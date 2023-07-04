<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$id = $_GET['id'];

$stmt = $pdo->query("SELECT kandidat.id AS id_kandidat,kandidat.nama AS nama_kandidat, kandidat.image AS kandidat_image,pemilihan.nama AS nama_pemilihan,pemilihan.id AS id_pemilihan FROM kandidat JOIN pemilihan WHERE kandidat.id_pemilihan = pemilihan.id AND kandidat.id_pemilihan = $id");

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;

$id = $_GET['id'];


?>


<?php
require_once("../../inc/header.php");
require_once("../../inc/admin_sidebar.php");

?>

<main class="admin table-section">
    <div class="table-header">
        <a href="index.php" style="background: red;">Back</a>

    </div>
    <h2>List Kandidat</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Nama Pemilihan</th>
            <th>Jumlah Voting</th>
        </tr>
        <?php foreach ($pemilihan as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><img src="<?= $row['kandidat_image'] ?>" alt="" width="75"></td>
                <td><?= $row['nama_kandidat'] ?></td>
                <td>
                    <?= $row['nama_pemilihan'] ?>
                </td>
                <?php
                $id_kandidat = $row['id_kandidat'];
                $sql = "SELECT COUNT(id_kandidat) FROM voting WHERE id_pemilihan = $id AND id_kandidat = $id_kandidat";

                $stmt = $pdo->query($sql);
                $count = $stmt->fetchColumn();
                ?>
                <td><?= $count ?></td>

            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php
require_once("../../inc/footer.php");
?>