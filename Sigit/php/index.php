<?php

// SINTAKS DASAR
echo "Hi, Kamu";
echo "</br>";
echo "<hr>";
// VARIABEL

// KONSTANTA

// OPERATOR ARITMATIKA
// PENJUMLAHAN (+)
// PERKALIAN (*)
// PENGURANGAN (-)
// PEMBAGIAN (/)
// PEMANGKATAN (**)
// SISA BAGI (%)
$angka1 = 10;
$angka2 = 20; 

echo "Penjumlahan 10 + 20 = ";
echo $angka1 + $angka2;

echo "</br>";
echo "<hr>";

echo "Perkalian 10 * 20 = ";
echo $angka1 * $angka2; 

echo "</br>";
echo "<hr>";

echo "Pengurangan 20 - 10 = ";
echo $angka2 - $angka1;

echo "</br>";
echo "<hr>";

echo "Pembagian 20 / 10 = ";
echo $angka2 / $angka1;

echo "</br>";
echo "<hr>";

echo "Pemangkatan 20 ** 10 = ";
echo $angka2 ** $angka1;

echo "</br>";
echo "<hr>";

echo "Sisa Bagi 20 % 10 = ";
echo $angka2 % $angka1;

echo "</br>";
echo "<hr>";

// OPERATOR INCREMENT DAN DECREMENT
$a = 5;
$b = 2;

$a++;  // + 1
$b--;  // - 1

echo $a; // hasilnya 6
echo "</br>";
echo "<hr>";
echo $b; // hasilnya 1

echo "</br>";
echo "<hr>";

// OPERATOR LOGIKA
/*
Lebih Besar (>)
Lebih Kecil (<)
Sama Dengan (==)
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

// PENGKONDISIAN IF ELSE
// if (kondisi) {
//     jika kondisi terpenuhi
// } else {
//     jika kondisi tidak terpenuhi
// }
$teman = "budi";

if ($teman == "andi") {
    echo "Benar Teman Saya Budi";
} else {
    echo "Bukan Teman Saya";
}

echo "</br>";
echo "<hr>";

// jika $c tidak sama dengan $d maka tampilkan benar selain itu salah
if ($c != $d) {
    echo "Benaar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

// jika $c lebih besar sama dengan $d maka tampilkan benar selain itu salah
if ($c >= $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

$temanku = "Rudi";

if ($temanku == "Rudi") {
    echo "Iya itu teman saya";
} else if ($temanku == "Ani") {
    echo "Iya itu teman perempuan saya";
} else {
    echo "Saya tidak punya teman";
}

echo "</br>";
echo "<hr>";

// PENGKONDISIAN SWITCH CASE
$bulan = "Maret";

switch ($bulan) {
    case 'Januari':
        echo "Ini bulan januari";
        break;
    
    case 'Februari':
        echo "Ini bulan Februari";
        break;

    case 'Maret':
        echo "Ini bulan Maret";
        break;

    default:
        echo "Tidak Ada Bulan";
        break;
}

echo "</br>";
echo "<hr>";

// PERULANGAN FOR
// hasilnya 0123456789
// $f = 10;
for ($i = 0; $i < 10; $i++) { 
    echo "microdata ";
    echo $i;
    echo "</br>";
}

echo "</br>";
echo "<hr>";

// Buat perulangan dari 10 sampai 1
for ($r = 20; $r >= 5; $r--) { 
    echo "microdata ";
    echo $r;
    echo "</br>";
}
// microdata 10
// microdata 9
// microdata 8
// microdata 7
// microdata 6
// microdata 5
// microdata 4
// microdata 3
// microdata 2
// microdata 1

// Buat perulangan 1 sampai 10 dengan tampilkan angka perulangan bilangan genap atau bilangan ganjil
// hasilnya
// 1 adalah bilangan ganjil
// 2 adalah bilangan genap 
// ....
// 10 adalah bilangan genap
for ($k = 0; $k <= 10; $k++) {
    // % sisa bagi atau modulus 
    // bilangan genap adalah bilangan yang habis kalau di bagi 2
    if ($k % 2 == 0) {
        echo $k . " adalah bilangan genap";
        echo "</br>";
    } else {
        echo $k . " adalah bilangan ganjil";
        echo "</br>";
    }
}

echo "</br>";
echo "<hr>";

// ARRAY []
// index itu diawalai dengan angka 0
$buah = ['mangga', 'apel', 'jeruk', 'durian', 'pisang', 78, true];
// menampilkan value dengan index ke 2 
echo $buah[2]; // hasilnya adalah jeruk
$buah[4] = "semangka";

echo "</br>";
echo "<hr>";

// PERULANGAN FOREACH
// ARRAY DENGAN LOOPING
foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
}


// PERULANGAN WHILE

// PERULANGAN DO WHILE

// FUNCTION 

?>