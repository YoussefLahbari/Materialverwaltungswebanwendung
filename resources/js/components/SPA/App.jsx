// App.js
import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Input from './sides/Input';
import Output from './sides/Output';
import '../../../css/app.css'; // Import CSS file for styles

const App = () => {
  return (
    <div className="container">
      {/* Left Div for Input */}
      <Input />

      {/* Define routes */}
      <Routes>
        <Route path="/home/:dataType" element={<Output />} />
      </Routes>
    </div>
  );
}

export default App;

