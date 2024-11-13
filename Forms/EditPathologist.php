<?php
require_once '../config/db.php';
require_once '../config/functions.php';

if (isset($_GET['PH_ID'])) {
    $PH_ID = $_GET['PH_ID'];
    $pathologist = fetch_pathologist($PH_ID); // Fetch Pathologist details based on PH_ID

    if (!$pathologist) {
        echo "No pathologist found with PH_ID: " . htmlspecialchars($PH_ID);
    }
}

if (isset($_POST['submit'])) {
    $PH_ID = $_POST['PH_ID']; // PH_ID should be read-only for updates
    $Name = $_POST['Name'];
    $Qualification = $_POST['Qualification'];
    $Phone = $_POST['Phone'];
    $AdharNo = $_POST['AdharNo'];
    $Address = $_POST['Address'];
    $Commission = $_POST['Commission'];
    update_pathologist($PH_ID, $Name, $Qualification, $Phone, $AdharNo, $Address, $Commission);
    header("Location: ../DisplayRecords/DisplayPathologist.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pathologist Data</title>
    <link rel="stylesheet" href="login.css" class="src">
</head>
<body>
<div class="body login_body">
    <div class="container">
        <div class="heading">Edit Pathologist Data</div>
        <form action="" method="post" class="form">
            <input readonly required class="input" type="text" name="PH_ID" placeholder="PH_ID" value="<?php echo htmlspecialchars($pathologist['PH_ID']); ?>">
            <input required class="input" type="text" name="Name" placeholder="Name" value="<?php echo htmlspecialchars($pathologist['Name']); ?>">
            <input required class="input" type="text" name="Qualification" placeholder="Qualification" value="<?php echo htmlspecialchars($pathologist['Qualification']); ?>">
            <input required class="input" type="text" name="Phone" placeholder="Phone" value="<?php echo htmlspecialchars($pathologist['Phone']); ?>">
            <input required class="input" type="text" name="AdharNo" placeholder="Adhar No" value="<?php echo htmlspecialchars($pathologist['AdharNo']); ?>">
            <input required class="input" type="text" name="Address" placeholder="Address" value="<?php echo htmlspecialchars($pathologist['Address']); ?>">
            <input required class="input" type="text" name="Commission" placeholder="Commission" value="<?php echo htmlspecialchars($pathologist['Commission']); ?>">
            <button type="submit" name="submit" class="login-button">Update</button>
            <a class="login-button" style="text-decoration: none; color: white; text-align: center;" href="../DisplayRecords/DisplayPathologist.php">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
