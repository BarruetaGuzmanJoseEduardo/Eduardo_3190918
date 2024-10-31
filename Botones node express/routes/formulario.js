const express = require('express');
const router = express.Router();
const path = require('path');
let formDataList = [];

router.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, '../public/formulario.html'));
});

router.post('/', (req, res) => {
    formDataList.push(req.body);
    res.status(200).send('Datos recibidos correctamente');
});

module.exports = { router, formDataList };