import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './SPA/App'
import {  BrowserRouter } from 'react-router-dom';

function Example() {
    return (
        <>
        <h1>hello</h1>
        </>
    );
}

export default Example;

if (document.getElementById('example')) {
    const Index = ReactDOM.createRoot(document.getElementById("example"));

    Index.render(
        <React.StrictMode>
              <Example/>
        </React.StrictMode>
    )
}
