<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>mobile_tech</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">



</head>

<body>

    

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



    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="../assets/img/sliderimg1.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <!-- <h1 class="h1 text-success"><b>Zay</b> eCommerce</h1> -->
                                <h3 class="h2"><strong> Explore the World of iPhones</strong></h3>
                                <p>
                                    Discover the cutting-edge technology, sleek design, and unparalleled performance
                                    that iPhones are known for. From the powerful A-series chips to the innovative
                                    camera systems, iPhones offer an unmatched mobile experience. Whether you're a
                                    photography enthusiast, a productivity guru, or a gaming aficionado, iPhones have
                                    something to offer for everyone.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="../assets/img/sliderimg2.png" alt=""
                                style=" height: 380px; margin : 50px  0px 80px  100px;  ">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <!-- <h1 class="h1"><strong>Experience Huawei Innovation</strong> </h1> -->
                                <h3 class="h2"><strong>Experience Huawei Innovation</strong></h3>
                                <p>
                                    Immerse yourself in the world of Huawei smartphones, where innovation meets style.
                                    Explore the latest advancements in mobile technology, including stunning AI-powered
                                    cameras, long-lasting battery life, and sleek designs that stand out. With Huawei's
                                    commitment to pushing boundaries, you can expect devices that redefine what's
                                    possible in the smartphone realm.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="../assets/img/s3.png" alt=""
                                style=" height: 380px; margin : 50px  0px 80px  100px;  ">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <!-- <h1 class="h1">Repr in voluptate</h1> -->
                                <h3 class="h2"><strong>Unleash Possibilities with Samsung Galaxy</strong> </h3>
                                <p>
                                    Elevate your smartphone experience with the Samsung Galaxy series. These devices
                                    combine elegance and functionality, offering powerful performance, crystal-clear
                                    displays, and a host of features that cater to every aspect of your life. From
                                    capturing breathtaking photos to staying productive on the go, Samsung Galaxy phones
                                    empower you to do more
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The all types of phones  -->
    <?php require 'connect.php';
    $categories_query = "SELECT * FROM category";

    $categories_result = $pdo->query($categories_query);
    //$categories_result = $conn->query($categories_query);
    ?>



    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1"> phones </h1>
                <p>
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                    deserunt mollit anim id est laborum.
                </p>
            </div>

        </div>
        <div class="row mx-1 justify-content-center">
            <?php while ($category = $categories_result->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="col-12 col-md-4 p-5 mt-3 ">
                    <a href="pages\shop.php"><img src="../admin_pages/uploads/<?php echo $category['picture'] ?>" class="img-fluid border" style="height:400px"></a>
                    <h5 class="text-center mt-3 mb-3">
                        <?php echo $category['name']; ?>
                    </h5>
                    <p class="text-center"><a class="btn btn-success" href="shop.php?category_id=<?php print_r($category['id']) ?>">Go Shop</a></p>
                </div>
            <?php } ?>
        </div>

    </section>
    <!-- End Categories of all phones category -->





    <?php
    require 'connect.php';
    // php foreach ($iphoneProducts as $product): 
    // Query to retrieve iPhones priced higher than $1000
    $query = "SELECT * FROM product ";
    $stmt = $pdo->query($query);

    // Fetch phone products
    $phoneProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query2 = "SELECT * FROM category ";
    $stmt2 = $pdo->query($query2);

    // Fetch phone products
    $phoneType = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    ?>

   

        <!-- Insert phone type products in the phone category -->
        <div class="category-container">
            <div class="products" id="iphone-products">
                <section class="bg-light">
                <?php foreach ($phoneType as $category): ?>
                               
                    <div class="container py-5">
                        <div class="row text-center py-3">
                            <div class="col-lg-6 m-auto">
                                <h1 class="h1"><strong>Latest <?php echo $category['name']; ?> Phones</strong></h1>
                                <p>
                                    Discover the newest <?php echo $category['name']; ?> models.
                                </p>
                            </div>
                        </div>
                        <div class="row mr-4">
                     
                        <?php foreach ($phoneProducts as $product): ?>
                            <?php if($product['price']>500 && $category['id']==$product['category_id']){?>

                                <div class="col-12 col-md-4 mb-4">
                                    <div class="card h-100">
                                        <a href="shop-single.php?id=<?php echo $product['id'] ?>">
                                            <img src="../admin_pages/uploads/<?php echo $product['main_picture'] ?>" class="card-img-top p-4" alt="...">
                                        </a>
                                        <div class="card-body">

                                            <a href="shop-single.php?id=<?php echo $product['id'] ?>" class="h2 text-decoration-none text-dark">
                                                <?php echo $product['product_name']; ?>
                                            </a>
                                            <p class="card-text">
                                                <?php echo $product['price']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>  <?php } ?> 
                                 <?php endforeach; ?>
                                 
                          
                        </div>
                    </div>
                            <?php endforeach; ?>
                            
                </section>
            </div>
        </div>


        <!-- Your remaining content here -->


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