<?php

namespace App\Http\Controllers\Admin;

use App\Model\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();
        return view('backend.admin.abouts.index', compact('about'));
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
        $request->validate([
            'description'       => 'required|string',
            'short_description' => 'required|string|max:500',
            'image_url1'        => 'nullable|image|max:1024|mimes:jpeg,png',
            'image_url2'        => 'nullable|image|max:1024|mimes:jpeg,png',
        ],
            [
                'description.required'       => 'Please Enter Description',
                'short_description.required' => 'Please Enter Short Description',
                'image_url1.max'             => 'Please Choose image of Maximum 1MB Size..',
                'image_url1.image'           => 'Please Choose Only Image',
                'image_url1.mimes'           => 'Please Choose Image of type JPG & PNG only',
                'image_url2.max'             => 'Please Choose image of Maximum 1MB Size..',
                'image_url2.image'           => 'Please Choose Only Image',
                'image_url2.mimes'           => 'Please Choose Image of type JPG & PNG only',
            ]);

        if ($request->hasFile('image_url1')) {

            $request['img1'] = uniqid() . '.' . pathinfo($request->image_url1->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url1->storeAs('public/images/abouts', $request->img1);

        }

        if ($request->hasFile('image_url2')) {

            $request['img2'] = uniqid() . '.' . pathinfo($request->image_url2->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url2->storeAs('public/images/abouts', $request->img2);

        }

        About::create([
            'description'       => $request->description,
            'short_description' => $request->short_description,
            'image_url1'        => $request->img1,
            'image_url2'        => $request->img2,
        ]);

        return redirect(route('admin.abouts.all'))->with('messageSuccess', 'Data has been Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description'       => 'required|string',
            'short_description' => 'required|string',
            'image_url1'        => 'nullable|image|max:1024|mimes:jpeg,png',
            'image_url2'        => 'nullable|image|max:1024|mimes:jpeg,png',
        ],
            [
                'description.required'       => 'Please Enter Description',
                'short_description.required' => 'Please Enter Short Description',
                'image_url1.max'             => 'Please Choose image of Maximum 1MB Size..',
                'image_url1.image'           => 'Please Choose Only Image',
                'image_url1.mimes'           => 'Please Choose Image of type JPG & PNG only',
                'image_url2.max'             => 'Please Choose image of Maximum 1MB Size..',
                'image_url2.image'           => 'Please Choose Only Image',
                'image_url2.mimes'           => 'Please Choose Image of type JPG & PNG only',
            ]);

        try {

            $about = About::where('id', $id)->firstOrFail();

            if ($request->hasFile('image_url1') && $about->image_url1 != null) {

                $old_image = '/storage/images/abouts/' . $about->image_url1;
                Storage::delete($old_image);
                $request->image_url1->storeAs('public/images/abouts', $about->image_url1);

            } elseif ($request->hasFile('image_url1') && $about->image_url1 == null) {

                $request['img1'] = uniqid() . '.' . pathinfo($request->image_url1->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->image_url1->storeAs('public/images/abouts', $request->img1);
                $about->update([
                    'image_url1' => $request->img1,
                ]);
            }

            if ($request->hasFile('image_url2') && $about->image_url2 != null) {

                $old_image = '/storage/images/abouts/' . $about->image_url2;
                Storage::delete($old_image);
                $request->image_url2->storeAs('public/images/abouts', $about->image_url2);

            } elseif ($request->hasFile('image_url2') && $about->image_url2 == null) {

                $request['img2'] = uniqid() . '.' . pathinfo($request->image_url2->getClientOriginalName(), PATHINFO_EXTENSION);
                $request->image_url2->storeAs('public/images/abouts', $request->img2);
                $about->update([
                    'image_url2' => $request->img2,
                ]);
            }

            $about->update([
                'description'       => $request->description,
                'short_description' => $request->short_description,
            ]);

            return redirect(route('admin.abouts.all'))->with('messageSuccess', 'Data has been Updated Successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.abouts.all'))->with('messageDanger', 'Whoops, Something Went Wrong !');
            }
            return redirect(route('admin.abouts.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::first();

        $old_image = public_path('/storage/images/abouts/' . $about->$id);

        if (File::exists($old_image)) {
            File::delete($old_image);
        }

        $about->update([
            $id => null,
        ]);

        return redirect(route('admin.abouts.all'))->with('messageSuccess', 'Data has been deleted Successfully !');
    }
}
