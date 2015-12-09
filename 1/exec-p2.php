<?php

$input = file_get_contents(__DIR__ . '/input.txt');

$input = str_split($input);

$floor = 0;

$firstBasement = null;

foreach ($input as $index => $command) {

    if ($firstBasement === null && $floor <= -1) {
        $firstBasement = $index;
    }

    if ($command === '(') {
        $floor++;
    } elseif ($command === ')') {
        $floor--;
    }
}

var_dump($firstBasement);
