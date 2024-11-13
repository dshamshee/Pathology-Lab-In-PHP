<?php 

require_once '../config/db.php';
require_once '../config/functions.php';

$result = display_Test();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Test Data</title>
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
    <h2 class="font-bold text-3xl text-center mt-2 mb-5">Test Records</h2>
    <button class="bg-blue-600 hover:bg-blue-800 text-white p-1 pr-2 pl-2 rounded-md font-bold"><a href="../Home.html">Home</a></button>
    <button class="bg-blue-600 hover:bg-blue-800 text-white p-1 pr-2 pl-2 rounded-md font-bold"><a href="../Forms/test.php"> Add New</a></button>
    <!-- <h1 class="bg-red-500">Danish</h1> -->
    <table>
        <tr>
            <th>Tid</th>
            <th>TName</th>
            <th>Cost</th>
            <th>MinRange</th>
            <th>MaxRange</th>
            <th>Chid</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
        <!-- Add rows dynamically -->
        <tr>
            <?php 
        
        while($row = mysqli_fetch_assoc($result)){
            ?>
        <td><?php echo $row['Tid'] ?></td>
        <td><?php echo $row['TName'] ?></td>
        <td><?php echo $row['Cost'] ?></td>
        <td><?php echo $row['MinRange'] ?></td>
        <td><?php echo $row['MaxRange'] ?></td>
        <td><?php echo $row['Chid'] ?></td>
        <td ><a href="../Forms/editTest.php?Tid=<?php echo $row['Tid']; ?>" class="bg-blue-600 hover:bg-blue-800 text-white p-1 pr-2 pl-2 rounded-md font-bold">Edit</a></td>
        <!-- <td><button class="bg-red-600 hover:bg-red-800 text-white p-1 rounded-md font-bold">Delete  </button></td> -->
        <td>
    <a href="deleteTest.php?Tid=<?php echo $row['Tid']; ?>" 
       class="bg-red-600 hover:bg-red-800 text-white p-1 rounded-md font-bold">
       Delete
    </a>
</td>
    </tr>
    <?php 
        }
        ?>  
        
        




</table>
</div>
</body>
</html>