<?php

/*
--- Day 6: Probably a Fire Hazard ---

Because your neighbors keep defeating you in the holiday house decorating contest year after year, you've decided to deploy one million lights in a 1000x1000 grid.

Furthermore, because you've been especially nice this year, Santa has mailed you instructions on how to display the ideal lighting configuration.

Lights in your grid are numbered from 0 to 999 in each direction; the lights at each corner are at 0,0, 0,999, 999,999, and 999,0. The instructions include whether to turn on, turn off, or toggle various inclusive ranges given as coordinate pairs. Each coordinate pair represents opposite corners of a rectangle, inclusive; a coordinate pair like 0,0 through 2,2 therefore refers to 9 lights in a 3x3 square. The lights all start turned off.

To defeat your neighbors this year, all you have to do is set up your lights by doing the instructions Santa sent you in order.

For example:

turn on 0,0 through 999,999 would turn on (or leave on) every light.
toggle 0,0 through 999,0 would toggle the first line of 1000 lights, turning off the ones that were on, and turning on the ones that were off.
turn off 499,499 through 500,500 would turn off (or leave off) the middle four lights.
After following the instructions, how many lights are lit?
 */

$input = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

//$input = ['turn off 499,499 through 500,500'];

$map = [];

$size = 999;

for ($x = 0; $x <= $size; $x++) {
    for ($y = 0; $y <= $size; $y++) {
        $map[$x][$y] = false;
    }
}

foreach ($input as $command) {
    var_dump($command);
    $command = parseCommand($command);

    for ($x = $command['from'][0]; $x <= $command['to'][0]; $x++) {
        for ($y = $command['from'][1]; $y <= $command['to'][1]; $y++) {
            switch ($command['command']) {
                case 'turn on':
                    $map[$x][$y] = true;
                    break;
                case 'turn off':
                    $map[$x][$y] = false;
                    break;
                case 'toggle':
                    $map[$x][$y] = !$map[$x][$y];
                    break;
            }
        }
    }
}

$on = 0;
for ($x = 0; $x <= $size; $x++) {
    for ($y = 0; $y <= $size; $y++) {
        if ($map[$x][$y]) {
            $on++;
        }
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

