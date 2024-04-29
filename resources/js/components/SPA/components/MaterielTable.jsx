import React from 'react';

const MaterielTable = ({ materiels }) => {
  // const handleEdit = (id) => {
  //   // Handle edit action
  //   console.log(`Editing materiel with id ${id}`);
  // };

  // const handleDelete = (id) => {
  //   // Handle delete action
  //   console.log(`Deleting materiel with id ${id}`);
  // };

  return (
    <div className="table-responsive">
      <table className="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Model</th>
            <th>Numero de Serie</th>
            <th>Numero d'Inventaire</th>
            <th>Etat</th>
            <th>Description</th>
            {/* <th>Action</th> */}
          </tr>
        </thead>
        <tbody>
          {materiels.map((materiel) => (
            <tr key={materiel.id}>
              <td>{materiel.id}</td>
              <td>{materiel.type}</td>
              <td>{materiel.model}</td>
              <td>{materiel.numero_serie}</td>
              <td>{materiel.numero_inventaire}</td>
              <td>{materiel.etat}</td>
              <td>{materiel.description}</td>
              <td>
                {/* <button
                  className="btn btn-sm btn-info me-1"
                  onClick={() => handleEdit(materiel.id)}
                >
                  Edit
                </button>
                <button
                  className="btn btn-sm btn-danger"
                  onClick={() => handleDelete(materiel.id)}
                >
                  Delete
                </button> */}
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default MaterielTable;
