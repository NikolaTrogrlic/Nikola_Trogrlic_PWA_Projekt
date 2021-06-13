<?php
include'connect.php';

if(isset($_GET["id"])){
  $id = $_GET["id"];
}

$query= "SELECT * FROM clanak WHERE id='$id' ";
$result = mysqli_query($dbc,$query);
while($row= mysqli_fetch_array($result)){
  $picture = $row['slika'];
  $datum = $row['datum'];
  $naslov = $row['naslov'];
  $kategorija = $row['kategorija'];
  $sadrzaj = $row['sadrzaj'];
  $podnaslov = $row['podnaslov'];
  echo "
<!DOCTYPE html>
   <html lang='es'>
   <head>
     <meta charset='UTF-8'>
     <link rel='stylesheet' type='text/css' href='style.css'>
     <title>El Confidencial Article</title>
   </head>
   <body>
     <header>
       <nav class='nav'>
         <h3><a id='$kategorija' href='kategorija.php?id=$kategorija'><span class='categoryLink'>$kategorija</span></a></h3>
       </nav>
         <div class='article-header'>
           <h1 id='h1article'>$naslov</h1>
           <div class='article-container'>
             <h2>$podnaslov</h2>
            <img class='big-image' alt='header img' src='".UPLPATH.$picture."'>
           </div>
         </div>
     </header>
     <main class='article-maincontainer'>
       <span id='date'>$datum</span>
       <p>
         $sadrzaj
       </p>
     </main>
     <footer>
       <ul>
         <li><a href='#'>© TITANIA COMPAÑÍA EDITORIAL, S.L. 2021. España. Todos los derechos reservados</a></li>
       </ul>
     </footer>
   </body>
   </html>";
   }
   ?>
