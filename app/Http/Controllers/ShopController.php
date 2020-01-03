<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Model\TxnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $shop = Shop::where('id', auth('shop')->user()->id)->first();
        return view('shopauth.index', compact('shop'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:191',
            'image_url' => 'nullable|image|mimes:jpeg,png|max:1024',
        ],
            [
                'name.required'   => 'Please Enter Shop Name',
                'image_url.image' => 'Please Select Proper Image',
                'image_url.mimes' => 'Please Select Image of JPEG & PNG Format only',
                'image_url.max'   => 'Please Select Image of Maximum size of 1 MB ',
            ]);

        try {
            $shop = Shop::where('id', auth('shop')->user()->id)->firstOrFail();

            if ($request->hasFile('image_url')) {

                $old_image = public_path("/storage/images/shops/" . $shop->image_url);

                if (File::exists($old_image)) {
                    File::delete($old_image);
                }

                $shop->update([
                    'image_url' => uniqid() . '.' . pathinfo($request->image_url->getClientOriginalName(), PATHINFO_EXTENSION),
                ]);

                $request->image_url->storeAs('public/images/shops', $shop->image_url);
            }

            $shop->update([
                'name' => strtolower($request->name),
            ]);

            connectify('success', 'Profile Updated', 'Your Profile has been Updated Successfully !');

            return redirect(route('shop.dashboard'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Shop Not Found !');

                return redirect(route('shop.login'));
            }

            connectify('error', 'Error', 'Whoops Something Went Wrong from our end !');

            return redirect(route('shop.dashboard'));
        }
    }

    public function getOrders()
    {
        $orders = TxnOrder::where('is_discount', true)->where('promocode', auth('shop')->user()->shop_code)->where('status', 'Delivered')->get();
        return view('shopauth.orders', compact('orders'));
    }
}
