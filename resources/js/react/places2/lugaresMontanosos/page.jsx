import React, { useState } from "react";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
import "./lugares.css";

export default function LugaresMontanososPage() {
  const [favoritos, setFavoritos] = useState([]);
  const [popupVisible, setPopupVisible] = useState(false);

  const lugares = [
    {
      id: 1,
      titulo: "Alto Del Nudo",
      ubicacion: "Pereira, Risaralda",
      descripcion: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.",
      imagen: "https://picsum.photos/id/1035/400/300",
      mapa: "https://maps.app.goo.gl/f3w9DC9zRFUMDEzv9",
    },
    {
      id: 2,
      titulo: "Alto Del Toro",
      ubicacion: "Pereira, Risaralda",
      descripcion: "Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.",
      imagen: "https://picsum.photos/id/1036/400/300",
      mapa: "https://maps.app.goo.gl/DyrpMApsB3Mz1hmV6",
    },
    {
      id: 3,
      titulo: "La Divisa De Don Juan",
      ubicacion: "Vía Altagracia, Altagracia, Pereira, Risaralda",
      descripcion: "Cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
      imagen: "https://picsum.photos/id/1037/400/300",
      mapa: "https://maps.app.goo.gl/7seGQZ2LHdAMoNqJ6",
    },
    {
      id: 4,
      titulo: "Cerro Batero",
      ubicacion: "Quinchía, Risaralda",
      descripcion: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.",
      imagen: "https://picsum.photos/id/1038/400/300",
      mapa: "https://maps.app.goo.gl/q6mCEfzAjGfJkuh56",
    },
    {
      id: 5,
      titulo: "Reserva Forestal La Nona",
      ubicacion: "Marsella, Risaralda",
      descripcion: "Veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.",
      imagen: "https://picsum.photos/id/1039/400/300",
      mapa: "https://maps.app.goo.gl/XacC2ScWUKbcgutv8",
    },
    {
      id: 6,
      titulo: "Reserva Natural Cerro Gobia",
      ubicacion: "Quinchía, Risaralda",
      descripcion: "Sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.",
      imagen: "https://picsum.photos/id/1040/400/300",
      mapa: "https://maps.app.goo.gl/8BF3SXF4RTpRbVxeA",
    },
    {
      id: 7,
      titulo: "Kaukitá Bosque Reserva",
      ubicacion: "Pereira, Risaralda",
      descripcion: "Consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.",
      imagen: "https://picsum.photos/id/1041/400/300",
      mapa: "https://maps.app.goo.gl/K3C93FAURYARtAvv6",
    },
    {
      id: 8,
      titulo: "Reserva Natural DMI Agualinda",
      ubicacion: "Apía, Risaralda",
      descripcion: "Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur.",
      imagen: "https://picsum.photos/id/1042/400/300",
      mapa: "https://maps.app.goo.gl/UNc9cTccV6LuGySU7",
    },
  ];

  const toggleFavorito = (lugar) => {
    if (favoritos.some(f => f.id === lugar.id)) {
      setFavoritos(favoritos.filter(f => f.id !== lugar.id));
    } else {
      setFavoritos([...favoritos, lugar]);
    }
  };

  const eliminarFavorito = (id) => {
    setFavoritos(favoritos.filter(f => f.id !== id));
  };

  return (
    <>
      <Header2 />
      <div className="contenedorTodo" style={{ marginTop: "100px" }}>
        <h1>Lugares Montañosos</h1>

        <button 
          className="mostrar-favoritos" 
          onClick={() => setPopupVisible(true)}
        >
          Favoritos (<span>{favoritos.length}</span>)
        </button>

        <div className="contenedor">
          <div className="cards">
            {lugares.map((lugar) => (
              <div className="card" key={lugar.id}>
                <img src={lugar.imagen} alt={lugar.titulo} />
                <h4>{lugar.titulo}</h4>
                <p className="ubicacion-text">{lugar.ubicacion}</p>
                <p className="descripcion">{lugar.descripcion}</p>

                <div className="card-actions">
                  <div className="action-buttons">
                    <a 
                      href={lugar.mapa} 
                      target="_blank" 
                      rel="noreferrer"
                      className="map-button"
                      title="Ver en mapa"
                    >
                      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                      </svg>
                      <span>Mapa</span>
                    </a>
                    <button className="info-button">
                      Más Info
                    </button>
                  </div>
                  <button 
                    className="favorito" 
                    onClick={() => toggleFavorito(lugar)}
                    title={favoritos.some(f => f.id === lugar.id) ? "Quitar de favoritos" : "Agregar a favoritos"}
                  >
                    {favoritos.some(f => f.id === lugar.id) ? "❤️" : "🤍"}
                  </button>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Popup de favoritos */}
        {popupVisible && (
          <div className="popup-overlay" onClick={() => setPopupVisible(false)}>
            <div className="popup-content" onClick={(e) => e.stopPropagation()}>
              <button 
                className="cerrar-popup" 
                onClick={() => setPopupVisible(false)}
              >
                ✕
              </button>
              <h2>Mis Favoritos</h2>
              {favoritos.length === 0 ? (
                <p className="mensaje-vacio">No has agregado ningún lugar aún.</p>
              ) : (
                <ul className="favoritos-list">
                  {favoritos.map(f => (
                    <li key={f.id}>
                      {f.titulo}
                      <button 
                        className="eliminar-favorito" 
                        onClick={() => eliminarFavorito(f.id)}
                      >
                        ❌
                      </button>
                    </li>
                  ))}
                </ul>
              )}
            </div>
          </div>
        )}
      </div>

      <Footer />
    </>
  );
}
