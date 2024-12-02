<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixelByte - Portfolio</title>
    <link rel="stylesheet" href="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: grey;
            color: #fff;
            min-height: 100vh;
        }

        /* Navegación */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .nav-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: #3b82f6;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #3b82f6;
        }

        /* Contenido Principal */
        .main-content {
            padding-top: 5rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 1rem 2rem;
        }

        .profile-container {
            display: flex;
            align-items: center;
            gap: 4rem;
        }

        .profile-image {
            position: relative;
            width: 256px;
            height: 256px;
            flex-shrink: 0;
        }

        .profile-image::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #9333ea;
            border-radius: 50%;
            opacity: 0.5;
        }

        .profile-image img {
            position: relative;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .content-section {
            max-width: 600px;
        }

        .title {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .highlight {
            color: #3b82f6;
        }

        .typewriter-container {
            height: 3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .typewriter-static {
            font-size: 1.875rem;
            white-space: nowrap;
        }

        .typewriter {
            font-size: 1.875rem;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
            display: inline-block;
        }

        .typewriter::after {
            content: '';
            position: absolute;
            right: -4px;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #3b82f6;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        .description {
            color: #9ca3af;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .social-icons {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .social-icons a {
            color: #3b82f6;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #2563eb;
        }

        .cta-button {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: white;
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .nav-links.active {
                display: flex;
            }

            .profile-container {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .content-section {
                align-items: center;
                display: flex;
                flex-direction: column;
            }

            .title {
                font-size: 2rem;
                text-align: center;
            }

            .typewriter-container {
                justify-content: center;
                height: 4rem;
            }

            .typewriter, .typewriter-static {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <a href="#" class="logo">PixelByte</a>
            <button class="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="nav-links">
                <li><a href="#home">HOGAR</a></li>
                <li><a href="#servicios">SERVICIOS</a></li>
                <li><a href="#habilidades">HABILIDADES</a></li>
                <li><a href="#educacion">EDUCACIÓN</a></li>
                <li><a href="#experiencia">EXPERIENCIA</a></li>
                <li><a href="#contacto">CONTACTO</a></li>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="profile-container">
            <div class="profile-image">
                <img src="../images/pixelbyte_logo.jpeg" alt="Profile picture">
            </div>
            <div class="content-section">
                <h1 class="title">Hola, esto es <span class="highlight">PIXELBYTE</span></h1>
                <div class="typewriter-container">
                    <h2 class="typewriter-static">Somos</h2>
                    <h2 class="typewriter highlight" id="changing-text"></h2>
                </div>
                <p class="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus labore dolores esse. 
                    Odit similique doloribus tenetur doloremque, sunt commodi in ipsa repudiandae 
                    debitis deleniti blanditiis quibusdam quaerat neque asperiores ea.
                </p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
                <button class="cta-button">Más sobre nosotros</button>
            </div>
        </div>
    </main>

    <script>
        // Manejo del menú responsivo
        const navToggle = document.querySelector('.nav-toggle');
        const navLinks = document.querySelector('.nav-links');
        const navbar = document.querySelector('.navbar');

        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Efecto de scroll en el navbar
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Texto cambiante con efecto typewriter
        const texts = [
            "desarrolladores frontend",
            "diseñadores web",
            "expertos en React",
            "desarrolladores JavaScript",
            "diseñadores UI/UX",
            "desarrolladores full stack",
            "especialistas en CSS",
            "creadores de experiencias web"
        ];

        const changingText = document.getElementById('changing-text');
        let currentIndex = 0;

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function typeWriter(text) {
            for (let i = 0; i <= text.length; i++) {
                changingText.textContent = text.substring(0, i);
                await sleep(50); // Velocidad de escritura
            }
        }

        async function eraseText() {
            const text = changingText.textContent;
            for (let i = text.length; i >= 0; i--) {
                changingText.textContent = text.substring(0, i);
                await sleep(30); // Velocidad de borrado
            }
        }

        async function updateText() {
            while (true) {
                await typeWriter(texts[currentIndex]);
                await sleep(2000); // Tiempo que permanece el texto completo
                await eraseText();
                currentIndex = (currentIndex + 1) % texts.length;
                await sleep(500); // Pausa entre palabras
            }
        }

        // Iniciar la animación
        updateText();

        // Cerrar menú móvil al hacer click en un enlace
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
    </script>
</body>
</html>