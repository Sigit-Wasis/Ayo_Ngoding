<?php

function sayHello()
{
    echo "Sebuah segitiga mempunyai alas 5 cm dan tinggi 10 cm. Berapakah Luas Segitiga?" . PHP_EOL;

}
sayHello();

function sum (int $alas, $tinggi)
{
    $luas = 1/2 * $alas * $tinggi;
    echo "Luas $alas x $tinggi = $luas " . PHP_EOL;
}

sum(5, 10);
echo "<br/>";
echo "<hr/>";


function addNumbers(int $panjang, $lebar, $tinggi)
{
    echo "Sebuah balok memiliki Lebar 10 cm, panjang 5 cm, tinggi 10. berapakah luas balok? " . PHP_EOL;
    $luas = 2 * ($panjang * $lebar) + ($panjang * $tinggi) + ($lebar * $tinggi);
    return $luas;

}  
   echo addNumbers(5, 10, 10); 
//  echo "Hitung Luas Balok Menggunakan $panjang x $lebar + $panjang x $tinggi + $lebar x $tinggi adalah";
?>

