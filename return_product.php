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

if (isset($_POST["submit_demande"])) {
    $id = uniq_id();

    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $type = $_POST["type"];
    $type = filter_var($type, FILTER_SANITIZE_STRING);

    $command_id = $_POST["command_id"];
    $command_id = filter_var($command_id, FILTER_SANITIZE_STRING);

    $select_user = $conn->prepare("select * from `users` where email='$email'");
    $select_user->execute();
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $select_cmd = $conn->prepare("select * from `commands` where id='$command_id'");
    $select_cmd->execute();

    $select_backprod = $conn->prepare("SELECT * FROM `backprod` WHERE user_id=? and cmd_id=?");
    $select_backprod->execute([$fetch_user["id"], $command_id]);

    if ($select_backprod->rowCount() == 0) {
        if ($select_cmd->rowCount() > 0) {
            $insert_to_backprod = $conn->prepare("INSERT INTO `backprod` (id,user_id,cmd_id,type) VALUES (?,?,?,?)");
            $insert_to_backprod->execute([$id, $fetch_user["id"], $command_id, $type]);
            $success_msg[] = "demande envoyé aves succés";
        } else {
            $warning_msg[] = 'commande introuvable !!';
        }
    } else {
        $warning_msg[] = 'demande déja exist !!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - retourner produit</title>
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
                <a href="return_product" style="color:var(--cyan)"><ion-icon name="reload"></ion-icon> <span>Retourner un produit</span></a>
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
                    <div class="retourner">
                        <h2>Retourner & Echanger</h2>
                        <h4>un article</h4>
                        <p class="p1">si le delai de votre garantie n'est pas éxpiré , il vous suffit de renseigner votre email et le numéro de commande pour effectuer la demande !</p>
                        <form action="" method="post">
                            <label for="">votre e-mail :</label><br>
                            <input type="email" name="email" id="" maxlength="30" required><br>
                            <label for="">type de demande :</label><br>
                            <select name="type" id="">
                                <option value="retourner">retourner un produit</option>
                                <option value="echanger">échanger un produit</option>
                            </select><br>
                            <label for="">numéro de commande :</label><br>
                            <p class="p2">* si vous n'avez pas le numero de commande, vérifier votre reçu ou votre <a href="history">historique</a> !</p>
                            <input type="text" name="command_id" id="" maxlength="5" required><br>
                            <button type="submit" name="submit_demande">confirmer</button>
                        </form>
                    </div>
                    <div class="history">
                        <table>
                            <thead>
                                <tr>
                                    <th>Demande(ID)</th>
                                    <th>Commande(ID)</th>
                                    <th>type</th>
                                    <th>statut</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_back = $conn->prepare("SELECT * FROM `backprod` Where user_id ='$user_id' order by date desc");
                                $select_back->execute();
                                if ($select_back->rowCount() > 0) {
                                    while ($fetch_back = $select_back->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <tr>
                                            <td><?= $fetch_back["id"] ?></td>
                                            <td><?= $fetch_back["cmd_id"] ?></td>
                                            <td><?= $fetch_back["type"] ?></td>
                                            <td><?= $fetch_back["statut"] ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($fetch_back["date"])) ?></td>
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

        .manager .content .container .container_content .retourner h2 {
            font-size: 32px;
            font-family: var(--bold);
            color: var(--dark2);
        }

        .manager .content .container .container_content .retourner h4 {
            font-size: 27px;
            font-family: var(--bold);
            color: var(--light2);
        }

        .manager .content .container .container_content .retourner .p1 {
            font-size: 17px;
            font-family: var(--light);
            color: var(--dark2);
            margin: 5px 0;
        }


        .manager .content .container .container_content .retourner form {
            width: 100%;
        }

        .manager .content .container .container_content .retourner form label {
            font-size: 17px;
            font-family: var(--regular);
            color: var(--black);
            margin-bottom: 5px;
        }

        .manager .content .container .container_content .retourner form input {
            width: 40%;
            border: 1px solid var(--dark2);
            color: var(--dark2);
            outline: none;
            font-family: var(--light);
            font-size: 16px;
            padding: 5px 10px;
            margin-bottom: 15px;
        }

        .manager .content .container .container_content .retourner form select {
            width: 20%;
            border: 1px solid var(--dark2);
            outline: none;
            margin-bottom: 15px;
            font-family: var(--light);
            font-size: 16px;
            padding: 5px 0;
        }

        .manager .content .container .container_content .retourner form .p2 {
            font-size: 14px;
            font-family: var(--light);
            color: rgb(240, 116, 34);
        }

        .manager .content .container .container_content .retourner form .p2 a {
            font-size: 15px;
            font-family: var(--regular);
            color: rgb(192, 100, 13);
        }

        .manager .content .container .container_content .retourner form button {
            font-size: 16px;
            font-family: var(--regular);
            color: var(--white);
            background-color: var(--cyan);
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            transition: all ease .3s;
        }

        .manager .content .container .container_content .retourner form button:hover {
            background-color: var(--light2);
        }

        .manager .content .container .container_content .history {
            width: 100%;
            height: 30vh;
            background-color: #f1f5fd;
            margin-top: 20px;
            padding: 20px;
            overflow-y: scroll;
        }

        .manager .content .container .container_content .history::-webkit-scrollbar {
            width: 8px;
            background-color: var(--white);
        }

        .manager .content .container .container_content .history::-webkit-scrollbar-thumb {
            width: 8px;
            background-color: var(--cyan);
        }

        .manager .content .container .container_content .history table {
            width: 100%;
            text-align: center;
            border-collapse: collapse;
        }

        .manager .content .container .container_content .history table th {
            font-size: 18px;
            font-family: var(--bold);
            color: var(--dark2);
            padding-bottom: 5px;
        }

        .manager .content .container .container_content .history table td {
            font-size: 16px;
            font-family: var(--light);
            color: var(--dark2);
            padding-bottom: 2px;
            border-top: 1px solid var(--dark2);
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
                height: 100vh;
            }

            .manager .content .container {
                width: 85%;
            }

            .manager .content .container .container_content {
                width: 100%;
                height: 100vh;
            }

            .manager .content .container .container_content .retourner h2 {
                font-size: 24px;
            }

            .manager .content .container .container_content .retourner h4 {
                font-size: 20px;
            }

            .manager .content .container .container_content .retourner .p1 {
                font-size: 16px;
            }

            .manager .content .container .container_content .retourner form input {
                width: 100%;
            }

            .manager .content .container .container_content .retourner form select {
                width: 70%;
            }

            .manager .content .container .container_content .history table th {
                font-size: 16px;
            }

            .manager .content .container .container_content .history table td {
                font-size: 14px;
            }

            .manager .content .container .container_content .history table {
                width: 240%;
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

            .manager .content .container .container_content .retourner form input {
                width: 80%;
            }

            .manager .content .container .container_content .retourner form select {
                width: 50%;
            }
        }
    </style>

    <script>
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?php include "alert.php" ?>
</body>

</html>