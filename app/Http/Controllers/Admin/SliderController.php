<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('sort_index')->where('status', true)->paginate(50);
        return view('backend.admin.sliders.index', compact('sliders'));
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
            'image_url'   => 'required|image|mimes:jpg,jpeg,png|max:1024',
            'sort_index'  => 'required|integer',
            'title'       => 'nullable|string|max:191',
            'subtitle'    => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'url'         => 'nullable|url|max:191',
        ],
            [
                'image_url.max'       => 'Please Choose image of Maximum 1MB Size..',
                'image_url.required'  => 'Please Choose Atleast One Image',
                'image_url.image'     => 'Please Choose Only Image',
                'sort_index.required' => 'Please Enter Slider Position',
                'url.url'             => 'Please Enter Proper Url',
            ]);

        if ($request->hasFile('image_url')) {
            $request['img'] = uniqid() . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION);
            $request->image_url->storeAs('public/images/sliders', $request->img);
        }

        Slider::create([
            'image_url'   => $request->img,
            'sort_index'  => $request->sort_index,
            'status'      => true,
            'title'       => $request->title,
            'url'         => $request->url,
            'subtitle'    => $request->subtitle,
            'description' => $request->description,
        ]);

        return redirect(route('admin.sliders.all'))->with('messageSuccess', 'New Slider has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider)
    {
        try {
            $slider = Slider::where('id', $slider)->firstOrFail();
            return view('backend.admin.sliders.edit', compact('slider'));

        } catch (\Exception $ex) {
            return redirect(route('admin.sliders.all'))->with('messageDanger', 'Whoops, Slider Not Found !');
        }

        return redirect(route('admin.sliders.all'))->with('messageDanger', 'Error , ' . $ex->getMessage());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image_url'   => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'sort_index'  => 'required|integer',
            'title'       => 'nullable|string|max:191',
            'subtitle'    => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'url'         => 'nullable|url|max:191',
        ],
            [
                'image_url.image'     => 'Please Choose Only image..',
                'image_url.mimes'     => 'Please Choose Only image of type JPG,JPEG,PNG..',
                'image_url.max'       => 'Please Choose Only image of Maximum 1MB Size..',
                'sort_index.required' => 'Please Enter Sort Index',
                'url.url'             => 'Please Enter Proper Url',
            ]);

        if ($request->hasFile('image_url')) {
            $old_image = "/storage/images/sliders/" . $slider->image_url;
            Storage::delete($old_image);
            $request->image_url->storeAs('public/images/sliders', $slider->image_url);

        }

        $slider->update([
            'status'      => $request->status,
            'sort_index'  => $request->sort_index,
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'url'         => $request->url,
            'description' => $request->description,
        ]);

        return redirect(route('admin.sliders.edit', $slider->id))->with('messageSuccess', 'Slider has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $old_image = public_path("/storage/images/sliders/" . $slider->image_url);
        if (File::exists($old_image)) {
            File::delete($old_image);
        }

        $slider->delete();
        return redirect(route('admin.sliders.all'))->with('messageSuccess', 'Slider Image has been Deleted successfully !');
    }

}
