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
  $button_wishlist = $settings->button_wishlist;
?>

var table = '<table class="table table-hover"><thead><tr><th style="display: {{$isDisplayImage}}">Image</th><th style="display: {{$isDisplayTitle}}">{{$title}}</th><th style="display: {{$isDisplayPrice}}">{{$price}}</th><th style="display: {{$isDisplayAction}}">{{$action}}</th></tr></thead><tbody id="wishproductlist"></tbody></table>';
var addToWishlist = '{{$addToWishlist}}';
    $('#table_wishlist').append(table);
    $('.add_to_wishlist_icon_label button.add_to_wishlist').html('<i class="far fa-heart mr-10"></i>{{$addToWishlist}}');
    $('.add_to_wishlist_label button.add_to_wishlist').html('{{$addToWishlist}}');
var url_page = location.href;
var product_handle = url_page.slice(url_page.lastIndexOf("/")+1);
var icon = '<div><button type="button" id="buttonAddToWishlistIcon'+product_handle+'" class="add_to_wishlist_icon add_to_wishlist" data-button="icon" data-handle='+product_handle+'><i class="far fa-heart"></i></button></i></div>';
var label = '<div><button type="button" id="buttonAddToWishlistLabel'+product_handle+'" class="add_to_wishlist_label add_to_wishlist" data-button="label"  data-handle='+product_handle+'>'+addToWishlist+'</button></div>';
var icon_label = '<div><button type="button" id="buttonAddToWishlistIconLabel'+product_handle+'" class="add_to_wishlist_icon_label add_to_wishlist" data-button="icon_label" data-handle='+product_handle+'><i class="far fa-heart" style="margin-right: 5px"></i>'+addToWishlist+'</button></div>';
var addwishlist_button = <?php
    if($button_wishlist == "icon"){
      echo 'icon';
    }else if($button_wishlist == "label"){
      echo 'label';
    }else{
      echo 'icon_label';
    }
 ?>;
// wishlist

var symbol_wishlist = '<div class="wishlist_module"><div class="wl_icon"><i class="fas fa-heart"></i></div><div class="wl_label"><p>Wishlist</p></div></div>';
$('body').append(symbol_wishlist);
var module_wishlist = '<div class="wl-overlayout"></div><div class="gl-wishlist"><div class="gl-header"><button class="close-gl-wishlist"><i class="fas fa-times"></i></button><p>List product</p></div><div class="gl-body"></div></div>';
$('body').append(module_wishlist);
var message_wishlist = '<div class="gl-wishlist-message"><div class="gl-message-header">Add successful</div><div class="gl-message-body"><div class="gl-image"><img src="//cdn.shopify.com/s/files/1/0266/3566/5511/products/pro3_300x300.jpg?v=1571821808"/></div><div class="gl-info"><p class="gl-title">Product title</p><p class="gl-price">Product price</p></div></div><button class="close-message-wishlist"><i class="fas fa-times"></i></button></div>';
$('body').append(message_wishlist);
$('.wishlist_module').click(function(){
  $('.gl-wishlist').animate({
    right: '0',
  });
  $('.wl-overlayout').css({
    display:'block',
  });
});
$('.close-gl-wishlist').click(function(){
  $('.gl-wishlist').animate({
    right: '-25%',
  });
  $('.wl-overlayout').css({
    display:'none',
  });
});
$('.close-message-wishlist').click(function(){
  $('.gl-wishlist-message').animate({
    bottom: '-200px',
  });
});


<?php 
  if($theme['theme_store_id']==796){
    echo '$(".product-form__item--submit").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid__item>.grid-view-item>a.grid-view-item__link");';
  }elseif($theme['theme_store_id']==578){
    echo '$(".grid__item .product-single__cart-submit-wrapper").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid>.grid__item>.supports-js>a.product__image-wrapper");';
  }elseif($theme['theme_store_id']==766){
    echo '$(".grid__item .product__form--add-to-cart").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".product-item>.product-item__link-wrapper>a.product-item__link");';
  }elseif($theme['theme_store_id']==775){
    echo '$(".product-form .product-form__item--submit").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid__item>a.product-card");';
  }elseif($theme['theme_store_id']==679){
    echo '$(".addToCartForm .payment-buttons").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid-item>a.product-grid-item");';
  }elseif($theme['theme_store_id']==829){
    echo '$(".product__form-wrapper .product-form").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid__item>.card>a.card__wrapper");';
  }elseif($theme['theme_store_id']==730){
    echo '$(".product-single__meta .product-single__form").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid__item>div.grid-product__wrapper>div.grid-product__image-wrapper>a.grid-product__image-link");';
  }elseif($theme['theme_store_id']==380){
    echo '$(".product-single .product-form--wide").append(addwishlist_button);';
    echo 'var item_in_prolist = $(".grid__item>div>a.grid-link");';
  }
