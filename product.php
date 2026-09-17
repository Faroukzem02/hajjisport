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

if (isset($_POST["add_to_cart"])) {
    $id = uniq_id();

    $user_id = $_SESSION["user_id"];
    $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);

    $prod_id = $_POST["prod_id"];
    $prod_id = filter_var($prod_id, FILTER_SANITIZE_STRING);

    $source = $_POST["source"];
    $source = filter_var($source, FILTER_SANITIZE_STRING);

    $qty = $_POST["qty"];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $size = $_POST["taille"];
    $size = filter_var($size, FILTER_SANITIZE_STRING);

    $price = $_POST["prod_price"];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $nom = $_POST["fullname"];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);

    $phone = $_POST["tel"];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);

    $adress = $_POST["adresse"];
    $adress = filter_var($adress, FILTER_SANITIZE_STRING);

    $select_cmds = $conn->prepare("SELECT * FROM `commands` WHERE user_id='$user_id' AND prod_id='$prod_id' AND source='$source' AND statut='in progress'");
    $select_cmds->execute();

    if ($select_cmds->rowCount() == 0) {
        $insert_contact = $conn->prepare("INSERT INTO `commands` (id,user_id,prod_id,source,qty,size,price,fullname,phone,adress) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert_contact->execute([$id, $user_id, $prod_id, $source, $qty, $size, $price, $nom, $phone, $adress]);
        $success_msg[] = 'votre commande est valider , on va vous contacter pour la confirmation .';
    } else {
        $warning_msg[] = 'commande déja valider .';
    }
}

