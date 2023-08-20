<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['np'];
    $confirmNewPassword = $_POST['c_np'];

    if ($newPassword === $confirmNewPassword) {
        // Database connection setup
        $host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "mobile_tech";

        $conn = new mysqli($host, $db_username, $db_password, $db_name);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        if(isset($_SESSION['email'])) {
            $userId = $_SESSION['email']; 

            // Hash the new password before storing it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateQuery = "UPDATE users SET password='$hashedPassword' WHERE email = '$userId'";

            if ($conn->query($updateQuery) === TRUE) {
                $successMessage = "Password changed successfully.";
            } else {
                $errorMessage = "Error updating password: " . $conn->error;
            }
        } else {
            $errorMessage = "User email not found in session.";
        }

        $conn->close();
    } else {
        $errorMessage = "Passwords do not match.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .error, .success {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: green;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px 0;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .ca {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        .ca:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="post" class="container">
        <h2>Change Password</h2>
        <?php if (isset($errorMessage)) { ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php } ?>

        <?php if (isset($successMessage)) { ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php } ?>

        <label>New Password</label>
        <input type="password" name="np" placeholder="New Password"><br>

        <label>Confirm New Password</label>
        <input type="password" name="c_np" placeholder="Confirm New Password"><br>

        <button type="submit">CHANGE</button>
        <a href="signin.php" class="ca">HOME</a>
    </form>
</body>
</html>
