<?php
require_once '../config/db.php';
require_once '../config/functions.php';

// Check if the phone number is provided
if (isset($_GET['phone'])) {
    $phone = $_GET['phone'];

    // Call the delete function to delete the employee record
    deleteEmployee($phone);

    // Redirect back to the employee display page after deletion
    header('Location: DisplayEmployee.php');
    exit();
} else {
    echo "Error: Phone number not provided!";
}
?>
