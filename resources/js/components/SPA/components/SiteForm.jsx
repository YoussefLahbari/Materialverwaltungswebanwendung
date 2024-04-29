import React from 'react';

const SiteForm = () => {
  return (
    <form className="form-container">
      <div className="form-row">
        <label>Site Name</label>
        <input type="text" placeholder="Enter site name" className="form-input" />
      </div>
      <div>
        <button type="button" className="form-button">Ajouter</button>
        <button type="button" className="form-button">Modifier</button>
      </div>
    </form>
  );
}

export default SiteForm;

