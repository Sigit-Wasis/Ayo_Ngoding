<?php
function hitungLuasSegitiga($alas, $tinggi) {
    $luas = (1/2) * $alas * $tinggi;
    return $luas;
}

// Contoh penggunaan fungsi:
$alas = 4;
$tinggi = 5;

$luasSegitiga = hitungLuasSegitiga($alas, $tinggi);

echo "Luas segitiga dengan alas $alas dan tinggi $tinggi adalah: $luasSegitiga";

echo "</br>";
echo "<hr>";

function hitungluaspersegipanjang ($Panjang, $Lebar){
    $Luas = ($Panjang * $Lebar);
    return $Luas;

}
$Panjang = 6;
$Lebar = 5;

$luaspersegipanjang = hitungluaspersegipanjang($Panjang, $Lebar);

echo "Luas persegi panjang dengan lebar $Panjang dan panjang $Lebar adalah: $luaspersegipanjang";

echo "</br>";
echo "<hr>";
?>