?>
item_in_prolist.each(function(ele){
  var href_pro_productlist = $(this).attr("href");
  var pro_handle_in_listproduct = href_pro_productlist != null ? href_pro_productlist.slice(href_pro_productlist.lastIndexOf("/")+1) : "";
  $(this).parent().append('<button id="buttonAddToWishlistIcon'+pro_handle_in_listproduct+'" class="add_to_wishlist add_wishlist_product_list" data-button="icon" data-handle="'+pro_handle_in_listproduct+'"><i class="far fa-heart"></i></button>');
})

$(document).on('click','.add_to_wishlist',function(e){
    e.preventDefault();
    var pro_handle = $(this).attr('data-handle');
    var customer_id = globoWishlistConfig.customerId;
    var customer_email = globoWishlistConfig.customerEmail;
    var shop_url = globoWishlistConfig.shopUrl;
    if(globoWishlistConfig.customerId !== null){
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
          jQuery.getJSON('/products/'+pro_handle+'.js',function(product){
            $('.gl-wishlist-message .gl-message-body .gl-info .gl-title').html(product.title);
            $('.gl-wishlist-message .gl-message-body .gl-info .gl-price').html(product.price);
            $('.gl-wishlist-message .gl-message-body .gl-image img').attr('src',product.featured_image);
            var item1 = '<li id='+"item-"+product_handle+' class="gl-item"> <div class="item-image"> <img src="'+product.featured_image+'"/> </div><div class="item-title">'+product.title+'</div></li>';
            $('.gl-body').append(item1);
          })
          $('.gl-wishlist-message').animate({
            bottom: '5px',
          });
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
            $('#item-'+pro_handle).remove();
          });
        }
      });
    }else{
      var label = $('#buttonAddToWishlistLabel'+pro_handle);
      var icon = $('#buttonAddToWishlistIcon'+pro_handle);
      var icon_label = $('#buttonAddToWishlistIconLabel'+pro_handle);
      wishlist = JSON.parse(localStorage.getItem('wishlist')) != null ? JSON.parse(localStorage.getItem('wishlist')) : [];
      if(wishlist.indexOf(pro_handle) == -1){
        wishlist.push(pro_handle);
        icon.html('<i class="fas fa-heart"></i>');
        label.css('background-color','#bd10e0');
        icon_label.css('background-color','#bd10e0');
        icon.css('color','#bd10e0');
        icon_label.html('<i class="fas fa-heart mr-10"></i>{{$addToWishlist}}');
        label.html('{{$addToWishlist}}');
        jQuery.getJSON('/products/'+pro_handle+'.js',function(product){
          $('.gl-wishlist-message .gl-message-body .gl-info .gl-title').html(product.title);
          $('.gl-wishlist-message .gl-message-body .gl-info .gl-price').html(product.price);
          $('.gl-wishlist-message .gl-message-body .gl-image img').attr('src',product.featured_image);
          var item1 = '<li id='+"item-"+product_handle+' class="gl-item"> <div class="item-image"> <img src="'+product.featured_image+'"/> </div><div class="item-title">'+product.title+'</div></li>';
          $('.gl-body').append(item1);
        })
        $('.gl-wishlist-message').animate({
          bottom: '5px',
        });
      }else{
        wishlist.splice(wishlist.indexOf(pro_handle),1);
        icon.html('<i class="far fa-heart"></i>');
        label.css('background-color','#f8e71c');
        icon_label.css('background-color','#f8e71c');
        icon.css('color','#f8e71c');
        icon_label.html('<i class="far fa-heart mr-10"></i>{{$addToWishlist}}');
        label.html('{{$addToWishlist}}');
        $('#item-'+pro_handle).remove();
      }
      localStorage.setItem('wishlist',JSON.stringify(wishlist));
    }
  });
