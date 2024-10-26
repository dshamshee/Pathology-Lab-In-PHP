

<?php
$PH_ID = $Name = $Qualification = $Phone = $AdharNo = $Address = $Commission = "";
    if (isset($_POST['submit'])) {
        include '../config/functions.php';
        $PH_ID = $_POST['PH_ID'];
        $Name = $_POST['Name'];
        $Qualification = $_POST['Qualification'];
        $Phone = $_POST['Phone'];
        $AdharNo = $_POST['AdharNo'];
        $Address = $_POST['Address'];
        $Commission = $_POST['Commission'];

        insertPathologist($PH_ID, $Name, $Qualification, $Phone, $AdharNo, $Address, $Commission);
        header("location: /Patholab in PHP/DisplayRecords/displayPathologist.php");
        // $PH_ID = $Name = $Qualification = $Phone = $AdharNo = $Address = $Commission = "";

    }
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pathologist Form</title>
  <link rel="stylesheet" href="login.css">
  <!-- Do not manipulate the CSS file -->
</head>

<body>

  <div class="body login_body">
    <!--Please Do not change the class name-->

    <div class="container">
      <div class="heading">Add Pathologist</div>
      <form action="" method="post" class="form">
        <input required="" class="input" type="text" name="PH_ID" id="PH_ID" placeholder="PH_ID"  value="<?php echo htmlspecialchars($PH_ID); ?>">
        <input required="" class="input" type="text" name="Name" id="Name" placeholder="Name"  value="<?php echo htmlspecialchars($Name); ?>">
        <input required="" class="input" type="text" name="Qualification" id="Qualification" placeholder="Qualifications"  value="<?php echo htmlspecialchars($Qualification); ?>">
        <input required="" class="input" type="text" name="Phone" id="Phone" placeholder="Phone Number"  value="<?php echo htmlspecialchars($Phone); ?>">
        <input required="" class="input" type="text" name="AdharNo" id="AdharNo" placeholder="Aaadhar Number"  value="<?php echo htmlspecialchars($AdharNo); ?>">
        <input required="" class="input" type="text" name="Address" id="Address" placeholder="Address"  value="<?php echo htmlspecialchars($Address); ?>">
        <input required="" class="input" type="text" name="Commission" id="Commission" placeholder="Commission"  value="<?php echo htmlspecialchars($Commission); ?>">
        <input class="login-button" name="submit" type="submit" value="Add">
      <a class="login-button" style="text-decoration: none; color: white; text-align: center;" href="../DisplayRecords/DisplayPathologist.php">Cancel</a>

      </form>
    </div>
  </div>
</body>

</html>