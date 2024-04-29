import React from 'react';

const BesoinForm = () => {
  return (
    <form className="form-container"> {/* Added class for styling */}
      <div className="form-row">
        <label>Besoin Name</label>
        <input type="text" placeholder="Enter besoin name" className="form-input" /> {/* Added class for styling */}
      </div>
      <div>
        <button type="button" className="form-button">Ajouter</button> {/* Added class for styling */}
        <button type="button" className="form-button">Modifier</button> {/* Added class for styling */}
      </div>
    </form>
  );
}

export default BesoinForm;
