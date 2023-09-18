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

echo "</br>";
echo "<hr>";

//Perkondisian Switch Case

$bulan = "Maret";

switch ($bulan) {
    case 'Januari':
        echo "Ini Bulan Januari";
        break;

    case 'Februari':
        echo "Ini Bulan Februari";
        break;

    case 'Maret':
        echo "Ini Bulan Maret";
        break;
    
    default:
        echo "Tidak Ada Bulan";
        break;
}
echo "</br>";
echo "<hr>";

//Perulangan For
$f = 10;
for ($i=1; $i < $f; $i++) { 
    echo " Microdata";
    echo $i;
    echo "</br>";
}

echo "</br>";
echo "<hr>";

// Buat Perulangan dari 10 - 1
$f = 10;
for ($i=0; $i < $f; $i++) { 
    echo " Microdata";
    echo $f - $i;
    echo "</br>";
}

echo "</br>";
echo "<hr>";

for ($r = 10; $r >= 1; $r--) { 
    echo " Microdata";
    echo $r;
    echo "</br>";
}

echo "</br>";
echo "<hr>";

// Buat perulangan 1 sampai 10 dengan tampilan angka perulangan bilangan genap dan ganjil

for ($i=0; $i <= 10; $i++) {
    // % sisa bagi atau modulus
    // Bilangan genap adalah bilangan yang bisa dibagi 2
    if (($i % 2)==0){
        echo $i. " Bilangan Genap";
        echo "</br>";
    }else{
        echo $i. " Bilangan Ganjil"; 
    echo "</br>";
    }
}

echo "</br>";
echo "<hr>";

// Array
// Index adalah yang diawali 0

$buah =  ['Mangga','Jeruk','Apel','Durian','Pisang',88,true];

echo $buah [2]; // hasilnya apel 
$buah [4] = "Kelengkeng";

echo "</br>";
echo "<hr>";

// Perulangan forecach
// Array dengan Looping
foreach ($buah as $value){
    var_dump ($value);
    echo "</br>";
}
// odi
// Constanta
echo "</br>";
echo "<hr>";
const nama = "Odi Adrian";
echo nama;

echo "</br>";
echo "<hr>";

function luasBelahKetupat($diagonal1, $diagonal2) {
    // Menghitung luas belah ketupat
    $luas = ($diagonal1 * $diagonal2) / 2;
    return $luas;
}


// Contoh penggunaan fungsi
$diagonal1 = 8;
$diagonal2 = 6;


echo "Luas belah ketupat dengan diagonal $diagonal1 dan $diagonal2 adalah: " . luasBelahKetupat($diagonal1, $diagonal2) . "<br>";


?>