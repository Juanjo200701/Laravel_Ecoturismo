<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pagcentral2.css') }}">
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
<link rel="icon" href="{{ asset('imagenes/iconoecoturismo.jpg') }}">
    <title>Risarlda Ecoturismo</title>
</head>
<body id="body">
    <!-- <div id="cookies" class="cookies-container">
        <div class="cookies-contenido">
            <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al continuar navegando, aceptas el uso de cookies.</p>
            <button id="aceptar">Aceptar</button>
            <button id="rechazar">Rechazar</button>
        </div>
    </div>  -->
    <div id="popup" class="popup hidden">
        <div class="popup-content">
            <h2>¿Cómo deseas continuar?</h2>
            <p>Por favor, selecciona una opción para continuar navegando:</p>
            <button id="registro"> <a href="{{ route('registro') }}">Registrarse</a></button>
            <button id="logiin"> <a href="{{ route('login') }}">Iniciar Sesión</a></button>
            <button id="guest">Continuar como Invitado</button>
        </div>
    </div>
    <header>
        <div class="header-container">
            <div class="logo-principal">
                <img src="{{ asset('imagenes/iconoecoturismo.jpg') }}" width="70px" alt="">
                <h2 class="risaralda">RisaraldaEcoTurismo</h2></div>
                
                <nav class="navbar">
                    <a class="catalogo" href="{{ route('comentarios2') }}" id="catalogo-link">Reseñas</a>
                    <a id="contacto" class="contacto" href="{{ route('contacto') }}">Contacto</a>
                    <a href="{{ route('lugares') }}" id="lugares-link">Lugares</a>
                    <a id="login" href="#pregunta">Login</a>
                    <div id="pregunta" class="pregunta eo">
                        <div id="pregunta-contenido">
                            <h2>¿Ya ingresaste a tu perfil?</h2>
                            <button id="si">Si</button>
                            <button id="no">No</button>
                        </div>
                    </div>
                    <!-- <div class="menu-desplegable" id="menu-desplegable">
                        <a href="{{ route('paraisosacuaticos') }}">🤽 Paraísos Acuáticos</a>
                        <a href="{{ route('lugaresmontañosos') }}">⛰️ Parques y Más...</a>
                        <a href="{{ route('territoriosdelcafe') }}">🍵 Territorios del café</a>
                    </div> -->
            </div>
            <div class="titulos">
                <!-- <a href="{{ route('login') }}">Login</a> -->
            </nav>
        </div>
    </header>
    <!-- <aside class="barralateral" id="barralateral">
    <div class="contenedorHotel">
        <div class="titulo"><h2>Hoteles cercanos y sus tarifas</h2>
        <p> 
             <div class="uno">
                <div class="subtitulo1"><h3>~ Ukumari</h3></div>
                <div class="hotel1"><h4><a href="https://maps.app.goo.gl/Sf8fEj6Z3DQ1bd4x9?g_st=iw">• Sonesta Hotel Pereira COP 460.000</a></h4></div>
                <div class="hotel2"><h4><a href="https://maps.app.goo.gl/uhSSYyiWvMVePijS8?g_st=iw">• Hostal San Jorge COP 180.000</a></h4></div>
                <div class="hotel3"><h4><a href="https://maps.app.goo.gl/4DvB9ixeB356b3ZU8?g_st=iw">• Villa Juana Hotel COP 216.000</a></h4></div>
            </div>
            <br>
            <div class="dos">
        <div class="subtitulo2"><h3>~ Parque Consota</h3></div>
                <div class="hotel4"><h4><a href="https://maps.app.goo.gl/zusmrqNKuK383mPR6?g_st=iw">•Visus Hotel Boutique & Spa COP 885.709</a></h4></div>
                <div class="hotel5"><h4><a href="https://maps.app.goo.gl/Sf8fEj6Z3DQ1bd4x9?g_st=iw">• Sonesta Hotel Pereira COP 460.000</a></h4></div>
                <div class="hotel6"><h4><a href="https://maps.app.goo.gl/CekKJTfge2o4npT76?g_st=iw">•Sazagua Hotel Boutique Pereira COP 473.869</a></h4></div>
            </div>
            <br>
            <div class="tres">
                <div class="subtitulo3"><h3>~ Termales de Santa Rosa de Cabal</h3></div>
                <div class="hotel7"><h4><a href="https://maps.app.goo.gl/PvpiMosSD1vNAbuKA?g_st=iw">• Termales de Santa Rosa de Cabal Hotel COP 509.800</a></h4></div>
                <div class="hotel8"><h4><a href="https://maps.app.goo.gl/W9F5LBAawEVXa1HH9?g_st=iw">• Hotel Termales San Vicente COP 514.793</a></h4></div>
            </div>
        </p>
        </div>
    </div>
    </aside> -->
    <main id="contenido">
        <div class="slider-container">
            <div class="intro-text">
                <h1>Bienvenidos a RisaraldaEcoTurismo</h1>
                <p>Encuentre en un solo lugar información detallada sobre los atractivos ecoturísticos de Risaralda, clasificados por temática y con recursos útiles para planificar su visita.

                </p>
            </div>
            <div class="slider">
                <div class="slide slide1">
                    <img src="{{ asset('imagenes/slideone.jpg') }}" alt="imagen 1">    
                </div>
    
                <div class="slide slide2">
                    <img src="{{ asset('imagenes/slidetwo.jpg') }}" alt="imagen 1">   
                </div>
    
                <div class="slide slide3">
                    <img src="{{ asset('imagenes/nudo4.jpg') }}" alt="imagen 1">
                </div>
            </div>
        </div>
        <!-- <div class="contenedorcards">
            <div class="card card1"><a href="https://shorturl.at/Stst2">
                <img src="{{ asset('imagenes/ukumari1.jpg') }}" alt="">
            </a>
            <p><p id="bold">El Bioparque Ukumarí</p>Es una reserva natural dedicada a la preservación de la biodiversidad a través de acciones ecológicas, sociales y económicamente sostenibles.</p>
            </div>
            <div class="card card2">
                <a href="https://maps.app.goo.gl/MY6KYoyXn5yU2bNW9?g_st=iw">
                    <img src="{{ asset('imagenes/consota.jpg') }}" alt="">
                </a>
                <p id="bold">El Parque Consotá <p></p>Es un parque de recreación y esparcimiento familiar. Cuenta con piscinas, senderos, escenarios deportivos, una granja, y espacios para eventos.</p>
            </div>
            <div class="card card3">
                <a href="https://maps.app.goo.gl/PvpiMosSD1vNAbuKA?g_st=iw">
                    <img src="{{ asset('imagenes/termales.jpg') }}" alt="">
                </a>
                <p id="bold">Los Termales de Santa Rosa de Cabal</p><p>Son una serie de piscinas de agua caliente ubicadas a 10 km de Santa Rosa de Cabal, en Risaralda, Colombia.</p>
            </div>
            <div class="card card4">
                <a href="">
                    <img src="{{ asset('imagenes/laguna.jpg') }}" alt="">
                </a>
                <p><p id="bold">La laguna del otún</p>La Laguna del Otún es un embalse natural en el Parque Nacional Natural Los Nevados, en Colombia. Es un atractivo turístico y un humedal Ramsar que se alimenta del deshielo del nevado Santa Isabel.</p>
            </div>
        </div> -->
    </div>
</main>
<footer>
    <p>© 2025 RisaraldaEcoTurismo</p>
    <br>
    <a href="{{ route('cookies') }}">Cookies  </a>
    |
    <a href="{{ route('terminosdeuso') }}">Términos de uso  </a>
    |
    <a href="{{ route('politicas') }}">Políticas de privacidad</a>
</footer>
<script text="text/javascript"  src="{{ asset('js/pagcentral.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/login.js') }}"></script> -->
</body>
</html>