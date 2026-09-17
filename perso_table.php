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

if (isset($_POST['delete_acc'])) {
    $users_id = $_SESSION["user_id"];
    $users_id = filter_var($users_id, FILTER_SANITIZE_STRING);

    $varify_delete_items = $conn->prepare("SELECT * FROM `users` WHERE id=? ");
    $varify_delete_items->execute([$users_id]);

    if ($varify_delete_items->rowCount() > 0) {
        $delete_users_id = $conn->prepare("DELETE FROM `users` WHERE id=?");
        $delete_users_id->execute([$users_id]);

        $delete_wishlist_id = $conn->prepare("DELETE FROM `wishlist` WHERE user_id=?");
        $delete_wishlist_id->execute([$users_id]);

        $delete_commands_id = $conn->prepare("DELETE FROM `commands` WHERE user_id=?");
        $delete_commands_id->execute([$users_id]);

        $delete_history_id = $conn->prepare("DELETE FROM `history` WHERE user_id=?");
        $delete_history_id->execute([$users_id]);

        session_destroy();
        header("Location: login");
        exit();
    } else {
        $warning_msg[] = "erreur ";
    }
}

if (isset($_POST['delete_perso'])) {
    $person = $_POST["perso_id"];
    $person = filter_var($person, FILTER_SANITIZE_STRING);

    $varify_delete_items = $conn->prepare("SELECT * FROM `personnalisation` WHERE id=? ");
    $varify_delete_items->execute([$person]);

    if ($varify_delete_items->rowCount() > 0) {
        $delete_person = $conn->prepare("DELETE FROM `personnalisation` WHERE id=?");
        $delete_person->execute([$person]);
    } else {
        $warning_msg[] = "produit déja supprimé";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - personnalisation</title>
    <style>
        <?php
        include "style.css"
        ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <div class="manager">
        <div class="menu">
            <div class="img">
                <a href="home"><img src="imgs/blue-pro.png" alt=""></a>
            </div>
            <div class="connected">
                <img src="imgs/profil.jpg" alt="">
                <div class="statut"></div>
            </div>
            <div class="user">
                <span><?php echo $_SESSION["user_username"] ?></span>
            </div>
            <div class="navbar">
                <a href="manager"><ion-icon name="home"></ion-icon> <span>Acceuil</span> </a>
                <a href="edit_infos"><ion-icon name="create"></ion-icon> <span>Modifer mes infos</span> </a>
                <a href="reset_password"><ion-icon name="key"></ion-icon> <span>Editer Mot de passe</span> </a>
                <a href="history"><ion-icon name="time"></ion-icon> <span>historique</span></a>
                <a href="return_product"><ion-icon name="reload"></ion-icon> <span>Retourner un produit</span></a>
                <a href="perso_table" style="color:var(--cyan)"><ion-icon name="color-palette"></ion-icon> <span>personnalisation</span></a>
            </div>
            <form action="" method="post">
                <button type="submit" name="logout"><ion-icon name="power"></ion-icon> <span>Déconnecter</span></button>
                <button type="submit" name="delete_acc" onclick="return confirm('vous voulez vraiment supprimer votre compte ?')"><ion-icon name="trash-bin"></ion-icon> <span>Supprimer ce compte</span></button>
            </form>
        </div>
        <div class="content">
            <div class="menu_place"></div>
            <div class="container">
                <div class="container_content">
                    <div class="title">
                        <h2>Votre commandes personnalisés</h2>
                    </div>
                    <div class="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Design</th>
                                    <th>Prix (DH)</th>
                                    <th>statut</th>
                                    <th>Commander le</th>
                                    <th>supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_personnalisation = $conn->prepare("SELECT * from `personnalisation` WHERE user_id='$user_id' ORDER BY date DESC");
                                $select_personnalisation->execute();
                                if ($select_personnalisation->rowCount() > 0) {
                                    while ($fetch_personnalisation = $select_personnalisation->fetch(PDO::FETCH_ASSOC)) {
                                        $select_products = $conn->prepare("SELECT * from `products` ORDER BY date DESC");
                                        $select_products->execute();
                                        $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)
                                ?>
                                        <tr>
                                            <td><img src="imgs/prods/<?= $fetch_products["img"] ?>" alt=""></td>
                                            <td><img src="imgs/personnalisation/<?= $fetch_personnalisation["design"] ?>" alt=""></td>
                                            <td><?php echo $fetch_products["prix"] + 200 ?></td>
                                            <td><?= $fetch_personnalisation["statut"] ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($fetch_personnalisation["date"])) ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="perso_id" value="<?= $fetch_personnalisation['id'] ?>">
                                                    <button type="submit" name="delete_perso" onclick="return confirm('cette commande va résilier !?')"><ion-icon name="trash-bin"></ion-icon></button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .manager {
            width: 100%;
            height: auto;
            display: flex;
            background-color: rgb(232, 232, 232);
        }

        .manager .menu {
            width: 17%;
            height: 100vh;
            background-color: rgb(248, 248, 248);
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 0 0 12px rgb(132, 132, 132);
            user-select: none;
        }

        .manager .menu .img {
            width: 100%;
            height: auto;
            background-color: rgb(244, 244, 244);
            padding: 5px 40px;
            margin-bottom: 15px;
        }

        .manager .menu .img img {
            width: 80%;
            margin: auto;
            display: flex;
        }

        .manager .menu .connected {
            margin: auto;
            position: relative;
            width: 40%;
            border-radius: 50%;
            display: flex;
            transition: all ease .3s;
            cursor: pointer;

        }

        .manager .menu .connected:hover {
            border: 1px rgb(18, 172, 18) solid;
            transform: scale(1.01);
        }

        .manager .menu .connected img {
            width: 100%;
            border-radius: 50%;
        }

        .manager .menu .connected .statut {
            background-color: rgb(18, 172, 18);
            width: 20px;
            height: 20px;
            position: absolute;
            z-index: 3;
            bottom: 3%;
            right: 5%;
            border-radius: 50%;
        }

        .manager .menu .user {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
            font-size: 18px;
            font-family: var(--regular);
            color: var(--dark2);

        }

        .manager .menu .navbar {
            padding: 10px 20px;
        }

        .manager .menu .navbar a {
            display: flex;
            align-items: center;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 16px;
            font-family: var(--bold);
            color: var(--dark1);
            transition: all ease .3s;
        }

        .manager .menu .navbar a:hover {
            color: var(--light2);
            transform: translateX(5px);
        }

        .manager .menu .navbar a ion-icon {
            font-size: 25px;
            margin-right: 10px;
        }

        .manager .menu form {
            padding: 20px;
        }

        .manager .menu form button {
            width: 100%;
            margin-bottom: 20px;
            border: none;
            background: transparent;
            font-size: 14px;
            font-family: var(--bold);
            display: flex;
            align-items: center;
            color: rgb(229, 6, 6);
            cursor: pointer;
            transition: all ease .3s;
        }

        .manager .menu form button ion-icon {
            font-size: 22px;
            margin-right: 10px;
        }


        .manager .menu form button:hover {
            color: rgb(153, 22, 22);
            transform: translateX(5px);
        }

        .manager .content {
            width: 100%;
            height: auto;
            display: flex;
        }

        .manager .content .menu_place {
            width: 17%;
            height: 100vh;
        }

        .manager .content .container {
            width: 83%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .manager .content .container .container_content {
            width: 90%;
            height: auto;
            background-color: var(--white);
            box-shadow: 0 0 15px rgb(200, 200, 200);
            padding: 20px;
            overflow: hidden;
        }

        .manager .content .container .container_content .title {
            margin-bottom: 20px;
        }

        .manager .content .container .container_content .title h2 {
            color: var(--dark2);
            font-size: 32px;
            font-family: var(--bold);
        }

        .manager .content .container .container_content .title p {
            color: var(--light2);
            font-size: 22px;
            font-family: var(--bold);
        }

        .manager .content .container .container_content .table {
            width: 100%;
            max-height: 70vh;
            overflow-y: scroll;
        }

        .manager .content .container .container_content .table::-webkit-scrollbar {
            width: 8px;
            background-color: var(--white);
        }

        .manager .content .container .container_content .table::-webkit-scrollbar-thumb {
            width: 8px;
            background-color: var(--cyan);
        }

        .manager .content .container .container_content .table table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        .manager .content .container .container_content .table table th {
            font-size: 18px;
            font-family: var(--bold);
            padding-bottom: 5px;
            border-bottom: 1px solid var(--dark2);
        }

        .manager .content .container .container_content .table table td {
            font-size: 16px;
            font-family: var(--light);
            padding-top: 5px;
            border-bottom: 1px solid var(--dark2);
        }

        .manager .content .container .container_content .table table td img {
            width: 100px;
        }

        .manager .content .container .container_content .table table td button {
            font-size: 32px;
            color: red;
            background-color: transparent;
            border: none;
            cursor: pointer;
            transition: all ease .3s;
        }

        .manager .content .container .container_content .table table td button:hover {
            color: darkred;
        }

        @media screen and (max-width:799px) {

            .manager .menu .img {
                width: 100%;
                height: auto;
                background-color: rgb(244, 244, 244);
                padding: 2px;
                margin-bottom: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .manager .menu .img img {
                width: 100%;
            }

            .manager .menu {
                width: 15%;
            }

            .manager .menu .connected {
                margin-bottom: 40px;
            }

            .manager .menu .connected .statut {
                width: 10px;
                height: 10px;
            }

            .manager .menu .user {
                display: none;
            }

            .manager .menu .navbar a span {
                display: none;
            }


            .manager .menu .navbar a {
                display: flex;
                justify-content: center;
            }

            .manager .menu .navbar a ion-icon {
                font-size: 32px;
                margin-right: 0;
            }

            .manager .menu form {
                padding: 10px;
                position: relative;
                top: 50px;
            }

            .manager .menu form button {
                font-size: 32px;
                justify-content: center;
            }

            .manager .menu form button ion-icon {
                font-size: 30px;
                margin-right: 0px;
            }

            .manager .menu form button span {
                display: none;
            }

            .manager .menu .navbar {
                padding: 10px;
            }

            .manager .content .menu_place {
                width: 15%;
                height: 100vh;
            }

            .manager .content .container {
                width: 85%;
            }

            .manager .content .container .container_content .title h2 {
                font-size: 20px;
            }

            .manager .content .container .container_content .title p {
                font-size: 18px;
            }

            .manager .content .container .container_content {
                width: 100%;
                height: 100vh;
            }

            .manager .content .container .container_content .table {
                max-height: 75vh;
            }

            .manager .content .container .container_content .table table {
                width: 250%;
                text-align: center;
                border-collapse: collapse;
            }

            .manager .content .container .container_content .table table td img {
                width: 60px;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .manager .menu .navbar a span {
                display: none;
            }


            .manager .menu form button span {
                display: none;
            }

            .manager .menu {
                width: 8%;
            }

            .manager .menu .connected {
                margin-bottom: 40px;
            }

            .manager .menu .connected .statut {
                width: 15px;
                height: 15px;
            }

            .manager .menu .user {
                display: none;
            }

            .manager .menu .img {
                width: 100%;
                height: auto;
                background-color: rgb(244, 244, 244);
                padding: 2px;
                margin-bottom: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .manager .menu .img img {
                width: 100%;
            }

            .manager .menu .navbar a {
                display: flex;
                justify-content: center;
            }

            .manager .menu .navbar a ion-icon {
                font-size: 30px;
                margin-right: 0;
            }

            .manager .menu form {
                padding: 10px;
                position: relative;
                top: 50px;
            }

            .manager .menu form button {
                font-size: 32px;
                justify-content: center;
            }

            .manager .menu form button ion-icon {
                font-size: 30px;
                margin-right: 0px;
            }

            .manager .menu .navbar {
                padding: 10px;
            }

            .manager .content .menu_place {
                width: 8%;
                height: 100vh;
            }

            .manager .content .container {
                width: 92%;
            }

            .manager .content .container .container_content .table table td img {
                width: 80px;
            }
        }
    </style>

    <script>
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>