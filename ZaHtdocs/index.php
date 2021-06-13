<?php
include'connect.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>El Confidencial</title>

</head>
<body>
  <header>
    <h1>El Confidencial</h1>
    <h2>EL DIARIO DE LOS LECTORES INFLUYENTES</h2>
    <nav>
      <ul>
        <li><a href="#">HOME</a></li>
        <li><a href="kategorija.php?id=EUROPA">EUROPA</a></li>
        <li><a href="kategorija.php?id=TEKNAUTAS">TEKNAUTAS</a></li>
        <li><a href="administracija.php">ADMINISTRACIJA</a></li>
        <li><a href="unos.php">UNOS ČLANKA</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section>
      <h3><a id="EUROPA" href="kategorija.php?id=EUROPA"><span class="categoryLink">EUROPA</span></a></h3>
      <?php
        $query= "SELECT * FROM clanak WHERE arhiva=1 AND kategorija='EUROPA' ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($dbc,$query);
        $i = 0;
        while($row= mysqli_fetch_array($result)){
          $slika = $row['slika'];
          $id = $row['id'];
          $datum = $row['datum'];
          $naslov = $row['naslov'];
          echo "<article><img class='article-image' alt='article$i' src='".UPLPATH.$slika."'><h4><a href='clanak.php?id=$id'>$naslov</a></h4>";
          echo "<p class='published'>$datum</p>";
          echo "</article>";
          $i = $i + 1;
        }
        if($i == 0){
          echo "<h4> Trenutno nema vjesti u ovoj kategoriji </h4>";
        }
       ?>
    </section>
    <section>
      <h3><a id="TEKNAUTAS" href="kategorija.php?id=TEKNAUTAS"><span class="categoryLink">TEKNAUTAS</span></a></h3>
      <?php
        $query= "SELECT * FROM clanak WHERE arhiva=1 AND kategorija='TEKNAUTAS' ORDER BY RAND() LIMIT 3";
        $result = mysqli_query($dbc,$query);
        $i = 0;
        while($row= mysqli_fetch_array($result)){
          $slika = $row['slika'];
          $id = $row['id'];
          $datum = $row['datum'];
          $naslov = $row['naslov'];
          echo "<article><img class='article-image' alt='article$i' src='".UPLPATH.$slika."'><h4><a href='clanak.php?id=$id'>$naslov</a></h4>";
          echo "<p class='published'>$datum</p>";
          echo "</article>";
          $i = $i + 1;
        }
        if($i == 0){
          echo "<h4> Trenutno nema vjesti u ovoj kategoriji </h4>";
        }
        mysqli_close($dbc);
       ?>
    </section>
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
