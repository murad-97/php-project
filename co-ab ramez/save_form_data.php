<?php
$host = 'localhost';
$dbname = 'abc';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'An error occurred while connecting to the database: ' . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    try {
        $stmt = $db->prepare("INSERT INTO contact_us (Name, Email, Subject, Message) VALUES (:name, :email, :subject, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
        echo 'The form data has been successfully saved to the database.';
    } catch (PDOException $e) {
        echo 'An error occurred while saving to the database: ' . $e->getMessage();
    }
}




$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.example.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "you@example.com";
$mail->Password = "password";

$mail->setFrom($email, $name);
$mail->addAddress("alrijjalramez@gmail.com", "Dave");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.html");
