<?php
include('conn.php');
$result = $conn->prepare("SELECT * FROM product");
$result->execute();
$product = $result->fetch(PDO::FETCH_ASSOC);
$_SESSION['product'] = $product;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobile Tech - Single product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="../assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/slick-theme.css">

</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <?php include('header.php'); ?>

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



    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <?php
                /////////// reviews //////////////
                // $result = $conn->query("SELECT * FROM reviews");
                // $reviews = $result->fetchAll(PDO::FETCH_ASSOC);

                if (isset($_GET['id'])) {
                    $product_id = $_GET['id'];
                    $result = $conn->prepare("SELECT * FROM product WHERE id = :id");
                    $result->bindParam(':id', $product_id);
                    $result->execute();
                    $product = $result->fetch(PDO::FETCH_ASSOC);
                    echo <<<here
                  
                            <div class="col-lg-5 mt-5">
                            <div class="card mb-3">
                                <img class="card-img img-fluid" src="../assets/img/$product[main_picture]" alt="Card image cap" id="product-detail">
                            </div>
                            <div class="row">
                                <!--Start Controls-->
                                <div class="col-1 align-self-center">
                                    <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                        <i class="text-dark fas fa-chevron-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </div>
                                <!--End Controls-->
                                <!--Start Carousel Wrapper-->
                                <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                                    <!--Start Slides-->
                                    <div class="carousel-inner product-links-wap" role="listbox">
        
                                        <!--First slide-->
                                        <div class="carousel-item active">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid"src="../assets/img/$product[picture1]"style="height: 220px;" alt="Product Image 1">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture2]"style="height: 220px;" alt="Product Image 2">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture3]"style="height: 220px;" alt="Product Image 3">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.First slide-->
        
                                        <!--Second slide-->
                                        <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[main_picture]"style="height: 220px;" alt="Product Image 4">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture2]"style="height: 220px;" alt="Product Image 5">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture3]"style="height: 220px;" alt="Product Image 6">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.Second slide-->
        
                                        <!--Third slide-->
                                        <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture1]"style="height: 220px;" alt="Product Image 7">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture2]"style="height: 220px;" alt="Product Image 8">
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid" src="../assets/img/$product[picture3]"style="height: 220px;" alt="Product Image 9">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/.Third slide-->
                                    </div>
                                    <!--End Slides-->
                                </div>
                                <!--End Carousel Wrapper-->
                                <!--Start Controls-->
                                <div class="col-1 align-self-center">
                                    <a href="#multi-item-example" role="button" data-bs-slide="next">
                                        <i class="text-dark fas fa-chevron-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <!--End Controls-->
                            </div>
                        </div>
                        <!-- col end -->
                        <div class="col-lg-7 mt-5">
                            <div class="card p-3">
                                <div class="card-body ">
                                    <h1 class="h2">$product[product_name]</h1>
                                    <p class="h3 py-2">$$product[price]</p>
                                </div>
                            
                        
             
                                <p class="py-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                            </p>
            
            
                            <h6>Description:</h6>
                            <p> $product[discription]</p>
            
                            <h6>Specification:</h6>
                            <ul class="list-unstyled pb-3" style="width:50%;">
                                $product[product_color] <br/>
                                $product[capacity] <br/>
                                $product[specification] 
                            </ul>
                        
                        here;
                }
                // foreach ($reviews as $review) {
                //     echo <<< here
                //             <div >
                //             <h3>$review[name]</h3>
                //             <p>Rating:$review[rating]/5 Stars</p>
                //             <p>$review[review]</p>
                //             </div>
                //             here;
                // }

                // ?>
           
                


                <form action="" method="GET">
                    <input type="hidden" name="$product[product_name] " value="Activewear">

                    <?php
                    $color = $product['product_color'];
                    $name = $product['product_name'];
                    $result = $conn->prepare("SELECT * FROM product WHERE product_name = :name AND product_color != :color");
                    $result->bindParam(':name', $name);
                    $result->bindParam(':color', $color);
                    $result->execute();
                    $selectedProducts = $result->fetchAll(PDO::FETCH_ASSOC);
                    if (count($selectedProducts) > 0) {
                        echo <<< here
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <ul class="list-inline pb-3">
                                                            <li class="list-inline-item">Available Colors:
                                                                <input type="hidden" name="product-size" id="product-size" value="S" href="shop-single.php?id=$product[id]">
                                                            </li>
                                            here;
                        foreach ($selectedProducts as $product) {
                            // echo $product['id'];
                            echo <<< here
                                                    <li><a class="btn btn-success text-white inline" href="shop-single.php?id=$product[id]"></i>$product[product_color]</a></li>

                                                    here;
                        }
                        echo <<< here
                                                        </ul>
                                                    </div>
                                               
                                            here;
                    }

                    echo <<< here
                                        </ul>
                                    </div>

                                
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <a  class="btn btn-success btn-lg" name="submit" value="buy" href="cart.php?id=$product[id]">Buy</a>
                                    </div>
                                    <div class="col d-grid">
                                        <a class="btn btn-success btn-lg" name="submit" value="addtocard"  href="cart.php?id=$product[id]">Add To Cart</a>
                                    </div>
                                </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> 
                </div>
                here;

                    // else {
                    //     echo "Product ID not provided.";
                    // }

                    ?>
            </div>
        </div>
    </section>
    <!-- Close Content -->

    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Related Products</h4>
            </div>

            <!--Start Carousel Wrapper-->
            <div id="carousel-related-product">
                <?php
                $currentProductId = $_GET['id'];
                $result = $conn->prepare("SELECT category_id FROM product WHERE id = :id");
                $result->bindValue(':id', $currentProductId, PDO::PARAM_INT);
                $result->execute();
                $categoryRow = $result->fetch(PDO::FETCH_ASSOC);

                $categoryId = $categoryRow['category_id'];
                $related = $conn->prepare("SELECT * FROM product WHERE category_id = :category_id AND id != :id LIMIT 5");
                $related->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
                $related->bindValue(':id', $currentProductId, PDO::PARAM_INT);
                $related->execute();
                $relatedProducts = $related->fetchAll(PDO::FETCH_ASSOC);
                foreach ($relatedProducts as $product) {
                    echo <<<here
                    <div class="d-flex flex-column">
                    <div class="card rounded-0 mx-4 p-4">
                    <img class="card-img rounded-0 img-fluid p-4" src="../assets/img/$product[main_picture]">
                    </div>
                    <div class="card-body">
                        <a href="shop-single.php?id=$product[id]" class="h3 text-decoration-none product_name"><strong class="">{$product['product_name']}</strong></a>

                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                            <li>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                            </li>
                        </ul>
                        <p class="text-center mb-0">\${$product['price']}</p>
                    </div>
                    </div>
                here;
                }
                ?>

            </div>
        </div>
        </div>
    </section>



    <!-- End Article -->

    <?php include 'footer.php'; ?>


    <!-- Start Script -->
    <script src="../assets/js/jquery-1.11.0.min.js"></script>
    <script src="../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/templatemo.js"></script>
    <script src="../assets/js/custom.js"></script>
    <!-- End Script -->

    <!-- Start Slider Script -->
    <script src="../assets/js/slick.min.js"></script>
    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->

</body>

</html>