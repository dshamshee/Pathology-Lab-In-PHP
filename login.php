<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="body login_body">
    <div class="container">
        <div class="heading">Sign In</div>
        <!-- Form submission -->
        <form action="" method="POST" class="form">
          <input required class="input" type="Admin_User_Name" name="Admin_User_Name" id="Admin_User_Name" placeholder="Username">
          <input required class="input" type="password" name="password" id="password" placeholder="Password">
          <span class="forgot-password"><a href="forgot_password.php">Forgot Password?</a></span>
          <input class="login-button" type="submit" name="login" value="Sign In">
        </form>

        <div class="social-account-container">
            <span class="title">Or Sign in with</span>
            <div class="social-accounts">
              <!-- Social button code here -->
            </div>
          </div>
          <span class="agreement"><a href="#">Learn user license agreement</a></span>
    </div>
</div>

<?php
require_once 'config/db.php'; // Include your functions.php for database connection

if (isset($_POST['login'])) {
    global $conn;
    $Admin_User_Name = mysqli_real_escape_string($conn, $_POST['Admin_User_Name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Validate credentials
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Admin_User_Name = ? AND password = ?");
    $stmt->bind_param("ss", $Admin_User_Name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Credentials are correct
        header("Location: Home.html");
        exit;
    } else {
        echo "<script>alert('Incorrect Admin_User_Name or password. Please try again.');</script>";
    }
}
?>

<script src="script.js"></script>
</body>
</html>
