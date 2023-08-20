<?php 
require_once('../google-api/vendor/autoload.php');
$gClient= new Google_Client();
$gClient-> setClientId("22492113012-tviubb3vmchvbronggfqnt07ffvcacp2.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Vicode Media Login");
$gClient->setRedirectUri("http://localhost/PHP-Project/google/cont.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
// login URL
$login_url = $gClient->createAuthUrl();
?>