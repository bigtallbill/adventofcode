<?php

/**
 * --- Part Two ---
 * The elves are also running low on ribbon. Ribbon is all the same width,
 * so they only have to worry about the length they need to order, which
 * they would again like to be exact.
 *
 * The ribbon required to wrap a present is the shortest distance around
 * its sides, or the smallest perimeter of any one face. Each present also
 * requires a bow made out of ribbon as well; the feet of ribbon required for
 * the perfect bow is equal to the cubic feet of volume of the present.
 * Don't ask how they tie the bow, though; they'll never tell.
 *
 * For example:
 *
 * A present with dimensions 2x3x4 requires 2+2+3+3 = 10 feet of ribbon to wrap the present plus
 * 2*3*4 = 24 feet of ribbon for the bow, for a total of 34 feet.
 *
 * A present with dimensions 1x1x10 requires 1+1+1+1 = 4 feet of ribbon to wrap the present plus
 * 1*1*10 = 10 feet of ribbon for the bow, for a total of 14 feet.
 * How many total feet of ribbon should they order?
 */

$input = file(__DIR__ . '/input.txt');

//$input = ['2x3x4'];

$requiredRibbon = 0;

foreach ($input as $rawDimensions) {

    $rawDimensions = trim($rawDimensions);

    list($l, $w, $h) = explode('x', $rawDimensions);

    $side1 = $l * 2;
    $side2 = $w * 2;
    $side3 = $h * 2;

    $sides = [$side1, $side2, $side3];

    $smallestTwoSides = [];

    while (count($smallestTwoSides) !== 2) {
        $smallest = min($sides);
        $smallestTwoSides[] = $smallest;
        array_splice($sides, array_search($smallest, $sides), 1);
    }

    $bowFeet = $l * $w * $h;
    $sideFeet = array_sum($smallestTwoSides);
    $ribbonFeet = $bowFeet + $sideFeet;

    $requiredRibbon += $ribbonFeet;

    var_dump("dim: $rawDimensions pdim: $l-$w-$h bow: $bowFeet ribbonfeet: $ribbonFeet");
}

var_dump($requiredRibbon);
