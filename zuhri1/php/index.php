<?php
// Menampilkan kata hallo
echo "hallo word"; 
echo "</br>";

// tampilkan variabel namaku 
// fungsi variabel untuk menyimpan data baik itu string,integer dll
$namaku = "Siti Aminatu Zuhriyah";
echo $namaku;

$huruf = "Microdata";
$angka = 100;
echo "</br>";

$angka3 = 40;
$angka4 = 30;

// Jumlahkan angka1 dengan angka2
echo $angka3 + $angka4;

echo $huruf;
echo "</br>";
echo $angka;

//KONSTANTA
const nama = "zuhri";
echo nama;

echo "</br>";
echo "<hr>";

//OPERATOR ARITMATIKA
//PENJUMLAHAN (+)
//PERKALIAN (*)
//PENGURANGAN (/)
//PEMBAGIAN (:)
//PEMANGKATAN (**)
//SISA BAGI (%)

// PENJUMLAHAN
echo "PENJUMLAHAN";
echo "</br>";
echo "<hr>";

$angka1 = 10;
$angka2 = 20;

echo "penjumlahan 10 + 20 = ";
echo $angka1 + $angka2;

echo "</br>";


echo "perkalian 10 * 20 = ";
echo $angka1 * $angka2;

echo "</br>";
echo "</hr>";

echo "pengurangan 20 - 10 = ";
echo $angka2 - $angka1;

echo "</br>";
echo "</hr>";

echo " pembagian 20 / 10 = ";
echo $angka2 / $angka1;

echo "</br>";
echo "</hr>";

echo " pemangkatan 20 ** 10 = ";
echo $angka2 ** $angka1;

echo "</br>";
echo "</hr>";

echo " sisa bagi 20 % 10 = ";
echo $angka2 % $angka1;

echo "</br>";
echo "<hr>";


//OPERATOR INCREMENT DAN DECREMENT
echo "OPERATOR INCREMENT DAN DECREMENT";
echo "</br>";
echo "<hr>";
$a = 5;
$b = 2;

$a++; // + 1
$b--; // - 1

echo $a; // hasilnya 6
echo "</br>";
echo "<hr>";
echo $b; // hasilnya 1
echo "</br>";
echo "<hr>";

//OPERATOR LOGIKA
/*
Lebih Besar (>)
Lebih Kecil (<)
Sama Deangan (=)
Tidak Sama Dengan (!=)
Lebih Besar Sama Dengan (>=)
Lebih Kecil Sama Dengan (<=)
*/
$c = 7;
$d = 4;

echo "OPERATOR LOGIKA";
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
echo $c != $d; // 1 atau true
echo "</br>";
echo "<hr>";
echo $c >= $d; // 1 atau true
echo "</br>";
echo "<hr>";
echo $c <= $d; // 0 atau false
echo "</br>";
echo "<hr>";

//PENGKODISIAN IF ELSE
echo "PENGKODISIAN IF ELSE";
echo "</br>";
echo "<hr>";

//PENGKODISIAN IF ELSE
// if (kondisi) {
//     jika komdisi terpenuhi
// } else {
//   jika kondisi tidak terpenuhi
// }
$teman = "BUDI";

if ($teman == "ANDI") {
    echo "benar teman saya budi";
} else {
    echo "bukan teman saya";
}

echo "</br>";
echo "<hr>";

// jika $c tidak sama dengan $d maka tampilkan benar selain itu salah
if ($c != $d) {
    echo "benar";
} else {
    echo "salah";
}
echo "</br>";
echo "<hr>";
 // $c lebih besar sama dengan $d maka tampilkan benar selain itu salah 

 if ($c >= $d) {
    echo "benar";
 } else {
    echo "salah";

 }
 echo "</br>";
 echo "<hr>";
 







?>
