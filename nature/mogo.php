<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
 <?php
try {
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query([]);
    $rows = $mng->executeQuery("scuolaBO.scuole", $query);
    foreach ($rows as $row) {
        echo "$row->nome : $row->indirizzo\n";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    //Errore
}
?>
    </body>
</html>
