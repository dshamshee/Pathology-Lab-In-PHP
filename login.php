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