<?php
session_start();
include '../../classtmdt/clslogin.php';
$lo = new clslogin();
$lo->comfirmlogin($_SESSION['iduser'], $_SESSION['username'], $_SESSION['password'], $_SESSION['phanquyen']);
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container">
        <header>
            BANNER HEADER <br>
            <!-- hien thi button logout -->
            <?php
            if (isset($_SESSION['iduser'])) {
                echo '<form action="" method="post">
                    <input style="width: 80px; text-align: center;" type="submit" name="submitlogout" value="Logout">
                </form>';
            }
            if (isset($_POST['submitlogout'])) {
                session_destroy();
                header("Location: ../login/index.php");
            } else {
                echo '';
            }
            ?>
        </header>