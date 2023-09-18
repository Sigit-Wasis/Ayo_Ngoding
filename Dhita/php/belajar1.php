<?php 
 echo "My Internship";
 echo "<br/>";
 echo "<hr/>";

 echo "Hello it's Me";
 echo "<br/>";
 echo "<hr/>";

// OPERATORS
$angka1 = 10;
$angka2 = 20;

// PENJUMLAHAN
echo "penjumlahan 10 + 20 = ";
echo $angka1 + $angka2;

echo "<br/>";
echo "<hr/>";


// PERKALIAN 
echo "perkalian 10 * 20 = ";
echo $angka1 * $angka2;

echo "<br/>";
echo "<hr/>";


// PENGURANGAN
echo "pengurangan 10 - 20 = ";
echo $angka1 - $angka2;

echo "<br/>";
echo "<hr/>";


// PEMBAGIAN
echo "pembagian 10 / 20 = ";
echo $angka1 / $angka2;

echo "<br/>";
echo "<hr/>";

// PEMANGKATAN
echo "pemangkatan 10 ** 20 = ";
echo $angka1 ** $angka2;

echo "<br/>";
echo "<hr/>";

// SISA BAGI
echo "sisa bagi 10 % 20 = ";
echo $angka1 % $angka2;

echo "<br/>";
echo "<hr/>";

// OPERATOR INCREMENT DAN DESCEMENT
echo "OPERATOR INCREMENT DAN DESCREMENT ";
echo "<br/>";
$a = 5;
$b = 4;

$a++; //+1
$b--; //-1

echo "Increment 5 = ";
echo $a;
echo "<br/>";

echo "Descrement 4 = ";
echo $b;
echo "<br/>";
echo "<hr/>";

// OPERATOR LOGIKA 
echo "OPERATOR LOGIKA";
echo "<br/>";
$c = 7;
$d = 4;

// LEBIH BESAR (>)
echo "Lebih besar = ";
echo $c > $d; // 1 atau true
echo "<br/>";
echo "<hr/>";

// LEBIH KECIL (<)
echo "Lebih kecil = ";
echo $c < $d; // 0 atau false 
echo "<br/>";
echo "<hr/>";

// SAMA DENGAN (==)
echo "Sama Dengan = ";
echo $c == $d; // 0 atau false 
echo "<br/>";
echo "<hr/>";

// TIDAK SAMA DENGAN (!=)
echo "Tidak Sama Dengan = ";
echo $c != $d; // 0 atau false 
echo "<br/>";
echo "<hr/>";

// LEBIH BESAR SAMA DENGAN (>=)
echo "Lebih besar sama dengan = ";
echo $c >= $d; // 0 atau false 
echo "<br/>";
echo "<hr/>";

// LEBIH KECIL SAMA DENGAN (<=)
echo "Lebih Kecil sama dengan = ";
echo $c <= $d; // 0 atau false 
echo "<br/>";
echo "<hr/>";

// PENGKONDOSIAN IF ELSE
/* IF (KONDISI) {
    JIKA KONDISI TERPENUHI
} ELSE {
    JIKA KONDISI TIDAK TERPENUHI
}
*/
//contoh!!
$teman = "budi";

if ($teman == "andi"){
    echo "benra teman saya budi";
} else {
    echo "bukan teman saya";
}
echo "<br/>";
echo "<hr/>";

// jika $c tidak sama dengan $d maka tampilkan benar selain itu salah
if ($c != $d) {
    echo "benar";
}else{ 
    echo "salah";
}

    echo "<br/>";

// jika $c lebih besar sama dengan $d maka tampilkan benar selain itu salah
if ($c >= $d) {
        echo "benar";
 }else{
    echo "salah";
 }
 
 echo "<br/>";
 echo "<hr/>";

// PENGKONDISIAN SWITCH CASE
echo "PENGKONDISIAN SWITCH CASE";
echo "<br/>";

$bulan = "Februari";
switch ($bulan) {
    case "Januari":
      echo "Ini bulan Januari";
      break;
    case "Februari":
      echo "Ini bulan Februari";
      break;
    case "Maret":
      echo "Ini bulan Maret";
      break;
    default:
    echo "Tidak ada Bulan"; 
    break;
    }

    echo "<br/>";
    echo "<hr/>";

// PERULANGAN 
echo "PERULANGAN ";
echo "<br/>";
echo "<hr/>";

$f = 10;
for ($i=0; $i < $f; $i++) {
    echo "Microdata";
    echo $i;
    echo "<br/>";
}

echo "<br/>";
echo "<hr/>";

$f = 1;
for ($i=10; $i >= $f; $i--) {
    echo "Micro";
    echo $i;
    echo "<br/>";
}
echo "<br/>";
echo "<hr/>";

for ($h=1; $h <= 10; $h++) {
    if (($h % 2 ) == 0) {
        echo "bilangan genap";
    }else{
        echo "bilangan ganjil";
    }
    echo $h;
    echo "</br>";
    
}

// ARRAY 
echo "<hr/>";
echo "ARRAY";
echo "</br>";
// Index diawali dengan angka 0
$buah = ['mangga', 'apel','jeruk','durian','pisang',16, true];

echo $buah[3];
$buah[4]="semangka";


echo "<hr/>";
echo "</br>";
// PERULANGAN 

foreach ($buah as $value) {
    var_dump($value);
    echo "</br>";
}

?>