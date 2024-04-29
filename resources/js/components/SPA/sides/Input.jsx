// Input.js
import React, { useState } from 'react';
import MaterielForm from '../components/MaterielForm';
import SiteForm from '../components/SiteForm';
import BesoinForm from '../components/BesoinForm';

const Input = () => {
  const [selectedForm, setSelectedForm] = useState('');

  const handleFormSelect = (event) => {
    setSelectedForm(event.target.value);
  };

  // Render the selected form based on the selectedForm state
  const renderSelectedForm = () => {
    switch (selectedForm) {
      case 'materiel':
        return <MaterielForm />;
      case 'site':
        return <SiteForm />;
      case 'besoin':
        return <BesoinForm />;
      default:
        return null;
    }
  };

  return (
    <div style={{ marginRight: '10px' }}>
      <h2>Input Form</h2>
      <div style={{ marginBottom: '10px' }}>
        <h3>Select Form:</h3>
        <select value={selectedForm} onChange={handleFormSelect} style={{ marginLeft: '10px' }}>
          <option value="">Select Form</option>
          <option value="materiel">Materiel</option>
          <option value="site">Site</option>
          <option value="besoin">Besoin</option>
        </select>
      </div>
      {/* Render the selected form */}
      {renderSelectedForm()}
    </div>
  );
};

export default Input;

