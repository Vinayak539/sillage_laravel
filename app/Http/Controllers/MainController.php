<?php

namespace App\Http\Controllers;

use App\Model\Delivery;
use App\Model\HomeOfferSlider;
use App\Model\MapColorSize;
use App\Model\MsSection;
use App\Model\ProductFaq;
use App\Model\Shop;
use App\Model\Slider;
use App\Model\Subscriber;
use App\Model\Testimonial;
use App\Model\TxnCategory;
use App\Model\TxnCondition;
use App\Model\TxnImage;
use App\Model\TxnProduct;
use App\Model\TxnUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        $sliders          = Slider::where('status', true)->orderBy('sort_index')->get();
        $testimonials     = Testimonial::where('status', true)->orderBy('sort_index')->get();
        $homeOfferSliders = HomeOfferSlider::where('status', true)->orderBy('sort_index')->get();
        // $side_products = SideProduct::with('product')->orderBy('sort_index')->limit(2)->get();
        $sections = MsSection::where('status', true)->with('msections')->get();
        // dd($sections);
        return view('frontend.index', compact('sliders', 'sections', 'testimonials', 'homeOfferSliders'));
        // return view('frontend.index', compact('sliders', 'testimonials', 'sections', 'side_products'));
    }

    public function subscribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'EMAIL' => 'required|email|unique:subscribers,email',
        ],
            [
                'EMAIL.required' => 'Please Enter Email ID',
                'EMAIL.email' => 'Please Enter Proper Email',
                'EMAIL.unique' => 'You have Already been Subscribed with us !',
            ]
        );

        if ($validator->fails()) {
            connectify('error', 'Error', $validator->errors()->first());
            return back()->withInput();
        }

        Subscriber::create([
            'email' => $request->EMAIL,
            'status' => true,
        ]);

        connectify('success', 'Subscribed', 'Thank you for Subscribing with us !');

        return back();
    }

    public function getProduct($slug)
    {

        try {
            // sizes remove
            $product = TxnProduct::where('status', true)->where('slug_url', $slug)->with(['images', 'condition', 'sizes', 'colors', 'category', 'warranty', 'reviews' => function ($q) {
                $q->where('status', true)->get();
            }])->firstOrFail();

            // dd($product->sizes);

            $prod = DB::table('txn_products as p')
                ->select(DB::raw('FLOOR(AVG(txn_reviews.rating)) as rating , COUNT(txn_reviews.id) as total_rating'))
                ->leftJoin("txn_reviews", "txn_reviews.product_id", "p.id")
                ->where('p.id', $product->id)
                ->where('txn_reviews.status', true)
                ->first();

            $colorsSizes = DB::table('map_color_sizes as m')
                ->selectRaw('DISTINCT(c.title) as color_name, s.title as size_name, c.id as color_id, s.id as size_id, m.mrp, m.stock, m.starting_price, m.id as map_id')
                ->join('mst_colors as c', 'm.color_id', 'c.id')
                ->join('mst_sizes as s', 'm.size_id', 's.id')
                ->where('m.product_id', $product->id)
                ->groupBy('c.id')
                ->get();

            $related_products = \DB::table('txn_products as p')
                ->selectRaw("p.id as product_id , p.title , p.slug_url, p.image_url, p.image_url1, p.status , FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment, c.name as category_name, c.slug_url as category_url")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "c.id", "p.category_id")
                ->where('p.status', true)
                ->where('p.id', '<>', $product->id)
                ->orWhere('c.id', $product->category_id)
                ->orderBy('p.id', 'DESC')
                ->limit(6)
                ->get();

            $offers = DB::table('txn_products as p')
                ->selectRaw('p.title as product_name, p.id as product_id, p.image_url, m.color_id, m.size_id, c.title as color_name, s.title as size_name, m.id as offer_id, mop.purchase_quantity, mop.offered_quantity, mop.id as map_id, mop.map_offer_id')
                ->join("map_mst_offer_products as m", "m.offer_product_id", "p.id")
                ->join("mst_colors as c", "m.color_id", "c.id")
                ->join("mst_sizes as s", "m.size_id", "s.id")
                ->join("map_offer_products as mop", "mop.map_offer_id", "m.offer_id")
                ->groupBy('m.offer_product_id', 'm.color_id', 'm.size_id')
                ->where('mop.product_id', $product->id)
                ->get();


            return view('frontend.product.show', compact('product', 'related_products', 'prod', 'colorsSizes', 'offers'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Product Not Found !');

                return redirect('/');
            }

            return $ex->getMessage();

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our End !');

            return redirect('/');
        }
    }

    public function getSizes(Request $request)
    {

        $results = MapColorSize::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();

        // $results = DB::table('map_color_sizes as m')
        //     ->selectRaw('c.title as color_name, GROUP_CONCAT(s.title) as size_name, c.id as color_id, GROUP_CONCAT(s.id) as size_id, m.mrp, m.stock, m.id as map_id')
        //     ->join('mst_colors as c', 'm.color_id', 'c.id')
        //     ->join('mst_sizes as s', 'm.size_id', 's.id')
        //     ->where('m.product_id', $request->product_id)
        //     ->where('m.color_id', $request->color_id)
        //     ->orderBy('m.id', 'DESC')
        //     ->groupBy('c.id')
        //     ->get();

        $color_images = TxnImage::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();

        if ($results) {
            return response()->json(['success' => $results, 'color_images' => $color_images]);
        }
        return response()->json(['error' => []]);
    }

    public function verifyPincode(Request $request)
    {
        $res  = Delivery::verify($request->pincode);
        $res1 = json_decode($res, true);
        if (count($res1['delivery_codes'])) {
            session(['pincode' => $request->pincode]);
            return response()->json(['success' => 'Delivery Available at ' . $request->pincode]);
        }
        return response()->json(['error' => 'Delivery Not Available at ' . $request->pincode]);
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.image_url, p.image_url1, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->where('p.status', '=', true)
                ->where('k.keyword', 'like', '%' . $request->q . '%');
        } else {

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.image_url, p.image_url1, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->where('p.status', '=', true);
        }

        $products  = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(50);
        $prodLists = [];

        foreach ($products as $prod) {
            array_push($prodLists, $prod->id);
        }

        $brands = \DB::table('txn_products as p')
            ->selectRaw("Distinct(b.id) as id, b.brand_name")
            ->leftJoin("txn_brands as b", "p.brand_id", "b.id")
            ->where('p.status', true)
            ->whereIN('p.id', $prodLists);

        $brands = $brands->groupBy("p.id")->get();

        $conditions = TxnCondition::where('status', true)->get();
        return view('frontend.product.index', compact('products', 'brands', 'conditions'))->with('input', $request);
    }

    public function filter(Request $request)
    {

        $products = \DB::table('txn_products as p')
            ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp, p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
            ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
            ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
            ->where('p.stock', '>', 0)
            ->where('p.status', '=', true);

        if ($request->filled('brands') && gettype($request->brands) == 'array') {
            $products = $products->whereIn('p.brand_id', $request->brands);
        }

        if ($request->filled('conditions') && gettype($request->conditions) == 'array') {
            $products = $products->whereIn('p.condition_id', $request->conditions);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(20);

        return response()->json(['products' => $products], 200);
    }

    public function cateFilter(Request $request)
    {

        $category = TxnCategory::where('id', $request->category_id)->where('status', true)->firstOrFail();

        $categories = DB::select(DB::raw("select  id
            from    (select * from txn_categories
                     order by parent_id, id) txn_categories,
                    (select @pv := $category->id) initialisation
            where   find_in_set(parent_id, @pv) > 0
            and     @pv := concat(@pv, ',', id)"));

        $cateLists    = [];
        $cateLists[0] = $category->id;

        foreach ($categories as $cate) {
            array_push($cateLists, $cate->id);
        }

        $products = \DB::table('txn_products as p')
            ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp, p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
            ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
            ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
            ->where('p.status', '=', true)
            ->where('p.stock', '>', 0)
            ->whereIN('p.category_id', $cateLists);

        if ($request->filled('brands') && gettype($request->brands) == 'array') {
            $products = $products->whereIn('p.brand_id', $request->brands);
        }

        if ($request->filled('conditions') && gettype($request->conditions) == 'array') {
            $products = $products->whereIn('p.condition_id', $request->conditions);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(20);

        return response()->json(['products' => $products], 200);
    }

    public function getCategoryProducts(Request $request, $slug)
    {
        try {

            $category = TxnCategory::where('slug_url', $slug)->where('status', true)->firstOrFail();

            $categories = DB::select(DB::raw("select  id
            from    (select * from txn_categories
                     order by parent_id, id) txn_categories,
                    (select @pv := $category->id) initialisation
            where   find_in_set(parent_id, @pv) > 0
            and     @pv := concat(@pv, ',', id)"));

            $cateLists    = [];
            $cateLists[0] = $category->id;

            foreach ($categories as $cate) {
                array_push($cateLists, $cate->id);
            }

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url, p.image_url, p.image_url1, p.category_id ,c.parent_id, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "p.category_id", "c.id")
                ->where('p.status', true)
                ->whereIN('p.category_id', $cateLists)
                ->groupBy("p.id")
                ->paginate(50);

            $brands = \DB::table('txn_products as p')
                ->selectRaw("Distinct(b.id) as id, b.brand_name")
                ->leftJoin("txn_brands as b", "p.brand_id", "b.id")
                ->where('p.status', true)
                ->whereIN('p.category_id', $cateLists)
                ->groupBy("p.id")
                ->get();

            $conditions = TxnCondition::where('status', true)->get();

            return view('frontend.product.cate-products', compact('products', 'category', 'brands', 'conditions'))->with('input', $request);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Category Not Found !');

                return redirect('/');
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our End  !');

            return redirect('/');
        }
    }

    public function askQuestion(Request $request, $id)
    {
        $request->validate(
            [
                'question' => 'required|string',
            ],
            [
                'question.required' => 'Please Enter your question',
            ]
        );

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            $qna = ProductFaq::create([
                'question'   => $request->question,
                'product_id' => $product->id,
                'status'     => false,
            ]);

            Mail::send(['html' => 'backend.mails.question'], ['qna' => $qna, 'product' => $product], function ($message) {
                $message->from('support@thehatkestore.com', 'The Hatke Store');
                $message->to('support@thehatkestore.com', 'The Hatke Store');
                $message->subject('The Hatke Store - Someone ask question');
            });

            return redirect(route('product', $product->slug_url))->with('messageSuccess1', 'Your question has been submitted successfully ! we\'ll answer your question soon !');

        } catch (\Exception $ex) {

            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                connectify('error', 'Error', 'Whoops, Category Not Found !');

                return back();
            }

            connectify('error', 'Error', 'Whoops, Something Went Wrong from our End !');

            return back();
        }
    }

    public function verifyPromocode(Request $request)
    {
        $promo = [];
        if ($request->filled('promocode')) {
            $promo = TxnUser::select('promocode')->where('elite', true)->where('promocode', $request->promocode)->first();
        } elseif ($request->filled('discountcode')) {
            $promo = Shop::select('shop_code')->where('shop_code', strtolower($request->discountcode))->first();
        }
        if (!empty($promo)) {
            session(['promocode' => $promo]);
            return response()->json(['success' => 'Promocode Applied Successfully !', 'status' => 200], 200);
        }
        return response()->json(['error' => 'Please Enter Valid Promocode', 'status' => 200], 200);
    }

}
