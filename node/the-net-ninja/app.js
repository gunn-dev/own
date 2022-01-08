const express = require('express');
const morgan = require('morgan');
const mongoose = require('mongoose');
const blogRouters = require('./routes/blogRoutes');



// express app
const app = express();

// connect to mongodb
const dbURL = 'mongodb+srv://root:root@cluster0.omszk.mongodb.net/nodedb?retryWrites=true&w=majority';
mongoose.connect(dbURL, { useNewUrlParser: true, useUnifiedTopology: true })
    .then((result) => app.listen(3000))
    .catch((err) => console.log(err));


// register view engine
app.set('view engine', 'ejs');

// middleware & static files [public folder accesiable]

app.use(express.static('public'));

// for post, put, delete methods
app.use(express.urlencoded({ extended: true }));


app.use(morgan('dev'));




// middleware 
app.use((req, res, next) => {
    console.log('new request made');
    console.log('host: ', req.hostname);
    next();
})

app.use((req, res, next) => {
    console.log('in the next middleware');
    next();
})


app.get('/', (req, res) => {
    // res.send('<p>home page</p>');
    // res.sendFile('./view/index.html', { root: __dirname });

    res.redirect('/blogs');
    const blogs = [
        { title: 'hello', name: 'my name' },
        { title: 'hello', name: 'my name' },

    ]
    res.render('index', { title: 'Home', blogs: blogs });


});

app.get('/about', (req, res) => {
    // res.send('<p>about page</p>');
    // res.sendFile('./view/about.html', { root: __dirname });
    res.render('about');


});


app.get('/about-us', (req, res) => {
    res.redirect('/about');
});

// use router
app.use('/blogs', blogRouters);

// app.use('url', (req, res) => {
app.use((req, res) => {
    // res.sendFile('./view/404.html', { root: __dirname });
    // res.status(404).sendFile('./view/404.html', { root: __dirname });
    res.render('404');
});