<?php

include("connectdata.php");


/////update
if (isset($_GET["id"])) {

    $name_category = $_POST["name"];


    ///////main_image///////////////////////

    $main_image_category = $_FILES["main-image"]["name"];
    $main_tmp = $_FILES["main-image"]["tmp_name"];
    $main_size = $_FILES["main-image"]["size"];



    // print_r($name);
    // print_r($category);
    // print_r($price);
    // print_r($description);

    // print_r($main_image);
    // print_r($image_name1);
    // print_r($image_name2);
    // print_r($image_name3);

    $update = "UPDATE  category SET name='$name_category',picture='$main_image_category' WHERE id=$_GET[id]";

    $updatein = $conn->prepare($update);
    $pdo = $updatein->execute();

    
    header("location: categories.php");
    exit();
}


?>