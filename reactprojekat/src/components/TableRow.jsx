import React from 'react';

const TableRow = ({ task }) => {
  return (
    <tr>
      <td>{task.id}</td>
      <td>{task.naziv}</td>
      <td>{task.opis}</td>
      <td>{task.rok}</td>
      <td>{task.status}</td>
    </tr>
  );
};

export default TableRow;
