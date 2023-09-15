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

// PENGKONDISIAN SWITCH CASE
$bulan = "Januari";

switch ($bulan) {
    case 'Januari':
        echo "Ini bulan Januari";
        break;

    case 'Februari':
        echo "Ini bulan februari";
        break;    

    case 'Maret':
        echo "Ini bulan Maret";
        break;

    default:
        echo "Tidak ada Bulan";
        break;

}
echo "</br>";
echo "<hr>";

// PERULANGAN FOR
$f = 10;
for ($i=0; $i < $f; $i++) {
    echo "Microdata ";
    echo $i;
    echo "</br>";


}
echo "</br>";
echo "<hr>";
// BUAT PERULANGAN DARI 10 SAMPAI 1
for ($r=10; $r >= 1; $r--) {
    
    echo "Microdata ";
    echo $r;
    echo "</br>";
}
echo "</br>";
echo "<hr>";
// Buat perulangan 1 sampai 10 dengan tampilkan angka perulangan bilangan genap atau bilangan ganjil
for ($m = 1; $m <= 10; $m++) {
    // % sisa bagi atau modulus
    // bilangan genap adalah bilangan yang habis kalau dibagi 2
    if ($m % 2 == 0) {
        echo $m . "adalah bilangan genap";
        echo "</br>";
    } else {
        echo $m .  "adalah bilangan ganjil";
        echo "</br>";
    }
    
}
    echo "</br>";
    echo "<hr>";

    // ARAY []
    // index itu diawali dengan angka 0
    $buah = ['mangga', 'apel', 'jeruk', 'durian', 'pisang', 78, true];
    // menampilkan  value dengan angka ke 2
    echo $buah[2]; // hasilnya adalah jeruk
    $buah[4] = "semangka";

    echo "</br>";
    echo "<hr>";

    foreach ($buah as $value) {
        var_dump($value);
        echo "</br>";
    }
    // PERULANGAN WHILE
    // ARRAY DENGAN LOOPING
    echo "</br>";
    echo "<hr>";


//KONSTANTA
const nama = "Roy Priandana ";
echo nama;

?>


