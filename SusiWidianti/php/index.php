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
echo"</br>";
echo"</hr>";

// PENGKONDISIAN SWITCH CASE(menampilkan nama-nama bulan)

$bulan = "September";

switch ($bulan) {

    case 'Januari':
        echo "ini bulan Januari";
        break;

    case 'Februari':
        echo "ini bulan Februari";
        break;

    case 'Maret':
        echo "ini bulan Maret";
        break;

    case 'April':
        echo "ini bulan April";
        break;
        
    case'Mei':
        echo "ini bulan mei";
        break;
    
    default:
        echo "tidak ada bulan";
        break;
}
echo"</br>";
echo"</hr>";

//PERULANGAN FOR
$f = 10;
$r =10;

for ($i=0; $i < $f; $i++){
    echo "microdata";
    echo $i;
    echo "</br>";
}


// buat perulangan dari 10 sampai 1
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

//PERULANGAN  9

echo"PERULANGAN 10-1";
echo"</br>";
echo"</hr>";

for ($r=10; $r >=1; $r--){
    echo "microdata";
    echo $r;
    echo "</br>";
}
echo"</br>";
echo"</hr>";

//Perulangan 1 sampai 10 dengan tampilkan angka perulangan bilangan genap atau bilangan ganjil
//hsdilnys
//1 bulangan ganjil
//2 bilangan genap
//....
//10 adalah bilangan genap

$a = 10;

for ($a=1; $a < 10; $a++){
    //% sisa bagi atau modulus
    // bilangan genap adalah bilangan yang habis di bagi 2
    if($a % 2 == 0){
        echo "Bilangan Genap";
    }
    else{
        echo "Ini Bilangan Ganjil";
    }
    echo "</br>";
    echo $a;
}
echo"</br>";
echo"</hr>";

//ARRAY[]
//index itu di awali dengan angka 0

echo"ARRAY"; 
echo"</br>";
echo"</hr>";

$buah =  ['mangga','apel','jeruk','nanas','durian','semangka',78,true];
//menampilkan valeu dengan index ke 2
echo $buah [4]; // hasilnya adalah jeruk
$buah[4]= "semangka";
echo"</br>";
echo"</hr>";

//var_dump untuk menampilkan tipe data 
foreach ($buah as $valeu){
    var_dump ($valeu);
    echo"</br>";
    echo "<hr>";
}

echo "Rumus Trapesium";
echo"</br>";
function volumeTrapesium($panjangAlas, $panjangSisiSejajar, $tinggiTrapesium, $tinggiSegitiga) {
    // Menghitung volume trapesium
    $volume = (1/2) * $panjangAlas * $panjangSisiSejajar * $tinggiTrapesium * $tinggiSegitiga;
    
    return $volume;
}

// Contoh penggunaan fungsi
$panjangAlas = 8; 
$panjangSisiSejajar = 6; 
$tinggiTrapesium = 4; 
$tinggiSegitiga = 2;

$hasilVolume = volumeTrapesium($panjangAlas, $panjangSisiSejajar, $tinggiTrapesium, $tinggiSegitiga);
echo "Hasil luas trapesium </br>";
echo "Diketahui: <br>";
echo "panjang alas = $panjangAlas</br>";
echo " panjang sisi sejajar = $panjangSisiSejajar</br>";
echo "tinggi trapesium = $tinggiTrapesium</br>";
echo "tinggi Segitiga = $tinggiSegitiga</br>";
echo "Volume trapesium adalah: " . $hasilVolume;
echo "</br>";
echo"<hr>";



function volumeBola($jariJari) {
    // Menghitung volume bola
echo"Rumus Menghitung Volume Bola";
    $volume = (4/3) * M_PI * pow($jariJari, 3);
    //pow 
    return $volume;
//return digunakan untuk memanggil variabel 
   
}

// Contoh penggunaan fungsi
$jariJari = 7;

$hasilVolume = volumeBola($jariJari);
echo "Hasil Hitung Volume Bola </br>";
echo "Diketahui: <br>";
echo "Jari-jari = $jariJari <br>";
echo "Volume bola adalah: " . $hasilVolume;
echo "</br>";
echo "<hr>";


function volumePrismaSegiLima($panjangAlas, $panjangApotem, $tinggiPrisma) {
    // Menghitung volume prisma segi lima
    $volume = (5/4) * $panjangAlas * $panjangApotem * $tinggiPrisma;
    
    return $volume;
}

//Prisma Segi Lima
echo "Rumus Bangun Ruang Prisma Segi Lima</br>";
$panjangAlas = 6; 
$panjangApotem = 4; 
$tinggiPrisma = 8; 

$hasilVolume = volumePrismaSegiLima($panjangAlas, $panjangApotem, $tinggiPrisma);
echo "Hasil hitung volume prisma segi lima yaitu <br>";
echo "Diketahui: <br>";
echo "Panjang Alas = $panjangAlas <br>";
echo "Panjang Apotem = $panjangApotem <br>";
echo "Tinggi Prisma = $tinggiPrisma <br>";
echo "Volume prisma segi lima adalah: " . $hasilVolume;
echo "<hr>";
echo "</br >";

function hitungluaspersegipanjang ($panjang, $lebar){
    // UNTUK MENGHITUNG
    $luas = $panjang * $lebar;
    return $luas;
}

// MENENTUKAN NILAI LUAS PERSEGI PANJANG
$panjang = 6;
$lebar = 5;

echo hitungluaspersegipanjang($panjang, $lebar);

?>