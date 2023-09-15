<?php 
//menampilkan kata hello
echo"hello";
echo "</br>";
echo"</hr>";

// tampilkan variabel nama kamu
// fungsi data baik iti string, integer dll
$namaku = "Nama ku Susi Widianti";
echo $namaku;
echo"</hr>";

$huruf ="Microdata";
$angka =100;
echo "</br>";

$angka3 = 40;
$angka4 = 30;
//jumlahkan angka1 dengan angka2
echo $angka3 + $angka4;
echo "</br>";

echo $huruf;
echo "</br>";
echo $angka;
echo "</br>";

//KONSTANTA
const nama ="Susi";
echo nama;
echo "</br>";
echo"</hr>";

// OPERATOR ARITMATIKA
//PENJUMLAHAN (+)
//PERKALIAN(*)
//PENGURANGAN(-)
//PEMBAGIAN (/)
//PEMANGKATAN(**)
//SISA BAGI(%)

$angka1 = 10;
$angka2 =20;

echo "Penjumlahan 10 + 20 =";
echo $angka1 + $angka2;

echo "</br>";
echo"</hr>";

echo "Perkalian 10 * 20 =";
echo "$angka1 * $angka2";

echo "</br>";
echo"</hr>";

echo "Pengurangan  20 - 10 =";
echo $angka2 - $angka1;

echo "</br>";
echo"</hr>";

echo "Pembagian 20 / 10 =";
echo $angka2 / $angka1;

echo "</br>";
echo"</hr>";

echo "Pemangkatan 20 ** 10 = ";
echo $angka2 ** $angka1;

echo "</br>";
echo"</hr>";

echo "Sisa bagi 20 % 10 = ";
echo $angka2 % $angka1;

echo "</br>";
echo"</hr>";

//OPERATOR INCREMENT DAN DECREMENT
$a= 5;
$b= 2;

$a++; // +1
$b--; // -1

echo $a;
echo"</br>";
echo"</hr>";
echo $b;
echo"</br>";
echo"</hr>";

// OPERATOR LOGIKA
/*
Lebih Besar (<)
Lebih kecil (>)
Sama Dengan (==)
Tidak Sama Dengan (!=)
Lebih besar sama dengan (<=)
Lebih kecil sama dengan (>=)
*/


echo "OPERATOR LOGIKA";
echo"</br>";
echo"</hr>";

$c =7;
$d =4;

echo $c > $d; // 1 atau true
echo"</br>";
echo"</hr>";

echo $c < $d; // 0 atau false
echo"</br>";
echo"</hr>";

echo $c == $d; // 0 atau false
echo"</br>";
echo"</hr>";

echo $c != $d; // 0 atau false
echo"</br>";
echo"</hr>";

echo $c <= $d; // 0 atau false
echo"</br>";
echo"</hr>";

echo $c >= $d; // 0 atau false
echo"</br>";
echo"</hr>";

// PENGKONDISIAN IF ELSE 
// if (kondisi){
// jika kondingan terpenuhi
// }else{ jika kondisi tidak terpenuhi
// }

$teman ="Budi";

if ($teman == "Budi") {
    echo "Benar Budi Teman saya";
}else {
    echo " Bukan teman saya";
}

echo"</br>";
echo"</hr>";

//JIka $c tidak sama dengan $d maka tampilkan benar selain itu salah
if($c != $d){
    echo "Benar Nilai c tidak sama dengan nilai d";
}else {
   echo "Salah"; 
}
echo"</br>";
echo"</hr>";

//Jika $c lebih besar sama dengan $d maka tampilkan benar selain itu salah
if ($c >= $d) {
    echo "Benar";
}else {
    echo "salah";
}
echo"</br>";
echo"</hr>";

$temanku = "Rudi";

if ($temanku == "Rudi") {
    echo " Benar teman saya";
 } else if ($temanku ==" Zuhri"){
    echo"iya itu teman perempuan saya";
}else { 
    echo"Bukan teman saya";
}




?>