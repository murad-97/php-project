<?php
session_start();
$_SESSION["cart"] =$_POST;
try {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbh = new PDO("mysql:host=$dbhost;dbname=mobile_tech", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="payment.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="#!" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                    <hr>


                                    <?php
                                    if (isset($_SESSION["cart"])) {
                                        foreach ($_SESSION["cart"] as $key => $value) {

                                            if ($key !== "full_price" && $key !== "shipping" && $key !== "sub") {
                                                print_r($key);
                                                print_r($value);
                                                $pdo_read = $dbh->prepare("SELECT * FROM `product` WHERE id = $key");
                                                $pdo_read->execute();
                                                $arr = $pdo_read->fetch(PDO::FETCH_ASSOC);

                                                echo <<<"here"
        <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                    <div>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img1.webp"
                            class="img-fluid rounded-3" alt="Shopping item"
                            style="width: 65px;">
                    </div>
                    <div class="ms-3">
                        <h5>$arr[product_name]</h5>
                        <p class="small mb-0">$arr[discription]</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div style="width: 50px;">
                        <h5 class="fw-normal mb-0">$value</h5>
                    </div>
                    <div style="width: 80px;">
                        <h5 class="mb-0">$$arr[price]</h5>
                    </div>
                    <a href="#!" style="color: #cecece;"><i
                            class="fas fa-trash-alt"></i></a>
                </div>
            </div>
        </div>
    </div>
    
here;

                                            }
                                        }

                                    }
                                    ?>



                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Card details</h5>
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                    class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                            </div>

                                            <p class="small mb-2">Card type</p>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-visa fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-amex fa-2x me-2"></i></a>
                                            <a href="#!" type="submit" class="text-white"><i
                                                    class="fab fa-cc-paypal fa-2x"></i></a>

                                            <form class="mt-4" method="post" action="config.php">
                                                <div class="form-outline form-white mb-4">
                                                    <input name="card-name" type="text" id="typeName"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="Cardholder's Name" />
                                                    <label class="form-label" for="typeName">Cardholder's Name</label>
                                                </div>

                                                <div class="form-outline form-white mb-4">
                                                    <input name="card-number" type="text" id="typeText"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="1234 5678 9012 3457" maxlength="14" required />
                                                    <label class="form-label" for="typeText">Card Number</label>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div class="form-outline form-white">
                                                            <input name="card-exp" type="text" id="typeExp"
                                                                class="form-control form-control-lg"
                                                                placeholder="MM/YYYY" size="7" id="exp" minlength="7"
                                                                maxlength="7" required />
                                                            <label class="form-label" for="typeExp">Expiration</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-outline form-white">
                                                            <input name="card-cvv" type="password" id="typeText"
                                                                class="form-control form-control-lg"
                                                                placeholder="&#9679;&#9679;&#9679;" size="1"
                                                                minlength="3" maxlength="3" required />
                                                            <label class="form-label" for="typeText">Cvv</label>
                                                        </div>
                                                    </div>
                                                </div>



                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p class="mb-2">$
                                                        <?php
                                                        echo $_SESSION["cart"]["sub"]

                                                            ?>
                                                    </p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Shipping</p>
                                                    <p class="mb-2">$
                                                        <?php
                                                        echo $_SESSION["cart"]["shipping"]

                                                            ?>.00
                                                    </p>
                                                </div>

                                                <div class="d-flex justify-content-between mb-4">
                                                    <p class="mb-2">Total(Incl. taxes)</p>
                                                    <p class="mb-2">$
                                                        <?php
                                                        echo $_SESSION["cart"]["full_price"]

                                                            ?>
                                                    </p>
                                                </div>
                                                
                                                <button type="submit" class="btn btn-info btn-block btn-lg">
                                                    <div class="d-flex justify-content-between">
                                                        <span>$
                                                            <?php
                                                            echo $_SESSION["cart"]["full_price"]

                                                                ?>
                                                        </span>
                                                        <span>Checkout <i
                                                                class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
// Include the configuration file  
require_once 'configration.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script
        src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>
</head>

<body>

    <div class="panel">
        <div class="overlay hidden">
            <div class="overlay-content"></div>
        </div>

        <div class="panel-body">
            <!-- Display status message -->
            <div id="paymentResponse" class="hidden"></div>

            <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
        </div>
    </div>
    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    "purchase_units": [{
                        "custom_id": "<?php echo $itemNumber; ?>",
                        "description": "<?php echo $itemName; ?>",
                        "amount": {
                            "currency_code": "<?php echo $currency; ?>",
                            "value": <?php echo $itemPrice; ?>,
                            "breakdown": {
                                "item_total": {
                                    "currency_code": "<?php echo $currency; ?>",
                                    "value": <?php echo $itemPrice; ?>
                                }
                            }
                        },
                        "items": [
                            {
                                "name": "<?php echo $itemName; ?>",
                                "description": "<?php echo $itemName; ?>",
                                "unit_amount": {
                                    "currency_code": "<?php echo $currency; ?>",
                                    "value": <?php echo $itemPrice; ?>
                                },
                                "quantity": "1",
                                "category": "DIGITAL_GOODS"
                            },
                        ]
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function (orderData) {
                    setProcessing(true);

                    var postData = { paypal_order_check: 1, order_id: orderData.id };
                    fetch('paypal_checkout_validate.php', {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: encodeFormData(postData)
                    })
                        .then((response) => response.json())
                        .then((result) => {
                            if (result.status == 1) {
                                window.location.href = "payment-status.php?checkout_ref_id=" + result.ref_id;
                            } else {
                                const messageContainer = document.querySelector("#paymentResponse");
                                messageContainer.classList.remove("hidden");
                                messageContainer.textContent = result.msg;

                                setTimeout(function () {
                                    messageContainer.classList.add("hidden");
                                    messageText.textContent = "";
                                }, 5000);
                            }
                            setProcessing(false);
                        })
                        .catch(error => console.log(error));
                });
            }
        }).render('#paypal-button-container');

        const encodeFormData = (data) => {
            var form_data = new FormData();

            for (var key in data) {
                form_data.append(key, data[key]);
            }
            return form_data;
        }

        // Show a loader on payment form processing
        const setProcessing = (isProcessing) => {
            if (isProcessing) {
                document.querySelector(".overlay").classList.remove("hidden");
            } else {
                document.querySelector(".overlay").classList.add("hidden");
            }
        }    
    </script>

</body>

</html>