<?php
function hitungluaspersegipanjang ($Panjang, $Lebar){
    // UNTUK MENGHITUNG
    $Luas = $Panjang * $Lebar;
    return $Luas;

}

// MENENTUKAN NILAI LUAS PERSEGI PANJANG
$Panjang = 6;
$Lebar = 3;

$luaspersegipanjang = hitungluaspersegipanjang($Panjang, $Lebar);

// MENAMPILKAN HASIL

echo "Luas persegi panjang dengan lebar $Panjang * $Lebar = $luaspersegipanjang";

echo "</br>";
echo "<hr>";


?>