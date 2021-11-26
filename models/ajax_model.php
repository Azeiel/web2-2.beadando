<?php
  switch($_POST['op']) {
    case 'orszag':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2_2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("select id, tipus from szolgaltatas");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['tipus']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'varos':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2_2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select azon, datum from naptar where szolgid = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['azon'], "nev" => $row['datum']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'intezmeny':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2_2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select azon, igeny from lakig where szolgid = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['azon'], "nev" => $row['igeny']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
    case 'info':
      $eredmeny = array("jelentes" => "", "datum" => "", "igeny" => "", "mennyiseg" => "");
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2_2', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select jelentes, datum, igeny, mennyiseg from szolgaltatas inner join naptar on szolgaltatas.id = naptar.szolgid inner join lakig on szolgaltatas.id = lakig.szolgid  where lakig.szolgid = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny = array("nev" => $row['jelentes'], "cim" => $row['datum'], "tel" => $row['igeny'], "email" => $row['mennyiseg']);
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
  }
?>

