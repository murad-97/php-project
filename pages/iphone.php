<?php

include('conn.php');
$sql = "SELECT * FROM product WHERE category_id = $_GET[id]";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobile Tech - Product Listing Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">info@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                            class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i
                            class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                            class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <?php include("header.php") ?>

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <!-- <h1 class="h2 pb-4">Categories</h1> -->
                <ul class="list-unstyled templatemo-accordion">
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="">
                            <h1 class="h2 pb-4">Categories</h1>
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                        <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="shop.php">All</a></li>
                            <?php

                            $sql = "SELECT * FROM category ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $category = $stmt->fetchAll(PDO::FETCH_ASSOC);


                            foreach ($category as $value) {
                                echo <<<here
                                         <li><a class="text-decoration-none" href="iphone.php?id=$value[id]">$value[name]</a></li>
                                         
                               here;

                            }
                            ?>


                        </ul>
                    </li>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">

                </div>
                <div class="row">
                    <?php
                    //  ******** search *********//
                    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
                    ?>
                    <form action="" method="get" class="input-group pb-4">
                        <input type="text" name="search" class="form-control rounded"
                            placeholder="Search specific mobile" value="<?php echo $searchQuery; ?>">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </form>
                    <!-- ********* color********* -->
                    <form method="get" action="">
                        <label for="color">Select Color:</label>
                        <select name="color" id="color" class="p-2 rounded mb-4">
                            <option value="white">White</option>
                            <option value="red" class="options" style="background-color:red;color:white;">Red</option>
                            <option value="pink" style="background-color:pink;color:white;">Pink</option>
                            <option value="black" style="background-color:black;color:white;">Black</option>
                            <option value="grey" style="background-color:grey;color:white;">Grey</option>
                        </select>
                        <input type="submit" value="Filter" class="btn btn-warning px-4 py-2 mx-3">
                    </form>
                    <?php
                    if (isset($_GET['color'])) {
                        if (count($products) > 0) {

                            $selectedColor = $_GET['color'];
                            $result = $conn->prepare("SELECT * FROM product WHERE category_id = $_GET[id] AND product_color = :color");
                            $result->bindParam(':color', $selectedColor);
                            $result->execute();
                            $products = $result->fetchAll(PDO::FETCH_ASSOC);
                            // ********* pagenation *********//
                            $num_product = count($products);
                            $num_every_page = 3;
                            $totalPages = ceil($num_product / $num_every_page);
                            // echo ($totalPages);
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                                // echo $page;
                            } else {
                                $page = 1;
                            }
                            $startinglimit = ($page - 1) * $num_every_page;
                            $result = $conn->prepare("SELECT * from product LIMIT " . $startinglimit .
                                "," . $num_every_page);
                            // $result->execute();
                            // $products = $result->fetchAll();
                            //********* end pagenation *************//
                            foreach ($products as $product) {
                                // print_r($product);
                                echo <<<here
                            <div class="col-md-4">
                                <div class="card mb-4 product-wap rounded-0">
                                    <div class="card rounded-0">
                                        <img class="card-img rounded-0 img-fluid" src="../assets/img/ $product[main_picture] ">
                                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                            <ul class="list-unstyled">
                                                <li><a class="btn btn-success text-white" href="shop-single <php?id=$product[id]"><i class="far fa-heart"></i></a></li>
                                                <li><a class="btn btn-success text-white mt-2" href="shop-single?id= $product[id]"<i class="far fa-eye"></i></a></li>
                                                <li><a class="btn btn-success text-white mt-2" href="shop-single?id= $product[id]"><i class="fas fa-cart-plus"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="shop-single <php" class="h3 text-decoration-none product_name"><strong class="">   $product[product_name]  </strong></a>
                                        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                            <p>   $product[discription]  </p>
                                        </ul>
                                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                                            <li>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <p class="text-center mb-0">$ $product[price] </p>
                                    </div>
                                </div>
                            </div>'; 
                here;
                            }
                        } else {
                            echo `<h2 class="justify-content-center">No products found</h2>`;
                        }
                    } elseif (isset($_GET["search"])) {
                        if (count($products) > 0) {

                            //  ******** search *********//
                            $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
                            $sql = "SELECT * FROM product WHERE (product_name LIKE :searchQuery OR discription LIKE :searchQuery) AND category_id = $_GET[id]";
                            $result = $conn->prepare($sql);
                            $result->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
                            $result->execute();
                            $products = $result->fetchAll();

                            // ********* pagenation *********//
                            $num_product = count($products);
                            $num_every_page = 3;
                            $totalPages = ceil($num_product / $num_every_page);
                            // echo ($totalPages);
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                                // echo $page;
                            } else {
                                $page = 1;
                            }
                            $startinglimit = ($page - 1) * $num_every_page;
                            $result = $conn->prepare("SELECT * from product LIMIT " . $startinglimit .
                                "," . $num_every_page);
                            //********* end pagenation *************//
                            foreach ($products as $product) {
                                // print_r($product);
                                echo '
            <div class="col-md-4">
                <div class="card mb-4 product-wap rounded-0">
                    <div class="card rounded-0">
                        <img class="card-img rounded-0 img-fluid" src="../assets/img/' . $product['main_picture'] . '">
                        <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                            <ul class="list-unstyled">
                                <li><a class="btn btn-success text-white" href="shop-single.php"><i class="far fa-heart"></i></a></li>
                                <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i class="far fa-eye"></i></a></li>
                                <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i class="fas fa-cart-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="shop-single.php" class="h3 text-decoration-none product_name"><strong class="">' . $product['product_name'] . '</strong></a>
                        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                            <p>' . $product['discription'] . '</p>
                        </ul>
                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                        </ul>
                        <p class="text-center mb-0">$' . $product['price'] . '</p>
                    </div>
                </div>
            </div>';
                            }

                        } else {
                            echo `<h2 class="justify-content-center">No products found</h2>`;
                        }
                    } elseif (count($products) > 0) {
                        // ********* pagenation *********//
                        $num_product = count($products);
                        $num_every_page = 3;
                        $totalPages = ceil($num_product / $num_every_page);
                        // echo ($totalPages);
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                            // echo $page;
                        } else {
                            $page = 1;
                        }
                        $startinglimit = ($page - 1) * $num_every_page;
                        $result = $conn->prepare("SELECT * from product LIMIT " . $startinglimit .
                            "," . $num_every_page);
                        $result->execute();
                        $products = $result->fetchAll();
                        //********* end pagenation *************//
                        foreach ($products as $product) {
                            // print_r($product);
                            echo '
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="../assets/img/' . $product['main_picture'] . '">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="shop-single.php"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="shop-single.php" class="h3 text-decoration-none product_name"><strong class="">' . $product['product_name'] . '</strong></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <p>' . $product['discription'] . '</p>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="text-center mb-0">$' . $product['price'] . '</p>
                            </div>
                        </div>
                    </div>';
                        }

                    } else {
                        echo `<h2 class="justify-content-center">No products found</h2>`;
                    }
                    ?>
                    <div class="row">
                        <ul class="pagination pagination-lg justify-content-end col-10">
                            <h5 class="pt-3" style="color:gray;">Pages:</h5>

                            <?php
                            for ($btn = 1; $btn <= $totalPages; $btn++) {
                                echo <<<here
            <button style="border:none;">
              <a class="page-link rounded-0 mr-3 shadow-sm text-dark" href="shop.php?page=$btn" style="background" tabindex="-1">$btn</a>
            </button>
            here;
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </div>
    </div>
    <!-- End Content -->


    <?php include("footer.php") ?>
    <!-- Start Script -->
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/templatemo.js"></script>
    <script src="../assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>