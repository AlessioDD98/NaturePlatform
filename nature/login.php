<html lang="en">
<br>
<body>
<div>
<?php
//Connessione al db
  try {
    $pdo=new PDO('mysql:host=localhost;dbname=nature','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo("[ERRORE] Connessione al DB non riuscita. Errore: ".$e->getMessage()."<br>");
    exit();
  }
  $nickname=$_POST["nickname"];
  $nickname = str_replace("'", "", $nickname);
  $password=md5($_POST["password"]);
  $sql="SELECT * from Utente WHERE(nickname='$nickname')&&(password='$password')";
  $res=$pdo->query($sql);
  $res=$res->fetch();
  if($res){
    session_start();
    $_SESSION["log"]=true;
    $_SESSION["nickname"]=$nickname;
    header("Location: mioprofilo.php");
  }
  else{
    include("login.html");
    echo "<div class='col-md-3 mx-auto text-white'><b>&emsp;&emsp;&emsp;&emsp;Nickname e/o Password errati!</b></div>";
  }
?>
</div>
<br>
</body>
</html>
