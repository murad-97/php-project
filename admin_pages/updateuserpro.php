<?php
include("connectdata.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];


    $update = "UPDATE  users SET name='$name',address='$address',phone='$phone' WHERE id=$_GET[id]";

    $updatein = $conn->prepare($update);
    $pdo = $updatein->execute();
print_r($pdo);
header("location:profile.php");
exit();

}

?>