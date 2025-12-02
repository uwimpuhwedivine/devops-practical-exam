<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - ShareRide</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: inline-block;
        }
        .success {
            color: #28a745;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .user-info {
            margin: 20px 0;
            padding: 15px;
            background-color: #e9ecef;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to ShareRide</h1>
        <div class="success">✅ Well logged in!</div>
        
        <div class="user-info">
            <p>Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong>!</p>
            <p>You have successfully logged into the system.</p>
        </div>
        
        <div>
            <a href="index.php" class="btn">Go to Home Page</a>
            <a href="logout.php" class="btn" style="background-color: #dc3545;">Logout</a>
        </div>
    </div>
</body>
</html>