<?php 

require_once 'db.php';

// Display Admin Records
function display_admin(){
    global $conn;
    $query = 'select *from admin';
    $result = mysqli_query($conn, $query);
    return $result;
}


// Display Employee Records
function display_Employee(){
    global $conn;
    $query = 'select *from employee';
    $result = mysqli_query($conn, $query);
    return $result;
}

// Display Pathologist Records
function display_Pathologist(){
    global $conn;
    $query = 'select *from pathologist';
    $result = mysqli_query($conn, $query);
    return $result;
}

// Display Test Records
function display_Test(){
    global $conn;
    $query = 'select *from test';
    $result = mysqli_query($conn, $query);
    return $result;
}


// Insert  Admin Data
function insertAdmin($username, $firstName, $lastName, $email, $password) {
    global $conn;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "insert into admin values('$username', '$firstName', '$lastName', '$password', '$email')";
    $result = mysqli_query($conn, $query);

    // Execute the query
    if (!$result) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $result->error;
    }

    // Close the connection
    $conn->close();
}


// Fetch Admin Data
function fetch_admin($username) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM admin WHERE Admin_User_Name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Update Admin Data
function update_admin($username, $firstName, $lastName, $email, $password) {
    global $conn;
    $stmt = $conn->prepare("UPDATE admin SET first_name=?, last_name=?, email=?, password=? WHERE Admin_User_Name=?");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $password, $username);
    $stmt->execute();
    echo "done";
    $stmt->close();
}




// Insert  Pathologist Data
function insertPathologist($PH_ID, $Name, $Qualification, $Phone, $AdharNo, $Address, $Commission) {
    global $conn;
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "insert into Pathologist values('$PH_ID', '$Name', '$Qualification', '$Phone', '$AdharNo', '$Address', '$Commission')";
    $result = mysqli_query($conn, $query);

    // Execute the query
    if (!$result) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $result->error;
    }

    // Close the connection
    $conn->close();
}














// Insert  Employee Data
function insertEmployee($Full_Name, $Phone, $AdharNO, $Gender, $address, $profession, $salary) {
    global $conn;
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "insert into employee values('$Full_Name', '$Phone', '$AdharNO', '$Gender', '$address', '$profession', '$salary')";
    $result = mysqli_query($conn, $query);

    // Execute the query
    if (!$result) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $result->error;
    }

    // Close the connection
    $conn->close();
}


function fetch_employee($phone) {
    global $conn;
    $query = "SELECT * FROM employee WHERE Phone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $phone); // Bind the phone number as a string
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function update_employee($fullName, $phone,  $adharNO, $gender, $address, $Profession, $salary) {
    global $conn;
    if(!$conn){
        echo "Error Occured";
    }else{
        echo "Success.";
    }
    $query = "UPDATE employee SET Full_Name = ?, AdharNO = ?, Gender = ?, address = ?, Profession = ?, salary = ? WHERE Phone = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $fullName, $phone, $adharNO, $gender, $address, $Profession, $salary);
    $stmt->execute();
    // echo $fullName, "<br>";
    // echo $phone, "<br>";
    // echo $adharNO, "<br>";
    // echo $gender, "<br>";
    // echo $address, "<br>";
    // echo $Profession, "<br>";
    // echo $salary, "<br>";

     // Execute and check for errors
     if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}






// Insert  Test Data
function insert_Test($Tid, $TName, $Cost, $MinRange, $MaxRange, $Chid) {
    global $conn;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "insert into test values('$Tid', '$TName', '$Cost', '$MinRange', '$MaxRange', '$Chid')";
    $result = mysqli_query($conn, $query);

    // Execute the query
    // if (!$result) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $result->error;
    // }

    // Close the connection
    $conn->close();
}


function get_Test_By_Id($Tid) {
    global $conn; // Assuming $conn is the database connection variable established elsewhere
    $Tid = mysqli_real_escape_string($conn, $Tid); // Sanitize input to prevent SQL injection

    $query = "SELECT * FROM test WHERE Tid = '$Tid'"; // Replace 'test_table' with your actual table name
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    return $result; // Returns the result set
}



function update_Test($Tid, $TName, $Cost, $MinRange, $MaxRange, $Chid) {
    global $conn; // Assuming $conn is your database connection
    $query = "UPDATE test SET TName = '$TName', Cost = '$Cost', MinRange = '$MinRange', MaxRange = '$MaxRange', Chid = '$Chid' WHERE Tid = '$Tid'";
    mysqli_query($conn, $query);
}





?>