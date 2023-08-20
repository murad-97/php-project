<?php
include("conn.php");
include("header.php");


try {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbh = new PDO("mysql:host=$dbhost;dbname=mobile_tech", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$_SESSION["page"] = $_SERVER["PHP_SELF"];
if (isset($_SESSION['userid'])) {
    $log = "payment.php";
} else {

    $log = "signin.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <form action=<?php echo $log ?> method="post">
        <header id="site-header">
            <div class="container">
                <h1>Shopping cart <span>[</span> <em><a href="index.php" target="_blank">Mobile-Tech</a></em><span
                        class="last-span is-open">]</span></h1>
            </div>
        </header>

        <div class="container">

            <section id="cart">
                <?php
                //                 if (isset($_POST["full_price"])) {
                

                //                     foreach ($_POST as $key => $value) {
                //                         if ($key!== "full_price"&&$key!== "shipping"&&$key!=="sub") {
                //                         $pdo_read = $dbh->prepare("SELECT * FROM `product` WHERE id = $_GET[id]");
                //                         $pdo_read->execute();
                //                         $arr = $pdo_read->fetch(PDO::FETCH_ASSOC);
                


                //                         echo <<<"here"
                //             <article class="product">
                //             <header>
                //                 <a class="remove">
                //                     <img src="../admin_pages/uploads/$arr[main_picture]" alt="">
                
                //                     <h3>Remove product</h3>
                //                 </a>
                //             </header>
                
                //             <div class="cont_content">
                //             <div class="content">
                
                //                 <h1>$arr[product_name]</h1>
                
                //                 $arr[discription]
                

                //             </div>
                
                //             <footer class="content">
                
                //                 <span class="qt-minus">-</span>
                //                 <span class="qt">$value</span><input class="hi"  name="$arr[id]" value="$value" hidden>
                //                 <span class="qt-plus">+</span>
                
                //                 <h2 class="full-price">
                //                 $arr[price] JOD
                //                 </h2>
                
                //                 <h2 class="price">
                //                 $arr[price] JOD
                //                 </h2>
                //             </footer></div>
                //         </article>
                // here;
                //                     }}
                //                 }else 
              
                if (isset($_GET["id"])) {
                    $_SESSION["pro"]=$_GET["id"];}
// print_r($_SESSION["product"]);
                    if(isset($_SESSION["pro"])){
                    $pdo_read = $conn->prepare("SELECT * FROM `product` WHERE id = $_SESSION[pro] ");
                    $pdo_read->execute();
                    $arr = $pdo_read->fetch(PDO::FETCH_ASSOC);

                    echo <<<"here"
        <article class="product">
        <header>
            <a class="remove">
                <img src="../admin_pages/uploads/$arr[main_picture]" alt="">

                <h3>Remove product</h3>
            </a>
        </header>

        <div class="cont_content">
        <div class="content">

            <h1>$arr[product_name]</h1>

            $arr[discription]

  
        </div>

        <footer class="content">

            <span class="qt-minus">-</span>
            <span class="qt">1</span><input class="hi"  name="$arr[id]" value="1" hidden>
            <span class="qt-plus">+</span>

            <h2 class="full-price">
            $arr[price] JOD
            </h2>

            <h2 class="price">
            $arr[price] JOD
            </h2>
        </footer></div>
    </article>
here;
                } else {

                    foreach (array_unique($_SESSION["product"]) as $value) {

                        $pdo_read = $conn->prepare("SELECT * FROM `product` WHERE id = $value");
                        $pdo_read->execute();
                        $arr = $pdo_read->fetch(PDO::FETCH_ASSOC);

                        echo <<<"here"
            <article class="product">
            <header>
                <a class="remove">
                    <img src="../admin_pages/uploads/$arr[main_picture]" alt="">

                    <h3>Remove product</h3>
                </a>
            </header>

            <div class="cont_content">
            <div class="content">

                <h1>$arr[product_name]</h1>

                $arr[discription]

      
            </div>

            <footer class="content">

                <span class="qt-minus">-</span>
                <span class="qt">1</span><input class="hi"  name="$arr[id]" value="1" hidden>
                <span class="qt-plus">+</span>

                <h2 class="full-price">
                $arr[price] JOD
                </h2>

                <h2 class="price">
                $arr[price] JOD
                </h2>
            </footer></div>
        </article>
here;
                    }
                }



                ?>
            </section>

        </div>

        <footer id="site-footer">
            <div class="container clearfix">

                <div class="left">
                    <h2 class="subtotal">Subtotal: <span>163.96</span>JOD</h2>
                    <input class="sub" name="sub" value="0" hidden>
                    <h3 class="tax">Taxes (16%): <span>8.2</span>JOD</h3>
                    <h3 class="shipping">Shipping: <span>5.00</span>JOD</h3>
                    <input class="shipping" name="shipping" value="5" hidden>
                </div>

                <div class="right">
                    <h1 class="total">Total: <span>177.16</span>JOD</h1>
                    <input class="full" name="full_price" value="0" hidden>
                    <input type="submit" class="btn">
                </div>

            </div>
        </footer>
    </form>

    <?php include_once("footer.php"); ?>

    <script src="../assets/js/cart.js"></script>
</body>

</html>