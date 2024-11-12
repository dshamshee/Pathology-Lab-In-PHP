<?php
$host = 'localhost'; // your host
$dbname = 'test'; // your database name
$username = 'root'; // your username
$password = ''; // your password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT * FROM test");
    $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($tests);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
