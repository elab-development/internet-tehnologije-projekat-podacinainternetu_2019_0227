import React, { useState } from 'react';
import axios from 'axios'; 
import InputField from './InputField';
import { useNavigate } from 'react-router-dom';
 

const RegistrationPage = ({ setToken }) => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [companyName, setCompanyName] = useState('');
  const [companyPIB, setCompanyPIB] = useState('');
  const [companyMaticniBroj, setCompanyMaticniBroj] = useState('');
  const [companyAdresa, setCompanyAdresa] = useState('');
  const [companyTelefon, setCompanyTelefon] = useState('');

  let navigate = useNavigate();

  const handleRegister = async (event) => {
    event.preventDefault();

    try {
      // Prvo šaljemo zahtev za registraciju korisnika
      const userResponse = await axios.post('http://127.0.0.1:8000/api/register', {
        name,
        email,
        password,
      });

      const { access_token } = userResponse.data;

      // Nakon registracije korisnika, šaljemo zahtev za kreiranje firme
      const firmaResponse = await axios.post('http://127.0.0.1:8000/api/firme', {
        naziv: companyName,
        PIB: companyPIB,
        maticniBroj: companyMaticniBroj,
        adresa: companyAdresa,
        kontaktTelefon: companyTelefon,
        email,
      }, {
        headers: {
          'Authorization': `Bearer ${access_token}`, // Dodajemo token za autorizaciju
        },
      });

      sessionStorage.setItem('authToken', access_token);
      sessionStorage.setItem('userId', userResponse.data.user.id);
      setToken(access_token);
      navigate('/tasks');
    } catch (error) {
      console.error('Registration error', error);
    }
  };

  return (
    <div className="registration-page">
      <form onSubmit={handleRegister} className="registration-form">
        <InputField
          type="text"
          value={name}
          onChange={(e) => setName(e.target.value)}
          placeholder="Name"
        />
        <InputField
          type="email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          placeholder="Email"
        />
        <InputField
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          placeholder="Password"
        />
        <InputField
          type="text"
          value={companyName}
          onChange={(e) => setCompanyName(e.target.value)}
          placeholder="Company Name"
        />
        <InputField
          type="text"
          value={companyPIB}
          onChange={(e) => setCompanyPIB(e.target.value)}
          placeholder="Company PIB"
        />
        <InputField
          type="text"
          value={companyMaticniBroj}
          onChange={(e) => setCompanyMaticniBroj(e.target.value)}
          placeholder="Company Maticni Broj"
        />
        <InputField
          type="text"
          value={companyAdresa}
          onChange={(e) => setCompanyAdresa(e.target.value)}
          placeholder="Company Adresa"
        />
        <InputField
          type="text"
          value={companyTelefon}
          onChange={(e) => setCompanyTelefon(e.target.value)}
          placeholder="Company Telefon"
        />
        <button type="submit" className="register-button">
          Register
        </button>
      </form>
    </div>
  );
};

export default RegistrationPage;
