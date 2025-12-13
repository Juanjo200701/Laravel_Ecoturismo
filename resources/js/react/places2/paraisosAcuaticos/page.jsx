import React, { useState } from "react";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
import "./lugares.css";

export default function ParaisosAcuaticosPage() {
  const [favoritos, setFavoritos] = useState([]);
  const [popupVisible, setPopupVisible] = useState(false);
  
  const lugares = [
    {
      id: 1,
      nombre: "Lago De La Pradera",
      ubicacion: "La Pradera - Dosquebradas, Risaralda",
      descripcion: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.",
      imagen: "https://picsum.photos/id/1001/400/300",
      mapa: "https://maps.app.goo.gl/M6RgB1GUYqJwGdGfA",
    },
    {
      id: 2,
      nombre: "La Laguna Del Otún",
      ubicacion: "Pereira, Santa Rosa, Risaralda",
      descripcion: "Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
      imagen: "https://picsum.photos/id/1002/400/300",
      mapa: "https://maps.app.goo.gl/ndHDFrHHQYfNt8n19",
    },
    {
      id: 3,
      nombre: "Chorros De Don Lolo",
      ubicacion: "Santa Rosa, Risaralda",
      descripcion: "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error.",
      imagen: "https://picsum.photos/id/1003/400/300",
      mapa: "https://maps.app.goo.gl/iraGYyGvchLDCFaj8",
    },
    {
      id: 4,
      nombre: "Termales de Santa Rosa",
      ubicacion: "Santa Rosa, Risaralda",
      descripcion: "Sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt.",
      imagen: "https://picsum.photos/id/1004/400/300",
      mapa: "https://maps.app.goo.gl/zTkAVYrmFBmFvJCv7",
    },
    {
      id: 5,
      nombre: "Parque Acuático Consota",
      ubicacion: "Pereira - Cerritos, Risaralda",
      descripcion: "Explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.",
      imagen: "https://picsum.photos/id/1005/400/300",
      mapa: "https://maps.app.goo.gl/Xe4dhpqnBSzML98b8",
    },
    {
      id: 6,
      nombre: "Balneario Los Farallones",
      ubicacion: "La Virginia, Risaralda",
      descripcion: "Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.",
      imagen: "https://picsum.photos/id/1006/400/300",
      mapa: "https://maps.app.goo.gl/XbZoEF6SsNpzKCL88",
    },
    {
      id: 7,
      nombre: "Cascada Los Frailes",
      ubicacion: "La Florida - Pereira, Risaralda",
      descripcion: "Et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi.",
      imagen: "https://picsum.photos/id/1007/400/300",
      mapa: "https://maps.app.goo.gl/PhcdF9sCzFxKAx3p7",
    },
    {
      id: 8,
      nombre: "Río San José",
      ubicacion: "Cordillera Central - Pereira, Risaralda",
      descripcion: "Consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas.",
      imagen: "https://picsum.photos/id/1008/400/300",
      mapa: "https://maps.app.goo.gl/LmncErfzPCRCvGvUA",
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
        <h1>Lugares Acuáticos</h1>

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
                <img src={lugar.imagen} alt={lugar.nombre} />
                <h4>{lugar.nombre}</h4>
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
                      {f.nombre}
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
