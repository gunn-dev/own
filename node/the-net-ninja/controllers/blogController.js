// blog_index, blog_details, blog_create_get, blog_create_post
const Blog = require('../models/blog');

const blog_index = (req, res) => {
    Blog.find().sort({ createdAt: -1 })
        .then((result) => {
            res.render('blogs/index', { title: 'All Blogs', blogs: result })
        })
        .catch((err) => console.log(err))
}

const blog_detail = (req, res) => {
    const id = req.params.id;
    Blog.findById(id)
        .then((result) => {
            res.render('details', { blog: result, title: 'Blog Title' })
        })
        .catch((err) => console.log(err))
}
module.exports = {
    blog_index,
    blog_detail
}