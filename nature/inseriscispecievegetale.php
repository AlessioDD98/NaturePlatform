<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Inserisci Specie Vegetale
</title>
<head>
  <meta charset="utf-8">
  <link href="stilef.css" rel="stylesheet" type="text/css">
  <br>
  <h1 class="card row justify-content-center align-items-center">Inserisci Specie Vegetale</h1>
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
  $classe=$_POST["classe"];
  $nomelatino=$_POST["nomelatino"];
  $nomeitaliano=$_POST["nomeitaliano"];
  $annoclassificazione=$_POST["anno"];
  $livvulnerabilita=$_POST["livvulnerabilita"];
  $link=$_POST["link"];
  $altezza=$_POST["altezza"];
  $diametro=$_POST["diametro"];
  $nomehabitat=$_POST["habitat"];
  $sql="SELECT Categoria from Utente where nickname='$nickname'";
  $res=$pdo->query($sql);
  $res=$res->fetch();
  if($res['Categoria']=="Amministratore"){
  if($classe!="" && $nomelatino!="" && $nomeitaliano!="" && $livvulnerabilita!="" && $nomehabitat!=""){
    try{
        $sql1="CALL InserisciSpecieVegetale('$classe','$nomelatino','$nomeitaliano','$annoclassificazione','$livvulnerabilita','$link','$altezza','$diametro','$nomehabitat','$nickname')";
        $result=$pdo->exec($sql1);
        echo("Inserimento avvenuto con successo!");
        $esito=true;
      }catch(PDOException	$e)	{
          echo("Errore, inserimento fallito.<br>");
      }
  }
  else{
    echo("Errore, dati mancanti!<br>");
  }
  try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Inserimento Specie Vegetale', 'esito'=> $esito];
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
