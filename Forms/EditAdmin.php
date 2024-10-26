<?php
require_once '../config/db.php';
require_once '../config/functions.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $user = fetch_admin($username); // Fetch admin details based on username
}

if (isset($_POST['submit'])) {
    $username = $_POST['Username'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    update_admin($username, $firstName, $lastName, $email, $password);
    header("Location: ../DisplayRecords/DisplayAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Data</title>
    <!-- <link rel="stylesheet" href="../src/output.css"> -->
    <link rel="stylesheet" href="login.css" class="src">
</head>
<body>
<div class="body login_body">
   <!--Please Do not change the class name-->

  <div class="container">
    <div class="heading">Edit Admin Data</div>
    <form action="" method="post" class="form">
        <input readonly required class="input" type="text" name="Username" placeholder="Username" value="<?php echo htmlspecialchars($user['Admin_User_Name']); ?>">
        <input required class="input" type="text" name="FirstName" placeholder="FirstName" value="<?php echo htmlspecialchars($user['first_name']); ?>">
        <input required class="input" type="text" name="LastName" placeholder="LastName" value="<?php echo htmlspecialchars($user['last_name']); ?>">
        <input required class="input" type="text" name="Email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>">
        <input class="input" type="password" name="Password" placeholder="Password"  value="<?php echo htmlspecialchars($user['password']); ?>">
        <button  type="submit" name="submit" class="login-button">Update</button>
        <a class="login-button" style="text-decoration: none; color: white; text-align: center;" href="DisplayAdmin.php">Cancel</a>
    </form>
    </div>
  </div>
</div>
</body>
</html>
