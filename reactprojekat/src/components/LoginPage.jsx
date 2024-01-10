 
import React, { useState } from 'react';
import axios from 'axios';
import './LoginPage.css';
import InputField from './InputField';

const LoginPage = ({setToken}) => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', {
        email,
        password,
      });
      const { access_token } = response.data;
      sessionStorage.setItem('authToken', access_token);
      setToken(access_token);
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
