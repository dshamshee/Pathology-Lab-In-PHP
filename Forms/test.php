<?php
$Tid = $TName = $Cost = $MinRange = $MaxRange = $Chid = "";
    if (isset($_POST['submit'])) {
        include '../config/functions.php';
        $Tid = $_POST['Tid'];
        $TName = $_POST['TName'];
        $Cost = $_POST['Cost'];
        $MinRange = $_POST['MinRange'];
        $MaxRange = $_POST['MaxRange'];
        $Chid = $_POST['Chid'];

        insert_Test($Tid, $TName, $Cost, $MinRange, $MaxRange, $Chid);
        header("location: /Patholab in PHP/DisplayRecords/displayTest.php");
    }
    ?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Admin</title>
  <link rel="stylesheet" href="login.css">
  <!-- Do not manipulate the CSS file -->
</head>

<body>
  <div class="body login_body">
   <!--Please Do not change the class name-->

  <div class="container">
    <div class="heading">Add Test</div>
    <form action="" method="post" class="form">
      <input required="" class="input" type="text" name="Tid" id="Tid" placeholder="Tid" value="<?php echo htmlspecialchars($Tid); ?>">
      <input required="" class="input" type="text" name="TName" id="TName" placeholder="TName" value="<?php echo htmlspecialchars($TName); ?>">
      <input required="" class="input" type="text" name="Cost" id="Cost" placeholder="Cost" value="<?php echo htmlspecialchars($Cost); ?>">
      <input required="" class="input" type="text" name="MinRange" id="MinRange" placeholder="MinRange" value="<?php echo htmlspecialchars($MinRange); ?>">
      <input required="" class="input" type="text" name="MaxRange" id="MaxRang" placeholder="MaxRange" value="<?php echo htmlspecialchars($MaxRange); ?>">
      <input required="" class="input" type="text" name="Chid" id="Chid" placeholder="Chid" value="<?php echo htmlspecialchars($Chid); ?>">
      <input class="login-button" name="submit" type="submit" value="Add">
    </form>
  </div>
  </div>
  </div>
</div>
</body>

</html>