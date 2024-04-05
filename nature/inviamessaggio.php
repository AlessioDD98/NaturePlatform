<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Invia Messaggio</title>
<head>
  <meta charset="utf-8">
  <link href="stilef.css" rel="stylesheet" type="text/css">
  <br>
  <h1 class="card row justify-content-center align-items-center">Invia Messaggio</h1>
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
  $esito=false;
  $mittente=$_SESSION["nickname"];
  $destinatario=$_POST["destinatario"];
  $titolo=$_POST["titolo"];
  $testo=$_POST["testo"];
  $timestamp=date("Ymd H: i: s");
  if($destinatario!="" && $titolo!="" && $testo!=""){
    try{
      $sql1="CALL InviaMessaggio ('$mittente','$destinatario','$titolo','$testo')";
      $result=$pdo->exec($sql1);
      echo("Messaggio inviato con successo!");
      $esito=true;
    }catch(PDOException	$e)	{
        echo("Errore, il destinatario inserito non è registrato nel sistema.<br>");
    }
  }
  else{
    echo("Errore in fase di invio!<br>");
  }
  try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Invia Messaggio', 'esito'=> $esito];
     $bulk->insert($doc);
     $mng->executeBulkWrite('LogNATURE.log', $bulk);
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice	errore".$e->getMessage()."<br>");
     }
?>
</div>
</div>
<br>
<div class="container">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
<button type="submit" onclick="location.href='mioprofilo.php'"   class="btn btn-secondary btn-lg">Ritorna al tuo profilo</button>
</div>
</div>
</body>
</html>
