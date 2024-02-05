import { useState, useEffect } from 'react';
import axios from 'axios';

const useTasks = (url, userId) => {
  const [tasks, setTasks] = useState([]);

  useEffect(() => {
    const fetchTasks = async () => {
      try {
        const response = await axios.get(url, {
          headers: {
            Authorization: `Bearer ${sessionStorage.getItem('authToken')}`
          }
        });
        
        setTasks(response.data.data);
      } catch (error) {
        console.error('Greška prilikom dohvatanja taskova', error);
      }
    };

    fetchTasks();
  }, [url, userId]);

  return tasks;
};

export default useTasks;
