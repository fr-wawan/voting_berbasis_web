<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$sql = "SELECT * FROM pemilihan";

$stmt = $pdo->query($sql);

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $id_pemilihan = $_POST['id_pemilihan'];
    $deskripsi = $_POST['deskripsi'];

    $target_dir = "../../images/kandidat/";
    $tmp_name = uniqid(1, true) .  basename($_FILES['image']['tmp_name']);

    $target_file = explode('.', $tmp_name);

    $target_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    $finalFile = $target_dir . $target_file[0] . '.' .  $target_ext;


    $errors = [];

    if (empty($nama)) {
        $errors[] = "Nama Tidak Boleh Kosong";
    }

    if (empty($deskripsi)) {
        $errors[] = "Deskripsi Tidak Boleh Kosong";
    }

    if (empty($finalFile)) {
        $errors[] = "Gambar Tidak Boleh Kosong";
    }

    if (empty($errors)) {

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $finalFile)) {
            echo "<script>alert('Upload Gambar Gagal')</script>";
            return;
        }
        $sql = "INSERT INTO kandidat (nama,id_pemilihan,deskripsi,image) VALUES (:nama,:id_pemilihan,:deskripsi,:image)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':id_pemilihan', $id_pemilihan);
        $stmt->bindParam(":deskripsi", $deskripsi);
        $stmt->bindParam(":image", $finalFile);
        $stmt->execute();
        echo "<script>alert('Create Data Berhasil')</script>";
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
    <h1>Create Kandidat</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-wrapper">
            <label for="nama">Nama Kandidat</label>
            <input type="text" name="nama" id="nama" required placeholder="Nama Kandidat...">
        </div>
        <div class="input-wrapper">
            <label for="id_pemilihan">Pemilihan</label>
            <select name="id_pemilihan" id="id_pemilihan" required>
                <?php foreach ($pemilihan as $row) : ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-wrapper">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required placeholder="Visi & Misi Kandidat..."></textarea>
        </div>

        <div class="input-wrapper">
            <label for="image">Gambar Kandidat</label>
            <input type="file" name="image" id="image" required>
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