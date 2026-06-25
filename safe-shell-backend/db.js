require('dotenv').config(); // Load environment variables
const mysql = require('mysql2');

const connection = mysql.createConnection({
    host: process.env.DB_HOST || 'localhost',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '', // Use environment variable for password
    database: process.env.DB_NAME || 'prokopkal_db'
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err.stack);
        return;
    }
    console.log('Connected to MySQL database as ID ' + connection.threadId);
});

module.exports = connection;