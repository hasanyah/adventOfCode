<?php

$lines = file('test.input');
$lines = file('06_1.input');
$lineNumber = 0;

function strToNums(string $str) : array {
    return array_map(
            fn($val) => intval($val), 
            preg_split(
                '/\s/', 
                $str,
                limit: -1,
                flags: PREG_SPLIT_NO_EMPTY
            ));

}

$times = strToNums(explode(':', $lines[0])[1]);
$time = intval(strval(implode('', $times)));
$distances = strToNums(explode(':', $lines[1])[1]);
$distance = intval(strval(implode('', $distances)));

$prev = 0;
$win = 0;
for ($i = 0; $i < $time; $i++) {
    $dist = ($time - $i) * $i;
    $win += $dist > $distance;
    $prev = $dist;
    if ($dist < $prev && $dist < $distance)
        break;
}

echo $win . ' <br/>';

