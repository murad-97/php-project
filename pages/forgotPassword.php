<?php
session_start();

include 'test.php';

$errorMessage = "";
$message = ""; // تعريف المتغير $message هنا

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    // Query if the email exists in the database

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // Redirect to change-password.php
        header("Location: change-password.php");

        exit();
    } else {
        $message = "The email is not in our records.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center mt-5 pt-5">
        <div class="card mt-5" style="width:500px">
            <div class="card-header">
                <h1 class="text-center">Forgot Password</h1>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mt-4">
                        <label for="email">Email : </label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="mt-4 text-end">
                        <input type="submit" name="send-link" class="btn btn-primary">
                    </div>
                </form>
                <p class="mt-4"><?php echo $message; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
