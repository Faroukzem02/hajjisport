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
    <title>hajji sport - events</title>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>

    <div class="apropos">
        <?php
        $select_gallery = $conn->prepare("SELECT * FROM `events_pics` order by date");
        $select_gallery->execute();
        $fetch_gallery = $select_gallery->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="book">
            <?php
            for ($i = 0; $i <= count($fetch_gallery); $i+=2) {
            ?>
                <input type="checkbox" name="" id="c<?= $i ?>" style="display: none">
            <?php
            }
            ?>
            <div class="cover"></div>
            <div class="flip-book">
                <?php
                for ($i = 0; $i <= count($fetch_gallery); $i+=2) {
                ?>
                    <div class="flip" id="p<?= $i ?>">
                        <?php
                        if ($i !== count($fetch_gallery)) {
                        ?>
                            <div class="back">
                                <img src="imgs/events/<?= $fetch_gallery[$i + 1]["img"] ?>" alt="">
                                <label id="back-btn" for="c<?= $i ?>"><ion-icon name="caret-back"></ion-icon></label>
                            </div>
                            <div class="front">
                                <img src="imgs/events/<?= $fetch_gallery[$i]["img"] ?>" alt="">
                                <label id="next-btn" for="c<?= $i ?>"><ion-icon name="caret-forward"></ion-icon></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <style>
                        #c<?= $i ?>:checked~.flip-book #p<?= $i ?> {
                            transform: rotateY(-180deg);
                            z-index: <?= $i ?>;
                        }

                        #p<?= $i ?> {
                            z-index: <?php echo count($fetch_gallery) - $i ?>;
                        }
                    </style>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <div class="programme">
        <div class="videos">
            <button class="arrow-left" onclick="prev()">&#10094;</button>
            <div class="slides">
                <div class="videos_slider">
                    <?php
                    $select_video = $conn->prepare("SELECT * from `events_vids` ORDER by date desc");
                    $select_video->execute();
                    if ($select_video->rowCount() > 0) {
                        while ($fetch_video = $select_video->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div class="slider">
                                <div class="video">
                                    <iframe src="<?= $fetch_video["iframe"] ?>"></iframe>
                                    <video>
                                        <source src="<?= $fetch_video["lien"] ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <button class="arrow-right" onclick="next()">&#10095;</button>
        </div>
    </div>

    <script>
        let currentIndex = 0;

        function getTranslateX() {
            if (window.matchMedia("(max-width: 799px)").matches) {
                return 300;
            } else if (window.matchMedia("(min-width: 800px) and (max-width: 1100px)").matches) {
                return 500;
            } else {
                return 1000;
            }
        }

        function showSlide(i) {
            let slides = document.querySelector(".videos_slider");
            const totalSlides = slides.children.length;

            currentIndex = (i + totalSlides) % totalSlides;
            const translateX = -currentIndex * getTranslateX();
            slides.style.transform = `translateX(${translateX}px)`;
        }

        function next() {
            showSlide(currentIndex + 1);
        }

        function prev() {
            showSlide(currentIndex - 1);
        }
    </script>

    <style>
        .programme {
            width: 100%;
            height: auto;
            padding: 20px 40px;
        }

        .programme .videos {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .programme .videos button {
            border: none;
            cursor: pointer;
            background-color: transparent;
            font-size: 40px;
            color: var(--white);
            transition: .3s all ease;
        }

        .programme .videos button:hover {
            color: var(--cyan);
            transform: scale(1.01);
        }


        .programme .videos .slides {
            width: 1000px;
            height: auto;
            overflow: hidden;
        }

        .programme .videos .videos_slider {
            width: 1000px;
            height: auto;
            display: flex;
            transition: all ease-in-out .4s;
        }

        .programme .videos .videos_slider .slider {
            width: 1000px;
            height: 500px;
        }

        .programme .videos .videos_slider .slider .video {
            width: 1000px;
            height: 500px;
            background-color: var(--white);
            padding: 20px;
        }

        .programme .videos .videos_slider .slider .video iframe {
            width: 100%;
            height: 100%;
            border: none;
            box-shadow: 0 0 8px var(--dark1);
        }

        .apropos {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            user-select: none;
            padding-top: 85px;
        }

        .apropos img {
            width: 100%;
            height: 100%;
        }

        .book {
            display: flex;
            margin-bottom: 20px;
            margin-top: 5px;
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
            color: var(--dark1);
        }

        .flip .front {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: var(--dark1);
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


        @media screen and (max-width:799px) {
            .programme {
                width: 100%;
                height: auto;
                padding: 10px;
            }

            .programme .videos .slides {
                width: 300px;
            }

            .programme .videos button {
                font-size: 30px;
            }

            .programme .videos .videos_slider {
                width: 300px;
                height: auto;
                display: flex;
                transition: all ease-in-out .4s;
            }

            .programme .videos .videos_slider .slider {
                width: 300px;
                height: 160px;
            }

            .programme .videos .videos_slider .slider .video {
                width: 300px;
                height: 160px;
                padding: 10px;
            }

            .nav_gallery .content a {
                font-size: 14px;
            }

            .book .cover {
                width: 200px;
                height: 200px;
            }

            .book .flip-book {
                width: 200px;
            }


            .apropos {
                height: auto;
                padding: 20px 0;
                padding-top: 100px;
            }

            .flip .front .description {
                padding: 20px;
            }

            .flip .front .description h2 {
                color: var(--white);
                font-size: 12px;
                font-family: var(--bold);
                margin-bottom: 10px;
            }

            .flip .front .description h4 {
                color: var(--white);
                font-size: 12px;
                font-family: var(--bold);
                margin-bottom: 10px;
            }

            .flip .front .description p {
                color: var(--white);
                font-size: 10px;
                font-family: var(--light);
            }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .programme {
                width: 100%;
                height: auto;
                padding: 10px 30px;
            }

            .programme .videos .slides {
                width: 700px;
            }

            .programme .videos button {
                font-size: 35px;
            }

            .programme .videos .videos_slider {
                width: 700px;
                height: auto;
                display: flex;
                transition: all ease-in-out .4s;
            }

            .programme .videos .videos_slider .slider {
                width: 700px;
                height: 350px;
            }

            .programme .videos .videos_slider .slider .video {
                width: 700px;
                height: 350px;
                padding: 10px;
            }

            .nav_gallery .content a {
                font-size: 16px;
            }

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
                padding-top: 100px;
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