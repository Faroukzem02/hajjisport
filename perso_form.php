<?php
include "connexion.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login');
    exit();
}


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login");
    exit();
}

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
}

if (isset($_POST["submit"])) {
    $id = uniq_id();

    $targetDirectory = 'imgs/personnalisation/';
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $targetDirectory . $fileName;
    if (file_exists($targetFilePath)) {
        unlink($targetFilePath);
    }
    move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);

    $user_id = $_POST["user_id"];
    $user_id = filter_var($user_id, FILTER_SANITIZE_STRING);

    $prod_id = $_POST["prod_id"];
    $prod_id = filter_var($prod_id, FILTER_SANITIZE_STRING);

    $fullname = $_POST["fullname"];
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);

    $tel = $_POST["tel"];
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);

    $adresse = $_POST["adresse"];
    $adresse = filter_var($adresse, FILTER_SANITIZE_STRING);

    $select_perso = $conn->prepare("SELECT * FROM `personnalisation` where user_id=? and product_id=? and design=?");
    $select_perso->execute([$user_id, $prod_id, $fileName]);

    if ($select_perso->rowCount() == 0) {
        $add_product = $conn->prepare("INSERT INTO `personnalisation` (id,user_id,product_id,fullname,tel,adresse,design) VALUES (?,?,?,?,?,?,?)");
        $add_product->execute([$id, $user_id, $prod_id, $fullname, $tel, $adresse, $fileName]);
        header("Location: perso_table?pid=$user_id");
        exit();
    } else {
        $warning_msg[] = "demande déja exist";
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
    <?php include "index/header.php" ?>

    <div class="perso_form">
        <div class="content">
            <h1>Remplir ce formulaire</h1>
            <h4>afin de valider la demande</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                <input type="hidden" name="prod_id" value="<?= $pid ?>">
                <label for="">nom complet :</label><br>
                <input type="text" name="fullname" id="" maxlength="30" required><br>
                <label for="">téléphone :</label><br>
                <input type="text" name="tel" id="" maxlength="15" required><br>
                <label for="">adresse :</label><br>
                <input type="text" name="adresse" maxlength="60" id="" required><br>
                <label for="">design à imprimer :</label><br>
                <input type="file" name="file" id="file" accept=".jpg,.jpeg,.png" value="upload" required><br>
                <button type="submit" name="submit" onclick="return confirm('confirmer la commande ??')">confirmer</button>
            </form>
        </div>
    </div>

    <style>
        .perso_form {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-top: 80px;
        }

        .perso_form .content {
            width: 40%;
            background-color: var(--light2);
            padding: 20px;
            box-shadow: 0 0 8px var(--black);
        }

        .perso_form .content h1 {
            font-size: 32px;
            font-family: var(--bold);
            color: var(--dark2);
        }

        .perso_form .content h4 {
            font-size: 24px;
            font-family: var(--bold);
            color: var(--cyan);
            margin-bottom: 15px;
        }

        .perso_form .content form {
            width: 100%;
        }

        .perso_form .content form label {
            font-size: 16px;
            font-family: var(--regular);
        }


        .perso_form .content form input {
            width: 100%;
            height: 30px;
            padding: 0 5px;
            outline: none;
            border: 1px solid var(--dark2);
            margin-top: 5px;
            margin-bottom: 10px;
            font-family: var(--light);
        }

        .perso_form .content form #file {
            border: none;
        }

        .perso_form .content form button {
            background-color: var(--cyan);
            color: var(--white);
            padding: 5px 15px;
            font-size: 16px;
            font-family: var(--regular);
            border: none;
            cursor: pointer;
            transition: all ease .3s;
        }

        .perso_form .content form button:hover {
            background-color: var(--dark1);
        }

        @media screen and (max-width:799px) {
            .perso_form .content {
                width: 100%;
            }

            .perso_form .content h1 {
                font-size: 22px;
            }

            .perso_form .content h4 {
                font-size: 20px;
            }
        }


        @media screen and (min-width:800px) and (max-width:1100px) {
            .perso_form .content {
                width: 80%;
            }

            .perso_form .content h1 {
                font-size: 27px;
            }

            .perso_form .content h4 {
                font-size: 22px;
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