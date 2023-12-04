<?php

function product($carry, $item) {
    $carry *= $item;
    return $carry;
}

$lines = file('04_1.input');
//$lines = file('test.input');

$cards = [];
$value = [];

foreach($lines as $line) {
    [$title, $tail] = explode(':', $line);
    $id = array_filter(explode(' ', $title), fn($val) => !empty($val));
    $id = end($id);

    array_push($cards, $id);
    $wnn = explode('|', $tail);
    $winners = array_map(
                fn($num) => intval($num),
                array_filter(
                    explode(' ', trim($wnn[0])), 
                    function($var){
                        return !empty($var);
                }));
    $numbers = array_map(
                fn($num) => intval($num),
                array_filter(
                    explode(' ', trim($wnn[1])), 
                    function($var){
                        return !empty($var);
                }));

    $cardPoints = 0;

    asort($winners);
    asort($numbers);

    foreach($numbers as $num) {
        if (in_array($num, $winners)) {
            $cardPoints++;
        }
    }
    $value[$id] = $cardPoints;
    echo $id . '            |<b>' . $cardPoints . '</b><br/>'; 
}
$i = 0;
while (!empty($cards[$i])) {
    for ($j = 0; $j < $value[$cards[$i]]; $j++)
        array_push($cards, $cards[$i]+$j+1);

    $i++;
}

echo "<b> Total: " . sizeof($cards) . "</b>";
