<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - ShareRide</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .welcome {
            text-align: center;
            font-size: 18px;
            margin-top: 40px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ShareRide Application</h1>
        <h2>Welcome to Our Platform</h2>
        
        <div class="menu">
            <a href="registration.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>
        </div>
        
        <div class="welcome">
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
                echo "<h3>Welcome back! You are logged in.</h3>";
                echo '<a href="logout.php" class="btn" style="background-color: #dc3545;">Logout</a>';
            } else {
                echo "<p>Please register or login to continue.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>