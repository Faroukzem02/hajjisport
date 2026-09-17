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

if (isset($_POST["submit-contact"])) {
    $id = uniq_id();

    $nom = $_POST["fullname"];
    $nom = filter_var($nom, FILTER_SANITIZE_STRING);

    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $sujet = $_POST["sujet"];
    $sujet = filter_var($sujet, FILTER_SANITIZE_STRING);

    $message = $_POST["message"];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $insert_contact = $conn->prepare("INSERT INTO `contact` (id,fullname,email,sujet,message) VALUES (?,?,?,?,?)");
    $insert_contact->execute([$id, $nom, $email, $sujet, $message]);

    $success_msg[] = 'merci pour votre message , on va vous répondre le dés possible';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - contact</title>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>

    <div class="contact-section">
        <div class="content">
            <div class="img">
                <img src="imgs/blue-pro.png" alt="">
            </div>
            <div class="title">
                <p><span>NF</span> Hajji sport Maroc</p>
                <h3>Contactez nous</h3>
            </div>
            <div class="container">
                <div class="grid1">
                    <div class="content">
                        <div class="position">
                            <span><ion-icon name="location"></ion-icon></span>
                            <div class="grids">
                                <div class="grid">
                                    <img src="imgs/contact/italy.png" alt="">
                                    <p>Via epomeo trav/p/3 , Napoli , Italia</p>
                                </div>
                                <div class="grid">
                                    <img src="imgs/contact/morocco.png" alt="">
                                    <p>N° 46 BD Zerktouni étage 3 Appt 6 , Casablanca , Maroc</p>
                                </div>
                            </div>
                        </div>
                        <div class="phone">
                            <span><ion-icon name="call"></ion-icon></span>
                            <div class="grids">
                                <div class="grid">
                                    <img src="imgs/contact/italy.png" alt="">
                                    <div class="nums">
                                        <p>347 197 4160</p>
                                        <p>335 541 7502</p>
                                    </div>

                                </div>
                                <div class="grid">
                                    <img src="imgs/contact/morocco.png" alt="">
                                    <div class="nums">
                                        <p>+212 661092539</p>
                                        <p>+212 662743588</p>
                                        <p>+212 522724593</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="gmail">
                            <span><ion-icon name="mail-open"></ion-icon></span>
                            <p>hhajji79@gmail.com</p>
                        </div>

                    </div>

                </div>
                <div class="grid2">
                    <form action="" method="post">
                        <label for="">Nom complet :</label><br>
                        <input type="text" name="fullname" required maxlength="30"><br>
                        <label for="">Email :</label><br>
                        <input type="text" name="email" required maxlength="30"><br>
                        <label for="">Sujet :</label><br>
                        <input type="text" name="sujet" required maxlength="50"><br>
                        <label for="">Message :</label><br>
                        <textarea name="message" required maxlength="150"></textarea><br>
                        <button type="submit" name="submit-contact">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .contact-section {
            width: 100%;
            padding: 20px;
            padding-top: 60px;
        }

        .contact-section .content {
            width: 100%;
        }

        .contact-section .content .img {
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .contact-section .content .img img {
            width: 250px;
        }

        .contact-section .content .title {
            width: 100%;
            text-align: center;
        }

        .contact-section .content .title p {
            font-family: var(--light);
            font-size: 24px;
            color: var(--white);
        }

        .contact-section .content .title p span {
            font-family: var(--regular);
            font-size: 22px;
            color: var(--cyan);
        }

        .contact-section .content .title h3 {
            font-family: var(--bold);
            font-size: 35px;
            color: var(--white);
        }

        .contact-section .content .container {
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .contact-section .content .container .grid1 {
            background-color: var(--white);
            padding: 20px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-section .content .container .grid1 .content {
            width: 80%;
        }

        .contact-section .content .container .grid1 .position,
        .contact-section .content .container .grid1 .phone {
            display: flex;
            align-items: start;
            margin-bottom: 10px;
        }

        .contact-section .content .container .grid1 .gmail {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-section .content .container .grid1 .position span,
        .contact-section .content .container .grid1 .phone span,
        .contact-section .content .container .grid1 .gmail span {
            font-size: 30px;
            color: #1688c7;
            margin-right: 10px;
        }

        .contact-section .content .container .grid1 .position .grids .grid {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .contact-section .content .container .grid1 .phone .grids .grid {
            display: flex;
            margin-bottom: 10px;
            align-items: start;
        }

        .contact-section .content .container .grid1 .position .grids .grid img,
        .contact-section .content .container .grid1 .phone .grids .grid img {
            width: 30px;
            margin-right: 10px;
        }

        .contact-section .content .container .grid1 .gmail p {
            color: var(--black);
            font-size: 16px;
            font-family: var(--light);
        }

        .contact-section .content .container .grid1 .position .grids .grid p,
        .contact-section .content .container .grid1 .phone .grids .grid p {
            color: var(--black);
            font-size: 16px;
            font-family: var(--light);
        }

        .contact-section .content .container .grid2 {
            background-color: var(--cyan);
            padding: 20px;
            border-radius: 25px;
        }

        .contact-section .content .container .grid2 label {
            color: var(--white);
            margin-bottom: 5px;
            font-family: var(--light);
            font-size: 18px;
        }

        .contact-section .content .container .grid2 input {
            width: 100%;
            height: 30px;
            margin-bottom: 15px;
            outline: none;
            border: none;
            border-radius: 10px;
            padding: 0 15px;
            background-color: var(--white);
        }

        .contact-section .content .container .grid2 textarea {
            width: 100%;
            margin-bottom: 15px;
            resize: none;
            height: 60px;
            outline: none;
            border: none;
            border-radius: 10px;
            padding: 4px 15px;
            background-color: var(--white);
        }

        .contact-section .content .container .grid2 button {
            padding: 5px 20px;
            border-radius: 10px;
            border: none;
            outline: none;
            cursor: pointer;
            font-family: var(--regular);
            font-size: 16px;
            transition: all ease .3s;
            background-color: var(--white);
        }

        .contact-section .content .container .grid2 button:hover {
            color: var(--white);
            background-color: #031d2a;
        }

        @media screen and (max-width:799px) {
            .contact-section .content .img img {
                width: 150px;
            }

            .contact-section .content .container {
                width: 100%;
                padding: 0;
                padding-top: 20px;
                grid-template-columns: repeat(1, 1fr);
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