require('dotenv').config(); // Load environment variables from .env file
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const donasiRoutes = require('./routes/donasiRoutes');
const path = require('path');

const app = express();
// Use port from environment variables or default to 3000
const port = process.env.PORT || 3000; 

// Middleware
app.use(cors()); // Enable CORS for all routes
app.use(bodyParser.json()); // Parse JSON request bodies
app.use(bodyParser.urlencoded({ extended: true })); // Parse URL-encoded request bodies

// Serve static files from the 'projek_webprokopkal' directory
// This means files like home.html, dashboard.html, donasi.html will be accessible directly
app.use(express.static(path.join(__dirname, '../../'))); 

// API routes
// All routes defined in donasiRoutes will be prefixed with /api
app.use('/api', donasiRoutes);

// Specific route for the dashboard.html
app.get('/dashboard', (req, res) => {
    res.sendFile(path.join(__dirname, '../../dashboard.html'));
});

// Catch-all for other routes (e.g., if someone accesses root, serve home.html)
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, '../../home.html'));
});

// Start the server
app.listen(port, () => {
    console.log(`Server running on port ${port}`);
    console.log(`Access dashboard at http://localhost:${port}/dashboard`);
});