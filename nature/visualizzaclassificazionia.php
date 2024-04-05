<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Visualizza Segnalazioni Classificate Di Animali
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Visualizza Segnalazioni Classificate Di Animali</h1>
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
  $sq="SELECT * FROM classificazioneanimale";
  $result=$pdo->query($sq);
  while($row=$result->fetch()){
    $ids=$row["IDSegnalazione"];
    $sql="SELECT * FROM Segnalazione WHERE (ID='$ids')";
    $res=$pdo->query($sql);
    $res0=$res->fetch();
    $sql1="SELECT NomeLatino FROM classificazioneanimale WHERE (IDSegnalazione='$ids')";
    $res=$pdo->query($sql1);
    $res1=$res->fetch();
    echo ("ID: ".$res0["ID"]."<br>");
    echo ("Nome Habitat: ".$res0["NomeHabitat"]."<br>");
    echo ("Nickname: ".$res0["Nickname"]."<br>");
    echo ("Data: ".$res0["Data"]."<br>");
    echo '<img  height="250px" width="250px" src=data:image/jpeg;base64,'.$res0["Foto"].'>'."<br>";
    echo ("Latitudine: ".$res0["Latitudine"]."<br>");
    echo ("Longitudine: ".$res0["Longitudine"]."<br>");
    echo("Classificazione: ".$res1["NomeLatino"]."<br><br><br>");
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
