<?php

namespace App\Http\Controllers;

use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'p_id' => 'required|exists:txn_products,id',
            'c_id' => 'required|exists:mst_colors,id',
            's_id' => 'required|exists:mst_sizes,id',
        ],
            [
                'p_id.required' => 'Product Not Available',
                'p_id.exists' => 'Product Not Exists',
                'c_id.required' => 'Colour Not Available',
                'c_id.exists' => 'Colour Not Exists',
                's_id.required' => 'size Not Available',
                's_id.exists' => 'size Not Exists',
            ]);

        if ($validator->fails()) {
            connectify('error', 'Wishlist Error', $validator->errors()->first());
            return back()->withInput();
        }

        if (auth('user')->check()) {
            
        }

        Wishlist::create([
            'product_id' => $request->p_id,
            'color_id' => $request->c_id,
            'size_id' => $request->s_id,
            'user_id' => $request->u_id,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
