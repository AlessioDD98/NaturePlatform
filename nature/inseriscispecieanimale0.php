<?php
session_start();
include("menu.html");
?>
<html>
<title>
Inserisci Specie Animale
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Inserisci Specie Animale</h1>
</head>
<body>
<br>
<form name="form_registration" method="post" action="inseriscispecieanimale.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
          <input type="text" name="classe" class="form-control" placeholder="Classe*">
        </div>
      <div class="form-group">
          <input type="text"  name="nomelatino" class="form-control" placeholder="Nome Latino*">
      </div>
      <div class="form-group">
          <input type="text"  name="nomeitaliano" class="form-control" placeholder="Nome Italiano*">
      </div>
      <div class="form-group">
        <input type="number"  name="anno" class="form-control" placeholder="Anno classificazione">
      </div>
      <div class="input-group mb-3" style="width: 410px;">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Livello vulnerabilità: </label>
        </div>
        <select name="livvulnerabilita" class="custom-select " id="inputGroupSelect01">
          <option selected>Seleziona il livello*</option>
          <option value="Minimo">Minimo</option>
          <option value="Basso">Basso</option>
          <option value="Medio"> Medio</option>
          <option value="Alto"> Alto</option>
          <option value="Critico"> Critico</option>
        </select>
      </div>
      <div class="form-group">
        <input type="text"  name="link" class="form-control" placeholder="Link">
      </div>
      <div class="form-group">
        <input type="text"  name="peso" class="form-control" placeholder="Peso">
      </div>
      <div class="form-group">
        <input type="text"  name="altezza" class="form-control" placeholder="Altezza">
      </div>
      <div class="form-group">
        <input type="number"  name="numprole" class="form-control" placeholder="Numero Medio Prole">
      </div>
      <div class="form-group">
        <input type="text"  name="habitat" class="form-control" placeholder="Nome Habitat*">
      </div>
    </div>
  </div>
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <button type="submit" class="btn btn-secondary btn-lg">Inserisci</button>
    </div>
  </div>
<p> <b>            I campi contrassegnati con * sono obbligatori</b></p>
</body>
</html>
