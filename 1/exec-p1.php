<?php

$input = file_get_contents(__DIR__ . '/input.txt');

$input = str_split($input);

$floor = 0;
foreach ($input as $command) {

    var_dump($command);
    if ($command === '(') {
        $floor++;
    } elseif ($command === ')') {
        $floor--;
    }
}

var_dump($floor);
