<?php
  include 'connect.php';


  $naslov = " ";
  $podnaslov = " ";
  $sadrzaj = " ";
  $kategorija = " ";
  if(isset($_POST["send"])){
      $date = date("m/d/Y");
      if(isset($_POST["naslov"])){
        $naslov = $_POST["naslov"];
      }
      if(isset($_POST["skraceniSadrzaj"])){
        $podnaslov = $_POST["skraceniSadrzaj"];
      }
      if(isset($_POST["sadrzaj"])){
        $sadrzaj = $_POST["sadrzaj"];
      }
      if(isset($_POST["kategorija"])){
        $kategorija = $_POST["kategorija"];
      }
      if(isset($_FILES["slika"])){
        $picture= $_FILES['slika']['name'];
        $target = UPLPATH.$picture;
        move_uploaded_file($_FILES['slika']['tmp_name'], "$target");
      }
      if(isset($_POST["prikaz"])){
        $prikaz = 1;
      }
      else{
        $prikaz = 0;
      }

      $query= "INSERT INTO clanak (naslov,podnaslov,kategorija,slika,sadrzaj,arhiva,datum) VALUES(?,?,?,?,?,?,?)";
      $stmt = mysqli_stmt_init($dbc);
      if(mysqli_stmt_prepare($stmt,$query)){
         mysqli_stmt_bind_param($stmt,'sssssis',$naslov,$podnaslov,$kategorija,$picture,$sadrzaj,$prikaz,$date);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
       }

      mysqli_close($dbc);
  }
 ?>
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
         <h3><a id='<?php echo $kategorija?>' href='<?php echo "kategorija.php?id=$kategorija" ?>'><span class="categoryLink"><?php echo $kategorija;?></span></a></h3>
       </nav>
         <div class='article-header'>
           <h1 id='h1article'>  <?php echo $naslov;?></h1>
           <div class='article-container'>
             <h2>  <?php echo $podnaslov;?></h2>
            <?php echo "<img class='big-image' alt='header img' src='".UPLPATH.$picture."'>";?>
           </div>
         </div>
     </header>
     <main class='article-maincontainer'>
       <span id='date'><?php echo $date; ?></span>
       <p>
         <?php echo "$sadrzaj";?>
       </p>
     </main>
     <footer>
       <ul>
         <li><a href='#'>© TITANIA COMPAÑÍA EDITORIAL, S.L. 2021. España. Todos los derechos reservados</a></li>
       </ul>
     </footer>
   </body>
   </html>
