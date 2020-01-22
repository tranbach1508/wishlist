
<?php 
  $settings = json_decode($shop->settings)->settings;
  $addToWishlistButtonColor = $settings->add_wishlist_button_color;
  $button_wishlist = $settings->button_wishlist;
?>
$removeButtonColor : #BD10E0;
$addToCartButtonColor: #FF4500;
$addToWishlistButtonColor: {{$addToWishlistButtonColor}};
{%- assign button_wishlist = "{{$button_wishlist}}"-%}
{% if button_wishlist == "icon"%}
.add_to_wishlist_icon{
  display: block;
}
.add_to_wishlist_icon_label{
  display: none;
}
.add_to_wishlist_label{
  display: none;
}
.product-element .after_hover .right .icons{
  display: flex;
  flex-direction: row ;
}
{%endif%}
{% if button_wishlist == "icon_label"%}
.add_to_wishlist_icon{
  display: none;
}
.add_to_wishlist_icon_label{
  display: block;
}
.add_to_wishlist_label{
  display: none;
}
{%endif%}
{% if button_wishlist == "label"%}
.add_to_wishlist_icon{
  display: none;
}
.add_to_wishlist_icon_label{
  display: none;
}
.add_to_wishlist_label{
  display: block;
}
{%endif%}
.imgProductWishlist{
  width: 100px;
}
.addToCartInWishlist{
  background-color: $addToCartButtonColor;
  color: #ffffff;
  height: 40px;
  padding: 0 20px;
  border: none;
}
.removeInWishlist{
  background-color: $removeButtonColor;
  color: #ffffff;
  height: 40px;
  padding: 0 20px;
  border: none;
}
.add_to_wishlist_icon{
    color: $addToWishlistButtonColor;
    background-color: white;
    border: none;
}
.product-element .after_hover .right .add_to_wishlist_label button,
.product-element .after_hover .right .add_to_wishlist_icon_label button,
.Wishlist .add_to_wishlist_label button,
.Wishlist .add_to_wishlist_icon_label button
{
  background-color: $addToWishlistButtonColor ;
  color: white !important;
  height: auto !important;
}
.width25{
  width: 25%;
}
.width50{
  width: 50%;
}
.mt-20{
  margin-top: 20px;
}
.add_to_wishlist_label,.add_to_wishlist_icon_label{
  height: 40px;
  color: white;
  padding: 0 20px;
  border: none;
  background-color: $addToWishlistButtonColor;
}
.wishlist_module{
  z-index: 9;
  display: flex;
  flex-direction: row;
  position: fixed;
  top: 50%;
  right: -30px;
  border: none;
  transform: rotate(-90deg);
  background: white;
  height: 50px;
  width: 124px;
  padding: 10px;
  border-top-right-radius: 20px;
  border-top-left-radius: 20px;
  cursor: pointer;
}
.wishlist_module .wl_icon{
  height: 30px;
  width: 30px;
  background: red;
  border-radius: 50%;
  position: relative;
  margin-right: 5px;
}
.wishlist_module .wl_icon i{
  color: white;
  position: absolute;
  top: 8px;
  left: 6px;
  font-size: 16px;
}
.wishlist_module .wl_label{
  font-family: Montserrat,sans-serif;
  font-weight: bold;
  line-height: 30px;
}
.gl-wishlist{
  background: white;
  z-index:9;
    width: 25%;
    height: 100%;
    position: fixed;
    top: 0;
    right: -25%;
}
.gl-wishlist .gl-header{
  background: lightgreen;
    padding: 5px 0;
    font-family: Montserrat,sans-serif;
    font-weight: normal;
}
.gl-wishlist .gl-header p{
  font-size: 30px;
    text-align: center;
    line-height: 45px;
}
.gl-wishlist .gl-body .gl-item{
  display: flex;
    flex-direction: row;
    border-bottom: 1px solid lightgreen;
}
.gl-wishlist .gl-body .gl-item .item-image{
  width: 100px;
}
.gl-wishlist .gl-body .gl-item .item-image img{
  max-width: 100px;
}
.gl-wishlist .gl-body .gl-item .item-title{
  line-height: 100px;
}
.close-gl-wishlist{
  right: 0;
  top: 0;
  z-index: 9999999;
  background: none;
  border: none;
  position: absolute;
}
.add_wishlist_product_list{
  border: none;
  background: none;
  font-size: 16px;
  position: absolute;
  top: 5px;
  right: 5px;
  display: none;
  color: $addToWishlistButtonColor;
}
.grid__item>div[class=""],.grid-uniform>.grid-item,.grid>.grid__item{
  position: relative;
}
.grid-view-item:hover .add_wishlist_product_list,.grid__item>div[class=""]:hover .add_wishlist_product_list,.grid__item>.grid-product__wrapper:hover .add_wishlist_product_list,.grid__item>.card:hover .add_wishlist_product_list,.grid-uniform>.grid-item:hover .add_wishlist_product_list,.grid>.grid__item:hover .add_wishlist_product_list{
  display: block;
  z-index: 99;
}
.gl-wishlist-message{
  position: fixed;
  bottom: -200px;
  right: 5px;
  height: 200px;
  width: 250px;
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
  background: gainsboro;
  border: red solid 1px;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
}
.gl-wishlist-message .gl-message-header{
  height: 50px;
    font-size: 24px;
    text-align: center;
    line-height: 50px;
    background: rebeccapurple;
    border-radius: inherit;
    color: white;
}
.gl-wishlist-message .gl-message-body{
  display: flex;
  flex-direction: row;
  background: white;
  height: 150px;
}
.gl-wishlist-message .gl-message-body .gl-image{
  width: 100px;
}
.gl-wishlist-message .gl-message-body .gl-image img{
  max-width: 100px;
}
.gl-wishlist-message .gl-message-body .gl-info{
  width: 150px;
}
.gl-wishlist-message .gl-message-body .gl-info .gl-title{
  font-weight: bold;
  font-size: 20px;
  margin-top: 15px;
  margin-bottom: 0px;
}
.gl-wishlist-message .gl-message-body .gl-info .gl-price{
  font-size: 14px;
  color: gray;
}
.gl-wishlist-message .close-message-wishlist{
  width: 30px;
  height: 30px;
  border: none;
  background: none;
  position: absolute;
  top: 5px;
  right: 5px;
  color: white;
}
.wl-overlayout{
  position: fixed;
  top:0;
  left: 0;
  width: 100%;
  height: 100%;
  background: black;
  opacity: 0.3;
  display: none;
}



