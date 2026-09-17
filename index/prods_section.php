<div class="prods_section">
    <div class="title">
        <img src="imgs/blue-pro.png" style="width: 200px;" alt="">
        <h3>Nos Produits</h3>
    </div>
    <div class="grids">
        <a href="list_products?pid=homme" class="grid">
            <div>
                <img src="imgs/prods/homme.png" alt="">
                <p class="p_title">Homme</p>
                <p>Découvrez notre collection de vêtements de sport haute performance pour hommes, conçus avec des matériaux avancés pour un confort et une durabilité optimaux.</p>
            </div>
        </a>
        <a href="list_products?pid=femme" class="grid">
            <div>
                <img src="imgs/prods/femme.png" alt="">
                <p class="p_title">Femme</p>
                <p>Découvrez notre collection de vêtements de sport pour femmes à la pointe de la technologie, conçus avec des tissus innovants pour une performance et un confort optimaux.</p>
            </div>
        </a>
        <a href="list_products?pid=enfant" class="grid">
            <div>
                <img src="imgs/prods/enfant.png" alt="">
                <p class="p_title">Enfant</p>
                <p>Découvrez notre collection dynamique de vêtements de sport pour enfants, fabriqués avec des matériaux durables et confortables pour accompagner leurs jeux actifs.</p>
            </div>
        </a>
        <a href="personnalisation" class="grid">
            <div>
                <img src="imgs/prods/perso.png" alt="">
                <p class="p_title">Personnalisation</p>
                <p>Rejoignez la personnalisation et ajoutez votre propre logo sur certains de nos produits comme vous le souhaitez.</p>
            </div>
        </a>
    </div>
</div>

<style>
    .prods_section {
        width: 100%;
        height: auto;
        padding: 20px;
        padding-bottom: 30px;
        user-select: none;
    }

    .prods_section .title {
        text-align: center;
        margin-bottom: 20px;
    }

    .prods_section .title p {
        color: var(--white);
        font-size: 18px;
        font-family: var(--light);
    }

    .prods_section .title p span {
        font-family: var(--bold);
        color: var(--cyan);
    }

    .prods_section .title h3 {
        color: var(--white);
        font-size: 32px;
        font-family: var(--bold);
    }

    .prods_section .grids {
        margin: auto;
        width: 90%;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .prods_section .grids .grid {
        background-color: var(--light2);
        text-decoration: none;
        transition: all ease .3s;
    }

    .prods_section .grids .grid:hover {
        border-radius: 20px;
        border-top: 3px solid var(--light2);
        transform: scale(1.01);
    }

    .prods_section .grids .grid div img {
        width: 100%;
        transition: all ease .3s;
    }

    .prods_section .grids .grid:hover img {
        border-radius: 20px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .prods_section .grids .grid div {
        width: 100%;
    }

    .prods_section .grids .grid div p {
        padding: 10px 20px;
        text-align: center;
        font-family: var(--light);
        color: var(--dark1);
        font-size: 16px;
    }

    .prods_section .grids .grid div .p_title {
        padding-bottom: 0px;
        font-family: var(--bold);
        font-size: 20px;
    }

    @media screen and (max-width:799px) {
        .prods_section .grids {
            width: 100%;
            grid-template-columns: repeat(1, 1fr);
        }
    }

    @media screen and (min-width:800px) and (max-width:1100px) {
        .prods_section .grids {
            width: 90%;
        }

        .prods_section .grids {
            width: 90%;
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>