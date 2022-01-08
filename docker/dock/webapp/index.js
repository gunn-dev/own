var express = require('express')
var app = express()

app.get('/', (req, res) => {
    res.send('hi');
})

app.listen(8081, function () {
    console.log('app listening on port 8081')
})

