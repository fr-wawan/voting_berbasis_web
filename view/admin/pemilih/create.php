<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

function isDuplicateEmail($email, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");

    $stmt->bindParam(':email', $email);

    $stmt->execute();

    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $user;
}

function isDuplicateKtp($no_ktp, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM user WHERE no_ktp = :no_ktp");


    $stmt->bindParam(':no_ktp', $no_ktp);

    $stmt->execute();

    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);


    return $user;
}

function registerUser($nama_lengkap, $email, $no_ktp, $alamat, $tanggal_lahir, $jenis_kelamin, $password, $konfirmasi_password, $pdo)
{
    if (isDuplicateEmail($email, $pdo) || isDuplicateKtp($no_ktp, $pdo)) {
        echo "<script>alert('Email / No KTP sudah ada')</script>";
    } else {

        if ($password !== $konfirmasi_password) {
            echo "<script>alert('Konfirmasi Password Tidak Sama')</script>";
            return false;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);


        $stmt = $pdo->prepare("INSERT INTO user (nama_lengkap,email,no_ktp,alamat,tanggal_lahir,jenis_kelamin,password) VALUES (:nama_lengkap,:email,:no_ktp,:alamat,:tanggal_lahir,:jenis_kelamin,:password)");

        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':no_ktp', $no_ktp);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':password', $hashed);

        $stmt->execute();

        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email AND no_ktp = :no_ktp");


        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':no_ktp', $no_ktp);

        $stmt->execute();

        echo "<script>
        alert('Create Data Berhasil') 
        </script>";
    }
}

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $no_ktp = $_POST['no_ktp'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    $errors = [];

    if (empty($nama_lengkap)) {
        $errors[] =  "Nama Lengkap Tidak Boleh Kosong";
    }

    if (empty($email)) {
        $errors[] =  "Email Tidak Boleh Kosong";
    }

    if (empty($no_ktp)) {
        $errors[] =  "No Ktp Tidak Boleh Kosong";
    }

    if (empty($alamat)) {
        $errors[] =  "Alamat Tidak Boleh Kosong";
    }

    if (empty($tanggal_lahir)) {
        $errors[] =  "Tanggal Lahir Tidak Boleh Kosong";
    }

    if (empty($password)) {
        $errors[] =  "Password Tidak Boleh Kosong";
    }

    if (empty($konfirmasi_password)) {
        $errors[] =  "Konfirmasi Password Tidak Boleh Kosong";
    }


    if (empty($errors)) {
        registerUser($nama_lengkap, $email, $no_ktp, $alamat, $tanggal_lahir, $jenis_kelamin, $password, $konfirmasi_password, $pdo);

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
    <h1>Create User</h1>
    <form action="" method="post">
        <div class="input-wrapper">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required>
        </div>

        <div class="input-wrapper">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-flex">
            <div class="input-wrapper">
                <label for="no_ktp">No Ktp</label>
                <input type="number" name="no_ktp" id="no_ktp" required>
            </div>
            <div class="input-wrapper">

                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>

        </div>

        <div class="input-flex">
            <div class="input-wrapper">

                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div class="input-wrapper">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="pria">Laki-Laki</option>
                    <option value="wanita">Perempuan</option>
                </select>
            </div>
        </div>


        <div class="input-wrapper">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="input-wrapper">
            <label for="konfirmasi_password">Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password" id="konfirmasi_password" required>
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