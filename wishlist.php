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

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login');
    exit();
}

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
}

if (isset($_POST['delete_from_wishlist'])) {
    $wishlist_id = $_POST['wishlist_id'];
    $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

    $varify_delete_items = $conn->prepare("SELECT * FROM `wishlist` WHERE id=? ");
    $varify_delete_items->execute([$wishlist_id]);

    if ($varify_delete_items->rowCount() > 0) {
        $delete_wishlist_id = $conn->prepare("DELETE FROM `wishlist` WHERE id=?");
        $delete_wishlist_id->execute([$wishlist_id]);
        $success_msg[] = "produit supprimé avec succés";
    } else {
        $warning_msg[] = "produit déja supprimé ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - favoris</title>
    <style>
        <?php
        include "style.css"
        ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>

    <div class="wishlist">
        <div class="content">
            <div class="title">
                <p><span>NF </span>HAJJI SPORTS</p>
                <h1>Favoris</h1>
            </div>
            <div class="container">
                <?php
                $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = '$pid' ORDER BY date DESC");
                $select_wishlist->execute();
                if ($select_wishlist->rowCount() > 0) {
                    while ($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)) {
                        if ($fetch_wishlist["source"] === 'prods') {
                            $select_prod = $conn->prepare("SELECT * FROM `products` WHERE id = ? ORDER BY date DESC");
                            $select_prod->execute([$fetch_wishlist["product_id"]]);
                            if ($select_prod->rowCount() > 0) {
                                while ($fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC)) {
                ?>
                                    <a href="product?pid=<?= $fetch_prod["id"] ?>" class="grid">
                                        <form action="" method="post">
                                            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist["id"] ?>">
                                            <button type="submit" name="delete_from_wishlist" onclick="return confirm('supprimer produit de votre favoris !?')"><ion-icon name="close"></ion-icon></button>
                                        </form>
                                        <div class="img">
                                            <img src="imgs/prods/<?= $fetch_prod["img"] ?>" alt="">
                                        </div>
                                        <div class="desc">
                                            <h4><?= $fetch_prod["nom"] ?></h4>
                                            <h3><?= $fetch_prod["prix"] ?>DH</h3>
                                        </div>
                                    </a>
                                <?php
                                }
                            }
                        } else {
                            $select_prod = $conn->prepare("SELECT * FROM `promos` WHERE id = ? ORDER BY date DESC");
                            $select_prod->execute([$fetch_wishlist["product_id"]]);
                            if ($select_prod->rowCount() > 0) {
                                while ($fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <a href="p_promos?pid=<?= $fetch_prod["id"] ?>" class="grid">
                                        <form action="" method="post">
                                            <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist["id"] ?>">
                                            <button type="submit" name="delete_from_wishlist" onclick="return confirm('supprimer produit de votre favoris !?')"><ion-icon name="close"></ion-icon></button>
                                        </form>
                                        <div class="img">
                                            <img src="imgs/prods/<?= $fetch_prod["img"] ?>" alt="">
                                        </div>
                                        <div class="desc">
                                            <h4><?= $fetch_prod["nom"] ?></h4>
                                            <h3><?= $fetch_prod["newprix"] ?>DH</h3>
                                        </div>
                                    </a>
                    <?php
                                }
                            }
                        }
                    }
                } else {
                    ?>
                    <p class="vide">Aucun produit à afficher</p>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <style>
        .wishlist {
            width: 100%;
            height: auto;
            padding: 20px;
            padding-top: 80px;
        }

        .wishlist .content {
            width: 100%;
            height: auto;
        }

        .wishlist .content .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .wishlist .content .title p {
            font-size: 17px;
            color: var(--white);
            font-family: var(--light);
        }

        .wishlist .content .title p span {
            font-size: 18px;
            color: var(--cyan);
            font-family: var(--regular);
        }

        .wishlist .content .title h1 {
            font-size: 35px;
            color: var(--white);
            font-family: var(--bold);
        }

        .wishlist .content .container {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            padding: 20px;
            gap: 20px;
        }

        .wishlist .content .container .vide {
            text-align: center;
            font-size: 27px;
            font-family: var(--bold);
            color: var(--white);
        }

        .wishlist .content .container .grid {
            padding: 10px;
            background-color: var(--white);
            text-decoration: none;
            color: var(--cyan);
            font-family: var(--bold);
            transition: all ease .3s;
        }

        .wishlist .content .container .grid:hover {
            transform: scale(1.02);
        }

        .wishlist .content .container .grid .desc {
            display: flex;
            justify-content: space-between;
            width: 95%;
            margin: auto;
        }

        .wishlist .content .container .grid .img {
            width: 100%;
            height: 300px;
            display: flex;
            align-items: center;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .wishlist .content .container .grid .img img {
            width: 100%;
        }

        .wishlist .content .container .grid form {
            position: absolute;
        }

        .wishlist .content .container .grid form button {
            padding: 2px;
            background-color: transparent;
            border: none;
            color: var(--white);
            font-size: 32px;
            cursor: pointer;
        }

        @media screen and (max-width:799px) {
            .wishlist .content .container {
                grid-template-columns: repeat(1, 1fr);
                padding: 0;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .wishlist .content .container {
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