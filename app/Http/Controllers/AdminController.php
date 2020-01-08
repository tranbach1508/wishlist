<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class AdminController extends Controller
{
    public function index(){
        $shop = Shop::getCurrentShop();
        if(!$shop){
            return response()->json(['error'=>"The shop is not exists"]);
        }
        return response()->json([
            'settings' => $shop->settings,
            'themes' =>$shop->getThemes()
        ]);
    }

    public function save(Request $request){
        $shop = Shop::getCurrentShop();
        $data = $request->all();
        $shop->settings = json_encode($data);
        $shop->save();

        $shopify = new \PHPShopify\ShopifySDK(array( 'ShopUrl' => $shop->url, 'AccessToken' => $shop->token ));
        $main_theme = $shop->getMainTheme();
        $themes = $shop->getThemes();
        foreach ($themes as $key => $value){
            if($request->theme == $value['id']){
                $theme = $shop->getThemeInfo($value);
                break;
            }
        }
        $themeLiquidjs = $shopify->Theme($request->theme)->Asset->put(array("key" => 'assets/globo.wishlist_app.js',"value" => view('assets.gwl-js', ['shop' => $shop,'theme'=>$theme])->render()));
        $themeLiquidcss = $shopify->Theme($request->theme)->Asset->put(array("key" => 'assets/globo.wishlist_app.scss.liquid',"value" => view('assets.gwl-css', ['shop' => $shop,'theme'=>$theme])->render()));
        $themeLiquidscript = $shopify->Theme($request->theme)->Asset->put(array("key" => 'snippets/globo.wishlist_app.script.liquid',"value" => view('assets.gwl-script-liquid', ['shop' => $shop,'theme'=>$theme])->render()));

        return response()->json(['message' =>'Success: You have updated the settings']);
    }
}
