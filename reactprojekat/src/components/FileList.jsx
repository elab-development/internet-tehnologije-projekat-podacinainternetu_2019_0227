import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './FileList.css';

const FileList = () => {
  const [files, setFiles] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [filesPerPage, setFilesPerPage] = useState(5);
  useEffect(() => {
    fetchFiles();
  }, []);

  const fetchFiles = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/fajlovi', {
        headers: {
          Authorization: `Bearer ${sessionStorage.getItem('authToken')}`
        }
      });
      setFiles(response.data.entries);
    } catch (error) {
      console.error('Greška prilikom dohvatanja fajlova', error);
    }
  };


 
  const indexOfLastFile = currentPage * filesPerPage;
  const indexOfFirstFile = indexOfLastFile - filesPerPage;
  const currentFiles = files.slice(indexOfFirstFile, indexOfLastFile);

  const paginate = (pageNumber) => setCurrentPage(pageNumber);
  return (
    <div className="file-list-container">
     
      <table className="file-list-table">
        <thead>
          <tr>
            <th>Ime Fajla</th>
            <th>Datum Modifikacije</th>
            <th>Veličina (u bajtovima)</th>
            <th>Otvori</th>
          </tr>
        </thead>
        <tbody>
          {currentFiles.map(file => (
            <tr key={file.id}>
              <td>{file.name}</td>
              <td>{file.server_modified}</td>
              <td>{file.size}</td>
              <td>
                <a href={`https://www.dropbox.com/home${file.path_lower}`} target="_blank" rel="noopener noreferrer">Otvori</a>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <div className="pagination">
        {[...Array(Math.ceil(files.length / filesPerPage)).keys()].map(number => (
          <button key={number + 1} onClick={() => paginate(number + 1)}>
            {number + 1}
          </button>
        ))}
      </div>
    </div>
  );
};

export default FileList;
