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

if (isset($_POST["submit_request"])) {
    $id = uniq_id();

    $fullname = $_POST["fullname"];
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);

    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $tel = $_POST["tel"];
    $tel = filter_var($tel, FILTER_SANITIZE_STRING);

    $service = $_POST["service"];
    $service = filter_var($service, FILTER_SANITIZE_STRING);

    $message = $_POST["message"];
    $message = filter_var($message, FILTER_SANITIZE_STRING);

    $insert_contact = $conn->prepare("INSERT INTO `service_requests` (id,name,email,phone,service,message) VALUES (?,?,?,?,?,?)");
    $insert_contact->execute([$id, $fullname, $email, $tel, $service, $message]);

    $success_msg[] = 'merci pour votre message , on va vous répondre le dés possible';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - services</title>
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

    <div class="service_container">
        <p class="title_p"><span>NF</span> Hajji Sports</p>
        <h1 class="title_h1">Nos services</h1>
                    
        <div class="apropos">
            <div class="book">
                <input type="checkbox" name="" id="c1">
                <input type="checkbox" name="" id="c2">
                <input type="checkbox" name="" id="c3">
                <input type="checkbox" name="" id="c4">
                <input type="checkbox" name="" id="c5">
                <input type="checkbox" name="" id="c6">
                <input type="checkbox" name="" id="c7">
                <input type="checkbox" name="" id="c8">
                <input type="checkbox" name="" id="c9">
            <div class="cover">
            </div>
            <div class="flip-book">
                <div class="flip" id="p1">
                    <div class="back">
                        <img src="imgs/service/1.png" alt="">
                        <label id="back-btn" for="c1"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/cover.png" alt="">
                        <label id="next-btn" for="c1"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p2">
                    <div class="back">
                        <img src="imgs/service/3.png" alt="">
                        <label id="back-btn" for="c2"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/2.png" alt="">
                        <label id="next-btn" for="c2"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p3">
                    <div class="back">
                        <img src="imgs/service/5.png" alt="">
                        <label id="back-btn" for="c3"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/4.png" alt="">
                        <label id="next-btn" for="c3"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p4">
                    <div class="back">
                        <img src="imgs/service/7.png" alt="">
                        <label id="back-btn" for="c4"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/6.png" alt="">
                        <label id="next-btn" for="c4"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p5">
                    <div class="back">
                        <img src="imgs/service/9.png" alt="">
                        <label id="back-btn" for="c5"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/8.png" alt="">
                        <label id="next-btn" for="c5"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p6">
                    <div class="back">
                        <img src="imgs/service/11.png" alt="">
                        <label id="back-btn" for="c6"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/10.png" alt="">
                        <label id="next-btn" for="c6"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p7">
                    <div class="back">
                        <img src="imgs/service/13.png" alt="">
                        <label id="back-btn" for="c7"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/12.png" alt="">
                        <label id="next-btn" for="c7"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p8">
                    <div class="back">
                        <img src="imgs/service/15.png" alt="">
                        <label id="back-btn" for="c8"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/14.png" alt="">
                        <label id="next-btn" for="c8"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p9">
                    <div class="back">
                        <img src="imgs/service/b-cover.png" alt="">
                        <label id="back-btn" for="c9"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/service/16.png" alt="">
                        <label id="next-btn" for="c9"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="services">
            <div class="ser1">
                <div class="welcome">
                    <div class="hr"></div>
                    <h2>DEMANDE</h2>
                    <p class="sec_title">D'INFORMATION</p>
                    <p>Nous accueillons vos commentaires, questions ou suggestions. Écrivez-nous, nous vous répondrons sans faute !</p>
                </div>
                <div class="form">
                    <form action="" method="post">
                        <div class="part">
                            <input type="text" name="fullname" placeholder="Nom Complet ..." id="" required maxlength="20">
                            <input type="text" name="email" placeholder="Email ..." id="" required maxlength="30">
                        </div>
                        <div class="part">
                            <input type="text" name="tel" placeholder="Téléphone ..." required maxlength="15">
                            <select name="service" id="">
                                <option value="-1">Choisi le service</option>
                                <option value="transport">Transport</option>
                                <option value="formation sportive">Formation sportive</option>
                                <option value="soutien aux entreprises">Soutien aux entreprises</option>
                                <option value="formation privée du football">Formation privée du football</option>
                                <option value="collaboration avex les écoles privées">Collaboration avex les écoles privées</option>
                            </select>
                        </div>
                        <textarea name="message" id="" placeholder="Message ..." required maxlength="150"></textarea>
                        <button type="submit" name="submit_request">Envoyer demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .apropos {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
            padding: 20px;
        }

        #c1,
        #c2,
        #c3,
        #c4,
        #c5,
        #c6,
        #c7,
        #c8,
        #c9 {
            display: none;
        }

        .apropos img {
            width: 100%;
            height: 100%;
        }

        .book {
            display: flex;
        }

        .book .cover {
            width: 500px;
            height: 500px;
        }

        .book .flip-book {
            width: 500px;
            height: auto;
            position: relative;
            perspective: 1500px;
        }

        .flip {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: left;
            transform-style: preserve-3d;
            transform: rotateY(0deg);
            transition: .5s;
            color: var(--dark2);
        }

        .flip .front {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: var(--dark2);
            box-sizing: border-box;
            box-shadow: inset 20px 0 50px var(--dark2) 0 2px 5px var(--dark2);
        }

        .flip .back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            background-color: var(--dark2);
        }

        #next-btn {
            position: absolute;
            bottom: 17px;
            right: 13px;
            cursor: pointer;
            color: var(--light1);
            font-size: 35px;
        }

        #back-btn {
            position: absolute;
            bottom: 17px;
            left: 13px;
            cursor: pointer;
            color: var(--light1);
            font-size: 35px;
        }

        #p1 {
            z-index: 9;
        }

        #p2 {
            z-index: 8;
        }

        #p3 {
            z-index: 7;
        }

        #p4 {
            z-index: 6;
        }

        #p5 {
            z-index: 5;
        }

        #p6 {
            z-index: 4;
        }

        #p7 {
            z-index: 3;
        }

        #p8 {
            z-index: 2;
        }

        #p9 {
            z-index: 1;
        }

        #c1:checked~.flip-book #p1 {
            transform: rotateY(-180deg);
            z-index: 1;
        }

        #c2:checked~.flip-book #p2 {
            transform: rotateY(-180deg);
            z-index: 2;
        }

        #c3:checked~.flip-book #p3 {
            transform: rotateY(-180deg);
            z-index: 3;
        }

        #c4:checked~.flip-book #p4 {
            transform: rotateY(-180deg);
            z-index: 4;
        }

        #c5:checked~.flip-book #p5 {
            transform: rotateY(-180deg);
            z-index: 5;
        }

        #c6:checked~.flip-book #p6 {
            transform: rotateY(-180deg);
            z-index: 6;
        }

        #c7:checked~.flip-book #p7 {
            transform: rotateY(-180deg);
            z-index: 7;
        }

        #c8:checked~.flip-book #p8 {
            transform: rotateY(-180deg);
            z-index: 8;
        }

        #c9:checked~.flip-book #p9 {
            transform: rotateY(-180deg);
            z-index: 9;
        }


        @media screen and (max-width:799px) {
            .book .cover {
                width: 200px;
                height: 200px;
            }

            .book .flip-book {
                width: 200px;
            }


            .apropos {
                height: auto;
                padding: 40px 0;
            }

            .vids_2 {
                grid-template-columns: repeat(1, 1fr);
            }

            .vids_2 .video {
                height: 250px;
            }
        }


        @media screen and (min-width:800px) and (max-width:1100px) {
            .book .cover {
                width: 350px;
                height: 350px;
            }

            .book .flip-book {
                width: 350px;
            }


            .apropos {
                height: auto;
                padding: 40px 0;
            }

            .vids_2 {
                grid-template-columns: repeat(2, 1fr);
            }

            .vids_2 .video {
                height: 300px;
            }
        }

        .service_container {
            padding: 20px;
            width: 100%;
            height: auto;
            padding-top: 80px;
        }

        .service_container .title_p {
            text-align: center;
            font-size: 18px;
            font-family: var(--light);
            color: var(--white);
        }

        .service_container .title_p span {
            color: var(--cyan);
        }

        .service_container .title_h1 {
            text-align: center;
            font-size: 35px;
            font-family: var(--bold);
            color: var(--white);
            margin-bottom: 25px;
        }

        .service_container .services {
            width: 70%;
            margin: auto;
        }

        .service_container .services .ser1 {
            display: flex;
            background-color: #000304;
            margin-bottom: 30px;
        }

        .service_container .services .ser1 .content {
            width: 40%;
            padding: 20px;
        }

        .service_container .services .ser1 .content .hr {
            width: 15%;
            margin-bottom: 15px;
            background-color: var(--cyan);
            height: 3px;
        }

        .service_container .services .ser1 .content h2 {
            font-size: 27px;
            font-family: var(--bold);
            color: var(--white);
            width: 100%;
        }

        .service_container .services .ser1 .content .sec_title {
            font-size: 22px;
            font-family: var(--light);
            color: var(--white);
            margin-bottom: 10px;
        }

        .service_container .services .ser1 .content p {
            font-size: 16px;
            font-family: var(--light);
            color: rgb(216, 216, 216);
        }

        .service_container .services .ser1 .img {
            width: 60%;
        }

        .service_container .services .ser1 .img img {
            width: 100%;
        }

        .service_container .services .ser1 .welcome {
            width: 30%;
            padding: 20px;
        }

        .service_container .services .ser1 .welcome .hr {
            width: 20%;
            margin-bottom: 15px;
            background-color: var(--cyan);
            height: 3px;
        }

        .service_container .services .ser1 .welcome h2 {
            font-size: 27px;
            font-family: var(--bold);
            color: var(--white);
        }

        .service_container .services .ser1 .welcome .sec_title {
            font-size: 22px;
            font-family: var(--light);
            color: var(--white);
            margin-bottom: 15px;
        }

        .service_container .services .ser1 .welcome p {
            font-size: 17px;
            font-family: var(--light);
            color: var(--white);
        }

        .service_container .services .ser1 .form {
            width: 100%;
            padding: 20px;
            background-color: #020c11
        }

        .service_container .services .ser1 .form form {
            width: 100%;
        }

        .service_container .services .ser1 .form form .part {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .service_container .services .ser1 .form form .part input {
            width: 48%;
            outline: none;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            font-family: var(--regular);
        }

        .service_container .services .ser1 .form form .part select {
            width: 48%;
            outline: none;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            font-family: var(--regular);
        }

        .service_container .services .ser1 .form form textarea {
            width: 100%;
            outline: none;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            font-family: var(--regular);
            resize: none;
            height: 100px;
            margin-bottom: 25px;
        }

        .service_container .services .ser1 .form form button {
            padding: 5px 20px;
            font-size: 16px;
            font-family: var(--regular);
            background-color: var(--cyan);
            color: var(--white);
            transition: all ease .3s;
            border: none;
            cursor: pointer;
        }

        .service_container .services .ser1 .form form button:hover {
            background-color: var(--white);
            color: var(--cyan);
        }

        @media screen and (max-width:799px) {
            .service_container .services {
                width: 100%;
                margin: auto;
            }

            .service_container .services .ser1 {
                display: block;
                padding: 20px;
            }


            .service_container .services .ser1 .content {
                width: 100%;
                padding: 0;
                padding-top: 20px;
            }

            .service_container .services .ser1 .content .hr {
                width: 30%;
            }

            .service_container .services .ser1 .img {
                width: 100%;
            }

            .service_container .services .ser1 .welcome {
                width: 100%;
                padding: 0px;
                padding-bottom: 20px;
            }

            .service_container .services .ser1 .welcome .hr {
                width: 30%;
            }

            .service_container .services .ser1 .form {
                padding: 10px 5px;
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .service_container .services {
                width: 100%;
                margin: auto;
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