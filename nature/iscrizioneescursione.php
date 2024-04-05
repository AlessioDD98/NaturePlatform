<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Iscrizione Escursione</title>
<head>
  <meta charset="utf-8">
  <link href="stilef.css" rel="stylesheet" type="text/css">
  <br>
  <h1 class="card row justify-content-center align-items-center">Iscrizione Escursione</h1>
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
$nickname=$_SESSION["nickname"];
$IDEscursione=$_POST["IDEscursione"];
try{
  $sql="SELECT count(*) FROM Iscrizione WHERE IDEscursione='$IDEscursione'";
  $numiscrizioni=$pdo->query($sql);
  $numiscrizioni=$numiscrizioni->fetch();
}catch(PDOException	$e)	{
}
try{
  $sql2="SELECT NumeroMaxPartecipanti FROM Escursione WHERE (ID=$IDEscursione)";
  $nummaxpart=$pdo->query($sql2);
  $nummaxpart=$nummaxpart->fetch();
}catch(PDOException	$e)	{
}
if($IDEscursione!="0" && $numiscrizioni[0]<$nummaxpart[0]){
  try{
    $sql1="CALL IscrizioneEscursione('$nickname','$IDEscursione')";
    $result=$pdo->exec($sql1);
    echo("Iscrizione avvenuta con successo!");
    $esito=true;
  }catch(PDOException	$e)	{
      echo("Errore, l'iscrizione all'escursione non è stata inserita nel sistema.<br>");
  }
}
else{
  echo("Errore in fase di iscrizione!<br>");
}
try {
   $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
   $bulk = new MongoDB\Driver\BulkWrite();
   $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Iscrizione Escursione', 'esito'=> $esito];
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
</div></body>
</html>
