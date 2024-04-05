<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Invia Messaggio
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Invia Messaggio</h1>
</head>
<body>
<br>
<form name="form_registration" method="post" action="inviamessaggio.php">
  <div class="container col-md-3">
    <div class="row justify-content-center align-items-center bg-white">Mittente:
      <?php
       $mittente=$_SESSION["nickname"];
       echo($mittente);
      ?>
    </div>
  </div>
    <div class="container">
      <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
        <div class="form-group">
            <input type="text" name="destinatario" class="form-control" placeholder="Destinatario*">
          </div>
        <div class="form-group">
            <input type="text" name="titolo" class="form-control" placeholder="Titolo*">
        </div>
        <div class="form-group">
            <input type="text" name="testo" class="form-control" placeholder="Testo*">
          </div>
        </div>
      </div>
<div class="container">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
    <button type="submit" class="btn btn-secondary btn-lg">Invia</button>
  </div>
</div>
<p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p>
</body>
</html>
