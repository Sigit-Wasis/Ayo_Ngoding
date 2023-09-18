<?php
function hitungLuasPersegiPanjang($panjang, $lebar) {
    $luas = $panjang * $lebar;
    return $luas;
}

function hitungKelilingPersegiPanjang($panjang, $lebar) {
    $keliling = 2 * ($panjang + $lebar);
    return $keliling;
}

// Contoh penggunaan fungsi:
$panjang = 9;
$lebar = 8;

$luas = hitungLuasPersegiPanjang($panjang, $lebar);
$keliling = hitungKelilingPersegiPanjang($panjang, $lebar);

echo "Luas persegi panjang dengan panjang $panjang dan lebar $lebar adalah: $luas<br>";
echo "Keliling persegi panjang dengan panjang $panjang dan lebar $lebar adalah: $keliling";
?>
