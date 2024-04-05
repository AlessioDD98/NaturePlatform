<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<head>
<title>
Visualizza Segnalazioni
</title>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Visualizza Segnalazioni</h1>
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
  $sql="SELECT * FROM Segnalazione";
  $res=$pdo->query($sql);
  while($row=$res->fetch()){
    echo ("ID: ".$row["ID"]."<br>");
    echo ("Nome Habitat: ".$row["NomeHabitat"]."<br>");
    echo ("Nickname: ".$row["Nickname"]."<br>");
    echo ("Data: ".$row["Data"]."<br>");
    echo '<img  height="250px" width="250px" src=data:image/jpeg;base64,'.$row["Foto"].'>'."<br>";
    echo ("Latitudine: ".$row["Latitudine"]."<br>");
    echo ("Longitudine: ".$row["Longitudine"]."<br><br><br>");
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
