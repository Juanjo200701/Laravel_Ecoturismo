<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $place->name }} - Risaralda EcoTurismo</title>
    <link rel="stylesheet" href="{{ asset('css/detallelugar.css') }}">
    <link rel="icon" href="{{ asset('imagenes/iconoecoturismo.jpg') }}">
</head>
<body>
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

        <div class="botones">
            <a href="{{ route('lugares') }}" class="boton-volver">Volver a Lugares</a>
        </div>
    </div>
</body>
</html>

