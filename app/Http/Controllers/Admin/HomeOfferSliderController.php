<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\HomeOfferSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeOfferSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeOfferSliders = HomeOfferSlider::orderBy('sort_index')->where('status', true)->paginate(50);
        return view('backend.admin.home-offer-sliders.index', compact('homeOfferSliders'));
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
            $request->image_url->storeAs('public/images/home-offer-sliders', $request->img);
        }

        HomeOfferSlider::create([
            'image_url'   => $request->img,
            'sort_index'  => $request->sort_index,
            'status'      => true,
            'title'       => $request->title,
            'url'         => $request->url,
        ]);

        return redirect(route('admin.home-offer-sliders.all'))->with('messageSuccess', 'New Slider has been added successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\HomeOfferSlider  $homeOfferSlider
     * @return \Illuminate\Http\Response
     */
    public function show(HomeOfferSlider $homeOfferSlider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\HomeOfferSlider  $homeOfferSlider
     * @return \Illuminate\Http\Response
     */
    public function edit($homeOfferSlider)
    {
        try {
            $homeOfferSlider = HomeOfferSlider::where('id', $homeOfferSlider)->firstOrFail();
            return view('backend.admin.home-offer-sliders.edit', compact('homeOfferSlider'));

        } catch (\Exception $ex) {
            return redirect(route('admin.home-offer-sliders.all'))->with('messageDanger', 'Whoops, Slider Not Found !');
        }

        return redirect(route('admin.home-offer-sliders.all'))->with('messageDanger', 'Error , ' . $ex->getMessage());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\HomeOfferSlider  $homeOfferSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeOfferSlider $homeOfferSlider)
    {
        $request->validate([
            'image_url'   => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'sort_index'  => 'required|integer',
            'title'       => 'nullable|string|max:191',
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
            $old_image = "/storage/images/home-offer-sliders/" . $homeOfferSlider->image_url;
            Storage::delete($old_image);
            $request->image_url->storeAs('public/images/home-offer-sliders', $homeOfferSlider->image_url);

        }

        $homeOfferSlider->update([
            'status'      => $request->status,
            'sort_index'  => $request->sort_index,
            'title'       => $request->title,
            'url'         => $request->url,
        ]);

        return redirect(route('admin.home-offer-sliders.edit', $homeOfferSlider->id))->with('messageSuccess', 'Slider has been updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\HomeOfferSlider  $homeOfferSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeOfferSlider $homeOfferSlider)
    {
        $old_image = public_path("/storage/images/home-offer-sliders/" . $homeOfferSlider->image_url);
        if (File::exists($old_image)) {
            File::delete($old_image);
        }

        $homeOfferSlider->delete();
        return redirect(route('admin.home-offer-sliders.all'))->with('messageSuccess', 'Slider Image has been Deleted successfully !');
    }
}
