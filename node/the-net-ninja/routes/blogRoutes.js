const express = require('express');
const blogController = require('../controllers/blogController');

const router = express.Router();

router.get('/blogs', blogController.blog_index)

// router.post('/blogs', (req, res) => {
//     console.log(req.body);

//     const blog = new Blog(req.body);
//     blog.save()
//         .then((result) => {
//             res.redirect('/blogs');
//         })
//         .catch((err) => console.log(err))
// })

router.get('/blogs/:id', blogController.blog_detail);


// router.delete('/blogs/:id', (req, res) => {
//     const id = req.params.id;
//     Blog.findByIdAndDelete(id)
//         .then((result) => {
//             // res.render('details', { blog: result, title: 'Blog Title' })
//             res.json({ redirect: '/blogs' })
//         })
//         .catch((err) => console.log(err))
// })


// // mongoose and mongo sandbox routes
// router.get('/add-blog', (req, res) => {
//     const blog = new Blog({
//         title: 'new blog 2',
//         snippet: 'about my new blog',
//         body: 'more abbout my new blog'
//     });

//     blog.save()
//         .then((result) => {
//             res.send(result)
//         })
//         .catch((err) => {
//             console.log(err);
//         });
// })

// router.get('/all-blogs', (req, res) => {
//     Blog.find()
//         .then((result) => {
//             res.send(result)
//         })
//         .catch((err) => console.log(err))
// })

// router.get('/single-blog', (req, res) => {
//     Blog.findById('61c1f11565829408c730f322')
//         .then((result) => {
//             res.send(result)
//         })
//         .catch((err) => console.log(err))
// })

// router.get('/blogs', (req, res) => {
//     Blog.find().sort({ createdAt: -1 })
//         .then((result) => {
//             res.render('index', { title: 'All Blogs', blogs: result })
//         })
//         .catch((err) => console.log(err))
// })

// router.post('/blogs', (req, res) => {
//     console.log(req.body);

//     const blog = new Blog(req.body);
//     blog.save()
//         .then((result) => {
//             res.redirect('/blogs');
//         })
//         .catch((err) => console.log(err))
// })

// router.get('/blogs/:id', (req, res) => {
//     const id = req.params.id;
//     Blog.findById(id)
//         .then((result) => {
//             res.render('details', { blog: result, title: 'Blog Title' })
//         })
//         .catch((err) => console.log(err))
// })


// router.delete('/blogs/:id', (req, res) => {
//     const id = req.params.id;
//     Blog.findByIdAndDelete(id)
//         .then((result) => {
//             // res.render('details', { blog: result, title: 'Blog Title' })
//             res.json({ redirect: '/blogs' })
//         })
//         .catch((err) => console.log(err))
// })


module.exports = router;
