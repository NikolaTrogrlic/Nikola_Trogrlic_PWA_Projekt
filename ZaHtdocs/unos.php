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
  <h1>Create your article</h1>
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
    <div id="form">
      <?php
      session_start();
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1) {
      echo '<form action="skripta.php" method="POST" enctype="multipart/form-data" name="unos">
        <div class="inputelement">
        <label for="naslov">Naslov članka:</label><br/>
        <input type="text" name="naslov" required/><br/>
        </div>

        <div class="inputelement">
          <label for="slika">Slika:</label>
          <input type="file" accept="image/jpg,image/gif,image/png" name="slika" required>
        </div>

        <div class="inputelement">
        <label for="kategorija">Kategorija članka:</label><br/>
          <select name="kategorija" required>
            <option></option>
            <option value="EUROPA">Europa</option>
            <option value="TEKNAUTAS">Teknautas</option>
          </select>
        </div>

        <div class="inputelement">
        <label for="skraceniSadrzaj">Skraćeni sadržaj članka:</label><br/>
        <textarea name="skraceniSadrzaj" rows="10" cols="30" ></textarea><br/>
        </div>

        <div class="inputelement">
        <label for="sadrzaj">Sadrzaj članka:</label><br/>
        <textarea name="sadrzaj" rows="10" cols="70"></textarea><br/>
        </div>

        <div class="inputelement">
          <label for="prikaz">Treba li se ovaj članak prikazivati na stranici? :
            <input type="checkbox" name="prikaz">
          </label>
        </div>

        <div class="inputelement">
          <input type="submit" name="send" value="Spremi">
          <input type="reset" value="Poništi">
        </div>
      </form>';
    }else if(!isset($_SESSION['logged_in']) || (isset($_SESION['logged_in']) && $_SESSION['logged_in'] == 0)){
      header('Location: login.php');
    }?>
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
