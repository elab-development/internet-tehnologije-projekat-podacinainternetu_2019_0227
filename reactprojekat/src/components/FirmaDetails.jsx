 
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
        const response = await axios.get(`http://127.0.0.1:8000/api/firme/${id}`);
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
          <h2>Detalji Firme</h2>
          <p><strong>Naziv:</strong> {firma.naziv}</p>
          <p><strong>PIB:</strong> {firma.PIB}</p>
          <p><strong>Matični broj:</strong> {firma.maticniBroj}</p>
          <p><strong>Adresa:</strong> {firma.adresa}</p>
          <p><strong>Kontakt telefon:</strong> {firma.kontaktTelefon}</p>
          <p><strong>Email:</strong> {firma.email}</p>
       
        </div>
      ) : (
        <p>Učitavanje detalja firme...</p>
      )}
    </div>
  );
};

export default FirmaDetails;
