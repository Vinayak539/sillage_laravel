<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MapColorSize;
use App\Model\MapOfferProduct;
use App\Model\MapProductMstSize;
use App\Model\MasterWarranty;
use App\Model\MstColor;
use App\Model\MstOffer;
use App\Model\MstSize;
use App\Model\ProductFaq;
use App\Model\TxnBrand;
use App\Model\TxnCategory;
use App\Model\TxnCondition;
use App\Model\TxnCustomField;
use App\Model\TxnImage;
use App\Model\TxnKeyword;
use App\Model\TxnMasterGst;
use App\Model\TxnMaterial;
use App\Model\TxnProduct;
use App\Model\TxnWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = TxnProduct::with('category')->orderBy('id')->paginate(50);
        $gsts     = TxnMasterGst::where('status', true)->get();
        return view('backend.admin.products.index', compact('products', 'gsts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands     = TxnBrand::where('status', true)->get();
        $sizes      = MstSize::where('status', true)->get();
        $gsts       = TxnMasterGst::where('status', true)->get();
        $colors     = MstColor::where('status', true)->get();
        $materials  = TxnMaterial::where('status', true)->get();
        $units      = TxnWeight::where('status', true)->get();
        $conditions = TxnCondition::where('status', true)->get();
        $gsts       = TxnMasterGst::where('status', true)->get();
        $warranties = MasterWarranty::where('status', true)->get();
        $categories = TxnCategory::where('status', true)->orderBy('name', 'ASC')->get();

        return view('backend.admin.products.create', compact('brands', 'sizes', 'colors', 'materials', 'units', 'conditions', 'gsts', 'categories', 'warranties', 'gsts'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'          => 'required|string',
                'image_url'      => 'required|image|max:1024|mimes:jpeg,png',
                'image_url1'     => 'required|image|max:1024|mimes:jpeg,png',
                'description'    => 'required|string',
                'brand_id'       => 'required|integer|exists:txn_brands,id',
                'category_id'    => 'required|exists:txn_categories,id',
                'color_id'       => 'required|integer|exists:mst_colors,id',
                'size_id'        => 'required|exists:mst_sizes,id',
                'material_id'    => 'required|integer|exists:txn_materials,id',
                'weight_id'      => 'nullable|integer|exists:txn_weights,id',
                'condition_id'   => 'required|integer|exists:txn_conditions,id',
                'warranty_id'    => 'nullable|integer|exists:master_warranties,id',
                'gst_id'         => 'required|integer|exists:txn_master_gsts,id',
                'breadth'        => 'nullable|string|max:191',
                'height'         => 'nullable|string|max:191',
                'weight'         => 'nullable|string|max:191',
                'image_urls'     => 'required|array',
                'image_urls.*'   => 'image|max:1024|mimes:jpeg,png',
                'keywords'       => 'required|string',
                'is_cod'         => 'required|numeric|max:1',
                'review_status'  => 'required|numeric|min:0|max:1',
                'mrp'            => 'required|numeric|min:1',
                'starting_price' => 'required|numeric|min:1',
                'stock'          => 'required|numeric|min:1',
            ],
            [
                'title.required'            => 'Please Enter Product Name',
                'title.unique'              => ' Product Already Available',
                'image_url.required'        => 'Please Choose Front Image',
                'image_url.image'           => 'Please Choose Proper front Image',
                'image_url.mimes'           => 'Please Choose Front Image of type JPG & PNG Only',
                'image_url.max'             => 'Please Choose Front Image of Maximum Size 1MB Only',
                'image_url1.required'       => 'Please Choose Back Image',
                'image_url1.image'          => 'Please Choose Back Proper Image',
                'image_url1.mimes'          => 'Please Choose Back Image of type JPG & PNG Only',
                'image_url1.max'            => 'Please Choose Back Image of Maximum Size 1MB Only',
                'brand_id.required'         => 'Please Select Brand',
                'brand_id.exists'           => 'Brand Not Exists',
                'category_id.required'      => 'Please Select Category',
                'category_id.exists'        => 'Category Not Exists',
                'weight_id.exists'          => 'Unit Not Exists',
                'condition_id.required'     => 'Please Select Condition',
                'condition_id.exists'       => 'Condition Not Exists',
                'gst_id.required'           => 'Please Select GST',
                'gst_id.exists'             => 'GST Not Exists',
                'warranty_id.required'      => 'Please Select Warranty',
                'warranty_id.exists'        => 'Warranty Not Exists',
                'starting_price.required'   => 'Please Select Starting Price',
                'buy_it_now_price.required' => 'Please Select Buying Price',
                'reserve_price.required'    => 'Please Select Reserve Price',
                'mrp.required'              => 'Please Select MRP',
                'image_urls.*.image'        => 'Please Choose Proper Multiple Image',
                'image_url.*.mimes'         => 'Please Choose Multiple Image of type JPG & PNG Only',
                'image_url.*.max'           => 'Please Choose Multiple Image of Maximum Size 1MB Only',
                'size_id.required'          => 'Please Select Sizes',
                'size_id.exists'            => 'Size does not exists',
                'description.required'      => 'Please Enter Description',
                'keywords.required'         => 'Please Enter Atleast One Keyword of the Product',
                'is_cod.required'           => 'Please Select Cod Availability',
                'is_cod.min'                => 'Invalid data provided in cod availability',
                'review_status.required'    => 'Please Select Review Status',
                'review_status.min'         => 'Invalid data provided in Review Status',
                'mrp.min'                   => 'Mrp Should be More than 1',
                'starting_price.min'        => 'Starting Price Should be More than 1',
                'stock.required'            => 'Please Enter Stock',
                'stock.min'                 => 'Stock Should be More than 1',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Add Product', $validator->errors()->first());
            return redirect(route('admin.products.create'))->withInput();
        }

        if ($request->hasFile('image_url')) {
            $request['img'] = "front_" . Str::slug(Str::limit($request->title, 20), '-') . '-' . rand(0, 10) . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url->storeAs('public/images/products', $request->img);
        }

        if ($request->hasFile('image_url1')) {
            $request['img1'] = "back_" . Str::slug(Str::limit($request->title, 20), '-') . '-' . rand(0, 10) . '.' . pathinfo($request->image_url1->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url1->storeAs('public/images/products', $request->img1);
        }

        $category = TxnCategory::where('id', $request->category_id)->first();

        $product = TxnProduct::create([
            'title'           => $request->title,
            'brand_id'        => $request->brand_id,
            'material_id'     => $request->material_id,
            'weight_unit'     => $request->weight_id,
            'condition_id'    => $request->condition_id,
            'description'     => $request->description,
            'length'          => $request->length,
            'breadth'         => $request->breadth,
            'height'          => $request->height,
            'weight'          => $request->weight,
            'width'           => $request->width,
            'upc'             => $request->upc,
            'category_id'     => $request->category_id,
            'warranty_id'     => $request->warranty_id,
            'gst_id'          => $request->gst_id,
            'image_url'       => $request->img,
            'image_url1'      => $request->img1,
            'status'          => true,
            'isCodAvailable'  => $request->is_cod,
            'review_status'   => $request->review_status,
            'within_days'     => $request->within_days,
            'wrong_products'  => $request->wrong_products,
            'faulty_products' => $request->faulty_products,
            'quality_issue'   => $request->quality_issue,
            'slug_url'        => Str::slug($category->name . '-' . $request->title, '-'),
        ]);

        if ($request->filled('keywords')) {

            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                TxnKeyword::create([
                    'keyword'    => trim($keyword, ' '),
                    'product_id' => $product->id,
                ]);
            }
        }

        if ($request->hasFile('image_urls')) {

            foreach ($request->image_urls as $images) {
                $request['image'] = uniqid() . '.' . pathinfo($images->getClientOriginalName(), PATHINFO_EXTENSION);
                $images->storeAs('public/images/multi-products', $request->image);

                TxnImage::create([
                    'product_id' => $product->id,
                    'image_url'  => $request->image,
                    'color_id'   => $request->color_id,
                ]);
            }
        }

        if ($request->filled('color_id')) {

            $gst = TxnMasterGst::where('id', $request->gst_id)->first();

            $gst_value = 1 + ($gst->gst_value / 100);

            $before_gst_price = round($request->mrp / $gst_value);

            $gst_amount = round($request->mrp - $before_gst_price);

            MapColorSize::create([
                'product_id'       => $product->id,
                'color_id'         => $request->color_id,
                'size_id'          => $request->size_id,
                'mrp'              => $request->mrp,
                'stock'            => $request->stock,
                'starting_price'   => $request->starting_price,
                'buy_it_now_price' => $before_gst_price,
                'gst'              => $gst_amount,
            ]);

            $size = MstSize::where('id', $request->size_id)->first();

            MapProductMstSize::updateOrCreate([
                'product_id' => $product->id,
                'size_id'    => $size->id,
            ], [
                'product_id' => $product->id,
                'size_id'    => $size->id,
                'title'      => $size->title,
            ]);
        }

        if (array_key_exists('field_name', $request->all())) {
            if (!in_array(null, $request->field_name, true)) {
                foreach ($request->field_name as $index => $name) {
                    TxnCustomField::create([
                        'field_name'  => $name,
                        'field_value' => $request->field_value[$index],
                        'product_id'  => $product->id,
                    ]);
                }
            }
        }

        connectify('success', 'Product Added', 'Product has been added successfully !');

        return redirect(route('admin.products.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(TxnProduct $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $product     = TxnProduct::where('slug_url', $id)->with(['category', 'images', 'custom_fields', 'sizes', 'offer'])->firstOrFail();
            $brands      = TxnBrand::where('status', true)->get();
            $sizes       = MstSize::where('status', true)->get();
            $colors      = MstColor::where('status', true)->get();
            $materials   = TxnMaterial::where('status', true)->get();
            $units       = TxnWeight::where('status', true)->get();
            $conditions  = TxnCondition::where('status', true)->get();
            $gsts        = TxnMasterGst::where('status', true)->get();
            $categories  = TxnCategory::where('status', true)->get();
            $allkeywords = TxnKeyword::where('product_id', $product->id)->get();
            $warranties  = MasterWarranty::where('status', true)->get();
            $keywords    = $allkeywords->implode('keyword', ',');

            $offers = MstOffer::where('status', true)->get();

            $product_details = DB::table('map_color_sizes as m')
                ->selectRaw("m.id as map_id, m.mrp, m.stock, m.starting_price, s.title as size_name, s.id as size_id, c.title as color_name, c.id as color_id, m.status")
                ->join('mst_sizes as s', 's.id', 'm.size_id')
                ->join('mst_colors as c', 'c.id', 'm.color_id')
                ->Where('m.product_id', $product->id)
                ->orderBy('m.id', 'DESC')
                ->get();

            return view('backend.admin.products.edit', compact('product_details', 'product', 'brands', 'sizes', 'colors', 'materials', 'units', 'conditions', 'gsts', 'keywords', 'categories', 'warranties', 'offers'));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Edit Product', 'Whoops Product Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Edit Product' => $ex->getMessage()]);

                connectify('error', 'Edit Product', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.all'));
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'        => 'required|string',
                'image_url'    => 'nullable|image|max:1024|mimes:jpeg,png',
                'description'  => 'required|string',
                'brand_id'     => 'required|integer|exists:txn_brands,id',
                'material_id'  => 'nullable|integer|exists:txn_materials,id',
                'weight_id'    => 'nullable|integer|exists:txn_weights,id',
                'condition_id' => 'required|integer|exists:txn_conditions,id',
                'category_id'  => 'required|integer|exists:txn_categories,id',
                'gst_id'       => 'required|integer|exists:txn_master_gsts,id',
                // 'expiry_date' => 'nullable|date_format:Y-m-d',
                'length'       => 'nullable|string|max:191',
                'breadth'      => 'nullable|string|max:191',
                'height'       => 'nullable|string|max:191',
                'weight'       => 'nullable|string|max:191',
                'keywords'     => 'required|string',
                'warranty_id'  => 'nullable|integer|exists:master_warranties,id',
                'is_cod'       => 'required|numeric|max:1',
                'review_status'       => 'required|numeric|min:0|max:1',
            ],
            [
                'title.required'          => 'Please Enter Product Name',
                'image_url.image'         => 'Please Choose Proper Image',
                'image_url.mimes'         => 'Please Choose Image of type JPG & PNG Only',
                'image_url.max'           => 'Please Choose Image of Maximum Size 1MB Only',
                'brand_id.required'       => 'Please Select Brand',
                'brand_id.exists'         => 'Brand Not Exists',
                'weight_id.exists'        => 'Unit Not Exists',
                'material_id.exists'      => 'Material Not Exists',
                'condition_id.required'   => 'Please Select Condition',
                'condition_id.exists'     => 'Condition Not Exists',
                'category_id.required'    => 'Please Select Category',
                'category_id.exists'      => 'Category Not Exists',
                'expiry_date.required'    => 'Please Select Expiry Date',
                'expiry_date.date_format' => 'Please Enter date in DD-MM-YYYY format',
                'keywords.required'       => 'Please Enter Atleast One Keyword of the Product',
                'warranty_id.required'    => 'Please Select Warranty',
                'warranty_id.exists'      => 'Warranty Not Exists',
                'is_cod.required'         => 'Please Select Cod Availability',
                'is_cod.min'              => 'Invalid data provided in cod availability',
                'review_status.required'    => 'Please Select Review Status',
                'review_status.min'         => 'Invalid data provided in Review Status',
                'gst_id.required'         => 'Please Select GST',
                'gst_id.exists'           => 'GST Not Exists',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'update Product', $validator->errors()->first());
            return redirect(route('admin.products.edit', $id))->withInput();
        }

        try {

            $product = TxnProduct::where('slug_url', $id)->with('offer')->firstOrFail();
            if ($request->hasFile('image_url')) {

                $old_image = public_path('/storage/images/products/' . $product->image_url);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $request->image_url->storeAs('public/images/products', $product->image_url);
            }

            if ($request->hasFile('image_url1')) {

                $old_image = public_path('/storage/images/products/' . $product->image_url1);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $request->image_url1->storeAs('public/images/products', $product->image_url1);
            }

            $category = TxnCategory::where('id', $request->category_id)->first();

            $product->update([
                'title'           => $request->title,
                'brand_id'        => $request->brand_id,
                'material_id'     => $request->material_id,
                'weight_unit'     => $request->weight_id,
                'condition_id'    => $request->condition_id,
                'category_id'     => $request->category_id,
                'description'     => $request->description,
                'length'          => $request->length,
                'breadth'         => $request->breadth,
                'height'          => $request->height,
                'weight'          => $request->weight,
                'width'           => $request->width,
                'upc'             => $request->upc,
                // 'expiry_date' => $request->expiry_date,
                'status'          => $request->status,
                'warranty_id'     => $request->warranty_id,
                'gst_id'          => $request->gst_id,
                'isCodAvailable'  => $request->is_cod,
                'within_days'     => $request->within_days,
                'review_status'   => $request->review_status,
                'wrong_products'  => $request->wrong_products,
                'faulty_products' => $request->faulty_products,
                'quality_issue'   => $request->quality_issue,
                'slug_url'        => Str::slug($category->name . '-' . $request->title, '-'),
            ]);

            if ($request->filled('keywords')) {

                DB::table('txn_keywords')->where('product_id', $product->id)->delete();
                $keywords = explode(',', $request->keywords);

                foreach ($keywords as $keyword) {
                    TxnKeyword::create([
                        'keyword'    => trim($keyword, ' '),
                        'product_id' => $product->id,
                    ]);
                }
            }

            if ($product->offer && $request->offer_id == null) {

                $product->offer->delete();

            } else {

                MapOfferProduct::updateOrCreate(
                    [
                        'product_id' => $product->id,
                    ], [
                        'product_id'        => $product->id,
                        'mst_offer_id'      => $request->offer_id,
                        'purchase_quantity' => $request->purchase_quantity,
                        'offered_quantity'  => $request->offered_quantity,
                    ]
                );
            }

            connectify('success', 'Product Updated', 'Product has been Updated successfully !');

            return redirect(route('admin.products.edit', $product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'update Product', 'Whoops Product Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['update Product' => $ex->getMessage()]);

                connectify('error', 'update Product', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url))->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function addImages(Request $request, $id)
    {
        $request->validate(
            [
                'image_urls'   => 'required|array',
                'image_urls.*' => 'image|max:1024|mimes:jpeg,png',
            ],
            [
                'image_urls.*.required' => 'Please Choose Atleast One Image',
                'image_urls.*.image'    => 'Please Choose Proper Multiple Image',
                'image_url.*.mimes'     => 'Please Choose Multiple Image of type JPG & PNG Only',
                'image_url.*.max'       => 'Please Choose Multiple Image of Maximum Size 1MB Only',
            ]
        );

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            if ($request->hasFile('image_urls')) {
                foreach ($request->image_urls as $images) {

                    $request['image'] = uniqid() . '.' . pathinfo($images->getClientOriginalName(), PATHINFO_EXTENSION);
                    $images->storeAs('public/images/multi-products', $request->image);

                    TxnImage::create([
                        'product_id' => $product->id,
                        'image_url'  => $request->image,
                        'color_id'   => $request->color_id ? $request->color_id : null,
                    ]);
                }
            }

            connectify('success', 'Images Added', 'Images has been added successfully !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Add Image', 'Whoops Image Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Add Image' => $ex->getMessage()]);

                connectify('error', 'Add Image', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }

    public function deleteImage(Request $request)
    {
        try {

            $image = TxnImage::where('id', $request->image_id)->with('product')->firstOrFail();

            $old_image = public_path('/storage/images/multi-products/' . $image->image_url);

            if (File::exists($old_image)) {
                File::delete($old_image);
            }

            $image->delete();

            connectify('success', 'Image Added', 'Image has been Deleted Successfully !');

            return back();

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Delete Image', 'Whoops Image Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Delete Image' => $ex->getMessage()]);

                connectify('error', 'Delete Image', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $image->product->slug_url));
            }
        }
    }

    public function addCustomField(Request $request, $id)
    {
        $request->validate(
            [
                'field_name'  => 'required|string|max:191',
                'field_value' => 'required|string|max:191',
            ],
            [
                'field_name.required'  => 'Please Enter Field Name',
                'field_value.required' => 'Please Enter Field Value',
            ]
        );

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            TxnCustomField::create([
                'field_name'  => $request->field_name,
                'field_value' => $request->field_value,
                'product_id'  => $product->id,
            ]);

            connectify('success', 'Custom Field Added', 'Custom Field has been Added Successfully !');

            return redirect(route('admin.products.edit', $product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Add Custom Field', 'Whoops Custom Field Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Add Custom Field' => $ex->getMessage()]);

                connectify('error', 'Add Custom Field', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }

    public function addColor(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'color_id'       => 'required|integer|exists:mst_colors,id',
                'size_id'        => 'required|exists:mst_sizes,id',
                'image_urls'     => 'required|array',
                'image_urls.*'   => 'image|max:1024|mimes:jpeg,png',
                'mrp'            => 'required|numeric|min:1',
                'stock'          => 'required|numeric|min:1',
                'starting_price' => 'required|numeric|min:1',
                'status'         => 'required|numeric|min:0|max:1',
            ],
            [
                'color_id.required'       => 'Please Choose Color',
                'color_id.exists'         => 'Color does not exists',
                'size_id.required'        => 'Please Select Sizes',
                'size_id.exists'          => 'Size does not exists',
                'image_urls.required'     => 'Please Choose Atleast One Image',
                'image_urls.*.image'      => 'Please Choose Proper Multiple Image',
                'image_urls.*.max'        => 'Please Choose Image of maximum size 1Mb',
                'mrp.required'            => 'Please Enter Mrp',
                'mrp.min'                 => 'Mrp Should be More than 1',
                'stock.required'          => 'Please Enter Stock',
                'stock.min'               => 'Stock Should be More than 1',
                'starting_price.required' => 'Please Enter Selling Price',
                'starting_price.min'      => 'Selling Price Should be More than 1',
                'status.required'         => 'Please Enter Status',
                'status.min'              => 'Invalid Status Provided',
                'status.max'              => 'Invalid Status Provided',
                'status.numeric'          => 'Invalid Status Provided',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Add Color & Size', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            $colorSize = MapColorSize::where('product_id', $product->id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();

            if ($colorSize) {

                connectify('error', 'Error', 'Color & Size already Available with "' . $product->title . '"');

                return redirect(route('admin.products.edit', $product->slug_url))->withInput($request->all());
            }

            if ($request->hasFile('image_urls')) {

                foreach ($request->image_urls as $images) {
                    $request['image'] = uniqid() . '.' . pathinfo($images->getClientOriginalName(), PATHINFO_EXTENSION);
                    $images->storeAs('public/images/multi-products', $request->image);

                    TxnImage::create([
                        'product_id' => $product->id,
                        'image_url'  => $request->image,
                        'color_id'   => $request->color_id,
                    ]);
                }
            }

            if ($request->filled('color_id')) {

                $gst = TxnMasterGst::where('id', $product->gst_id)->first();

                $gst_value = 1 + ($gst->gst_value / 100);

                $before_gst_price = round($request->mrp / $gst_value);

                $gst_amount = round($request->mrp - $before_gst_price);

                MapColorSize::create([
                    'product_id'       => $product->id,
                    'color_id'         => $request->color_id,
                    'size_id'          => $request->size_id,
                    'mrp'              => $request->mrp,
                    'stock'            => $request->stock,
                    'starting_price'   => $request->starting_price,
                    'buy_it_now_price' => $before_gst_price,
                    'gst'              => $gst_amount,
                    'status'           => true
                ]);

                $size = MstSize::where('id', $request->size_id)->first();

                MapProductMstSize::updateOrCreate([
                    'product_id' => $product->id,
                    'size_id'    => $size->id,
                ], [
                    'product_id' => $product->id,
                    'size_id'    => $size->id,
                    'title'      => $size->title,
                ]);
            }

            connectify('success', 'Color & Size Added', 'Color & Size has been Added Successfully !');

            return redirect(route('admin.products.edit', $product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Add Color & Size', 'Whoops Color Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Add Color & Size' => $ex->getMessage()]);

                connectify('error', 'Add Color & Size', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }

    public function editColor($id)
    {
        try {

            $cl = MapColorSize::where('id', $id)->with('product')->firstOrFail();

            $product = TxnProduct::where('id', $cl->product_id)->with('sizes')->firstOrFail();

            $colors = MstColor::where('status', true)->get();

            $images = TxnImage::where('color_id', $cl->color_id)->where('product_id', $cl->product_id)->orderBy('id', 'ASC')->get();

            return view('backend.admin.products.color-edit', compact('cl', 'colors', 'product', 'images'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Update Custom Field', 'Whoops Custom Field Not found !');

                return redirect(route('admin.products.all'));

            } else {

                \Log::error(['Product Update Custom field' => $ex->getMessage()]);

                connectify('error', 'Error Update Custom Field', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }

    public function updateColorSize(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'size_id'        => 'required|exists:mst_sizes,id',
                'mrp'            => 'required|numeric|min:1',
                'stock'          => 'required|numeric|min:0',
                'starting_price' => 'required|numeric|min:1',
                'status' => 'required|numeric|min:0|max:1',
            ],
            [
                'size_id.required'        => 'Please Select Sizes',
                'size_id.exists'          => 'Size does not exists',
                'mrp.required'            => 'Please Enter Mrp',
                'mrp.min'                 => 'Mrp Should be More than 1',
                'stock.required'          => 'Please Enter Stock',
                'stock.min'               => 'Stock Should be More than 1',
                'starting_price.required' => 'Please Enter Selling Price',
                'starting_price.min'      => 'Selling Price Should be More than 1',
                'status.required'         => 'Please Enter Status',
                'status.min'              => 'Invalid Status Provided',
                'status.max'              => 'Invalid Status Provided',
                'status.numeric'          => 'Invalid Status Provided',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return redirect(route('admin.products.color.edit', $id))->withInput();
        }

        try {

            $cl = MapColorSize::where('id', $id)->with('color')->firstOrFail();

            $product = TxnProduct::where('id', $cl->product_id)->firstOrFail();

            $cl->update([
                'size_id'        => $request->size_id,
                'mrp'            => $request->mrp,
                'stock'          => $request->stock,
                'starting_price' => $request->starting_price,
                'status' => $request->status,
            ]);

            connectify('success', 'Color & Size Added', 'Data has been Updated Successfully !');

            return redirect(route('admin.products.color.edit', $id));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Update Custom Field', 'Whoops Custom Field Not found !');

                return redirect(route('admin.products.all'));

            } else {

                \Log::error(['Product Update Custom field' => $ex->getMessage()]);

                connectify('error', 'Error Update Custom Field', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }

    public function updateCustomField(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'field_name'  => 'required|string|max:191',
                'field_value' => 'required|string|max:191',
            ],
            [
                'field_name.required'  => 'Please Enter Field Name',
                'field_value.required' => 'Please Enter Field Value',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Update Custom Field', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $field = TxnCustomField::where('id', $request->field_id)->with('product')->firstOrFail();
            $field->update([
                'field_name'  => $request->field_name,
                'field_value' => $request->field_value,
            ]);
            connectify('success', 'Custom Field Updated', 'Custom Field Updated Successfully !');

            return redirect(route('admin.products.edit', $field->product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Update Custom Field', 'Whoops Custom Field Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Product Update Custom field' => $ex->getMessage()]);

                connectify('error', 'Error Update Custom Field', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $field->product->slug_url));
            }
        }
    }

    public function destroyCustomField(Request $request)
    {
        try {

            $field = TxnCustomField::where('id', $request->cust_id)->with('product')->firstOrFail();

            $field->delete();

            connectify('success', 'Deleted Custom Field', 'Custom Field Deleted Successfully !');

            return redirect(route('admin.products.edit', $field->product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Delete Custom Field', 'Whoops Custom Field Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Product Delete Custom field' => $ex->getMessage()]);

                connectify('error', 'Error Delete Custom Field', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $field->product->slug_url));
            }
        }
    }

    public function destroyColor(Request $request)
    {
        try {

            $color = MapColorSize::where('id', $request->map_id)->with('product')->firstOrFail();

            $images = TxnImage::where('product_id', $color->product->id)->where('color_id', $color->color_id)->get();

            foreach ($images as $image) {

                $old_image = public_path('/storage/images/multi-products/' . $image->image_url);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $image->delete();
            }

            $color->delete();

            connectify('success', 'Deleted Color & Size', 'Color & Size Deleted Successfully !');

            return redirect(route('admin.products.edit', $color->product->slug_url));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Delete Color & Size', 'Whoops Color & Size Not found !');

                return redirect(route('admin.products.all'));
            } else {

                return $ex->getMessage();
                \Log::error(['Product Delete Color & Size' => $ex->getMessage()]);

                connectify('error', 'Error Delete Color & Size', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $color->product->slug_url));
            }
        }
    }

    public function updateColor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'color_id'       => 'required|integer|exists:mst_colors,id',
                'size_id'        => 'required|exists:mst_sizes,id',
                'mrp'            => 'required|numeric|min:1',
                'stock'          => 'required|numeric|min:0',
                'starting_price' => 'required|numeric|min:1',
            ],
            [
                'color_id.required'       => 'Please Choose Color',
                'color_id.exists'         => 'Color does not exists',
                'size_id.required'        => 'Please Select Sizes',
                'size_id.exists'          => 'Size does not exists',
                'mrp.required'            => 'Please Enter Mrp',
                'mrp.min'                 => 'Mrp Should be More than 1',
                'stock.required'          => 'Please Enter Stock',
                'stock.min'               => 'Stock Should be More than 1',
                'starting_price.required' => 'Please Enter Selling Price',
                'starting_price.min'      => 'Selling Price Should be More than 1',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Add Color & Size', $validator->errors()->first());
            return back()->withInput();
        }

        try {

            $mapColorSize = MapColorSize::where('id', $request->map_id)->with('product')->firstOrFail();

            // $colorSize = MapColorSize::where('product_id', $mapColorSize->product->id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first();

            // if($colorSize){

            //     connectify('error', 'Error', 'Color & Size already Available with "' . $mapColorSize->product->title . '"');

            //     return redirect(route('admin.products.edit', $mapColorSize->product->slug_url))->withInput($request->all());
            // }

            $gst = TxnMasterGst::where('id', $mapColorSize->product->gst_id)->first();

            $gst_value = 1 + ($gst->gst_value / 100);

            $before_gst_price = round($request->mrp / $gst_value);

            $gst_amount = round($request->mrp - $before_gst_price);

            MapColorSize::updateOrCreate([
                'product_id' => $mapColorSize->product->id,
                'color_id'   => $request->color_id,
                'size_id'    => $request->size_id,
            ], [
                'color_id'         => $request->color_id,
                'size_id'          => $request->size_id,
                'mrp'              => $request->mrp,
                'stock'            => $request->stock,
                'starting_price'   => $request->starting_price,
                'buy_it_now_price' => $before_gst_price,
                'gst'              => $gst_amount,
                'status'              => $request->status,
            ]);

            connectify('success', 'Color & Size Updated', 'Color & Size Updated Successfully !');

            return redirect(route('admin.products.edit', $mapColorSize->product->slug_url));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Update Color & Size', 'Whoops Color & Size Not found !');

                return redirect(route('admin.products.all'));
            } else {

                return $ex->getMessage();
                \Log::error(['Product Update Color & Size' => $ex->getMessage()]);

                connectify('error', 'Error Update Color & Size', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $mapColorSize->product->slug_url));
            }
        }
    }

    public function getQuestions($slug)
    {
        try {

            $product = TxnProduct::where('slug_url', $slug)->with('qnas')->firstOrFail();
            return view('backend.admin.products.qnas', compact('product'));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find Product !');
            } else {
                \Log::error(['Product Get All Question' => $ex->getMessage()]);
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function getQuestion($id)
    {
        try {

            $faq = ProductFaq::where('id', $id)->with('product')->firstOrFail();
            return view('backend.admin.products.qna-edit', compact('faq'));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find question !');
            } else {
                \Log::error(['Product Get Question' => $ex->getMessage()]);
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function deleteQuestion($id)
    {
        try {

            $faq = ProductFaq::where('id', $id)->firstOrFail();
            $faq->delete();
            return redirect(route('admin.products.all'))->with('messageSuccess', 'Data has been deleted successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find question !');
            } else {
                \Log::error(['Product Delete Question' => $ex->getMessage()]);
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function updateQuestion(Request $request, $id)
    {
        $request->validate(
            [
                'question' => 'required|string',
                'answer'   => 'required|string',
                'status'   => 'required|numeric|max:1',
            ],
            [
                'question.required' => 'Please Enter Question',
                'answer.required'   => 'Please Enter Answer',
                'status.required'   => 'Please Select Status',
                'status.numeric'    => 'Invalid Status Given',
                'status.max'        => 'Invalid Status Given',
            ]
        );

        try {

            $faq = ProductFaq::where('id', $id)->with('product')->firstOrFail();

            $faq->update([
                'question'   => $request->question,
                'answer'     => $request->answer,
                'status'     => $request->status,
                'replied_by' => auth('admin')->user()->name,
            ]);

            return redirect(route('admin.products.all'))->with('messageSuccess', 'Data has been updated successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find question !');
            } else {
                \Log::error(['Product Update Questions' => $ex->getMessage()]);
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function addSizes(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'size_id' => 'required|numeric|exists:mst_sizes,id',
            ],
            [
                'size_id.required' => 'Please Select Size',
                'size_id.exists'   => 'Size does not exists',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Add Product Size', $validator->errors()->first());
            return redirect(route('admin.products.edit', $id))->withInput();
        }

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            $size = MstSize::where('id', $request->size_id)->first();

            MapProductMstSize::create([
                'title'      => $size->title,
                'product_id' => $product->id,
                'size_id'    => $size->id,
            ]);

            connectify('success', 'Add Size', 'Size Added Successfully !');

            return redirect(route('admin.products.edit', $product->slug_url));
        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error Add Product Size', 'Whoops Size Not found !');

                return redirect(route('admin.products.all'));
            } else {
                \Log::error(['Product Add Product Size' => $ex->getMessage()]);

                connectify('error', 'Error Add Product Size', 'Whoops Something Went Wrong from our end !');

                return redirect(route('admin.products.edit', $product->slug_url));
            }
        }
    }
}
