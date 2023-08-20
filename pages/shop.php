<?php
include('conn.php');
include('header.php');
if (isset($_SESSION["pro"])) {
   unset($_SESSION["pro"]);
}

$result = $conn->prepare("SELECT * FROM product");
$result->execute();
$products = $result->fetchAll();
// print_r($products);
// $page = $_GET['page'];
// $page =$_GET ['page'];
// $color= $_GET ['color'];
// $category_id= $_GET ['category_id'];






    if(!isset($_SESSION["product"])){
        $_SESSION["product"] = array();
    }
    if(isset($_GET["id"])){
    
    array_push($_SESSION["product"],$_GET["id"] );
    }
    // $page =Array ($_GET['page']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobile Tech - Product Listing Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    

     


    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <!-- select the category from the category  -->
            <div class="col-lg-3">
                <div class="list-unstyled templatemo-accordion">
                    <div class="pb-3">
                        <h2 class="h2 pb-2 pt-4">Categories</h2>
                        <div><a class="text-decoration-none categories" href="shop.php">All</a></div>
                        <?php
                        $sql = "SELECT * FROM category ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($category as $value) {
                            echo <<<here
                            <div><a class="text-decoration-none" href="shop.php?category_id=$value[id]">$value[name]</a></div>
                            here;
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">

                    <?php // Check if a specific category is selected
                    if (isset($_GET['category_id'])) {
                        $selectedCategory = $_GET['category_id'];
                        $sql = "SELECT * FROM product WHERE category_id = :category_id";
                        $result = $conn->prepare($sql);
                        $result->bindParam(':category_id', $selectedCategory, PDO::PARAM_INT);
                    } else {
                        $sql = "SELECT * FROM product";
                        $result = $conn->prepare($sql);
                    }

                    // Execute the query and fetch products
                    $result->execute();
                    $products = $result->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                </div>
                <div class="row">
                    
                    <?php
                    //  ******** search *********//
                    $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
                    ?>
                    <form action="shop.php?<?php echo isset($_GET['category_id']) ? 'category_id=' . $_GET['category_id'] . '&' : ''; ?>" method="get" class="input-group pb-4">
                        <input type="text" name="search" class="form-control rounded" placeholder="Search specific mobile" value="<?php echo $searchQuery; ?>">
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
                            $result = $conn->prepare("SELECT * FROM product WHERE product_color = :color");
                            $result->bindParam(':color', $selectedColor);
                            $result->execute();
                            $products = $result->fetchAll(PDO::FETCH_ASSOC);
                            
                            // ********* pagenation *********//

                            $num_product = count($products);
                            $num_every_page = 3;
                            $totalPages = ceil($num_product / $num_every_page);
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            $startinglimit = ($page - 1) * $num_every_page;
                            $result = $conn->prepare("SELECT * from product LIMIT " . $startinglimit .
                                "," . $num_every_page);


                            //  // ********* Pagination *********//
                            // $num_every_page = 3;
                            // $totalProducts = count($products);
                            // $totalPages = ceil($totalProducts / $num_every_page);

                            // if (isset($_GET['page'])) {
                            //     $page = $_GET['page'];
                            // } else {
                            //     $page = 1;
                            // }

                            // $startinglimit = ($page - 1) * $num_every_page;

                            // if (isset($_GET['category_id'])) {
                            //     $sql .= " LIMIT " . $startinglimit . "," . $num_every_page;
                            //     $result = $conn->prepare($sql);
                            //     $result->bindParam(':category_id', $selectedCategory, PDO::PARAM_INT);
                            // } else {
                            //     $sql .= " LIMIT " . $startinglimit . "," . $num_every_page;
                            //     $result = $conn->prepare($sql);
                            // }

                            // // Execute the paginated query and fetch products for the current page
                            // $result->execute();
                            // $products = $result->fetchAll(PDO::FETCH_ASSOC);    
        
                            //********* end pagenation *************//

                            foreach ($products as $product) {
                                echo <<<here
                                        <div class="col-md-4">
                                            <div class="card mb-4 product-wap rounded-0">
                                                <div class="card rounded-0">
                                                <img class="card-img rounded-0 img-fluid p-4"style="height: 350px;" src="../assets/img/$product[main_picture]">
                                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                                        <ul class="list-unstyled">
                                                            <li><a class="btn btn-success text-white" href="shop-single.php?id=$product[id]"><i class="far fa-heart"></i></a></li>
                                                            <li><a class="btn btn-success text-white mt-2" href="shop-single.php?id=$product[id]"><i class="far fa-eye"></i></a></li>
                                                            <li><a class="btn btn-success text-white mt-2" href="shop.php?id=$product[id]"><i class="fas fa-cart-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="shop-single.php?id=$product[id]" class="h3 text-decoration-none product_name"><strong class="">$product[product_name]</strong></a>
                                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                                        <p class="description">$product[discription]</p>
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
                                                    <p class="text-center mb-0">$$product[price]</p>

                                                </div>
                                            </div>
                                        </div>
                                        here;
                            }
                        } else {
                            echo `<h2 class="justify-content-center">No products found</h2>`;
                        }
                    } elseif (isset($_GET["search"])) {
                        if (count($products) > 0) {

                            $sql = "SELECT * FROM product WHERE product_name LIKE :searchQuery OR discription LIKE :searchQuery";
                            $result = $conn->prepare($sql);
                            $result->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
                            $result->execute();
                            $products = $result->fetchAll();
                            
                            // ********* pagenation *********//

                            $num_product = count($products);
                            $num_every_page = 3;
                            $totalPages = ceil($num_product / $num_every_page);
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            } else {
                                $page = 1;
                            }
                            $startinglimit = ($page - 1) * $num_every_page;
                            $result = $conn->prepare("SELECT * from product LIMIT " . $startinglimit .
                                "," . $num_every_page);

                            //********* end pagenation *************//

                            foreach ($products as $product) {
                                echo <<<here
                                        <div class="col-md-4">
                                            <div class="card mb-4 product-wap rounded-0">
                                                <div class="card rounded-0">
                                                <img class="card-img rounded-0 img-fluid p-4"style="height: 350px;" src="../assets/img/$product[main_picture]">
                                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                                        <ul class="list-unstyled">
                                                            <li><a class="btn btn-success text-white" href="shop-single.php?id=$product[id]"><i class="far fa-heart"></i></a></li>
                                                            <li><a class="btn btn-success text-white mt-2" href="shop-single.php?id=$product[id]"><i class="far fa-eye"></i></a></li>
                                                            <li><a class="btn btn-success text-white mt-2" href="shop.php?id=$product[id]"><i class="fas fa-cart-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <a href="shop-single.php?id=$product[id]" class="h3 text-decoration-none product_name"><strong class="">$product[product_name]</strong></a>
                                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                                        <p class="description">$product[discription]</p>
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
                                                    <p class="text-center mb-0">$$product[price]</p>

                                                </div>
                                            </div>
                                        </div>
                                        here;
                            }
                        } else {
                            echo `<h2 class="justify-content-center">No products found</h2>`;
                        }
                    } elseif (count($products) > 0) {

                        // ********* Pagination *********//
                        $num_every_page = 3;
                        $totalProducts = count($products);
                        $totalPages = ceil($totalProducts / $num_every_page);

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $startinglimit = ($page - 1) * $num_every_page;

                        if (isset($_GET['category_id'])) {
                            $sql .= " LIMIT " . $startinglimit . "," . $num_every_page;
                            $result = $conn->prepare($sql);
                            $result->bindParam(':category_id', $selectedCategory, PDO::PARAM_INT);
                        } else {
                            $sql .= " LIMIT " . $startinglimit . "," . $num_every_page;
                            $result = $conn->prepare($sql);
                        }

                        // Execute the paginated query and fetch products for the current page
                        $result->execute();
                        $products = $result->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($products as $product) {
                            echo <<<here
                                    <div class="col-md-4">
                                        <div class="card mb-4 product-wap rounded-0">
                                            <div class="card rounded-0">
                                                <img class="card-img rounded-0 img-fluid p-4"style="height: 350px;" src="../assets/img/$product[main_picture]">
                                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                                    <ul class="list-unstyled">
                                                        <li><a class="btn btn-success text-white" href="shop-single.php?id=$product[id]"><i class="far fa-heart"></i></a></li>
                                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.php?id=$product[id]"><i class="far fa-eye"></i></a></li>
                                                        <li><a class="btn btn-success text-white mt-2" href="shop.php?id=$product[id]"><i class="fas fa-cart-plus"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="shop-single.php?id=$product[id]" class="h3 text-decoration-none product_name"><strong class="">$product[product_name]</strong></a>
                                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                                    <p class="description">$product[discription]</p>
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
                                                <p class="text-center mb-0">$$product[price]</p>

                                            </div>
                                        </div>
                                    </div>
                                    here;
                        }
                    } else {
                        echo `<h2 class="justify-content-center">No products found</h2>`;
                    }
                    ?>

                            <div class="row">
    <ul class="pagination pagination-lg justify-content-end col-10">
        <h5 class="pt-3" style="color: gray;">Pages:</h5>
        <?php
        for ($btn = 1; $btn <= $totalPages; $btn++) {
            // $selectedCategory = $_GET['category_id'];

            echo <<<here
        <li class="page-item">
            <a class="page-link rounded-0 mr-3 shadow-sm text-dark" href="shop.php?page=$btn">$btn</a>
        </li>
        here;
        }
        ?>
    </ul>
</div>

                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->


    <?php include 'footer.php'; ?>


    <!-- Start Script -->
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/templatemo.js"></script>
    <script src="../assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>