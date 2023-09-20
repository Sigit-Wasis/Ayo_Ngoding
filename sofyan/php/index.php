<?php
//menampilkan kata
echo "hello ";

// fungsi variabel untuk menyimpan dta baik string dan ll
$namaku = "Sofyan Hadi";
echo $namaku;
echo "<hr>";
echo "</br>";
echo "</br>";


$huruf = "Microdata";
$angka = 2002;


echo "Operator Aritmatika";
echo "</br>";
echo "</br>";

$angka1 = 10;
$angka2 = 43;

echo "penjumlahan 10 + 43 = ";
echo $angka1+$angka2;
echo "</br>";
echo "<hr>";

echo "perkalian 10 x 43 = ";
echo $angka1*$angka2;
echo "</br>";
echo "<hr>";

echo "perkurangan 43 - 10 = ";
echo $angka2-$angka1;
echo "</br>";
echo "<hr>";

echo "pembagian 43 - 10 = ";
echo $angka2/$angka1;
echo "</br>";
echo "<hr>";

echo "pemangkatan 43 ** 10 = ";
echo $angka2**$angka1;
echo "</br>";
echo "<hr>";

echo "sisa bagi 43 % 10 = ";
echo $angka2 % $angka1;
echo "</br>";
echo "<hr>";

$a = 10;
$b = 12; 

//increment dan Dicrement

echo "increment 10 (+1) = "; 
echo ++$a;
echo "</br>";
echo "<hr>";

echo "Decrement 12 (-1) = "; 
echo --$b;
echo "</br>";
echo "<hr>";


//operrator logika
/*
Lebih Besar (>)
Lebih Kecil (<)
Sama Dengan (==)
Tidak Sama Dengan (!=)
Lebih Bear Sama Dengan (>=)
Lebih Kecil Sama Dengan (<=)
*/
echo "</br>";
echo "Opertor Logika"; 
echo "</br>";
echo "<hr>";


$c = 7;
$d = 4;

echo $c > $d;
echo "</br>";
echo "<hr>";

echo $c < $d;
echo "</br>";
echo "<hr>";

echo $c == $d;
echo "</br>";
echo "<hr>";

echo $c != $d;
echo "</br>";
echo "<hr>";

echo $c >= $d;
echo "</br>";
echo "<hr>";

echo $c <= $d;
echo "</br>";
echo "<hr>";
echo "</br>";


// penggunaan if else
echo "Pengkodisian IF ELSE";
echo "</br>";
echo "<hr>";

// jika $c  sama dengan dengan $d maka bener
echo "jika 7 sama dengan 4 = ";
if ($c==$d){
    echo "benar";
}else{
    echo "Salah";
}
echo "</br>";
echo "<hr> ";

// jika $c tidak sama dengan dengan $d maka bener
echo "jika 7 tidak sama dengan 4 = ";
if ($c!=$d){
    echo "benar";
}else{
    echo "Salah";
}
echo "</br>";
echo "<hr>";

// jika $c lebih besar dengan $d maka bener
echo "jika 7 lebih besar dengan 4 = ";
if ($c>$d){
    echo "benar";
}else{
    echo "Salah";
}
echo "</br>";
echo "<hr>";
echo "</br>";

//pengkondisian switch case
echo "Pengkodisian SWITCH CASE";
echo "</br>";
echo "<hr>";
$bulan = "Januari";
switch ($bulan) {
    case 'Januari':
        echo "Ini bulan Januari";
        break;
    
    case 'Febuari':
        echo "Ini bulan Febuari";
        break;

    case 'Maret':
        echo "Ini bulan Maret";
        break;        
    default:
        echo "Tidak Ada bulan";
        break;
}
echo "</br>";
echo "<hr>";
echo "</br>";

//pengkondisian Pengulangan FOR
echo "Pengkodisian Pengulangn FOR";
echo "</br>";
echo "<hr>";
$f = 5;
for ($i=0; $i < $f; $i++) { 
    echo "MIKRODATA";
    echo $i;
    echo "</br>";
}
echo "</br>";
echo "<hr>";

// BUAT PENGULANGAN DARI 10 SAMPAI 1
$g =1;
for ($j=10; $j >= $g; $j--) { 
    echo "MIKRODATA";
    echo $j;
    echo "</br>";
}
echo "</br>";
echo "<hr>";


//buat perulangan 1 sampai 10 dengan tampilan angka perulangan bilangan genap atau bilangan ganjil
for ($h=1; $h <= 10; $h++) { 
    // % sisa bagi atau modulus
    // bilangan genap adlah bialngan yang habis di bagi 2
    if (($h % 2) ==0){
        echo "bilangan genap ";
    }else{
        echo "bilangan ganjil ";
    }
    echo $h;
    echo "</br>";
}
echo "</br>";


