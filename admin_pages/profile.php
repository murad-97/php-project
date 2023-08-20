<?php
include("connectdata.php");
include_once("header.php");

if (isset($_POST["name"])) {

  $name = $_POST["name"];

  $address = $_POST["address"];

  $phone = $_POST["phone"];


  $update = "UPDATE `users` SET name='$name', address='$address', phone='$phone'";

  $updatein = $conn->prepare($update);
  $pdo = $updatein->execute();
}
$pdo = $conn->prepare("SELECT id,name, email,password,role,address, phone FROM users where id = $_SESSION[userid]");

$pdo->execute();
$result = $pdo->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../build/css/profile.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">

  <title>Document</title>
</head>

<body>
  <section class=" row col-sm-12 m-auto">

    <div class="page-content page-container row col-sm-12 " id="page-content">
      <div class="mt-5 row-12 container col-sm-12 w-full ">
        <div class="row container col-sm-12   ">
          <div class=" col-sm-12 row-12">
            <div class="card user-card-full ">
              <div class="row m-l-0 m-r-0">
                <div class="col-sm-12 bg-c-lite-green user-profile">
                  <div class="card-block text-center text-white">
                    <div class="m-b-25">
                      <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                    </div>
                    <h6 class="f-w-600"><?PHP print_r($result[0]["name"])   ?></h6>
                    
                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                  </div>
                </div>
                <div class="col-sm-12 row-12 mb-4 mt-1">
                  <button class="btn btn-success w-25" onclick="myFunction()">Information</button>
                  <button class="btn btn-success w-25" onclick=" myFunctiondiv2()">Order detail</button>
                </div>
                <div class="col-sm-12 row-12 ">

                  <div class="col-sm-12 row-12 ">
                    <div id="myDIV">
                      <?php
                      /////update
                      

                      //display user
                     

                      foreach ($result as $value) {
                        if ($result > 0) {
                          echo <<< here


                                    <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row w-full">
                                      <div class="col-sm-4">
                                        <p class="m-b-10 b-b-default f-w-600">Name : </p>
                                        <h6 class="text-muted f-w-400">$value[name]</h6>
                                      </div>
                                        <div class="col-sm-4">
                                            <p class="m-b-10 b-b-default f-w-600 ">Email :</p>
                                            <h6 class="text-muted f-w-400">$value[email]</h6>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="m-b-10 b-b-default f-w-600">Phone : </p>
                                            <h6 class="text-muted f-w-400">$value[phone]</h6>
                                        </div>
                                       
                                    </div>
                                     <div class="row col-sm-12 mt-5">
                                          <div class="col-sm-4 row-12 ">
                                            <a class="btn btn-success col-sm-12 row-12 w-30" href="updateuser.php?id=$value[id]>">Edit</a>
                                          </div> 
                                        </div>
                                       

                                here;
                        } else {
                        }
                        if (empty($result)) {
                          echo "<h2> Order is Empty</h2>";
                        }
                      }
                      ?>



                    </div>
                  </div>
                </div>

                <div id="myDIV2">
                  <h2 class="m-3">Order Detail</h2>
                  <table class="table m-auto row-8 height-100">
                    <thead>
                      <?php
                      ////display order details

                      $display = $conn->prepare("SELECT users.id, users.name, order_detail.price, order_detail.quantity, order_detail.confirmation, cart.user_id, product.product_name
                      FROM users
                      INNER JOIN order_detail ON users.id = order_detail.user_id
                      INNER JOIN cart ON users.id = cart.user_id
                      INNER JOIN product ON cart.product_id = product.id
                      WHERE users.id = $_SESSION[userid];");

                      $display->execute();
                      $result_of_display = $display->fetchAll();


                      ?>
                      <tr>

                        <th>name</th>
                        <th>product-name</th>
                        <th>price</th>
                        <th>quantity</th>
                        <th>confirmation</th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php
                      foreach ($result_of_display as $value) {
                        if ($result_of_display > 0) {
                          echo <<< here
                                                                            <tr>
                                                                              
                                                                              <td>$value[name]</td>
                                                                               <td>$value[product_name]</td>
                                                                              <td>$value[price]</td>
                                                                              <td>$value[quantity]</td>
                                                                              <td>$value[confirmation]</td>
                                                                            </tr>
                                                                            here;
                        } else {
                          echo "<h2>not orders</h2>";
                        }
                      }
                      ?>


                    </tbody>
                  </table>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    var x = document.getElementById("myDIV");
    var y = document.getElementById("myDIV2");
    y.style.display = "none";

    function myFunction() {

      if (x.style.display === "none") {
        x.style.display = "block";
        y.style.display = "none";

      } else {
        x.style.display = "none";
        y.style.display = "block";

      }
    }

    function myFunctiondiv2() {

      if (y.style.display === "none") {
        y.style.display = "block";
        x.style.display = "none";

      } else {
        y.style.display = "none";
        x.style.display = "block";

      }
    }
  </script>
</body>

</html>