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

$select_users = $conn->prepare("SELECT * FROM `users` WHERE id='$user_id'");
$select_users->execute();
$fetch_users = $select_users->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["edit"])) {
    $old_pass = $_POST["old_pass"];
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

    $pass = $_POST["pass"];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $c_pass = $_POST["c_pass"];
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    if ($fetch_users["password"] !== $old_pass) {
        $warning_msg[] = "l'encien mot de passe est incorrect";
    } else {
        if (strlen($pass) < 8 || strlen($pass) > 20 || !preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass) || !preg_match('/[\W_]/', $pass)) {
            $warning_msg[] = "mot de passe faut étre entre 8 et 20 , contient un lettre majuscule au moin des chiffes et des symboles";
        } else {
            if ($pass != $c_pass) {
                $warning_msg[] = 'confirmer votre mot de passe';
            } else {
                $update_product = $conn->prepare("UPDATE `users` SET password=? WHERE id='$user_id'");
                $update_product->execute([$pass]);

                header("Location: manager");
                exit();
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - Manager</title>
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
                <a href="reset_password" style="color:var(--cyan)"><ion-icon name="key"></ion-icon> <span>Editer Mot de passe</span> </a>
                <a href="history"><ion-icon name="time"></ion-icon> <span>historique</span></a>
                <a href="return_product"><ion-icon name="reload"></ion-icon> <span>Retourner un produit</span></a>
                <a href="perso_table"><ion-icon name="color-palette"></ion-icon> <span>personnalisation</span></a>
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
                    <div class="header">
                        <p>informations personnelles > modifer informations ><span> modifer mot de passe</span></p>
                    </div>
                    <div class="body">
                        <h2>Modifer le mot de passe</h2>
                        <div class="aboutyou">
                            <form action="" method="post">
                                <div class="grid">
                                    <label for="">Votre encien mot de passe</label>
                                    <div class="psw">
                                        <input type="password" name="old_pass" required maxlength="20" class="input-apsw">
                                        <span><ion-icon name="eye" class="show-apsw"></ion-icon></span>
                                    </div>
                                </div>
                                <div class="grid">
                                    <label for="">Entrer le nouveau mot de passe</label>
                                    <div class="psw">
                                        <input type="password" name="pass" required maxlength="20" class="input-npsw">
                                        <span><ion-icon name="eye" class="show-npsw"></ion-icon></span>
                                    </div>
                                </div>
                                <div class="grid">
                                    <label for="">Confirmer le mot de passe</label>
                                    <div class="psw">
                                        <input type="password" name="c_pass" required maxlength="20" class="input-cpsw">
                                        <span><ion-icon name="eye" class="show-cpsw"></ion-icon></span>
                                    </div>
                                </div>
                                <button name="edit" type="submit">Valider</button>
                                <a href="">mot de passe oublié ?</a>
                            </form>
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

            .manager .content .container .container_content .header {
                width: 100%;
                border-bottom: var(--cyan) 1px solid;
                padding: 10px 20px;
                margin-bottom: 20px;
            }

            .manager .content .container .container_content .header p {
                font-size: 16px;
                font-family: var(--light);
                color: var(--dark2);
            }

            .manager .content .container .container_content .header p span {
                font-size: 16px;
                font-family: var(--bold);
                color: var(--cyan);
            }

            .manager .content .container .container_content .body {
                width: 100%;
                padding: 10px;
            }

            .manager .content .container .container_content .body h2 {
                color: var(--dark1);
                margin-bottom: 10px;
                font-size: 27px;
                font-family: var(--bold);
            }

            .manager .content .container .container_content .body h4 {
                color: var(--light2);
                font-size: 20px;
                font-family: var(--bold);
            }

            .manager .content .container .container_content .body .aboutyou {
                width: 50%;
            }

            .manager .content .container .container_content .body .aboutyou label {
                font-size: 16px;
                font-family: var(--light);
                color: var(--dark2);
                user-select: none;
            }

            .psw {
                background-color: var(--white);
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding-right: 15px;
                border: 1px var(--dark1) solid;
                height: 35px;
                margin-bottom: 15px;
            }

            .psw input {
                width: 85%;
                background-color: transparent;
                border: none;
                height: 100%;
                outline: none;
                font-family: var(--light);
                font-size: 16px;
                color: var(--dark2);
                padding: 0 10px;
            }

            .psw span {
                display: flex;
                align-items: center;
                color: var(--dark1);
                font-size: 25px;
                cursor: pointer;
            }


            .manager .content .container .container_content form button {
                padding: 5px 25px;
                margin-right: 5px;
                background-color: var(--light2);
                text-decoration: none;
                color: var(--white);
                font-size: 17px;
                font-family: var(--light);
                transition: all ease .3s;
                border: none;
                cursor: pointer;
            }

            .manager .content .container .container_content form button:hover {
                background-color: var(--cyan);
            }

            .manager .content .container .container_content form a {
                text-decoration: none;
                color: var(--cyan);
                font-size: 14px;
                font-family: var(--light);
                transition: all ease 0.3s;
            }

            .manager .content .container .container_content form a:hover {
                color: var(--dark1);
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
                    font-size: 30px;
                    margin-right: 0;
                }

                .manager .menu form {
                    padding: 10px;
                    position: relative;
                    top: 50px;
                }

                .manager .menu form button {
                    font-size: 30px;
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
                }

                .manager .content .container {
                    width: 85%;
                }

                .manager .content .container .container_content {
                    width: 100%;
                    height: 100vh;
                }

                .manager .content .container .container_content .header {
                    padding: 0px;
                    padding-bottom: 10px;
                }

                .manager .content .container .container_content .header p {
                    font-size: 14px;
                }

                .manager .content .container .container_content .header p span {
                    font-size: 15px;
                }

                .manager .content .container .container_content .body {
                    width: 100%;
                    padding: 0px;
                }

                .manager .content .container .container_content .body h2 {
                    font-size: 20px;
                }

                .manager .content .container .container_content .body h4 {
                    font-size: 17px;
                }

                .manager .content .container .container_content .body .aboutyou {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .manager .content .container .container_content .footer {
                    padding: 0;
                    margin-bottom: 20px;
                }

                .manager .content .container .container_content .footer a {
                    padding: 10px 25px;
                    margin-right: 15px;
                    background-color: var(--light2);
                    text-decoration: none;
                    color: var(--white);
                    font-size: 17px;
                    font-family: var(--light);
                    transition: all ease .3s;
                    display: block;
                    margin-bottom: 20px;
                }

                .manager .content .container .container_content .footer a:hover {
                    background-color: var(--cyan);
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
                    font-size: 30px;
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
            }
        </style>

        <script>
            let show_abtn = document.querySelector(".show-apsw");
            let input_abtn = document.querySelector(".input-apsw");
            let show_cbtn = document.querySelector(".show-cpsw");
            let input_cbtn = document.querySelector(".input-cpsw");
            let show_nbtn = document.querySelector(".show-npsw");
            let input_nbtn = document.querySelector(".input-npsw");
            show_nbtn.onclick = () => {
                if (input_nbtn.type === "text") {
                    input_nbtn.type = "password";
                    show_nbtn.name = "eye";
                } else {
                    input_nbtn.type = "text";
                    show_nbtn.name = "eye-off";
                }
            }
            show_abtn.onclick = () => {
                if (input_abtn.type === "text") {
                    input_abtn.type = "password";
                    show_abtn.name = "eye";
                } else {
                    input_abtn.type = "text";
                    show_abtn.name = "eye-off";
                }
            }
            show_cbtn.onclick = () => {
                if (input_cbtn.type === "text") {
                    input_cbtn.type = "password";
                    show_cbtn.name = "eye";
                } else {
                    input_cbtn.type = "text";
                    show_cbtn.name = "eye-off";
                }
            }
        </script>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <?php include "alert.php" ?>
</body>

</html>