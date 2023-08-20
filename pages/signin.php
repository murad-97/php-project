<?php
include 'conn.php';
include '../google/config.php'; // Include using correct relative path
session_start();
if (isset($_GET["logout"])) {
	unset($_SESSION['userid']);
	unset($_SESSION['role']);
	
	// print_r($_SESSION);
	
}

?>

<?php
if(isset($_POST['login'])){
    include 'conn.php';

    $loemail = $_POST['loemail'];
    $lopass = $_POST['lopass'];
    
    if (empty($loemail) || empty($lopass)) {
        header('location: signin.php?error=emptyfields&loemail=' . $loemail);
        exit();
    } else {
        $sql = "SELECT id, name, email, password,role FROM users WHERE name = :name OR email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $loemail); // Bind to name and email, as you're checking both fields
        $stmt->bindParam(':email', $loemail);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row
		  
		 
        if($result){ // Check if a user was found
            $passcheck = password_verify($lopass, $result['password']);
            if($passcheck == false){
                header('location: signin.php?error=wrongpassword');
                exit();
            } else if($passcheck == true){
                
                $_SESSION['userid'] = $result['id'];
                $_SESSION['useridname'] = $result['name'];
				$_SESSION['role']=$result['role'];
                if(isset($_SESSION["page"])){
					header("location: $_SESSION[page]");
				}else{
					header("location: home.php");
				}  
                exit();
            }
        } else {
            header('location: signin.php?error=nouser');
            exit();
        }
    }
}
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
				<p>Don't have an account?</p>
				<button><a href="signup.php">Register</a></button>
			</div>
			<div class="wrapper">
				<form id="login" tabindex="500" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<h3>Login</h3>
                    <?php
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfields") {
							echo "<span> Fill all the fields! </span>";
						} else if ($_GET['error'] == "wrongpassword") {
							echo "<span> Wrong Password! </span>";
						}  else if ($_GET['error'] == "nouser") {
							echo "<span> No User Found, Please Register!</span>";
						}
					} 
					?>
					<div class="mail">
						<input type="email" name="loemail">
						<label>Email</label>
					</div>
					<div class="passwd">
						<input type="password" name="lopass">
						<label>Password</label>
					</div>
					<div class="submit">
						<button class="dark" name="login">Login</button>
					</div>
					<div class="social">
						<p>Login by</p>
						<button onclick="window.location = '<?php echo $login_url; ?>'"type="button" ><i class="fab fa-brands fa-google"></i></button>
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