 
import React from 'react';
 

const InputField = ({ type, value, onChange, placeholder }) => {
  return (
    <input
      type={type}
      value={value}
      onChange={onChange}
      placeholder={placeholder}
      required
    />
  );
};

export default InputField;
