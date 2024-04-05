<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Inserimento Donazione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Effettua Donazione</h1>
</head>
<body>
<br>
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
  try{
  $esito=false;
  $nickname=$_SESSION["nickname"];
  $campagna=$_POST["campagna"];
  $importo=$_POST["importo"];
  $note=$_POST["note"];
  $sql="SELECT Stato from Campagna WHERE ID='$campagna'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
   }
  catch(PDOException $e){
    echo('Codice Errore' .$e->getMessage());
    echo('Campagna non trovata');
    exit();
    }
  if($res['Stato']=="Aperto"){
  try{
    $sqli="INSERT into Donazione(Nickname,IDCampagna,Importo,Note)values('$nickname','$campagna','$importo','$note')";
    $result=$pdo->exec($sqli);
    $esito=true;
    }
    catch(PDOException $e){
    echo('Codice Errore' .$e->getMessage());
    exit();
    }
    echo "Inserimento riuscito";
    }
    if($res['Stato']=="Chiuso"){
    echo "Campagna Chiusa";
     }
    if($res['Stato']==NULL){
       echo "Campagna insesistente";
          }
    try {
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $bulk = new MongoDB\Driver\BulkWrite();
    $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Donazione', 'esito'=>$esito];
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
