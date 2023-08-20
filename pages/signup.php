<?php
include 'conn.php';
include '../google/config.php'; // Include using correct relative path
?>
<?php

if (isset($_POST['Register'])) {
	include 'conn.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$conpass = $_POST['conpass'];


	if (empty($name) || empty($email) || empty($pass) || empty($conpass)) {
		header('location:signup.php?error=emptyfieldes&name=' . $name . '$email=' . $email);
		exit();
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		header('location:signup.php?error=invalidemailname&name');
		exit();
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location:signup.php?error=invalidemail&name=' . $name);
		exit();
	} elseif (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		header('location: signup.php?error=' . urlencode('invalidname') . '&name=' . $name);
		exit();
	} elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass)) {
		header('location:signup.php?error=invalidpass&name=' . $name . '$email=' . $email);
		exit();
	} elseif ($pass !== $conpass) {
		header('location:signup.php?error=checkpassword&name=' . $name . '$email=' . $email);
		exit();
	} else {
		$sql = "SELECT id FROM users WHERE name = :name";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->execute();
		$rowCount = $stmt->rowCount();

		if ($rowCount > 0) {
			header('location: signup.php?error=' . urlencode('user taken') . '&name=' . $name);
			exit();
		} else {
			$hashedPassword = password_hash($pass, PASSWORD_DEFAULT); // Hash the password
			$sql = $conn->prepare("INSERT INTO users (name,email,password) VALUES ('$name','$email','$hashedPassword')");
			$result = $sql->execute();
			header('location:signup.php?error=success');
			exit();
		}
	}
}

// $nameErr = $emailErr = $passErr = $conpassErr = "";
// $name = $email = $pass = $conpass  = "";

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Register'])) {
//     if (empty($_POST["name"])) {
//         $nameErr = "Name is required";
//     } else {
//         $name = test_input($_POST["name"]);
// 		if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
// 			$nameErr = "Only letters and white space allowed";
// 		  }
//     }

//     if (empty($_POST["email"])) {
//         $emailErr = "Email is required";
//     } else {
//         $email = test_input($_POST["email"]);

//         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//             $emailErr = "Invalid email format"; 
//         }
//     }

// 	if(empty($_POST['pass'])){
// 		$passErr = "Password is required"; 
// 	}else{
// 		$pass = test_input($_POST["pass"]);
// 		if(!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $pass)){
// 			$passErr = "Invalid Password format"; 
// 		}
// 	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link type="text/css" rel="stylesheet" href="css/styleok.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" href="../assets/css/signup.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>



<body>
	<div class="body">
		<div class="veen">
			<div class="login-btn splits">
				<p>Already an user?</p>
				<button class="active">Login</button>
			</div>
			<div class="rgstr-btn splits">
				<p>Already an user?</p>
				<button><a href="signin.php">Login</a></button>
			</div>
			<div class="wrapper">
				<form id="login" class="reg" tabindex="502" method="post" style="padding-top: 5%;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<h3>Register</h3>
					<?php
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfieldes") {
							echo "<span> Fill all the fields! </span>";
						}else if ($_GET['error'] == "invalidemailname") {
							echo "<span> invalid email and name! </span>";
						}else if ($_GET['error'] == urldecode("user taken")) {
							echo "<span>User taken!</span>";
						}else if ($_GET['error'] == "success") {
							echo "<span style='color:green; margin-bottom: 20px;'>Registration successful! You can now log in.</span>";
							echo '<br>';
						}
					} 
					?>
					<div class="name">
						<input type="text" name="name">
						<label>Full Name</label>
						<span><?php if (isset($_GET['error']) && $_GET['error'] === 'invalidname') {
            echo "<span> Name should only contain letters and digits (no spaces or special characters). </span>";
        } ?></span>
					</div>
					<div class="mail">
						<input type="email" name="email">
						<label>Email</label>
						<span><?php if (isset($_GET['error'])) {
						if ($_GET['error'] == "invalidemail") {
							echo "<span>Invalid email format! Please enter a valid email address! </span>";
						}} ?></span>
					</div>
					<div class="passwd">
						<input type="password" name="pass">
						<label>Password</label>
						<span><?php if (isset($_GET['error'])) {
						if ($_GET['error'] == "invalidpass") {
							echo "<span>Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long. </span>";
						}} ?></span>
					</div>
					<div class="uid">
						<input type="password" name="conpass">
						<label>Confirm Password</label>
						<span><?php if (isset($_GET['error'])) {
						if ($_GET['error'] == "checkpassword") {
							echo "<span>Passwords do not match! </span>";
						}} ?></span>

					</div>
					<div class="submit">
						<button class="dark" name="Register">Register</button>
					</div>
					<div class="social">
						<p>Register by</p>
						<button onclick="window.location = '<?php echo $login_url; ?>'"type="button"><i class="fab fa-brands fa-google"></i></button>
						<button><i class="fab fa-brands fa-facebook-f"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>


	<style type="text/css">
		.site-link {
			padding: 5px 15px;
			position: fixed;
			z-index: 99999;
			background: #fff;
			box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
			right: 30px;
			bottom: 30px;
			border-radius: 10px;
		}

		.site-link img {
			width: 30px;
			height: 30px;
		}
	</style>
	<script src="../assets/js/signup.js"></script>
</body>

</html>