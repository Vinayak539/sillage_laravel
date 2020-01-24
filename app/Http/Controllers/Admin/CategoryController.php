<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TxnCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = TxnCategory::paginate(50);
        return view('backend.admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $txnCategory = TxnCategory::orderBy('parent_id')->get();

        $category = array(
            'categories' => array(),
            'parent_cats' => array(),
        );

        foreach ($txnCategory as $key => $value) {
            # code...
            $category['categories'][$value->id] = $value;
            //creates entry into parent_cats array. parent_cats array contains a list of all categories with children
            $category['parent_cats'][$value->parent_id][] = $value->id;
        }

        $dynamicCategory = $this->buildCategory(0, $category);
        // dd($dynamicCategory);
        return view('backend.admin.categories.create', compact('dynamicCategory'));
    }

    public function buildCategory($parent, $category)
    {
        $html = "";
        if (isset($category['parent_cats'][$parent])) {
            $html .= "<b class='collapsible'></b>";
            $html .= "<ul class='category_div content'>";
            foreach ($category['parent_cats'][$parent] as $cat_id) {
                if (!isset($category['parent_cats'][$cat_id])) {
                    $html .= "<li><strong data-parent-id='" . $category['categories'][$cat_id]['id'] . "' data-parent-name='" . $category['categories'][$cat_id]['name'] . "' class='addCategory badge badge-primary'>Add New</strong> in " . $category['categories'][$cat_id]['name'] . "</li>";

                }
                if (isset($category['parent_cats'][$cat_id])) {
                    $html .= "<li> <strong data-parent-id='" . $category['categories'][$cat_id]['id'] . "' data-parent-name='" . $category['categories'][$cat_id]['name'] . "' class='addCategory badge badge-primary'>Add New</strong> in " . $category['categories'][$cat_id]['name'];
                    $html .= $this->buildCategory($cat_id, $category);
                    $html .= "</li>";

                }
            }
            $html .= "</ul> \n";
        }
        return $html;
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
            'category_name' => 'required|string',
        ],
            [
                'category_name.required' => 'Please Enter Category Name',
                'category_name.unique' => $request->category_name . ' Category Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Category', $validator->errors()->first());
            return redirect(route('admin.categories.create'))
                ->withInput();
        }

        $request['txtCategoryID'] = $request->txtCategoryID == null ? '0' : $request->txtCategoryID;

        $cate = TxnCategory::where('id', $request->txtCategoryID)->first();

        if ($cate) {
            $request['slug_url'] = Str::slug($cate->name . '-' . $request->category_name . $cate->id, '-');
        } else {
            $request['slug_url'] = Str::slug($request->category_name. $cate->id, '-');
        }

        TxnCategory::create([
            'parent_id' => $request->txtCategoryID,
            'name' => $request->category_name,
            'status' => true,
            'slug_url' => $request->slug_url,
        ]);

        connectify('success', 'Added Category', 'Category has been added successfully');

        return redirect(route('admin.categories.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $category = TxnCategory::where('id', $id)->firstOrFail();
            $allCategories = TxnCategory::where('status', true)->get();
            return view('backend.admin.categories.edit', compact('category', 'allCategories'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Updated Category', 'Whoops, Category Not Found !');

                return redirect(route('admin.categories.all'));
            }

            Log::error(['Edit Category' => $ex->getMessage()]);

            connectify('error', 'Updated Category', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.categories.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'parent_id' => 'required|numeric',
        ],
            [
                'name.required' => 'Please Enter Category Name',
                'parent_id.required' => 'Please Enter Parent Category',
            ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'parent_id' => 'required|numeric',
        ],
            [
                'name.required' => 'Please Enter Category Name',
                'parent_id.required' => 'Please Enter Parent Category',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Update Category', $validator->errors()->first());
            return redirect(route('admin.categories.edit', $id))->withInput();
        }

        try {

            $category = TxnCategory::where('id', $id)->firstOrFail();

            if ($category) {
                $request['slug_url'] = Str::slug($category->name . '-' . $request->category_name . $category->id, '-');
            } else {
                $request['slug_url'] = Str::slug($request->category_name. $category->id, '-');
            }

            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
                'slug_url' => $request->slug_url,
            ]);

            connectify('success', 'Updated Category', 'Category has been Updated successfully');

            return redirect(route('admin.categories.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Updated Category', 'Whoops, Category Not Found !');

                return redirect(route('admin.categories.all'));
            }

            Log::error(['Update Category' => $ex->getMessage()]);

            connectify('error', 'Updated Category', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.categories.all'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $category = TxnCategory::where('id', $id)->firstOrFail();

            $category->delete();

            return redirect(route('admin.categories.all'))->with('messageSuccess', 'Category has been deleted Successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.categories.all'))->with('messageDanger', 'Whoops, Category Not Found with id : ' . $id);
            }
            return redirect(route('admin.categories.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    public function addCategory(Request $request)
    {

    }

    public function getCategory(Request $request)
    {
        $categories = TxnCategory::where('parent_id', $request->category_id)->get();
        if (count($categories)) {
            return response()->json(['success' => $categories], 200);
        }
        return response()->json(['error' => $categories], 200);
    }
}
