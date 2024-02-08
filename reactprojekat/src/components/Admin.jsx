import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Bar } from 'react-chartjs-2';
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);

const AdminPage = () => {
  const [data, setData] = useState(null);

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const token = sessionStorage.getItem('authToken');
  
      if (!token) {
        console.error('Token nije pronađen u sessionStorage.');
        return;
      }
  
      const config = {
        headers: {
          Authorization: `Bearer ${token}`
        }
      };
  
      const response = await axios.get('http://127.0.0.1:8000/api/statistics', config);
      setData(response.data);
    } catch (error) {
      console.error('Greška prilikom dohvatanja podataka:', error);
    }
  };
  

  return (
    <div>
      <h1>Statistika po firmama</h1>
      {data && (
        <>
          <div>
            <h2>Broj zaposlenih po firmi</h2>
            <Bar
              key="employees-chart"
              data={{
                labels: data.employees_per_company.map(item => item.naziv),
                datasets: [
                  {
                    label: 'Broj zaposlenih',
                    data: data.employees_per_company.map(item => item.broj_zaposlenih),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                  },
                ],
              }}
              options={{
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }}
            />
          </div>
          <div>
            <h2>Broj fajlova po firmi</h2>
            <Bar
              key="files-chart"
              data={{
                labels: Object.keys(data.files_per_company),
                datasets: [
                  {
                    label: 'Broj fajlova',
                    data: Object.values(data.files_per_company),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                  },
                ],
              }}
              options={{
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }}
            />
          </div>
        </>
      )}
    </div>
  );
};

export default AdminPage;
