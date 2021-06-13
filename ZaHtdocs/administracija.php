<?php
include'connect.php';
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>El Confidencial</title>
  <script type="text/javascript" src="jquery-1.11.0.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <script src="js/form-validation.js"></script>
</head>
<body>
  <header>
    <h1><?php echo "Administracija"; ?></h1>
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
  <main>
    <div class="center">

     <?php
     session_start();
     if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
       if($_SESSION['razina'] == 1){
       echo'
       <span class="centerText">Dobrodošli, '.$_SESSION["ime"].' '.$_SESSION["prezime"].'</span>
       <a href="logout.php" id="logoutButton" class="centerText">
       Log out
       </a>
       <form method="POST">
         <div class="inputelement">
         <label for="selectclanak">Izaberite članak za editiranje</label><br/>
         <select name="selectclanak">';
           $query= "SELECT * FROM clanak ORDER BY id ASC";
           $result = mysqli_query($dbc,$query);
           $i = 0;
           while($row= mysqli_fetch_array($result)){
             $id = $row['id'];
             $naslov = $row['naslov'];
             echo "<option value=".$id.">".$naslov."</option>";
             $i = $i + 1;
           }
           if($i == 0){
             echo "<h4> Trenutno nema vjesti </h4>";
           }
         echo'</select><br/>
      </div>
      <div class="inputelement">
          <input type="submit" value="Edit" name="edit">
        </div></form>';
       if(isset($_POST["edit"])){
         $query = "SELECT slika,id,datum,naslov,sadrzaj,podnaslov,kategorija FROM clanak WHERE id= ?";//$_POST["selectedclanak"]
         $stmt= mysqli_stmt_init($dbc);
         if(mysqli_stmt_prepare($stmt, $query)){
           mysqli_stmt_bind_param($stmt, 'i', $_POST["selectclanak"]);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
         }
         mysqli_stmt_bind_result($stmt,$slika,$id,$datum,$naslov,$sadrzaj,$podnaslov,$kategorija);
         mysqli_stmt_fetch($stmt);
           echo '
           <form method="POST" enctype="multipart/form-data" name="unos">
           <div class="inputelement">
           <label for="naslov">Naslov članka:</label><br/>
           <input type="text" name="naslov" value="'.$naslov.'"required/><br/>
           </div>

           <div class="inputelement">
             <label for="picture">Slika:</label>
             <input type="file" accept="image/jpg,image/gif,image/png" name="picture"><br/>
             <img src="'.UPLPATH.$slika.'" width="100px"/><br/>
           </div>

           <div class="inputelement">
           <label for="kategorija">Kategorija članka:</label><br/>
             <select name="kategorija" value="'.$kategorija.'">';
              if($kategorija == "EUROPA"){
                echo '<option value="EUROPA" selected>Europa</option>
                <option value="TEKNAUTAS">Teknautas</option>';
              }
              else{
                echo '<option value="EUROPA">Europa</option>
                <option value="TEKNAUTAS" selected>Teknautas</option>';
              }
            echo'
             </select>
           </div>

           <div class="inputelement">
           <label for="skraceniSadrzaj">Skraćeni sadržaj članka:</label><br/>
           <textarea name="skraceniSadrzaj" rows="10" cols="30">'.$podnaslov.'</textarea><br/>
           </div>

           <div class="inputelement">
           <label for="sadrzaj">Sadrzaj članka:</label><br/>
           <textarea name="sadrzaj" rows="10" cols="70">'.$sadrzaj.'</textarea><br/>
           </div>
           <input type="hidden" name="id" value="'.$row['id'].'">
           <div class="inputelement">
             <label for="prikaz">Treba li se ovaj članak prikazivati na stranici? :';
             if($row['arhiva'] == 1){
               echo'<input type="checkbox" name="prikaz" checked>';
             }else{
               echo'<input type="checkbox" name="prikaz">';
             }
          echo '
             </label>
           </div>

           <div class="inputelement">
             <input type="submit" name="update" value="Spremi promjene">
             <input type="submit" name="delete" value="Izbriši članak">
           </div>
           </form>';
        }
         elseif(isset($_POST["update"])){
           $title=$_POST['naslov'];
           $about=$_POST['skraceniSadrzaj'];
           $content=$_POST['sadrzaj'];
           $category=$_POST['kategorija'];
           if(isset($_POST['prikaz'])){
             $archive=1;
           }else{
             $archive=0;
           }
             $id=$_POST['id'];
             $query= "UPDATE clanak SET naslov=?, podnaslov=?, sadrzaj=?, kategorija=?, arhiva=? WHERE id=?";
             $stmt= mysqli_stmt_init($dbc);
             $picture= $_FILES["picture"]['name'];
             if($_FILES["picture"]["error"] == 0){
            //U slucaju da se slika ne uploada pravilno ili se ne promjeni uopce, ostavljamo staru sliku
              echo $_FILES["picture"]["error"];
             $target_dir= UPLPATH.$picture;
             move_uploaded_file($_FILES["picture"]["tmp_name"], $target_dir);
             $query= "UPDATE clanak SET naslov=?, podnaslov=?, sadrzaj=?, slika=?, kategorija=?, arhiva=? WHERE id=?";
            if(mysqli_stmt_prepare($stmt, $query)){
              mysqli_stmt_bind_param($stmt, 'sssssii', $title, $about, $content, $picture, $category,$archive,$id);
              mysqli_stmt_execute($stmt);
            }
          }else{
            if(mysqli_stmt_prepare($stmt, $query)){
              mysqli_stmt_bind_param($stmt, 'ssssii', $title, $about, $content, $category,$archive,$id);
              mysqli_stmt_execute($stmt);
            }
          }
         }
         elseif(isset($_POST['delete'])){
           $id=$_POST['id'];
           $query= "DELETE FROM clanak WHERE id=?";
           $stmt= mysqli_stmt_init($dbc);
           if(mysqli_stmt_prepare($stmt, $query)){
             mysqli_stmt_bind_param($stmt, 'i', $id);
             mysqli_stmt_execute($stmt);
           }
         }
         mysqli_close($dbc);
       }
       elseif($_SESSION['razina'] == 0){
         echo'<span class="centerText">Dobrodošli, '.$_SESSION["ime"].' '.$_SESSION["prezime"].'.Trenutno nemate admin prava.</span>
         <a href="logout.php" id="logoutButton" class="centerText">
         Log out
         </a>';
       }
     }else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
       header('Location: login.php');
     }
       ?>
    </div>
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
