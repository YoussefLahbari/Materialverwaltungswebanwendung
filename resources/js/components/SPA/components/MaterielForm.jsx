import React, { useState } from 'react';

const MaterielForm = () => {
  const [materiel, setMateriel] = useState({
    type: '',
    model: '',
    numero_serie: '',
    numero_inventaire: '',
    etat: '',
    description: '',
    site_id: '',
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setMateriel({ ...materiel, [name]: value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Handle form submission here
    console.log(materiel);
  };

  return (
    <form onSubmit={handleSubmit} className="form-container"> {/* Added class for styling */}
      <div className="mb-3">
        <label htmlFor="type" className="form-label">Type</label>
        <input
          type="text"
          className="form-control"
          id="type"
          name="type"
          value={materiel.type}
          onChange={handleChange}
        />
      </div>
      {/* Add other form inputs similarly */}
      {/* We'll handle site_id separately */}
      <button type="submit" className="btn btn-primary">Submit</button>
    </form>
  );
};

export default MaterielForm;
