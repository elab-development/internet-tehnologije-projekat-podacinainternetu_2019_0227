
import React from 'react';
const FirmaRow = ({ firma, onNavigate }) => {
    const { id, naziv, PIB } = firma;
    return (
      <tr>
        <td>{id}</td>
        <td>{naziv}</td>
        <td>{PIB}</td>
        <td>
          <button className="detalji-btn" onClick={() => onNavigate(`/firme/${id}`)}>Detalji</button>
        </td>
      </tr>
    );
  };


  export default FirmaRow;