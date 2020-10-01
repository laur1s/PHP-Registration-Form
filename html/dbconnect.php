<?php
//database authentication anmd connection
$conn = new mysqli('mysql', 'root', 'pass', 'db');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
