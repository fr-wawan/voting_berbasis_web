<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$id = $_GET['id'];

$sql = "SELECT image FROM kandidat WHERE id = $id";

$stmt = $pdo->query($sql);

$gambar_lama = $stmt->fetchColumn();

unlink($gambar_lama);

$sql = "DELETE FROM kandidat WHERE id = '$id'";
$pdo->query($sql);

header("location:index.php");
