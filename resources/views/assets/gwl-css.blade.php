
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

