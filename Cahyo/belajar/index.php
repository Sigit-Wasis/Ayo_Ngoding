<?php

//SINTAK DASAR
echo "Hi";
echo "</br>";
echo "<hr>";
//VARIABEL
//KONSTANTA

//OPERATOR ARITMATIKA
//PENJUMLAHAN (+)
//PERKALIAN (*)
//PENGURANGAN (-)
//PEMBAGIAN (/)
//PEMANGKATAN (**)
//SISA BAGI (%)
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

echo "Pengurangan 10 - 20 = ";
echo $angka2 - $angka1;

echo "</br>";
echo "<hr>";

echo "Pembagian 10 / 20 = ";
echo $angka2 / $angka1;

echo "</br>";
echo "<hr>";

echo "Pemangkatan 10 ** 20 = ";
echo $angka2 ** $angka1;

echo "</br>";
echo "<hr>";

echo "Sisa Bagi 10 % 20 = ";
echo $angka2 % $angka1;

echo "</br>";
echo "<hr>";

//OPERTOR INCREMENT DAN DECREMENT
$a = 5;
$b = 2;

$a++; // + 1
$b--; // - 1

echo $a; //hasilnya 6
echo "</br>";
echo "<hr>";
echo $b;
echo "</br>";
echo "<hr>";

//OPERATOR LOGIKA
/*
Lebih Besar(>)
Lebih Kecil (<)
Sama Dengan (=)
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

//PENGKONDISIAN IF ELSE
//if (kondisi) {
//    jika kondisi terpenuhi
// } else {
//    jika kondisi tidak terpenuhi
// }
$teman = "Budi";

if ($teman == "andi") {
    echo "Benar Teman Saya Budi";
} else {
    echo "Bukan Teman Saya";
}

echo "</br>";
echo "<hr>";

//Jika $c lebih besar dari $d maka tampilkan benar selain itu salah
if ($c > $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

//Jika $c lebih kecil dari $d maka tampilkan benar selain itu salah
if ($c < $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

//Jika $c sama dengan dari $d maka tampilkan benar selain itu salah
if ($c == $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

//Jika $c tidak sama dengan $d maka tampilkan benar selain itu salah
if ($c != $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

//Jika $c lebih besar sama dengan $d maka tampilkan benar selain itu salah
if ($c >= $d) {
    echo "Benar";
} else {
    echo "Salah";
}

echo "</br>";
echo "<hr>";

//Jika $c lebih kecil sama dengan $d maka tampilkan benar selain itu salah
if ($c <= $d) {
    echo "Benar";
} else {
    echo "Salah";
}

?>