const http = require('http');
const mongoClient = require('mongodb').MongoClient;

const hostname = '127.0.0.1';
const port = 3000;
const url = 'mongodb://localhost:27017/';

var dbo;
var db;

mongoClient.connect(url, (err, database) => {
    if (err) console.log(err);
    db = database;
    dbo = database.db('node_mongo');
})

const server = http.createServer((req, res) => {

    if (req.url == '/get-one') {
        // dbo.createCollection('customers', (err, res) => {
        //     if (err) console.log(err);
        //     console.log('Collection created!');
        // });

        dbo.collection('customers').find({ name: 'Ince Company' }).toArray((err, result) => {
            if (err) console.log(err);
            res.statusCode = 200;
            // res.setHeader('Content-Type', 'text/plain');
            res.end(JSON.stringify(result));
        });
    }

    if (req.url == '/get-all') {
        dbo.collection('customers').find().toArray((err, result) => {
            if (err) console.log(err);
            res.statusCode = 200;
            // res.setHeader('Content-Type', 'text/plain');
            res.end(JSON.stringify(result));
        });
    }


});



// server.listen(port, () => {
//     console.log(`Server running at http://${hostname}:${port}/`);
// })



// if (err) console.log(err);
// console.log(req.url);
// const dbo = db.db('node_mongo');
// dbo.createCollection('customers', (err, res) => {
//     if (err) console.log(err);
//     console.log('Collection created!');

// })
// let myObj = { name: 'Ince Company', address: 'Highway 56' };
// dbo.collection('customers').insertOne(myObj, (err, res) => {
//     if (err) console.log(err);
//     console.log('1 document inserted');
//     db.close();

// });
// dbo.collection('customers').find({ name: 'Ince Company' }).toArray((err, result) => {
//     if (err) console.log(err);
//     res.statusCode = 200;
//     // res.setHeader('Content-Type', 'text/plain');
//     res.end(JSON.stringify(result));
//     db.close();
// })

// dbo.collection('customers').deleteOne({ name: 'Company Inc' }, (err, res) => {
//     if (err) console.log(err);
//     console.log(res);
//     db.close();
// })


// res.end(req.url);
// if (req.url == '/') {
//     connectMongo();
// }

// function connectMongo() {
//     mongoClient.connect(url, (err, db) => {
//         if (err) console.log(err);
//         console.log(req.url);
//         const dbo = db.db('node_mongo');
//         let myObj = { name: 'Ince Company', address: 'Highway 56' };

//         dbo.collection('customers').find({ name: 'Ince Company' }).toArray((err, result) => {
//             if (err) console.log(err);
//             res.statusCode = 200;
//             // res.setHeader('Content-Type', 'text/plain');
//             res.end(JSON.stringify(result));
//             db.close();
//         })
//     })
// }
// mongoClient.connect(url, (err, db) => {
//     if (err) console.log(err);
//     console.log(req.url);
//     const dbo = db.db('node_mongo');
//     // dbo.createCollection('customers', (err, res) => {
//     //     if (err) console.log(err);
//     //     console.log('Collection created!');

//     // })
//     let myObj = { name: 'Ince Company', address: 'Highway 56' };
//     // dbo.collection('customers').insertOne(myObj, (err, res) => {
//     //     if (err) console.log(err);
//     //     console.log('1 document inserted');
//     //     db.close();

//     // });
//     dbo.collection('customers').find({ name: 'Ince Company' }).toArray((err, result) => {
//         if (err) console.log(err);
//         res.statusCode = 200;
//         // res.setHeader('Content-Type', 'text/plain');
//         res.end(JSON.stringify(result));
//         db.close();
//     })

//     // dbo.collection('customers').deleteOne({ name: 'Company Inc' }, (err, res) => {
//     //     if (err) console.log(err);
//     //     console.log(res);
//     //     db.close();
//     // })
// })

server.listen(port, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
})