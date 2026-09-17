<header>
    <div class="header">
        <div class="logo">
            <a href="home"><img src="imgs/blue.png" alt=""></a>
        </div>

        <div class="navbar">
            <div class="menu">
                <a style="cursor: pointer;" class="close_menu"><ion-icon name="arrow-forward"></ion-icon></a>
                <a href="home">Acceuil</a>
                <a href="about" class="about_a">Apropos</a>
                <style>
                    @keyframes colorChange {
                        0% {
                            color: #de49a0;
                        }

                        30% {
                            color: #de49a0;
                        }

                        60% {
                            color: #0975af;
                        }

                        90% {
                            color: #de49a0;
                        }

                        100% {
                            color: #de49a0;
                        }
                    }

                    @keyframes colorChange1 {
                        0% {
                            color: #de49a0;
                        }

                        30% {
                            color: #de49a0;
                        }

                        60% {
                            color: #f1f1f1;
                        }

                        90% {
                            color: #de49a0;
                        }

                        100% {
                            color: #de49a0;
                        }
                    }

                    .about_a {
                        color: white;
                        animation: colorChange 4s infinite;
                    }
                </style>
                <div class="encadr">
                    <a style="cursor: pointer;" class="encadrant">Encadrants</a>
                    <div class="show_encadrants">
                        <a href="encadrants">Staff</a>
                        <a href="partenaire">Partenaires</a>
                    </div>
                </div>
                <a href="programme">Programme</a>
                <div class="encadr">
                    <a style="cursor: pointer;" class="galerie">Galerie</a>
                    <div class="show_galerie">
                        <a href="events">Evenements</a>
                        <a href="gallery">Galerie</a>
                        <a href="napoli">Napoli</a>
                    </div>
                </div>
                <a href="services">Services</a>
                <a href="inscri">Inscription</a>
            </div>
            <span class="menu_icon"><ion-icon name="menu" class="menu_icon"></ion-icon></span>
            <div class="icons">
                <ion-icon name="search" class="search_icon"></ion-icon>
                <div class="search">
                    <div class="search_input">
                        <input type="text" id="searchInput" placeholder="Rechercher...">
                        <ion-icon name="search"></ion-icon>
                    </div>

                    <div id="resultsContainer"></div>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#searchInput').on('input', function() {
                                let query = $(this).val();

                                if (query.length > 0) {
                                    $.ajax({
                                        method: 'POST',
                                        url: 'search.php',
                                        data: {
                                            searchQuery: query
                                        },
                                        success: function(data) {
                                            if (data.trim() === "") {
                                                $('#resultsContainer').html("<div class='no-results'>No results found</div>").show();
                                            } else {
                                                $('#resultsContainer').html(data).show();
                                            }
                                        }
                                    });
                                } else {
                                    $('#resultsContainer').html("").hide();
                                }
                            });
                        });
                    </script>
                </div>
                <ion-icon name="person" class="login_icon"></ion-icon>
                <div class="block">
                    <?php
                    if ($user_id) {
                    ?>
                        <p>user : <span><?php echo $_SESSION["user_username"] ?></span></p>
                        <p>email : <span><?php echo $_SESSION["user_email"] ?></span></p>
                        <form action="" method="post">
                            <a href="commands?pid=<?php echo $_SESSION["user_id"] ?>"><ion-icon name="cart-outline"></ion-icon></a>
                            <a href="wishlist?pid=<?php echo $_SESSION["user_id"] ?>"><ion-icon name="heart-outline"></ion-icon></a>
                            <a href="manager?pid=<?php echo $_SESSION["user_id"] ?>"><ion-icon name="settings-outline"></ion-icon></a>
                            <button type="submit" name="logout" class="logout-btn"><ion-icon name="power"></ion-icon></button>
                        </form>
                    <?php
                    } else {
                    ?>
                        <a href="login" class="login_a">S'inscrire / Se connecter</a>
                    <?php
                    }
                    ?>
                </div>
                <!-- <ion-icon name="globe-outline" class="langue_icon"></ion-icon>
                <div class="langue">
                    <a id="fra-link" href="home">Fra</a>
                    <a id="eng-link" href="ang_home">Eng</a>
                    <a id="ita-link" href="ita_home">Ita</a>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const currentPath = window.location.pathname;
                            const currentSearch = window.location.search;
                            const currentHash = window.location.hash;
                            let pageName = currentPath.split('/').pop().split('.')[0];
                            const prefixMatch = pageName.match(/^(ang_|ita_)/);
                            if (prefixMatch) {
                                pageName = pageName.substring(prefixMatch[0].length);
                            }

                            const fraLink = document.getElementById('fra-link');
                            const engLink = document.getElementById('eng-link');
                            const itaLink = document.getElementById('ita-link');

                            if (pageName === 'home') {
                                fraLink.href = 'home' + currentSearch + currentHash;
                                engLink.href = 'ang_home' + currentSearch + currentHash;
                                itaLink.href = 'ita_home' + currentSearch + currentHash;
                            } else {
                                fraLink.href = pageName + currentSearch + currentHash;
                                engLink.href = 'ang_' + pageName + currentSearch + currentHash;
                                itaLink.href = 'ita_' + pageName + currentSearch + currentHash;
                            }
                        });
                    </script>
                </div> -->
            </div>
        </div>
    </div>
