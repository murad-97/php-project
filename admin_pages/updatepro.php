 <?php
    include("connectdata.php");

 /////update
 if (isset($_GET["id"])) {


 $product_color = $_POST["product_color"];
 $specification = $_POST["specification"];
 $capacity = $_POST["capacity"];


 $name = $_POST["name"];

 $category = $_POST["category"];

 $price = $_POST["price"];

 $description = $_POST["description"];

 $status = $_POST["status"];
 ///////main_image///////////////////////

 $main_image = $_FILES["main-image"]["name"];
 $main_tmp = $_FILES["main-image"]["tmp_name"];
 $main_size = $_FILES["main-image"]["size"];

 ////////image one//////////////////////

 $image_name1 = $_FILES["image1"]['name'];
 $image_temp1 = $_FILES["image1"]['tmp_name'];
 $image_size1 = $_FILES["image1"]['size'];

 //////////image tow//////////////////

 $image_name2 = $_FILES["image2"]['name'];
 $image_temp2 = $_FILES["image2"]['tmp_name'];
 $image_size2 = $_FILES["image2"]['size'];

 //////////////image three///////////////

 $image_name3 = $_FILES["image3"]['name'];
 $image_temp3 = $_FILES["image3"]['tmp_name'];
 $image_size3 = $_FILES["image3"]['size'];

 // print_r($name);
 // print_r($category);
 // print_r($price);
 // print_r($description);

 // print_r($main_image);
 // print_r($image_name1);
 // print_r($image_name2);
 // print_r($image_name3);

 // Assuming $conn is your PDO connection object

// Define the update query with placeholders
$update = "UPDATE product SET category_id=:category, product_name=:name, discription=:description,
price=:price, status=:status, main_picture=:main_image, picture1=:image_name1,
picture2=:image_name2, picture3=:image_name3, product_color=:product_color,
specification=:specification, capacity=:capacity WHERE id=:id";

// Prepare the statement
$updateStmt = $conn->prepare($update);

// Bind parameters
$updateStmt->bindParam(':category', $category);
$updateStmt->bindParam(':name', $name);
$updateStmt->bindParam(':description', $description);
$updateStmt->bindParam(':price', $price);
$updateStmt->bindParam(':status', $status);
$updateStmt->bindParam(':main_image', $main_image);
$updateStmt->bindParam(':image_name1', $image_name1);
$updateStmt->bindParam(':image_name2', $image_name2);
$updateStmt->bindParam(':image_name3', $image_name3);
$updateStmt->bindParam(':product_color', $product_color);
$updateStmt->bindParam(':specification', $specification);
$updateStmt->bindParam(':capacity', $capacity);
$updateStmt->bindParam(':id', $_GET['id']); // Assuming id is passed via GET

// Execute the statement
$updateSuccess = $updateStmt->execute();

header("location: products.php");
exit();



 }