<?php
//Connessione al db
  try {
    $pdo=new PDO('mysql:host=localhost;dbname=nature','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e) {
    echo("[ERRORE] Connessione al DB non riuscita. Errore: ".$e->getMessage()."<br>");
    exit();
  }
      // These are all PHP variables. The web browser doesn't know about them.
try {
     $sql="SELECT * from Segnalazione";
     $res=$pdo->query($sql);
     $nbRows = $res->rowCount();
     $point=$res->fetchAll();
     }catch(PDOException	$e)	{
              echo("Codice errore".$e->getMessage()."<br>");
	      exit();
    }
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<title>Mappa Segnalazioni</title>
<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
 <script type='text/javascript' src='http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js'></script>

</head>

<body>

<div id="map" style="height: 900px; width: 100%; border: 1px solid #AAA;"></div>

<p id="demo"></p>

<script>

var map = L.map( 'map', {
    center: [20.0, 5.0],
    minZoom: 2,
    zoom: 2
});


L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    subdomains: ['a','b','c']
}).addTo( map );

var data = <?php echo JSON_encode($point);?>;

for (var i = 0; i < data.length; i++)
    {
       var marker= L.marker([Number(data[i].Latitudine), Number(data[i].Latitudine)]).addTo(map);
       marker.bindPopup("<b>"+data[i].NomeHabitat+"</b><br>"+data[i].Data).openPopup();
    }


</script>
<div class="container">
  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
<button type="submit" onclick="location.href='mioprofilo.php'"   class="btn btn-secondary btn-lg">Ritorna al tuo profilo</button>
</div>
</div>
</body>
</html>
