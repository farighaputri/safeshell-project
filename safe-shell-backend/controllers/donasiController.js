const db = require('../db');

exports.createDonasi = (req, res) => {
    const { nama, jumlah, pesan } = req.body;
    const sql = 'INSERT INTO donasi (nama, jumlah, pesan) VALUES (?, ?, ?)';
    db.query(sql, [nama, jumlah, pesan], (err, result) => {
        if (err) {
            console.error('Error creating donasi:', err);
            res.status(500).send('Error creating donasi');
            return;
        }
        res.status(201).send('Donasi created successfully');
    });
};

exports.getAllDonasi = (req, res) => {
    const sql = 'SELECT * FROM donasi';
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Error fetching donasi:', err);
            res.status(500).send('Error fetching donasi');
            return;
        }
        res.json(results);
    });
};