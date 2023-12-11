<?php

function allZero(array $arr) : bool {
    foreach ($arr as $val) {
        if ($val !== 0)
            return false;
    }
    return true;
}

$lines = file('test.input');
$lines = file('09_1.input');

$sum = 0;

foreach ($lines as $line) {
    $starters = [];
    $entry = array_map(
            fn($v)=>intval($v), 
            preg_split("/[\s]+/", $line, flags: PREG_SPLIT_NO_EMPTY));
    $ogStarter = reset($entry);
    $modifier = 1;
    while (!allZero($entry)) {
        $tmp = [];
        for ($i = 0; $i < sizeof($entry) - 1; $i++) {
            array_push($tmp, $entry[$i+1] - $entry[$i]);
        }
        $entry = $tmp;
        array_push($starters, $modifier * reset($entry));
        $modifier *= -1;
    }
    echo '<pre><b>';
    echo 'OG: ' . $ogStarter . '<br/>';
    print_r($starters);
    echo array_sum($starters) . '<br/>';
    $sum += $ogStarter - array_sum($starters);
    echo 'Sum: ' . $sum . '<br/>';
    echo '</b></pre>';
    
}

echo '<pre><b>';
echo 'Total: ' . $sum;
echo '</b></pre>';
