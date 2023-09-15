<?php
// SINTAKS DASAR
echo "HI";
echo "</br>";
echo "<hr>";
// VARIABEL

// KOSTANTA
// OPERATOR ARITMATIKA
// PENJUMLAHAN (+)
// PERKALIAN (*)
// PENGURANGAN (-)
// PEMBAGIAN (/)
// PEMANGKATAN (**)
// SISA BAGI (%)

$angka1 = 10;
$angka1 = 20;

echo "Penjumlahan 10 + 20 =";
echo $angka1 + $angka2;

echo "</hr>";
echo "<br>";

echo "Perkalian 20 * 10 =";
echo $angka1 * $angka2;

echo "</hr>";
echo "<br>";

echo "Pengurangan 20 - 10 =";
echo $angka2 - $angka1;

echo "</hr>";
echo "<br>";

echo "Pembagian 20 / 10 =";
echo $angka1 / $angka2;

echo "</hr>";
echo "<br>";

echo "Pemangkatan 10 ** 20 =";
echo $angka1 ** $angka2;

echo "</hr>";
echo "<br>";

echo "Sisa bagi 20 % 10 =";
echo $angka1 % $angka2;

echo "</hr>";
echo "<br>";

// OPERATOR INCREMENT DAN DECREMENT
$a = 5;
$b = 2;

$a++; // + 1
$b--; // -1

echo $a; // hasilnya 6
echo "</br>";
echo "<hr>";
echo $b;
echo "</br>";
echo "<hr>";

// OPERATOR LOGIKA 
/*
// Lebih Besar (>)
// Lebih Kecil (<)
// Sama Dengan (==)
// Tidak Sama Dengan (!=)
// Lebih Besar Sama Dengan (>=)
// Lebih Kecil sama Dengan (<=)
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
//}

// jika $c lebih besar dari $d maka tampilkan benar
if ($c > $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// jika $c lebih kecil dari $d maka tampilkan salah
if ($c < $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// jika $c sama dengan dari $d maka tampilkan salah
if ($c == $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// jika $c tidak sama dengan dari $d maka tampilkan salah
if ($c != $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// jika $c lebih besar sama dengan dari $d maka tampilkan salah
if ($c <= $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// jika $c lebih kecil sama dengan dari $d maka tampilkan salah
if ($c >= $d){
    echo "BENAR";
}else {
    echo "SALAH";
}
echo "</br>";
echo "<hr>";

// PENGKONDISIAN SWITCH CASE

$bulan = "Januari";

switch ($bulan){
    case 'Januari';
    echo "ini bulan Januari";
    break;

    case 'Februari';
    echo "ini bulan Februari";
    break;

    case 'Maret';
    echo "ini bulan Maret";
    break;

    case 'April';
    echo "ini bulan April";
    break;
}

?>