<!DOCTYPE html>
<?php
session_start();
include("menu.html");
?>
<html lang="en">
<title>
Correzione classificazione
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Correggi Classificazione</h1>
</head>
<body>
<br>
<form name="form_correzione" method="post" action="CorrezioneCl.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
        <input type="number" name="segnalazione" class="form-control"  placeholder="Segnalazione*" aria-label="Segnalazione" aria-describedby="basic-addon1">
      </div>
      <div class="input-group mb-3" style="width: 410px;">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Tipo Specie: </label>
              </div>
        <select name="tipospecie" class="custom-select" id="inputGroupSelect01">
          <option selected>Seleziona il tipo*</option>
          <option value="animale">Animale</option>
          <option value="vegetale">Vegetale</option>
        </select>
      </div>
        <div class="form-group">
          <br><input type="text" name="specie" class="form-control" placeholder="Specie*" aria-label="Specie" aria-describedby="basic-addon1">
        </div>
      </div>
      <div class="container">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
          <button type="submit" class="btn btn-secondary btn-lg">Inserisci</button>
        </div>
      </div>
      <p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p></body>
</html>
