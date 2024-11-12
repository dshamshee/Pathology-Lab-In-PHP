<?php
include '../config/functions.php';

$Tid = $TName = $Cost = $MinRange = $MaxRange = $Chid = "";

// Fetch existing data based on Tid
if (isset($_GET['Tid'])) {
    $Tid = $_GET['Tid'];
    $result = get_Test_By_Id($Tid); // Assuming you have a function that fetches a record by Tid.
    $row = mysqli_fetch_assoc($result);

    $TName = $row['TName'];
    $Cost = $row['Cost'];
    $MinRange = $row['MinRange'];
    $MaxRange = $row['MaxRange'];
    $Chid = $row['Chid'];
}

// Update data when form is submitted
if (isset($_POST['submit'])) {
    $Tid = $_POST['Tid'];
    $TName = $_POST['TName'];
    $Cost = $_POST['Cost'];
    $MinRange = $_POST['MinRange'];
    $MaxRange = $_POST['MaxRange'];
    $Chid = $_POST['Chid'];

    update_Test($Tid, $TName, $Cost, $MinRange, $MaxRange, $Chid); // Assuming you have an update function.
    header("location: /Patholab in PHP/DisplayRecords/displayTest.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Test</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="body login_body">
        <div class="container">
            <div class="heading">Edit Test</div>
            <form action="" method="post" class="form">
                <input readonly class="input" type="text" name="Tid" id="Tid" placeholder="Tid" value="<?php echo htmlspecialchars($Tid); ?>">
                <input required class="input" type="text" name="TName" id="TName" placeholder="TName" value="<?php echo htmlspecialchars($TName); ?>">
                <input required class="input" type="text" name="Cost" id="Cost" placeholder="Cost" value="<?php echo htmlspecialchars($Cost); ?>">
                <input required class="input" type="text" name="MinRange" id="MinRange" placeholder="MinRange" value="<?php echo htmlspecialchars($MinRange); ?>">
                <input required class="input" type="text" name="MaxRange" id="MaxRange" placeholder="MaxRange" value="<?php echo htmlspecialchars($MaxRange); ?>">
                <input required class="input" type="text" name="Chid" id="Chid" placeholder="Chid" value="<?php echo htmlspecialchars($Chid); ?>">
                <input class="login-button" name="submit" type="submit" value="Update">
                <button class="login-button"><a style="text-decoration: none; color: white; text-align: center;" href="../DisplayRecords/DisplayTest.php">Cancel</a></button>
            </form>
        </div>
    </div>
</body>
</html>
