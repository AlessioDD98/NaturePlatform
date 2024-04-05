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
<form enctype="multipart/form-data" method="post" action="inseriscisegnalazione.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
          <input type="text" name="habitat" class="form-control" placeholder="Habitat*">
        </div>
      <div class="form-group">
          <input type="number" step=any name="latitudine" class="form-control" placeholder="Latitudine*">
      </div>
      <div class="form-group">
          <input type="number" step=any name="longitudine" class="form-control" placeholder="Longitudine*">
        </div>
    </div>
  </div>
  <div class="form-row">
    <div class="input-group input-group-lg col-md-3 mx-auto mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Foto</span>
      </div>
      <input type="file" name="filefoto" class="form-control" aria-describedby="basic-addon1">
    </div>
  </div>
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <button type="submit" class="btn btn-secondary btn-lg">Inserisci</button>
    </div>
  </div>
<p><br>  <b>            I campi contrassegnati con * sono obbligatori</b></p>
</body>
</html>
