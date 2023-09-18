<?php

function Luaspersegi() {
 
  echo "Keliling dan Luas Persegi";
  echo "<hr>";
 
  $sisi = 20;
  $panjang = 10;
  $lebar = 10;
 
  $keliling_persegi = 4 * $sisi;
  $luas_persegi = $sisi * $sisi;
   
  echo "sisi persegi = $sisi <br>";
  echo "Keliling persegi = (4 x $sisi) = $keliling_persegi <br>";
  echo "Luas persegi = ($sisi x $sisi) = $luas_persegi <br>";

  echo "<br>";
  echo "<hr>";

  echo "Keliling dan Luas Segitiga";
  echo "<hr>";
 
  $alas = 10;
  $tinggi = 15;
 
  $sisi_miring = sqrt(($alas * $alas) + ($tinggi * $tinggi));
  $keliling_segitiga = $alas + $tinggi + $sisi_miring;
  $luas_segitiga = 1/2 * $alas * $tinggi;
 
  echo "Alas segitiga = $alas <br>";
  echo "Tinggi segitiga = $tinggi <br>";
 
  echo "<br>";
 
  echo "Sisi miring segitiga = ". round($sisi_miring,2) ." <br>";
  echo "Keliling segitiga = ". round($keliling_segitiga,2) ."<br>";
  echo "Luas segitiga = ". round($luas_segitiga,2) ."<br>";

  echo "<br>";
  echo "<hr>";

  function luasBelahKetupat($diagonal1, $diagonal2) {
    // Menghitung luas belah ketupat
    $luas = ($diagonal1 * $diagonal2 * 0.5) ;
    return $luas;
    }

    // Contoh penggunaan fungsi
    $diagonal1 = 8;
    $diagonal2 = 6;

  echo "Luas belah ketupat dengan diagonal $diagonal1 dan $diagonal2 adalah: " . luasBelahKetupat($diagonal1, $diagonal2,) . "<br>";

}
Luaspersegi();
?>