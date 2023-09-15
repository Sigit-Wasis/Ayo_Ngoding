<?php
// menampilkan kata hallo
echo"hallo ";


//fungsi variabel untuk menyimpan data baik string, integer dll
//tampilkan variabel namaku
$namaku = "Roy Priandana ";
echo $namaku;

$huruf = " Microdata";
$angka = 2000;

$angka1 = 11;
$angka2 = 24;

//jumlahkan angka1 dengan angka2
echo $angka1 + $angka2;

echo $huruf;
echo "</br>";
echo $angka;

// OPERATOR ARITMATIKA
// PENJUMLAHAN (+)
// PERKALIAN (*)
// PENGURANGAN (-)
// PEMBAGIAN (/)
// PEMANGKATAN (**)
// SISA BAGI (%)

echo " penjumlahan 10 + 20 = ";
echo $angka1 + $angka2;

echo "</br>";
echo "<hr>";

echo "perkalian 10 * 20 = ";
echo $angka1 * $angka2;

echo "</br>";
echo "<hr>";

echo "pengurangan 20 - 10 = ";
echo $angka1 - $angka2;

echo "</br>";
echo "<hr>";

echo "pembagian 20 / 10 = ";
echo $angka1 / $angka2;

echo "</br>";
echo "<hr>";

echo "pemangkatan 40 ** 10 = ";
echo $angka1 ** $angka2;

echo "</br>";
echo "<hr>";

echo "sisa bagi 60 % 20 = ";
echo $angka1 % $angka2;

echo "</br>";
echo "<hr>";

// OPERATOR INCREMENT DAN DECREMENT
$a = 5;
$b = 2;

$a++; // + 1
$b--; // - 1

echo $a;
echo "</br>";
echo "<hr>";
echo $b;
echo "</br>";
echo "<hr>";

// OPERATOR LOGIKA
/*
Lebih Besar (>)
Lebih Kecil (<)
Sama Dengan (=)
Tidak Sama Dengan (!=)
Lebih Besar Sama Dengan (>=)
Lebih Kecil Sama Dengan (<=)
*/

echo "OPERATOR LOGIKA";
echo "</br>";
echo "<hr>";
$c = 7;
$d = 4;


echo $c > $d; // 1 atau true
echo "</br>";
echo "<hr>";
echo $c < $d; // 0 atau false
echo "</br>";
echo "<hr>";
echo $c == $d; // 0 atau false
echo "</br>";
echo "<hr>";
echo $c != $d; // 1 atau true
echo "</br>";
echo "<hr>";
echo $c >= $d; // 1 atau false
echo "</br>";
echo "<hr>";
echo $c <= $d; // 0 atau false
echo "</br>";
echo "<hr>";

// PENGKONDISIAN IF ELSE
// if (kondisi) {
//  jika kondisi terpenuhi
// } else {
//}    
$teman = "budi";

if ($teman == "andi") {
    echo "benar teman saya budi";
} else {
    echo "bukan teman saya";
}    
echo "</br>";
echo "<hr>";

// Jika $c tidak sama dengan $d maka tampilkan benar selain itu salah
if ($c != $d) {
    echo "benar";
} else {
    echo "salah";
}
echo "</br>";
echo "<hr>";

// jika $c lebih besar sama dengan $d maka tampilkan benar selain itu salah
if ($c >= $d) {
    echo " benar";
} else {
    echo "salah";
}   
echo "</br>";
echo "<hr>";


//KONSTANTA
const nama = "Roy Priandana ";
echo nama;

?>


