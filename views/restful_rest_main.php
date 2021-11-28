<?php
$url = "http://localhost/web2_2/restful_/szerver.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['ti'] = trim($_POST['ti']);
  $_POST['je'] = trim($_POST['je']);

  
  // Ha nincs id és megadtak minden adatot (tipus, jelentés), akkor beszúrás
  if($_POST['id'] == "" && $_POST['ti'] != "" && $_POST['je'] != "")
  {
      $data = Array("ti" => $_POST["ti"], "je" => $_POST["je"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot (tipus, jelentés), akkor módosítás
  elseif($_POST['id'] >= 1 && ($_POST['ti'] != "" || $_POST['je'] != ""))
  {
      $data = Array("id" => $_POST["id"], "ti" => $_POST["ti"], "je" => $_POST["je"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REST BEADANDÓ</title>
</head>
<body>
    <?= $result ?>
    <h1>Szolgáltatások:</h1>
    <?= $tabla ?>
    <br>
    <h2>Módosítás / Beszúrás</h2>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Tipus <input type="text" name="ti" maxlength="45"> <br><br>
    Jelentés: <input type="text" name="je" maxlength="100"> <br><br>
    <input type="submit" value = "Küldés">
    </form>
</body>
</html>
