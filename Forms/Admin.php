
<?php
$username = $firstName = $lastName = $email = $password = "";
    if (isset($_POST['submit'])) {
        include '../config/functions.php';
        $username = $_POST['Username'];
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];

        insertAdmin($username, $firstName, $lastName, $email, $password);
        header("location: /Patholab in PHP/DisplayRecords/displayAdmin.php");
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Form</title>
  <link rel="stylesheet" href="login.css">
  <!-- Do not manipulate the CSS file -->
</head>

<body>
  <div class="body login_body">
   <!--Please Do not change the class name-->

  <div class="container">
    <div class="heading">Add Admin</div>
    <form action="" method="post" class="form">
      <input required="" class="input" type="text" name="Username" id="Username" placeholder="Username"  value="<?php echo htmlspecialchars($username); ?>">
      <input required="" class="input" type="text" name="FirstName" id="FirstName" placeholder="FirstName"  value="<?php echo htmlspecialchars($firstName); ?>">
      <input required="" class="input" type="text" name="LastName" id="LastName" placeholder="LastName"  value="<?php echo htmlspecialchars($lastName); ?>">
      <input required="" class="input" type="text" name="Email" id="Email" placeholder="Email"  value="<?php echo htmlspecialchars($email); ?>">
      <input required="" class="input" type="password" name="Password" id="Password" placeholder="Password"  value="<?php echo htmlspecialchars($password); ?>">
      <input class="login-button" type="submit" name="submit" value="Add">
      <a class="login-button" style="text-decoration: none; color: white; text-align: center;" href="../DisplayRecords/DisplayAdmin.php">Cancel</a>
    </form>
  </div>
  </div>
</div>
</body>
</html>