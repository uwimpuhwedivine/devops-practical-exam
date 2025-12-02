<?php
session_start();
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please enter email and password";
        header("Location: login.php");
        exit();
    }
    
    $database = new Database();
    $db = $database->getConnection();
    
    // Check user credentials
    $query = "SELECT user_id, user_firstname, user_lastname, user_password 
              FROM tbl_users 
              WHERE user_email = :email";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verify password
        if (password_verify($password, $row['user_password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_firstname'] . ' ' . $row['user_lastname'];
            
            // Redirect to home page
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid email or password";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>