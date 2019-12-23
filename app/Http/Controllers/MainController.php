<?php

namespace App\Http\Controllers;

use App\Model\Delivery;
use App\Model\MsSection;
use App\Model\ProductFaq;
use App\Model\Slider;
use App\Model\Subscriber;
use App\Model\Testimonial;
use App\Model\TxnCategory;
use App\Model\TxnCondition;
use App\Model\TxnProduct;
use App\Model\HomeOfferSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->orderBy('sort_index')->get();
        $homeOfferSliders = HomeOfferSlider::where('status', true)->orderBy('sort_index')->get();
        $testimonials = Testimonial::where('status', true)->orderBy('sort_index')->get();
        // $side_products = SideProduct::with('product')->orderBy('sort_index')->limit(2)->get();
        $sections = MsSection::where('status', true)->with('msections')->get();
        // dd($sections);
        return view('frontend.index', compact('sliders', 'sections', 'testimonials','homeOfferSliders'));
        // return view('frontend.index', compact('sliders', 'testimonials', 'sections', 'side_products'));
    }

    public function subscribers(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:subscribers,email',
            ],
            [
                'email.required' => 'Please Enter Email ID',
                'email.email' => 'Please Enter Proper Email',
                'email.unique' => 'Email is already Registered',
            ]
        );

        subscriber::create([
            'email' => $request->email,
            'status' => true,
        ]);

        return redirect('/')->with('messgeSuccess1', 'Thank you for Subscribing with us !');
    }

    public function getProduct($slug)
    {

        try {
            // sizes remove
            $product = TxnProduct::where('status', true)->where('slug_url', $slug)->with(['images', 'sizes', 'category', 'warranty', 'reviews' => function ($q) {
                $q->where('status', true)->get();
            }])->firstOrFail();

            $prod = DB::table('txn_products as p')
                ->select(DB::raw('FLOOR(AVG(txn_reviews.rating)) as rating , COUNT(txn_reviews.id) as total_rating'))
                ->leftJoin("txn_reviews", "txn_reviews.product_id", "p.id")
                ->where('p.id', $product->id)
                ->where('txn_reviews.status', true)
                ->first();

            $colorsSizes = DB::table('map_color_sizes as m')
                ->selectRaw('DISTINCT(c.title) as color_name, s.title as size_name, c.id as color_id, s.id as size_id, m.mrp, m.stock, m.id as map_id')
                ->join('mst_colors as c', 'm.color_id', 'c.id')
                ->join('mst_sizes as s', 'm.size_id', 's.id')
                ->where('m.product_id', $product->id)
                ->orderBy('m.id', 'DESC')
                ->groupBy('c.id')
                ->get();

            $related_products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url, p.image_url , FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment, c.name as category_name, c.slug_url as category_url")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "c.id", "p.category_id")
                ->where('p.status', '=', true)
                ->where('p.id', '!=', $product->id)
                ->orWhere('c.id', $product->category_id);

            $related_products = $related_products->orderBy('p.id', 'DESC')->groupBy("p.id")->limit(6)->get();
            return view('frontend.product.show', compact('product', 'related_products', 'prod', 'colorsSizes'));
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return $ex->getMessage();
                return redirect('/')->with('messageDanger1', 'Whoops, Product Not Found !');
            }
            return $ex->getMessage();

            return redirect('/')->with('messageDanger1', 'Whoops, Something Went Wrong from our End ');
        }
    }

    public function getSizes(Request $request)
    {

        // $results = MapColorSize::where('product_id', $request->product_id)->where('color_id', $request->color_id)->get();

        $results = DB::table('map_color_sizes as m')
            ->selectRaw('c.title as color_name, s.title as size_name, c.id as color_id, s.id as size_id, m.mrp, m.stock')
            ->join('mst_colors as c', 'm.color_id', 'c.id')
            ->join('mst_sizes as s', 'm.size_id', 's.id')
            ->where('m.product_id', $request->product_id)
            ->where('m.color_id', $request->color_id)
            ->orderBy('m.id', 'DESC')
            ->get();

        if ($results) {
            return response()->json(['success' => $results]);
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

        $cateLists = [];
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

            $cateLists = [];
            $cateLists[0] = $category->id;

            foreach ($categories as $cate) {
                array_push($cateLists, $cate->id);
            }

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url, p.image_url, p.image_url1, p.category_id ,c.parent_id, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "p.category_id", "c.id")
                ->where('p.status', true)
                ->whereIN('p.category_id', $cateLists);

            $products = $products->groupBy("p.id")->paginate(50);

            $brands = \DB::table('txn_products as p')
                ->selectRaw("Distinct(b.id) as id, b.brand_name")
                ->leftJoin("txn_brands as b", "p.brand_id", "b.id")
                ->where('p.status', true)
                ->whereIN('p.category_id', $cateLists);

            $brands = $brands->groupBy("p.id")->get();

            $conditions = TxnCondition::where('status', true)->get();
            return view('frontend.product.cate-products', compact('products', 'category', 'brands', 'conditions'))->with('input', $request);
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect('/')->with('messageDanger1', 'Whoops, Category Not Found !');
            }
            return $ex->getMessage();
            return redirect('/')->with('messageDanger1', 'Whoops, Something Went Wrong from our End ');
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
                $message->from('support@thehatkestore.com', 'The Hatke Store');
                $message->to('support@thehatkestore.com', 'The Hatke Store');
                $message->subject('The Hatke Store - Someone ask question');
            });

            return redirect(route('product', $product->slug_url))->with('messageSuccess1', 'Your question has been submitted successfully ! we\'ll answer your question soon !');
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return back()->with('messageDanger1', 'Whoops, Category Not Found !');
            }
            // return $ex->getMessage();
            return back()->with('messageDanger1', 'Whoops, Something Went Wrong from our End ');
        }
    }
}
