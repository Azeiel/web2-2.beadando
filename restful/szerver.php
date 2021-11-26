<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=web2_2', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM szolgaltatas";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Tipus</th><th>Jelentés</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$sql = "insert into szolgaltatas values (0, :ti, :je)";
				$sth = $dbh->prepare($sql);
				$cojet = $sth->execute(Array(":ti"=>$_POST["ti"], ":je"=>$_POST["je"]));
				$newid = $dbh->lastInsertId();
				$eredmeny .= $cojet." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['ti'] != "") {$modositando .= ", tipus = :ti"; $params[":ti"] = $data["ti"];}
				if($data['je'] != "") {$modositando .= ", jelentes = :je"; $params[":je"] = $data["je"];}
				
				$sql = "update szolgaltatas set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$cojet = $sth->execute($params);
				$eredmeny .= $cojet." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from szolgaltatas where id=:id";
				$sth = $dbh->prepare($sql);
				$cojet = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $cojet." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>