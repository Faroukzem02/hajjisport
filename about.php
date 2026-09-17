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
    <title>hajji sport - a propos</title>
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
    <div class="apropos">
        <div class="book">
            <input type="checkbox" name="" id="c1">
            <input type="checkbox" name="" id="c2">
            <input type="checkbox" name="" id="c3">
            <input type="checkbox" name="" id="c4">
            <input type="checkbox" name="" id="c5">
            <input type="checkbox" name="" id="c6">
            <div class="cover">
            </div>
            <div class="flip-book">
                <div class="flip" id="p1">
                    <div class="back">
                        <img src="imgs/flipbook/2.png" alt="">
                        <label id="back-btn" for="c1"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/cover.png" alt="">
                        <label id="next-btn" for="c1"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p2">
                    <div class="back">
                        <img src="imgs/flipbook/4.png" alt="">
                        <label id="back-btn" for="c2"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/3.png" alt="">
                        <label id="next-btn" for="c2"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p3">
                    <div class="back">
                        <img src="imgs/flipbook/6.png" alt="">
                        <label id="back-btn" for="c3"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/5.png" alt="">
                        <label id="next-btn" for="c3"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p4">
                    <div class="back">
                        <img src="imgs/flipbook/8.png" alt="">
                        <label id="back-btn" for="c4"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/7.png" alt="">
                        <label id="next-btn" for="c4"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p5">
                    <div class="back">
                        <img src="imgs/flipbook/10.png" alt="">
                        <label id="back-btn" for="c5"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/9.png" alt="">
                        <label id="next-btn" for="c5"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p6">
                    <div class="back">
                        <img src="imgs/flipbook/b-cover.png" alt="">
                        <label id="back-btn" for="c6"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/flipbook/11.png" alt="">
                        <label id="next-btn" for="c6"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "index/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?php include "alert.php" ?>

    <style>
        .span {
            color: var(--dark2);
            position: absolute;
            top: 30px;
            left: 30px;
            font-size: 30px;
            cursor: pointer;
        }

        .apropos {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            user-select: none;
        }

        #c1,
        #c2,
        #c3,
        #c4,
        #c5,
        #c6 {
            display: none;
        }

        .apropos img {
            width: 100%;
            height: 100%;
        }

        .book {
            display: flex;
            margin-top: 70px;
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
            z-index: 6;
        }

        #p2 {
            z-index: 5;
        }

        #p3 {
            z-index: 4;
        }

        #p4 {
            z-index: 3;
        }

        #p5 {
            z-index: 2;
        }

        #p6 {
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
        }
    </style>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>