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

</head>

<body>

    <header>
        <nav class="navbar">
            <h1><a href="../../../view/public/voting/index.php">VOTING</a></h1>
            <ul>
                <li><a href="../../../view/public/voting/index.php">VOTE</a></li>
            </ul>
            <div class="navbar-right">
                <?php if (!isset($_SESSION['isLoggedIn'])) { ?>
                    <a href="../../../view/public/auth/login.php">Sign In</a>
                <?php } elseif (isset($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                    <a href="../../../view/admin/dashboard/index.php">Admin</a>
                    <a href="../../../view/public/auth/logout.php">Logout</a>
                <?php } else { ?>
                    <a href="../../../view/public/auth/logout.php">Logout</a>
                <?php } ?>
            </div>
        </nav>
    </header>