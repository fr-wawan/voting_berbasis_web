<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../public/auth/login.php");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $status = $_POST['status'];


    $errors = [];

    if (empty($nama)) {
        echo "<script>alert('Nama Pemilihan Tidak Boleh Kosong')</script>";
    }

    if (empty($errors)) {

        $sql = "INSERT INTO pemilihan (nama,status) VALUES (:nama,:status)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        echo "<script>alert('Create Data Berhasil')</script>";
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('" . $error . "')</script>";
        }
    }
}

?>


<?php
require_once("../../inc/header.php");
require_once("../../inc/admin_sidebar.php");

?>

<main class="admin form-crud">
    <h1>Create Pemilihan</h1>
    <form action="" method="post">
        <div class="input-wrapper">
            <label for="nama">Nama Pemilihan</label>
            <input type="text" name="nama" id="nama">
        </div>
        <div class="input-wrapper">
            <label for="status">Status Pemilihan</label>
            <select name="status" id="status">
                <option value="tidak_berlangsung">Tidak Berlangsung</option>
                <option value="berlangsung">Berlangsung</option>
            </select>
        </div>

        <div class="crud-button-wrapper">
            <a href="index.php">Back</a>
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</main>


<?php
require_once("../../inc/footer.php");
?>