<?php
include "connexion.php";
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hajji sport - Galerie</title>
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
        <?php
        $select_gallery = $conn->prepare("SELECT * FROM `pictures`");
        $select_gallery->execute();
        $fetch_gallery = $select_gallery->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="book">
            <?php
            for ($i = 1; $i <= count($fetch_gallery); $i++) {
            ?>
                <input type="checkbox" name="" id="c<?= $i ?>" style="display: none">
            <?php
            }
            ?>
            <div class="cover"></div>
            <div class="flip-book">
                <?php
                for ($i = 1; $i <= count($fetch_gallery); $i++) {
                ?>
                    <div class="flip" id="p<?= $i ?>">
                        <div class="back">
                            <?php
                            if ($i === count($fetch_gallery)) {
                            ?>
                                <img src="imgs/gallery/b-cover.png" alt="">
                                <label id="back-btn" for="c<?= $i ?>"><ion-icon name="caret-back"></ion-icon></label>
                            <?php
                            } else {
                            ?>
                                <img src="imgs/gallery/<?= $fetch_gallery[$i]["img1"] ?>" alt="">
                                <label id="back-btn" for="c<?= $i ?>"><ion-icon name="caret-back"></ion-icon></label>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="front">
                            <?php
                            if ($i === 1) {
                            ?>
                                <img src="imgs/gallery/cover.png" alt="">
                                <label id="next-btn" for="c<?= $i ?>"><ion-icon name="caret-forward"></ion-icon></label>
                            <?php
                            } else {
                            ?>
                                <div class="description">
                                    <h2><?= $fetch_gallery[$i - 1]["nom"] ?></h2>
                                    <h4><?= $fetch_gallery[$i - 1]["job_fr"] ?></h4>
                                    <p><?= $fetch_gallery[$i - 1]["description_fr"] ?></p>
                                </div>

                                <label id="next-btn" for="c<?= $i ?>"><ion-icon name="caret-forward"></ion-icon></label>
                            <?php
                            }
                            ?>
                        </div>
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
    </div>

    <?php include "index/footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?php include "alert.php" ?>

    <style>
        .nav_gallery {
            width: 100%;
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 85px;
        }

        .nav_gallery .content {
            display: flex;
            justify-content: space-between;
            background-color: var(--dark1);
            padding: 5px;
        }

        .nav_gallery .content a {
            text-decoration: none;
            font-family: var(--bold);
            font-size: 20px;
            padding: 0 15px;
            color: var(--white);
            transition: all ease .3s;
        }

        .nav_gallery .content a:hover {
            color: var(--light1);
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
            margin-bottom: 70px;
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

        .flip .front .description {
            padding: 20px;
        }

        .flip .front .description h2 {
            color: var(--white);
            font-size: 22px;
            font-family: var(--bold);
            margin-bottom: 10px;
        }

        .flip .front .description h4 {
            color: var(--white);
            font-size: 18px;
            font-family: var(--bold);
            margin-bottom: 10px;
        }

        .flip .front .description p {
            color: var(--white);
            font-size: 18px;
            font-family: var(--light);
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
            .nav_gallery .content a {
                font-size: 16px;
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
                font-size: 14px;
                font-family: var(--bold);
                margin-bottom: 10px;
            }

            .flip .front .description p {
                color: var(--white);
                font-size: 12px;
                font-family: var(--light);
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
                padding-top: 100px;
            }
        }
    </style>
</body>

</html>