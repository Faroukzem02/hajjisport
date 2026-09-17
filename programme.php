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
    <title>hajji sport - programme</title>
    <style>
        <?php include "style.css" ?>
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
            <input type="checkbox" name="" id="c7">
            <input type="checkbox" name="" id="c8">
            <input type="checkbox" name="" id="c9">
            <input type="checkbox" name="" id="c10">
            <input type="checkbox" name="" id="c11">
            <input type="checkbox" name="" id="c12">
            <div class="cover">
            </div>
            <div class="flip-book">
                <div class="flip" id="p1">
                    <div class="back">
                        <img src="imgs/program/1.jpg" alt="">
                        <label id="back-btn" for="c1"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/cover.jpg" alt="">
                        <label id="next-btn" for="c1"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p2">
                    <div class="back">
                        <img src="imgs/program/3.jpg" alt="">
                        <label id="back-btn" for="c2"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/2.jpg" alt="">
                        <label id="next-btn" for="c2"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p3">
                    <div class="back">
                        <img src="imgs/program/5.jpg" alt="">
                        <label id="back-btn" for="c3"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/4.jpg" alt="">
                        <label id="next-btn" for="c3"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p4">
                    <div class="back">
                        <img src="imgs/program/7.jpg" alt="">
                        <label id="back-btn" for="c4"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/6.jpg" alt="">
                        <label id="next-btn" for="c4"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p5">
                    <div class="back">
                        <img src="imgs/program/9.jpg" alt="">
                        <label id="back-btn" for="c5"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/8.jpg" alt="">
                        <label id="next-btn" for="c5"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p6">
                    <div class="back">
                        <img src="imgs/program/11.jpg" alt="">
                        <label id="back-btn" for="c6"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/10.jpg" alt="">
                        <label id="next-btn" for="c6"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p7">
                    <div class="back">
                        <img src="imgs/program/13.jpg" alt="">
                        <label id="back-btn" for="c7"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/12.jpg" alt="">
                        <label id="next-btn" for="c7"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p8">
                    <div class="back">
                        <img src="imgs/program/15.jpg" alt="">
                        <label id="back-btn" for="c8"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/14.jpg" alt="">
                        <label id="next-btn" for="c8"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p9">
                    <div class="back">
                        <img src="imgs/program/17.jpg" alt="">
                        <label id="back-btn" for="c9"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/16.jpg" alt="">
                        <label id="next-btn" for="c9"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p10">
                    <div class="back">
                        <img src="imgs/program/19.jpg" alt="">
                        <label id="back-btn" for="c10"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/18.jpg" alt="">
                        <label id="next-btn" for="c10"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p11">
                    <div class="back">
                        <img src="imgs/program/21.jpg" alt="">
                        <label id="back-btn" for="c11"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/20.jpg" alt="">
                        <label id="next-btn" for="c11"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
                <div class="flip" id="p12">
                    <div class="back">
                        <img src="imgs/program/b-cover.jpg" alt="">
                        <label id="back-btn" for="c12"><ion-icon name="caret-back"></ion-icon></label>
                    </div>
                    <div class="front">
                        <img src="imgs/program/22.jpg" alt="">
                        <label id="next-btn" for="c12"><ion-icon name="caret-forward"></ion-icon></label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .vids_2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 100%;
            padding: 20px;
            padding-top: 85px;
            height: auto;
        }

        .vids_2 .video {
            background-color: var(--white);
            padding: 10px;
            height: 400px;
            width: 100%;
        }

        .vids_2 .video iframe {
            width: 100%;
            height: 100%;
            box-shadow: 0 0 8px var(--black);
        }

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
        #c9,
        #c10,
        #c11,
        #c12 {
            display: none;
        }

        .apropos img {
            width: 100%;
            height: 100%;
        }

        .book {
            display: flex;
            margin-top: 85px;
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
            z-index: 12;
        }

        #p2 {
            z-index: 11;
        }

        #p3 {
            z-index: 10;
        }

        #p4 {
            z-index: 9;
        }

        #p5 {
            z-index: 8;
        }

        #p6 {
            z-index: 7;
        }

        #p7 {
            z-index: 6;
        }

        #p8 {
            z-index: 5;
        }

        #p9 {
            z-index: 4;
        }

        #p10 {
            z-index: 3;
        }

        #p11 {
            z-index: 2;
        }

        #p12 {
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

        #c10:checked~.flip-book #p10 {
            transform: rotateY(-180deg);
            z-index: 10;
        }

        #c11:checked~.flip-book #p11 {
            transform: rotateY(-180deg);
            z-index: 11;
        }

        #c12:checked~.flip-book #p12 {
            transform: rotateY(-180deg);
            z-index: 12;
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
    </style>

    <?php include "index/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


    <?php include "alert.php" ?>

</body>

</html>