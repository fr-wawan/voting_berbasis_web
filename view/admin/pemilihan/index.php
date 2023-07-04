<?php
require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}

$stmt = $pdo->query("SELECT * FROM pemilihan");

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;
?>


<?php
require_once("../../inc/header.php");
require_once("../../inc/admin_sidebar.php");

?>

<main class="admin table-section">
    <div class="table-header">
        <a href="create.php">Create Pemilihan</a>
    </div>
    <h2>List Pemilihan</h2>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pemilihan as $row) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td>
                    <?php if ($row['status'] == 'tidak_berlangsung') { ?>
                        <p class="tidak-berlangsung">Tidak Berlangsung</p>
                    <?php } elseif ($row['status'] == "berlangsung") { ?>
                        <p class="berlangsung">Berlangsung</p>
                    <?php } else { ?>
                        <p class="selesai">Selesai</p>
                    <?php } ?>
                </td>
                <td class="actions">
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are You Sure?')">Delete</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php
require_once("../../inc/footer.php");
?>