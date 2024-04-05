<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Statistica specie vegetali
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Statistica Specie Vegetali</h1>
</head>
<body>
<br>
<div class="container col-md-3">
  <div class="row justify-content-center align-items-center bg-white"><?php
  try {
    $pdo=new PDO('mysql:host=localhost;dbname=nature','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo("[ERRORE] Connessione al DB non riuscita. Errore: ".$e->getMessage()."<br>");
    exit();
  }
   try{
   $sql="SELECT NomeLatino,count(*) as tot from ClassificazioneVegetale group by NomeLatino order by count(*)";
   $res=$pdo->query($sql);
     while($row=$res->fetch()){
        echo('Nome Latino: ' .$row['NomeLatino'].'<br> Totale: ' .$row['tot'] ."<br>");
        }
      }catch(PDOException $e)	{
	      echo("Codice errore".$e->getMessage()."<br>");
	      exit();
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
