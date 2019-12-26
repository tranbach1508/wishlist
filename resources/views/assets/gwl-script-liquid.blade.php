<?php 
  $settings = json_decode($shop->settings)->settings;
  $limit_wishlist_products_status =  $settings->limit_wishlist_products_status == false ? "false" : "true";
  $max_wishlist_products = (int) $settings->limit_wishlist_products;
?>
<?php echo "{{ 'globo.wishlist_app.scss.css' | asset_url | stylesheet_tag }}"; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css" >
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
  var globoWishlistConfig = {
    api: 'http://localhost:88/wishlist_app/public/api/',
    customerId: {% if customer %}<?php echo'"{{customer.id}}"' ?>{% else %}null{% endif %},
    customerEmail: {% if customer %}<?php echo'"{{customer.email}}"' ?>{% else %}null{% endif %},
    shopUrl: <?php echo'{{shop.permanent_domain | json}}' ?>,
    max_wishlist_products : {{$limit_wishlist_products_status}} === true ? {{$max_wishlist_products}} : 0,
  }
</script>
<script src=<?php echo '"{{ "globo.wishlist_app.js" | asset_url}}"'; ?> defer="defer"></script>

