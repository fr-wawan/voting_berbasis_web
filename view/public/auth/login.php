<?php
require_once("../../../config/database.php");

session_start();


function loginUser($email, $password, $pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");


    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user && !password_verify($password, $user['password'])) {
        echo "<script>alert('Email Tidak Ditemukan')</script>";
        return false;
    }

    $_SESSION['isLoggedIn'] = true;
    $_SESSION['id'] = $user['id'];

    if ($user['role'] == 'admin') {

        $_SESSION['admin'] = true;
        header("Location: ../../admin/dashboard/index.php");
    } else {
        $_SESSION['admin'] = false;
        header("Location: ../voting/index.php");
    }

    echo "<script>alert('Login Berhasil')</script>";
}


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($email)) {
        echo "<script>alert('Email Tidak Boleh Kosong')</script>";
    }

    if (empty($password)) {
        echo "<script>alert('Password Tidak Boleh Kosong')</script>";
    }

    if (empty($errors)) {
        loginUser($email, $password, $pdo);
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('" . $error . "')</script>";
        }
    }
}


?>

<?php
require_once("../../inc/header.php");
?>

<main class="auth">
    <h1>LOGIN</h1>
    <form action="" method="post">

        <div class="input-wrapper">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="input-wrapper">

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="auth-button-wrapper">
            <button type="submit" name="submit">SUBMIT</button>
        </div>

    </form>

</main>

<?php
require_once("../../inc/footer.php");
?>