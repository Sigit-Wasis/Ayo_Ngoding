<?php
//menampilkan kata
echo "hello ";

// fungsi variabel untuk menyimpan dta baik string dan ll
$namaku = "Sofyan Hadi";
echo $namaku;
echo "<hr>";
echo "</br>";
echo "</br>";


$huruf = "Microdata";
$angka = 2002;


echo "Operator Aritmatika";
echo "</br>";
echo "</br>";

$angka1 = 10;
$angka2 = 43;

echo "penjumlahan 10 + 43 = ";
echo $angka1+$angka2;
echo "</br>";
echo "<hr>";

echo "perkalian 10 x 43 = ";
echo $angka1*$angka2;
echo "</br>";
echo "<hr>";

echo "perkurangan 43 - 10 = ";
echo $angka2-$angka1;
echo "</br>";
echo "<hr>";

echo "pembagian 43 - 10 = ";
echo $angka2/$angka1;
echo "</br>";
echo "<hr>";

echo "pemangkatan 43 ** 10 = ";
echo $angka2**$angka1;
echo "</br>";
echo "<hr>";

echo "sisa bagi 43 % 10 = ";
echo $angka2 % $angka1;
echo "</br>";
echo "<hr>";

$a = 10;
$b = 12; 

//increment dan Dicrement

echo "increment 10 (+1) = "; 
echo ++$a;
echo "</br>";
echo "<hr>";

echo "Decrement 12 (-1) = "; 
echo --$b;
echo "</br>";
echo "<hr>";


//operrator logika
/*
Lebih Besar (>)
Lebih Kecil (<)
Sama Dengan (==)
Tidak Sama Dengan (!=)
Lebih Bear Sama Dengan (>=)
Lebih Kecil Sama Dengan (<=)
*/
echo "</br>";
echo "Opertor Logika"; 
echo "</br>";
echo "<hr>";


$c = 7;
$d = 4;

echo $c > $d;
echo "</br>";
echo "<hr>";

echo $c < $d;
echo "</br>";
echo "<hr>";

echo $c == $d;
echo "</br>";
echo "<hr>";

echo $c != $d;
echo "</br>";
echo "<hr>";

echo $c >= $d;
echo "</br>";
echo "<hr>";

echo $c <= $d;
echo "</br>";
echo "<hr>";
echo "</br>";

// penggunaan if else

echo "Pengkodisian IF ELSE";
echo "</br>";
echo "<hr>";

// jika $c  sama dengan dengan $d maka bener
echo "jika 7 sama dengan 4 = ";
if ($c==$d){
    echo "benar";
}else{
    echo "Salah";
}
echo "</br>";
echo "<hr> ";

// jika $c tidak sama dengan dengan $d maka bener
echo "jika 7 tidak sama dengan 4 = ";
if ($c!=$d){
    echo "benar";
}else{
    echo "Salah";
}
echo "</br>";
echo "<hr>";

// jika $c lebih besar dengan $d maka bener
echo "jika 7 lebih besar dengan 4 = ";
if ($c>$d){
    echo "benar";
}else{
    echo "Salah";
}


//konstanta
echo "</br>";
echo "<hr>";
const namaasf = "Sofyan Hadi";
echo namaasf; 
echo "</br>";
echo "<hr>";
?>