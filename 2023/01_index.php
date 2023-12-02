<?php

$lines = file('01_1.input');
//$lines = file('test.input');
$count = 0;
$total = 0;

$nums = [
    'one'=>1,
    'two'=>2,
    'three'=>3,
    'four'=>4,
    'five'=>5,
    'six'=>6,
    'seven'=>7,
    'eight'=>8,
    'nine'=>9,
];


foreach($lines as $line) {
    if (trim($line) !== '') {
        $count += 1;
        $numline = '';
        echo str_pad($count, 2, 0, STR_PAD_LEFT) . ', ' . $line;

        $len = strlen($line);

        for ($i = 0; $i < $len; $i++) {
            $sub = substr($line, $i);
            if (is_numeric($sub[0]))
                $numline .= $sub[0]; 
            else {
                foreach ($nums as $key=>$val) {
                    if (str_starts_with($sub, $key))
                        $numline .= $val;
                }
            }
        }

        if (trim($line) !== '') {    
            echo ' | ' . $numline;

            $lineNum = intval($numline[0])*10 + intval($numline[-1]);
            echo ' | ' . '<b>' . $lineNum . '</b>';
            echo '<br />';
            $total += $lineNum;
        }
    }
}

echo 'Total: ' . $total;
