<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<head>
  <link href="stilef.css" rel="stylesheet" type="text/css">
  <br>
  <h1 class="card row justify-content-center align-items-center">Il Mio Profilo</h1>
</head>
<body>
<br>
<div class="container col-md-3">
  <div class="row justify-content-center align-items-center bg-white">
<?php
  try {
    $pdo=new PDO('mysql:host=localhost;dbname=nature','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo("[ERRORE] Connessione al DB non riuscita. Errore: ".$e->getMessage()."<br>");
    exit();
  }
  $nickname=$_SESSION["nickname"];
  $sql="SELECT email,professione,dataregistrazione,annonascita,foto from Utente WHERE nickname='$nickname'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
  echo ("Nickname:".$_SESSION["nickname"]."<br>");
  echo ("Email: ".$res["email"]."<br>");
  echo ("Professione: ".$res["professione"]."<br>");
  echo ("Data Registrazione: ".$res["dataregistrazione"]."<br>");
  echo ("Anno nascita: ".$res["annonascita"]."<br>");
  if($res["foto"]!=""){
    echo '<img  height="300px" width="300px" src=data:image/jpeg;base64,'.$res["foto"].'>'."<br>";
  }
    ?>
</div>
</div>
</body>
</html>
