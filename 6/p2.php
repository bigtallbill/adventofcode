<?php

/*
--- Part Two ---

You just finish implementing your winning light pattern when you realize you mistranslated Santa's message from Ancient Nordic Elvish.

The light grid you bought actually has individual brightness controls; each light can have a brightness of zero or more. The lights all start at zero.

The phrase turn on actually means that you should increase the brightness of those lights by 1.

The phrase turn off actually means that you should decrease the brightness of those lights by 1, to a minimum of zero.

The phrase toggle actually means that you should increase the brightness of those lights by 2.

What is the total brightness of all lights combined after following Santa's instructions?

For example:

turn on 0,0 through 0,0 would increase the total brightness by 1.
toggle 0,0 through 999,999 would increase the total brightness by 2000000.

 */

$input = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

//$input = ['toggle 0,0 through 999,999'];

$map = [];

$size = 999;

for ($x = 0; $x <= $size; $x++) {
    for ($y = 0; $y <= $size; $y++) {
        $map[$x][$y] = 0;
    }
}

foreach ($input as $command) {
    var_dump($command);
    $command = parseCommand($command);

    for ($x = $command['from'][0]; $x <= $command['to'][0]; $x++) {
        for ($y = $command['from'][1]; $y <= $command['to'][1]; $y++) {
            switch ($command['command']) {
                case 'turn on':
                    $map[$x][$y]++;
                    break;
                case 'turn off':
                    $map[$x][$y] = max($map[$x][$y] - 1, 0);
                    break;
                case 'toggle':
                    $map[$x][$y] += 2;
                    break;
            }
        }
    }
}

$on = 0;
for ($x = 0; $x <= $size; $x++) {
    for ($y = 0; $y <= $size; $y++) {
        $on += $map[$x][$y];
    }
}

var_dump($on);

function parseCommand($command) {

    $coords = [];
    preg_match_all("/(\\d+,\\d+)/uis", $command, $coords);

    $commandString = [];
    preg_match_all("/^(\\D)+/uis", $command, $commandString);

    $final = [
        'command' => trim($commandString[0][0]),
        'from' => explode(',', $coords[0][0]),
        'to' => explode(',', $coords[0][1])
    ];

    return $final;
}

