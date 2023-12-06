<?php

function product($carry, $item) {
    $carry *= $item;
    return $carry;
}

$lines = file('02_1.input');
//$lines = file('test.input');

$power = 0;

foreach($lines as $line) {
    $flag = true;

    if (trim($line) !== '') {
        [$title, $data] = explode(':', $line);
        $id = explode(' ', $title)[1];
        $rounds = explode(';', $data);
        
        $min = [
            'green' => 0,
            'blue' => 0,
            'red' => 0,
        ];
        foreach($rounds as $round) {
            $draws = explode(',', $round);

            foreach($draws as $draw) {
                [$count, $color] = explode(' ', trim($draw));
                $min[$color] = $count > $min[$color] ? $count : $min[$color];
            }
        }
        $power += array_reduce($min, 'product', 1);
    }
}

echo 'Total: ' . $power;
