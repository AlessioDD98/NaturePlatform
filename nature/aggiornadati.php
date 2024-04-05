<!DOCTYPE html>
<?php
session_start();
include("menu.html");
 ?>
<html lang="en">
<title>
Aggiorna Dati
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Aggiorna Dati</h1>
</head>
<body>
<br>
<div class='col-md-3 mx-auto text-white'>
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
  $email=$_POST["email"];
  $professione=$_POST["professione"];
  $check=getimagesize($_FILES["filefoto"]["tmp_name"]);
  $image=$_FILES['filefoto']['tmp_name'];
  $foto = base64_encode(file_get_contents(addslashes($image)));
  $nickname=$_SESSION["nickname"];
  if($email!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set email='$email' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($professione!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set professione='$professione' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($check!=false){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set foto='$foto' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($email!="" && $professione!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set email='$email', professione='$professione' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($email!="" && $foto!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set email='$email',foto='$foto' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($email!="" && $foto!="" && $professione!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set email='$email',foto='$foto',professione='$professione' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($professione!="" && $foto!=""){
    try{
        $pdo->beginTransaction();
        $sql="UPDATE Utente set professione='$professione',foto='$foto' WHERE nickname='$nickname'";
        $result=$pdo->exec($sql);
        $pdo->commit();
        $esito=true;
    }catch(PDOException	$e)	{
        $pdo->rollback();
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
    }
  }
  if($esito==true){
    echo("<b>Aggiornamento avvenuto con successo!</b>");
  }
  else{
    echo("<b>Nessun campo è stato aggiornato.</b>");
  }
  try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione: ' => 'Aggiornamento dati', 'esito'=> $esito];
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
