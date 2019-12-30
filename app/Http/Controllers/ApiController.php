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
        $shop_id = Shop::getCurrentShop()->id;
        $products = Product::where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->distinct()
        ->get()
        ->groupBy('product_handle')
        ->count();
        return response()->json(['products'=>$products]);
    }

    public function index(){
        return view('index');
    }
}
