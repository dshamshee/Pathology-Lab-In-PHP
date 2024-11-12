<?php 

require_once '../config/db.php';
require_once '../config/functions.php';

$result = display_Employee();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Employee Data</title>
    <link rel="stylesheet" href="../src/output.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            /* margin: 20px 0; */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: large;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body class="bg-slate-500 flex justify-center mb-10">

<div class="container w-[1400px] bg-yellow-50 mt-10 rounded-lg p-5">

    <!-- Admin Table -->
    <h2 class="font-bold text-3xl text-center mt-2 mb-5">Employee's Records</h2>
    <button class="bg-blue-600 hover:bg-blue-800 text-white p-1 pr-2 pl-2 rounded-md font-bold"><a href="../Forms/Employee.php"> Add New</a></button>

    <table>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Adhar Number</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Profession</th>
            <th>Salary</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <!-- Add rows dynamically -->
        <tr>
            <?php 
        
        while($row = mysqli_fetch_assoc($result)){
            ?>
        <td><?php echo $row['Full_Name'] ?></td>
        <td><?php echo $row['Phone'] ?></td>
        <td><?php echo $row['AdharNO'] ?></td>
        <td><?php echo $row['Gender'] ?></td>
        <td><?php echo $row['address'] ?></td>
        <td><?php echo $row['Profession'] ?></td>
        <td><?php echo $row['salary'] ?></td>
        <td ><a href="../Forms/editEmployee.php?phone=<?php echo $row['Phone']; ?>" class="bg-blue-600 hover:bg-blue-800 text-white p-1 pr-2 pl-2 rounded-md font-bold">Edit</a></td>
        <td><button class="bg-red-600 hover:bg-red-800 text-white p-1 rounded-md font-bold">Delete  </button></td>
    </tr>
    <?php 
        }
        ?>  
        
        




</table>
</div>
</body>
</html>