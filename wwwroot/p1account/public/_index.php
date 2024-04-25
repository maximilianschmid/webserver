<?php
$host = 'localhost';
$user = 'root';
$pass = '64zm2JNUq8rR97a';
$db = 'typo3_physiotherapiehuber';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL successfully";

$conn->close();
?>
