<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\Blog;
use DB;
use Exception;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('title', 'asc')->paginate(10);
        return view('backend.admin.blogs.index', compact('blogs'));
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string',
                    'image' => 'required|mimes:png,jpeg,jpg',
                    'description' => 'required',
                ]
            );

            if($validator->fails()){
                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }

            if ($request->hasFile('image')) {

                $request['img'] = uniqid() . '.' . pathinfo($request->image->getClientOriginalName(), PATHINFO_EXTENSION);
              
                $request->image->storeAs('public/images/blogs', $request->img);

            }

            $blog = new Blog;

            $blog->title = $request->title;

            $blog->description = $request->description;

            $blog->image = $request->img;
            
            $blog->status = true;

            $blog->save();

            DB::commit();

            connectify('success', 'Success', 'Added Blog ' . $blog->title . ' Successfully');
            return back();
        }catch(Exception $e){
            DB::rollback();

            connectify('error', 'Error', $e->getMessage());
            return back();
        }
    }

    public function edit($id)
    {
        try{
            $blog = Blog::where('id', $id)->firstOrFail();
            return view('backend.admin.blogs.edit', compact('blog'));
        }catch(Exception $e){
            connectify('error', 'Error', $e->getMessage());
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(),
                [
                    'title' => 'required|string',
                    'image' => 'nullable|mimes:png,jpeg,jpg',
                    'description' => 'required',
                ]
            );

            if($validator->fails()){
                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }

            $blog = Blog::find($id);

            if(!$blog){
                throw new Exception('No Data Found!!!!');
            }

            if ($request->hasFile('image')) {
                $old_image = "/storage/images/blogs/" . $blog->image;

                Storage::delete($old_image);

                $request->image->storeAs('public/images/blogs', $blog->image);
            }

            $blog->title = $request->title;

            $blog->description = $request->description;

            $blog->status = $request->status;

            $blog->save();

            DB::commit();

            connectify('success', 'Success', 'Added Blog ' . $blog->title . ' Successfully');
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

            $blog = Blog::where('id', $request->blog_id)->firstOrFail();

            $blog->delete();

            DB::commit();

            connectify('success', 'Success', 'Deleted Blog Successfully!!');
            return back();
        }catch(Exception $e){
            DB::rollback();

            connectify('error', 'Error', $e->getMessage());
            return back();
        }
    }
}
