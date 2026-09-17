<div class="slider">
    <div class="slider_section">
        <div class="slids_container">
            <a href="https://www.beneventocalcio.club/">
                <div class="slide1"></div>
            </a>
            <a href="https://www.csvnapoli.it/">
                <div class="slide2"></div>
            </a>
            <a href="https://www.caravaggiosv.com/">
                <div class="slide3"></div>
            </a>
        </div>
        <button class="arrow-left" onclick="prev()">&#10094;</button>
        <button class="arrow-right" onclick="next()">&#10095;</button>
    </div>
    <div class="vid_section">
        <div class="video">
            <video muted autoplay loop>
                <source src="imgs/slider_vid.mp4" type="video/mp4">
            </video>
        </div>
    </div>
</div>
<script>
    let currentIndex = 0;

    function showSlide(i) {
        let slides = document.querySelector(".slids_container");
        const totalSlides = slides.children.length;

        currentIndex = (i + totalSlides) % totalSlides;
        const translateX = -currentIndex * 100;
        slides.style.transform = `translateX(${translateX}%)`;
    }

    function next() {
        showSlide(currentIndex + 1);
    }

    function prev() {
        showSlide(currentIndex - 1);
    }

    setInterval(next, 5000);
</script>
<style>
    .slider {
        width: 100%;
        overflow: hidden;
        user-select: none;
    }

    .slider .vid_section {
        margin-top: 20px;
    }

    .slider .video {
        width: 100%;
        height: 550px;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .slider .video video {
        width: 100%;
    }

    .slider_section {
        height: 100vh;
        width: 100%;
        position: relative;
    }

    .slider_section .slids_container {
        display: flex;
        width: 100%;
        transition: transform 0.5s ease-in-out;
    }

    .slider_section .slids_container a {
        width: 100%;
        height: 100vh;
        display: flex;
        flex: 0 0 100%;
        transition: all ease .3s;
        justify-content: center;
    }

    .slider_section .slids_container a:hover {
        opacity: 0.8;
    }

    .slider_section .slids_container a div {
        height: 100vh;
        width: 100%;
        display: flex;
        text-align: center;
    }

    .slider_section .slids_container .slide1 {
        background: url(imgs/slider/bene.png) center/cover no-repeat
    }

    .slider_section .slids_container .slide2 {
        background: url(imgs/slider/csv1.png) center/cover no-repeat
    }

    .slider_section .slids_container .slide3 {
        background: url(imgs/slider/cara.png) center/cover no-repeat
    }

    .slider_section .slids_container .slide .content {
        position: relative;
        top: 85px;
        left: 10px;
    }

    .slider_section .slids_container .slide .content a {
        padding: 8px 22px;
        background-color: #D80073;
        text-decoration: none;
        color: var(--white);
        font-family: var(--regular);
        transition: all ease 0.3s;
        font-size: 16px;
    }

    .slider_section .slids_container .slide .content a:hover {
        background-color: #0d3145;
    }

    .slider .slider_section button {
        position: absolute;
        top: 45%;
        left: 4%;
        transition: ease all 0.3s;
        padding: 5px 20px;
        font-size: 50px;
        cursor: pointer;
        font-family: var(--regular);
        border: none;
        background-color: transparent;
        color: var(--white);
    }

    .slider .slider_section button:hover {
        color: var(--cyan);
    }

    .slider .slider_section .arrow-right {
        left: 91%;
    }

    @media screen and (max-width:799px) {
        .slider_section .slids_container .slide1 {
            background: url(imgs/slider/bene-mobile.png) center/cover no-repeat
        }

        .slider_section .slids_container .slide2 {
            background: url(imgs/slider/csv1-mobile.png) center/cover no-repeat
        }

        .slider_section .slids_container .slide3 {
            background: url(imgs/slider/cara-mobile.png) center/cover no-repeat
        }
    }

    @media screen and (max-width:799px) {
        .slider .slider_section .arrow-right {
            left: 80%;
        }

        .slider_section .slids_container .slide .content p {
            font-size: 22px;
        }

        .slider .video {
            height: 250px;
        }
    }

    @media screen and (min-width:800px) and (max-width:1100px) {
        .slider .slider_section .arrow-right {
            left: 87%;
        }
    }
</style>