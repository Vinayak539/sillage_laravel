<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\MstColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MstColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = MstColor::paginate(50);
        return view('backend.admin.colors.index', compact('colors'));
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
            'title' => 'required|string|max:50|unique:mst_colors,title',
        ],
            [
                'title.required' => 'Please Enter Color',
                'title.max' => 'Please Enter Color in Maximum 50 Character',
                'title.unique' => $request->title . ' Colour Already Available',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Add Colour', $validator->errors()->first());
            return redirect(route('admin.colors.all'))->withInput();
        }

        MstColor::create([
            'title' => $request->title,
            'status' => true,
        ]);

        connectify('success', 'Colour Added', 'Colour has been added successfully !');

        return redirect(route('admin.colors.all'));
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

            $color = MstColor::where('id', $id)->firstOrFail();
            return view('backend.admin.colors.edit', compact('color'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Colour Updated', 'Whoops, Colour Not Found !');

                return redirect(route('admin.colors.all'));
            }

            Log::error(['Edit Colour' => $ex->getMessage()]);

            connectify('error', 'Colour Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.colors.all'));
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
                'title.required' => 'Please Enter Color',
                'title.max' => 'Please Enter Color in Maximum 50 Character',
                'status.required' => 'Please Enter Colour Status',
                'status.max' => 'Invalid Data Provided',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Colour Update', $validator->errors()->first());
            return redirect(route('admin.colors.edit', $id))->withInput();
        }

        try {

            $color = MstColor::where('id', $id)->firstOrFail();

            $color->update([
                'title' => $request->title,
                'status' => $request->status,
            ]);

            connectify('success', 'Colour Updated', 'Colour has been Updated successfully');

            return redirect(route('admin.colors.all'));

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Colour Updated', 'Whoops, Colour Not Found !');

                return redirect(route('admin.colors.all'));
            }

            Log::error(['Edit Colour' => $ex->getMessage()]);

            connectify('error', 'Colour Update', 'Whoops, Something Went Wrong from our end !');

            return redirect(route('admin.colors.all'));
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

            $color = MstColor::where('id', $id)->firstOrFail();
            $color->delete();
            return redirect(route('admin.colors.all'))->with('messageSuccess', 'Colour has been deleted successfully !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.colors.all'))->with('messageDanger', 'Whoops, Colour Not Found with id : ' . $id);
            }
            return redirect(route('admin.colors.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
