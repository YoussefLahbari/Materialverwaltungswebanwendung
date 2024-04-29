const generateFakeMateriels = () => {
    return [
      {
        id: 1,
        type: 'Type A',
        model: 'Model 1',
        numero_serie: 'ABC123',
        numero_inventaire: 'INV001',
        etat: 'Good',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      },
      {
        id: 2,
        type: 'Type B',
        model: 'Model 2',
        numero_serie: 'XYZ789',
        numero_inventaire: 'INV002',
        etat: 'Fair',
        description: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      },
      // Add more Materiel objects as needed
    ];
  };
  
  export default generateFakeMateriels;
  