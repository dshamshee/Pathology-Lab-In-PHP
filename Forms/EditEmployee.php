<?php
require_once '../config/db.php';
require_once '../config/functions.php';

if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];
    $employee = fetch_employee($phone); // Fetch employee details based on the phone number

    if (!$employee) {
        echo "No employee found with phone: " . htmlspecialchars($phone);
    }
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['Full_Name'];
    $phone = $_POST['Phone']; // Using phone as the identifier
    $adharNO = $_POST['AdharNO'];
    $gender = $_POST['Gender'];
    $address = $_POST['address'];
    $Profession = $_POST['Profession'];
    $salary = $_POST['salary'];
    update_employee( $fullName, $phone, $adharNO, $gender, $address, $Profession, $salary);
    header("Location: ../DisplayRecords/DisplayEmployee.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Data</title>
    <link rel="stylesheet" href="login.css" class="src">
</head>
<body>
<div class="body login_body">
    <!-- Container for editing employee data -->
    <div class="container">
        <div class="heading">Edit Employee Data</div>
        <form action="" method="post" class="form">
            <input required class="input" type="text" name="Full_Name" placeholder="Full Name" value="<?php echo htmlspecialchars($employee['Full_Name']); ?>">
            <input readonly required class="input" type="text" name="Phone" placeholder="Phone" value="<?php echo htmlspecialchars($employee['Phone']); ?>">
            <input required class="input" type="text" name="AdharNO" placeholder="Adhar No" value="<?php echo htmlspecialchars($employee['AdharNO']); ?>">
            <div style="display: flex; flex-direction: row; gap: 10px;">
                <input required class="input" type="radio" name="Gender" id="Male" value="Male" <?php echo ($employee['Gender'] == 'Male') ? 'checked' : ''; ?>> 
                <label for="Male">Male</label>
                <input required class="input" type="radio" name="Gender" id="Female" value="Female" <?php echo ($employee['Gender'] == 'Female') ? 'checked' : ''; ?>> 
                <label for="Female">Female</label>
                <input required class="input" type="radio" name="Gender" id="Other" value="Other" <?php echo ($employee['Gender'] == 'Other') ? 'checked' : ''; ?>> 
                <label for="Other">Other</label>
            </div>
            <input required class="input" type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($employee['address']); ?>">
            <input required class="input" type="text" name="Profession" placeholder="Profession" value="<?php echo htmlspecialchars($employee['Profession']); ?>">
            <input required class="input" type="text" name="salary" placeholder="Salary" value="<?php echo htmlspecialchars($employee['salary']); ?>">
            <button type="submit" name="submit" class="login-button">Update</button>
            <a class="login-button" style="text-decoration: none; color: white; text-align: center;" href="DisplayEmployee.php">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
