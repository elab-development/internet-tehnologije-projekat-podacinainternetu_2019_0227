 
import React, { useState } from 'react';
import axios from 'axios';
import './LoginPage.css';
import InputField from './InputField';
import { useNavigate } from 'react-router-dom';

const LoginPage = ({setToken,setUloga}) => {
  const [email, setEmail] = useState('feeney.aisha@example.net');   
  const [password, setPassword] = useState('password');
  let navigate = useNavigate(); 
  const handleLogin = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', {
        email,
        password,
      });
      const { access_token } = response.data;
      sessionStorage.setItem('authToken', access_token);
      sessionStorage.setItem('userId', response.data.user.id);
      sessionStorage.setItem('firmaId', response.data.user.firma_id);
      setToken(access_token);
      setUloga(response.data.user.uloga);
      if(response.data.user.uloga=="korisnik"){
        navigate('/tasks');
      }else{
        navigate('/admin');
      }
     
    } catch (error) {
      console.error('Login error', error); 
    }
  };

  return (
    <div className="login-page">
      <form onSubmit={handleLogin} className="login-form">
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
        <button type="submit" className="login-button">Login</button>
      </form>
    </div>
  );
};

export default LoginPage;
