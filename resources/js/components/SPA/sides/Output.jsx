import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, useParams } from 'react-router-dom';

const Output = ({ formRowStyle, buttonStyle }) => {
  const navigate = useNavigate();
  const { dataType } = useParams();
  const [data, setData] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(`/home/${dataType}`);
        setData(response.data || []);
        console.log(response.data) // Ensure data is set to an empty array if response.data is falsy
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };
    
    fetchData();
  }, [dataType]);

  return (
    <div>
      <h2>Output Table</h2>
      {/* Output Table */}
      <div style={{ border: '1px solid black', padding: '10px', marginBottom: '10px' }}>
        <table>
          <thead>
            <tr>
              <th>Column 1</th>
              <th>Column 2</th>
              {/* Add more columns as needed */}
            </tr>
          </thead>
          <tbody>
            {/* Map over data to render table rows */}
            {Array.isArray(data) && data.length > 0 ? (
              data.map((item, index) => (
                <tr key={index}>
                  <td>{item.column1}</td>
                  <td>{item.column2}</td>
                  {/* Add more columns as needed */}
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="2">No data available</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default Output;

