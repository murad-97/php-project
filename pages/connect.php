<?php
    $host = 'localhost'; // Replace with your host
    $dbname = 'mobile_tech'; // Replace with your database name
    $username = 'root'; // Replace with your username
    $password = ''; // Replace with your password
    
    // Create a new PDO instance
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }