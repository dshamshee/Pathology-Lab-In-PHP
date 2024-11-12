<?php
require_once '../config/db.php';
require_once '../config/functions.php';

// Check if the phone number is provided
if (isset($_GET['Tid'])) {
    $Tid = $_GET['Tid'];

    // Call the delete function to delete the employee record
    deleteTest($Tid);

    // Redirect back to the employee display page after deletion
    header('Location: DisplayTest.php');
    exit();
} else {
    echo "Error: Phone number not provided!";
}
?>
