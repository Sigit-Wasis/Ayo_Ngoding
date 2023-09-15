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

 // PENGKODNDISIAN SWITCH CASE
 echo "PENGKONDISIAN SWITCH CASE";
 echo "</br>";
 echo "<hr>";
 $switch = "Januari";

 switch ($switch) {
    case 'Januari':
        echo "ini bulan januari";
        break;
        case 'Februari':
        echo "ini bulan Februari";
            break;
            case 'Maret':
         echo "ini bulan Maret";
                break;
        default:
        echo "Tidak Ada Bulan";
        break;
        echo "</br>";
        echo "<hr>";

 }

 //PERULANGAN FOR

 echo "PERULANGAN FOR";
 echo "</br>";
 echo "<hr>";

$f = 10;
for ($i=0; $i < 10 ; $i++) {
    echo " Microdata ";
    echo $i;
    echo "</br>";
}
echo "</br>";
echo "<hr>";

//Buat pengulangan dari 10 sampai 1
//Microdata 10
//Microdata 9
//Microdata 8
//Microdata 7
//Microdata 6
//Microdata 5
//Microdata 4
//Microdata 3
//Microdata 2
//Microdata 1

$f = 10;
for ($i=20; $i <= $f; $i--) {
    echo " Microdata ";
    echo $f - $i;
    echo "</br>";
}
echo "</br>";
echo "<hr>";

//Buat perulangan 1 sampai 10 dengan tampilkan angka perulangan bilangan genap atau bilangan ganjil 
//hasilnya 
//1 adalah bilangan ganjil
//2 adalah bilangan genap 
//.....
//10 adalah bilangan genap

$f = 10;
for ($f=1; $f<=10; $f++) {
    if ($f % 2 == 1 )
{
    echo $f."<ini bilangan ganjil>";
}
echo "</br>";
echo "<hr>";
}
for ($h=1; $h <= 10; $h++) {
    if (($h % 2) ==0){
        echo "bilangan genap";
    }else{
        echo "bilangan ganjil";
    }
    echo $h;
    echo "</br>";
    echo "<hr>";
}
// ARRAY []
//index itu diawali dengan angka 0,index = key = kunci 
//mangga 0
//apel 1
//jeruk 2
//durian 3
//pisang 4
$buah = ['mangga','apel','jeruk','durian','pisang',78,true];
// menampilkan value dengan index ke 2
echo $buah [2]; //hasilnya adalah jeruk

//PERULANGAN FOREACH
//ARRAY DENGAN LOOPING
foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
    //untuk menambahkan array array_push
    $buah[7] = "semangka";
}

?>
