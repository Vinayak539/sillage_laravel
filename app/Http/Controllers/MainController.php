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
        // $sliders = Slider::where('status', true)->orderBy('sort_index')->get();
        // $testimonials = Testimonial::where('status', true)->orderBy('sort_index')->get();
        // $homeOfferSliders = HomeOfferSlider::where('status', true)->orderBy('sort_index')->get();
        // $sections = MsSection::where('status', true)->with('msections')->get();
        return view('frontend_new.index');
        // , compact('sliders', 'sections', 'testimonials', 'homeOfferSliders'));
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

            $product = TxnProduct::where('status', true)->where('slug_url', $slug)->with(['images', 'condition', 'sizes', 'unit', 'colors', 'category', 'warranty', 'reviews' => function ($q) {
                $q->where('status', true)->get();
            }])->firstOrFail();

            $prod = DB::table('txn_products as p')
                ->select(DB::raw('FLOOR(AVG(txn_reviews.rating)) as rating , COUNT(txn_reviews.id) as total_rating'))
                ->leftJoin("txn_reviews", "txn_reviews.product_id", "p.id")
                ->where('p.id', $product->id)
                ->where('txn_reviews.status', true)
                ->first();

            $colorsSizes = DB::table('map_color_sizes as m')
                ->selectRaw('DISTINCT(c.title) as color_name,c.color_code , s.title as size_name, c.id as color_id, s.id as size_id, m.mrp, m.stock, m.starting_price, m.id as map_id')
                ->join('mst_colors as c', 'm.color_id', 'c.id')
                ->join('mst_sizes as s', 'm.size_id', 's.id')
                ->where('m.product_id', $product->id)
                ->where('m.status', true)
                ->groupBy('c.id')
                ->orderBy('m.sort_index')
                ->get();

            $related_products = \DB::table('txn_products as p')
                ->selectRaw("p.id as product_id , p.title,w.id as w_id, w.user_id as w_u_id, w.product_id as w_product_id,map.color_id as c_id, map.size_id as s_id,  c.id as cate_id , p.slug_url, p.image_url,map.mrp, map.starting_price,GROUP_CONCAT(DISTINCT(co.color_code)) as color_codes, p.image_url1, p.status, p.review_status , FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment, c.name as category_name, c.slug_url as category_url")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("map_color_sizes as map", "map.product_id", "p.id")
                ->leftJoin("mst_colors as co", "co.id", "map.color_id")
                ->leftJoin("txn_categories as c", "c.id", "p.category_id")
                ->leftJoin("wishlists as w", "p.id", "w.product_id")
                ->where('p.status', true)
                ->where('p.id', '<>', $product->id)
                ->Where('c.id', $product->category_id)
                ->orderBy('p.id', 'DESC')
                ->groupBy("p.id")
                ->get();

