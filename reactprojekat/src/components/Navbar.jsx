import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Navbar.css';

const Navbar = ({ token, setToken }) => {
  const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      await axios.post('http://127.0.0.1:8000/api/logout', {}, {
        headers: {
          Authorization: `Bearer ${sessionStorage.getItem('authToken')}`
        }
      });
      sessionStorage.removeItem('authToken');
      setToken(null);
      navigate('/');
    } catch (error) {
      console.error('Greška prilikom odjave', error);
    }
  };

  return (
    <nav className="navbar">
      <Link to="/" className="nav-link">Početna</Link>
      {token ? (
        <>
          <Link to="/firme" className="nav-link">Firme</Link>
          <Link to="/tasks" className="nav-link">Tasks</Link>
          <Link to="/fajlovi" className="nav-link">Fajlovi</Link>
          <Link to="/zaposleni" className="nav-link">Zaposleni</Link>
          <button onClick={handleLogout} className="nav-link">Odjava</button>
        </>
      ) : (
        <Link to="/login" className="nav-link">Prijava</Link>
      )}
    </nav>
  );
};

export default Navbar;
