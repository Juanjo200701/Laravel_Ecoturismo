<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $place->name }} - Risaralda EcoTurismo</title>
    <link rel="stylesheet" href="{{ asset('css/detallelugar.css') }}">
    <link rel="icon" href="{{ asset('imagenes/iconoecoturismo.jpg') }}">
</head>
<body>
    @auth
        @if(auth()->user()->is_admin)
            @include('components.header-admin')
        @else
            @include('components.header-user')
        @endif
    @else
        @include('components.header-guest')
    @endauth
    <div class="contenedor-detalle">
        <header class="header-lugar">
            <h1>{{ $place->name }}</h1>
            @if($place->location)
                <p class="subtitulo">{{ $place->location }}</p>
            @endif
        </header>

        <div class="galeria">
            @if($place->image)
                <img src="{{ $place->image }}" alt="{{ $place->name }}" class="imagen-principal" onerror="this.src='{{ asset('imagenes/iconoecoturismo.jpg') }}'">
            @else
                <img src="{{ asset('imagenes/iconoecoturismo.jpg') }}" alt="{{ $place->name }}" class="imagen-principal">
            @endif
        </div>

        <section class="informacion">
            @if($place->description)
                <div class="descripcion">
                    <h2>Descripción</h2>
                    <p>{{ $place->description }}</p>
                </div>
            @endif

            @if($place->location)
                <div class="ubicacion">
                    <h2>Ubicación</h2>
                    <p>{{ $place->location }}</p>
                </div>
            @endif
        </section>

        @auth
            <div style="margin:30px 0; padding:20px; background:#f9f9f9; border-radius:10px;">
                <h3>Acciones</h3>
                <div style="display:flex; gap:15px; flex-wrap:wrap; margin-top:15px;">
                    <a href="{{ route('reservations.create', $place) }}" style="background:#24a148; color:#fff; padding:12px 24px; border-radius:8px; text-decoration:none; font-weight:600;">Reservar Ahora</a>
                    <button id="btn-favorite" style="background:#ffc107; color:#1c1c1a; padding:12px 24px; border-radius:8px; border:none; cursor:pointer; font-weight:600;">⭐ Agregar a Favoritos</button>
                </div>
            </div>
        @else
            <div style="margin:30px 0; padding:20px; background:#fff3cd; border-radius:10px; text-align:center;">
                <p style="margin:0 0 15px 0;">¿Te gusta este lugar? <a href="{{ route('login') }}" style="color:#24a148; font-weight:600;">Inicia sesión</a> para reservar o agregarlo a favoritos.</p>
            </div>
        @endauth

        <div class="botones">
            <a href="{{ route('lugares') }}" class="boton-volver">Volver a Lugares</a>
        </div>
    </div>
    @auth
    <form id="favorite-form" method="POST" action="{{ route('favorites.store') }}" style="display:none;">
        @csrf
        <input type="hidden" name="place_id" value="{{ $place->id }}">
    </form>
    <script>
        document.getElementById('btn-favorite').addEventListener('click', function() {
            document.getElementById('favorite-form').submit();
        });
    </script>
    @endauth
</body>
</html>