if (isset($_POST["add_to_wishlist"])) {
    if ($user_id) {
        $id = uniq_id();

        $source = $_POST["source"];
        $source = filter_var($source, FILTER_SANITIZE_STRING);

        $userid = $_SESSION["user_id"];
        $userid = filter_var($userid, FILTER_SANITIZE_STRING);

        $prodid = $_POST["prod_id"];
        $prodid = filter_var($prodid, FILTER_SANITIZE_STRING);

        $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id='$userid' AND product_id='$prodid'AND source ='$source'");
        $select_wishlist->execute();

        if ($select_wishlist->rowCount() == 0) {
            $insert_to_wishlist = $conn->prepare("INSERT INTO `wishlist` (id,user_id,product_id,source) VALUES (?,?,?,?)");
            $insert_to_wishlist->execute([$id, $userid, $prodid, $source]);
            $success_msg[] = "produit ajouté aves succés";
        } else {
            $warning_msg[] = 'produit déja exist !!';
        }
    } else {
        $warning_msg[] = 'il faut se connecter !!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - produit</title>
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
    <?php
    if (isset($_GET["pid"])) {
        $pid = $_GET["pid"];
        $select_prods = $conn->prepare("SELECT * from `products` where id='$pid'");
        $select_prods->execute();
        if ($select_prods->rowCount() > 0) {
            while ($fetch_prods = $select_prods->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="list_menu">
                    <div class="nav">
                        <a href="list_products?pid=homme">Homme</a>
                        <a href="list_products?pid=femme">Femmes</a>
                        <a href="list_products?pid=enfant">Enfants</a>
                        <a href="list_products?pid=equipement">Equipements</a>
                        <a href="list_products?pid=accessoire">Accessories</a>
                    </div>
                </div>
                <div class="product-container" id="product-container">
                    <div class="left">
                        <img src="imgs/prods/<?= $fetch_prods["img"] ?>" alt="">
                    </div>
                    <div class="right">
                        <div class="enstock">
                            <p>en stock :
                                <?php
                                if ($fetch_prods["qty"] > 0) {
                                ?>
                                    <ion-icon name="checkmark" style="color:green"></ion-icon>
                                <?php
                                } else {
                                ?>
                                    <ion-icon name="close" style="color:red"></ion-icon>
                                <?php
                                }
                                ?>
                            </p>
                        </div>
                        <div class="name_price">
                            <h3><?= $fetch_prods["nom"] ?></h3>
                            <h2><?= $fetch_prods["prix"] ?> DH</h2>
                        </div>
                        <div class="buttons">
                            <form action="" method="post">
                                <input type="hidden" name="prod_id" value="<?= $fetch_prods["id"] ?>">
                                <input type="hidden" name="source" value="<?= $fetch_prods["source"] ?>">
                                <button type="submit" name="add_to_wishlist" class="btn_towishlist">Ajouter au favoris <ion-icon name="heart"></ion-icon></button>
                            </form>
                        </div>
                        <div class="description">
                            <p><?= $fetch_prods["type_fr"] ?></p>
                        </div>
                        <div class="shop">
                            <?php
                            if ($user_id) {
                                $select_users = $conn->prepare("SELECT * FROM `users` WHERE id=$user_id");
                                $select_users->execute();
                                $fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);
                            ?>
                                <form action="" method="post">
                                    <input type="hidden" name="prod_id" value="<?= $fetch_prods["id"] ?>">
                                    <input type="hidden" name="prod_price" value="<?= $fetch_prods["prix"] ?>">
                                    <input type="hidden" name="source" value="<?= $fetch_prods["source"] ?>">
                                    <input type="text" name="fullname" placeholder="nom complet ..." maxlength="20" required value="<?= $fetch_users["fullname"] ?>">
                                    <input type="text" name="tel" placeholder="téléphone ..." maxlength="15" required value="<?= $fetch_users["tel"] ?>">
                                    <input type="text" name="adresse" placeholder="Adresse ..." maxlength="40" required value="<?php echo $fetch_users["adress"] . " , " . $fetch_users["ville"] . " , " . $fetch_users["pays"] ?>">
                                    <input type="number" name="qty" placeholder="Quantité" value="1" min="1" max="5" required>
                                    <?php
                                    if ($fetch_prods["category_fr"] === "homme" || $fetch_prods["category_fr"] === "femme") {
                                    ?>
                                        <select name="taille" id="taille" required>
                                            <option value="-1">Choisir une taille</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    <?php
                                    } elseif ($fetch_prods["category_fr"] === "enfant") {
                                    ?>
                                        <select name="taille" id="taille" required>
                                            <option value="-1">Choisir une taille</option>
                                            <option value="6y">6A</option>
                                            <option value="8y">8A</option>
                                            <option value="10y">10A</option>
                                            <option value="12y">12A</option>
                                            <option value="14y">14A</option>
                                        </select>
                                        <?php
                                    } elseif ($fetch_prods["category_fr"] === "equipement") {
                                        if ($fetch_prods["type_fr"] === "ballon") {
                                        ?>
                                            <select name="taille" id="taille" required>
                                                <option value="-1">Choisir une taille</option>
                                                <option value="s">2</option>
                                                <option value="m">3</option>
                                                <option value="l">4</option>
                                                <option value="xl">5</option>
                                            </select>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>
                                    <button type="submit" name="add_to_cart" class="btn_tocart">Commander</button>
                                </form>
                            <?php
                            } else {
                            ?>
                                <div class="disclaimer">
                                    <p>Il faut se connecter pour commender ce produit <ion-icon name="warning-outline"></ion-icon></p>
                                    <a href="login">Login</a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>

    <style>
        .product-container {
            width: 100%;
            height: auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            padding: 20px 0;
        }

        .list_menu {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-top: 85px;
        }

        .list_menu .nav {
            width: 50%;
            display: flex;
            justify-content: space-between;
            background-color: var(--cyan);
            padding: 15px 30px;
        }

        .list_menu .nav a {
            text-decoration: none;
            color: var(--white);
            font-size: 20px;
            font-family: var(--bold);
        }

        .product-container .left {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
            height: 100%;
        }

        .product-container .left img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .product-container .right {
            width: 100%;
            padding: 20px;
        }

        .product-container .right .enstock {
            background-color: var(--white);
            border-radius: 15px;
            width: 150px;
            padding: 5px;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .product-container .right .enstock p {
            font-size: 19px;
            font-family: var(--regular);
            display: flex;
            align-items: center;
        }

        .product-container .right .enstock p ion-icon {
            font-size: 27px;
            margin: 0 10px;
        }

        .product-container .right .name_price {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 80%;
            margin-bottom: 20px;
        }

        .product-container .right .name_price h3 {
            font-size: 22px;
            font-family: var(--bold);
            color: var(--white);
        }

        .product-container .right .name_price h2 {
            font-size: 25px;
            font-family: var(--bold);
            color: var(--white);
        }

        .product-container .right .buttons button {
            background-color: rgb(132, 11, 11);
            padding: 5px 15px;
            border: none;
            outline: none;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            font-family: var(--regular);
            color: var(--white);
            cursor: pointer;
            transition: all ease .3s;
            display: flex;
            align-items: center;
        }

        .product-container .right .buttons button:hover {
            background-color: var(--white);
            color: rgb(132, 11, 11);
        }

        .product-container .right .buttons button ion-icon {
            margin-left: 5px;
            font-size: 22px;
        }

        .product-container .right .description p {
            margin-bottom: 20px;
            font-size: 24px;
            color: var(--white);
            font-family: var(--regular);
            text-transform: uppercase;
        }

        .product-container .right .shop .disclaimer p {
            color: var(--white);
            font-size: 17px;
            font-family: var(--light);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .product-container .right .shop .disclaimer p ion-icon {
            font-size: 20px;
            margin-left: 5px;
        }

        .product-container .right .shop .disclaimer a {
            color: var(--white);
            font-size: 17px;
            font-family: var(--regular);
            padding: 5px 15px;
            border-radius: 10px;
            text-decoration: none;
            background-color: var(--cyan);
        }

        .product-container .right .shop input {
            width: 80%;
            margin-bottom: 15px;
            padding: 5px 10px;
            font-family: var(--light);
            outline: none;
            border: none;
            border-radius: 15px;
            display: block;
        }

        .product-container .right .shop select {
            width: 40%;
            padding: 5px 0px;
            border-radius: 15px;
            margin-bottom: 15px;
            display: block;
            outline: none;
            border: none;
            font-family: var(--regular);
        }

        .product-container .right .shop button {
            font-size: 16px;
            font-family: var(--regular);
            color: var(--white);
            background-color: var(--cyan);
            padding: 5px 20px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            transition: all ease .3s;
        }

        .product-container .right .shop button:hover {
            background-color: var(--black);
            color: var(--white);
        }

        @media screen and (max-width:799px) {
            .list_menu {
                padding-top: 85px;
            }

            .list_menu .nav {
                width: 100%;
                padding: 15px 20px;
            }

            .list_menu .nav a {
                font-size: 14px;
            }

            .product-container {
                grid-template-columns: repeat(1, 1fr);
            }

            .product-container .right .name_price {
                width: 100%;
            }

            .product-container .right .shop input {
                width: 100%;
            }

            .product-container .right .shop select {
                width: 50%;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .list_menu .nav {
                width: 80%;
                padding: 15px 20px;
            }

            .list_menu .nav a {
                font-size: 16px;
            }

            .product-container .right .name_price {
                width: 100%;
            }

            .product-container .right .shop input {
                width: 100%;
            }

            .product-container .right .shop select {
                width: 50%;
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