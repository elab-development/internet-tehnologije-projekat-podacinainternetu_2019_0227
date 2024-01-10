import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Tasks.css';
import useTasks from './useTasks';

const Tasks = () => {
    const userId = parseInt(sessionStorage.getItem('userId'));
    const tasks = useTasks('http://127.0.0.1:8000/api/task', userId);

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
