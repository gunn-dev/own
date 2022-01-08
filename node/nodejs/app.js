require('dotenv').config();

// const http = require('http');

// const hostname = '127.0.0.1';
// const port = 3000;

// const server = http.createServer((req, res) => {
//     res.statusCode = 200;
//     res.setHeader('Content-Type', 'text/plain');
//     res.end(process.env.USER_KEY);
// })

// server.listen(port, hostname, () => {
//     console.log(`Server running at http://${hostname}:${port}/`);
//     console.log(process.env.USER_ID);
//     console.log(process.env.USER_KEY);

// })


const arg = process.argv;
console.log(arg[2]);