<?php 
// session_start();
// Include the configuration file  
require_once 'configration.php'; 
 
// Include the database connection file  
require_once 'dbConnect.php'; 
 
$payment_ref_id = $statusMsg = ''; 
$status = 'error'; 
 
// Check whether the payment ID is not empty 
if(!empty($_GET['checkout_ref_id'])){ 
    $payment_txn_id  = base64_decode($_GET['checkout_ref_id']); 
     
    // Fetch transaction data from the database 
    $sqlQ = "SELECT id,payer_id,payer_name,payer_email,payer_country,order_id,transaction_id,paid_amount,paid_amount_currency,payment_source,payment_status,created FROM transactions WHERE transaction_id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $stmt->bind_param("s", $payment_txn_id); 
    $stmt->execute(); 
    $stmt->store_result(); 
 
    if($stmt->num_rows > 0){ 
        // Get transaction details 
        $stmt->bind_result($payment_ref_id, $payer_id, $payer_name, $payer_email, $payer_country, $order_id, $transaction_id, $paid_amount, $paid_amount_currency, $payment_source, $payment_status, $created); 
        $stmt->fetch(); 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
try {
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbh = new PDO("mysql:host=$dbhost;dbname=mobile_tech", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>";
    die();
}


}else{ 
        $statusMsg = "Transaction has been failed!"; 
    } 
}else{ 
    header("Location: ndex.php"); 
    exit; 
} 
?>

<?php if(!empty($payment_ref_id)){ ?>
<?php include("config.php") ?>
   
<?php }else{ ?>
    <h1 class="error">Your Payment been failed!</h1>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php }?>