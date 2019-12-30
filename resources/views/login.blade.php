<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Globo Recurring Charge Products - Globo Software Solution</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://sdks.shopifycdn.com/polaris/1.8.3/polaris.min.css" />
    <link rel="icon"
        href="https://i0.wp.com/mobilesearchready.com.au/wp-content/uploads/2018/04/subscription_icon.png?fit=330%2C330&ssl=1">
</head>

<body class="fresh-ui">
    <div id="app">
        <section class="content">
            <br /><br /><br />
            <div class="Polaris-Page">
                <div class="Polaris-Layout">
                    <div class="Polaris-Layout__Section">
                        <div class="Polaris-Card">
                            <div class="Polaris-Card__Header">
                                <h2 class="Polaris-Heading">Enter your store's URL</h2>
                            </div>
                            <div class="Polaris-Card__Section">
                                <form method="get" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="Polaris-FormLayout">
                                        <div class="Polaris-FormLayout__Item">
                                            <div class="Polaris-TextField">
                                                <input id="shop" value="" name="shop" class="Polaris-TextField__Input"
                                                    aria-labelledby="TextField1Label" aria-invalid="false">
                                                <div class="Polaris-TextField__Backdrop"></div>
                                            </div>
                                        </div>
                                        <div class="Polaris-FormLayout__Item">
                                            <div class="">
                                                <button type="submit"
                                                    class="Polaris-Button Polaris-Button--primary"><span
                                                        class="Polaris-Button__Content"><span>Login</span></span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
