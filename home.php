<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroFund</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif; 
            color: white;
        }
        .hidden {
            opacity: 0;
            transform: translateY(50px);
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="px-3 py-2 text-white">
    <nav class="flex items-center justify-between flex-wrap bg-green-600 p-6 fixed w-full z-10">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="landing_page.php" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="dark" stroke="currentColor" 
                stroke-linecap="round" stroke-linejoin="round" stroke-width="3" aria-hidden="false" class="me-2" viewBox="0 0 640 512">
                  <path d="M272.2 64.6l-51.1 51.1c-15.3 4.2-29.5 11.9-41.5 22.5L153 161.9C142.8 171 129.5 176 115.8 176H96V304c20.4 .6 
                  39.8 8.9 54.3 23.4l35.6 35.6 7 7 0 0L219.9 397c6.2 6.2 16.4 6.2 22.6 0c1.7-1.7 3-3.7 3.7-5.8c2.8-7.7 9.3-13.5 17.3-15.3s16.4 .6 
                  22.2 6.5L296.5 393c11.6 11.6 30.4 11.6 41.9 0c5.4-5.4 8.3-12.3 8.6-19.4c.4-8.8 5.6-16.6 13.6-20.4s17.3-3 24.4 2.1c9.4 6.7 22.5 5.8 
                  30.9-2.6c9.4-9.4 9.4-24.6 0-33.9L340.1 243l- 35.8 33c-27.3 25.2-69.2 25.6-97 .9c-31.7-28.2-32.4-77.4-1.6-106.5l70.1-66.2C303.2 78.4 
                  339.4 64 377.1 64c36.1 0 71 13.3 97.9 37.2L505. 1 128H544h40 40c8.8 0 16 7.2 16 16V352c0 17.7-14.3 32-32 32H576c -11.8 0-22.2-6.4-27.7-16H463.4c-3.4 6.7-7.9 13.1-13.5 18.7c-17.1 17.1-40.8 23.8-63 20.1c-3.6 7.3-8.5 14.1-14.6 20.2c-27.3 27.3-70 30-100.4 8.1c-25.1 20.8-62.5
                   19.5-86-4.1L159 404l-7-7-35.6-35.6c-5.5-5.5-12.7-8.7-20.4-9.3C96 369.7 81.6 384 64 384H32c-17.7 0-32-14.3-32-32V144c0-8.8 7.2-16 16-16H56 
                   96h19.8c2 0 3.9-.7 5.3-2l26.5-23.6C175.5 77.7 211.4 64 248.7 64H259c4.4 0 8.9 .2 13.2 .6zM544 320V176H496c-5.9 0-11.6-2.2-15.9-6.1l-36.9-32.
                   8c-18.2-16.2-41.7-25.1-66.1-25.1c-25.4 0-49.8 9.7-68.3 27.1l-70.1 66.2c-10.3 9.8-10.1 26.3 .5 35.7c9.3 8.3 23.4 8.1 32.5-.3l71.9-66.4c9.7-9 
                   24.9-8.4 33.9 1.4s8.4 24.9-1.4 33.9l-.8 .8 74.4 74.4c10 10 16.5 22.3 19.4 35.1H544zM64 336a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm528 16a16 16
                    0 1 0 0-32 16 16 0 1 0 0 32z"/></svg>
                  <strong class="text-warning">AgroFund</strong>
            </a>
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-white border-white hover:text-green-600 hover:border-green-600">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0v-2zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="https://yourdomain.com/project.php" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-green-200 mr-4" onclick="checkAuth('project.php')">Acceuil</a>
                <a href="https://yourdomain.com/signup.php" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-green-200 mr-4" onclick="checkAuth('signup.php')">Se connecter</a>
                <a href="https://yourdomain.com/login.php" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-green-200" onclick="checkAuth('login.php')">Créer un compte</a>
            </div>
        </div>
    </nav>
</div>

<script>
    const isAuthenticated = true; // Replace with actual authentication check
    const userRole = 'Investisseur'; // Replace with actual user role

    function checkAuth(redirectUrl) {
        if (isAuthenticated) {
            window.location.href = redirectUrl;
        } else {
            window.location.href = 'login.php';
        }
    }

    window.onload = function() {
        if (isAuthenticated) {
            switch (userRole) {
                case 'admin':
                    window.location.href = 'admin_dashboard.php';
                    break;
                case 'investisseur':
                    window.location.href = 'process_project.php';
                    break;
                case 'Agriculteur':
                    window.location.href = 'project.php';
                    break;
                default:
                    window.location.href = 'landing_page.php';
            }
        } else {
            window.location.href = 'login.php';
        }
    };
</script>

<div class="flex flex-col gap-8 pt-10 items-center">
    <div class="text-center text-white mt-32" id="title" style="
        background-size: cover;
        background-size: auto;
        background-position: center;
        background-image: url('rice-field-7890204_1920.jpg');">
        <h1 class="text-6xl font-bold text-black text-green-600">AgroFund</h1>
        <p class="mt-2 text-lg text-white-700" id="subtitle">Plateforme de financement participatif pour l'agriculture durable</p>
        <div class="m-4 flex flex-col sm:flex-row justify-center gap-4">
            <a class="rounded-full bg-green-600 text-white py-2 px-4 transition-colors hover:bg-white-700" href="#" onclick="checkAuth('project.php')">Démarrer un projet</a>
            <a class="rounded-full bg-green-600 text-white border border-green-600 py-2 px-4 transition-colors hover:bg-white-700 hover:text-white" href="#" onclick="checkAuth('process_project.php')">Investir</a>
        </div>

        <div class="flex text-white-700 justify-center mt-12 space-x-8" id="stats">
            <div class="text-center hidden">
                <p class="text-3xl font-bold">200 K+</p>
                <p class="mt-2">Financements réalisés</p>
            </div>
            <div class="text-center hidden">
                <p class="text-3xl font-bold">150+</p>
                <p class="mt-2">Projets financés</p>
            </div>
            <div class="text-center hidden">
                <p class="text-3xl font-bold">5000+</p>
                <p class="mt-2">Investisseurs actifs</p>
            </div>
        </div>
    </div>

    <div class="mt-32 flex flex-col sm:flex-row justify-center items-center space-x-0 sm:space-x-8">
        <img src="Free_Vector_Workplace_culture_abstract_concept_vector_illustration.jpg" alt="beastar" class="w-full sm:w-1/2 rounded-lg shadow-lg mb-4 sm:mb-0">
        <div class="max-w-md">
            <p class="text-4xl text-white mb-10 text-center">Pourquoi investir chez nous?</p>
            <p class="text-white">Lorem ipsum veredis tuisdu reaufd dufdjdbf qbdhbdhslj dhqsq yqosd sffs fbdhfb dfhsdh sdhbsd hdhfiu fiuze fiue ezhzue zyfjmksd sdyfssbdhm idjsou hudhufhu udhduhf huehuehg ufhuher uuehuhg feuhjkdj hudhe uehuehoe urehoro ehgerg gerhue erhepie pgzerp io ierhgr rhegheg ehgehg hzehfzh ohgohgh rhoehgdzp.</p>
        </div>
    </div>

    <div class="mt-32">
        <p class="text-4xl mb-10 text-white text-center">Comment ça fonctionne</p>
        <div class="flex flex-wrap justify-center space-x-0 sm:space-x-8">
            <div class="bg-green-500 p-6 rounded-lg text-center text-white w-64 hidden mb-4 sm:mb-0 card">
                <i class="fas fa-seedling text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Créez votre projet</h3>
                <p class="mt-2">Présentez votre projet agricole et définissez vos besoins de financement</p>
            </div>
            <div class="bg-green-500 p-6 rounded-lg text-center text-white w-64 hidden mb-4 sm:mb-0 card">
                <i class="fas fa-check-circle text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Validation experte</h3>
                <p class="mt-2">Notre équipe vérifie et valide votre projet selon des critères stricts</p>
            </div>
            <div class="bg-green-500 p-6 rounded-lg text-center text-white w-64 hidden mb-4 sm:mb-0 card">
                <i class="fas fa-hand-holding-usd text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Collecte de fonds</h3>
                <p class="mt-2">Les investisseurs soutiennent votre projet en toute transparence</p>
            </div>
            <div class="bg-green-500 p-6 rounded-lg text-center text-white w-64 hidden mb-4 sm:mb-0 card">
                <i class="fas fa-chart-line text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Suivi du projet</h3>
                <p class="mt-2">Partagez l'avancement et les résultats avec vos investisseurs</p>
            </div>
        </div>
    </div>

    <div class="bg-green-600 py-12 mt-56 px-10 text-center text-white">
        <h2 class="text-2xl font-bold">Prêt à développer l'agriculture durable ?</h2>
        <p class="mt-2">Rejoignez notre communauté d'agriculteurs et d'investisseurs engagés</p>
        <button class="bg-white text-green-600 py-2 px-4 rounded-full mt-4 transition-colors hover:bg-green-200">Commencer maintenant !</button>
    </div>

    <div class="mt-32 w-full flex justify-center">
        <div class="max-w-4xl">
            <h2 class="text-4xl text-white text-center mb-6">Regardez notre vidéo pour plus d'informations</h2>
            <div class="video-container">
                <iframe class="rounded-lg shadow-lg" src="invideo-ai-1080_AgroFund_Revolutionner_le_financement_a_2025-03-08.mp4" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    anime({
        targets: '#title',
        opacity: [0, 1],
        translateY: [-50, 0],
        scale: [0.8, 1],
        duration: 700,
        easing: 'easeInOutQuad'
    });

    anime({
        targets: '#subtitle',
        opacity: [0, 1],
        translateY: [-30, 0],
        duration: 700,
        easing: 'easeInOutQuad',
        delay: 100
    });

    const stats = document.querySelectorAll('#stats > div');
    const functions = document.querySelectorAll('.bg-green-500');
    let hasAnimated = false; // Flag to track if animation has occurred
    let lastScrollTop = 0; // Variable to track last scroll position

    const animateOnScroll = () => {
        const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScrollTop < lastScrollTop && !hasAnimated) { // Check if scrolling up
            const windowHeight = window.innerHeight;
            stats.forEach(stat => {
                const rect = stat.getBoundingClientRect();
                if (rect.top < windowHeight) {
                    stat.classList.remove('hidden');
                    anime({
                        targets: stat,
                        opacity: [0, 1],
                        translateY: [20, 0],
                        duration: 700,
                        easing: 'easeInOutQuad'
                    });
                }
            });

            functions.forEach((func, index) => {
                const rect = func.getBoundingClientRect();
                if (rect.top < windowHeight) {
                    func.classList.remove('hidden');
                    anime({
                        targets: func,
                        opacity: [0, 1],
                        translateY: [20, 0],
                        duration: 700,
                        easing: 'easeInOutQuad',
                        delay: index * 100 // Staggered delay for each card
                    });
                }
            });

            hasAnimated = true; // Set flag to true after animation
        }
        lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop; // For Mobile or negative scrolling
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Initial check in case elements are already in view
</script>
</body>
</html>