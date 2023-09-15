<?php
//menampilkan kata hello baby

echo "hello";

// fungsi variabel untuk menyimpan data baik itu string, integer dll
// tampilkan variabel namaku
$namaku = " Alva";
echo $namaku;
echo "</br>";

$huruf = "Microdata";
echo $angka = 100;

$angka1 = 40;
$angka2 = 30;

// jumlahkan angka1 dan angka2
echo $angka1 + $angka2;
echo "</br>";
echo $huruf;
echo "</br>";
echo $angka;

// KONSTANTA
const nama = "Pintu";
echo nama
?>

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
echo $angka1 - $angka2;

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

    default :
    echo "Tidak ada bulan";
    break;
}
echo "</br>";
echo "<hr>";

// PERULANGAN FOR

$f = 15;
for ($i=0; $i <$f ; $i++) { 
    echo "WTF ";
    echo $i;
    echo "</br>";
}
echo "</br>";
echo "<hr>";

// BUAT PERULANGAN DARI 10 SAMPAI 1

for ($r=10; $r >= 1; $r--) { 
    echo "WTF ";
    echo $r;
    echo "</br>";
}
echo "</br>";
echo "<hr>";

// BUAT PERULANGAN 1 SAMPAI 10 DENGAN TAMPILKAN ANGKA PERULANGAN BILANGAN GENAP ATAU BILANGAN GANJIL

for ($i = 1; $i <= 10; $i++) {
    if ($i % 2 == 0) {
        echo " $i genap";
        echo "</br>";
    } else {
        echo " $i ganjil";
        echo "</br>";
    }
}
echo "</br>";
echo "<hr>";

// ARRAY
//index itu diawal dengan angka 0

$buah = ['jagung', 'jeruk', 'anggur', 'apel', 'pisang',true];

// menampilkan value dengan index ke 2
echo $buah[2];

echo "</br>";
echo "<hr>";

foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
   
}

?>