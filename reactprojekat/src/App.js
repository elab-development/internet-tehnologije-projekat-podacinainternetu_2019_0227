 
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

function App() {
  const [token,setToken] = useState(null);





  return (
    <Router>
    <div className="App">
      <Navbar token={token} setToken={setToken}></Navbar>
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route path="/login" element={<LoginPage setToken={setToken}/>} />
        <Route path="/firme/:id" element={<FirmaDetails />} />
        <Route path="/firme" element={<Firme />} />
        <Route path="/tasks" element={<Tasks />} />
        <Route path="/fajlovi" element={<FileList />} />
       
      </Routes>
    </div>
  </Router>
  );
}

export default App;