</header>

<script>
    let header = document.querySelector("header");
    let logo = document.querySelector(".logo a img");
    let links = document.querySelectorAll(".menu a");
    let icons = document.querySelectorAll(".icons ion-icon");

    let enc = document.querySelector(".encadrant");
    let gal = document.querySelector(".galerie");
    let show_enc = document.querySelector(".show_encadrants");
    let show_gal = document.querySelector(".show_galerie");
    let show_enc_a = document.querySelectorAll(".show_encadrants a");
    let show_gal_a = document.querySelectorAll(".show_galerie a");

    let menu = document.querySelector(".menu");
    let menu_icon = document.querySelector(".menu_icon");
    let menu_close = document.querySelector(".close_menu");
    let menu_ico = document.querySelector(".menu_icon ion-icon");

    let search_icon = document.querySelector(".search_icon");
    let search = document.querySelector(".search");

    let login_icon = document.querySelector(".login_icon");
    let login = document.querySelector(".block");

    let block_icons = document.querySelectorAll(".block a ion-icon");
    let block_btn = document.querySelector(".block button ion-icon");

    let about = document.querySelector(".about_a");


    window.onscroll = () => {
        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            if (menu.style.transform === "translateX(0px)") {
                menu.style.transform = "translateX(-1000px)"
            }
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
            header.style.backgroundColor = "#0f0c29";
            menu.style.backgroundColor = "#0f0c29";
            menu_ico.style.color = "var(--white)";
            about.style.animation = "colorChange1 4s infinite"
            logo.src = "imgs/white.png";
            links.forEach(link => {
                link.style.color = "var(--white)"
            });
            icons.forEach(icon => {
                icon.style.color = "var(--white)"
            });
            block_icons.forEach(icon => {
                icon.style.color = "var(--cyan)"
            });
            block_btn.style.color = "rgb(190,2,0)";
            show_enc_a.forEach(a => {
                a.style.color = "var(--white)"
            });
            show_gal_a.forEach(a => {
                a.style.color = "var(--white)"
            });
        } else {
            header.style.backgroundColor = "transparent";

            function getBg() {
                if (window.matchMedia("(max-width: 799px)").matches) {
                    return "#0f0c29";
                } else if (window.matchMedia("(min-width: 800px) and (max-width: 1100px)").matches) {
                    return "transparent";
                } else {
                    return "transparent";
                }
            }
            menu.style.backgroundColor = getBg();
            menu_ico.style.color = "var(--cyan)";
            about.style.animation = "colorChange 4s infinite"
            logo.src = "imgs/blue.png";
            links.forEach(link => {
                link.style.color = "var(--cyan)"
            });
            icons.forEach(icon => {
                icon.style.color = "var(--cyan)"
            });
            block_icons.forEach(icon => {
                icon.style.color = "var(--cyan)"
            });
            block_btn.style.color = "rgb(190,2,0)";
            show_enc_a.forEach(a => {
                a.style.color = "var(--white)"
            });
            show_gal_a.forEach(a => {
                a.style.color = "var(--white)"
            });
        }
    }

    menu_icon.onclick = () => {
        if (menu.style.transform === "translateX(0px)") {
            menu.style.transform = "translateX(-1000px)";
        } else {
            menu.style.transform = "translateX(0px)";
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    menu_close.onclick = () => {
        if (menu.style.transform === "translateX(-1000px)") {
            menu.style.transform = "translateX(0px)";
        } else {
            menu.style.transform = "translateX(-1000px)";
        }
    }

    enc.onclick = () => {
        if (show_enc.style.display === "block") {
            show_enc.style.display = "none";
        } else {
            show_enc.style.display = "block";
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    gal.onclick = () => {
        if (show_gal.style.display === "block") {
            show_gal.style.display = "none"
        } else {
            show_gal.style.display = "block";
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    enc.onmouseover = show_enc.onmouseover = () => {
        if (show_enc.style.display === "block") {
            show_enc.style.display = "none"
        } else {
            show_enc.style.display = "block";
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    enc.onmouseout = show_enc.onmouseout = () => {
        if (show_enc.style.display === "none") {
            show_enc.style.display = "block"
        } else {
            show_enc.style.display = "none";

        }
    }

    gal.onmouseover = show_gal.onmouseover = () => {
        if (show_gal.style.display === "block") {
            show_gal.style.display = "none"
        } else {
            show_gal.style.display = "block";
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    gal.onmouseout = show_gal.onmouseout = () => {
        if (show_gal.style.display === "none") {
            show_gal.style.display = "block"
        } else {

            show_gal.style.display = "none";
        }
    }

    search_icon.onclick = () => {
        if (search.style.transform === "translateX(0px)") {
            search.style.transform = "translateX(800px)"
        } else {
            search.style.transform = "translateX(0px)"
            if (menu.style.transform === "translateX(0px)") {
                menu.style.transform = "translateX(-1000px)"
            }
            if (login.style.transform === "translateX(0px)") {
                login.style.transform = "translateX(500px)"
            }
        }
    }

    login_icon.onclick = () => {
        if (login.style.transform === "translateX(0px)") {
            login.style.transform = "translateX(500px)"
        } else {
            login.style.transform = "translateX(0px)"
            if (menu.style.transform === "translateX(0px)") {
                menu.style.transform = "translateX(-1000px)"
            }
            if (search.style.transform === "translateX(0px)") {
                search.style.transform = "translateX(800px)"
            }
        }
    }
</script>

<style>
    header {
        width: 100%;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 10;
        user-select: none;
    }

    .header {
        width: 100%;
        background-color: transparent;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 40px;
    }

    header .logo img {
        width: 200px;
    }

    header .navbar {
        display: flex;
        align-items: center;
    }

    header .navbar .menu {
        margin-right: 40px;
        display: flex;
        align-items: center;
    }

    header .navbar .menu a {
        margin-left: 30px;
        font-family: var(--bold);
        color: var(--cyan);
        font-size: 18px;
        text-decoration: none;
        transition: all ease .3s;
    }

    header .navbar .menu a:hover {
        color: var(--light2);
    }

    header .navbar .menu .encadr a {
        display: block;
    }

    header .navbar .menu .show_encadrants {
        background-color: var(--light2);
        display: none;
        position: absolute;
        top: 65px;
        margin-left: 30px;
    }

    header .navbar .menu .show_encadrants a {
        color: var(--white);
        margin: 5px 10px;
    }

    header .navbar .menu .show_galerie {
        background-color: var(--light2);
        display: none;
        position: absolute;
        top: 65px;
        margin-left: 30px;
    }

    header .navbar .menu .show_galerie a {
        color: var(--white);
        margin: 5px 10px;
    }

    header .navbar .icons {
        display: flex;
        align-items: center;
        width: 100%;
    }

    header .navbar .icons ion-icon {
        font-size: 20px;
        color: var(--cyan);
        transition: all ease .3s;
        margin-left: 10px;
        cursor: pointer;
    }

    header .navbar .icons ion-icon:hover {
        color: var(--light2);
    }

    header .navbar .menu_icon {
        font-size: 23px;
        color: var(--cyan);
        transition: all ease .3s;
        margin-left: 10px;
        cursor: pointer;
        display: none;
        align-items: center;
    }

    header .navbar .menu_icon ion-icon:hover {
        color: var(--light2);
    }

    header .navbar .menu .close_menu {
        font-size: 25px;
        display: none;
    }

    header .navbar .icons .block {
        width: 18%;
        background-color: var(--white);
        padding: 10px;
        transform: translateX(500px);
        transition: all ease .4s;
        position: absolute;
        right: 2%;
        top: 100px;
    }

    header .navbar .icons .block p {
        font-size: 16px;
        font-family: var(--regular);
        color: var(--black);
    }

    header .navbar .icons .block p span {
        font-family: var(--bold);
        color: var(--dark1);
    }

    header .navbar .icons .block form {
        margin-top: 10px;
        display: flex;
    }

    header .navbar .icons .block form a {
        color: var(--cyan);
        font-size: 27px;
        display: flex;
        align-items: center;
        margin-right: 5px;
    }

    header .navbar .icons .block form button {
        background-color: transparent;
        border: none;
        font-size: 27px;
        display: flex;
        align-items: center;
        cursor: pointer;
        color: rgba(230, 0, 0);
    }

    header .navbar .icons .block ion-icon {
        font-size: 25px;
        transition: all ease .3s;
        margin-left: 0;
        display: flex;
        align-items: center;
    }

    header .navbar .icons .block ion-icon:hover {
        color: var(--light2);
    }

    header .navbar .icons .block .login_a {
        text-decoration: none;
        font-size: 18px;
        color: var(--cyan);
        font-family: var(--regular);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    header .langue {
        width: 10%;
        height: 35px;
        background-color: var(--white);
        padding: 10px 20px;
        transform: translateX(500px);
        transition: all ease .4s;
        display: flex;
        justify-content: space-between;
        position: absolute;
        right: 2%;
        top: 85px;
    }

    header .langue a {
        text-decoration: none;
        font-size: 18px;
        color: var(--cyan);
        font-family: var(--regular);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search {
        width: 25%;
        position: absolute;
        top: 100px;
        right: 2%;
        background-color: var(--white);
        border-radius: 10px;
        padding: 5px 10px;
        transform: translateX(800px);
        transition: all ease .4s;
    }

    .search .search_input {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search .search_input input {
        font-size: 16px;
        font-family: var(--light);
        color: var(--black);
        border: none;
        outline: none;
        width: 80%;
    }

    .search #resultsContainer {
        max-height: 50vh;
        overflow-y: scroll;
    }

    .search #resultsContainer::-webkit-scrollbar {
        width: 8px;
        background-color: var(--white);
    }

    .search #resultsContainer::-webkit-scrollbar-thumb {
        width: 8px;
        background-color: var(--cyan);
    }

    .search #resultsContainer .result {
        padding-top: 10px;
        font-size: 16px;
        font-family: var(--regular);
    }

    .search #resultsContainer .no-results {
        padding-top: 10px;
        font-size: 16px;
        font-family: var(--regular);
        color: var(--dark2);
    }

    .search #resultsContainer .result a {
        text-decoration: none;
        color: var(--dark2);
    }

    @media screen and (max-width:799px) {
        .header {
            padding: 10px 20px;
        }

        header .logo img {
            width: 120px;
        }

        header .navbar .menu {
            display: block;
            align-items: center;
            position: absolute;
            left: 0;
            top: 80px;
            background-color: #0f0c29;
            width: 50%;
            padding: 5px 10px;
            height: auto;
            transition: all ease .3s;
            transform: translateX(-1000px);
        }

        header .navbar .menu .close_menu {
            font-size: 30px;
            display: flex;
            align-items: center;
        }

        header .navbar .menu_icon {
            display: flex;
        }

        header .navbar .menu a {
            margin-left: 20px;
            font-size: 20px;
            display: block;
            padding-bottom: 20px;
        }


        header .navbar .icons .block {
            width: 60%;
            top: 80px;
        }

        header .langue {
            width: 40%;
            top: 50px;
        }

        header .navbar .menu .show_encadrants {
            left: 90%;
            top: 40%;
            margin-left: 0px;
        }

        header .navbar .menu .show_encadrants a {
            padding: 0;
        }

        header .navbar .menu .show_galerie {
            left: 90%;
            top: 60%;
            margin-left: 0px;
        }

        header .navbar .menu .show_galerie a {
            padding: 0;
        }

        .search {
            width: 95%;
            top: 80px;
        }

        .search #resultsContainer {
            max-height: 60vh;
        }
    }

    @media screen and (min-width:800px) and (max-width:1100px) {
        header .logo img {
            width: 150px;
        }

        header .navbar .menu a {
            margin-left: 15px;
            font-size: 17px;
        }


        header .navbar .icons .block {
            width: 30%;
        }

        header .langue {
            width: 15%;
        }

        header .navbar .menu .show_encadrants {
            top: 70px;
            margin-left: 15px;
        }

        header .navbar .menu .show_galerie {
            top: 70px;
            margin-left: 15px;
        }

        .search {
            width: 60%;
        }

        .search #resultsContainer {
            max-height: 70vh;
        }
    }
</style>