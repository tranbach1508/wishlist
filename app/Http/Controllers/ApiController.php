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

    public function statistical(){
        $shop = Shop::getCurrentShop();
        if(!$shop){
            return response()->json(['error'=>"The shop is not exists"]);
        }
        $products = $shop->products()->where('list_type','wishlist')->groupBy('product_handle')->selectRaw('product_handle,count(*) as quantity')->get();
        return response()->json(['top_wishlist'=>$products]);
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

    public function index(){
        return view('index');
    }
}
