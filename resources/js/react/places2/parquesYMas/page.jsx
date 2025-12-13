import React, { useState } from "react";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
import "./lugares.css";

export default function ParquesYMasPage() {
  const [favoritos, setFavoritos] = useState([]);
  const [popupVisible, setPopupVisible] = useState(false);

  const lugares = [
    {
      id: 1,
      titulo: "Parque Nacional Natural Tatamá",
      ubicacion: "Pueblo Rico, Risaralda",
      descripcion: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
      imagen: "https://picsum.photos/id/1015/400/300",
      mapa: "https://maps.app.goo.gl/hPSphPUBmXGBqeGJ6",
    },
    {
      id: 2,
      titulo: "Parque Las Araucarias",
      ubicacion: "Santa Rosa de Cabal, Risaralda",
      descripcion: "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
      imagen: "https://picsum.photos/id/1018/400/300",
      mapa: "https://maps.app.goo.gl/SDZUo3UZpzU3YWq28",
    },
    {
      id: 3,
      titulo: "Parque Regional Natural Cuchilla de San Juan",
      ubicacion: "Belén de Umbría, Risaralda",
      descripcion: "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
      imagen: "https://picsum.photos/id/1020/400/300",
      mapa: "https://maps.app.goo.gl/2uWtBq8BNCCHuCft9",
    },
    {
      id: 4,
      titulo: "Parque Natural Regional Santa Emilia",
      ubicacion: "Belén de Umbría, Risaralda",
      descripcion: "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
      imagen: "https://picsum.photos/id/1021/400/300",
      mapa: "https://maps.app.goo.gl/5G6AXY18b8hAwdfW6",
    },
    {
      id: 5,
      titulo: "Jardín Botánico UTP",
      ubicacion: "Pereira, Risaralda",
      descripcion: "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.",
      imagen: "https://picsum.photos/id/1022/400/300",
      mapa: "https://maps.app.goo.gl/hhkmfB9owU9PcB6Z7",
    },
    {
      id: 6,
      titulo: "Jardín Botánico De Marsella",
      ubicacion: "Marsella, Risaralda",
      descripcion: "Totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.",
      imagen: "https://picsum.photos/id/1023/400/300",
      mapa: "https://maps.app.goo.gl/L2ysAcHE6EvuNq3U7",
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
        <h1>Parques y Más</h1>

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

        <Footer />
      </div>
    </>
  );
}

