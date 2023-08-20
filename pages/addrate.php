<?php
include('database.php');
$id = 1;



// if ($_SERVER['REQUEST_METHOD'] == "POST"){
//     $name = $_POST['name'];
//     $rating = $_POST['rating']; // Corrected spelling
//     $review = $_POST['review'];
  

   
//     $result = $conn->prepare("INSERT INTO reviews (product_id, review, rating, user_id) VALUES (:product_id, :review, :rating, :user_id)");
//     $result->bindParam(':product_id',$id);
//     $result->bindParam(':review', $review);
//     $result->bindParam(':rating', $rating);
//     $result->bindParam(':user_id',$id);

//     $result->execute();

//     echo "Review submitted successfully!";
// }
$result = $conn->prepare("SELECT * FROM reviews WHERE product_id = $id");
$result->execute();
$product = $result->fetchAll(PDO::FETCH_ASSOC);
$rate = 0;
foreach ($product as $value) {
    $rate += floatval($value["rating"]);
}
$rate = $rate/(count($product));
echo$rate;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mobile Tech - Rating</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/templatemo.css">
    <link rel="stylesheet" href="../assets/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="post"> 
                <div>
                    <h3>Rate your mobile</h3>
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="rateyo my-2" id="rating" for="rating"></div>
                    <input class="rate" type="hidden" name="rating" value="<?php echo $rate; ?>"> 
                </div>
                <!-- <span class="result">0</span> <br> -->
                <label for="review">Your Review:</label><br>
                <textarea id="review" name="review" rows="4" cols="50"></textarea><br>
                <div><input type="submit" name="add" class="btn btn-success my-4"></div>
            </form>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(document).ready(function () {
            console.log($(".rate").val())
            $("#rating").rateYo({
                rating: $(".rate").val(),
                fullStar: true,
                onChange: function (rating, rateYoInstance) {
                    $(".rate").val(rating)
                    console.log($(".rate").val())
                    // console.log("Rating changed to: " + rating);
                }
            });
        });
    </script>
</body>

</html>
