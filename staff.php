<?php
include "connexion.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login");
    exit();
}

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - Staff</title>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>
        <div class="videos_gallery">
            <?php
            $select_pics = $conn->prepare("SELECT * FROM `encadrement` where id='$pid'");
            $select_pics->execute();
            if ($select_pics->rowCount() > 0) {
                while ($fetch_pics = $select_pics->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="container_a">
                            <img src="imgs/encadrants/<?= $fetch_pics["img"] ?>" alt="">
                    </div>
                    <a href="<?=$fetch_pics["wikipedia"]?>">En savoir plus sur Wikipedia</a>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <style>
        .videos_gallery {
            width: 100%;
            height: auto;
            padding-top: 80px;
        }

        .videos_gallery .container_a {
            width: 100%;
            height: auto;
            justify-content: center;
            display: flex;
            margin-bottom: 30px;
        }

        .videos_gallery .container_a img {
            width: 80%;
            height: auto;
        }

        .videos_gallery a{
            font-size: 20px;
            font-family: var(--regular);
            color: var(--white);
            background-color: var(--cyan);
            text-decoration: none;
            padding: 5px 10px;
            margin: auto;
            margin-bottom: 20px;
            display: flex;
            width: 250px;
            align-items: center;
            justify-content: center;
        }
        </style>


    <?php include "index/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <?php include "alert.php" ?>

</body>

</html>
