<?php

$db_host = "localhost";
$db_name = "db";
$db_user = "admin";
$db_pass = "2enXukm9LMsd";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