//            dd($related_products);
            $offers = DB::table('txn_products as p')
                ->selectRaw('p.title as product_name, p.id as product_id, m.color_id, m.size_id, c.title as color_name, s.title as size_name, m.id as offer_id, mop.purchase_quantity, mop.offered_quantity, mop.id as map_id, mop.map_offer_id, timg.image_url')
                ->join("map_mst_offer_products as m", "m.offer_product_id", "p.id")
                ->join("mst_colors as c", "m.color_id", "c.id")
                ->join("mst_sizes as s", "m.size_id", "s.id")
                ->join("mst_offers as o", "m.offer_id", "o.id")
                ->join("map_offer_products as mop", "mop.mst_offer_id", "m.offer_id")
                ->join("txn_images as timg", function ($join) {
                    $join->on("timg.product_id", "=", "m.offer_product_id")
                        ->on("timg.color_id", "=", "m.color_id");
                })
                ->join("map_color_sizes as mcs", function ($join) {
                    $join->on("mcs.product_id", "=", "m.offer_product_id")
                        ->on("mcs.color_id", "=", "c.id")
                        ->on("mcs.size_id", "=", "s.id");
                })
                ->groupBy('m.offer_product_id', 'm.color_id', 'm.size_id')
                ->where('o.status', true)
                ->where('p.status', true)
                ->where('mcs.status', true)
                ->where('mcs.stock', '>', 0)
                ->where('mop.product_id', $product->id)
                ->get();

            // dd($offers);

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

        $results = MapColorSize::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('status', true)->where('stock', '>', 0)->orderBy('sort_index')->get();

        $color_images = TxnImage::where('product_id', $request->product_id)->where('color_id', $request->color_id)->orderBy('id', 'DESC')->get();

        if ($results) {
            return response()->json(['success' => $results, 'color_images' => $color_images]);
        }
        return response()->json(['error' => []]);
    }

    public function verifyPincode(Request $request)
    {
        $res = Delivery::verify($request->pincode);
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
                ->selectRaw("p.id , p.title , p.slug_url,w.user_id as w_u_id, w.id as w_id, w.product_id as w_product_id,map.color_id as c_id, map.size_id as s_id , p.image_url, p.image_url1,p.review_status, FLOOR(AVG(r.rating)) as rating , map.mrp, map.starting_price,
                GROUP_CONCAT(DISTINCT(c.color_code)) as color_codes, COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("map_color_sizes as map", "map.product_id", "p.id")
                ->leftJoin("mst_colors as c", "c.id", "map.color_id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->leftJoin("wishlists as w", "p.id", "w.product_id")
                ->where('p.status', '=', true)
                ->where('k.keyword', 'like', '%' . $request->q . '%');
        } else {

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url,w.user_id as w_u_id,w.id as w_id, w.product_id as w_product_id,map.color_id as c_id, map.size_id as s_id , p.image_url,p.review_status, p.image_url1, FLOOR(AVG(r.rating)) as rating , map.mrp, map.starting_price,
                GROUP_CONCAT(DISTINCT(c.color_code)) as color_codes, COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("map_color_sizes as map", "map.product_id", "p.id")
                ->leftJoin("mst_colors as c", "c.id", "map.color_id")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->leftJoin("wishlists as w", "p.id", "w.product_id")
                ->where('p.status', '=', true);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(50);
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
            ->selectRaw("p.id , p.title , p.slug_url, p.image_url, p.image_url1,FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
            ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
            ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
            ->where('p.status', '=', true);

        if ($request->filled('brands') && gettype($request->brands) == 'array') {
            $products = $products->whereIn('p.brand_id', $request->brands);
        }

        if ($request->filled('conditions') && gettype($request->conditions) == 'array') {
            $products = $products->whereIn('p.condition_id', $request->conditions);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(20);

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

        // return response()->json(['products' => $products], 200);
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

        $cateLists = [];
        $cateLists[0] = $category->id;

        foreach ($categories as $cate) {
            array_push($cateLists, $cate->id);
        }

        $products = \DB::table('txn_products as p')
            ->selectRaw("p.id , p.title , p.slug_url , p.image_url, p.image_url1, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
            ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
            ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
            ->where('p.status', '=', true)
            ->whereIN('p.category_id', $cateLists);

        $brands = \DB::table('txn_products as p')
            ->selectRaw("Distinct(b.id) as id, b.brand_name")
            ->leftJoin("txn_brands as b", "p.brand_id", "b.id")
            ->where('p.status', true)
            ->whereIN('p.category_id', $cateLists)
            ->groupBy("p.id")
            ->get();

        $conditions = TxnCondition::where('status', true)->get();

        if ($request->filled('brands') && gettype($request->brands) == 'array') {
            $products = $products->whereIn('p.brand_id', $request->brands);
        }

        if ($request->filled('conditions') && gettype($request->conditions) == 'array') {
            $products = $products->whereIn('p.condition_id', $request->conditions);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(20);

        return view('frontend.product.cate-products', compact('products', 'category', 'brands', 'conditions'))->with('input', $request);

        // return response()->json(['products' => $products], 200);
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

            $cateLists = [];
            $cateLists[0] = $category->id;

            foreach ($categories as $cate) {
                array_push($cateLists, $cate->id);
            }

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url,w.user_id as w_u_id,w.id as w_id, w.product_id as w_product_id,map.color_id as c_id, map.size_id as s_id, p.image_url, p.image_url1,p.review_status, map.mrp, map.starting_price,
                GROUP_CONCAT(DISTINCT(co.color_code)) as color_codes, p.category_id ,c.parent_id, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("map_color_sizes as map", "map.product_id", "p.id")
                ->leftJoin("mst_colors as co", "co.id", "map.color_id")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "p.category_id", "c.id")
                ->leftJoin("wishlists as w", "p.id", "w.product_id")
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
                'question' => $request->question,
                'product_id' => $product->id,
                'status' => false,
            ]);

            Mail::send(['html' => 'backend.mails.question'], ['qna' => $qna, 'product' => $product], function ($message) {
                $message->from('support@sillageniche.com', 'SILLAGE');
                $message->to('support@sillageniche.com', 'SILLAGE');
                $message->subject('SILLAGE - Someone ask question');
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

    public function getSizePrice(Request $request)
    {
        try {

            $result = MapColorSize::select('mrp', 'starting_price')->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->where('status', true)->firstOrFail();

            return response()->json(['success' => $result]);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {

                return response()->json(['error' => 'Whoops something went wrong !']);
            }
            return response()->json(['error' => 'Whoops something went wrong from our end, try again later !']);
        }
    }

}
