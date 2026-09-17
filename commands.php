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

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login');
    exit();
}

if (isset($_POST['delete_command'])) {
    $command_id = $_POST['command_id'];
    $command_id = filter_var($command_id, FILTER_SANITIZE_STRING);

    $varify_delete_items = $conn->prepare("SELECT * FROM `commands` WHERE id=? ");
    $varify_delete_items->execute([$command_id]);

    if ($varify_delete_items->rowCount() > 0) {
        $delete_command_id = $conn->prepare("DELETE FROM `commands` WHERE id=?");
        $delete_command_id->execute([$command_id]);
        $success_msg[] = "command delete successfully";
    } else {
        $warning_msg[] = "command already deleted";
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
    <div class="commands">
        <div class="title">
            <p><span>NF </span>HAJJI SPORTS</p>
            <h1>Votre Commandes</h1>
        </div>
        <div class="container">
            <?php
            $select_command = $conn->prepare("SELECT * FROM `commands` WHERE user_id = '$pid' ORDER BY date DESC");
            $select_command->execute();
            if ($select_command->rowCount() > 0) {
                while ($fetch_command = $select_command->fetch(PDO::FETCH_ASSOC)) {
                    if ($fetch_command["source"] === 'prods') {
                        $select_prod = $conn->prepare("SELECT * FROM `products` WHERE id = ? ORDER BY date DESC");
                        $select_prod->execute([$fetch_command["prod_id"]]);
                        if ($select_prod->rowCount() > 0) {
                            while ($fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC)) {
            ?>
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
                                <a href="details_commands?pid=<?= $fetch_command["id"] ?>" class="grid" style="border : <?php echo $style ?> 2px solid">
                                    <div class="part1">
                                        <form action="" method="post">
                                            <input type="hidden" name="command_id" value="<?= $fetch_command["id"] ?>">
                                            <?php
                                            if ($fetch_command["statut"] !== "confirmed") {
                                            ?>
                                                <button type="submit" name="delete_command" onclick="return confirm('supprimer cette commande !?')"><ion-icon name="close"></ion-icon></button>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                        <p><?= $fetch_command["date"] ?></p>
                                    </div>
                                    <div class="part2">
                                        <div class="img">
                                            <img src="imgs/prods/<?= $fetch_prod["img"] ?>" alt="">
                                        </div>
                                        <div class="desc">
                                            <h3><?= $fetch_prod["nom"] ?></h3>
                                            <?php
                                            $total_price = $fetch_command["qty"] * $fetch_command["price"];
                                            ?>
                                            <h3>Prix Total : <?php echo $total_price ?> DH</h3>
                                        </div>
                                    </div>
                                    <div class="part3">
                                        <p style="color :<?php echo $style ?>"><?= $fetch_command["statut"] ?></p>
                                    </div>
                                </a>
                            <?php
                            }
                        }
                    } else {
                        $select_prod = $conn->prepare("SELECT * FROM `promos` WHERE id = ? ORDER BY date DESC");
                        $select_prod->execute([$fetch_command["prod_id"]]);
                        if ($select_prod->rowCount() > 0) {
                            while ($fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC)) {
                            ?>
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
                                <a href="details_commands?pid=<?= $fetch_command["id"] ?>" class="grid" style="border : <?php echo $style ?> 2px solid">
                                    <div class="part1">
                                        <form action="" method="post">
                                            <input type="hidden" name="command_id" value="<?= $fetch_command["id"] ?>">
                                            <?php
                                            if ($fetch_command["statut"] !== "confirmed") {
                                            ?>
                                                <button type="submit" name="delete_command" onclick="return confirm('supprimer cette commande !?')"><ion-icon name="close"></ion-icon></button>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                        <p><?= $fetch_command["date"] ?></p>
                                    </div>
                                    <div class="part2">
                                        <div class="img">
                                            <img src="imgs/prods/<?= $fetch_prod["img"] ?>" alt="">
                                        </div>
                                        <div class="desc">
                                            <h3><?= $fetch_prod["nom"] ?></h3>
                                            <?php
                                            $total_price = $fetch_command["qty"] * $fetch_command["price"];
                                            ?>
                                            <h3>Prix Total : <?php echo $total_price ?> DH</h3>
                                        </div>
                                    </div>
                                    <div class="part3">
                                        <p style="color :<?php echo $style ?>"><?= $fetch_command["statut"] ?></p>
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

        <style>
            .commands {
                width: 100%;
                height: auto;
                padding: 20px;
                padding-top: 80px;
            }

            .commands .title {
                text-align: center;
                margin-bottom: 20px;
            }

            .commands .title p {
                font-size: 20px;
                color: var(--white);
                font-family: var(--light);
            }

            .commands .title p span {
                font-size: 22px;
                color: var(--cyan);
                font-family: var(--regular);
            }

            .commands .title h1 {
                font-size: 35px;
                color: var(--white);
                font-family: var(--bold);
            }

            .commands .container {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                padding: 20px;
                gap: 20px;
            }

            .commands .container .grid {
                padding: 10px;
                background-color: var(--white);
                text-decoration: none;
                color: var(--dark1);
                font-family: var(--bold);
                transition: all ease .3s;
            }

            .commands .container .vide {
                text-align: center;
                font-size: 30px;
                font-family: var(--bold);
                color: var(--white);
            }

            .commands .container .grid:hover {
                transform: scale(1.02);
            }

            .commands .container .grid .part1 {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }

            .commands .container .grid .part1 p {
                color: var(--dark1);
            }

            .commands .container .grid .part1 form button {
                padding: 2px;
                background-color: transparent;
                border: none;
                color: var(--dark1);
                font-size: 30px;
                cursor: pointer;
                transition: all ease .3s;
            }

            .commands .container .grid .part1 form button:hover {
                color: red;
            }

            .commands .container .grid .part2 .img {
                width: 100%;
                height: 300px;
                display: flex;
                align-items: center;
                overflow: hidden;
                margin-bottom: 10px;
            }

            .commands .container .grid .part2 .img img {
                width: 100%;
            }

            .commands .container .grid .part2 .desc {
                display: flex;
                font-size: 16px;
                justify-content: space-between;
                align-items: center;
                font-family: var(--bold);
            }

            .commands .container .grid .part3 {
                display: flex;
                justify-content: center;
                margin-top: 10px;
            }

            @media screen and (max-width:799px) {
                .commands .container {
                    grid-template-columns: repeat(1, 1fr);
                    padding: 0;
                }
            }


            @media screen and (min-width:800px) and (max-width:1100px) {
                .commands .container {
                    grid-template-columns: repeat(2, 1fr);
                    padding: 0;
                }
            }
        </style>
    </div>
    <?php include "index/footer.php" ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?php include "alert.php" ?>

</body>

</html>