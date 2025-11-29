<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares - Risaralda EcoTurismo</title>
    <link rel="stylesheet" href="{{ asset('css/lugares.css') }}">
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
<div class="contenedorTodo">
    <h1>Lugares de Risaralda</h1>

    @if($places->count() > 0)
        @php
            $chunks = $places->chunk(3);
        @endphp

        @foreach($chunks as $index => $chunk)
            <div class="contenedor{{ $index > 0 ? $index + 1 : '' }}">
                <div class="cards">
                    @foreach($chunk as $place)
                        <div class="card">
                            @if($place->image)
                                <img src="{{ $place->image }}" alt="{{ $place->name }}" onerror="this.src='{{ asset('imagenes/iconoecoturismo.jpg') }}'">
                            @else
                                <img src="{{ asset('imagenes/iconoecoturismo.jpg') }}" alt="{{ $place->name }}">
                            @endif
                            <h4>{{ $place->name }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit($place->description ?? 'Sin descripción disponible', 150) }}</p>
                            @if($place->location)
                                <p style="font-size: 0.9em; color: #666; margin-top: 5px;">
                                    📍 {{ $place->location }}
                                </p>
                            @endif
                            <a href="{{ route('place.show', $place) }}">
                                <button class="ubicacion ubicacionn" style="margin-top: 10px;">Más Info</button>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('pagcentral') }}">
                <button class="volver">Volver</button>
            </a>
        </div>
    @else
        <div style="text-align: center; padding: 40px;">
            <p style="font-size: 1.2em; color: #666;">Aún no hay lugares disponibles.</p>
            <a href="{{ route('pagcentral') }}">
                <button class="volver">Volver</button>
            </a>
        </div>
    @endif
<div class="final-message">
    @auth
        <p>Gracias por iniciar sesión, {{ auth()->user()->name }}. Estamos preparando más destinos exclusivos para ti.</p>
    @else
        <p>Si quieres ver más lugares → <a href="{{ route('login') }}">Inicia Sesión </a></p>
    @endauth
</div>
</div>
<footer>© 2025 Risaralda EcoTurismo</footer>
</body>
</html>