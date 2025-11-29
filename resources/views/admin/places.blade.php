<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Lugares - Administración</title>
    <style>
        body { background:#f5f7fb; font-family: 'Montserrat', sans-serif; padding:30px; }
        .container { max-width:1100px; margin:0 auto; background:#fff; border-radius:16px; padding:30px; box-shadow:0 25px 50px rgba(28, 28, 26, 0.12); }
        h1 { margin-bottom:10px; color:#1c1c1a; }
        .subtitle { color:#6c6c68; margin-bottom:30px; }
        .status { background:#d4edda; color:#155724; border-radius:8px; padding:12px 16px; margin-bottom:20px; }
        .grid { display:grid; grid-template-columns:1fr 1fr; gap:30px; }
        .card { border:1px solid #ececec; border-radius:14px; padding:20px; background:#fafafa; }
        label { display:block; font-weight:600; margin-top:12px; color:#1c1c1a; }
        input[type="text"], textarea { width:100%; padding:10px 12px; border-radius:10px; border:1px solid #dcdcdc; font-size:0.95rem; }
        textarea { min-height:90px; resize:vertical; }
        button { background:#24a148; border:none; color:#fff; padding:10px 18px; border-radius:8px; cursor:pointer; font-weight:600; margin-top:15px; }
        table { width:100%; border-collapse:collapse; margin-top:30px; }
        th, td { border-bottom:1px solid #e9e9e9; padding:12px 10px; text-align:left; }
        th { color:#6f6f6a; font-weight:600; }
        .actions { display:flex; gap:10px; flex-wrap:wrap; }
        .actions button { margin-top:0; }
        .actions form { display:inline; }
        .secondary { background:#004d40; }
        .danger { background:#d7263d; }
        @media (max-width:900px) {
            .grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
            <div>
                <h1>Gestión de Lugares</h1>
                <p class="subtitle">Hola {{ auth()->check() ? auth()->user()->name : 'Usuario' }}, administra los lugares disponibles en la plataforma.</p>
            </div>
            <a href="{{ route('pagcentral') }}" style="color:#24a148; font-weight:600;">← Volver</a>
        </div>

        @if(session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if(isset($error))
            <div style="background:#f8d7da; color:#721c24; border-radius:8px; padding:12px 16px; margin-bottom:20px;">
                <strong>Error:</strong> {{ $error }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#f8d7da; color:#721c24; border-radius:8px; padding:12px 16px; margin-bottom:20px;">
                <strong>Errores:</strong>
                <ul style="margin:5px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid">
            <div class="card">
                <h2>Crear nuevo lugar</h2>
                <form method="POST" action="{{ route('admin.places.store') }}">
                    @csrf
                    <label>Nombre</label>
                    <input type="text" name="name" required value="{{ old('name') }}">

                    <label>Descripción</label>
                    <textarea name="description">{{ old('description') }}</textarea>

                    <label>Ubicación</label>
                    <input type="text" name="location" value="{{ old('location') }}">

                    <label>URL de imagen</label>
                    <input type="text" name="image" value="{{ old('image') }}">

                    <button type="submit">Guardar lugar</button>
                </form>
            </div>

            <div class="card" style="background:#1b1b18; color:#fff;">
                <h2>Consejos rápidos</h2>
                <ul style="line-height:1.6; padding-left:18px;">
                    <li>Los campos de nombre y descripción son visibles para los usuarios.</li>
                    <li>Usa URL absolutas para las imágenes (ej: https://.../imagen.jpg).</li>
                    <li>Recuerda que estos cambios afectan inmediatamente la API pública.</li>
                    <li>Solo usuarios con rol administrador pueden acceder a esta herramienta.</li>
                </ul>
            </div>
        </div>

        <h2 style="margin-top:40px;">Listado de lugares</h2>
        <table>
            <thead>
                <tr>
                    <th>Detalle</th>
                    <th style="width:260px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($places as $place)
                    <tr>
                        <td>
                            <form id="form-update-{{ $place->id }}" method="POST" action="{{ route('admin.places.update', $place) }}">
                                @csrf
                                @method('PUT')
                                <label>Nombre</label>
                                <input type="text" name="name" value="{{ $place->name }}" required>

                                <label>Descripción</label>
                                <textarea name="description">{{ $place->description }}</textarea>

                                <label>Ubicación</label>
                                <input type="text" name="location" value="{{ $place->location }}">

                                <label>Imagen</label>
                                <input type="text" name="image" value="{{ $place->image }}">

                                <small>Última actualización: {{ $place->updated_at ? $place->updated_at->format('d/m/Y H:i') : 'N/A' }}</small>
                            </form>
                        </td>
                        <td class="actions">
                            <button form="form-update-{{ $place->id }}" type="submit" class="secondary">Actualizar</button>
                            <form method="POST" action="{{ route('admin.places.destroy', $place) }}" onsubmit="return confirm('¿Eliminar este lugar?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Aún no hay lugares cargados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

