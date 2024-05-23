<?php
// Connection details
$host = "localhost";
$user = "SHEMA";
$pass = "ERIC$700.";
$database = "virtualmusictherapysessionsplatform";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>