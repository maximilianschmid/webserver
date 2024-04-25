<?php
// Database configuration
$host = 'localhost'; // or your host
$username = 'root';
$password = 'password';
$database = 'typo3_physiotherapiehuber';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";

// Perform query
$result = $conn->query("SELECT VERSION()");

// Fetch result
if ($result) {
    $row = $result->fetch_row();
    echo "MySQL server version: " . $row[0];
} else {
    echo "Query failed: " . $conn->error;
}

// Close connection
$conn->close();
?>
