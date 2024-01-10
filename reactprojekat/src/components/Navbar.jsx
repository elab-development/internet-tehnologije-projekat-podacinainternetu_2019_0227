 
import React from 'react';
import { Link } from 'react-router-dom';
import './Navbar.css';

const Navbar = () => {
  return (
    <nav className="navbar">
      <Link to="/" className="nav-link">Početna</Link>
      <Link to="/login" className="nav-link">Prijava</Link>
      <Link to="/firme" className="nav-link">Firme</Link>
    </nav>
  );
};

export default Navbar;
