const express = require('express');
const router = express.Router();
const { formDataList } = require('./formulario');

router.get('/', (req, res) => {
    let tableRows = formDataList.map((data, index) => `
        <tr>
            <td>${index + 1}</td>
            <td>${data.nombre}</td>
            <td>${data.email}</td>
        </tr>
    `).join('');

    res.send(`
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Datos Recabados</title>
            <link rel="stylesheet" href="styles/style.css">
        </head>
        <body>
            <h1>Datos Recabados</h1>
            <a href="http://localhost:2420">
                <button>Inicio</button>
            </a>
            <table>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                </tr>
                ${tableRows}
            </table>
        </body>
        </html>
    `);
});

module.exports = router;
