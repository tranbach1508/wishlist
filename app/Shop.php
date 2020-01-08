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

  public $themes = [
    730 => 'Brooklyn', #
    679 => 'Supply', #
    380 => 'Minimal', #
    578 => 'Simple', #
    775 => 'Venture', #
    766 => 'Boundless', #
    719 => 'Pop', #
    796 => 'Debut', #
    829 => 'Narrative', #
    782 => 'Jumpstart', #
    855 => 'Prestige', #
    857 => 'Impulse', #
    838 => 'Empire', #
    847 => 'Motion', #
    688 => 'Parallax', #
    606 => 'Blockshop', #
    623 => 'Testament', #
    735 => 'District', #
    836 => 'Venue', #
    739 => 'Pipeline', #
    686 => 'Icon', #
    411 => 'Envy', #
    568 => 'Symmetry', #
    141 => 'Fashionopolism', #
    687 => 'ShowTime', #
    304 => 'Responsive', #
    601 => 'Retina', #
    567 => 'Mr Parker', #
    566 => 'Atlantic', #
    459 => 'Vantage', #
    652 => 'Startup', #theme lỗi
    801 => 'Flow', #
    732 => 'Canopy', #
    865 => 'Avenue', #ko có theme
    718 => 'Grid', #
    849 => 'Modular', #
    842 => 'Split', #
    863 => 'Boost', #
    464 => 'Mobilia', #
    677 => 'Showcase', #
    57 => 'Sunrise', #
    450 => 'Masonry', #
    793 => 'Launch', #
    846 => 'Loft', #
    705 => 'Pacific', #
    826 => 'Handy', #
    859 => 'Cascade', #
    856 => 'Artisan', #
    587 => 'Providence', #
    725 => 'Kingdom', #
    816 => 'Trademark', #
    757 => 'Colors', #
    765 => 'Maker', #
    773 => 'Label', #ko có theme
    777 => 'Palo Alto', #
    864 => 'Story', #ko có theme
    747 => 'Kagami', #
    833 => 'Local', #cài app vào ko add class "theme_store_id"
    790 => 'Ira', #ko mở được submenu trên mobile
    853 => 'Reach', #
    851 => 'Galleria', #theme lỗi
    812 => 'Capital', #
    808 => 'Vogue', #
    827 => 'Editorial', #ko có theme
    457 => 'Editions', #
    657 => 'Alchemy', #
    230 => 'Expression', #
    691 => 'California', #
    714 => 'Focal', #
    798 => 'Lorenza' #
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
    $themes = $restAPI->Theme->get(['fields' => 'id,name,theme_name,role,theme_store_id', 'role' => 'main,unpublished']);
    return $themes;
  }

  public function getMainTheme()
  {
    $restAPI = $this->getRestAPI();
    $main = $restAPI->Theme->get(['fields' => 'id,name,theme_name,role,theme_store_id', 'role' => 'main']);
    return $main;
  }

  public function products(){
    return $this->hasMany('App\Product');
  }

  public function getThemeInfo($theme)
  {
    if (empty($theme['theme_store_id'])) {
      $restAPI = $this->getRestAPI();
      $schema = $restAPI->Theme($theme['id'])->Asset()->get(['asset[key]' => 'config/settings_schema.json', 'fields' => 'value']);
      $schema = json_decode($schema['asset']['value'], true);
        if (isset($schema[0]['name']) && $schema[0]['name'] == 'theme_info') {
          if (!empty($schema[0]['theme_name'])) {
          $theme['theme_name'] = $schema[0]['theme_name'];
            foreach ($this->themes as $theme_store_id => $name) {
              if (strpos($theme['theme_name'], $name) !== FALSE) {
                $theme['theme_store_id'] = $theme_store_id;
              break;
              }
            }
            if (!empty($schema[0]['theme_version'])) {
              $theme['theme_version'] = $schema[0]['theme_version'];
            }
          } elseif (isset($schema[0]['settings'])) {
            foreach ($schema[0]['settings'] as $value) {
              if ($value['type'] == 'header') {
                foreach ($this->themes as $theme_store_id => $name) {
                  if (isset($value['content']) && strpos($value['content'], $name) !== FALSE) {
                    $theme['theme_name'] = $name;
                    $theme['theme_store_id'] = $theme_store_id;
                    break 2;
                  }
                }
              } else {
                foreach ($this->themes as $theme_store_id => $name) {
                  if (isset($value['content']) && strpos($value['content'], $name) !== FALSE) {
                    $theme['theme_name'] = $name;
                    $theme['theme_store_id'] = $theme_store_id;
                    break 2;
                  }
                }
              }
            }
          }
        } elseif (isset($schema[0]['settings'])) {
          foreach ($schema[0]['settings'] as $value) {
            foreach ($this->themes as $theme_store_id => $name) {
              if (isset($value['content']) && strpos($value['content'], $name) !== FALSE) {
                $theme['theme_name'] = $name;
                $theme['theme_store_id'] = $theme_store_id;
                break 2;
              }
          }
        }
      }
    }
  return $theme;
  }
}
