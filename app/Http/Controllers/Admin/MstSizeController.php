<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MstSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MstSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = MstSize::paginate(50);
        return view('backend.admin.sizes.index', compact('sizes'));
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
            'title' => 'required|string|max:50|unique:mst_sizes,title',
        ],
            [
                'title.required' => 'Please Enter size',
                'title.max' => 'Please Enter size in Maximum 50 Character',
                'title.unique' => $request->title . ' Size Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Size', $validator->errors()->first());
            return redirect(route('admin.sizes.all'))->withInput();
        }

        MstSize::create([
            'title' => $request->title,
            'status' => true,
        ]);

        connectify('success', 'Size Added', 'Size has been added successfully !');

        return redirect(route('admin.sizes.all'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $size = MstSize::where('id', $id)->firstOrFail();
            return view('backend.admin.sizes.edit', compact('size'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Size Updated', 'Whoops, Size Not Found !');

                return redirect(route('admin.sizes.all'));
            }

            Log::error(['Edit Size' => $ex->getMessage()]);

            connectify('error', 'Size Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sizes.all'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:50',
            'status' => 'required|integer|max:1',
        ],
            [
                'title.required' => 'Please Enter size',
                'title.max' => 'Please Enter size in Maximum 50 Character',
                'status.required' => 'Please Enter Size Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Size Update', $validator->errors()->first());
            return redirect(route('admin.sizes.edit', $id))->withInput();
        }

        try {

            $size = MstSize::where('id', $id)->firstOrFail();

            $size->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            connectify('success', 'Size Updated', 'Size has been Updated successfully');

            return redirect(route('admin.sizes.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Size Updated', 'Whoops, Size Not Found !');

                return redirect(route('admin.sizes.all'));
            }

            Log::error(['Edit Size' => $ex->getMessage()]);

            connectify('error', 'Size Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sizes.all'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $size = MstSize::where('id', $id)->firstOrFail();
            $size->delete();
            return redirect(route('admin.sizes.all'))->with('messageSuccess', 'Size has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Size Deleted', 'Whoops, Size Not Found !');

                return redirect(route('admin.sizes.all'));
            }

            Log::error(['Delete Size' => $ex->getMessage()]);

            connectify('error', 'Size Delete', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.sizes.all'));
        }
    }
}
