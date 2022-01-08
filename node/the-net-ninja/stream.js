const fs = require('fs');

const readStream = fs.createReadStream('./docs/blog.txt', { encoding: 'utf8' });
const writestream = fs.createWriteStream('./docs/blog1.txt');

// readStream.on('data', (chunk) => {
//     console.log('------------- New CHHUNK ----------');
//     console.log(chunk);

//     writestream.write('\nNew Chunk\n')
//     writestream.write(chunk);
// })

// piping
readStream.pipe(writestream);