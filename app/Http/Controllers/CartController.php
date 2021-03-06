<?php

namespace App\Http\Controllers;

use App\Model\MapColorSize;
use App\Model\MapOfferProduct;
use App\Model\MstSize;
use App\Model\TxnImage;
use App\Model\TxnProduct;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::getContent();
        return view('frontend.order.cart', compact('carts'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qty' => 'required|min:1|max:4',
        ],
            [
                'qty.required' => 'Please Select Atleast One Quantity',
                'qty.min' => 'Please Select Atleast One Quantity',
                'qty.max' => 'Only 4 Quantity of product is allowed at a time'
            ]);

        if ($validator->fails()) {
            connectify('error', 'Checkout Error', $validator->errors()->first());
            return redirect(route('checkout'))->withInput();
        }

        try {

            $product = TxnProduct::where('id', $request->prod_id)->firstOrFail();

            $size = MstSize::where('id', $request->size_id)->first();

            $prodsizeColor = MapColorSize::where('color_id', $request->color_id)->where('product_id', $request->prod_id)->where('size_id', $request->size_id)->where('status', true)->with('color')->first();

            $image = TxnImage::where('color_id', $request->color_id)->where('product_id', $request->prod_id)->first();

            if ($prodsizeColor) {


                $exp_offer = explode(',', $request->map_ids);

                if ($request->filled('offers')) {

                    $selected_qty = explode(',', $request->offers);

                    $product_offer = MapOfferProduct::where('id', $exp_offer[0])->first();

                    if (count($selected_qty) > 0) {

                        // dd(count($selected_qty), $product_offer->purchase_quantity, $product_offer->offered_quantity * $request->qty);

                        $validateSelectedOffer = (count($selected_qty)) == ($product_offer->purchase_quantity * ($product_offer->offered_quantity * $request->qty));

                        if (!$validateSelectedOffer) {

                            connectify('error', 'Invalid Offer', 'On Purchase of ' . $product_offer->purchase_quantity * $request->qty . ' Product(s) Select ' . $product_offer->offered_quantity * $request->qty . ' offer Product(s)');

                            return back()->withInput($request->all());
                        }
                    }
                }

                // dd((Int) $request->qty, count($selected_qty), $product_offer->purchase_quantity, $product_offer->offered_quantity);

                if ($prodsizeColor->stock <= 0) {

                    connectify('error', 'Product Out Of Stock', 'Product is Out Of Stock, stay tuned !');

                    return back();

                } elseif ($request->qty > $prodsizeColor->stock) {

                    connectify('error', 'Product Out Of Stock', $prodsizeColor->stock . ' Product Left in stock, stay tuned !');

                    return back();
                }

                Cart::add(array(
                    'id'         => $size->title . '_' . $prodsizeColor->id,
                    'name'       => $product->title,
                    'price'      => $prodsizeColor->mrp,
                    'quantity'   => $request->qty,
                    'attributes' => array(
                        'size_id'        => $size->id,
                        'color_id'       => $request->color_id,
                        'color_name'     => $prodsizeColor->color->title,
                        'size_name'      => $size->title,
                        'image_url'      => $product->image_url,
                        'slug_url'       => $product->slug_url,
                        'product_id'     => $product->id,
                        'category_id'    => $product->category_id,
                        'stock'          => $prodsizeColor->stock,
                        'map_id'         => $prodsizeColor->id,
                        'isCodAvailable' => $product->isCodAvailable,
                        'offer_map_id'   => $exp_offer[0],
                        'offers'         => json_encode($request->offers),
                        'color_image'    => $image->image_url
                    ),
                ));

                Cart::update($size->title . '_' . $prodsizeColor->id, array(
                    'quantity' => array(
                        'relative' => false,
                        'value'    => $request->qty,
                    ),
                ));

                connectify('success', 'Cart', '"' . $product->title . '"' . ' has been added to your cart !');

                return redirect(route('cart'));
            }

            connectify('error', 'Cart', ' Size "' . $size->title . '"' . ' is out of stock currently, stay tuned !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Cart', "It seems that the Product you're searching for doesn't exists !");

                return back();
            } else {
                \Log::error($ex->getMessage());

                return $ex->getMessage();

                connectify('error', 'Cart', "Oops, Something went wrong at our end !");

                return back();
            }
        }
    }

    public function update(Request $request)
    {
        $cart = Cart::get($request->itemid);

        $product = TxnProduct::where('id', $cart->attributes->product_id)->first();

        $size = MapColorSize::where('product_id', $product->id)->where('size_id', $cart->attributes->size_id)->where('color_id', $cart->attributes->color_id)->first();

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1|max:' . $size->stock,
        ],
            [
                'quantity.required' => 'Please enter quantity',
                'quantity.min'      => 'Quantity must be greater than 1',
                'quantity.max'      => 'Only ' . $size->stock . ' Quantity left in stock',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Cart Error', $validator->errors()->first());
            return back()->withInput();
        }

        Cart::update($request->itemid, array(

            'quantity'   => array(
                'relative' => false,
                'value'    => $request->quantity,
            ),

            'attributes' => array(
                'size_id'      => $cart->attributes->size_id,
                'color_id'     => $size->color_id,
                'color_name'   => $cart->attributes->color_name,
                'size_name'    => $cart->attributes->size_name,
                'map_id'       => $cart->attributes->map_id,
                'image_url'    => $product->image_url,
                'slug_url'     => $product->slug_url,
                'product_id'   => $product->id,
                'category_id'  => $product->category_id,
                'stock'        => $size->stock,
                'offer_map_id' => $cart->attributes->offer_map_id,
                'offers'       => $cart->attributes->offers,
            ),
        ));

        connectify('success', 'Cart Updated', 'Cart has been updated successfully !');

        return response()->json(['success' => 'Cart has been updated successfully !', 'size' => $size]);
    }

    public function destroy(Request $request)
    {
        $cart = Cart::get($request->item_id);
        Cart::remove($request->item_id);

        connectify('success', 'Item Removed', $cart->name . ' has been removed from your cart !');

        return back();
    }
}
