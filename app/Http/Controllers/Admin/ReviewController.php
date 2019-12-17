<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Review;
use App\Model\TxnProduct;
use App\Model\TxnReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews  = TxnReview::orderBy('id', 'DESC')->with('product')->paginate(50);
        $products = TxnProduct::where('status', true)->orderBy('id', 'DESC')->get();
        return view('backend.admin.reviews.index', compact('reviews', 'products'));
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
            'name'        => 'required|string|max:191',
            'product_id'  => 'required|integer|exists:txn_products,id',
            'review_date' => 'required|date_format:Y-m-d',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'required|string|max:255',
        ],
            [
                'name.required'           => 'Please Enter Customer Name',
                'product_id.required'     => 'Please Select Product to Rate',
                'product_id.exists'       => 'Selected Product does Not exists',
                'review_date.required'    => 'Please Enter Review Date',
                'review_date.date_format' => 'Please Enter Review date in YYYY-MM-DD format ',
                'rating.required'         => 'Please Enter Rating',
                'rating.integer'          => 'Please Enter Numeric only',
                'rating.min'              => 'Please Select Min 1 Rating',
                'rating.max'              => 'Please Select Max 5 Rating',
                'comment.required'        => 'Please Enter Your Review',
            ]);
            
        $request['email'] = 'admin@ranayas.com';   

        TxnReview::updateOrCreate([
            'product_id' => $request->product_id,
            'email'      => $request->email,
            'name'      => $request->name,
        ], [
            'name'       => $request->name,
            'email'      => $request->email,
            'product_id' => $request->product_id,
            'created_at' => date('Y-m-d', strtotime($request->review_date)),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            'status'     => true,
        ]);

        return redirect(route('admin.reviews.all'))->with('messageSuccess', 'Review has been Updated successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $review   = TxnReview::where('id', $id)->firstOrFail();
            $products = TxnProduct::where('status', true)->orderBy('id', 'DESC')->get();
            return view('backend.admin.reviews.edit', compact('review', 'products'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.reviews.all'))->with('messageDanger', 'Whoops, Review Not Found !');
            }
            return redirect(route('admin.reviews.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:191',
            'status'      => 'required',
            'product_id'  => 'required|integer|exists:txn_products,id',
            'review_date' => 'required|date_format:Y-m-d',
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'required|string|max:255',
        ],
            [
                'name.required'           => 'Please Enter Customer Name',
                'status.required'         => 'Please Select Status',
                'product_id.required'     => 'Please Select Product to Rate',
                'product_id.exists'       => 'Selected Product does Not exists',
                'review_date.required'    => 'Please Enter Review Date',
                'review_date.date_format' => 'Please Enter Review date in YYYY-mm-dd format ',
                'rating.required'         => 'Please Enter Rating',
                'rating.integer'          => 'Please Enter Numeric only',
                'rating.min'              => 'Please Select Min 1 Rating',
                'rating.max'              => 'Please Select Max 5 Rating',
                'comment.required'        => 'Please Enter Your Review',
            ]);

        try {

            $review = TxnReview::where('id', $id)->firstOrFail();

            $review->update([
                'name'       => $request->name,
                'product_id' => $request->product_id,
                'created_at' => date('Y-m-d', strtotime($request->review_date)),
                'rating'     => $request->rating,
                'comment'    => $request->comment,
                'status'     => $request->status,
            ]);

            return redirect(route('admin.reviews.all'))->with('messageSuccess', 'Review has been Updated successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.reviews.all'))->with('messageDanger', 'Whoops, Review Not Found !');
            }
            return redirect(route('admin.reviews.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $review = TxnReview::where('id', $id)->firstOrFail();

            $review->delete();

            return redirect(route('admin.reviews.all'))->with('messageSuccess', 'Review has been deleted successfully !');

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect(route('admin.reviews.all'))->with('messageDanger', 'Whoops, Review Not Found !');
            }
            return redirect(route('admin.reviews.all'))->with('messageDanger', 'Error, ' . $ex->getMessage());
        }
    }
}
