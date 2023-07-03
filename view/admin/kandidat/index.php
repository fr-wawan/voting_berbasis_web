<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../../public/auth/login.php");
}

$stmt = $pdo->query("SELECT kandidat.id AS id_kandidat,kandidat.nama AS nama_kandidat, kandidat.image AS kandidat_image,pemilihan.nama AS nama_pemilihan,pemilihan.id AS id_pemilihan FROM kandidat JOIN pemilihan WHERE kandidat.id_pemilihan = pemilihan.id");

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;
?>


<?php
require_once("../../inc/header.php");
require_once("../../inc/admin_sidebar.php");

?>

<main class="admin table-section">
    <div class="table-header">
        <a href="create.php">Create Kandidat</a>
    </div>
    <h2>List Kandidat</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Nama</th>
            <th>Nama Pemilihan</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pemilihan as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><img src="<?= $row['kandidat_image'] ?>" alt=""></td>
                <td><?= $row['nama_kandidat'] ?></td>
                <td>
                    <?= $row['nama_pemilihan'] ?>
                </td>
                <td class="actions">
                    <a href="edit.php?id=<?= $row['id_kandidat'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $row['id_kandidat'] ?>">Delete</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php
require_once("../../inc/footer.php");
?>