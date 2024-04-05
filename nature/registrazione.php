<html lang="en">
<br>
<body>
<div>
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
  $esito=false;
  $nickname=$_POST["nickname"];
  $password=md5($_POST["password"]);
  $email=$_POST["email"];
  $professione=$_POST["professione"];
  $dataregistrazione=date("Y-n-j");
  $image=$_FILES['filefoto']['tmp_name'];
  $foto = base64_encode(file_get_contents(addslashes($image)));
  $annonascita=$_POST["annonascita"];
  try{
    $sql="SELECT * from Utente WHERE (nickname='$nickname')";
    $res=$pdo->query($sql);
    $res=$res->fetch();
  }catch(PDOException $e){
    echo ("Errore: ".$e->getMessage());
    exit();
  }
  if($nickname!="" && $password!="" && $email!="" && $annonascita>0 && !$res ){
    try{
        $sql1="INSERT into Utente (Nickname,Password,Email,Professione,DataRegistrazione,AnnoNascita,Categoria, Foto) values ('$nickname','$password','$email','$professione','$dataregistrazione','$annonascita', 'Semplice','$foto')";
        $result=$pdo->exec($sql1);
        $esito=true;
      }catch(PDOException	$e)	{
	      echo("Codice	errore".$e->getMessage()."<br>");
	      exit();
      }
  }
  else{
    include("index.html");
    echo("<div class='col-md-3 text-white'><b>Errore in fase di registrazione!</b></div><br>");
  }
  if(isset($sql1)){
    include("login.html");
    echo("<br><br><p><b>Registrazione avvenuta con successo!</b></p>");
  }
  try {
     $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
     $bulk = new MongoDB\Driver\BulkWrite();
     $doc = ['_id' => new MongoDB\BSON\ObjectID(),'data'=>date("Y-m-d h:i:sa"),'name' => $nickname, 'azione' => 'Nuovo utente', 'esito'=> $esito];
     $bulk->insert($doc);
     $mng->executeBulkWrite('LogNATURE.log', $bulk);
     } catch (MongoDB\Driver\Exception\Exception $e) {
    echo("Codice	errore".$e->getMessage()."<br>");
  }
?>
</div>
<br>
</body>
</html>
