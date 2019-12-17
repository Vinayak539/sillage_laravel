<?php

namespace App\Http\Controllers;

use App\Model\MsSection;
use App\Model\ProductFaq;
use App\Model\SideProduct;
use App\Model\Slider;
use App\Model\Subscriber;
use App\Model\Testimonial;
use App\Model\TopMasterSection;
use App\Model\TxnCategory;
use App\Model\TxnCondition;
use App\Model\TxnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->orderBy('sort_index')->get();
        $testimonials = Testimonial::where('status', true)->orderBy('sort_index')->get();
        // $side_products = SideProduct::with('product')->orderBy('sort_index')->limit(2)->get();
        $sections = MsSection::where('status', true)->with('msections')->get();
        // dd($sections);
        return view('frontend.index', compact('sliders', 'sections', 'testimonials'));
        // return view('frontend.index', compact('sliders', 'testimonials', 'sections', 'side_products'));
    }

    public function subscribers(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ],
            [
                'email.required' => 'Please Enter Email ID',
                'email.email' => 'Please Enter Proper Email',
                'email.unique' => 'Email is already Registered',
            ]);

        Subscriber::create([
            'email' => $request->email,
            'status' => true,
        ]);

        return redirect('/')->with('messgeSuccess1', 'Thank you for Subscribing with us !');
    }

    public function getProduct($slug)
    {

        try {
            // sizes remove 
            $product = TxnProduct::where('status', true)->where('slug_url', $slug)->with(['images', 'category', 'warranty', 'reviews' => function ($q) {
                $q->where('status', true)->get();
            }])->firstOrFail();

            // $product = TxnProduct::where('status', true)->where('slug_url', $slug)->with(['images', 'sizes', 'category', 'warranty', 'reviews' => function ($q) {
            //     $q->where('status', true)->get();
            // }, 'qnas' => function ($q) {
            //     $q->where('status', true)->get();
            // }])->firstOrFail();

            $prod = DB::table('txn_products')
                ->select(DB::raw('FLOOR(AVG(txn_reviews.rating)) as rating , COUNT(txn_reviews.id) as total_rating'))
                ->leftJoin("txn_reviews", "txn_reviews.product_id", "txn_products.id")
                ->where('txn_products.id', $product->id)
                ->where('txn_reviews.status', true)
                ->groupBy('txn_products.id')
                ->first();

            $related_products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp,p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment, c.name as category_name, c.slug_url as category_url")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "c.id", "p.category_id")
                ->where('p.status', '=', true)
                ->where('p.stock', '>', 0)
                ->orWhere('c.id', $product->category_id)
                ->where('p.slug_url', '<>', $slug);

            $related_products = $related_products->orderBy('p.id', 'DESC')->groupBy("p.id")->limit(6)->get();

            return view('frontend.product.show', compact('product', 'related_products', 'prod'));

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect('/')->with('messageDanger1', 'Whoops, Product Not Found !');
            }
            return redirect('/')->with('messageDanger1', 'Whoops, Something Went Wrong from our End ');
        }
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp, p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->where('p.status', '=', true)
                ->where('p.stock', '>', 0)
                ->where('k.keyword', 'like', '%' . $request->q . '%');

        } else {

            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp, p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_keywords as k", "k.product_id", "p.id")
                ->where('p.stock', '>', 0)
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
    
    public function sectionFilter(Request $request)
    {

        $section = TopMasterSection::where('id', $request->section_id)->firstOrFail();

        $products = \DB::table('txn_products as p')
        ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp,p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
        ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
        ->leftJoin("map_product_to_top_sections as m", "m.product_id", "p.id")
        ->where('p.status', '=', true)
        ->where('p.stock', '>', 0)
        ->where('m.section_id', $section->id);

        if ($request->filled('brands') && gettype($request->brands) == 'array') {
            $products = $products->whereIn('p.brand_id', $request->brands);
        }

        if ($request->filled('conditions') && gettype($request->conditions) == 'array') {
            $products = $products->whereIn('p.condition_id', $request->conditions);
        }

        $products = $products->orderBy('p.id', 'DESC')->groupBy("p.id")->paginate(20);

        return response()->json(['products' => $products], 200);
    }

    public function getTopSectionProduct(Request $request, $id, $slug)
    {
        try {

            $section = TopMasterSection::where('id', $id)->firstOrFail();
            
            $products = \DB::table('txn_products as p')
                ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.starting_price,p.mrp,p.stock, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("map_product_to_top_sections as m", "m.product_id", "p.id")
                ->where('p.status', '=', true)
                ->where('p.stock', '>', 0)
                ->where('m.section_id', $section->id);

            $products = $products->groupBy("p.id")->paginate(50);

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

            return view('frontend.product.section', compact('products', 'brands', 'conditions', 'section'))->with('input', $request);
        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return redirect('/')->with('messageDanger1', 'Whoops, Section Not Found !');
            }

            return redirect('/')->with('messageDanger1', 'Whoops, Something Went Wrong from our End ');
        }
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
                ->selectRaw("p.id , p.title , p.slug_url , p.buy_it_now_price , p.image_url, p.category_id , p.starting_price,p.mrp, p.stock,c.parent_id, FLOOR(AVG(r.rating)) as rating , COUNT(Distinct(r.comment)) as total_comment")
                ->leftJoin("txn_reviews as r", "r.product_id", "p.id")
                ->leftJoin("txn_categories as c", "p.category_id", "c.id")
                ->where('p.status', true)
                ->where('p.stock', '>', 0)
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

    public function checkBidPrice(Request $request)
    {
        try {

            $product = TxnProduct::where('id', $request->prod_id)->firstOrFail();
            if ($request->bid_value >= $product->reserve_price) {
                $save_amount = $product->buy_it_now_price - $request->bid_value;
                if ($save_amount > 0) {
                    return response()->json(['success' => 'Congratulations you saved ₹' . $save_amount . ' per item'], 200);
                }
                return response()->json(['success' => 'Congratulations you can procced with add to cart with ₹' . $request->bid_value], 200);
            }
            return response()->json(['error' => 'You are not allowed with ₹' . $request->bid_value . ' try again !'], 200);

        } catch (\Exception $ex) {
            if ($ex instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error', 'Whoops, Product Not Found !'], 200);
            }

            return response()->json(['error', 'Whoops, something went wrong, try again later !']);
        }
    }

    public function askQuestion(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
        ],
            [
                'question.required' => 'Please Enter your question',
            ]);

        try {

            $product = TxnProduct::where('id', $id)->firstOrFail();

            $qna = ProductFaq::create([
                'question' => $request->question,
                'product_id' => $product->id,
                'status' => false,
            ]);

            Mail::send(['html' => 'backend.mails.question'], ['qna' => $qna, 'product' => $product], function ($message) {
                $message->from('support@ranayas.com', 'Ranayas Store');
                $message->to('support@ranayas.com', 'Ranayas Store');
                $message->subject('Ranayas Store - Someone ask question');
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
