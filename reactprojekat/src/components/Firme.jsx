 
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Firme.css';
import { useNavigate } from 'react-router-dom';
import FirmaRow from './FirmaRow';

const Firme = () => {
  const [firme, setFirme] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const dohvatiFirme = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/firme');
        setFirme(response.data);
      } catch (error) {
        console.error('Došlo je do greške prilikom dohvatanja firmi', error);
      }
    };
    dohvatiFirme();
  }, []);

  return (
    <div className="firme-container">
      <table className="firme-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>PIB</th>
            <th>Detalji</th>
          </tr>
        </thead>
        <tbody>
          {firme.map((firma) => (
            <FirmaRow key={firma.id} firma={firma} onNavigate={navigate} />
          ))}
        </tbody>
      </table>
    </div>
  );
};



export default Firme;
