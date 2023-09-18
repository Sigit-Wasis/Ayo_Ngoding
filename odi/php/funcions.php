<?php

function luasBelahKetupat($diagonal1, $diagonal2) {
    // Menghitung luas belah ketupat
    $luas = ($diagonal1 * $diagonal2 / 2) ;
    return $luas;
}


// Contoh penggunaan fungsi
$diagonal1 = 8;
$diagonal2 = 6;


echo "Luas belah ketupat dengan diagonal $diagonal1 dan $diagonal2 adalah: " . luasBelahKetupat($diagonal1, $diagonal2,) . "<br>";


?>