<?php
// Connection details
$host = "localhost";
$user = "Baraka";
$pass = "Ritha$07";
$database = "carrentalsystem";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>