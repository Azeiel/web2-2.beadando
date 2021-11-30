<head>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/pdf.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background-image: url('images/gp_bkg.jpg');
    background-size: 100% 100%;
}

table, th, td {
  border: 1px solid white;
  border-collapse: collapse;
}
th, td {
  background-color: #BDD4D4;
}
</style>






</head>
<body>



<!--------------------------------------------------->
<!----- Ügyfél Select ------------------------------->
<!--------------------------------------------------->


<?php

if(isset($_SESSION['tip_sel'])) { $tipus = $_SESSION['tip_sel']; }
?>
        
<form id="hulladek_select" method="POST">
    <fieldset>
    <legend>Ügyféladatok</legend>
      <label for="tipus">Hulladéktípus:</label>
      <select id="tipus" name="tipus">
        <option disabled selected>- Válasszon -</option>
        <option value="osszes">Összes típus</option>
        
           <?php
            foreach ($tipus as $row) {
                echo "<option value=".$row['tipus'].">".$row['tipus']." - ".$row['jelentes']."</option>";
                }
            ?>">

        </select> 
        <br><br>

<?php
if(isset($_SESSION['igeny_sel'])) { $igeny = $_SESSION['igeny_sel']; }
?>

        <label for="igeny">Szállítási igény dátuma:</label>
        <select id="igeny" name="igeny">
            <option disabled selected>- Válasszon -</option>
            <option value="osszes">Összes szállítás</option>
        
           <?php
            foreach ($igeny as $row) {
                echo "<option value=".$row['igeny'].">".$row['igeny']."</option>";
                }
            ?>">

        
        </select>
        <br><br>
        
<?php
if(isset($_SESSION['date_sel'])) { $igeny = $_SESSION['date_sel']; }
?>

        <label for="naptar">Szállítás dátuma:</label>
        <select id="naptar" name="naptar">
            <option disabled selected>- Válasszon -</option>
            <option value="osszes">Összes szállítás</option>
            
        
           <?php
            foreach ($igeny as $row) {
                echo "<option value=".$row['datum'].">".$row['datum']."</option>";
                }
            ?>">

        
        </select>
        <br><br>
        
        
        <input type="submit" value="Küldés">
    </fieldset>
    </form>
    
    <form action="tcpdf/examples/pdf.php">
        <input type="submit" value="PDF mentése">
    </form>


<!--------------------------------------------------->
<!----- Táblázat ------------------------------------>
<!--------------------------------------------------->

<?php
    if(isset($_SESSION['$szall_ig'])) {
                $szall_ig = $_SESSION['$szall_ig'];
                $szall_nap = $_SESSION['$szall_nap'];
                $szall_meny = $_SESSION['$szall_meny'];
                $szall_tip = $_SESSION['$szall_tip'];
                $szall_jel = $_SESSION['$szall_jel'];
                }



?>



<!--------------------------------------------------------------------------------------\
<!---                                                --------------------------------\  |
<!--------------------------------------------------------------------------------\  |  |
<!--                                                                              V  V  V
-->  

    
<?php
    if(!isset($_SESSION['osszes_mind'])){
        if(isset($_SESSION['lekerdezes'])){
        
            
?>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Szállítási igény</th>
                        <th>Szállítás napja</th>
                        <th>Mennyiség</th>
                        <th>Típus</th>
                        <th>Hulladék típusa</th>
                    </tr>
                    </thead>
<?php
                    
            $lekerdezes = $_SESSION['lekerdezes'];
          $y = (count($lekerdezes) -1);
                        for ($x = 0; $x <= $y; $x++) {
?>
            <tbody>
                <tr>
                  <td><?php print_r($lekerdezes[$x]['id']); ?></td>
                  <td><?php print_r($lekerdezes[$x]['igeny']); ?></td>
                  <td><?php print_r($lekerdezes[$x]['datum']); ?></td>
                  <!--<td><?php print_r($lekerdezes[$x]['szolgid']); ?></td>-->             
                  <td><?php print_r($lekerdezes[$x]['mennyiseg']); ?></td>
                  <td><?php print_r($lekerdezes[$x]['tipus']); ?></td>
                  <td><?php print_r($lekerdezes[$x]['jelentes']); ?></td>
                  
                </tr>
            </tbody>
        
<?php
            }

            unset($_SESSION['lekerdezes']);
            unset($lekerdezes);            
        }
    }
?>
</table>


<!--------------------------------------------------------------------------------------\
<!---                                                --------------------------------\  |
<!--------------------------------------------------------------------------------\  |  |
<!--                                                                              V  V  V
-->  

    <table>
<?php
        if(isset($_SESSION['lakig2'])){
            
?>
                    <thead>
                    <tr>
                        <th>Dátum</th>
                        <th>Típus</th>
                        <th>Mennyiség</th>
                        <th>Hulladék típusa</th>
                    </tr>
                    </thead>
<?php
                    
            $lakig = $_SESSION['lakig'];
          $y = (count($_SESSION['lakig']) -1);
                        for ($x = 0; $x <= $y; $x++) {
?>
            <tbody>
                <tr>
                  <td><?php print_r($lakig[$x]['igeny']); ?></td>
                  <td><?php print_r($lakig[$x]['szolgid']); ?></td>             
                  <td><?php print_r($lakig[$x]['mennyiseg']); ?></td>
                  <td><?php print_r($lakig[$x]['jelentes']); ?></td>
                  
                </tr>
            </tbody>
        
<?php
            }

            unset($_SESSION['lakig']);
            unset($lakig);            
        }
?>
</table>


<!--------------------------------------------------------------------------------------\
<!--- Szállítás igény és szállítás időpontja szerint --------------------------------\  |
<!--------------------------------------------------------------------------------\  |  |
<!--                                                                              V  V  V
-->                                                                             

<?php
if(isset($_SESSION['osszes_mind'])){ 
if(isset($szall_ig)){   
?>    


<h2 id="head">Szállítási igény a szállítás időpontja szerint</h2>
               <table> 
                    <thead>
                    <tr>
                        <th>Szállítási igény</th>
                        <th>Szállítás napja</th>
                        <th>Mennyiség</th>
                        <th>Kat.</th>
                        <th>Hulladék Típusa</th>
                    </tr>
                    </thead>
<?php
    $y = (count($szall_ig) );
    for ($a = 1; $a <= $y; $a++) {
?>
            <tbody>
                <tr>
                  <td><?php print_r($szall_ig[$a]); ?></td>
                  <td><?php print_r($szall_nap[$a]); ?></td>  
                  <td><?php print_r($szall_meny[$a]); ?></td>
                  <td><?php print_r($szall_tip[$a]); ?></td>
                  <td><?php print_r($szall_jel[$a]); ?></td>    
                </tr>
            </tbody>
        
<?php  
    }
?>  
</table>
<?php 
}
unset($_SESSION['osszes_mind']);

}
?>


</body>