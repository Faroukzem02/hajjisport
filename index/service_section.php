<div class="service_section">
    <div class="title">
        <p><span>NF</span> Hajji sports</p>
        <h3>Nos Services</h3>
    </div>
    <div class="grids">
        <a href="services" class="grid">
            <div>
                <img src="imgs/service/school-bus.jpg" alt="">
                <p class="p_title">Transport</p>
                <p>Un bon transport assure ponctualité, confort, sécurité et accessibilité pour tous les enfants.</p>
            </div>
        </a>
        <a href="services" class="grid">
            <div>
                <img src="imgs/service/school-bus.jpg" alt="">
                <p class="p_title">Transport</p>
                <p>Un bon transport assure ponctualité, confort, sécurité et accessibilité pour tous les passagers.</p>
            </div>
        </a>
        <a href="services" class="grid">
            <div>
                <img src="imgs/service/school-bus.jpg" alt="">
                <p class="p_title">Transport</p>
                <p>Un bon transport assure ponctualité, confort, sécurité et accessibilité pour tous les passagers.</p>
            </div>
        </a>
        <a href="services" class="grid">
            <div>
                <img src="imgs/service/school-bus.jpg" alt="">
                <p class="p_title">Transport</p>
                <p>Un bon transport assure ponctualité, confort, sécurité et accessibilité pour tous les passagers.</p>
            </div>
        </a>
    </div>
    <a href="services" class="all_services">Savoir plus</a>
</div>

<style>
    .service_section {
        width: 100%;
        height: auto;
        padding: 20px;
        padding-bottom: 30px;
        user-select: none;
    }

    .service_section .all_services {
        padding: 5px 20px;
        margin: auto;
        font-size: 14px;
        font-family: var(--regular);
        background-color: var(--cyan);
        color: var(--white);
        text-decoration: none;
        transition: all ease .3s;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 140px;
        margin-top: 20px;
    }

    .service_section .all_services:hover {
        background-color: var(--light2);
        color: var(--dark2);
        border-radius: 10px;
    }

    .service_section .title {
        text-align: center;
        margin-bottom: 20px;
    }

    .service_section .title p {
        color: var(--white);
        font-size: 16px;
        font-family: var(--light);
    }

    .service_section .title p span {
        font-family: var(--bold);
        color: var(--cyan);
    }

    .service_section .title h3 {
        color: var(--white);
        font-size: 30px;
        font-family: var(--bold);
    }

    .service_section .grids {
        margin: auto;
        width: 90%;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .service_section .grids .grid {
        background-color: var(--light2);
        text-decoration: none;
        transition: all ease .3s;
    }

    .service_section .grids .grid:hover {
        border-radius: 20px;
        border-top: 3px solid var(--light2);
        transform: scale(1.01);
    }

    .service_section .grids .grid div img {
        width: 100%;
        transition: all ease .3s;
    }

    .service_section .grids .grid:hover img {
        border-radius: 20px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .service_section .grids .grid div {
        width: 100%;
    }

    .service_section .grids .grid div p {
        padding: 10px 20px;
        text-align: center;
        font-family: var(--light);
        color: var(--dark1);
        font-size: 14px;
    }

    .service_section .grids .grid div .p_title {
        padding-bottom: 0px;
        font-family: var(--bold);
        font-size: 18px;
    }

    @media screen and (max-width:799px) {
        .service_section .grids {
            width: 100%;
            grid-template-columns: repeat(1, 1fr);
            margin: auto;
        }
    }

    @media screen and (min-width:800px) and (max-width:1100px) {
        .service_section .grids {
            width: 90%;
            grid-template-columns: repeat(2, 1fr);
            margin: auto;
        }
    }
</style>