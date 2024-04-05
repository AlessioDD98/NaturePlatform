<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
  Correzione Classificazione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Correzione Classificazione</h1>
</head>
<body>
<br>
<br
<div class="container col-md-3">
  <div class="row justify-content-center align-items-center bg-white">
<?php
  try {
    $pdo=new PDO('mysql:host=localhost;dbname=NATURE','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo("[ERRORE] Connessione al DB non riuscita. Errore: ".$e->getMessage()."<br>");
    exit();
  }
  $esito=false;
  $nickname=$_SESSION["nickname"];
  $segnalazione=$_POST["segnalazione"];
  $tipospecie=$_POST["tipospecie"];
  $specie=$_POST["specie"];
  $sql="SELECT Categoria from Utente where nickname='$nickname'";
  $res=$pdo->query($sql);
   $res=$res->fetch();
   if($res['Categoria']=="Amministratore"){
   if($tipospecie=="animale"){
  $sql="SELECT * from ClassificazioneAnimale where IDSegnalazione='$segnalazione'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
  if($res){
    try{
     $sql1="UPDATE ClassificazioneAnimale set NomeLatino='$specie' WHERE IDSegnalazione='$segnalazione'";
     $result=$pdo->exec($sql1);
     echo "Correzione effettuata";
     $esito=true;
          }
   catch(PDOException	$e){
      echo("Codice errore".$e->getMessage()."<br>");
      exit();
      }
         }
   else{
    echo "classificazione inesistente";
     }
    }
  if($tipospecie=="vegetale"){
   $sql="SELECT * from ClassificazioneVegetale where IDSegnalazione='$segnalazione'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
   if($res){
    try{
     $sql="UPDATE ClassificazioneVegetale set NomeLatino='$specie' WHERE IDSeganalazione='$segnalazione'";
     $result=$pdo->exec($sql);
     echo "Correzione effettuata";
     $esito=true;
      }
   catch(PDOException	$e){
      echo("Codice errore".$e->getMessage()."<br>");
      exit();
      }
            }
   else{
    echo "classificazione inesistente";
     }
  }
   try {
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $bulk = new MongoDB\Driver\BulkWrite();
    $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Correzione Classificazione', 'esito'=> $esito];
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
  <br>
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <button type="submit" onclick="location.href='mioprofilo.php'"   class="btn btn-secondary btn-lg">Ritorna al tuo profilo</button>
  </div>
</div>
</body>
</html>
