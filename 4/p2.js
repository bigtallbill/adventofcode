/*
 Now find one that starts with six zeroes.
 */

var md5 = require('md5');

var input = 'your puzzle input',
    number = 0,
    hash,
    sourceString;

do {
    sourceString = input + number;
    hash = md5(sourceString);
    number++;

    // only log every 10000th test because it takes more time to output each log
    // than it takes to process 10000. or just remove this, but i like people to
    // think i work on The Matrix :P
    if (number % 10000 === 0) {
        console.log('testing', sourceString, hash);
    }
} while (hash.search('000000') !== 0);

console.log(number - 1);
