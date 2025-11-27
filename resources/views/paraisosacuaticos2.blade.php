<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paraísos Acuáticos</title>
    <link rel="stylesheet" href="css/lugares.css">
    <link rel="icon" href="imagenes/iconoecoturismo.jpg">
</head>
<body>
    <div class="contenedorTodo">
        <h1>Paraísos Acuáticos</h1>
        <button id="mostrar-favoritos" class="mostrar-favoritos">
            Favoritos (<span id="contador-favoritos">0</span>)
        </button>

        <!-- Contenedor principal de tarjetas -->
        <div class="contenedor">
            <div class="cards">
                <!-- Tarjeta 1 -->
                <div class="card">
                    <img src="imagenes/Lago.jpeg" alt="Lago de La Pradera">
                    <h4>Lago De La Pradera</h4>
                    <!-- <p>El Lago de La Pradera es un lago artificial en Dosquebradas, Colombia, que se ha convertido en un popular espacio de recreación y esparcimiento.</p> -->
                     <p>La Pradera - Dosquebradas, Risaralda.</p>
                    <!-- <a class="ubication" href="https://maps.app.goo.gl/M6RgB1GUYqJwGdGfA">🗺️</a> -->
                    <button class="ubication-button"><a href="https://maps.app.goo.gl/M6RgB1GUYqJwGdGfA">

                        <img src="./imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="Ubicación"></button>
                    </a>
                    <a href="lagolapradera.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Lago De La Pradera">🤍</button>
                </div>

                <!-- Tarjeta 2 -->
                <div class="card">
                    <img src="imagenes/laguna.jpg" alt="Laguna del Otún">
                    <h4>La Laguna Del Otún</h4>
                    <p>Pereira, Santa Rosa, Risaralda.</p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/ndHDFrHHQYfNt8n19">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="lagunadelotun.html">
                        <button class="ubicacion">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="La Laguna Del Otún">🤍</button>
                </div>

                <!-- Tarjeta 3 -->
                <div class="card">
                    <img src="imagenes/lolo.jpg" alt="Chorros de Don Lolo">
                    <h4>Chorros De Don Lolo</h4>
                    <p>Santa Rosa, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/iraGYyGvchLDCFaj8">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="chorrosdonlolo.html">
                        <button class="ubicacion">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Chorros De Don Lolo">🤍</button>
                </div>

                <!-- Tarjeta 4 -->
                <div class="card">
                    <img src="imagenes/termaales.jpg" alt="Termales de Santa Rosa">
                    <h4>Termales de Santa Rosa</h4>
                    <!-- <p>Los Termales Santa Rosa de Cabal son un destino turístico en Risaralda, Colombia, famoso por sus aguas termales naturales. El complejo está formado por el Termales Hotel y el Termales Balneario.</p> -->
                    <p>Santa Rosa, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/zTkAVYrmFBmFvJCv7">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;"alt="">
                        </a>
                    </button>
                    <a href="termalessantarosa.html">
                        <button class="ubicacion">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Termales de Santa Rosa">🤍</button>
                </div>

                <!-- Tarjeta 5 -->
                <div class="card">
                    <img src="imagenes/parquecafe.jpg" alt="Parque Metropolitano del Café">
                    <h4>Parque Metropolitano del Café</h4>
                    <p>Av Sur-Pereira, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/2ZBVKPdNQmpVnmDq9">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="parquedelcafe.html">
                        <button class="ubicacion">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Parque Metropolitano del Café">🤍</button>
                </div>

                <!-- Tarjeta 6 -->
                <div class="card">
                    <img src="imagenes/consota.jpg" alt="Parque Acuático Consota">
                    <h4>Parque Acuático Consota</h4>
                    <p>Pereira-Cerritos, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/Xe4dhpqnBSzML98b8">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="consota.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Parque Acuático Consota">🤍</button>
                </div>

                <!-- Tarjeta 7 -->
                <div class="card">
                    <img src="imagenes/farallones.jpeg" alt="Balneario Los Farallones">
                    <h4>Balneario Los Farallones</h4>
                    <p>La Virginia, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/XbZoEF6SsNpzKCL88">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="farallones.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Balneario Los Farallones">🤍</button>
                </div>
                <div class="card">
                    <img src="imagenes/frailes2.webp" alt="Cascada Los Frailes">
                    <h4>Cascada Los Frailes</h4>
                    <p>La Florida-Pereira, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/PhcdF9sCzFxKAx3p7">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="cascadalosfrailes.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Cascada Los Frailes">🤍</button>
                </div>
                <div class="card">
                    <img src="imagenes/sanjose.webp" alt="Río San José">
                    <h4>Rio San Jose</h4>
                    <p>Cordillera Central-Pereira, Risaralda
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/LmncErfzPCRCvGvUA">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="riosanjose.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Rio San José">🤍</button>
                </div>
                <div class="card">
                    <img src="imagenes/piedras.jpg" alt="Piedras Marcadas Dosquebradas">
                    <h4>Piedras Marcadas Dosquebradas</h4>
                    <p>Alto Del Toro-Dosquebradas, Risaralda</p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/Ttq1WxYgq8LE9nit7">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="piedrasmarcadas.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Piedras Marcadas Dosquebradas">🤍</button>
                </div>
            </div>
        </div>

        <!-- Contenedor de favoritos -->
        <div id="popup-favoritos" class="popup hidden">
            <div class="popup-content">
                <button id="cerrar-popup" class="cerrar-popup">X</button>
                <h2>Mis Favoritos</h2>
                <ul id="favoritos-list"></ul>
                <p id="mensaje-vacio" class="hidden">No has agregado ningún lugar aún.</p>
            </div>
        </div>

        <!-- Botón de volver -->
        <a href="pagcentral2.html">
            <button class="volver">Volver</button>
        </a>
    </div>

    <footer>© 2025 Risaralda EcoTurismo</footer>
    <script src="js/lugares.js"></script>
    <script src="js/favoritos.js"></script>
</body>
</html>