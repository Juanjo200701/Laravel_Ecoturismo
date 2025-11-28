<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parque Regional Natural Cuchilla de San Juan - Información Detallada</title>
    <link rel="stylesheet" href="{{ asset('public/css/detallelugar.css') }}">
    <link rel="icon" href="imagenes/iconoecoturismo.jpg">
</head>
<body>
    <div class="contenedor-detalle">
        <header class="header-lugar">
            <h1>Parque Regional Natural Cuchilla de San Juan</h1>
            <p class="subtitulo">Belén de Umbría, Risaralda</p>
        </header>

        <div class="galeria">
            <img src="{{ asset('imagenes/cuchilla.jpg') }}" alt="Cuchilla de San Juan" class="imagen-principal">
            <div class="miniaturas">
                <img src="{{ asset('imagenes/cuchillasanjuan2.webp') }}" alt="Paisaje montañoso" class="miniatura">
                <img src="{{ asset('imagenes/cuchillasanjuan3.avif') }}" alt="Senderos" class="miniatura">
                <img src="{{ asset('imagenes/cuchillasanjuan4.webp') }}" alt="Vista panorámica" class="miniatura">
            </div>
        </div>

        <section class="informacion">
            <div class="descripcion">
                <h2>Descripción</h2>
                <p>El Parque Regional Natural Cuchilla de San Juan es un área protegida que alberga una rica biodiversidad y ecosistemas únicos. Ofrece impresionantes vistas panorámicas, senderos para caminatas ecológicas y es hogar de numerosas especies de flora y fauna nativas.</p>
            </div>

            <div class="caracteristicas">
                <h2>Características</h2>
                <ul>
                    <li>🏔️ Paisaje montañoso</li>
                    <li>🌿 Biodiversidad única</li>
                    <li>🦜 Avistamiento de aves</li>
                    <li>🚶‍♂️ Senderos ecológicos</li>
                    <li>🌳 Bosque nativo</li>
                    <li>📸 Miradores panorámicos</li>
                    <li>💧 Fuentes hídricas</li>
                </ul>
            </div>

            <div class="horarios-precios">
                <h2>Horarios y Precios</h2>
                <div class="tabla-info">
                    <div class="fila">
                        <span class="etiqueta">Horario:</span>
                        <span class="valor">6:00 AM - 5:00 PM</span>
                    </div>
                    <div class="fila">
                        <span class="etiqueta">Días:</span>
                        <span class="valor">Todos los días (con permiso previo)</span>
                    </div>
                    <div class="fila">
                        <span class="etiqueta">Nota importante:</span>
                        <span class="valor">Se requiere guía certificado</span>
                    </div>
                </div>
            </div>

            <div class="aviso-importante">
                <h2>Aviso Importante</h2>
                <p>Por ser un área protegida, no hay servicios de restaurante dentro del parque ni en sus inmediaciones. Se recomienda llevar provisiones y agua suficiente para la visita.</p>
            </div>

            <div class="alojamientos">
                <h2>Alojamientos cercanos</h2>
                <div class="info">
                    <ol>
                        <li>
                            <strong>Hotel Belén Plaza</strong>
                            <ul>
                                <li><strong>Ubicación: </strong>Centro de Belén de Umbría</li>
                                <li>Habitaciones cómodas</li>
                                <li>Servicio personalizado</li>
                            </ul>
                        </li>
                        <br>
                        <li>
                            <strong>Finca Hotel La Cuchilla</strong>
                            <ul>
                                <li><strong>Ubicación: </strong>Afueras de Belén de Umbría</li>
                                <li>Entorno natural</li>
                                <li>Ideal para senderismo</li>
                            </ul>
                        </li>
                        <br>
                        <li>
                            <strong>Hostal El Mirador</strong>
                            <ul>
                                <li><strong>Ubicación: </strong>Mistrató</li>
                                <li>Vistas panorámicas</li>
                                <li>Experiencia acogedora</li>
                            </ul>
                        </li>
                        <br>
                        <li>
                            <strong>Eco Hotel Monteverde</strong>
                            <ul>
                                <li><strong>Ubicación: </strong>Apía</li>
                                <li>Alojamientos ecológicos</li>
                                <li>Servicios de guías disponibles</li>
                            </ul>
                        </li>
                        <br>
                        <li>
                            <strong>Hotel Campestre Pueblo Rico</strong>
                            <ul>
                                <li><strong>Ubicación: </strong>Pueblo Rico</li>
                                <li>Precios accesibles</li>
                                <li>Habitaciones cómodas</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="recomendaciones">
                <h2>Recomendaciones</h2>
                <ul>
                    <li>🎒 Llevar suficiente agua y alimentos</li>
                    <li>🧥 Ropa adecuada para clima variable</li>
                    <li>📝 Tramitar permisos con anticipación</li>
                    <li>🦺 Contratar guía certificado</li>
                    <li>📱 Llevar equipo de comunicación</li>
                </ul>
            </div>

            <div class="ubicacion">
                <h2>Cómo Llegar</h2>
                <div class="mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.497173435605!2d-75.88955852650408!3d5.184233637279229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4799dde3d3fb59%3A0xa77ba3c6f3213fe!2sCuchilla%20del%20San%20Juan!5e0!3m2!1ses!2sco!4v1745078820440!5m2!1ses!2sco" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
            </div>
        </section>

        <div class="botones">
            <a href="{{ route('lugaresmontañosos2') }}" class="boton-volver">Volver a Lugares</a>
            <button class="boton-favorito" data-lugar="Parque Regional Natural Cuchilla de San Juan">🤍</button>
        </div>
    </div>
    <script src="{{ asset('js/favoritos.js') }}"></script>
</body>
</html>