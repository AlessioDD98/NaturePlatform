<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Crea campagna
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Crea Campagna Fondi</h1>
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
$esito=false;
$nickname=$_SESSION["nickname"];
$datainizio=$_POST["datainizio"];
$importofinale=$_POST["importofinale"];
$descrizione=$_POST["descrizione"];
$sql="SELECT Categoria from Utente where nickname='$nickname'";
$res=$pdo->query($sql);
$res=$res->fetch();
if($res['Categoria']=="Amministratore"){
if($datainizio!="" && $importofinale!=0){
  try{
    $sql1="CALL CreaCampagna ('$nickname','$datainizio','$importofinale','$descrizione')";
    $result=$pdo->exec($sql1);
    echo("Campagna fondi creata con successo!");
    $esito=true;
  }catch(PDOException	$e)	{
      echo("Errore, la campagna fondi non è stata inserita nel sistema.<br>");
  }
}
else{
  echo("Errore in fase di creazione!<br>");
}
try {
   $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
   $bulk = new MongoDB\Driver\BulkWrite();
   $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Creazione Campagna', 'esito'=> $esito];
   $bulk->insert($doc);
   $mng->executeBulkWrite('LogNATURE.log', $bulk);
   } catch (MongoDB\Driver\Exception\Exception $e) {
  echo("Codice	errore".$e->getMessage()."<br>");
   }
 }
 else{
    echo "Utente non autorizzato";
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
