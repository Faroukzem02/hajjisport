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

if (isset($_POST['delete_command'])) {
    $command_id = $_POST['command_id'];
    $command_id = filter_var($command_id, FILTER_SANITIZE_STRING);

    $varify_delete_items = $conn->prepare("SELECT * FROM `commands` WHERE id=? ");
    $varify_delete_items->execute([$command_id]);

    if ($varify_delete_items->rowCount() > 0) {
        $delete_command_id = $conn->prepare("DELETE FROM `commands` WHERE id=?");
        $delete_command_id->execute([$command_id]);
        $success_msg[] = "commande supprimé avec succés";
    } else {
        $warning_msg[] = "command déja supprimer";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - votre commandes</title>
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
    $select_command = $conn->prepare("SELECT * FROM `commands` WHERE id = '$pid'");
    $select_command->execute();
    $fetch_command = $select_command->fetch(PDO::FETCH_ASSOC);

    if ($select_command->rowCount() > 0) {
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE id =?");
        $select_user->execute([$fetch_command["user_id"]]);
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

        $select_prod = $conn->prepare("SELECT * FROM `products` WHERE id =?");
        $select_prod->execute([$fetch_command["prod_id"]]);
        $fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC);
    ?>
        <div class="details_commands">
            <div class="title">
                <p><span>NF </span>HAJJI SPORTS</p>
                <h1>Command N° <?= $fetch_command["id"] ?></h1>
            </div>
            <div class="container">
                <div class="part1">
                    <p><?php echo $_SESSION["user_username"] ?></p>
                    <p><span>date :</span> <?= $fetch_command["date"] ?></p>
                </div>
                <div class="part2">
                    <div class="prod_infos">
                        <p><span>product :</span> <?= $fetch_prod["nom"] ?></p>
                        <p><span>size :</span> <?= $fetch_command["size"] ?></p>
                        <p><span>price :</span> <?= $fetch_command["price"] ?> DH</p>
                        <p><span>quantity :</span> <?= $fetch_command["qty"] ?></p>
                        <?php
                        $total_price = $fetch_command["qty"] * $fetch_command["price"];
                        ?>
                        <p><span>total price :</span> <?php echo $total_price ?> DH</p>
                    </div>
                    <div class="user_infos">
                        <p><span>fullname :</span> <?= $fetch_user["fullname"] ?></p>
                        <p><span>phone :</span> <?= $fetch_user["tel"] ?></p>
                        <p><span>adresse :</span> <?= $fetch_user["adress"] ?></p>
                        <p><span>email :</span> <?= $fetch_user["email"] ?></p>
                    </div>
                </div>
                <div class="part3">
                    <form action="" method="post">
                        <input type="hidden" name="command_id" value="<?= $fetch_command["id"] ?>">
                        <button type="submit" name="delete_command" onclick="return confirm('la commande va résilier !?')">annuler la commande</button>
                    </form>
                    <?php
                    $style;
                    if ($fetch_command["statut"] === 'canceled') {
                        $style = "rgb(220 , 10 , 10)";
                    } elseif ($fetch_command["statut"] === 'confirmed') {
                        $style = "rgb(17 , 183 , 31)";
                    } else {
                        $style = "rgb(255 , 145 , 0)";
                    }

                    ?>
                    <p style="color :<?php echo $style ?>"><?= $fetch_command["statut"] ?></p>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="backtoIndex">
            <p>command déja supprimé retourner a <a href="commands?pid=<?= $user_id ?>">votre commandes</a> </p>
        </div>
    <?php
    }
    ?>


    <?php include "index/footer.php" ?>

    <style>
        .details_commands {
            width: 100%;
            height: auto;
            padding: 20px;
            padding-top: 80px;
        }

        .details_commands .title {
            width: 100%;
            text-align: center;
        }

        .details_commands .title p {
            font-family: var(--light);
            font-size: 24px;
            color: var(--white);
        }

        .details_commands .title p span {
            font-family: var(--regular);
            font-size: 22px;
            color: var(--cyan);
        }

        .details_commands .title h1 {
            font-family: var(--bold);
            font-size: 35px;
            color: var(--white);
        }

        .details_commands .container {
            width: 50%;
            margin: auto;
            margin-top: 20px;
        }

        .details_commands .container p {
            color: var(--white);
            font-family: var(--light);
            font-size: 16px;
        }

        .details_commands .container p span {
            font-family: var(--bold);
        }

        .details_commands .container .part1 {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #03141d;
            padding: 10px 20px;
        }

        .details_commands .container .part2 {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #031018;
            padding: 10px 50px;
        }

        .details_commands .container .part3 {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #020e14;
            padding: 10px 20px;
        }

        .details_commands .container .part3 button {
            background-color: rgb(200, 7, 7);
            color: var(--white);
            font-family: var(--regular);
            font-size: 16px;
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            transition: all ease .3s;
        }

        .details_commands .container .part3 button:hover {
            color: rgb(200, 7, 7);
            background-color: var(--white);
        }

        @media screen and (max-width:799px) {
            .details_commands .container {
                width: 100%;
                margin: auto;
                margin-top: 20px;
            }

            .details_commands .container .part2 {
                display: block;
                text-align: center;
            }

            .details_commands .container .part2 .prod_infos {
                margin-bottom: 20px;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .details_commands .container {
                width: 80%;
                margin: auto;
                margin-top: 20px;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        <?php include "script.js" ?>
    </script>

    <?php include "alert.php" ?>

</body>

</html>