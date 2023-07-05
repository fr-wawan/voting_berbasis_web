<?php
require_once("../../../config/database.php");

session_start();

if (!isset($_SESSION['isLoggedIn'])) {
  header("Location: ../../public/auth/login.php");

  die();
}
$id = $_GET['id'];

$sql = "SELECT * FROM kandidat WHERE id_pemilihan = $id";

$stmt = $pdo->query($sql);

$kandidat = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;

$sql = "SELECT * FROM pemilihan WHERE id = $id";
$stmt = $pdo->query($sql);

$pemilihan = $stmt->fetch(PDO::FETCH_ASSOC);

$user_id = $_SESSION['id'];

$sql = "SELECT id_user FROM voting WHERE id_user = $user_id AND id_pemilihan = $id";

$stmt = $pdo->query($sql);

$voting = $stmt->fetchColumn();



if (isset($_POST['submit']) && $voting == false) {

  $vote_candidate_id = $_POST['voting'];

  $errors = [];

  if (empty($vote_candidate_id)) {
    $errors[] = "Voting Tidak Boleh Kosong";
  }

  if (empty($errors)) {
    $stmt = $pdo->prepare("INSERT INTO voting (id_user,id_pemilihan,id_kandidat) VALUES (:id_user,:id_pemilihan,:id_kandidat)");

    $stmt->bindParam(":id_user", $user_id);
    $stmt->bindParam(":id_pemilihan", $id);
    $stmt->bindParam(":id_kandidat", $vote_candidate_id);

    $stmt->execute();

    echo "<script>alert('Voting Berhasil')</script>";

    header("refresh: 0");
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


<main class="voting table-section">
  <a href="index.php" class="back-button">Back</a>
  <?php if ($voting) :  ?>
    <h1>Mohon Maaf Kamu Telah Voting</h1>
    <?php die() ?>
  <?php elseif ($pemilihan['status'] == "tidak_berlangsung" || $pemilihan['status']  == "selesai") :  ?>
    <h1>Mohon Maaf Voting Belum Berlangsung</h1>
    <?php die() ?>
  <?php endif; ?>
  <h1>List Kandidat Di <?= $pemilihan['nama'] ?></h1>

  <form action="" method="post">
    <table>
      <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama Kandidat</th>
        <th>Deskripsi</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($kandidat as $row) :  ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><img src="<?= $row['image'] ?>" alt="" width="75"></td>
          <td><?= $row['nama'] ?></td>
          <td style="width: 50%;"><?= $row['deskripsi'] ?></td>
          <td class="vote">
            <input hidden type="radio" name="voting" id="<?= $row['id'] ?>" value="<?= $row['id'] ?>" required>
            <label for="<?= $row['id'] ?>">Vote</label>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>

    <div class="button-wrapper">
      <button type="submit" name="submit">Kirim Voting</button>
    </div>
  </form>
</main>


<?php
require_once("../../inc/footer.php");
?>

<script>
</script>