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
    <title>hajji sport - encadrants</title>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>

    <div class="encadrants">
        <div class="title">
            <p><span>NF</span> Hajji sports</p>
            <h3>Nos STAFF</h3>
        </div>
        <div class="videos_gallery">
            <?php
            $select_vids = $conn->prepare("SELECT * FROM `encadrement`");
            $select_vids->execute();
            if ($select_vids->rowCount() > 0) {
                while ($fetch_vids = $select_vids->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="container_a">
                        <a href="staff?pid=<?=$fetch_vids['id']?>" class="img">
                            <img src="imgs/encadrants/<?= $fetch_vids["lien"] ?>" alt="">
                        </a>
                        <p><?= $fetch_vids["nom"] ?> <span>(<?= $fetch_vids["job_fr"] ?>)</span></p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <style>
        .encadrants {
            width: 100%;
            height: auto;
            padding: 20px;
            padding-top: 85px;
        }

        .encadrants .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .encadrants .title p {
            color: var(--white);
            font-size: 18px;
            font-family: var(--light);
        }

        .encadrants .title p span {
            font-family: var(--bold);
            color: var(--cyan);
        }

        .encadrants .title h3 {
            color: var(--white);
            font-size: 32px;
            font-family: var(--bold);
        }

        .videos_gallery {
            width: 100%;
            height: auto;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .videos_gallery .container_a {
            width: 100%;
            height: auto;
        }

        .videos_gallery .img {
            height: auto;
            background-color: var(--white);
            padding: 10px;
            transition: all ease .3s;
            display: flex;
        }

        .videos_gallery .img:hover {
            transform: scale(1.02);
            border-radius: 10px;
        }

        .videos_gallery .img img {
            width: 100%;
            height: 420px;
            box-shadow: 0px 0px 6px var(--black);
            transition: all ease .3s;
        }

        .videos_gallery .img:hover img:hover {
            border-radius: 10px;
        }

        .videos_gallery .container_a p {
            font-size: 17px;
            text-align: center;
            font-family: var(--bold);
            color: #1688c7;
            margin-top: 10px;
        }

        .videos_gallery .container_a p span {
            font-size: 17px;
            text-align: center;
            font-family: var(--bold);
            color: var(--white);
            margin-top: 10px;
        }

        @media screen and (max-width:799px) {
            .videos_gallery {
                grid-template-columns: repeat(1, 1fr);
                padding: 0;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .videos_gallery {
                grid-template-columns: repeat(2, 1fr);
                padding: 0;
            }
        }
    </style>

    <?php include "index/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <?php include "alert.php" ?>

</body>

</html>