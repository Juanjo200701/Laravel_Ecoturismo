import React from "react";
import { Link } from "react-router-dom";
import "./page.css";

// Importar imágenes desde la carpeta components/imagenes
import divisa2 from "@/react/components/imagenes/divisa2.jpg";
import lago from "@/react/components/imagenes/lago.jpeg";
import laguna from "@/react/components/imagenes/laguna.jpg";
import nudo from "@/react/components/imagenes/nudo.jpg";
import toro from "@/react/components/imagenes/toro.jpg";
import lolo from "@/react/components/imagenes/lolo.jpg";
import tambo from "@/react/components/imagenes/tambo.jpg";
import leo from "@/react/components/imagenes/leo.jpg";
import jardin from "@/react/components/imagenes/jardin.jpeg";

const PlacesPage = () => {
  return (
    <div className="contenedorTodo">
      <h1>Algunos lugares...</h1>

      <div className="contenedor">
        <div className="cards">
          <div className="card">
            <img src={divisa2} alt="La divisa de Don Juan" />
            <h4>La divisa de Don Juan</h4>
            <p>
              La Divisa de Don Juan es una finca cafetera familiar en Pereira,
              Colombia, que ofrece tours guiados. La finca es un importante
              productor de café y un área de conservación de la biodiversidad.
            </p>
          </div>

          <div className="card">
            <img src={lago} alt="Lago De La Pradera" />
            <h4>Lago De La Pradera</h4>
            <p>
              El Lago de La Pradera es un lago artificial en Dosquebradas,
              Colombia, que se ha convertido en un popular espacio de recreación
              y esparcimiento.
            </p>
          </div>

          <div className="card">
            <img src={laguna} alt="La Laguna Del Otún" />
            <h4>La Laguna Del Otún</h4>
            <p>
              La Laguna del Otún es un embalse natural en el Parque Nacional
              Natural Los Nevados, en Colombia. Es un atractivo turístico y un
              humedal Ramsar que se alimenta del deshielo del nevado Santa
              Isabel.
            </p>
          </div>
        </div>
      </div>

      <div className="contenedor2">
        <div className="cards">
          <div className="card">
            <img src={nudo} alt="Alto Del Nudo" />
            <h4>Alto Del Nudo</h4>
            <p>
              El Alto del Nudo es una reserva natural regional en la Serranía El
              Nudo, en el departamento de Risaralda, Colombia. Es un lugar de
              gran biodiversidad, con senderos ecológicos y miradores.
            </p>
          </div>

          <div className="card">
            <img src={toro} alt="Alto Del Toro" />
            <h4>Alto Del Toro</h4>
            <p>
              El Alto del Toro es una vereda en Dosquebradas, Risaralda,
              Colombia. También hay una ruta de ciclismo y senderismo que lleva
              a este lugar.
            </p>
          </div>

          <div className="card">
            <img src={lolo} alt="Chorros De Don Lolo" />
            <h4>Chorros De Don Lolo</h4>
            <p>
              Los Chorros de Don Lolo son una cascada de 40 metros de altura en
              Santa Rosa de Cabal, Risaralda, Colombia. Se encuentran en un
              bosque húmedo secundario y son un destino popular para los amantes
              de la naturaleza.
            </p>
          </div>
        </div>
      </div>

      <div className="contenedor3">
        <div className="cards">
          <div className="card">
            <img src={tambo} alt="Tambo El Privilegio" />
            <h4>Tambo El Privilegio</h4>
            <p>
              El Tambo El Privilegio es un mirador y punto de parada en la
              autopista que va de Pereira a Manizales, en el departamento de
              Risaralda. Es un lugar para disfrutar de la vista, tomar café, y
              descansar.
            </p>
          </div>

          <div className="card">
            <img src={leo} alt="Café De Leo" />
            <h4>Café De Leo</h4>
            <p>
              El Café de Leo es un lugar en Santa Rosa de Cabal, Colombia, que
              ofrece café de la región, gastronomía local y bebidas a base de
              café especial. Algunos lo describen como un lugar único, bonito y
              con una excelente atención.
            </p>
          </div>

          <div className="card">
            <img src={jardin} alt="Jardín Botánico" />
            <h4>Jardín Botánico</h4>
            <p>
              El Jardín Botánico de la Universidad Tecnológica de Pereira (UTP)
              es un lugar para observar aves, conocer la flora y la fauna, y
              aprender sobre el medio ambiente. Está ubicado en el campus
              universitario, a pocos minutos del centro de Pereira.
            </p>
          </div>
        </div>

        {/* Enlace al botón Volver: usar Link para navegación interna */}
        <Link to="/">
          <button className="volver2">Volver </button>
        </Link>
      </div>

      <div className="final-message">
        <p>
          Si quieres ver más lugares → <a href="login.html">Inicia Sesión</a>
        </p>
      </div>

      <footer>© 2025 Risaralda EcoTurismo</footer>
    </div>
  );
};

export default PlacesPage;