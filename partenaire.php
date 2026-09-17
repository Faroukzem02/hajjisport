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
    <title>hajji sport - encadrants</title>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="icon" href="imgs/ico.png" type="image/x-icon">
</head>

<body>
    <?php include "loading.php" ?>
    <?php include "index/header.php" ?>
    <div class="encadrants">
        <div class="videos">
            <button class="arrow-left" onclick="prev()">&#10094;</button>
            <div class="slides">
                <div class="videos_slider">
                    <?php
                    $select_video = $conn->prepare("SELECT * from `videos`");
                    $select_video->execute();
                    if ($select_video->rowCount() > 0) {
                        while ($fetch_video = $select_video->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                            <div class="slider">
                                <a href="<?=$fetch_video["ytblink"]?>">
                                    <div class="img">
                                        <img src="imgs/encadrants/<?=$fetch_video["img"]?>" alt="" srcset="">
                                    </div>
                                </a>
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
        .encadrants {
            width: 100%;
            height: auto;
            padding: 20px 40px;
            padding-top: 100px;
        }

        .encadrants .videos {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .encadrants .videos button {
            border: none;
            cursor: pointer;
            background-color: transparent;
            font-size: 40px;
            color: var(--white);
            transition: .3s all ease;
        }

        .encadrants .videos button:hover {
            color: var(--cyan);
            transform: scale(1.01);
        }


        .encadrants .videos .slides {
            width: 1000px;
            height: auto;
            overflow: hidden;
        }

        .encadrants .videos .videos_slider {
            width: 1000px;
            height: auto;
            display: flex;
            transition: all ease-in-out .4s;
        }

        .encadrants .videos .videos_slider .slider {
            width: 1000px;
            height: auto;
        }

        .encadrants .videos .videos_slider .slider .img {
            width: 1000px;
            height: auto;
            background-color: var(--white);
            padding: 10px;
            transition: all ease .3s;
        }

        .encadrants .videos .videos_slider .slider .img:hover{
            opacity: 0.8;
        }

        .encadrants .videos .videos_slider .slider .img img {
            width: 100%;
            height: auto;
            box-shadow: 0 0 8px var(--dark1);
        }

        @media screen and (max-width:799px) {
            .encadrants {
                width: 100%;
                height: auto;
                padding: 10px;
                padding-top: 100px;
            }

            .encadrants .videos .slides {
                width: 300px;
            }

            .encadrants .videos button {
                font-size: 30px;
            }

            .encadrants .videos .videos_slider {
                width: 300px;
                height: auto;
                display: flex;
                transition: all ease-in-out .4s;
            }

            .encadrants .videos .videos_slider .slider {
                width: 300px;
                height: auto;
            }

            .encadrants .videos .videos_slider .slider .img {
            width: 300px;
            height: auto;
            background-color: var(--white);
            padding: 5px;
            transition: all ease .3s;
        }
        }

        @media screen and (min-width:800px) and (max-width:1100px) {
            .encadrants {
                width: 100%;
                height: auto;
                padding: 10px 30px;
                padding-top: 100px;
            }

            .encadrants .videos .slides {
                width: 500px;
            }

            .encadrants .videos button {
                font-size: 35px;
            }

            .encadrants .videos .videos_slider {
                width: 500px;
                height: auto;
                display: flex;
                transition: all ease-in-out .4s;
            }

            .encadrants .videos .videos_slider .slider {
                width: 500px;
                height: auto;
            }

            .encadrants .videos .videos_slider .slider .img {
            width: 500px;
            height: auto;
            background-color: var(--white);
            padding: 10px;
            transition: all ease .3s;
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