import React from "react";
import "./index.css";
import Header from "./components/Header/Header";
import Footer from "./components/Footer/Footer";
import Slider from "./components/slider/Slider";

function App() {
  return (
    <>
      <Header />

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
