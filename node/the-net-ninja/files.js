const fs = require('fs');

// read file
// fs.readFile('./docs/blog.txt', (err, data) => {
//     if (err) {
//         console.log(err);
//     }
//     console.log(data.toString());
// })


// write file
// fs.writeFile('./docs/blog.txt', 'haa', () => {
//     console.log('file was writtern');
// });

// directories
// if (!fs.existsSync('./assets')) {
//     fs.mkdir('./assets', (err) => {
//         if (err) {
//             console.log(err)
//         }
//         console.log('folder creaated');
//     });
// } else {
//     fs.rmdir('./assets', (err) => {
//         if (err) {
//             console.log(err);
//         }
//         console.log('folder deleted');
//     })
// }

// deleteing files
// if (fs.existsSync('./docs/delete.txt')) {
//     fs.unlink('./docs/delete.txt', (err) => {
//         if (err) {
//             console.log(err);
//         }
//         console.log('file deleted');
//     })
// } else {
//     fs.writeFile('./docs/delete.txt', 'delete something', () => {
//         console.log('file was writtern');
//     });
// }

if (fs.existsSync('./assets')) {
    fs.rmdir('./assets', (err) => {
        if (err) {
            console.log(err);
        }
        console.log('folder deleted');
    })
}