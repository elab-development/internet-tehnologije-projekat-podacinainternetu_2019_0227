import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './Tasks.css';
import useTasks from './useTasks';
import TableRow from './TableRow';

const Tasks = () => {
    const userId = parseInt(sessionStorage.getItem('userId'));
    const tasks = useTasks('http://127.0.0.1:8000/api/task', userId);
    const [filter, setFilter] = useState('sve');

    const filteredTasks = filter === 'sve' ? tasks : tasks.filter(task => task.status === filter);
    
    return (
        <div className="zaposleni-container">
            <h2 className="todo-list-title">MOJA TODO LISTA</h2>
           
            {filteredTasks.length === 0 ? (
                <p>Nema više zadataka</p>
            ) : (
              <>
              <div className="filter-container">
              <label htmlFor="statusFilter">Filter po statusu: </label>
              <select id="statusFilter" onChange={(e) => setFilter(e.target.value)} value={filter}>
                  <option value="sve">Svi</option>
                  <option value="zavrseno">Završeno</option>
                  <option value="otkazano">Otkazano</option>
                  <option value="u izradi">U izradi</option>
              </select>
          </div>
                <table className="zaposleni-table">
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
                        {filteredTasks.map(task => (
                            <TableRow key={task.id} task={task}/>
                        ))}
                    </tbody>
                </table>
                </> )}
        </div>
    );
};

export default Tasks;
