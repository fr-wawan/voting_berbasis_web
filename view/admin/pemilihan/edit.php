<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$id = $_GET['id'];

$sql = "SELECT * FROM pemilihan WHERE id = '$id'";

$stmt = $pdo->query($sql);

$pemilihan = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $tanggal_pemilihan = $_POST['tanggal_pemilihan'];


    $errors = [];

    if (empty($nama)) {
        $errors[] =  "Nama Tidak Boleh Kosong";
    }


    if (empty($errors)) {

        $sql = "UPDATE pemilihan SET nama = :nama,status = :status,tanggal_pemilihan = :tanggal_pemilihan WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(':tanggal_pemilihan', $tanggal_pemilihan);
        $stmt->execute();

        echo "<script>alert('Update Data Berhasil')</script>";

        header("refresh: 0");
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error')</script>";
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
            <input type="text" name="nama" id="nama" value="<?= $pemilihan['nama'] ?>" required>
        </div>
        <div class="input-wrapper">
            <label for="status">Status Pemilihan</label>
            <select name="status" id="status" required>

                <option value="tidak_berlangsung" <?= $pemilihan['status'] == 'tidak_berlangsung' ? 'selected' : "" ?>>Tidak Berlangsung</option>
                <option value="berlangsung" <?= $pemilihan['status'] == 'berlangsung' ? 'selected' : "" ?>>Berlangsung</option>
                <option value="selesai" <?= $pemilihan['status'] == 'selesai' ? 'selected' : "" ?>>Selesai</option>
            </select>
        </div>

        <div class="input-wrapper">
            <label for="tanggal_pemilihan">Tanggal Pemilihan</label>
            <input type="date" name="tanggal_pemilihan" id="tanggal_pemilihan" value="<?= $pemilihan['tanggal_pemilihan'] ?>" required>
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