<?php 
  $settings = json_decode($shop->settings)->settings;
  $addedToWishlistButtonColor = $settings->added_wishlist_button_color;
  $addToWishlistButtonColor = $settings->add_wishlist_button_color;
  $translation = json_decode($shop->settings)->translation;
  $addToCart = $translation->add_to_cart;
  $addedToCart = $translation->added_to_cart;
  $addToWishlist = $translation->add_to_wishlist;
  $addedToWishlist = $translation->added_to_wishlist;
  $price = $translation->price;
  $title = $translation->title;
  $action = $translation->action;
  $field = json_decode($shop->settings)->field;
  $isDisplayImage = $field->isDisplayImage == true ? "" : "none";
  $isDisplayTitle = $field->isDisplayTitle == true ? "" : "none";
  $isDisplayPrice = $field->isDisplayPrice == true ? "" : "none";
  $isDisplayAction = $field->isDisplayAction == true ? "" : "none";
?>

var table = '<table class="table table-hover"><thead><tr><th style="display: {{$isDisplayImage}}">Image</th><th style="display: {{$isDisplayTitle}}">{{$title}}</th><th style="display: {{$isDisplayPrice}}">{{$price}}</th><th style="display: {{$isDisplayAction}}">{{$action}}</th></tr></thead><tbody id="wishproductlist"></tbody></table>'
    $('#table_wishlist').append(table);
    $('.add_to_wishlist_icon_label button.add_to_wishlist').html('<i class="far fa-heart mr-10"></i>{{$addToWishlist}}');
    $('.add_to_wishlist_label button.add_to_wishlist').html('{{$addToWishlist}}');

// wishlist
$(document).on('click','.add_to_wishlist',function(e){
    e.preventDefault();
    var pro_handle = $(this).attr('data-handle');
    var customer_id = $(this).attr('data-customerId');
    var customer_email = $(this).attr('data-customerEmail');
    var shop_url = $(this).attr('data-shopUrl').slice(8);
    if(globoWishlistConfig.customerId !== ""){
      const product = {
        customer_id : globoWishlistConfig.customerId,
        customer_email : globoWishlistConfig.customerEmail,
        product : pro_handle,
        type : 'wishlist',
        shop_url: globoWishlistConfig.shopUrl
      };
      $.ajax({
        url : globoWishlistConfig.api+"add",
        type : "post",
        data : product
      }).done(function(success){
          var label = $('#buttonAddToWishlistLabel'+pro_handle);
          var icon = $('#buttonAddToWishlistIcon'+pro_handle);
          var icon_label = $('#buttonAddToWishlistIconLabel'+pro_handle);
        if(success.message === "Success: You have added the products"){
          icon.html('<i class="fas fa-heart"></i>');
          label.css('background-color','{{$addedToWishlistButtonColor}}');
          icon_label.css('background-color','{{$addedToWishlistButtonColor}}');
          icon.css('color','{{$addedToWishlistButtonColor}}');
          icon_label.html('<i class="fas fa-heart mr-10"></i>{{$addedToWishlist}}');
          label.html('{{$addedToWishlist}}');
        }else{
          $.ajax({
            url : globoWishlistConfig.api+"remove",
            type : "post",
            data : product
          }).done(function(success){
            icon.html('<i class="far fa-heart"></i>');
            label.css('background-color','{{$addToWishlistButtonColor}}');
            icon_label.css('background-color','{{$addToWishlistButtonColor}}');
            icon.css('color','{{$addToWishlistButtonColor}}');
            icon_label.html('<i class="far fa-heart mr-10"></i>{{$addToWishlist}}');
            label.html('{{$addToWishlist}}');
          });
        }
      });
    }else{
      alert("You must login before add to wishlist");
    }
  });
$(document).on('click', '.removeInWishlist', function(){
  var pro_handle = $(this).attr('data-handle');
  var customer_id = $(this).attr('data-customerId');
  var customer_email = $(this).attr('data-customerEmail');
  var shop_url = $(this).attr('data-shopUrl').slice(8);
  const product = {
    product : pro_handle,
    customer_id : globoWishlistConfig.customerId,
    customer_email : globoWishlistConfig.customerEmail,
    type : 'wishlist',
    shop_url: globoWishlistConfig.shopUrl
  };
  $.ajax({
    url : globoWishlistConfig.api+"remove",
    type : "post",
    data : product
  }).done(function(success){
    alert(success.message);
    location.reload();
  });
});

// recently_viewed    
if(localStorage.getItem('recently_viewed') == null){
  var recently_viewed = [];
  localStorage.setItem('recently_viewed',JSON.stringify(recently_viewed));
}


