import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Navbar.css';

const Navbar = ({ token, setToken, uloga, setUloga }) => {
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
      setUloga(null);
      navigate('/');
    } catch (error) {
      console.error('Greška prilikom odjave', error);
    }
  };

  return (
    <nav className="navbar">
      <Link to="/" className="nav-link">Početna</Link>
      <Link to="/firme" className="nav-link">Firme</Link>
      {token ? (
        <>
        
          {uloga === 'korisnik' && <Link to="/tasks" className="nav-link">Tasks</Link>}
          {(uloga === 'korisnik' || uloga === 'admin') && <Link to="/fajlovi" className="nav-link">Fajlovi</Link>}
          {(uloga === 'korisnik' || uloga === 'admin') && <Link to="/fajlovi/upload" className="nav-link">Upload</Link>}

          {uloga === 'admin' && <Link to="/zaposleni" className="nav-link">Zaposleni</Link>}
          {uloga === 'admin' && <Link to="/admin" className="nav-link">Admin</Link>}
          <button onClick={handleLogout} className="nav-link">Odjava</button>
        </>
      ) : (
        <>
          <Link to="/login" className="nav-link">Prijava</Link>
          <Link to="/register" className="nav-link">Register</Link>
        </>
      )}
    </nav>
  );
};

export default Navbar;
