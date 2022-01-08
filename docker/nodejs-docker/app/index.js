var express = require('express')
var app = express()
var bodyParser = require('body-parser')
var router = express.Router()


// app.use(bodyParser.urlencoded({ extended: false }))
// app.use(bodyParser.json())

// router.get('/', (req, res) => {
//     res.send('your name is ' + req.body.name);

// })

app.get('/', (req, res) => {
    res.send('hi');
})

app.listen(8081, function () {
    console.log('app listening on port 8081')
})

// app.use('/', router)