//Array []
//Indek diawali dengan angka 0
echo "Array";
echo "</br>";
echo "<hr>";
$buah = ['mangga','apel','melon','jeruk','semangka',56,true];
echo $buah[2];//menampilkan value dengan indek ke 2
$buah[7]="jambu"; //fungsi menambahkan atai mengggantikn data array sebelmnya
echo "</br>";
echo "<hr>";
echo "</br>";

//perulangan forech
//Array dengan Looping
echo "perulangan forech";
echo "</br>";
echo "<hr>";
foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
}
echo "</br>";
//konstanta
echo "</br>";
const namaasf = "Sofyan Hadi";
echo namaasf; 
echo "</br>";
echo "<hr>";
echo " <br>";
echo " <br>";
//mencari luas persegi panjang
function luasPersegipanjang() {
    $panjang = 7;
    $lebar = 5;

    echo "Menghitung Luas Persegi Panjang";
    echo "<hr>";
    echo "panjang : $panjang cm <br>";
    echo "lebar : $lebar cm <br>";
    echo "Luas Persegi = " . ($panjang * $lebar);
    echo " cm";
}

luasPersegipanjang();
echo " <br>";
echo " <br>";


//mencari luas segitiga
function Segitiga() {
    $alas = 6;
    $tinggi = 8;

    echo "Menghitung Luas segitiga";
    echo "<hr>";
    echo "Alas : $alas cm <br>";
    echo "Tinggi : $tinggi cm <br>";
    echo "Luas Segitiga = " . (0.5 * $alas * $tinggi)." cm";
}

Segitiga();
echo " <br>";
echo " <br>";

//mencari luas Trapesium
function Trapesium() {
    $sisiA = 6;
    $sisiB = 8;
    $tinggiT =10;

    echo "Menghitung Luas Trapesium";
    echo "<hr>";
    echo "Sisi 1 : $sisiA cm <br>";
    echo "Sisi 2 : $sisiB cm <br>";
    echo "Tinggi : $tinggiT cm <br>";
    echo "Luas Trapesium = " . (0.5 * ($sisiA + $sisiB)*$tinggiT)." cm";
}

Trapesium();
echo " <br>";
echo " <br>";

//mencari luas layang-layang
function Layanglayang() {
    $diagonala1 = 6;
    $diagonala2 = 8;

    echo "Menghitung Luas Layang-layang";
    echo "<hr>";
    echo "Diagonal 1: $diagonala1 cm <br>";
    echo "Diagonal 2: $diagonala2 cm <br>";
    echo "Luas Layang-layang = " . (0.5 * $diagonala1 * $diagonala2) . " cm²";
}

Layanglayang();

echo " <br>";
echo " <br>";

//mencari luar bangun ruang prisma segitiga
function HitungLuasPrismaSegitiga($alasP, $tinggiP, $sisi1, $sisi2, $sisi3, $tinggiPrisma) {
    $hasil = [];

    $hasil[] = "Menghitung Bangun Ruang Prisma Segitiga";
    $hasil[] = "<hr>";

    $hasil[] = "Luas Permukaan alas segitiga";
    $hasil[] = "<br>";
    $hasil[] = "Alas : $alasP cm <br>";
    $hasil[] = "Tinggi : $tinggiP cm <br>";
    $totalpermukaan = 0.5 * $alasP * $tinggiP;
    $hasil[] = "Luas Permukaan Prisma = $totalpermukaan cm <br>";
    $hasil[] = "<br>";

    $hasil[] = "Luas Permukaan sisi-sisi prisma <br>";
    $hasil[] = "Sisi 1 : $sisi1 cm <br>";
    $hasil[] = "Sisi 2 : $sisi2 cm <br>";
    $hasil[] = "Sisi 3 : $sisi3 cm <br>";
    $hasil[] = "Tinggi : $tinggiPrisma cm <br>";
    $toatalsisiPrisma = ($sisi1 + $sisi2 + $sisi3) * $tinggiPrisma;
    $hasil[] = "Luas Sisi - Sisi Prisma = $toatalsisiPrisma cm <br>";
    $hasil[] = "<br>";

    $hasil[] = "Luas Permukaan Total <br>";
    $hasil[] = "Luas Permukaan Prisma = $totalpermukaan cm <br>";
    $hasil[] = "Luas Sisi - Sisi Prisma = $toatalsisiPrisma cm <br>";
    $hasil[] = "Total Luas = " . 2 * ($totalpermukaan + $toatalsisiPrisma) . " cm <br>";

    return implode("\n", $hasil);
}


$hasilPerhitungan = HitungLuasPrismaSegitiga(6,8, 4, 4, 4, 10);
echo $hasilPerhitungan;
echo " <br>";
echo " <br>";


?>