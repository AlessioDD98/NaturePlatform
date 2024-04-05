<?php
session_start();
include("menu.html");
?>
<html>
<title>
Inserisci Habitat
</title>
<head>
<meta charset="utf-8">
<link href="stilef.css" rel="stylesheet" type="text/css">
<br>
<h1 class="card row justify-content-center align-items-center">Inserisci Habitat</h1>
</head>
<body>
<br>
<form name="form_registration" method="post" action="inseriscihabitat.php">
  <div class="container">
    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
      <div class="form-group">
          <input type="text" name="nome" class="form-control" placeholder="Nome*">
        </div>
      <div class="form-group">
          <input type="text"  name="descrizione" class="form-control" placeholder="Descrizione">
      </div>
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
