<?php

// Product Details
 
$itemNumber = "1";
$itemName = "demo";

$currency = "USD";

/* PayPal REST API configuration 
 * You can generate API credentials from the PayPal developer panel. 
 * See your keys here: https://developer.paypal.com/dashboard/ 
 */
define('PAYPAL_SANDBOX', TRUE); //TRUE=Sandbox | FALSE=Production 
define('PAYPAL_SANDBOX_CLIENT_ID', 'AeZrmEIAR12JdGD5c1DzdETO6he1KYurlJwWgrS2yykM1t6MYfZ9mQzZtgKs0aRO8rusB2duAJvfS6a4');
define('PAYPAL_SANDBOX_CLIENT_SECRET', 'EKF7UJ27XehPC0P1n7xtrw3DwCixFqlRsrkRbhbjLBuWkXjvc1kW9_u2rlfucyHcjSVLP2B2wGQ-j-pQ');
define('PAYPAL_PROD_CLIENT_ID', 'Insert_Live_PayPal_Client_ID_Here');
define('PAYPAL_PROD_CLIENT_SECRET', 'Insert_Live_PayPal_Secret_Key_Here');

// Database configuration  
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mobile_tech');

?>