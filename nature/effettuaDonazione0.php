<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Effettua Donazione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Effettua Donazione</h1>
</head>
<body>
<br>
<form name="form_donazione" method="post" action="effettuaDonazione.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
          <input type="number" name="campagna" class="form-control"  placeholder="ID Campagna*" aria-label="ID Campagna" aria-describedby="basic-addon1">
      </div>">
      <div class="form-group">
          <input type="number" name="importo" class="form-control"  placeholder="Importo*" aria-label="Importo" aria-describedby="basic-addon1">
      </div>
      <div class="form-group">
        <input type="text" name="note" class="form-control"  placeholder="Note" aria-label="Note" aria-describedby="basic-addon1">
      </div>
    </div>
    <div class="container">
      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
        <button type="submit" class="btn btn-secondary btn-lg">Inserisci</button>
      </div>
    </div>
  </div>
    <p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p>
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
$sql="SELECT * FROM Campagna WHERE Stato='Aperto'";
$res=$pdo->query($sql);
while($row=$res->fetch()){
  echo ("ID:".$row["ID"]."<br>");
  echo ("Nickname creatore:".$row["NicknameCreatore"]."<br>");
  echo ("Importo finale:".$row["ImportoFinale"]."<br>");
  echo ("Data inizio:".$row["DataInizio"]."<br>");
  echo ("Descrizione:".$row["Descrizione"]."<br><br><br>");
}
?>
</div>
</div>
</body>
</html>
