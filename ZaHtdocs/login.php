<!DOCTYPE html>
<?php
include'connect.php';?>
<html>
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
    <h1>Log in/Register</h1>
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
  <div class="center" id="loginforma">
  <form method="POST" name="loginform">
    <label for="username">Korisničko Ime:</label>
    <input type="text" maxlength="30" name="username"></input>
  </br></br>
    <label for="password">Lozinka:</label>
    <input type="password" name="password"></input>
  </br></br>
<hr/>
<p> Ako ste novi korisnik također ispunite podatke ispod</p>
    <label for="password">Ponovite Lozinku:</label>
    <input type="password" name="password2"></input>
  </br></br>
    <label for="ime">Ime:</label>
    <input type="text" name="ime"></input>
  </br></br>
    <label for="prezime">Prezime:</label>
    <input type="text" name="prezime"></input>
  </br></br>
<hr/>
    <input type="submit" name="Login" value="Log in"></input>
    <input type="submit" name="Register" value="Register"></input>
  </form>
  <?php
    session_start();

    if(isset($_POST["Login"]) || isset($_POST["Register"])){
      $lozinka = $_POST["password"];
      $username = $_POST["username"];
      if($dbc){
        if(isset($_POST["Login"])){
          $query1="SELECT lozinka,ime,prezime,razina FROM korisnik WHERE korisnicko_ime=?";
          $stmt = mysqli_stmt_init($dbc);
          if(mysqli_stmt_prepare($stmt,$query1)){
            mysqli_stmt_bind_param($stmt,'s',$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
          }
             if(mysqli_stmt_num_rows($stmt)>0){
                mysqli_stmt_bind_result($stmt,$lozinkabaze,$ime,$prezime,$razina);
                mysqli_stmt_fetch($stmt);
                if (password_verify($lozinka, $lozinkabaze)){
                  $_SESSION['username'] = $username;
                  $_SESSION['razina'] = $razina;
                  $_SESSION['logged_in'] = 1;
                  $_SESSION['ime'] = $ime;
                  $_SESSION['prezime'] = $prezime;
                  header("Location: index.php");
                }
                else{
                  echo 'Pogrešna lozinka!';
                }
        }
        else{
          echo 'Korisnik nije registriran.';
        }
      }
      else if(isset($_POST["Register"])){
        if(isset($_POST["prezime"]) && isset($_POST["ime"])){
            $ime = $_POST["ime"];
            $prezime = $_POST["prezime"];
            $lozinka2 = $_POST["password2"];
            $stmt = mysqli_stmt_init($dbc);
            if(strlen($ime) > 1 || strlen($prezime) > 1){
              if($lozinka2 == $lozinka){
            $hashed_password = password_hash($lozinka,CRYPT_BLOWFISH);
            $query1="SELECT * FROM korisnik WHERE korisnicko_ime=?";
            if(mysqli_stmt_prepare($stmt,$query1)){
            mysqli_stmt_bind_param($stmt,'s',$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            }
            if(mysqli_stmt_num_rows($stmt)==0){
              $query2="INSERT INTO korisnik (korisnicko_ime,lozinka,razina,ime,prezime) values (?, ?,0,?,?)";
              $stmt = mysqli_stmt_init($dbc);
              if(mysqli_stmt_prepare($stmt,$query2)){
              mysqli_stmt_bind_param($stmt,'ssss',$username,$hashed_password,$ime,$prezime);
              mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);
              }
              echo "Registracija je uspješna";
            }
            else{
              echo "Korisničko ime se već koristi";
            }
          }else{
            echo "Lozinke se moraju podudarati";
          }
        }else{
          echo "Niste upisali ime i prezime!";
        }
      }
        else{
          echo "Niste upisali ime i prezime!";
        }
      }
    }
    else{
      echo 'Error pri spajanju s bazom, pokušajte ponovno';
    }
    mysqli_close($dbc);
  }
  ?>
  </div>
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
