<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$id = $_GET['id'];

$sql = "DELETE FROM pemilihan WHERE id = '$id'";


$pdo->query($sql);

header("location:index.php");
