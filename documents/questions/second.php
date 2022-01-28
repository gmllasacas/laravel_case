<?php

function isValid(string $upc)
{
    $upc_inv = strrev($upc);
    $total = 0;
    $check = intval($upc_inv[0]);

    foreach (range(1, 11, 2) as $index) {
        $total += $upc_inv[$index];
    }

    $total = $total * 3;

    foreach (range(2, 11, 2) as $index) {
        $total += $upc_inv[$index];
    }
    $rest = $total % 10;

    if (intval($rest) == 0){
        return ($check == 0 ? 'true' : 'false') ;
    } else {
        $rest = 10 - $rest;
        if(intval($check) == intval($rest)){
            return 'true' ;
        }else{
            return 'false' ;
        }
    }
}

echo isValid('036000241457');