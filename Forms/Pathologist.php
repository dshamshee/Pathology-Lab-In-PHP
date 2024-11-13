

<?php
require_once '../config/db.php'; // Include database connection

// Fetch the last PH_ID from the database and increment it for the new Pathologist
$query = "SELECT PH_ID FROM pathologist ORDER BY PH_ID DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$lastPid = 'PH00'; // Default value if no record is found

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lastPH_ID = $row['PH_ID'];
}

// Increment the PH_ID (assuming format is 'PH' followed by a number, like PH01, PH02, etc.)
$PH_IDNumber = (int) substr($lastPH_ID, 1);
$newPH_ID = 'PH' . str_pad($PH_IDNumber + 1, 2, '0', STR_PAD_LEFT);


 $Name = $Qualification = $Phone = $AdharNo = $Address = $Commission = "";
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
        $PH_ID = $Name = $Qualification = $Phone = $AdharNo = $Address = $Commission = "";

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
        <input required="" class="input" type="text" name="PH_ID" id="PH_ID" placeholder="PH_ID"  value="<?php echo htmlspecialchars($newPH_ID); ?>" readonly>
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