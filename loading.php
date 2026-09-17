<div id="loading-screen">
    <div class="loader"></div>
</div>

<style>
    /* Full-screen loader */
    #loading-screen {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgb(255, 255, 255,0.2);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Loader animation */
    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #168ecf;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script>
    // Wait for the entire page to load
    window.onload = function() {
        // Hide the loading screen
        var loadingScreen = document.getElementById('loading-screen');
        loadingScreen.style.display = 'none';
    };
</script>