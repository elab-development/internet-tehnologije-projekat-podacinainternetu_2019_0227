 
import React from 'react';
import './HomePage.css';

const HomePage = () => {
  return (
    <div className="homepage">
      <header className="header">
        <h1>Your Data Hub</h1>
        <p className="tagline">Centralize. Organize. Optimize.</p>
        <p>
          Transform the way your business manages data with our comprehensive platform designed
          to streamline employee management, task delegation, and access control. Experience the
          power of having all your essential data at your fingertips — safely stored and easily accessible.
        </p>
      </header>
      <div className="features">
        <div className="feature-card">
          <div className="feature-icon">&#128100;</div> 
          <p>Manage Employees</p>
        </div>
        <div className="feature-card">
          <div className="feature-icon">&#128221;</div>  
          <p>Assign Tasks</p>
        </div>
        <div className="feature-card">
          <div className="feature-icon">&#128272;</div>  
          <p>Control Access</p>
        </div>
      </div>
    </div>
  );
};

export default HomePage;
