<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Shop;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function add(Request $request)
    {
        $shop_id = Shop::where('url', $request->shop_url)->first()->id;
        $product_old = Product::where('product_handle', $request->product)
            ->where('shop_id', $shop_id)
            ->where('customer_id', $request->customer_id)
            ->where('list_type', $request->type)
            ->first();
        if (isset($product_old)) {
            return response()->json(['message' => "Product has been in wishlist"]);
        } else {
            $products = new Product;
            $products->shop_id = $shop_id;
            $products->customer_id = $request->customer_id;
            $products->customer_email = $request->customer_email;
            $products->product_handle = $request->product;
            $products->list_type = $request->type;
            $products->save();
            return response()->json([
                'message' => 'Success: You have added the products'
            ]);
        }
    }

    public function select($shopUrl, $customerId)
    {
        $shop_id = Shop::where('url', $shopUrl)->first()->id;
        $products = Product::where('list_type', 'wishlist')->where('shop_id', $shop_id)->where('customer_id', $customerId)->get();
        return response()->json(['products' => $products]);
    }

    public function getRecentlyViewed($shopUrl, $customerId)
    {
        $shop_id = Shop::where('url', $shopUrl)->first()->id;
        $products = Product::where('list_type', 'recently_viewed')->where('shop_id', $shop_id)->where('customer_id', $customerId)->get();
        return response()->json(['products' => $products]);
    }

    public function remove(Request $request)
    {
        $shop_id = Shop::where('url', $request->shop_url)->first()->id;
        $products = Product::where('product_handle', $request->product)
            ->where('shop_id', $shop_id)
            ->where('customer_id', $request->customer_id)
            ->where('list_type', $request->type)->delete();
        return response()->json(['message' => 'Success: Remove success']);
    }

    public function dashboard()
    {
        $shop_id = Shop::getCurrentShop()->id;
        $actions = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')->get()->count();
        $users = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $products = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        return response()->json(['actions' => $actions, 'users' => $users, 'products' => $products]);
    }

    public function linechart()
    {
        $shop_id = Shop::getCurrentShop()->id;
        $date = date("Y-m");
        $date11 = date('Y-m', strtotime($date . ' - 1 month'));
        $date12 = date('Y-m', strtotime($date11 . '+ 1 month'));
        $date10 = date('Y-m', strtotime($date12 . ' - 2 month'));
        $date9 = date('Y-m', strtotime($date12 . ' - 3 month'));
        $date8 = date('Y-m', strtotime($date12 . ' - 4 month'));
        $date7 = date('Y-m', strtotime($date12 . ' - 5 month'));
        $date6 = date('Y-m', strtotime($date12 . ' - 6 month'));
        $date5 = date('Y-m', strtotime($date12 . ' - 7 month'));
        $date4 = date('Y-m', strtotime($date12 . ' - 8 month'));
        $date3 = date('Y-m', strtotime($date12 . ' - 9 month'));
        $date2 = date('Y-m', strtotime($date12 . ' - 10 month'));
        $date1 = date('Y-m', strtotime($date12 . ' - 11 month'));
        $actions1 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date1)
            ->where('created_at', '<', $date2)
            ->get()
            ->count();
        $actions2 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date2)
            ->where('created_at', '<', $date3)
            ->get()
            ->count();
        $actions3 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date3)
            ->where('created_at', '<', $date4)
            ->get()
            ->count();
        $actions4 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date4)
            ->where('created_at', '<', $date5)
            ->get()
            ->count();
        $actions5 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date5)
            ->where('created_at', '<', $date6)
            ->get()
            ->count();
        $actions6 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date6)
            ->where('created_at', '<', $date7)
            ->get()
            ->count();
        $actions7 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date7)
            ->where('created_at', '<', $date8)
            ->get()
            ->count();
        $actions8 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date8)
            ->where('created_at', '<', $date9)
            ->get()
            ->count();
        $actions9 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date9)
            ->where('created_at', '<', $date10)
            ->get()
            ->count();
        $actions10 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date10)
            ->where('created_at', '<', $date11)
            ->get()
            ->count();
        $actions11 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date11)
            ->where('created_at', '<', $date12)
            ->get()
            ->count();
        $actions12 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date12)
            ->get()
            ->count();
        $users1 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date1)
            ->where('created_at', '<', $date2)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users2 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date2)
            ->where('created_at', '<', $date3)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users3 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date3)
            ->where('created_at', '<', $date4)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users4 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date4)
            ->where('created_at', '<', $date5)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users5 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date5)
            ->where('created_at', '<', $date6)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users6 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date6)
            ->where('created_at', '<', $date7)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users7 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date7)
            ->where('created_at', '<', $date8)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users8 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date8)
            ->where('created_at', '<', $date9)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users9 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date9)
            ->where('created_at', '<', $date10)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users10 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date10)
            ->where('created_at', '<', $date11)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users11 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date11)
            ->where('created_at', '<', $date12)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $users12 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date12)
            ->distinct()
            ->get()
            ->groupBy('customer_id')
            ->count();
        $products1 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date1)
            ->where('created_at', '<', $date2)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products2 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date2)
            ->where('created_at', '<', $date3)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products3 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date3)
            ->where('created_at', '<', $date4)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products4 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date4)
            ->where('created_at', '<', $date5)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products5 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date5)
            ->where('created_at', '<', $date6)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products6 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date6)
            ->where('created_at', '<', $date7)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products7 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date7)
            ->where('created_at', '<', $date8)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products8 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date8)
            ->where('created_at', '<', $date9)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products9 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date9)
            ->where('created_at', '<', $date10)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products10 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date10)
            ->where('created_at', '<', $date11)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products11 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date11)
            ->where('created_at', '<', $date12)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        $products12 = Product::where('shop_id', $shop_id)
            ->where('list_type', 'wishlist')
            ->where('created_at', '>=', $date12)
            ->distinct()
            ->get()
            ->groupBy('product_handle')
            ->count();
        return response()->json(
            [
                'actions' => [$actions1, $actions2, $actions3, $actions4, $actions5, $actions6, $actions7, $actions8, $actions9, $actions10, $actions11, $actions12],
                'users' => [$users1, $users2, $users3, $users4, $users5, $users6, $users7, $users8, $users9, $users10, $users11, $users12],
                'products' => [$products1, $products2, $products3, $products4, $products5, $products6, $products7, $products8, $products9, $products10, $products11, $products12],
                'months' => [$date1, $date2, $date3, $date4, $date5, $date6, $date7, $date8, $date9, $date10, $date11, $date12]
            ]
        );
    }

    public function listdata(){
        $shop_id = Shop::getCurrentShop()->id;
        $shop_url = Shop::getCurrentShop()->url;
        $items = Product::select('customer_email','created_at','product_handle')
        ->where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->get();
        return response()->json(['items'=>$items,'shop_url'=>$shop_url]);
    }

    public function toptrending($from,$to){
        $shop_id = Shop::getCurrentShop()->id;
        $shop_url = Shop::getCurrentShop()->url;
        $items = Product::select('product_handle',DB::raw('count(*) as count'))
        ->where('shop_id',$shop_id)
        ->where('list_type','wishlist')
        ->where('created_at','>',$from)
        ->where('created_at','<=',$to)
        ->groupBy('product_handle')
        ->get();
        return response()->json(['items'=>$items,'shop_url'=>$shop_url]);
    }

    public function index()
    {
        return view('index');
    }
}
