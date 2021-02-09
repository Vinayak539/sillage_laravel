<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Page;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('heading', 'asc')->paginate(10);
        return view('backend.admin.pages.index', compact('pages'));
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $validator = Validator::make($request->all(),
                [
                    'heading' => 'required|string',
                    'type' => 'required',
                    'description' => 'required',
                    'sort_index' => 'required',
                ]
            );

            if($validator->fails()){
                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }

            $page = new Page;

            $page->heading = $request->heading;

            $page->description = $request->description;

            $page->type = $request->type;

            $page->sort_index = $request->sort_index;

            $page->status = true;

            $page->save();

            DB::commit();

            connectify('success', 'Success', 'Added Page ' . $page->heading . ' Successfully');

            return redirect(route('admin.pages.all'));
        }catch(Exception $e){

            DB::rollback();

            connectify('error', 'Error', $e->getMessage());

            return back();
        }
    }

    public function edit($id)
    {
        try{
            $page = Page::where('id', $id)->firstOrFail();
            return view('backend.admin.pages.edit', compact('page'));
        }catch(Exception $e){

            connectify('error', 'Error', $e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();
            $validator = Validator::make($request->all(),
                [
                    'heading' => 'required|string',
                    'type' => 'required',
                    'description' => 'required',
                    'sort_index' => 'required',
                ]
            );

            if($validator->fails()){
                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }

            $page = Page::find($id);

            if(!$page){
                throw new Exception('No Data Found!!!!');
            }

            $page->heading = $request->heading;

            $page->description = $request->description;

            $page->type = $request->type;

            $page->sort_index = $request->sort_index;

            $page->status = $request->status;

            $page->save();

            DB::commit();

            connectify('success', 'Success', 'Updated Page ' . $page->heading . ' Successfully');

            return back();
        }catch(Exception $e){

            DB::rollback();

            connectify('error', 'Error', $e->getMessage());

            return back();
        }
    }

    public function delete(Request $request)
    {
        try{
            DB::beginTransaction();

            $page = Page::where('id', $request->page_id)->firstOrFail();

            $page->delete();

            DB::commit();
            
            connectify('success', 'Success', 'Deleted Page Successfully!!');
            return back();
        }catch(Exception $e){
            DB::rollback();

            connectify('error', 'Error', $e->getMessage());

            return back();
        }
    }
}
