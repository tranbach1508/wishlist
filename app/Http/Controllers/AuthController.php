<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use Log;
use App\Shop;
use Session;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */


class AuthController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('dev')){
            $shop = Shop::whereUrl($request->input('url'))->whereToken($request->input('token'))->first();
            $request->session()->put('globo_wishlist_shop', $shop->url);
            $request->session()->put('globo_wishlist_token', $shop->token);
            $request->session()->save();
            return redirect('/admin');
        }
        $config = array(
            'ShopUrl' => (string)$request->input('shop'),
            'ApiKey' => env('SHOPIFY_API_KEY'),
            'SharedSecret' => env('SHOPIFY_SECRET_KEY'),
        );
        $request_shop = (string)$request->input('shop');
        if ($request->has('code')){
            \PHPShopify\ShopifySDK::config($config);
            $accessToken = \PHPShopify\AuthHelper::getAccessToken();

            $request->session()->put('globo_wishlist_shop',  $request_shop);
            $request->session()->put('globo_wishlist_token', $accessToken);

            if(Shop::where('url', $request_shop)->count() > 0){
                $shop = Shop::where('url', $request_shop)->first();
                $shop->update([
                    'token' => $accessToken
                ]);
                return redirect('/index');
            }else{
                $shop = Shop::create([
                    'url' => $request_shop,
                    'token' => $accessToken,
                    'email' => '',
                    'settings' => ''
                ]);
                return redirect('/index');
            }
        }elseif($request->has('shop')) {
            \PHPShopify\ShopifySDK::config($config);
            preg_match('/^[a-zA-Z0-9\-]+.myshopify.com$/', $request_shop) or die('Invalid myshopify.com store URL.');
            $redirectURL = url('authorize');
            $installURL = \PHPShopify\AuthHelper::createAuthRequest(env('SHOPIFY_SCOPE'), $redirectURL,null, null, true);
            die("<script>top.location.href='$installURL'</script>");
            exit;
        }else{
            return view('login');
        }
    }

    public function receiveRACCallback(Request $request){

        $shop = Shop::where('url', $request->input('shop'))->first();

        $sh = App::make('ShopifyAPI');
        $sh->setup(['API_KEY' => config('constants.SHOPIFY_API_KEY'), 'API_SECRET' => config('constants.SHOPIFY_SECRET_KEY'), 'SHOP_DOMAIN' => $shop->url, 'ACCESS_TOKEN' => $shop->token]);

        $app_active = false;
        if($request->has('charge_id')){
            $charge = $sh->call([
                'METHOD'    => 'GET',
                'URL'       => '/admin/recurring_application_charges/'.$request->input('charge_id').'.json'
            ]);
            if(isset($charge)&&count($charge)){
                if($charge->recurring_application_charge->status == 'accepted'){
                    $charge = $sh->call([
                        'METHOD'    => 'POST',
                        'URL'       => '/admin/recurring_application_charges/'.$charge->recurring_application_charge->id.'/activate.json',
                        'DATA'      => array('recurring_application_charge' => (array)$charge->recurring_application_charge)
                    ]);
                    $app_active = true;
                }elseif($charge->recurring_application_charge->status == 'active'){
                    $app_active = true;
                }
            }


        }
        $request->session()->put('globo_wishlist_shop',  $shop->url);
        $request->session()->put('globo_wishlist_token', $shop->token);

        if(!$app_active){
            return redirect('https://'.$shop->url.'/admin/apps/');
        }else{
            $shop->pricing_id = $shop->getPricingID($charge->recurring_application_charge->price);
            $shop->save();
            return redirect('/');
        }
    }
}