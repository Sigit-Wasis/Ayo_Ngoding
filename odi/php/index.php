<?php

echo "Hallo";
echo "</br>";

// Fungsi Variabel untuk menyimpan data
$namaku = "Odi Adrian";
echo "My Name is " . $namaku . "<br>";

$huruf = "Microdata";
$angka = 12345678;

echo $huruf;
echo "</br>";
echo $angka;
echo "</br>";

$angka1 = 40;
$angka2 = 30;
echo $angka1 + $angka2;

echo "</br>";
echo "</br>";

echo "penjumlahan 30 + 40 = ";
echo $angka1 + $angka2;

echo "</br>";
echo "<hr>";

echo "pengurangan 30 - 40 = ";
echo $angka1 - $angka2;

echo "</br>";
echo "<hr>";

echo "perkalian 30 * 40 = ";
echo $angka1 * $angka2;

echo "</br>";
echo "<hr>";

echo "pembagian 30 / 40 = ";
echo $angka1 / $angka2;

echo "</br>";
echo "<hr>";

echo "pemangkatan 30 ** 40 = ";
echo $angka1 ** $angka2;

echo "</br>";
echo "<hr>";

echo "sisa bagi 30 % 40 = ";
echo $angka1 % $angka2;

echo "</br>";
echo "<hr>";

$a = 5;
$b = 2;

$a++; // +1
$b--; // -1

echo $a;
echo "</br>";
echo "<hr>";
echo $b;

// Operator Logika
/*
Lebih Besar >
Lebih Kecil <
Sama Dengan =
Tidak Sama Dengan |=
Lebih Besar Sama Dengan >=
Lebih Kecil Sama Dengan <=
*/

echo "</br>";
echo "<hr>";
$c = 7;
$d = 4;

echo "Operator Logika";
echo "</br>";
echo "<hr>";

echo $c > $d; // 1 atau true
echo "</br>";
echo "<hr>";

echo $c < $d; // 0 atau false
echo "</br>";
echo "<hr>";

echo $c == $d; // 0 atau false
echo "</br>";
echo "<hr>";

echo $c |= $d; // 1 atau true
echo "</br>";
echo "<hr>";

echo $c >= $d; // 1 atau true
echo "</br>";
echo "<hr>";

echo $c <= $d; // 0 atau false
echo "</br>";
echo "<hr>";


// Pengkondisian If False
// if (kondisi) {
//   jika kondisi terpenuhi
// }else{
//    jika kondisi tidak terpenuhi
// }

$teman = "Odi";
if ($teman == "Odi") {
    echo "Benar Itu Nama Saya = Odi";
}else{
    echo "Salah Itu Bukan Saya";
}

echo "</br>";
echo "<hr>";

// jika $c tidak sma dengan $d maka benar
// jika $c sma dengan $d maka salah
if ($c |= $d) {
    echo "Benar jika c dan d tidak sama dengan";
}else{
    echo "salah";
}

echo "</br>";
echo "<hr>";

$temanku = "Rudi";

if ($temanku == "rudi"){
    echo "Benar itu Teman Ku";
}else if($temanku == "ani") {
    echo "Bukan Teman Prempuan Saya";
}else{
    echo "Bukan Teman Saya";
}
// Constanta
echo "</br>";
echo "<hr>";
const nama = "Odi Adrian";
echo nama;
?>