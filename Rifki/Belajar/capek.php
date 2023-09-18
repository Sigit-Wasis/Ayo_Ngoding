<?php
function hitungluaspersegipanjang ($Panjang, $Lebar){
    $Luas = $Panjang * $Lebar;
    return $Luas;

}

// MENGHITUNG LUAS PERSEGI PANJANG
$Panjang = 6;
$Lebar = 3;

$luaspersegipanjang = hitungluaspersegipanjang($Panjang, $Lebar);

// MENAMPILKAN HASIL

echo "Luas persegi panjang dengan lebar $Panjang * $Lebar = $luaspersegipanjang";

echo "</br>";
echo "<hr>";


?>
