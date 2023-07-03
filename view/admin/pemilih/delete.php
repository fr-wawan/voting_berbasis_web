<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../public/auth/login.php");
}

$id = $_GET['id'];

$sql = "DELETE FROM user WHERE id = '$id'";


$pdo->query($sql);

header("location:index.php");
