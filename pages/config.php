<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/conformation.css">
    <title>conformation</title>
</head>

<body>
    <?php include("header.php") ?>
    <?php

    try {
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbh = new PDO("mysql:host=$dbhost;dbname=mobile_tech", $dbuser, $dbpass);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    //cart
    if (isset($_SESSION["cart"])) {
        $qty = 0;
        foreach ($_SESSION["cart"] as $key => $value) {


            if ($key !== "full_price" && $key !== "shipping" && $key !== "sub") {
                $qty += intval($value);
                $insert = "INSERT INTO cart (user_id,product_id,qty,price) VALUES (:user_id,:product_id,:qty,:price)";


                $insertin = $dbh->prepare($insert);
                $pdo = $insertin->execute(array(':user_id' => $_SESSION["userid"], ':product_id' => $key, ':qty' => $value, ":price" => 0));

               $sub= $_SESSION["cart"]["sub"];
                $full = $_SESSION["cart"]["full_price"];

                      
            }
        }
        echo <<< here
        <div class="container">
       <div class="sub-container">
           <div class="conten2t">
               <h3>Order Review</h3>
               <div class="flex">
                   <p>item quantity :</p>

                   <p>$qty item</p>
            </div>
               <div class="flex">
                <p>sub Total :</p>
                   <p> $sub JD</p>
               </div>
               <hr>


           <h3 class="flex">Total: <p>$full JD</p>
               </h3>

               <div class="cont"> <a href="home.php" class="button-cancel">home</a> <a href="../admin_pages/profile.php" class="button-conformation">profile</a></div>
           </div>
       </div>
   </div>
   here;

        $insert = "INSERT INTO order_detail (user_id,price,quantity,confirmation) VALUES 
        (:user_id,:price,:quantity,:confirmation)";
        $insertin = $dbh->prepare($insert);
        $pdo = $insertin->execute(array(':user_id' => $_SESSION["userid"], ':price' => $_SESSION["cart"]["full_price"], ':quantity' => $qty, ":confirmation" => 0));
    
    
    
    

    
    }

    //payment






    if (isset($_SESSION["cart"])) {
        // print_r($_SESSION["cart"]["full_price"]);
    }
    ?>
  
    <?php include("footer.php") ?>
    <?php unset($_SESSION['product']) ?>
    <?php unset($_SESSION['cart']) ?>





    </section>

    <script src="/javascript/conformation.js"></script>
</body>

</html>