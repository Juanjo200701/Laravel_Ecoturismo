import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import Header2 from "@/react/components/Header2/Header2";
import Footer from "@/react/components/Footer/Footer";
import axios from "axios";
import "./page.css";

const PerfilPage = () => {
  const navigate = useNavigate();
  const user = window.Laravel?.user || null;
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    telefono: "",
  });
  const [message, setMessage] = useState("");
  const [loading, setLoading] = useState(false);

  // Validar que el usuario esté autenticado
  useEffect(() => {
    if (!user) {
      navigate("/login", { replace: true });
      return;
    }

    // Cargar datos del usuario
    setFormData({
      name: user.name || "",
      email: user.email || "",
      telefono: user.telefono || "",
    });
  }, [user, navigate]);

  if (!user) {
    return null;
  }

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setMessage("");

    try {
      const response = await axios.put("/perfil", formData);
      setMessage("Perfil actualizado exitosamente");
      setTimeout(() => setMessage(""), 3000);
    } catch (error) {
      setMessage(
        error.response?.data?.message || "Error al actualizar el perfil"
      );
    } finally {
      setLoading(false);
    }
  };

  const handleLogout = async () => {
    try {
      await axios.post("/logout");
      window.location.href = "/";
    } catch (error) {
      console.error("Error al cerrar sesión:", error);
    }
  };

  return (
    <>
      <Header2 />

      <div className="perfil-container">
        <div className="perfil-card">
          <h1>Mi Perfil</h1>

          {message && (
            <div className={`message ${message.includes("Error") ? "error" : "success"}`}>
              {message}
            </div>
          )}

          <form onSubmit={handleSubmit} className="perfil-form">
            <div className="form-group">
              <label htmlFor="name">Nombre:</label>
              <input
                id="name"
                type="text"
                name="name"
                value={formData.name}
                onChange={handleChange}
                required
              />
            </div>

            <div className="form-group">
              <label htmlFor="email">Correo:</label>
              <input
                id="email"
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                required
              />
            </div>

            <div className="form-group">
              <label htmlFor="telefono">Teléfono:</label>
              <input
                id="telefono"
                type="tel"
                name="telefono"
                value={formData.telefono}
                onChange={handleChange}
              />
            </div>

            <div className="form-buttons">
              <button
                type="submit"
                disabled={loading}
                className="btn-guardar"
              >
                {loading ? "Guardando..." : "Guardar Cambios"}
              </button>

              <button
                type="button"
                onClick={handleLogout}
                className="btn-logout"
              >
                Cerrar Sesión
              </button>
            </div>
          </form>
        </div>
      </div>

      <Footer />
    </>
  );
};

export default PerfilPage;
