 
import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './App.css';
import HomePage from './components/HomePage';
import LoginPage from './components/LoginPage';
import Firme from './components/Firme';
import FirmaDetails from './components/FirmaDetails';
import Navbar from './components/Navbar';

function App() {
  return (
    <Router>
    <div className="App">
      <Navbar></Navbar>
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/login" element={<LoginPage />} />
        <Route path="/firme" element={<Firme />} />
        <Route path="/firme/:id" element={<FirmaDetails />} />
      </Routes>
    </div>
  </Router>
  );
}

export default App;
