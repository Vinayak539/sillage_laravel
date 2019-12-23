<?php

namespace App\Http\Controllers;

use App\Model\MapColorSize;
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
        try {

            $product = TxnProduct::where('id', $request->prod_id)->firstOrFail();
            // $size    = MapColorSize::where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();
            $size = MapColorSize::where('id', $request->map_id)->first();

            if ($size->stock < 0 || $request->qty > $size->stock) {
                return back()->with('messageDanger1', $size->stock . ' Product Left in stock, stay tuned !');
            }

            Cart::add(array(
                'id' => $size->id,
                'name' => $product->title,
                'price' => $size->mrp,
                'quantity' => $request->qty,
                'attributes' => array(
                    'size_id' => $size->size_id,
                    'color_id' => $size->color_id,
                    'image_url' => $product->image_url,
                    'slug_url' => $product->slug_url,
                    'product_id' => $product->id,
                    'category_id' => $product->category_id,
                    'stock' => $size->stock,
                ),
            ));
            Cart::update($size->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->qty,
                ),
            ));

            connectify('success', 'Cart', $product->title . ' has been added to your cart !');

            return redirect(route('cart'));

            return redirect('/cart')->with('messageSuccess1', 'Product has been added to your cart !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with("messageDanger1", "It seems that the Product you're searching for doesn't exists !");
            } else {
                \Log::info($ex->getMessage());
                // return back()->with("messageDanger1", "Oops, Something went wrong at our end !");
                return back()->with("messageDanger1", "Error, " . $ex->getMessage());
            }
        }
    }

    public function update(Request $request)
    {
        $cart = Cart::get($request->itemid);

        $product = TxnProduct::where('id', $cart->attributes->product_id)->first();

        $size = MapColorSize::where('id', $cart->id)->first();

        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|min:1|max:' . $size->stock,
        ],
            [
                'quantity.required' => 'Please enter quantity',
                'quantity.min' => 'Quantity must be greater than 1',
                'quantity.max' => 'Only ' . $size->stock . ' Quantity left in stock',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Cart Error', $validator->errors()->first());
            return back()->withInput();
        }

        Cart::update($request->itemid, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),

            'attributes' => array(
                'size_id' => $size->size_id,
                'color_id' => $size->color_id,
                'image_url' => $product->image_url,
                'slug_url' => $product->slug_url,
                'product_id' => $product->id,
                'category_id' => $product->category_id,
                'stock' => $size->stock,
            ),
        ));

        connectify('success', 'Cart Updated', 'Cart has been updated successfully !');

        return response()->json(['success' => 'Cart has been updated successfully !']);
    }

    public function destroy(Request $request)
    {
        $cart = Cart::get($request->item_id);
        Cart::remove($request->item_id);

        connectify('success', 'Item Removed', $cart->name . ' has been removed from your cart !');

        return back();
    }
}
