import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import "./index.css";
import Header from "./components/Header/Header";
import Header2 from "./components/Header2/Header2";
import Footer from "./components/Footer/Footer";
import Slider from "./components/slider/Slider";

function App() {
  // Obtener datos del usuario si están disponibles
  const user = window.Laravel?.user || null;
  const isAdmin = window.Laravel?.isAdmin || false;
  const navigate = useNavigate();

  // Si el usuario está logueado, redirigir a pagLogueados
  useEffect(() => {
    if (user) {
      navigate('/pagLogueados', { replace: true });
    }
  }, [user, navigate]);

  return (
    <>
      {user ? <Header2 /> : <Header />}

      <main>
        <Slider />

        <div className="contenedorcards">
          {/* cards futuras */}
        </div>
      </main>

      <Footer />
    </>
  );
}

export default App;
