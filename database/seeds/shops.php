<?php

use Illuminate\Database\Seeder;

class shops extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'url'=>'globo-development-store.myshopify.com',
            'token'=>'c28d19caf249889967611c91d247d4b9',
            'email'=>'',
            'settings'=>'{"settings":{"goToCart":true,"limit_wishlist_products_status":true,"max_wishlist_products":"5","button_wishlist":"icon","add_wishlist_button_color":"FF4500","added_wishlist_button_color":"FF4500"},"field":{"isDisplayImage": true,"isDisplayTitle": true,"isDisplayPrice": true,"isDisplayAvailability": true,"isDisplayAction": true},"translation":{"add_to_wishlist":"Add to wishtlist","added_to_wishlist":"Added to wishlist","title":"PRODUCT NAME","price":"PRICE","action":null,"read_more":"Read more","select_options":"Select options","add_to_cart":"Add to cart","added_to_cart":"Added to cart","availability":"STOCK STATUS","in_stock":"In stock","out_of_stock":"Out of stock","empty":"Empty Wishlist"}}'
        ]);
    }
}
