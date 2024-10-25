
//Importar mmodulo http incluido en node
const http = require('http');
//definir puerto del servidor
const port = 3006;

//crear servidor
const server = http.createServer((req, res)=>{
    res.writeHead(200, {'Content-Type':'text/plain'});
    res.end('Barrueta Guzman Jose Eduardo - 319091894')
    
});


server.listen(port, ()=>{
    console.log(`El servidor está en http://localhost:${port}`);
});
