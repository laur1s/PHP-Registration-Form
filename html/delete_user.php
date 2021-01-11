<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

if (!$userRow['is_admin']) {
    echo "window.alert('You don`t have permissions for this operation')";
    header("Location: index.php");
    exit;
} else{
    $id=$_GET['id'];
    $stmts = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmts->bind_param("s", $id);
    $res = $stmts->execute();//get result
    echo "window.alert('Delete in result = {$res}')";
    $stmts->close();
    header("Location: users.php"); 
}

?>