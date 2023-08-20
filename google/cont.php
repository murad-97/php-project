<?php 
require_once('../google-api/vendor/autoload.php');
include 'config.php';
include 'cont.class.php';

if (isset($_GET['code'])) {
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
} else {
    header('Location: ./pages/signin.php');
    exit();
}

if (isset($token["error"]) != "invalid_grant") {
    // Get data from Google
    $oAuth = new Google_Service_Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();

    // Insert data in the database
    $Controller = new Controller;
    echo $Controller->insertUserData(
        array(
            'email' => $userData['email'],
            'name' => $userData['name']
        )
    );
} else {
    header('Location: ./pages/signin.php');
    exit();
}
?>
