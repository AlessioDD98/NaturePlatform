<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Iscrizione Escursione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Iscrizione Escursione</h1>
</head>
<body>
<br>
<form name="form_registration" method="post" action="iscrizioneescursione.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
        <input type="number" name="IDEscursione" class="form-control"  placeholder="ID Escursione*" aria-label="IDEscursione" aria-describedby="basic-addon1">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <button type="submit" class="btn btn-secondary btn-lg">Iscriviti</button>
    </div>
<p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p>
<br><br>
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
  $sql="SELECT * FROM escursione";
  $res=$pdo->query($sql);
  while($row=$res->fetch()){
    echo ("ID: ".$row["ID"]."<br>");
    echo ("Nickname: ".$row["NicknameCreatore"]."<br>");
    echo ("Titolo: ".$row["Titolo"]."<br>");
    echo ("Orario di partenza: ".$row["OrarioPartenza"]."<br>");
    echo ("Orario di ritorno: ".$row["OrarioRitorno"]."<br>");
    echo ("Numero massimo di partecipanti: ".$row["NumeroMaxPartecipanti"]."<br>");
    echo ("Descrizione: ".$row["Descrizione"]."<br>");
    echo ("Data: ".$row["Data"]."<br>");
    echo ("Tragitto: ".$row["Tragitto"]."<br><br>");
  }
?>
</div>
</div>
</body>
</html>
