import React, { useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useAuth } from "@/react/context/AuthContext";
import "./page.css";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
import usuarioImg from "@/react/components/imagenes/usuario.jpg";

const Comments2Page= () => {
  const navigate = useNavigate();
  const { user, isAuthenticated, loading } = useAuth();

  useEffect(() => {
    if (!loading && !isAuthenticated) {
      navigate('/login', { replace: true });
    }
  }, [isAuthenticated, loading, navigate]);

  // Mostrar loading
  if (loading) {
    return (
      <div style={{ 
        display: 'flex', 
        justifyContent: 'center', 
        alignItems: 'center', 
        height: '100vh' 
      }}>
        <p>Cargando...</p>
      </div>
    );
  }

  // Si no hay usuario, no renderizar
  if (!isAuthenticated || !user) {
    return null;
  }

  return (
    <>
      <Header2 />

      <div className="contenedorTodo">
        {/* Sección de título */}
        <section className="review" id="review">
          <div className="middle-text">
            <h4>Nuestros Clientes</h4>
            <h2>Reseñas y Comentarios</h2>
          </div>
        </section>

        {/* Sección de reseñas */}
        <section className="review-content">
          <div className="box">
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ab,
              asperiores dolores cupiditate eius dolorem.
            </p>
            <div className="in-box">
              <div className="bx-img">
                <img src={usuarioImg} alt="Usuario" />
              </div>
              <div className="bxx-text">
                <h4>Karla Ospina</h4>
                <h5>Excelente, cumple con su trabajo, lo recomiendo mucho.</h5>
                <div className="ratings">
                  {[1, 2, 3, 4, 5].map((n) => (
                    <a href="#" key={n}>
                      <i id={`star${n}`}>★</i>
                    </a>
                  ))}
                </div>
              </div>
            </div>
          </div>

          <div className="box">
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ab,
              asperiores dolores cupiditate eius dolorem.
            </p>
            <div className="in-box">
              <div className="bx-img">
                <img src={usuarioImg} alt="Usuario" />
              </div>
              <div className="bxx-text">
                <h4>Frank Navarro</h4>
                <h5>Gran servicio, todo es rápido y profesional.</h5>
                <div className="ratings">
                  {[1, 2, 3, 4, 5].map((n) => (
                    <a href="#" key={n}>
                      <i id={`starY${n}`}>★</i>
                    </a>
                  ))}
                </div>
              </div>
            </div>
          </div>

          <div className="box">
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsum ab,
              asperiores dolores cupiditate eius dolorem.
            </p>
            <div className="in-box">
              <div className="bx-img">
                <img src={usuarioImg} alt="Usuario" />
              </div>
              <div className="bxx-text">
                <h4>Joan Montoya</h4>
                <h5>Me lo recomendó un compañero y todo correcto.</h5>
                <div className="ratings">
                  {[1, 2, 3, 4, 5].map((n) => (
                    <a href="#" key={n}>
                      <i id={`starX${n}`}>★</i>
                    </a>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* Formulario de comentarios */}
        <form className="comentaarios" onSubmit={(e) => e.preventDefault()}>
          <div className="input-container textarea focus">
            <textarea
              name="message"
              className="input"
              placeholder="Déjanos tu comentario:"
            ></textarea>
          </div>
          <div className="buttons-container">
            <Link to="/pagLogueados">
              <button type="button" className="volver">Volver</button>
            </Link>
            <input type="submit" value="Enviar" className="btn" />
          </div>
        </form>
      </div>

      <Footer />
    </>
  );
};

export default Comments2Page;
