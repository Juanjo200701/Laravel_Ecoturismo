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

        <!-- Sección de Reseñas y Comentarios -->
        <section style="margin:40px 0; padding:30px; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="margin-top:0; color:#1c1c1a;">Reseñas y Comentarios</h2>
            
            @if($averageRating > 0)
                <div style="margin-bottom:20px; padding:15px; background:#f9f9f9; border-radius:8px;">
                    <div style="display:flex; align-items:center; gap:15px;">
                        <div>
                            <div style="font-size:2em; font-weight:bold; color:#24a148;">{{ number_format($averageRating, 1) }}</div>
                            <div style="color:#6c6c68; font-size:0.9em;">{{ $reviews->count() }} {{ $reviews->count() == 1 ? 'reseña' : 'reseñas' }}</div>
                        </div>
                        <div style="font-size:1.5em; color:#ffc107;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($averageRating))
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            @endif

            @auth
                @if(!$userReview)
                    <div style="margin-bottom:30px; padding:20px; background:#f9f9f9; border-radius:10px;">
                        <h3 style="margin-top:0;">Deja tu reseña</h3>
                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf
                            <input type="hidden" name="place_id" value="{{ $place->id }}">
                            
                            <label style="display:block; margin-top:15px; font-weight:600;">Calificación *</label>
                            <div style="display:flex; gap:5px; margin:10px 0;">
                                @for($i = 5; $i >= 1; $i--)
                                    <label style="cursor:pointer; font-size:2em; color:#ddd;">
                                        <input type="radio" name="rating" value="{{ $i }}" required style="display:none;" onchange="updateStars(this)">
                                        <span class="star" data-rating="{{ $i }}">☆</span>
                                    </label>
                                @endfor
                            </div>
                            
                            <label style="display:block; margin-top:15px; font-weight:600;">Comentario</label>
                            <textarea name="comment" rows="4" style="width:100%; padding:10px; border-radius:8px; border:1px solid #dcdcdc; margin-top:5px;" placeholder="Escribe tu experiencia..."></textarea>
                            
                            @if($errors->has('review'))
                                <div style="color:#d7263d; margin-top:10px;">{{ $errors->first('review') }}</div>
                            @endif
                            
                            <button type="submit" style="background:#24a148; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer; font-weight:600; margin-top:15px;">Publicar Reseña</button>
                        </form>
                    </div>
                @else
                    <div style="margin-bottom:20px; padding:15px; background:#e8f5e9; border-radius:8px;">
                        <p style="margin:0; color:#155724;">✓ Ya has dejado una reseña para este lugar.</p>
                        <form method="POST" action="{{ route('reviews.destroy', $userReview) }}" style="margin-top:10px;" onsubmit="return confirm('¿Eliminar tu reseña?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:#d7263d; color:#fff; border:none; padding:5px 15px; border-radius:5px; cursor:pointer; font-size:0.9em;">Eliminar mi reseña</button>
                        </form>
                    </div>
                @endif
            @else
                <div style="margin-bottom:20px; padding:15px; background:#fff3cd; border-radius:8px; text-align:center;">
                    <p style="margin:0;"><a href="{{ route('login') }}" style="color:#24a148; font-weight:600;">Inicia sesión</a> para dejar una reseña.</p>
                </div>
            @endauth

            @if(session('status'))
                <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:20px;">
                    {{ session('status') }}
                </div>
            @endif

            <div style="margin-top:30px;">
                <h3 style="margin-bottom:20px;">Todas las reseñas ({{ $reviews->count() }})</h3>
                @if($reviews->count() > 0)
                    @foreach($reviews as $review)
                        <div style="padding:20px; border-bottom:1px solid #ececec; margin-bottom:15px;">
                            <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:10px;">
                                <div>
                                    <strong style="color:#1c1c1a;">{{ $review->usuario->name }}</strong>
                                    <div style="color:#ffc107; font-size:1.2em; margin:5px 0;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <span style="color:#6c6c68; font-size:0.9em;">{{ $review->fecha_comentario->format('d/m/Y') }}</span>
                            </div>
                            @if($review->comment)
                                <p style="color:#1c1c1a; margin:10px 0;">{{ $review->comment }}</p>
                            @endif
                            @auth
                                @if($review->user_id == auth()->id())
                                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" style="margin-top:10px;" onsubmit="return confirm('¿Eliminar tu reseña?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:#d7263d; color:#fff; border:none; padding:5px 15px; border-radius:5px; cursor:pointer; font-size:0.9em;">Eliminar</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                @else
                    <p style="text-align:center; padding:40px; color:#6c6c68;">Aún no hay reseñas para este lugar. ¡Sé el primero en comentar!</p>
                @endif
            </div>
        </section>

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
        
        // Actualizar estrellas al seleccionar rating
        function updateStars(radio) {
            const rating = parseInt(radio.value);
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, index) => {
                const starRating = parseInt(star.getAttribute('data-rating'));
                if (starRating <= rating) {
                    star.textContent = '★';
                    star.style.color = '#ffc107';
                } else {
                    star.textContent = '☆';
                    star.style.color = '#ddd';
                }
            });
        }
        
        // Hover en estrellas
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('mouseenter', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                const stars = document.querySelectorAll('.star');
                stars.forEach((s, index) => {
                    const sRating = parseInt(s.getAttribute('data-rating'));
                    if (sRating <= rating) {
                        s.style.color = '#ffc107';
                    }
                });
            });
            
            star.addEventListener('mouseleave', function() {
                const selected = document.querySelector('input[name="rating"]:checked');
                if (selected) {
                    updateStars(selected);
                } else {
                    document.querySelectorAll('.star').forEach(s => {
                        s.textContent = '☆';
                        s.style.color = '#ddd';
                    });
                }
            });
            
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                document.querySelector(`input[value="${rating}"]`).checked = true;
                updateStars(document.querySelector(`input[value="${rating}"]`));
            });
        });
    </script>
    @endauth
</body>
</html>

