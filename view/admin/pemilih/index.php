<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$stmt = $pdo->query("SELECT * FROM user");

$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;
?>
<?php
require_once("../../inc/header.php");
require_once("../../inc/admin_sidebar.php");

?>

<main class="admin table-section">
    <div class="table-header">
        <a href="create.php">Create User</a>
    </div>
    <h2>List User</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama lengkap</th>
            <th>Email</th>
            <th>No Ktp</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($user as $row) : ?>
            <?php if ($row['role'] == 'pemilih') { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_lengkap'] ?></td>
                    <td>
                        <?= $row['email'] ?>
                    </td>
                    <td>
                        <?= $row['no_ktp'] ?>
                    </td>
                    <td>
                        <?= $row['alamat'] ?>
                    </td>
                    <td>
                        <?= $row['tanggal_lahir'] ?>
                    </td>
                    <td>
                        <?= $row['jenis_kelamin'] ?>
                    </td>
                    <td class="actions">
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are You Sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php endforeach; ?>
    </table>
</main>

<?php
require_once("../../inc/footer.php");
?>