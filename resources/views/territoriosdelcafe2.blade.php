<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Territorios Del Café</title>
    <link rel="stylesheet" href="public/css/lugares.css">
    <link rel="icon" href="imagenes/iconoecoturismo.jpg">
</head>
<body>
    <div class="contenedorTodo">
        <h1>Territorios Del Café</h1>
        <button id="mostrar-favoritos" class="mostrar-favoritos">
            Favoritos (<span id="contador-favoritos">0</span>)
        </button>

        <div class="contenedor">
            <div class="cards">
                <div class="card">
                    <img src="imagenes/divisa.jpeg" alt="La Divisa De Don Juan">
                    <h4>La Divisa De Don Juan</h4>
                    <p>Vía Altagracia, Altagracia, Pereira, Risaralda</p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/7seGQZ2LHdAMoNqJ6">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="divisadonjuan2.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="La Divisa De Don Juan">🤍</button>
                </div>

                <div class="card">
                    <img src="imagenes/tambo.jpg" alt="Tambo El Privilegio">
                    <h4>Tambo El Privilegio</h4>
                    <p>Santa Rosa De Cabal (Risaralda)
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/Szaz4EXNWszusTK1A">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="tamboelprivilegio.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Tambo El Privilegio">🤍</button>
                </div>

                <div class="card">
                    <img src="imagenes/cafedeleo.webp" alt="Café De Leo">
                    <h4>Café De Leo</h4>
                    <p>Santa Rosa De Cabal (Risaralda) 
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/DYrSFfubNimqcEq66">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="cafedeleo.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Café De Leo">🤍</button>
                </div>
                <div class="card">
                    <img src="imagenes/horizonte.jpg" alt="Café Hacienda Horizonte">
                    <h4>Café Hacienda Horizontes</h4>
                    <p>Marsella (Risaralda)
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/PwCPzmVGcZBazvzk8">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="cafehaciendahorizonte.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Café Hacienda Horizontes">🤍</button>
                </div>
                <div class="card">
                    <img src="imagenes/cafemanolo.jpg" alt="Finca Cafetera La Comadreja">
                    <h4>Café Don Manolo</h4>
                    <p>Vereda El Estanquillo-Dosquebradas (Risaralda)</p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/LiKcYnjD1R685KZP8">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="cafedonmanolo.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Finca Cafetera La Comadreja">🤍</button>
                </div>

                <div class="card">
                    <img src="imagenes/mirador.jpg" alt="Mirador de Altagracia">
                    <h4>Mirador de Altagracia</h4>
                    <p>Altagracia-Pereira (Risaralda)
                    </p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/2CTLPe4HKjRYJ3HN8">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="miradoraltagracia.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Mirador de Altagracia">🤍</button>
                </div>

                <div class="card">
                    <img src="imagenes/canceles.jpg" alt="Cerro Canceles">
                    <h4>Cerro Canceles</h4>
                    <p>Las Brisas-Pereira (Risaralda).</p>
                    <button class="ubication-button">
                        <a href="https://maps.app.goo.gl/WSnBnJCREhjKZwL78">
                            <img src="imagenes/mapa2.svg" style="width: 24px; height: 24px;" alt="">
                        </a>
                    </button>
                    <a href="cerrocanceles.html">
                        <button class="ubicacion ubicacionn">Más Info</button>
                    </a>
                    <button class="favorito" data-lugar="Cerro Canceles">🤍</button>
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
            <button class="volver">
                Volver
            </button>
        </a>
</div>

    <footer>© 2025 Risaralda EcoTurismo</footer>
    <script src="js/lugares.js"></script>
    <script src="js/favoritos.js"></script>
</body>
</html>