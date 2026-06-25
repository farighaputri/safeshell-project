const express = require('express');
const router = express.Router();
const donasiController = require('../controllers/donasiController');

router.post('/donasi', donasiController.createDonasi);
router.get('/donasi', donasiController.getAllDonasi);

module.exports = router;