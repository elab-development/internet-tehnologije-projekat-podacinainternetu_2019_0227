// FirmaDetails.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import './FirmaDetails.css';

const FirmaDetails = () => {
  const [firma, setFirma] = useState(null);
  const { id } = useParams();

  useEffect(() => {
    const dohvatiDetaljeFirme = async () => {
      try {
        const response = await axios.get(`http://127.0.0.1/api/firme/${id}`);
        setFirma(response.data);
      } catch (error) {
        console.error('Došlo je do greške prilikom dohvatanja detalja firme', error);
      }
    };
    dohvatiDetaljeFirme();
  }, [id]);

  return (
    <div className="firma-details-container">
      
      {firma ? (
        <div>
         
        </div>
      ) : (
        <p>Učitavanje detalja firme...</p>
      )}
    </div>
  );
};

export default FirmaDetails;
