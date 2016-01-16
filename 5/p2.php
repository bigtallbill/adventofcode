<?php

/*
Realizing the error of his ways, Santa has switched to a better model of determining whether a string is naughty or nice. None of the old rules apply, as they are all clearly ridiculous.

Now, a nice string is one with all of the following properties:

It contains a pair of any two letters that appears at least twice in the string without overlapping, like xyxy (xy) or aabcdefgaa (aa), but not like aaa (aa, but it overlaps).
It contains at least one letter which repeats with exactly one letter between them, like xyx, abcdefeghi (efe), or even aaa.
For example:

qjhvhtzxzqqjkmpb is nice because is has a pair that appears twice (qj) and a letter that repeats with exactly one letter between them (zxz).
xxyxx is nice because it has a pair that appears twice and a letter that repeats with one between, even though the letters used by each rule overlap.
uurcxstgmygtbstg is naughty because it has a pair (tg) but no repeat with a single letter between them.
ieodomkazucvgmuy is naughty because it has a repeating letter with one between (odo), but no pair that appears twice.

How many strings are nice under these new rules?
 */

$input = file(__DIR__ . '/input.txt', FILE_IGNORE_NEW_LINES);

$nice = 0;
foreach ($input as $string) {
    $chars = str_split($string);


    if (hasMiddleChar($chars) && hasDuplicateGroups($chars)) {
        $nice++;
    }
}

var_dump($nice);

function hasDuplicateGroups($chars)
{
    $prev = null;
    $groups = [];
    $currentGroup = [];
    for ($index = 0; $index < count($chars); $index++) {
        $currentGroup[] = $chars[$index];

        if (count($currentGroup) >= 2) {
            $groups[] = ['chars' => implode('', $currentGroup), 'index' => $index];
            $currentGroup = [];
            $index--;
        }

        $prev = $chars[$index];
    }

    foreach ($groups as $group) {
        foreach ($groups as $group2) {
            $g1Index = $group['index'];
            $g2Index = $group2['index'];

            $g1Chars = $group['chars'];
            $g2Chars = $group2['chars'];

            $charsSame = $g1Chars === $g2Chars;
            $indexesDifferent = $g1Index !== $g2Index;
            $overlap = $g1Index + 1 == $g2Index || $g2Index + 1 == $g1Index;

            $matching = $charsSame && $indexesDifferent && !$overlap;

            if ($matching) {
                return true;
            }
        }
    }

    return false;
}

/**
 * @param $chars
 * @return bool
 */
function hasMiddleChar($chars)
{
    foreach ($chars as $index => $char) {
        if (isset($chars[$index + 2]) && $char === $chars[$index + 2]) {
            return true;
        }
    }

    return false;
}
