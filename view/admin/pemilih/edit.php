<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../public/auth/login.php");
}

$id = $_GET['id'];

$sql = "SELECT * FROM user WHERE id = $id";

$stmt = $pdo->query($sql);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];


    $errors = [];

    if (empty($nama_lengkap)) {
        echo "<script>alert('Nama Lengkap Tidak Boleh Kosong')</script>";
    }


    if (empty($alamat)) {
        echo "<script>alert('Alamat Tidak Boleh Kosong')</script>";
    }

    if (empty($tanggal_lahir)) {
        echo "<script>alert('Tanggal Lahir Tidak Boleh Kosong')</script>";
    }




    if (empty($errors)) {
        $sql = "UPDATE user SET nama_lengkap = :nama_lengkap,alamat = :alamat,tanggal_lahir = :tanggal_lahir,jenis_kelamin = :jenis_kelamin WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nama_lengkap", $nama_lengkap);
        $stmt->bindParam(":alamat", $alamat);
        $stmt->bindParam(":tanggal_lahir", $tanggal_lahir);
        $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        echo "<script>alert('Update Data Berhasil')</script>";
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
    <h1>Edit User</h1>
    <form action="" method="post">
        <div class="input-wrapper">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required value="<?= $user['nama_lengkap'] ?>">
        </div>

        <div class="input-wrapper">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" disabled value="<?= $user['email'] ?>">
        </div>
        <div class="input-flex">
            <div class="input-wrapper">
                <label for="no_ktp">No Ktp</label>
                <input type="number" name="no_ktp" id="no_ktp" disabled value="<?= $user['no_ktp'] ?>">
            </div>
            <div class="input-wrapper">

                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required value="<?= $user['tanggal_lahir'] ?>">
            </div>

        </div>

        <div class="input-flex">
            <div class="input-wrapper">

                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" required value="<?= $user['nama_lengkap'] ?>">
            </div>
            <div class="input-wrapper">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="pria" <?= $user['jenis_kelamin'] == 'pria' ? 'selected' : "" ?>>Pria</option>
                    <option value="wanita" <?= $user['jenis_kelamin'] == 'wanita' ? 'selected' : "" ?>>Wanita</option>
                </select>
            </div>
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