$(document).on('click', '.removeInWishlist', function(){
  var pro_handle = $(this).attr('data-handle');
  var customer_id = globoWishlistConfig.customerId;
  var customer_email = globoWishlistConfig.customerEmail;
  var shop_url = globoWishlistConfig.shopUrl;
  const product = {
    product : pro_handle,
    customer_id : globoWishlistConfig.customerId,
    customer_email : globoWishlistConfig.customerEmail,
    type : 'wishlist',
    shop_url: globoWishlistConfig.shopUrl
  };
  if(customer_id == null){
    wishlist  = JSON.parse(localStorage.getItem('wishlist'));
    var index = wishlist.indexOf(pro_handle);
    wishlist.splice(index,1);
    localStorage.setItem('wishlist',JSON.stringify(wishlist));
    $($($(this).parent()).parent()).remove();
  }else{
    $.ajax({
      url : globoWishlistConfig.api+"remove",
      type : "post",
      data : product
    }).done(function(success){
      alert(success.message);
      location.reload();
    });
  }
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
        jQuery.getJSON("/products/"+recently_viewed[i].product_handle+".js", function(product) {
          var item = '<li class="mt-20"><div style="display: flex; flex-direction: row"><div class="width25"><img class="imgProductWishlist" id="pro'+product.id+'_img_1" src="'+product.images[0]+'"/></div><div class="width50"><h5>'+product.title+'</h5></div><div class="width25"><p>'+product.price+'</p></div></div></li>';
          $('#collectionRecentlyViewedlist').append(item);
        } );
      }
}
    var products = [];
    if(globoWishlistConfig.customerId !== null){
      var wishlist = JSON.parse(localStorage.getItem('wishlist'));
      for(var i=0;i<wishlist.length;i++){
        const product = {
          shop_url : globoWishlistConfig.shopUrl,
          customer_id : globoWishlistConfig.customerId,
          customer_email : globoWishlistConfig.customerEmail,
          product : wishlist[i],
          type : 'wishlist'
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
            label.css('background-color','#bd10e0');
            icon_label.css('background-color','#bd10e0');
            icon.css('color','#bd10e0');
            icon_label.html('<i class="fas fa-heart mr-10"></i>{{$addedToCart}}');
            label.html('{{$addedToCart}}');
          }else{
            $.ajax({
              url : globoWishlistConfig.api+"remove",
              type : "post",
              data : product
            }).done(function(success){
              icon.html('<i class="far fa-heart"></i>');
              label.css('background-color','#f8e71c');
              icon_label.css('background-color','#f8e71c');
              icon.css('color','#f8e71c');
              icon_label.html('<i class="far fa-heart mr-10"></i>{{$addToCart}}');
              label.html('{{$addToCart}}');
            });
          }
        });
      }
      localStorage.setItem('wishlist','[]');
    jQuery.getJSON(globoWishlistConfig.api+"select/"+globoWishlistConfig.shopUrl+"/"+globoWishlistConfig.customerId,function(data){
      products = data.products;
      if(products.length > 0){
        for(var i=0;i<products.length;i++){
          jQuery.getJSON('/products/'+products[i].product_handle+'.js', function(product) {
            jQuery.getJSON('/cart.js', function(carts) {
              var textToCart = globoWishlistConfig.carts_items.indexOf(product.id) != -1 ? '{{$addedToWishlist}}' : '{{$addToWishlist}}';
              var item = '<tr><td style="display: {{$isDisplayImage}}"><img class="imgProductWishlist" id="'+product.handle+'_img_1" src="'+product.images[0]+'"/></td><td style="display: {{$isDisplayTitle}}">'+product.title+'</td><td style="display: {{$isDisplayPrice}}">'+product.price+'</td><td style="display: {{$isDisplayAction}}"><button data-variantId="'+product.variants[0].id+'" class="addToCartInWishlist mr-10">'+textToCart+'</button><button type="button" data-shopUrl="'+globoWishlistConfig.shopUrl+'" data-handle="'+product.handle+'" data-customerId="'+globoWishlistConfig.customerId+'" data-customerEmail="'+globoWishlistConfig.customerEmail+'"class="removeInWishlist">REMOVE</button></td></tr>';
              $('#wishproductlist').append(item);
              var item1 = '<li id='+"item-"+product.handle+' class="gl-item"> <div class="item-image"> <img src="'+product.images[0]+'"/> </div><div class="item-title">'+product.title+'</div></li>';
              $('.gl-body').append(item1);
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
  }else{
    var wishlist = JSON.parse(localStorage.getItem('wishlist'));
      for(var i=0;i<wishlist.length;i++){
        jQuery.getJSON('/products/'+wishlist[i]+'.js', function(product) {
            var textToCart = globoWishlistConfig.carts_items.indexOf(product.id) != -1 ? '{{$addedToCart}}' : '{{$addToCart}}';
            var item = '<tr><td style="display: "><img class="imgProductWishlist" id="'+product.handle+'_img_1" src="'+product.images[0]+'"/></td><td style="display: ">'+product.title+'</td><td style="display: ">'+product.price+'</td><td style="display: "><button data-variantId="'+product.variants[0].id+'" class="addToCartInWishlist mr-10">'+textToCart+'</button><button type="button" data-shopUrl="'+globoWishlistConfig.shopUrl+'" data-handle="'+product.handle+'" data-customerId="'+globoWishlistConfig.customerId+'" data-customerEmail="'+globoWishlistConfig.customerEmail+'"class="removeInWishlist">REMOVE</button></td></tr>';
            var item1 = '<li id='+"item-"+product.handle+' class="gl-item"> <div class="item-image"> <img src="'+product.images[0]+'"/> </div><div class="item-title">'+product.title+'</div></li>';
            $('#wishproductlist').append(item);
            $('.gl-body').append(item1);
            $('.add_to_wishlist_icon_label button#buttonAddToWishlistIconLabel'+product.handle).html('<i class="fas fa-heart mr-10"></i>{{$addedToCart}}');
            $('.add_to_wishlist_label button#buttonAddToWishlistLabel'+product.handle).html('{{$addedToCart}}');
            var label = $('#buttonAddToWishlistLabel'+product.handle);
            var icon = $('#buttonAddToWishlistIcon'+product.handle);
            var icon_label = $('#buttonAddToWishlistIconLabel'+product.handle);
            icon.html('<i class="fas fa-heart"></i>');
            icon_label.html('<i class="fas fa-heart mr-10"></i>{{$addedToCart}}');
            label.html('{{$addedToCart}}');
            label.css('background-color','#bd10e0');
            icon_label.css('background-color','#bd10e0');
            icon.css('color','#bd10e0');
          } );
      }
  }

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