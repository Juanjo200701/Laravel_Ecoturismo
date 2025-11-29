<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reserva - {{ $place->name }}</title>
    <style>
        body { background:#f5f7fb; font-family: 'Montserrat', sans-serif; margin:0; padding:0; }
        .container { max-width:800px; margin:30px auto; padding:0 30px; }
        .card { background:#fff; border-radius:12px; padding:30px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        label { display:block; font-weight:600; margin-top:15px; color:#1c1c1a; }
        input[type="text"], input[type="date"], input[type="time"], input[type="number"], textarea { width:100%; padding:10px 12px; border-radius:10px; border:1px solid #dcdcdc; font-size:0.95rem; box-sizing:border-box; }
        textarea { min-height:90px; resize:vertical; }
        button { background:#24a148; border:none; color:#fff; padding:12px 24px; border-radius:8px; cursor:pointer; font-weight:600; margin-top:20px; }
        button.secondary { background:#6c6c68; }
        .place-info { background:#f9f9f9; padding:20px; border-radius:10px; margin-bottom:20px; }
        .place-info h2 { margin-top:0; }
    </style>
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
    
    <div class="container">
        <div class="card">
            <div class="place-info">
                <h2>{{ $place->name }}</h2>
                @if($place->location)
                    <p style="color:#6c6c68; margin:5px 0;">📍 {{ $place->location }}</p>
                @endif
                @if($place->description)
                    <p style="margin-top:10px;">{{ $place->description }}</p>
                @endif
            </div>

            <h1 style="margin-bottom:20px;">Crear Reserva</h1>

            <form method="POST" action="{{ route('reservations.store') }}">
                @csrf
                <input type="hidden" name="place_id" value="{{ $place->id }}">

                <label>Fecha de visita *</label>
                <input type="date" name="fecha_visita" required min="{{ date('Y-m-d') }}" value="{{ old('fecha_visita') }}">

                <label>Hora de visita</label>
                <input type="time" name="hora_visita" value="{{ old('hora_visita') }}">

                <label>Número de personas *</label>
                <input type="number" name="personas" required min="1" max="50" value="{{ old('personas', 1) }}">

                <label>Teléfono de contacto</label>
                <input type="text" name="telefono_contacto" value="{{ old('telefono_contacto') }}" placeholder="Ej: 3001234567">

                <label>Precio total (COP)</label>
                <input type="number" name="precio_total" min="0" step="0.01" value="{{ old('precio_total') }}" placeholder="Opcional">

                <label>Comentarios adicionales</label>
                <textarea name="comentarios" placeholder="Notas especiales, requerimientos, etc.">{{ old('comentarios') }}</textarea>

                @if($errors->any())
                    <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-top:15px;">
                        <ul style="margin:0; padding-left:20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div style="display:flex; gap:10px; margin-top:20px;">
                    <button type="submit">Confirmar Reserva</button>
                    <a href="{{ route('place.show', $place) }}">
                        <button type="button" class="secondary">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

