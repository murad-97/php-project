<?php
session_start();
class Connect extends PDO
{
    public function __construct()
    {
        parent::__construct(
            "mysql:host=localhost;dbname=mobile_tech",
            'root',
            '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}


class Controller
{
    private $connection; // Store the database connection


    public function generateCode($length)
    {
        $chars = "vwxyzABCD02789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
    public function __construct()
    {
        $this->connection = new Connect(); // Initialize the database connection
    }

    // Insert email and name into the database
    public function insertUserData($data)
    {
        $email = $data['email'];
        $name = $data['name'];
        $password = $this->generateCode(10); // Generate a 10-character password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password

        try {
            $sql = "SELECT id FROM users WHERE name = :name";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch a single row
            $rowCount = $stmt->rowCount();

            if ($rowCount > 0) {
                $_SESSION['userid'] = $result['id'];
                $_SESSION['useridname'] = $result['name'];
                $_SESSION['role'] = 0;
                if(isset($_SESSION["page"])){
					header("location: $_SESSION[page]");
				}else{
					header("location: home.php");
				}  
                
                exit();
            } else {
                $stmt = $this->connection->prepare("INSERT INTO users (email, name, password) VALUES (:email, :name, :password)");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':password', $hashedPassword);
                $stmt->execute();

                $lastInsertId = $this->connection->lastInsertId(); //to get the ID of the newly inserted user.
                $_SESSION['userid'] = $lastInsertId;
                $_SESSION['useridname'] = $name;
                $_SESSION['role'] = 0;
                if(isset($_SESSION["page"])){
					header("location: $_SESSION[page]");
				}else{
					header("location: home.php");
				}  
              
                exit();
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
// ... (rest of the code)
