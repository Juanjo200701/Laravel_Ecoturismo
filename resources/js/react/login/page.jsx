import { useState } from "react";
import { useLocation, Link } from "react-router-dom";
import axios from "axios";
import "./page.css";

export default function Login() {
  const location = useLocation();
  const isRegister = location.pathname === "/registro";
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [errors, setErrors] = useState({});
  const [msg, setMsg] = useState("");

  const login = async (e) => {
    e.preventDefault();
    setErrors({});
    setMsg("");

    try {
      await axios.post("/login", {
        name: username, // Laravel espera "name" o "email"
        password,
      });

      window.location.href = "/"; // login OK
    } catch (error) {
      if (error.response?.status === 422) {
        setErrors(error.response.data.errors);
      } else if (error.response?.status === 401) {
        setMsg("Credenciales incorrectas");
      } else {
        setMsg("Error del servidor");
      }
    }
  };

  return (
    <>
      <video id="bg-video" autoPlay loop muted>
        <source src="/imagenes/Videofondo4.mp4" type="video/mp4" />
      </video>

      <div className="container">
        <header className="header">
          <h1>Risaralda EcoTurismo</h1>
        </header>

        <form className="login-card" onSubmit={login}>
          <label>Nombre de usuario o Email:</label>
        <input
          type="text"
          value={username}
          onChange={(e) => setUsername(e.target.value)}
          required
        />
        {errors.name && <p className="error">{errors.name[0]}</p>}
        {errors.email && <p className="error">{errors.email[0]}</p>}

        <label>Contraseña:</label>
        <input
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        {errors.password && <p className="error">{errors.password[0]}</p>}

        {!isRegister && (
          <p className="register-text">
            ¿Todavía no tienes cuenta? <Link to="/registro">Regístrate</Link>
          </p>
        )}

        {isRegister && (
          <p className="register-text">
            ¿Ya tienes cuenta? <Link to="/login">Inicia sesión</Link>
          </p>
        )}

        <button type="submit">
          {isRegister ? "Registrarse" : "Iniciar sesión"}
        </button>

          {msg && <p className="message">{msg}</p>}
        </form>

        <footer className="footer">© 2025 Risaralda EcoTurismo</footer>
      </div>
    </>
  );
}
