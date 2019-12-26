<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class Shop extends Model
{
  protected $table = 'shops';
  protected $fillable = [
    'url',
    'token',
    'email',
    'settings'
  ];

  public static function getCurrentShop()
  {
    return Shop::where('url', Session::get('globo_wishlist_shop'))->where('token', Session::get('globo_wishlist_token'))->firstOrFail();
  }

  public function getRestAPI()
  {
    return new \PHPShopify\ShopifySDK(['ShopUrl' => $this->url, 'AccessToken' => $this->token, 'ApiVersion' => '2019-07']);
  }

  public function getThemes()
  {
    $restAPI = $this->getRestAPI();
    $themes = $restAPI->Theme->get(['fields' => 'id,name,role,theme_store_id', 'role' => 'main,unpublished']);
    return $themes;
  }

  public function products(){
    return $this->hasMany('App\Product');
  }
}
