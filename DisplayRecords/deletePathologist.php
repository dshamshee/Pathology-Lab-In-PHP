<?php
require_once '../config/db.php';
require_once '../config/functions.php';

// Check if the phone number is provided
if (isset($_GET['PH_ID'])) {
    $PH_ID = $_GET['PH_ID'];

    // Call the delete function to delete the employee record
    deletePathologist($PH_ID);

    // Redirect back to the employee display page after deletion
    header('Location: DisplayPathologist.php');
    exit();
} else {
    echo "Error: PH_ID not provided!";
}
?>