<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Shop;
use App\Model\TxnOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
        $orders = TxnOrder::where('is_discount', true)->where('promocode', auth('shop')->user()->shop_code)->where('status', 'Delivered')->get();
        return view('shopauth.orders', compact('orders'));

    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:191',
            'image_url'    => 'nullable|image|mimes:jpeg,png|max:1024',
            'password'     => 'required_with:con_password|max:191',
            'con_password' => 'required_with:password|same:password|max:191',
        ],
            [
                'name.required'          => 'Please Enter Shop Name',
                'image_url.image'        => 'Please Select Proper Image',
                'image_url.mimes'        => 'Please Select Image of JPEG & PNG Format only',
                'image_url.max'          => 'Please Select Image of Maximum size of 1 MB ',
                'password.required_with' => 'Please Enter Password',
                'con_password.required_with' => 'Please Enter Confirm Password',
                'con_password.same'      => 'Please Enter Confirm Password same as password',
            ]);
        if ($validator->fails()) {
            connectify('error', 'Checkout Error', $validator->errors()->first());
            return redirect(route('shop.account'))->withInput();
        }

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

            if ($request->filled('password')) {
                $shop->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            $shop->update([
                'name' => strtolower($request->name),
            ]);

            connectify('success', 'Profile Updated', 'Your Profile has been Updated Successfully !');

            return redirect(route('shop.account'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Shop Not Found !');

                return redirect(route('shop.login'));
            }

            connectify('error', 'Error', 'Whoops Something Went Wrong from our end !');

            return redirect(route('shop.account'));
        }
    }

    public function getAccount()
    {
        $shop = Shop::where('id', auth('shop')->user()->id)->first();
        return view('shopauth.index', compact('shop'));
    }
}
