<?php
include "credentials.php";

// Database connection
$connection = new mysqli('localhost', $user, $pw, $db);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Select all records from the Assig3 table
$AllRecords =  $connection->prepare("SELECT * FROM Assig3 ORDER BY item ASC");
$AllRecords->execute();
$result = $AllRecords->get_result();
?>