$(document).on('click','.goToProductDetail',function(){
  var pro_handle = $(this).attr('data-handle');
  const product = {
    shop_url : globoWishlistConfig.shopUrl,
    customer_id : globoWishlistConfig.customerId,
    customer_email : globoWishlistConfig.customerEmail,
    product : pro_handle,
    type : 'recently_viewed'
  };
  if(globoWishlistConfig.customerId !== ""){
    $.ajax({
      url : globoWishlistConfig.api+"add",
      type : "post",
      data : product
    }).done(function(success){
    });
  }else{
    recently_viewed = JSON.parse(localStorage.getItem('recently_viewed'));
    if(recently_viewed.indexOf(product)=== -1){
      recently_viewed.push(product);
      localStorage.setItem('recently_viewed',JSON.stringify(recently_viewed));
    }
  }
});

if(globoWishlistConfig.customerId!=null){
      jQuery.getJSON(globoWishlistConfig.api+"getRecentlyViewed/"+globoWishlistConfig.shopUrl+"/"+globoWishlistConfig.customerId,function(data){
        recently_viewed = data.products;
        for(var i=0;i<recently_viewed.length;i++){
          jQuery.getJSON('/products/'+recently_viewed[i].product_handle+'.js', function(product) {
            var item = '<li class="mt-20"><div style="display: flex; flex-direction: row"><div class="width25"><img class="imgProductWishlist" id="pro'+product.id+'_img_1" src="'+product.images[0]+'"/></div><div class="width50"><h5>'+product.title+'</h5></div><div class="width25"><p>'+product.price+'</p></div></div></li>';
            $('#collectionRecentlyViewedlist').append(item);
          } );
        }
      });
}else{
      recently_viewed  = JSON.parse(localStorage.getItem('recently_viewed'));
      for(var i=0;i<recently_viewed.length;i++){
        for(var j=0;j<all_products.length;j++){
        if(recently_viewed[i] === all_products[j].product_handle){
           var product = '<li class="mt-20"><div style="display: flex; flex-direction: row"><div class="width25"><img class="imgProductWishlist" id="pro'+all_products[j].product_id+'_img_1" src="'+all_products[j].product_image+'"/></div><div class="width50"><h5>'+all_products[j].product_title+'</h5></div><div class="width25"><p>'+all_products[j].product_price+'</p></div></div></li>';
                    $('#collectionRecentlyViewedlist').append(product);
      }
      }
  	}
}
    var products = [];
    jQuery.getJSON(globoWishlistConfig.api+"select/"+globoWishlistConfig.shopUrl+"/"+globoWishlistConfig.customerId,function(data){
      products = data.products;
      if(products.length > 0){
        for(var i=0;i<products.length;i++){
          jQuery.getJSON('/products/'+products[i].product_handle+'.js', function(product) {
            jQuery.getJSON('/cart.js', function(carts) {
              var textToCart = null;
              carts.items.forEach(function callback(cart){
                textToCart = cart.handle != product.handle ? '{{$addToCart}}' : '{{$addedToCart}}';
            });
            var item = '<tr><td style="display: {{$isDisplayImage}}"><img class="imgProductWishlist" id="'+product.handle+'_img_1" src="'+product.images[0]+'"/></td><td style="display: {{$isDisplayTitle}}">'+product.title+'</td><td style="display: {{$isDisplayPrice}}">'+product.price+'</td><td style="display: {{$isDisplayAction}}"><button data-variantId="'+product.variants[0].id+'" class="addToCartInWishlist mr-10">'+textToCart+'</button><button type="button" data-shopUrl="'+globoWishlistConfig.shopUrl+'" data-handle="'+product.handle+'" data-customerId="'+globoWishlistConfig.customerId+'" data-customerEmail="'+globoWishlistConfig.customerEmail+'"class="removeInWishlist">REMOVE</button></td></tr>'
            $('#wishproductlist').append(item);
            $('.add_to_wishlist_icon_label button#buttonAddToWishlistIconLabel'+product.handle).html('<i class="fas fa-heart mr-10"></i>{{$addedToWishlist}}');
            $('.add_to_wishlist_label button#buttonAddToWishlistLabel'+product.handle).html('{{$addedToWishlist}}');
            var label = $('#buttonAddToWishlistLabel'+product.handle);
            var icon = $('#buttonAddToWishlistIcon'+product.handle);
            var icon_label = $('#buttonAddToWishlistIconLabel'+product.handle);
            icon.html('<i class="fas fa-heart"></i>');
            icon_label.html('<i class="fas fa-heart mr-10"></i>{{$addedToWishlist}}');
            label.html('{{$addedToWishlist}}');
            label.css('background-color','{{$addedToWishlistButtonColor}}');
            icon_label.css('background-color','{{$addedToWishlistButtonColor}}');
            icon.css('color','{{$addedToWishlistButtonColor}}');
          });
        } );
        }
    	}
    });

    $(document).on('click', '.addToCartInWishlist', function(){
      var pro_handle = $(this).attr('data-handle');
      var variant_id = $(this).attr('data-variantId');
      jQuery.post('/cart/add.js', {
        items: [
          {
            quantity: 1,
            id: variant_id
          }
        ]
      }).done(function(){
        $(this).text("{{$addedToCart}}");
      });
    });