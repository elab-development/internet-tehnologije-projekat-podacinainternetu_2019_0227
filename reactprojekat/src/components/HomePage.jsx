import React, { useEffect, useState } from 'react';
import axios from 'axios';
import './HomePage.css';

const HomePage = () => {
  const [images, setImages] = useState([]);

  useEffect(() => {
    const fetchImages = async () => {
      try {
        const response = await axios.get(
          'https://api.unsplash.com/photos/random?count=6&query=business&client_id=mgvH-dYb-0DA4vZU8jJbPSh6dJr9p4BkoaBx9alFrKA'
        );
        setImages(response.data);
      } catch (error) {
        console.error('Error fetching images:', error);
      }
    };

    fetchImages();
  }, []);

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
      <div className="image-gallery">
        {images.map((image) => (
          <div key={image.id} className="image-container">
            <img src={image.urls.regular} alt={image.alt_description} className="image"/>
          </div>
        ))}
      </div>
    </div>
  );
};

export default HomePage;
