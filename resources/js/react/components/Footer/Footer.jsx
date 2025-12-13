import React from "react";
import "./footer.css";

const Footer = () => {
  return (
    <>
      {/* FOOTER */}
          <footer className="containerFooter">
            <div className="footer-inner">
              <p className="footer-copy">&copy; 2025 RisaraldaEcoTurismo</p>
              <p className="footer-links">
                <a href="#">Cookies</a>
                <span className="sep">|</span>
                <a href="#">Términos de uso</a>
                <span className="sep">|</span>
                <a href="#">Políticas de privacidad</a>
              </p>
            </div>
          </footer>
    </>
  );
};

export default Footer;

