<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MapColorSize;
use App\Model\MapMstOfferProduct;
use App\Model\MapProductMstSize;
use App\Model\MstOffer;
use App\Model\Offer;
use App\Model\TxnCategory;
use App\Model\TxnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = MstOffer::orderBy('id', 'DESC')->get();
        return view('backend.admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:mst_offers,title',
        ],
            [
                'title.required' => 'Please Enter Title',
                'title.unique'   => $request->title . ' Offer Already Exists',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Offer', $validator->errors()->first());
            return redirect(route('admin.offers.all'))->withInput();
        }

        MstOffer::create([
            'title'  => $request->title,
            'status' => true,
        ]);

        connectify('success', 'Offer Added', 'Offer has been added successfully !');

        return redirect(route('admin.offers.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $offer = MstOffer::where('id', $id)->firstOrFail();

            $map_offers = \DB::table('map_mst_offer_products as mp')
                ->selectRaw('mp.id as map_id, mp.status, mp.created_at, c.name as category_name, p.title as product_name, col.title as color_name, s.title as size_name')
                ->join('txn_categories as c', 'c.id', 'mp.category_id')
                ->join('txn_products as p', 'p.id', 'mp.offer_product_id')
                ->join('mst_colors as col', 'col.id', 'mp.color_id')
                ->join('mst_sizes as s', 's.id', 'mp.size_id')
                ->where('offer_id', $id)
                ->get();

            $categories = TxnCategory::where('status', true)->get();

            $products = TxnProduct::where('status', true)->get();

            return view('backend.admin.offers.edit', compact('offer', 'categories', 'products', 'map_offers'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Offer Not Found !');
                return redirect(route('admin.offers.all'));
            }
            \Log::error($ex->getMessage());
            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End !');
            return redirect(route('admin.offers.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'category_id'      => 'required_with:product_id',
            'product_id'       => 'required_with:category_id',
            'offer_product_id' => 'nullable',
            'offer_color_id'   => 'nullable',
            'offer_size_id'    => 'nullable',
            'purchase_qty'     => 'nullable|min:1',
            'offered_qty'      => 'nullable|min:1',
        ],
            [
                'category_id.required_with' => 'Select Category when Product selected !',
                'product_id.required_with'  => 'Select Product when Category selected !',
                'purchase_qty.min'          => 'Purchase Quantity Should be minimum 1 !',
                'offered_qty.min'           => 'Offered Quantity Should be minimum 1 !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Edit Offer', $validator->errors()->first());
            return redirect(route('admin.offers.edit', $id))->withInput();
        }

        try {

            $offer = Offer::where('id', $id)->with('product')->firstOrFail();

            if ($request->filled('category_id')) {

                $offer->update([
                    'category_id' => $request->category_id,
                    'product_id'  => $request->product_id,
                ]);

            }

            if ($request->filled('offer_product_id')) {

                $offer->update([
                    'offer_product_id' => $request->offer_product_id,
                ]);

            }

            if ($request->filled('offer_color_id')) {

                $offer->update([
                    'offer_color_id' => $request->offer_color_id,
                ]);

            }

            if ($request->filled('offer_size_id')) {

                $offer->update([
                    'offer_size_id' => $request->offer_size_id,
                ]);

            }

            if ($request->filled('purchase_qty')) {

                $offer->product->update([
                    'purchase_qty' => $request->purchase_qty,
                ]);

            }

            if ($request->filled('offered_qty')) {

                $offer->product->update([
                    'offered_qty' => $request->offered_qty,
                ]);

            }

            if ($request->filled('status')) {

                $offer->update([
                    'status' => $request->status,
                ]);

            }

            connectify('success', 'Offer Updated', 'Offer Updated Successfully !');

            return redirect(route('admin.offers.edit', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Offer Not Found !');
                return redirect(route('admin.offers.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End !');
            return redirect(route('admin.offers.edit', $id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{

            $offer = MapMstOfferProduct::where('id', $request->offer_id)->firstOrFail();
            
            $offer->delete();

            connectify('success', 'Offer Product Removed', 'Offer Product has been removed successfully !');

            return back();

        }catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Offer Not Found !');
                return redirect(route('admin.offers.all'));
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong From Our End !');
            return back();
        }
        
    }

    public function getProducts(Request $request)
    {

        $category = TxnCategory::where('id', $request->cate_id)->firstOrFail();

        $categories = \DB::select(\DB::raw("select  id
            from    (select * from txn_categories
                     order by parent_id, id) txn_categories,
                    (select @pv := $category->id) initialisation
            where   find_in_set(parent_id, @pv) > 0
            and     @pv := concat(@pv, ',', id)"));

        $cateLists    = [];
        $cateLists[0] = $category->id;

        foreach ($categories as $cate) {
            array_push($cateLists, $cate->id);
        }

        $products = TxnProduct::whereIN('category_id', $cateLists)
            ->get();

        return response()->json(['products' => $products], 200);
    }

    public function getColors(Request $request)
    {

        $colors = MapColorSize::where('product_id', $request->prod_id)
            ->with('color')
            ->get();

        $sizes = MapProductMstSize::where('product_id', $request->prod_id)
            ->with('size')
            ->get();

        return response()->json(['colors' => $colors, 'sizes' => $sizes], 200);
    }

    public function mapOfferProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id'      => 'required|numeric|exists:txn_categories,id',
            'offer_id'         => 'required|exists:mst_offers,id',
            'offer_product_id' => 'required|numeric|exists:txn_products,id',
            'offer_color_id'   => 'required|numeric|exists:mst_colors,id',
            'offer_size_id'    => 'required|numeric|exists:mst_sizes,id',
        ],
            [
                'category_id.required'      => 'Please Select Category',
                'category_id.exists'        => 'Caegory Not Found !',
                'offer_id.required'         => 'Invalid Data Provided',
                'offer_id.exists'           => 'Whoops Offer Not Found !',
                'offer_product_id.required' => 'Please Select Offer Product',
                'offer_product_id.exists'   => 'Product Not Found !',
                'offer_color_id.required'   => 'Please Select Offer Colour',
                'offer_color_id.exists'     => 'Colour Not Found !',
                'offer_size_id.required'    => 'Please Select Offer Size',
                'offer_size_id.exists'      => 'Size Not Found !',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Offer', $validator->errors()->first());
            return redirect(route('admin.offers.edit', $request->offer_id))->withInput();
        }

        // dd($request);

        MapMstOfferProduct::create([
            'category_id'      => $request->category_id,
            'offer_id'         => $request->offer_id,
            'offer_product_id' => $request->offer_product_id,
            'color_id'         => $request->offer_color_id,
            'size_id'          => $request->offer_size_id,
            'status'           => true,
        ]);

        connectify('success', 'Offer Added', 'Offer has been added successfully !');

        return redirect(route('admin.offers.edit', $request->offer_id));
    }
}
