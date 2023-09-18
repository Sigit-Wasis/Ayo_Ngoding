<?php

//SINTAK DASAR
echo "Hi Mas Bro";
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

echo "</br>";
echo "<hr>";

// PENGKONDISIAN SWITCH CASE
$bulan = "Januari";

switch ($bulan) {
    case 'Januari':
        echo "Ini bulan Januari";
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

//PERULANGAN FOR
$f = 10;
for ($i=0; $i < $f; $i++) { 
   echo "BISMILLAH ";
   echo $i;
   echo "</br>";
}

echo "</br>";
echo "<hr>";

$f = 10;
for ($i=0; $i <= $f; $i++) { 
   echo "BISMILLAH ";
   echo $f - $i;
   echo "</br>";
}

echo "</br>";
echo "<hr>";

for ($r = 10; $r >= 1; $r--) { 
   echo "BISMILLAH ";
   echo $r;
   echo "</br>";
}

echo "</br>";
echo "<hr>";

// BUAT PERULANGAN DARI 10 SAMPAI 1
// BISMILLAH 10
// BISMILLAH 9
// BISMILLAH 8
// BISMILLAH 7
// BISMILLAH 6
// BISMILLAH 5
// BISMILLAH 4
// BISMILLAH 3
// BISMILLAH 2
// BISMILLAH 1

// BUAT PERULANGAN 1 SAMPAI 10 DENGAN TAMPILKAN ANGKA PERULANGAN BILANGAN GENAP ATAU BILANGAN GANJIL
// HASILNYA
// 1 ADALAH BILANGAN GANJIL
// 2 ADALAH BILANGAN GENAP
// .....

$f = 10;
for ($i = 0; $i <= $f; $i++) {
    if ($i % 2 == 0) {
        echo "$i ADALAH BILANGAN GENAP";
    } else {
        echo "$i ADALAH BILANGAN GANJIL";
    }
    echo "</br>";
    // % sisa bagi atau modulus
    // bilangan genap adalah bilangan yang habis kalau dibagi 2
}

echo "</br>";
echo "<hr>";

// ARRAY []
// index itu di awali dengan angka 0
$buah = ['Rambutan','Kelengkeng','Durian', true];
// menampilkan value dengan index ke 2
echo $buah[2];
$buah[5] = "aaaaaaaaaaaaa";

echo "</br>";
echo "<hr>";

foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
}
echo "</br>";
echo "<hr>";

// ARRAY DENGAN LOOPING

// PERULANGAN WHILE

// PERULANGAN DO WHILE

// PERULANGAN FOREACH

// FUNCTION
echo "FUNCTION";
echo "<hr>";
function tampilkan_nama(){ // pembuatan function
	echo "Nama saya Mbuh"; // isi function
}
 
tampilkan_nama(); // panggilan function

echo "</br>";
echo "<hr>";

//Function dengan Parameter
function penjumlahan($angkaC, $angkaA){
    $jumlah = $angkaC + $angkaA; 
	echo "Hasil : $jumlah"; 
}
 
penjumlahan(5, 3); 

echo "</br>";
echo "<hr>";

//Function PHP mengembalikan Nilai / Value
//function hitung_umur($thn_lahir, $thn_sekarang){
    //$umur = $thn_sekarang - $thn_lahir; 
	//return $umur; 
//}
//echo "Umur Saya Sekarang " . hitung_umur (2002, 2023) . " tahun"; 

echo "</br>";
echo "<hr>";

// Memanggil Fungsi didalam Function
function hitung_umur($thn_lahir, $thn_sekarang){
    $umur = $thn_sekarang - $thn_lahir; 
    return $umur;
}

function perkenalan($nama, $tahun_lahir, $tahun_sekarang, $salam = "Selamat Pagi"){
    echo $salam. " </br>";
    echo "Perkenalkan Nama Saya " . $nama . "</br>";
    // Memanggil function hitung_umur dengan parameter tahun lahir dan tahun sekarang
    echo "Umur Saya Sekarang " . hitung_umur($tahun_lahir, $tahun_sekarang) . " tahun</br>"; 
    echo "Senang bisa mengenal anda</br>";
}

// Memanggil function perkenalan dengan parameter nama, tahun lahir, dan tahun sekarang
perkenalan("Uvuvwevwevwe Onyetenyetwevwe Ugwemubwem Ossas", 2002, 2023);

echo "</br>";
echo "<hr>";

//Luas Bangun Persegi Panjang
echo "Luas Bangun Datar</br>";
echo "<hr>";

echo "Belah Ketupat </br>";
function hitung_luas_belah_ketupat($diagonal1, $diagonal2) {
    $luas = 0.5 * $diagonal1 * $diagonal2;
    return $luas;
}

$diagonal1 = 9; 
$diagonal2 = 4;    
$luas_belah_ketupat = hitung_luas_belah_ketupat($diagonal1, $diagonal2);

echo "Diagonal 1: $diagonal1<br>";
echo "Diagonal 2: $diagonal2<br>";
echo "Luas Belah Ketupat: $luas_belah_ketupat";

echo "</br>";
echo "<hr>";

echo "Trapesium </br>";
function hitung_luas_trapesium($sisi1, $sisi2, $tinggi) {
    $luas = 0.5 * ($sisi1 + $sisi2) * $tinggi;
    return $luas;
}

$sisi1_trapesium = 8;
$sisi2_trapesium = 6;
$tinggi_trapesium = 4;

$luas_trapesium = hitung_luas_trapesium($sisi1_trapesium, $sisi2_trapesium, $tinggi_trapesium);

echo "Luas Trapesium: $luas_trapesium";

echo "</br>";
echo "<hr>";

echo "</br>";
echo "<hr>";

echo "Luas Bangun Volume</br>";
echo "<hr>";

echo "Kubus </br>";
function hitung_volume_kubus($sisi) {
    $volume = pow($sisi, 3);
    return $volume;
}

$sisi_kubus = 5;

$volume_kubus = hitung_volume_kubus($sisi_kubus);

echo "Volume Kubus: $volume_kubus";

echo "</br>";
echo "<hr>";

echo "Tabung </br>";
function hitung_volume_tabung($jari_jari, $tinggi) {
    $volume = M_PI * pow($jari_jari, 2) * $tinggi;
    return $volume;
}

$jari_jari_tabung = 5;
$tinggi_tabung = 10;

$volume_tabung = hitung_volume_tabung($jari_jari_tabung, $tinggi_tabung);

echo "Volume Tabung: $volume_tabung";



?>