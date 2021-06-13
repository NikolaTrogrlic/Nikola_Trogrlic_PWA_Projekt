<?php
include'connect.php';

$kategorija = "EUROPA";
if(isset($_GET["id"])){
  $kategorija = $_GET["id"];
}?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>El Confidencial</title>

</head>
<body>
  <header>
    <h1><?php echo "$kategorija"; ?></h1>
    <nav>
      <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="kategorija.php?id=EUROPA">EUROPA</a></li>
        <li><a href="kategorija.php?id=TEKNAUTAS">TEKNAUTAS</a></li>
        <li><a href="administracija.php">ADMINISTRACIJA</a></li>
        <li><a href="unos.php">UNOS ČLANKA</a></li>
      </ul>
    </nav>
  </header>
  <main class="center">
    <?php
      $query= "SELECT slika,id,datum,podnaslov,sadrzaj FROM clanak WHERE kategorija=? ORDER BY RAND()";
      $stmt = mysqli_stmt_init($dbc);
      if(mysqli_stmt_prepare($stmt,$query)){
         mysqli_stmt_bind_param($stmt,'s',$kategorija);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
       }
      $i = 0;
      $rows = mysqli_stmt_num_rows($stmt);
       if($rows >0){
        mysqli_stmt_bind_result($stmt, $slika,$id,$datum,$naslov,$sadrzaj);
        while($i < $rows){
        mysqli_stmt_fetch($stmt);
        echo "<article class='clanak'>
        <p class='published'>$datum</p>
        <img class='article-image-big' alt='article$i' src='".UPLPATH.$slika."'>
        <h4><a href='clanak.php?id=$id'>$naslov</a></h4>";
        echo substr($sadrzaj,0,110)."...";
        echo "</article>";
        $i = $i + 1;
        }
      }
      if($i == 0){
        echo "<h4> Trenutno nema vjesti u ovoj kategoriji </h4>";
      }
     ?>
  </main>
  <footer>
    <ul>
      <li><a href="#">© TITANIA COMPAÑÍA EDITORIAL, S.L. 2021. España. Todos los derechos reservados</a></li>
      <li><a href="#">Condiciones</a></li>
      <li><a href="#">Política de Privacidad</a></li>
      <li><a href="#">Política de Cookies</a></li>
      <li><a href="#">Transparencia</a></li>
      <li><a href="#">Auditado por Comscore </a></li>
    </ul>
  </footer>
</body>
</html>
