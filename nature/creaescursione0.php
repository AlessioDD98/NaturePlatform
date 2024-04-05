<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Crea Escursione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Crea Escursione</h1>
</head>
<body>
<br>
<form name="form_registration" method="post" action="creaescursione.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
          <input type="text" name="titolo" class="form-control" placeholder="Titolo*">
        </div>
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Orario Partenza*: </label>
        </div>
      <div class="form-group">
          <input type="time"  name="orariopartenza" class="form-control" placeholder="Orario Partenza*: ">
      </div>
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Orario Ritorno*: </label>
      </div>
      <div class="form-group">
          <input type="time"  name="orarioritorno" class="form-control" placeholder="*">
      </div>
      <div class="form-group">
        <input type="number"  name="nummaxpart" class="form-control" placeholder="Numero massimo partecipanti*">
      </div>
      <div class="form-group">
        <input type="text"  name="descrizione" class="form-control" placeholder="Descrizione">
      </div>
      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Data*: </label>
      </div>
      <div class="form-group">
        <input type="date"  name="data" class="form-control" placeholder="Altezza">
      </div>
      <div class="form-group">
        <input type="text"  name="tragitto" class="form-control" placeholder="Tragitto*">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <button type="submit" class="btn btn-secondary btn-lg">Crea</button>
    </div>
  </div
<p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p>
</body>
</html>
