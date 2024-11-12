<?php
require_once '../config/db.php'; // Include database connection

// Fetch the last Pid from the database and increment it for the new patient
$query = "SELECT Pid FROM patient ORDER BY Pid DESC LIMIT 1";
$result = mysqli_query($conn, $query);
$lastPid = 'P00'; // Default value if no record is found

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $lastPid = $row['Pid'];
}

// Increment the Pid (assuming format is 'P' followed by a number, like P01, P02, etc.)
$pidNumber = (int) substr($lastPid, 1);
$newPid = 'P' . str_pad($pidNumber + 1, 2, '0', STR_PAD_LEFT);

// Get the current date
$currentDate = date('d-m-y');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch patient data from form submission
    $name = $_POST['Name'];
    $age = $_POST['Age'];
    $gender = $_POST['Gender'];
    $phone = $_POST['Phone'];
    $userID = $_POST['User_ID'];
    $pdate = $currentDate;
    $refby = $_POST['refby'];

    // Insert patient data into the database
    $insertQuery = "INSERT INTO patient (Pid, Name, Age, Gender, Phone, User_ID, pdate, refby) 
                    VALUES ('$newPid', '$name', '$age', '$gender', '$phone', '$userID', '$pdate', '$refby')";

    if (mysqli_query($conn, $insertQuery)) {
        // Redirect to the receipt page with the patient details
        header("Location: /Patholab in PHP/Forms/receipt2.php?patient_id=$newPid&patient_name=$name&gender=$gender&age=$age&bill_no=BL1"); // Add more parameters if needed
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient</title>
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <div class="body login_body">
    <div class="container">
      <div class="heading">Patient</div>
      <form action="" method="post" class="form">
        <input required="" class="input" type="text" name="Pid" id="Pid" value="<?php echo htmlspecialchars($newPid); ?>" readonly>
        <input required="" class="input" type="text" name="Name" id="Name" placeholder="Name">
        <input required="" class="input" type="text" name="Age" id="Age" placeholder="Age">
        <input required="" class="input" type="text" name="Gender" id="Gender" placeholder="Gender">
        <input required="" class="input" type="text" name="Phone" id="Phone" placeholder="Phone">
        <input required="" class="input" type="text" name="User_ID" id="User_ID" placeholder="User_ID">
        <input required="" class="input" type="text" name="pdate" id="pdate" value="<?php echo htmlspecialchars($currentDate); ?>" readonly>
        <input required="" class="input" type="text" name="refby" id="refby" placeholder="refby">
        <input class="login-button" type="submit" value="Add">
      </form>
    </div>
  </div>
</body>

</html>
