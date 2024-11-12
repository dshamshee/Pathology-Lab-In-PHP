<?php
$Full_Name = $Phone = $AdharNO = $Gender = $address = $profession = $salary = "";
    if (isset($_POST['submit'])) {
        include '../config/functions.php';
        $Full_Name = $_POST['Full_Name'];
        $Phone = $_POST['Phone'];
        $AdharNO = $_POST['AdharNO'];
        $Gender = $_POST['Gender'];
        $address = $_POST['address'];
        $profession = $_POST['profession'];
        $salary = $_POST['salary'];

        insertEmployee($Full_Name, $Phone, $AdharNO, $Gender, $address, $profession, $salary);
        header("location: /Patholab in PHP/DisplayRecords/DisplayEmployee.php");
        $Full_Name = $Phone = $AdharNO = $Gender = $address = $profession = $salary = "";
    }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee  </title>
    <link rel= "stylesheet" href="login.css">
</head>
<body>
    
<div class="body Employee-body"> 
    <div class="container">
        <div class="heading"> Add Employee</div>
        <form action="" method="post" class="form">
            <input required="" class="input" type="text" name="Full_Name" id="Full_Name" placeholder="Full_Name" value="<?php echo htmlspecialchars($Full_Name); ?>">
            <input required="" class="input" type="text" name="Phone" id="Phone" placeholder="Phone" value="<?php echo htmlspecialchars($Phone); ?>">
            <input required="" class="input" type="text" name="AdharNO" id="AdharNO" placeholder="AdharNo" value="<?php echo htmlspecialchars($AdharNO); ?>">
            <div class="" >
                <div style="display: flex; flex-direction: row; height: auto; gap: 10px;">   
                <input required="" class="input" type="radio" name="Gender" id="Gender1" value="Male">
                <input required="" class="input" type="radio" name="Gender" id="Gender2" value="Female">
                <input required="" class="input" type="radio" name="Gender" id="Gender3" value="Transgender">
                </div>
                <div style="">
                    <label for="Gender1" style="margin-left: 39px;" > Male</label>
                    <label for="Gender1"  style="margin-left: 76px;"> Female</label>
                    <label for="Gender1"  style="margin-left: 50px;"> Transgender</label>
                </div>
            </div>
            <input required="" class="input" type="text" name="address" id="address" placeholder="address" value="<?php echo htmlspecialchars($address); ?>">
            <input required="" class="input" type="text" name="profession" id="Profession" placeholder="Profession" value="<?php echo htmlspecialchars($profession); ?>">
            <input  required="" class="input"type="text" name="salary" id="Salary" placeholder="Salary" value="<?php echo htmlspecialchars($salary); ?>">
            <input class="login-button" name="submit"  type="submit" value="Add">
        </form>

    </div>

</div>
    
</body>
</html>