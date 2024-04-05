<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Ricerca Utente
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Ricerca Utente</h1>
</head>
<body>
<br>
<div class="container col-md-3">
  <div class="row justify-content-center align-items-center bg-white">
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
  echo ("Utente cercato: ".$nickname)."<br><br>";
  $sql="SELECT email,professione,dataregistrazione,annonascita,foto from Utente WHERE nickname='$nickname'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
  if($res){
    echo ("Nickname: ".$nickname."<br>");
    echo ("Email: ".$res["email"]."<br>");
    echo ("Professione: ".$res["professione"]."<br>");
    echo ("Data Registrazione: ".$res["dataregistrazione"]."<br>");
    echo ("Anno nascita: ".$res["annonascita"]."<br>");
    echo '<img  height="300px" width="300px" src=data:image/jpeg;base64,'.$res["foto"].'>'."<br>";
  }
  else{
    echo ("Utente non trovato");
  }
?>
</div>
</div>
<div class="container">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
<button type="submit" onclick="location.href='mioprofilo.php'"   class="btn btn-secondary btn-lg">Ritorna al tuo profilo</button>
</div>
</div>
</body>
</html>
