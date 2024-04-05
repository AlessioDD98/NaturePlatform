<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html>
<title>
Inserisci Segnalazione
</title>
<head>
  <meta charset="utf-8">
  <link href="stilef.css" rel="stylesheet" type="text/css">
  <br>
  <h1 class="card row justify-content-center align-items-center">Inserisci Segnalazione</h1>
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
  $habitat=$_POST["habitat"];
  $data=date("Y-n-j");
  $check=getimagesize($_FILES["filefoto"]["tmp_name"]);
  $image=$_FILES['filefoto']['tmp_name'];
  $foto = base64_encode(file_get_contents(addslashes($image)));
  $latitudine=$_POST["latitudine"];
  $longitudine=$_POST["longitudine"];
  if($nickname!="" && $habitat!="" && $latitudine>0 && $longitudine>0){
    try{
        $sql1="INSERT into Segnalazione (Nickname,NomeHabitat,Data,Foto,Latitudine,Longitudine) values('$nickname','$habitat','$data','$foto','$latitudine','$longitudine')";
        $result=$pdo->exec($sql1);
        echo("Inserimento avvenuto con successo!");
        $esito=true;
      }catch(PDOException	$e)	{
          echo("Errore, l'habitat inserito non è registrato nel sistema.<br>");
      }
  }
  else{
    echo("Errore in fase di inserimento!<br>");
  }
  try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Inserimento Segnalazione', 'esito'=> $esito];
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
