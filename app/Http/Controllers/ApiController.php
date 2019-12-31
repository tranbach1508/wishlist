<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;

class ApiController extends Controller
{
    public function add(Request $request){
        $shop_id = Shop::where('url',$request->shop_url)->first()->id;
        $product_old = Product::where('product_handle',$request->product)
        ->where('shop_id',$shop_id)
        ->where('customer_id',$request->customer_id)
        ->where('list_type',$request->type)
        ->first();
        if(isset($product_old)){
            return response()->json(['message' =>"Product has been in wishlist"]);
        }else{
            $products = new Product;
            $products->shop_id = $shop_id;
            $products->customer_id = $request->customer_id;
            $products->customer_email = $request->customer_email;
            $products->product_handle = $request->product;
            $products->list_type = $request->type;
            $products->save();
            return response()->json([
                'message' =>'Success: You have added the products'
            ]);
        }
    }

    public function select($shopUrl,$customerId){
        $shop_id = Shop::where('url', $shopUrl)->first()->id;
        $products = Product::where('list_type','wishlist')->where('shop_id',$shop_id)->where('customer_id',$customerId)->get();
        return response()->json(['products'=>$products]);
    }

    public function getRecentlyViewed($shopUrl,$customerId){
        $shop_id = Shop::where('url', $shopUrl)->first()->id;
        $products = Product::where('list_type','recently_viewed')->where('shop_id',$shop_id)->where('customer_id',$customerId)->get();
        return response()->json(['products'=>$products]);
    }

    public function remove(Request $request){
        $shop_id = Shop::where('url',$request->shop_url)->first()->id;
        $products = Product::where('product_handle',$request->product)
        ->where('shop_id',$shop_id)
        ->where('customer_id',$request->customer_id)
        ->where('list_type',$request->type)->delete();
        return response()->json(['message' =>'Success: Remove success']);
    }

    public function dashboard(){
        $shop_id = Shop::getCurrentShop()->id;
        $actions = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')->get()->count();
        $users = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->distinct()
        ->get()
        ->groupBy('customer_id')
        ->count();
        $products = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->distinct()
        ->get()
        ->groupBy('product_handle')
        ->count();
        return response()->json(['actions'=>$actions,'users'=>$users,'products'=>$products]);
    }

    public function month($month){
        switch($month){
            case 'Jan':
                $from = '2019-01-01 00:00:00';
                $to = '2019-01-31 23:59:59';
                break;
            case 'Feb':
                $from = '2019-02-01 00:00:00';
                $to = '2019-02-29 23:59:59';
                break;
            case 'Mar':
                $from = '2019-03-01 00:00:00';
                $to = '2019-03-31 23:59:59';
                break;
            case 'Apr':
                $from = '2019-04-01 00:00:00';
                $to = '2019-04-30 23:59:59';
                break;
            case 'May':
                $from = '2019-05-01 00:00:00';
                $to = '2019-05-31 23:59:59';
                break;
            case 'Jun':
                $from = '2019-06-01 00:00:00';
                $to = '2019-06-30 23:59:59';
                break;
            case 'Jul':
                $from = '2019-07-01 00:00:00';
                $to = '2019-07-31 23:59:59';
                break;
            case 'Aug':
                $from = '2019-08-01 00:00:00';
                $to = '2019-08-31 23:59:59';
                break;
            case 'Sep':
                $from = '2019-09-01 00:00:00';
                $to = '2019-09-30 23:59:59';
                break;
            case 'Oct':
                $from = '2019-10-01 00:00:00';
                $to = '2019-10-31 23:59:59';
                break;
            case 'Nov':
                $from = '2019-11-01 00:00:00';
                $to = '2019-11-30 23:59:59';
                break;
            case 'Dec':
                $from = '2019-12-01 00:00:00';
                $to = '2019-12-31 23:59:59';
                break;
        }
        $shop_id = Shop::getCurrentShop()->id;
        $actions = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->get()
        ->count();
        $users = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->distinct()
        ->get()
        ->groupBy('customer_id')
        ->count();
        $products = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=',$from)
        ->where('created_at','<=',$to)
        ->distinct()
        ->get()
        ->groupBy('product_handle')
        ->count();
        return response()->json(['actions'=>$actions,'users'=>$users,'products'=>$products,'month'=>$month]);
    }

    public function linechart(){
        $shop_id = Shop::getCurrentShop()->id;
        $actions1 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-01-01 00:00:00')
        ->where('created_at','<=','2019-01-31 23:59:59')
        ->get()
        ->count();
        $actions2 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-02-01 00:00:00')
        ->where('created_at','<=','2019-02-29 23:59:59')
        ->get()
        ->count();
        $actions3 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-03-01 00:00:00')
        ->where('created_at','<=','2019-03-31 23:59:59')
        ->get()
        ->count();
        $actions4 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-04-01 00:00:00')
        ->where('created_at','<=','2019-04-30 23:59:59')
        ->get()
        ->count();
        $actions5 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-05-01 00:00:00')
        ->where('created_at','<=','2019-05-31 23:59:59')
        ->get()
        ->count();
        $actions6 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-06-01 00:00:00')
        ->where('created_at','<=','2019-06-30 23:59:59')
        ->get()
        ->count();
        $actions7 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-07-01 00:00:00')
        ->where('created_at','<=','2019-07-31 23:59:59')
        ->get()
        ->count();
        $actions8 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-08-01 00:00:00')
        ->where('created_at','<=','2019-08-31 23:59:59')
        ->get()
        ->count();
        $actions9 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-09-01 00:00:00')
        ->where('created_at','<=','2019-09-30 23:59:59')
        ->get()
        ->count();
        $actions10 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-10-01 00:00:00')
        ->where('created_at','<=','2019-10-31 23:59:59')
        ->get()
        ->count();
        $actions11 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-11-01 00:00:00')
        ->where('created_at','<=','2019-11-30 23:59:59')
        ->get()
        ->count();
        $actions12 = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>=','2019-12-01 00:00:00')
        ->where('created_at','<=','2019-12-31 23:59:59')
        ->get()
        ->count();
        return response()->json(['actions'=>[$actions1,$actions2,$actions3,$actions4,$actions5,$actions6,$actions7,$actions8,$actions9,$actions10,$actions11,$actions12]]);
    }

    public function index(){
        return view('index');
    }
}
