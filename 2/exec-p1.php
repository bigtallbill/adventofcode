<?php

$input = file(__DIR__ . '/input.txt');

//$input = ['2x3x4'];

$totalSquareFoot = 0;
foreach ($input as $rawDimensions) {

    $rawDimensions = trim($rawDimensions);

    list($l, $w, $h) = explode('x', $rawDimensions);

    $side1 = $l * $w;
    $side1Area = (2 * $side1);
    $side2 = $w * $h;
    $side2Area = (2 * $side2);
    $side3 = $h * $l;
    $side3Area = (2 * $side3);

    $area = $side1Area + $side2Area + $side3Area;
    $smallest = min($side1, $side2, $side3);

    $requiredWrappingPaper = $area + $smallest;

    $totalSquareFoot += $requiredWrappingPaper;

    var_dump("dim: $rawDimensions pdim: $l-$w-$h smallest: $smallest sides: $side1Area-$side2Area-$side3Area area: $area required-feet: $requiredWrappingPaper");
}

var_dump($totalSquareFoot);
