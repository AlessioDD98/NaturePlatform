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
<br><br>
<form enctype="multipart/form-data" method="post" action="aggiornadati.php">
<div class="container">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
    <div class="form-group">
      <label class="sr-only">email</label>
        <input type="text" name="email" class="form-control" placeholder="Email">
      </div>
    <div class="form-group">
      <label class="sr-only">professione</label>
        <input type="text" name="professione" class="form-control" placeholder="Professione">
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
    <button type="submit" class="btn btn-secondary btn-lg">Aggiorna</button>
  </div>
</div>
</body>
</html>
