 
import React, { useState } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './App.css';
import HomePage from './components/HomePage';
import LoginPage from './components/LoginPage';
import Firme from './components/Firme';
import FirmaDetails from './components/FirmaDetails';
import Navbar from './components/Navbar';
import Tasks from './components/Tasks';
import FileList from './components/FileList';
import RegistrationPage from './components/RegistrationPage';
import Zaposleni from './components/Zaposleni';
import FileUploadForm from './components/FileUploadForm';
import AdminPage from './components/Admin';

function App() {
  const [token,setToken] = useState(null);

  const [uloga,setUloga] = useState(null);



  return (
    <Router>
    <div className="App">
      <Navbar token={token} setToken={setToken} uloga={uloga} setUloga={setUloga}></Navbar>
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/register" element={<RegistrationPage />} />

        <Route path="/login" element={<LoginPage setToken={setToken}  setUloga={setUloga}/>} />
        <Route path="/firme/:id" element={<FirmaDetails />} />
        <Route path="/firme" element={<Firme />} />
        <Route path="/tasks" element={<Tasks />} />
        <Route path="/fajlovi/upload" element={<FileUploadForm />} />
        <Route path="/fajlovi" element={<FileList />} />
        <Route path="/zaposleni" element={<Zaposleni />} />
        <Route path="/admin" element={<AdminPage />} />
      </Routes>
    </div>
  </Router>
  );
}

export default App;
