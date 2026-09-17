<footer>
    <div class="social_media">
        <a href="https://www.facebook.com/share/8CoJYQpNBrCa8kxN/?mibextid=qi2Omg"><ion-icon name="logo-facebook"></ion-icon></a>
        <a href="https://www.tiktok.com/@napolifunhajjisports"><ion-icon name="logo-tiktok"></ion-icon></a>
        <a href="https://x.com/Napoli_Fan/"><ion-icon name="logo-twitter"></ion-icon></a>
        <a href="https://www.youtube.com/@nfhajjisportspro"><ion-icon name="logo-youtube"></ion-icon></a>
        <a href="https://www.instagram.com/nf_hajji_sports?igsh=MXA0YmF4Mmk3ZTgzdg=="><ion-icon name="logo-instagram"></ion-icon></a>
    </div>
    <div class="footer-img">
        <img src="imgs/footer/LUW.png" alt="">
    </div>
    <div class="footer-content">
        <div class="part1">
            <a href=""><img src="imgs/footer/napolifan.png" alt=""></a>
            <a href="https://www.csvnapoli.it/"><img src="imgs/footer/csv.png" alt=""></a>
            <a href="https://www.beneventocalcio.club/"><img src="imgs/footer/benevento.png" alt=""></a>
            <a href=""><img src="imgs/footer/legends.png" alt=""></a>
            <a href="https://www.caravaggiosv.com/"><img src="imgs/footer/carvaggio.png" alt=""></a>
            <a href=""><img src="imgs/footer/apt.png" alt=""></a>

        </div>
        <div class="part2">
            <div class="grid1">
                <a href="list_products?pid=homme">Hommes</a>
                <a href="list_products?pid=femme">Femmes</a>
                <a href="list_products?pid=enfant">Enfants</a>
                <a href="list_products?pid=equipement">Equipement</a>
                <a href="list_products?pid=accessoire">Accessoires</a>
                <a href="personnalisation">Personnalisation</a>
                <a href="promos">PROMOS</a>
            </div>
            <div class="grid2">
                <h4>Accèe rapide</h4>
                <a href="gallery">Galerie</a>
                <a href="contact">Contactez-nous</a>
            </div>
            <div class="grid3">
                <h4>Mon compte</h4>
                <?php
                if ($user_id) {
                    $manager = "edit_infos?pid=$user_id";
                    $commands = "commands?pid=$user_id";
                    $wishlist = "wishlist?pid=$user_id";
                    $return_product = "return_product?pid=$user_id";
                } else {
                    $manager = "login";
                    $commands = "login";
                    $wishlist = "login";
                    $return_product = "login";
                }
                ?>
                <a href="<?= $manager ?>">Gérer mon compte</a>
                <a href="<?= $commands ?>">Mes commandes</a>
                <a href="<?= $wishlist ?>">Mes favoris</a>
                <a href="<?= $return_product ?>">Retourner un produit</a>
            </div>
        </div>
        <!--<div class="apt">
            <img src="imgs/footer/apt.png" alt="">
        </div>-->
        <hr>
        <div class="part3">
            <div class="line1">
            </div>
        </div>
    </div>
</footer>

<style>
    footer {
        width: 100%;
        background-color: #0f0c29;
        user-select: none;
    }

    footer a {
        transition: .4s all ease;
    }

    footer .social_media {
        padding: 15px;
        width: 20%;
        margin: auto;
        display: flex;
        justify-content: space-between;
    }

    footer .social_media p {
        color: var(--white);
        font-size: 20px;
        font-family: var(--light);
    }

    footer .social_media a {
        display: flex;
        align-items: center;
        font-size: 27px;
        color: var(--white);
        transition: all ease .3s;
    }

    footer .social_media a:hover {
        color: var(--cyan);
    }

    footer .footer-img {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 15px 0;
        background-color: #302b63;
    }

    footer .footer-img img {
        width: 200px;
    }

    footer .footer-content {
        width: 100%;
        background-color: #302b63;
    }

    footer .footer-content .part1 {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        padding: 20px;
    }

    footer .footer-content .part1 a {
        width: 75%;
        margin: auto;
    }

    footer .footer-content .part1 a img {
        width: 100%;
    }

    footer .footer-content .part2 {
        display: flex;
        justify-content: space-between;
        width: 85%;
        margin: auto;
        padding: 20px 0;
    }

    footer .footer-content .part2 .grid1,
    footer .footer-content .part2 .grid2,
    footer .footer-content .part2 .grid3 {
        border-top: 1px solid var(--white);
        padding-top: 10px;
    }

    footer .footer-content .part2 .grid1 a,
    footer .footer-content .part2 .grid2 a,
    footer .footer-content .part2 .grid3 a {
        display: block;
        text-decoration: none;
        font-size: 17px;
        font-family: var(--regular);
        color: var(--white);
        margin-bottom: 5px;
    }

    footer .footer-content .part2 a:hover {
        color: var(--cyan);
    }

    footer .footer-content .part2 h4 {
        color: var(--white);
        font-family: var(--bold);
        font-size: 20px;
        margin-bottom: 15px;
    }

    footer .footer-content hr {
        width: 100%;
        height: 1px;
        background-color: var(--white);
    }

    .apt {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .apt img {
        width: 100px;
        padding-bottom: 20px;
    }

    footer .footer-content .part3 {
        width: 100%;
        padding: 15px 40px;
        background-color: var(--black);
    }

    footer .footer-content .part3 .line1 {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 5px;
    }

    footer .footer-content .part3 .line2 {
        width: 50%;
        display: flex;
        justify-content: space-between;
    }

    footer .footer-content .part3 a {
        color: var(--cyan);
        text-decoration: none;
        font-family: var(--regular);
        font-size: 15px;
    }

    footer .footer-content .part3 a:hover {
        color: var(--white);
    }

    @media screen and (max-width:799px) {
        footer .social_media {
            width: 80%;
        }

        footer .footer-img img {
            width: 100px;
        }

        footer .footer-content .part1 {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        footer .footer-content .part2 {
            display: block;
            width: 60%;
            margin: auto;
            padding: 20px 0;
            text-align: center;
        }

        footer .footer-content .part2 .grid1,
        footer .footer-content .part2 .grid2,
        footer .footer-content .part2 .grid3 {
            padding-bottom: 20px;
        }

        .apt img {
            width: 80px;
        }

        footer .footer-content .part3 .line1 {
            width: 100%;
            display: block;
            margin-bottom: 5px;
        }

        footer .footer-content .part3 .line2 {
            width: 100%;
            display: block;
        }

        footer .footer-content .part3 a {
            display: block;
            text-align: center;
            margin-bottom: 10px;
        }
    }

    @media screen and (min-width:800px) and (max-width:1100px) {
        footer .social_media {
            width: 30%;
        }

        footer .footer-img img {
            width: 150px;
        }
    }
</style>