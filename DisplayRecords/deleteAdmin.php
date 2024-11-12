<?php
require_once '../config/db.php';
require_once '../config/functions.php';

// Check if username is provided
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Call the delete function
    deleteAdmin($username);

    // Redirect back to the display page after deletion
    header('Location: DisplayAdmin.php');
    exit();
} else {
    echo "Error: Username not provided!";
}
?>
