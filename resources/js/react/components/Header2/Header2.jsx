import React, { useState, useRef, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "../../context/AuthContext";
import icono from "../imagenes/iconoecoturismo.jpg";
import "./Header2.css";

const Header2 = () => {
  const { user, logout, isAdmin } = useAuth();
  const navigate = useNavigate();
  const [openMenu, setOpenMenu] = useState(false);
  const dropdownRef = useRef(null);

  const toggleMenu = () => {
    setOpenMenu((prev) => !prev);
  };

  // Cierra el menú si se hace clic fuera
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setOpenMenu(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  // Cierra el menú al hacer clic en un enlace
  const handleLinkClick = () => {
    setOpenMenu(false);
  };

  const handleLogout = async () => {
    await logout();
    navigate("/", { replace: true });
  };

  return (
    <header>
      <div className="header-container">
        <Link to="/pagLogueados" className="logo-principal">
          <img src={icono} alt="Logo" width="60" />
          <div className="titulos">
            <h2 className="risaralda">RisaraldaEcoTurismo</h2>
          </div>
        </Link>

        <nav className="navbar">
          <Link to="/comentarios2" className="nav-link">Reseñas</Link>

          {/* Menú desplegable de Lugares */}
          <div className="dropdown" ref={dropdownRef}>
            <button
              className="dropdown-btn"
              onClick={toggleMenu}
              aria-expanded={openMenu}
              aria-haspopup="true"
            >
              Lugares <span className="arrow">{openMenu ? "▲" : "▼"}</span>
            </button>

            {openMenu && (
              <ul className="dropdown-menu" role="menu">
                <li>
                  <Link 
                    to="/paraisosAcuaticos" 
                    role="menuitem"
                    onClick={handleLinkClick}
                  >
                    <span className="icono">🏖️</span> Lugares Acuáticos
                  </Link>
                </li>
                <li>
                  <Link 
                    to="/lugaresMontanosos" 
                    role="menuitem"
                    onClick={handleLinkClick}
                  >
                    <span className="icono">⛰️</span> Lugares Montañosos
                  </Link>
                </li>
                <li>
                  <Link 
                    to="/parquesYMas" 
                    role="menuitem"
                    onClick={handleLinkClick}
                  >
                    <span className="icono">🏞️</span> Parques y Más
                  </Link>
                </li>
              </ul>
            )}
          </div>

          <Link to="/contacto" className="nav-link">Contacto</Link>
          <Link to="/perfil" className="nav-link">👤 {user?.name || "Perfil"}</Link>
          <button onClick={handleLogout} className="nav-link" style={{ background: 'none', border: 'none', cursor: 'pointer', color: 'inherit' }}>
            Cerrar Sesión
          </button>
        </nav>
      </div>
    </header>
  );
};

export default Header2;