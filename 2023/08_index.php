<?php

function allEndWithZ(array $arr) : bool {
    foreach ($arr as $val) {
        if (!str_ends_with($val, "Z"))
            return false;
    }

    return true;
}
$lines = file('test.input');
$lines = file('08_1.input');

$count = 0;
$instr  = [];

$map = [];
$currents = [];
$next = "";
$totalSteps = [];

foreach ($lines as $line) {
    $count++;
    if ($count == 1) {
        $instr = array_map(
                    fn($v) => $v == "L" ? strval(0) : strval(1),
                    str_split(trim($line))
                    );
        continue;
    }

    if (empty(trim($line)))
        continue;

    [$key, $val] = array_map(
                        fn($v)=>trim($v), 
                        preg_split("/[=]+/", $line, flags: PREG_SPLIT_NO_EMPTY)
                    );
    $points = preg_split("/[(),\s]+/", $val, flags: PREG_SPLIT_NO_EMPTY);
    $map[$key] = $points;
    if ($key[2] === "A")
        array_push($currents, $key);
}

echo 'There are ' . sizeof($currents) . " starting positions \n";

for ($j = 0; $j < sizeof($currents); $j++) {
    $current = $currents[$j];
    $steps = 0;
    while (!str_ends_with($current, "Z")) {
        // echo 'Current: ' . $current . ' <br/>';
        $dir = intval($instr[$steps % sizeof($instr)]);
        // echo 'Dir: ' . strval($dir) . ' <br/>';

        $current = $map[$current][$dir];
        $steps++;
    }
    array_push($totalSteps, $steps);
}
$lcm = 1;
foreach ($totalSteps as $steps) {
    $lcm = gmp_lcm($lcm, $steps);
    echo $lcm . '<br/>';
}
echo '<pre>';
var_dump($totalSteps);

echo '</pre>';
