<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Latihan Soal Algoritma Bahasa PHP</title>
  <style>
    body   { text-align: center; font-family: "Trebuchet MS", serif; }
    h1,h2  { margin-bottom: 0; }
    hr     { width: 80%; }
    form   { margin-top: 2rem; }
    canvas { margin: 1.4rem; }
    p      { margin:0.1rem }
    .result {
      margin: 1rem auto; 
      padding: 0.25rem 0.25rem 1rem 0.25rem;
      background-color: ghostwhite;
      width: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  </style>
</head>
<body>
  <h1>Kode Program PHP - Keliling dan Luas Persegi</h1>
  <hr>
  <form action="" method="post">
    <div>
      Panjang Sisi Persegi: <input type="text" name="sisi" size="1">
      <input type="submit" name="submit">
    </div>
  </form>
   
    <?php
      if (isset($_POST['submit'])) {
        $sisi = $_POST['sisi'];
 
        echo "<div class='result'>";
        echo "<h2>Hasil Kode Program</h2>";
        echo "<span>(panjang sisi persegi: $sisi)</span>";
    ?>
        <canvas id="myCanvas" width="100px" height="100px"></canvas>
        <script>
          var c = document.getElementById("myCanvas");
          var ctx = c.getContext("2d");
          ctx.beginPath();
          ctx.rect(0, 0, 100, 100);
          ctx.stroke();
        </script> 
    <?php
        $keliling_persegi = 4 * $sisi;
        $luas_persegi = $sisi * $sisi;
 
        echo "<p>Keliling persegi = (4 x $sisi) = $keliling_persegi </p>";
        echo "<p>Luas persegi = ($sisi x $sisi) = $luas_persegi </p>";
        echo "</div>";
      }
    ?>
   
</body>
</html>