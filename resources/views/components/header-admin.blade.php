<nav class="navbar-admin" style="background:#1c1c1a; padding:15px 30px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
    <div style="display:flex; align-items:center; gap:20px;">
        <a href="{{ route('pagcentral') }}" style="color:#24a148; font-weight:bold; font-size:1.2em; text-decoration:none;">🌿 EcoTurismo</a>
        <a href="{{ route('admin.dashboard') }}" style="color:#fff; text-decoration:none; padding:8px 15px; border-radius:5px; transition:background 0.3s;" onmouseover="this.style.background='#2a2a28'" onmouseout="this.style.background='transparent'">Dashboard</a>
        <a href="{{ route('admin.places.index') }}" style="color:#fff; text-decoration:none; padding:8px 15px; border-radius:5px; transition:background 0.3s;" onmouseover="this.style.background='#2a2a28'" onmouseout="this.style.background='transparent'">Lugares</a>
        <a href="{{ route('admin.reservations.index') }}" style="color:#fff; text-decoration:none; padding:8px 15px; border-radius:5px; transition:background 0.3s;" onmouseover="this.style.background='#2a2a28'" onmouseout="this.style.background='transparent'">Reservas</a>
        <a href="{{ route('admin.categories.index') }}" style="color:#fff; text-decoration:none; padding:8px 15px; border-radius:5px; transition:background 0.3s;" onmouseover="this.style.background='#2a2a28'" onmouseout="this.style.background='transparent'">Categorías</a>
    </div>
    <div style="display:flex; align-items:center; gap:15px;">
        <span style="color:#fff; font-weight:600;">👤 {{ auth()->user()->name }}</span>
        <span style="color:#24a148; background:#0d3d1f; padding:5px 10px; border-radius:12px; font-size:0.85em;">ADMIN</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline; margin:0;">
            @csrf
            <button type="submit" style="background:#d7263d; color:#fff; border:none; padding:8px 15px; border-radius:5px; cursor:pointer; font-weight:600;">Cerrar Sesión</button>
        </form>
    </div>
</nav>

