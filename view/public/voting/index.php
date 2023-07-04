<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['isLoggedIn'])) {
    header("Location: ../../public/auth/login.php");

    die();
}

$sql = "SELECT * FROM pemilihan";

$stmt = $pdo->query($sql);

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;
?>
<?php
require_once("../../inc/header.php");
?>

<main class="voting table-section">
    <h1>LIST PEMILIHAN</h1>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Pemilihan</th>
            <th>Tanggal Pemilihan</th>
            <th>Status Pemilihan</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pemilihan as $row) :  ?>
            <?php if ($row['status'] !== 'selesai') : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['tanggal_pemilihan'] ?></td>
                    <td>
                        <?php if ($row['status'] == 'tidak_berlangsung') :  ?>
                            <p class="tidak-berlangsung">Tidak Berlangsung</p>
                        <?php else : ?>
                            <p class="berlangsung">Berlangsung</p>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <a href="details.php?id=<?= $row['id'] ?>" style="background-color: blue;">View</a>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach; ?>

    </table>
</main>

<?php
require_once("../../inc/footer.php");
?>