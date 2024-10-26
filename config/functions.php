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
    // Database connection details
    // $servername = "localhost";
    // $dbname = "your_database_name";
    // $dbuser = "your_database_username";
    // $dbpass = "your_database_password";

    // // Create connection
    // $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
    global $conn;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // // Prepare and bind
    // $stmt = $conn->prepare("INSERT INTO Users (Username, FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?, ?)");
    // $stmt->bind_param("sssss", $username, $firstName, $lastName, $email, $hashedPassword);

    // // Hash the password before storing it
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $query = "insert into admin values('$username', '$firstName', '$lastName', '$password', '$email')";
    $result = mysqli_query($conn, $query);

    // Execute the query
    if (!$result) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $result->error;
    }

    // Close the connection
    // $stmt->close();
    $conn->close();
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




?>