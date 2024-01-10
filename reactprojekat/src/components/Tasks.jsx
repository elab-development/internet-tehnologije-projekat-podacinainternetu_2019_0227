import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Tasks.css';

const Tasks = () => {
  const [tasks, setTasks] = useState([]);
  const userId = parseInt(sessionStorage.getItem('userId'));

  useEffect(() => {
    const fetchTasks = async () => {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/task', {
          headers: {
            Authorization: `Bearer ${sessionStorage.getItem('authToken')}`
          },
          params: { userId }
        });
        console.log(response)
        setTasks(response.data.data);
      } catch (error) {
        console.error('Greška prilikom dohvatanja taskova', error);
      }
    };

    fetchTasks();
  }, [userId]);

  return (
    <div className="tasks-container">
      <table className="tasks-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Rok</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          {tasks.map(task => (
            <tr key={task.id}>
              <td>{task.id}</td>
              <td>{task.naziv}</td>
              <td>{task.opis}</td>
              <td>{task.rok}</td>
              <td>{task.status}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Tasks;
