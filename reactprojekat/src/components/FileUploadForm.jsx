import React, { useState } from 'react';
import axios from 'axios';

const FileUploadForm = () => {
  const [file, setFile] = useState(null);

  const handleFileChange = (e) => {
    setFile(e.target.files[0]);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    if (!file) {
      alert('Morate izabrati fajl za otpremanje.');
      return;
    }

    const formData = new FormData();
    formData.append('file', file);

    try {
        const token = sessionStorage.getItem('authToken');
        const response = await axios.post('http://127.0.0.1:8000/api/fajlovi/upload', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
              'Authorization': `Bearer ${token}`
            }
          });
      console.log('Odgovor sa servera:', response.data);
      alert('Fajl je uspešno otpremljen.');
    } catch (error) {
      console.error('Greška prilikom otpremanja fajla:', error);
      alert('Došlo je do greške prilikom otpremanja fajla.');
    }
  };

  return (
    <div className="login-page">
      <form className="login-form" onSubmit={handleSubmit}>
        <input type="file" onChange={handleFileChange} />
        <button type="submit" className="login-button">Otpremi fajl</button>
      </form>
    </div>
  );
};

export default FileUploadForm;
