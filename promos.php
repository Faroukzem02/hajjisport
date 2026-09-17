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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - PROMOS</title>
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
    <div class="list">
        <p class="title"><span>NF</span> HAJJI SPORTS MAROC</p>
        <h1>Promotions pour vous</h1>
        <div class="products">
            <?php
            $select_prods = $conn->prepare("SELECT * from `promos`");
            $select_prods->execute();
            if ($select_prods->rowCount() > 0) {
                while ($fetch_prods = $select_prods->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <a href="p_promos?pid=<?= $fetch_prods["id"] ?>#product-container" class="product">
                        <div class="img">
                            <img src="imgs/prods/<?= $fetch_prods["img"] ?>" alt="">
                        </div>
                        <div class="name_price">
                            <p class="name"><?= $fetch_prods["nom"] ?></p>
                            <div class="price">
                                <p class="price" style="color: rgb(240,7,7);text-decoration:line-through"><?= $fetch_prods["oldprix"] ?> DH</p>
                                <p class="price"><?= $fetch_prods["newprix"] ?> DH</p>
                            </div>
                        </div>
                        <p class="type"><?= $fetch_prods["category_fr"] ?></p>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <style>
        .list {
            width: 100%;
            padding: 20px;
            padding-top: 80px;
        }

        .list .title {
            text-align: center;
            color: var(--white);
            font-family: var(--light);
            font-size: 18px;
        }

        .list .title span {
            color: var(--cyan);
            font-family: var(--regular);
            font-size: 20px;
        }

        .list h1 {
            color: var(--white);
            font-size: 32px;
            text-align: center;
            font-family: var(--bold);
            padding-bottom: 15px;
        }

        .list h1 span {
            color: var(--cyan);
        }

        .list .products {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .list .products .product {
            width: 100%;
            border-radius: 10px;
            padding: 10px;
            background-color: var(--black);
            text-decoration: none;
            transition: all ease .4s;
        }

        .list .products .product:hover {
            background-color: #03141d;
        }

        .list .products .product .img {
            width: 100%;
            height: 300px;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .list .products .product img {
            width: 100%;
        }

        .list .products .product .name_price {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .list .products .product .name_price .name {
            font-size: 18px;
            font-family: var(--bold);
            color: var(--white);
        }

        .list .products .product .name_price .price {
            font-size: 20px;
            font-family: var(--bold);
            color: var(--white);
        }

        .list .products .product .type {
            font-size: 22px;
            font-family: var(--light);
            color: var(--white);
            text-align: center;
            text-transform: uppercase;
            font-family: var(--regular);
        }

        .list .products .product p {
            font-size: 16px;
            font-family: var(--light);
            color: rgb(183, 191, 193);
        }

        @media screen and (max-width:799px) {
            .list .products {
                grid-template-columns: repeat(1, 1fr);
            }

            .list_menu .nav {
                width: 100%;
                padding: 15px 20px;
            }

            .list_menu .nav a {
                font-size: 14px;
            }

            .list h1 {
                font-size: 24px;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .list .products {
                grid-template-columns: repeat(2, 1fr);
            }

            .list_menu {
                padding-top: 140px;
            }

            .list_menu .nav {
                width: 80%;
                padding: 15px 20px;
            }

            .list_menu .nav a {
                font-size: 18px;
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