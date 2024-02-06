import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Zaposleni.css';

const Zaposleni = () => {
  const [zaposleni, setZaposleni] = useState([]);
  const [loading, setLoading] = useState(true);
  const [newZaposleni, setNewZaposleni] = useState({
    name: '',
    email: '',
    password: '',
    pozicija: '',
    odeljenje: '',
    datum_pocetka_rada: '',
    datum_kraja_ugovora: '',
    plata: '',
    firma_id: '',
  });
  const [selectedZaposleniId, setSelectedZaposleniId] = useState(null);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setNewZaposleni({ ...newZaposleni, [name]: value });
  };

  const handleCreateClick = async () => {
    try {
      const token = sessionStorage.getItem('authToken');
      const headers = {
        'Authorization': `Bearer ${token}`,
      };
      const response = await axios.post('http://127.0.0.1:8000/api/zaposleni', newZaposleni, { headers });

      // Dodajte novog zaposlenog u niz zaposlenih
      setZaposleni([...zaposleni, response.data.zaposleni]);

      // Resetujte formu nakon uspešnog kreiranja
      setNewZaposleni({
        name: '',
        email: '',
        password: '',
        pozicija: '',
        odeljenje: '',
        datum_pocetka_rada: '',
        datum_kraja_ugovora: '',
        plata: '',
        firma_id: '',
      });
    } catch (error) {
      console.error('Greška prilikom kreiranja zaposlenog:', error);
    }
  };

  const handleEditClick = (id) => {
    // Pronađite zaposlenog u nizu na osnovu ID-ja i postavite ga u formu za ažuriranje
    const selectedZaposleni = zaposleni.find((z) => z.id === id);
    if (selectedZaposleni) {
      setNewZaposleni(selectedZaposleni);
      setSelectedZaposleniId(id);
    }
  };

  const handleUpdateClick = async () => {
    try {
      const token = sessionStorage.getItem('authToken');
      const headers = {
        'Authorization': `Bearer ${token}`,
      };
      const response = await axios.put(`http://127.0.0.1:8000/api/zaposleni/${selectedZaposleniId}`, newZaposleni, { headers });

      // Ažurirajte zaposlenog u nizu sa novim podacima
      const updatedZaposleni = zaposleni.map((z) => (z.id === selectedZaposleniId ? response.data.zaposleni : z));
      setZaposleni(updatedZaposleni);

      // Resetujte formu za ažuriranje
      setNewZaposleni({
        name: '',
        email: '',
        password: '',
        pozicija: '',
        odeljenje: '',
        datum_pocetka_rada: '',
        datum_kraja_ugovora: '',
        plata: '',
        firma_id: '',
      });
      setSelectedZaposleniId(null);
    } catch (error) {
      console.error('Greška prilikom ažuriranja zaposlenog:', error);
    }
  };

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

  const handleDeleteClick = async (id) => {
    try {
      const token = sessionStorage.getItem('authToken');
      const headers = {
        'Authorization': `Bearer ${token}`,
      };
      await axios.delete(`http://127.0.0.1:8000/api/zaposleni/${id}`, { headers });

      // Uklonite zaposlenog iz niza
      setZaposleni(zaposleni.filter((z) => z.id !== id));
    } catch (error) {
      console.error('Greška prilikom brisanja zaposlenog:', error);
    }
  };

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
            <th>Akcije</th>
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
              <td>
                <button onClick={() => handleEditClick(zaposlen.id)}>Izmeni</button>
                <button onClick={() => handleDeleteClick(zaposlen.id)}>Obriši</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <div className="zaposleni-form">
        <h2>Kreiraj/Ažuriraj zaposlenog</h2>
        <div>
          <label>Ime:</label>
          <input type="text" name="name" value={newZaposleni.name} onChange={handleInputChange} />
        </div>
        <div>
          <label>Email:</label>
          <input type="email" name="email" value={newZaposleni.email} onChange={handleInputChange} />
        </div>
        <div>
          <label>Šifra:</label>
          <input type="password" name="password" value={newZaposleni.password} onChange={handleInputChange} />
        </div>
        <div>
          <label>Pozicija:</label>
          <input type="text" name="pozicija" value={newZaposleni.pozicija} onChange={handleInputChange} />
        </div>
        <div>
          <label>Odeljenje:</label>
          <input type="text" name="odeljenje" value={newZaposleni.odeljenje} onChange={handleInputChange} />
        </div>
        <div>
          <label>Datum početka rada:</label>
          <input type="date" name="datum_pocetka_rada" value={newZaposleni.datum_pocetka_rada} onChange={handleInputChange} />
        </div>
        <div>
          <label>Datum kraja ugovora:</label>
          <input type="date" name="datum_kraja_ugovora" value={newZaposleni.datum_kraja_ugovora} onChange={handleInputChange} />
        </div>
        <div>
          <label>Plata:</label>
          <input type="number" name="plata" value={newZaposleni.plata} onChange={handleInputChange} />
        </div>
        <div>
          <label>ID Firme:</label>
          <input type="number" name="firma_id" value={newZaposleni.firma_id} onChange={handleInputChange} />
        </div>
        {selectedZaposleniId ? (
          <button onClick={handleUpdateClick}>Ažuriraj</button>
        ) : (
          <button onClick={handleCreateClick}>Kreiraj</button>
        )}
      </div>
    </div>
  );
};

export default Zaposleni;
