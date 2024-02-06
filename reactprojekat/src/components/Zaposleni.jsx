import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Zaposleni.css';

const Zaposleni = () => {
  const [zaposleni, setZaposleni] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchZaposleni = async () => {
      try {
        const token = sessionStorage.getItem('token');
        const headers = {
          'Authorization': `Bearer ${token}`,
        };
        const response = await axios.get('http://127.0.0.1:8000/api/zaposleni', { headers });
        setZaposleni(response.data.data);
        setLoading(false);
      } catch (error) {
        console.error('Greška prilikom dobijanja zaposlenih:', error);
        setLoading(false);
      }
    };

    fetchZaposleni();
  }, []);

  if (loading) {
    return <p>Učitavanje...</p>;
  }

  return (
    <div className="zaposleni-container">
      <h1>Zaposleni</h1>
      <table className="zaposleni-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Email</th>
            <th>Pozicija</th>
            <th>Odeljenje</th>
            <th>Datum početka rada</th>
            <th>Datum kraja ugovora</th>
            <th>Plata</th>
            <th>Firma</th>
          </tr>
        </thead>
        <tbody>
          {zaposleni.map((zaposlen) => (
            <tr key={zaposlen.id}>
              <td>{zaposlen.id}</td>
              <td>{zaposlen.name}</td>
              <td>{zaposlen.email}</td>
              <td>{zaposlen.pozicija}</td>
              <td>{zaposlen.odeljenje}</td>
              <td>{zaposlen.datum_pocetka_rada}</td>
              <td>{zaposlen.datum_kraja_ugovora}</td>
              <td>{zaposlen.plata}</td>
              <td>{zaposlen.firma.naziv}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Zaposleni;
