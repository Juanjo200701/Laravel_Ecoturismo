import "./contacto.css";

export default function contact() {
  return (
    <div className="container">
      <div className="form">

        {/* ------- COLUMNA IZQUIERDA ------- */}
        <div className="contact-info">
          <h3 className="tittle">Pongámonos en contacto</h3>
          <p className="text">
            Escríbenos y te buscamos la mejor opción para tu página
          </p>

          <div className="info">

            <div className="information">
              <img src="src/assets/maps-and-location.png" className="icon" alt="" />
              <p>Dosquebradas-Pereira</p>
            </div>

            <div className="information">
              <img src="src/assets/correo-electronico.png" className="icon" alt="" />
              <a href="mailto:proyectoecoturismo2@gmail.com">
                <p>proyectoecoturismo2@gmail.com</p>
              </a>
            </div>

            <div className="information">
              <img src="src/assets/telefono.png" className="icon" alt="" />
              <a href="tel:3134152020">
                <p>3134152020</p>
              </a>
            </div>

            <div className="information copyright">
              <p>© 2025 RisaraldaEcoTurismo</p>
            </div>

          </div>

          {/* Redes sociales */}
          <div className="social-media">
            <p>Conéctate con nosotros:</p>
            <div className="social-icon">
              <a href="https://www.facebook.com">
                <img src="src/assets/iconofb.png" width="30px" alt="" />
              </a>

              <a href="https://www.whatsapp.com">
                <img src="src/assets/iconowp.png" width="30px" alt="" />
              </a>

              <a href="https://www.instagram.com">
                <img src="src/assets/iconoig.png" width="30px" alt="" />
              </a>

              <button id="volver">
                <a href="pagcentral.html">Volver</a>
              </button>
            </div>
          </div>
        </div>

        {/* ------- COLUMNA DERECHA ------- */}
        <div className="contact-form">

          <form action="contactosbienhecho.html">
            <h3 className="tittle">Contáctanos</h3>

            <div className="input-container focus">
              <input type="text" name="name" className="input" />
              <label>Nombre de usuario</label>
              <span>Nombre de usuario</span>
            </div>

            <div className="input-container focus">
              <input type="email" name="email" className="input" />
              <label>Correo</label>
              <span>Correo</span>
            </div>

            <div className="input-container focus">
              <input type="tel" name="phone" className="input" />
              <label>Teléfono</label>
              <span>Teléfono</span>
            </div>

            <div className="input-container textarea focus">
              <textarea name="message" className="input"></textarea>
              <label>Mensaje</label>
              <span>Mensaje</span>
            </div>

            <input type="submit" value="Enviar" className="btn" />

          </form>

        </div>

      </div>
    </div>
  );
}
