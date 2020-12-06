<?php

// Detail Produk
// Jumlah minimal $0.05 US
$productName = "Demo Product";
$productID = "DP12345";
$productPrice = 35;
$currency = "aud"; // Australian Dollar

// Mengubah harga, dari usd ke cent
$stripeAmount = round($productPrice * 100, 2);

// Pengaturan Stripe API
define('STRIPE_API_KEY', 'sk_test_51HuCM2FmAjoNgprYRQPvpS56dv8VWBhbJuMsryP9RB7TGHY8xnsr5OWWkkgatjaLdm24C9HhsuNBwQKhLNl7KCBm00ABzVZghm');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51HuCM2FmAjoNgprYbnxW6X7WgUbgdYmwkM7UMwPJzEypu0AxXp5k4BAZgtbxzu64IeEsBt8r4hYS3WmIkJIs7iJz00ZquXbIrH');
define('STRIPE_SUCCESS_URL', 'http://localhost/Learning/StripePayment/success.php');
define('STRIPE_CANCEL_URL', 'http://localhost/Learning/StripePayment/cancel.php');

// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'kautsaralbana');
define('DB_PASSWORD', 'ucayy');
define('DB_NAME', 'db_stripe-php');
