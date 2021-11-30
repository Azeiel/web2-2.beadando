<?php
class pdf_Model {

  public function pdf(){
  

    unset($_SESSION['lekerdezes']);
    
    //-------------------------------------------------------------------------
    //- Kiválasztja az adatbázisból a hulladéktípus rövidítését és jelentését -
    //-------------------------------------------------------------------------
    $connection = Database::getConnection();
    $sql = "SELECT DISTINCT `tipus`, `jelentes` FROM `szolgaltatas` ORDER BY `tipus` ASC";
    $sth = $connection->prepare($sql);
    $sth->execute(array());
    $sel_tip = $sth->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['tip_sel'] = $sel_tip;
    //- END -------------------------------------------------------------------
    
    //-------------------------------------------------------------------------
    //- Kiválasztja az adatbázisból a szállítási időpontokat                  -
    //-------------------------------------------------------------------------
    $connection = Database::getConnection();
    $sql = "SELECT DISTINCT datum FROM naptar ORDER BY datum ASC";
    $sth = $connection->prepare($sql);
    $sth->execute(array());
    $sel_date = $sth->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['date_sel'] = $sel_date;
    //- END -------------------------------------------------------------------
    
    //-------------------------------------------------------------------------
    //- Kiválasztja az adatbázisból az ügyfél adatait                         -
    //-------------------------------------------------------------------------
    $connection = Database::getConnection();
    $sql = "SELECT DISTINCT igeny FROM lakig ORDER BY igeny ASC";
    $sth = $connection->prepare($sql);
    $sth->execute(array());
    $sel_igeny = $sth->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['igeny_sel'] = $sel_igeny;
    //- END -------------------------------------------------------------------
    



//$adatok1 = $grafikon['igeny'];
//$adatok1 = $grafikon['mennyiseg'];
//$title1 = "Dátum";
//$title2 = "Mennyiség";




    //- END -------------------------------------------------------------------    
    
    //------------------------------------------------------------------------------
    //- Lekéri az adatokat a nézetben (pdf_main ügyfél) beállított értékek alapján -
    //------------------------------------------------------------------------------
    
    
    
    
    
    
    
    
    
    if(isset($_POST['tipus']) && isset($_POST['igeny']) && isset($_POST['naptar'])) { // Ha mind a három lehetőség választva van...
    
       if($_POST['tipus'] !== "osszes" or $_POST['igeny'] !== "osszes" or $_POST['naptar'] !== "osszes") { // Ha a három választás közül legalább az egyik NEM "osszes"
    
          $_SESSION['lekerdezes'] = true;
            
            $sel_tip = $_POST['tipus']; // Kiválasztás a hulladék típusa szereint,
            $sel_ige = $_POST['igeny']; // a hulladék kirakásának időpontja szerint,
            $sel_nap = $_POST['naptar'];// a hulladék elszállításának időpontja szerint.
            
            $and_ig = "";
            $and_nap = "";
            
            
            if($sel_tip !== "osszes" and $sel_ige == "osszes" and $sel_nap !== "osszes"){ // Ha a típus és a szállítási dátum ki van választva, akkor beszúrja a datum elé: AND
                    $and_nap = " AND ";
                }//else{$and_nap = "";}
            
            
            if($sel_tip !== "osszes" and $sel_ige !== "osszes" and $sel_nap == "osszes"){ // Ha a típus és a szállítási igény ki van választva, akkor beszúrja az igény elé: AND
                    $and_ig = " AND ";
                }//else{$and_ig = "";}
                
                
                
            if($sel_tip == "osszes" and $sel_ige !== "osszes" and $sel_nap !== "osszes"){ // Ha az igény és a datum ki van választva, akkor beszúrja a datum elé: AND
                    $and_nap = " AND ";
                }//else{$and_nap = "";}
                
                
                
            if($sel_tip !== "osszes" and $sel_ige !== "osszes" and $sel_nap !== "osszes"){ // Ha a mind a három ki van választva, akkor beszúrja az igeny és a datum elé: AND
                    $and_ig = " AND ";
                    $and_nap = " AND ";
            }//else{
               // $and_ig = "";
                //$and_nap = "";
                //}
            
            
            if($sel_tip !== "osszes"){
                $sel_tip = "tipus=".'"'.$_POST['tipus'].'"';
            }else{
                $sel_tip = "";
            }
            
            if($sel_ige !== "osszes"){
                $sel_ige = "igeny=".'"'.$_POST['igeny'].'"';
            }else{
                $sel_ige = "";
            }
            
            if($sel_nap !== "osszes"){
                $sel_nap = "datum=".'"'.$_POST['naptar'].'"';
                
            }else{
                $sel_nap = "";
            }
            
            

            

            
            
             $where = $sel_tip.$and_ig.$sel_ige.$and_nap.$sel_nap; // Feltétel, ami szerint a lekérdezést végre kell hajtani
        
        
    try {
            $connection = Database::getConnection();
            $sql_lekerdezes = "SELECT id, igeny, datum, mennyiseg, tipus, jelentes 
                           FROM lakszol 
                           WHERE ".$where." 
                           ORDER BY igeny ASC";
            
            $sth_lekerdezes = $connection->prepare($sql_lekerdezes);
            $sth_lekerdezes->execute(array());
            $eredmeny['lekerdezes'] = $sth_lekerdezes->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['lekerdezes'] = $eredmeny['lekerdezes'];
            $lekerdezes = $eredmeny['lekerdezes'];
            
            // Open a file in write mode ('w')
            $fp = fopen('tcpdf/examples/data/persons.csv', 'w');
            
            // Loop through file pointer and a line
            foreach ($lekerdezes as $fields) {
            	fputcsv($fp, $fields, ";");
            }
            
            fclose($fp);
            
            }
    	catch (PDOException $e) {
            $eredmeny["hibakod"] = 1;
            $eredmeny["uzenet"] = $e->getMessage();
    	}
    }
    
    
    



   
    
    
    
    
    if($_POST['tipus'] == "osszes" && $_POST['igeny'] == "osszes" && $_POST['naptar'] == "osszes") {
    $_SESSION['osszes_mind'] = true;
    
    
    try {
            $connection = Database::getConnection();
            //$sql_lakig = "SELECT igeny, szolgid, mennyiseg FROM lakig order by igeny asc";
            $sql_lakig = "SELECT igeny, szolgid, mennyiseg, tipus, jelentes 
                          FROM lakig 
                          JOIN szolgaltatas
                          ON id = szolgid
                          order by igeny ASC";
            
            $sth_lakig = $connection->prepare($sql_lakig);
            $sth_lakig->execute(array());
            $eredmeny['lakig'] = $sth_lakig->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['lakig'] = $eredmeny['lakig'];
            $lakig = $eredmeny['lakig'];
            }
    	catch (PDOException $e) {
            $eredmeny["hibakod"] = 1;
            $eredmeny["uzenet"] = $e->getMessage();
    	}
    

      
    
    	$eredmeny = array("hibakod" => 0,
    					  "uzenet" => "",
    					  "lakig" => Array());
    	  
    	

    	//return $eredmeny;
        
      try {
            $connection = Database::getConnection();
            $sql_naptar = "SELECT datum, szolgid FROM naptar order by datum asc";
            
            $sth_naptar = $connection->prepare($sql_naptar);
            $sth_naptar->execute(array());
            $eredmeny['naptar'] = $sth_naptar->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['naptar'] = $eredmeny['naptar'];
            $naptar = $eredmeny['naptar'];
            }
    	catch (PDOException $e) {
            $eredmeny["hibakod"] = 1;
            $eredmeny["uzenet"] = $e->getMessage();
    	}
    

      
    
    	$eredmeny = array("hibakod" => 0,
    					  "uzenet" => "",
    					  "lakig" => Array());
    	  
    try {
            $connection = Database::getConnection();
            $sql_lekerdezes = "SELECT id, igeny, datum, mennyiseg, tipus, jelentes 
                           FROM lakszol 
                           ORDER BY igeny ASC";
            
            $sth_lekerdezes = $connection->prepare($sql_lekerdezes);
            $sth_lekerdezes->execute(array());
            $eredmeny['lekerdezes'] = $sth_lekerdezes->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['lekerdezes'] = $eredmeny['lekerdezes'];
            $lekerdezes = $eredmeny['lekerdezes'];
            
            // Open a file in write mode ('w')
            $fp = fopen('tcpdf/examples/data/persons.csv', 'w');
            
            // Loop through file pointer and a line
            foreach ($lekerdezes as $fields) {
            	fputcsv($fp, $fields, ";");
            }
            
            fclose($fp);
            
            }
    	catch (PDOException $e) {
            $eredmeny["hibakod"] = 1;
            $eredmeny["uzenet"] = $e->getMessage();
    	}
        

       

    
       $z = 0;
       $zz = 0;
       $x = 0;
       $ok = 0;
       $ok2 = 0;
       $a=1;
       
       $y = (count($lakig) -1);
       $y2 = (count($naptar) -1);
       
        
        while($x <= $y) { //while -1-
            $z = 0;

            
            if($lakig[$x]['igeny'] > $naptar[$z]['datum']) { //if -1-

                for($z=0; $lakig[$x]['igeny'] > $naptar[$z]['datum']; $z++) { //for -1-
                  
                } //for -1-
              } //if -1-
              
              if($lakig[$x]['szolgid'] !== $naptar[$z]['szolgid']) { //if -2-
            
                    while($lakig[$x]['szolgid'] !== $naptar[$z]['szolgid']) { //while -2-
                        $z++;
                        if($z >= $y2){
                        //echo "Ebben az évben már nincs ilyen fajta szállítás:"."<br>";
                        //echo $lakig[$x]['igeny']." _ ".$lakig[$x]['szolgid']."<br>";
                        break;
                        }
                } //while -2-
              }else{ // if -2- else -1-
                   
              } // else -1-
                $wspace = "&nbsp&nbsp&nbsp&nbsp&nbsp";
                
                $szall_ig[$a] = $lakig[$x]['igeny'];
                $szall_nap[$a] = $naptar[$z]['datum'];
                $szall_szid[$a] = $lakig[$x]['szolgid'];
                $szall_meny[$a] = $lakig[$x]['mennyiseg'];
                $szall_tip[$a] = $lakig[$x]['tipus'];
                $szall_jel[$a] = $lakig[$x]['jelentes'];
                
                //echo $a.$wspace.$szall_ig[$a].$wspace.$szall_nap[$a].$wspace.$szall_szid[$a].$wspace.$szall_meny[$a].$wspace.$szall_tip[$a]."<br>";
                
                $a++;
                
                
                //echo $lakig[$x]['igeny'].$wspace.$lakig[$x]['mennyiseg'].$wspace.$naptar[$z]['datum'].$wspace.$lakig[$x]['tipus'].$wspace.$lakig[$x]['jelentes']."<br>";
              //echo $lakig[$x]['igeny']." _ ".$lakig[$x]['szolgid']."   -   ".$naptar[$z]['datum']." _ ".$naptar[$z]['szolgid']."<br>";
              /*echo "x= ".$x."<br>";
              echo "z= ".$z."<br>";
              echo "y= ".$y."<br>";
              echo "y2= ".$y2."<br>";*/
              $x++;
              
              
              
              
              
                        
                  
                  
                         

                
                }  //while -1-

    
    	//return $eredmeny;
    
    $_SESSION['$szall_ig'] = $szall_ig;
    $_SESSION['$szall_nap'] = $szall_nap;
    $_SESSION['$szall_szid'] = $szall_szid;
    $_SESSION['$szall_meny'] = $szall_meny;
    $_SESSION['$szall_tip'] = $szall_tip;
    $_SESSION['$szall_jel'] = $szall_jel;
    





    
    //- END -------------------------------------------------------------------
    
   } 
   }
   
    //-------------------------------------------------------------------------
    //- Debug BE = 1, KI = 0                                                  -
    //-------------------------------------------------------------------------
$debug = "0"; // Debug be=1 Ki=0
  
  if ($debug == "1") {
  
    
    //- Debug ------------------------------------- Select feltételek ---------
    
    
    if(isset($_POST['tipus']) && isset($_POST['igeny']) && isset($_POST['naptar'])) {
        if($_POST['tipus'] !== "osszes" or $_POST['igeny'] !== "osszes" or $_POST['naptar'] !== "osszes") {
        
            
            echo "sel_tip = ".$sel_tip."<br>";
            echo "and_tip = ".$and_ig."<br>";
            echo "sel_ige = ".$sel_ige."<br>";
            echo "and_nap = ".$and_nap."<br>";
            echo "sel_nap = ".$sel_nap."<br>";
        }
    }
    
    //- Debug ------------------------------------- Adatbázis lekérdezések-----
    
    
    
    if(isset($sql_lekerdezes)) {
        echo "DB kérdezés: ";
        echo $sql_lekerdezes."<br>";
    }
    
    if(isset($sql_lakig)) {
        echo "DB kérdezés: ";
        echo $sql_lakig."<br>";
    }
    
    if(isset($sql_naptar)) {
        echo "DB kérdezés: ";
        echo $sql_naptar."<br>";
    }    
    
    
    
    if(isset($_POST['tipus'])) {
        echo "Típus OK! = ".$_POST['tipus']."<br>";
    }

    if(isset($_POST['igeny'])) {
        echo "Igény OK! = ".$_POST['igeny']."<br>";
    }
    if(isset($_POST['naptar'])) {
        echo "Naptár OK! = ".$_POST['naptar']."<br>";
    }
    
    }
    
    //- Debug END ---------------------------------------------------------------
   
   }     
}
    
    
    
