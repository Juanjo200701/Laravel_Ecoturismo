import React, { useEffect } from "react";
import "./index.css";
import { useNavigate } from "react-router-dom";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
// import Card from '@/react/components/Cards/Card';
import Slider from "@/react/components/slider/Slider";

function PagLogueados() {
  const navigate = useNavigate();
  const user = window.Laravel?.user || null;

  // Validar que el usuario esté autenticado
  useEffect(() => {
    if (!user) {
      navigate('/login', { replace: true });
    }
  }, [user, navigate]);

  // Si no hay usuario, no renderizar nada
  if (!user) {
    return null;
  }

  return (
    <>
      <Header2 />
      {/* MAIN */}
      <main>
        <Slider />

        {/* CARDS */}
        <div className="contenedorcards">
          {/* <Card 
            urlImg={"https://picsum.photos/id/40/300/200"}
            title={"Paisajes"}
            description={"Conoce los paisajes más hermosos de la región."}
          /> */}
          {/* <Card 
            urlImg={"https://picsum.photos/id/41/300/200"}
            title={"Gastronomía"}
            description={"Sabores únicos que te encantarán."}
          /> */}
          {/* <Card 
            urlImg={"https://picsum.photos/id/42/300/200"}
            title={"Cultura"}
            description={"Tradición y arte en cada rincón."}
          /> */}
        </div>
        {/* CARDS */}
      </main>

      <Footer />
    </>
  );
}

export default PagLogueados;
