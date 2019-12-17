<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MapProductToTopSection;
use App\Model\MasterWarranty;
use App\Model\MstColor;
use App\Model\MstSize;
use App\Model\ProductFaq;
use App\Model\SideProduct;
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
        $gsts = TxnMasterGst::where('status', true)->get();
        return view('backend.admin.products.index', compact('products', 'gsts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = TxnBrand::where('status', true)->get();
        $sizes = MstSize::where('status', true)->get();
        $colors = MstColor::where('status', true)->get();
        $materials = TxnMaterial::where('status', true)->get();
        $units = TxnWeight::where('status', true)->get();
        $conditions = TxnCondition::where('status', true)->get();
        $gsts = TxnMasterGst::where('status', true)->get();
        $warranties = MasterWarranty::where('status', true)->get();
        $categories = TxnCategory::where('status', true)->orderBy('name', 'ASC')->get();

        return view('backend.admin.products.create', compact('brands', 'sizes', 'colors', 'materials', 'units', 'conditions', 'gsts', 'categories', 'warranties'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'image_url' => 'required|image|max:1024|mimes:jpeg,png',
                'description' => 'required|string',
                'brand_id' => 'required|integer|exists:txn_brands,id',
                'category_id' => 'required|exists:txn_categories,id',
                'color_id' => 'required|integer|exists:txn_colors,id',
                'material_id' => 'required|integer|exists:txn_materials,id',
                'weight_id' => 'required|integer|exists:txn_weights,id',
                'condition_id' => 'required|integer|exists:txn_conditions,id',
                'gst_id' => 'required|integer|exists:txn_master_gsts,id',
                'warranty_id' => 'required|integer|exists:master_warranties,id',
                'expiry_date' => 'required|date_format:Y-m-d',
                'starting_price' => 'required|numeric|min:1',
                'buy_it_now_price' => 'required|numeric|min:1',
                'reserve_price' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
                'length' => 'required|string|max:191',
                'breadth' => 'required|string|max:191',
                'height' => 'required|string|max:191',
                'weight' => 'required|string|max:191',
                'stock' => 'required|numeric|min:0',
                'image_urls' => 'required|array',
                'image_urls.*' => 'image|max:1024|mimes:jpeg,png',
                'keywords' => 'required|string',
                'is_cod' => 'required|numeric|max:1',
            ],
            [
                'title.required' => 'Please Enter Product Name',
                'image_url.required' => 'Please Choose Product Image',
                'image_url.image' => 'Please Choose Proper Image',
                'image_url.mimes' => 'Please Choose Image of type JPG & PNG Only',
                'image_url.max' => 'Please Choose Image of Maximum Size 1MB Only',
                'brand_id.required' => 'Please Select Brand',
                'brand_id.exists' => 'Brand Not Exists',
                'category_id.required' => 'Please Select Category',
                'category_id.exists' => 'Category Not Exists',
                'weight_id.exists' => 'Unit Not Exists',
                'condition_id.required' => 'Please Select Condition',
                'condition_id.exists' => 'Condition Not Exists',
                'gst_id.required' => 'Please Select GST',
                'gst_id.exists' => 'GST Not Exists',
                'warranty_id.required' => 'Please Select Warranty',
                'warranty_id.exists' => 'Warranty Not Exists',
                'expiry_date.date_format' => 'Please Enter date in DD-MM-YYYY format',
                'starting_price.required' => 'Please Select Starting Price',
                'buy_it_now_price.required' => 'Please Select Buying Price',
                'reserve_price.required' => 'Please Select Reserve Price',
                'mrp.required' => 'Please Select MRP',
                'image_urls.*.image' => 'Please Choose Proper Multiple Image',
                'image_url.*.mimes' => 'Please Choose Multiple Image of type JPG & PNG Only',
                'image_url.*.max' => 'Please Choose Multiple Image of Maximum Size 1MB Only',
                'description.required' => 'Please Enter Description',
                'keywords.required' => 'Please Enter Atleast One Keyword of the Product',
                'stock.required' => 'Please Enter Stock',
                'stock.numeric' => 'Invalid data provided for stock',
                'stock.min' => 'Stock Should not be less than 0',
                'is_cod.required' => 'Please Select Cod Availability',
                'is_cod.min' => 'Invalid data provided in cod availability',
            ]
        );

        if ($request->hasFile('image_url')) {
            $request['img'] = Str::slug(Str::llimit($request->title, 20), '-') . '-' . rand(0, 10) . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url->storeAs('public/images/products', $request->img);
        }

        $request['status'] = $request->saveAsDraft == 'on' ? false : true;
        $request['expiry_date'] = $request->expiry_date == null ? null : $request->expiry_date;

        if ($request->filled('category_id')) {
            $category = TxnCategory::where('name', $request->category_id)->first();
        }

        $product = TxnProduct::create([
            'title' => $request->title,
            'brand_id' => $request->brand_id,
            'color_id' => $request->color_id,
            'material_id' => $request->material_id,
            'weight_unit' => $request->weight_id,
            'condition_id' => $request->condition_id,
            'gst' => $request->gst_id,
            'description' => $request->description,
            'starting_price' => $request->starting_price,
            'buy_it_now_price' => $request->buy_it_now_price,
            'reserve_price' => $request->reserve_price,
            'mrp' => $request->mrp,
            'length' => $request->length,
            'breadth' => $request->breadth,
            'height' => $request->height,
            'weight' => $request->weight,
            'width' => $request->width,
            'stock' => $request->stock,
            'upc' => $request->upc,
            'expiry_date' => $request->expiry_date,
            'category_id' => $category->id,
            'warranty_id' => $request->warranty_id,
            'image_url' => $request->img,
            'status' => $request->status,
            'gst_value' => $request->gst_amount,
            'isCodAvailable' => $request->is_cod,
            'within_days' => $request->within_days,
            'wrong_products' => $request->wrong_products,
            'faulty_products' => $request->faulty_products,
            'quality_issue' => $request->quality_issue,
        ]);

        $product->update([
            'slug_url' => Str::slug($request->title, '-'),
        ]);

        if ($request->filled('keywords')) {

            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $keyword) {
                TxnKeyword::create([
                    'keyword' => trim($keyword, ' '),
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
                    'image_url' => $request->image,
                ]);
            }
        }

        if (array_key_exists('field_name', $request->all())) {
            if (!in_array(null, $request->field_name, true)) {
                foreach ($request->field_name as $index => $name) {
                    TxnCustomField::create([
                        'field_name' => $name,
                        'field_value' => $request->field_value[$index],
                        'product_id' => $product->id,
                    ]);
                }
            }
        }

        if ($request->filled('section_id')) {

            MapProductToTopSection::create([
                'section_id' => $request->section_id,
                'product_id' => $product->id,
            ]);
        }

        if ($product->status == true) {
            return redirect(route('admin.products.all'))->with('messageSuccess', 'Product has been added Successfully !');
        }
        return redirect(route('admin.products.all'))->with('messageSuccess', 'Product has been save as draft !');
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

            $product = TxnProduct::where('slug_url', $id)->with(['category', 'images', 'custom_fields', 'side_product'])->firstOrFail();
            $brands = TxnBrand::where('status', true)->get();
            $sizes = MstSize::where('status', true)->get();
            $colors = MstColor::where('status', true)->get();
            $materials = TxnMaterial::where('status', true)->get();
            $units = TxnWeight::where('status', true)->get();
            $conditions = TxnCondition::where('status', true)->get();
            $gsts = TxnMasterGst::where('status', true)->get();
            $categories = TxnCategory::where('status', true)->get();
            $allkeywords = TxnKeyword::where('product_id', $product->id)->get();
            $warranties = MasterWarranty::where('status', true)->get();
            $keywords = $allkeywords->implode('keyword', ',');

            return view('backend.admin.products.edit', compact('product', 'brands', 'sizes', 'colors', 'materials', 'units', 'conditions', 'gsts', 'keywords', 'categories', 'warranties'));
        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Product Not Found');
            }
            Log::error(['Product Edit' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
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
        $request->validate(
            [
                'title' => 'required|string',
                'image_url' => 'nullable|image|max:1024|mimes:jpeg,png',
                'description' => 'required|string',
                'brand_id' => 'required|integer|exists:txn_brands,id',
                'color_id' => 'nullable|integer|exists:txn_colors,id',
                'material_id' => 'nullable|integer|exists:txn_materials,id',
                'weight_id' => 'nullable|integer|exists:txn_weights,id',
                'condition_id' => 'required|integer|exists:txn_conditions,id',
                'gst_id' => 'required|integer|exists:txn_master_gsts,id',
                'category_id' => 'required|integer|exists:txn_categories,id',
                'expiry_date' => 'nullable|date_format:Y-m-d',
                'starting_price' => 'required|numeric|min:1',
                'buy_it_now_price' => 'required|numeric|min:1',
                'reserve_price' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
                'length' => 'nullable|string|max:191',
                'breadth' => 'nullable|string|max:191',
                'height' => 'nullable|string|max:191',
                'weight' => 'nullable|string|max:191',
                'stock' => 'required|numeric|min:0',
                'keywords' => 'required|string',
                'warranty_id' => 'required|integer|exists:master_warranties,id',
                'is_cod' => 'required|numeric|max:1',
            ],
            [
                'title.required' => 'Please Enter Product Name',
                'image_url.image' => 'Please Choose Proper Image',
                'image_url.mimes' => 'Please Choose Image of type JPG & PNG Only',
                'image_url.max' => 'Please Choose Image of Maximum Size 1MB Only',
                'brand_id.required' => 'Please Select Brand',
                'brand_id.exists' => 'Brand Not Exists',
                'weight_id.exists' => 'Unit Not Exists',
                'color_id.exists' => 'Color Not Exists',
                'material_id.exists' => 'Material Not Exists',
                'condition_id.required' => 'Please Select Condition',
                'condition_id.exists' => 'Condition Not Exists',
                'category_id.required' => 'Please Select Category',
                'category_id.exists' => 'Category Not Exists',
                'gst_id.required' => 'Please Select GST',
                'gst_id.exists' => 'GST Not Exists',
                'expiry_date.required' => 'Please Select Expiry Date',
                'expiry_date.date_format' => 'Please Enter date in DD-MM-YYYY format',
                'starting_price.required' => 'Please Enter Starting Price',
                'buy_it_now_price.required' => 'Please Enter Buying Price',
                'reserve_price.required' => 'Please Enter Reserve Price',
                'keywords.required' => 'Please Enter Atleast One Keyword of the Product',
                'stock.required' => 'Please Enter Stock',
                'stock.numeric' => 'Invalid data provided for stock',
                'stock.min' => 'Stock Should not be less than 0',
                'warranty_id.required' => 'Please Select Warranty',
                'warranty_id.exists' => 'Warranty Not Exists',
                'is_cod.required' => 'Please Select Cod Availability',
                'is_cod.min' => 'Invalid data provided in cod availability',
            ]
        );

        try {

            $product = TxnProduct::where('slug_url', $id)->firstOrFail();

            if ($request->hasFile('image_url')) {

                $old_image = public_path('/storage/images/products/' . $product->image_url);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $request->image_url->storeAs('public/images/products', $product->image_url);
            }

            $product->update([
                'title' => $request->title,
                'brand_id' => $request->brand_id,
                'color_id' => $request->color_id,
                'material_id' => $request->material_id,
                'weight_unit' => $request->weight_id,
                'condition_id' => $request->condition_id,
                'category_id' => $request->category_id,
                'gst' => $request->gst_id,
                'description' => $request->description,
                'starting_price' => $request->starting_price,
                'buy_it_now_price' => $request->buy_it_now_price,
                'reserve_price' => $request->reserve_price,
                'mrp' => $request->mrp,
                'length' => $request->length,
                'breadth' => $request->breadth,
                'height' => $request->height,
                'weight' => $request->weight,
                'width' => $request->width,
                'stock' => $request->stock,
                'upc' => $request->upc,
                'expiry_date' => $request->expiry_date,
                'status' => $request->status,
                'warranty_id' => $request->warranty_id,
                'gst_value' => $request->gst_amount,
                'isCodAvailable' => $request->is_cod,
                'within_days' => $request->within_days,
                'wrong_products' => $request->wrong_products,
                'faulty_products' => $request->faulty_products,
                'quality_issue' => $request->quality_issue,
            ]);

            $product->update([
                'slug_url' => Str::slug($request->title, '-'),
            ]);

            if ($request->filled('keywords')) {

                DB::table('txn_keywords')->where('product_id', $product->id)->delete();
                $keywords = explode(',', $request->keywords);

                foreach ($keywords as $keyword) {
                    TxnKeyword::create([
                        'keyword' => trim($keyword, ' '),
                        'product_id' => $product->id,
                    ]);
                }
            }

            if ($request->filled('section_id')) {

                DB::table('map_product_to_top_sections')->where('product_id', $product->id)->delete();

                MapProductToTopSection::create([
                    'section_id' => $request->section_id,
                    'product_id' => $product->id,
                ]);
            }

            if ($request->filled('side_product')) {

                $side_product = SideProduct::where('product_id', $product->id)->first();

                if ($side_product && $side_product->product_id == $product->id) {

                    $side_product->delete();
                }

                SideProduct::updateOrCreate(
                    [
                        'sort_index' => $request->side_product,
                    ],
                    [
                        'product_id' => $product->id,
                        'sort_index' => $request->side_product,
                    ]
                );
            }

            return redirect(route('admin.products.all'))->with('messageSuccess', 'Product has been updated Successfully !');
        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Product Not Found');
            }
            \Log::error(['Product Update' => $ex->getMessage()]);
            // return redirect(route('admin.products.edit', $id))->with('messageDanger', 'Error, ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
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
        try {
            $product = TxnProduct::where('id', $id)->firstOrFail();

            $old_image = public_path('/storage/images/products/' . $product->image_url);

            if (File::exists($old_image)) {
                File::delete($old_image);
            }

            $product->delete();

            return redirect(route('admin.products.all'))->with('messageSuccess', 'Product has been deleted Successfully !');
        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Product Not Found');
            }
            \Log::error(['Product Delete' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
        }
    }

    public function addImages(Request $request, $id)
    {
        $request->validate(
            [
                'image_urls' => 'required|array',
                'image_urls.*' => 'image|max:1024|mimes:jpeg,png',
            ],
            [
                'image_urls.*.required' => 'Please Choose Atleast One Image',
                'image_urls.*.image' => 'Please Choose Proper Multiple Image',
                'image_url.*.mimes' => 'Please Choose Multiple Image of type JPG & PNG Only',
                'image_url.*.max' => 'Please Choose Multiple Image of Maximum Size 1MB Only',
            ]
        );

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            foreach ($request->image_urls as $images) {
                $request['image'] = uniqid() . '.' . pathinfo($images->getClientOriginalName(), PATHINFO_EXTENSION);
                $images->storeAs('public/images/multi-products', $request->image);

                TxnImage::create([
                    'product_id' => $product->id,
                    'image_url' => $request->image,
                ]);
            }

            return redirect(route('admin.products.edit', $product->slug_url))->with('messageSuccess', 'Data has been added Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find product with that id !');
            }
            \Log::error(['Product Add Images' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
        }
    }

    public function deleteImage($id)
    {
        try {

            $image = TxnImage::where('id', $id)->with('product')->firstOrFail();

            $old_image = public_path('/storage/images/multi-products/' . $image->image_url);

            if (File::exists($old_image)) {
                File::delete($old_image);
            }

            $image->delete();

            return redirect(route('admin.products.edit', $image->product->slug_url))->with('messageSuccess', 'Image has been Deleted Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find product with that id !');
            }
            \Log::error(['Product Delete Image' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
        }
    }

    public function addCustomField(Request $request, $id)
    {
        $request->validate(
            [
                'field_name' => 'required|string|max:191',
                'field_value' => 'required|string|max:191',
            ],
            [
                'field_name.required' => 'Please Enter Field Name',
                'field_value.required' => 'Please Enter Field Value',
            ]
        );

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            TxnCustomField::create([
                'field_name' => $request->field_name,
                'field_value' => $request->field_value,
                'product_id' => $product->id,
            ]);

            return redirect(route('admin.products.edit', $product->slug_url))->with('messageSuccess', 'Data has been added Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find product with that id !');
            }
            \Log::error(['Product Custom Fields' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
        }
    }

    public function updateCustomField(Request $request, $id)
    {
        $request->validate(
            [
                'field_name' => 'required|string|max:191',
                'field_value' => 'required|string|max:191',
            ],
            [
                'field_name.required' => 'Please Enter Field Name',
                'field_value.required' => 'Please Enter Field Value',
            ]
        );

        try {

            $field = TxnCustomField::where('id', $id)->with('product')->firstOrFail();
            $field->update([
                'field_name' => $request->field_name,
                'field_value' => $request->field_value,
            ]);

            return redirect(route('admin.products.edit', $field->product->slug_url))->with('messageSuccess', 'Custom Field Updated Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find Field with that id !');
            }
            \Log::error(['Product Update Custom Fields' => $ex->getMessage()]);
            // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
            return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
        }
    }

    public function destroyCustomField($id)
    {
        try {

            $field = TxnCustomField::where('id', $id)->with('product')->firstOrFail();
            $field->delete();
            return redirect(route('admin.products.edit', $field->product->slug_url))->with('messageSuccess', 'Custom Field Deleted Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find Field !');
            } else {
                \Log::error(['Product Delete Custom field' => $ex->getMessage()]);
                // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate(
            [
                'stock' => 'required|numeric|min:0',
            ],
            [
                'stock.required' => 'Please Enter Stock',
                'stock.numeric' => 'Please Enter Stock in digits only',
                'stock.min' => 'Stock should be atleast 0',
            ]
        );
        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();
            $product->update([
                'stock' => $request->stock,
            ]);

            return redirect(route('admin.products.all'))->with('messageSuccess', 'Stock has been updated Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find Product !');
            } else {
                \Log::error(['Product Update stock' => $ex->getMessage()]);
                // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
            }
        }
    }

    public function updatePrice(Request $request, $id)
    {
        $request->validate(
            [
                'gst_id' => 'required|integer|exists:txn_master_gsts,id',
                'expiry_date' => 'nullable|date_format:Y-m-d',
                'starting_price' => 'required|numeric|min:1',
                'buy_it_now_price' => 'required|numeric|min:1',
                'reserve_price' => 'required|numeric|min:1',
                'mrp' => 'required|numeric|min:1',
            ],
            [
                'gst_id.required' => 'Please Select GST',
                'gst_id.exists' => 'GST Not Exists',
                'expiry_date.date_format' => 'Please Enter date in DD-MM-YYYY format',
                'starting_price.required' => 'Please Select Starting Price',
                'buy_it_now_price.required' => 'Please Select Buying Price',
                'reserve_price.required' => 'Please Select Reserve Price',
                'mrp.required' => 'Please Select MRP',
            ]
        );
        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();
            $product->update([
                'gst' => $request->gst_id,
                'starting_price' => $request->starting_price,
                'buy_it_now_price' => $request->buy_it_now_price,
                'reserve_price' => $request->reserve_price,
                'mrp' => $request->mrp,
                'gst_value' => $request->gst_amount,
            ]);

            return redirect(route('admin.products.all'))->with('messageSuccess', 'Price has been updated Successfully !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.products.all'))->with('messageDanger', 'We can\'t find Product !');
            } else {
                \Log::error(['Product Update Price' => $ex->getMessage()]);
                // return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops ! ' . $ex->getMessage());
                return redirect(route('admin.products.all'))->with('messageDanger', 'Whoops, Something Went Wrong, try again later');
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
                'answer' => 'required|string',
                'status' => 'required|numeric|max:1',
            ],
            [
                'question.required' => 'Please Enter Question',
                'answer.required' => 'Please Enter Answer',
                'status.required' => 'Please Select Status',
                'status.numeric' => 'Invalid Status Given',
                'status.max' => 'Invalid Status Given',
            ]
        );

        try {

            $faq = ProductFaq::where('id', $id)->with('product')->firstOrFail();

            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'status' => $request->status,
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
}
