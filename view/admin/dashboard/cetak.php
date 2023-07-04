<?php


require_once("../../../config/database.php");

session_start();

if ($_SESSION['admin'] == false) {
    header("Location: ../../public/auth/login.php");
    die();
}


$id = $_GET['id'];

$sql = "SELECT * FROM kandidat WHERE id_pemilihan = $id";

$stmt = $pdo->query($sql);

$pemilihan = $stmt->fetchAll(PDO::FETCH_ASSOC);

$no = 1;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOTING</title>
    <link rel="stylesheet" href="../../../dist/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        .admin {
            width: 100%;
            margin: 3rem;

        }

        html,
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(246, 246, 246);
            font-family: "Noto Sans", sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            width: 90%;
        }

        th {
            background-color: var(--primary);
            color: var(--white);
        }

        th,
        td {
            padding: 0.9rem;
            border: 1px solid #ddd;
            text-align: center;
        }
    </style>
</head>

<body>

    <main class="admin table-section">

        <table>
            <tr>
                <th>No</th>
                <th>Nama Pemilihan</th>
                <th>Jumlah Voting</th>
            </tr>
            <?php foreach ($pemilihan as $row) :  ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>


                    <?php
                    $id_kandidat = $row['id'];
                    $sql = "SELECT COUNT(id_kandidat) FROM voting WHERE id_pemilihan = $id AND id_kandidat = $id_kandidat";

                    $stmt = $pdo->query($sql);
                    $count = $stmt->fetchColumn();
                    ?>
                    <td><?= $count ?></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </main>

</body>

</html>


<?php
require_once("../../../library/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = ob_get_contents();
ob_get_clean();

$dompdf->setPaper("A4", "landscape");
$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream("voting-kandidat", ["Attachment" => 0]);

?>