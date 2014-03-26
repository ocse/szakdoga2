<?php
    if(isset($_SESSION["username"])){
    $username=$_SESSION["username"];
//      $email = $_SESSION["email"];
    }
   
    $t = time();
    $uzenet_datum = date("Y.m.d", $t);
     
     $sql="SELECT * FROM `uzenet` ORDER by `uzenet_date` DESC";
     $lekeres=  mysql_query($sql) or die(mysql_error());
     
     $sor=mysql_num_rows($lekeres);
//     echo $sor;
     
     $table = array();
     while ($sor = mysql_fetch_assoc($lekeres)){
         $table[] = $sor;
     }
    echo '<div style="padding-top: 10px;">
    <h1 style=" font-family: monospace; font-size: large">Itt láthatod az üzeneteket!</h1><br/></div>
    <table style="width: 600px;">';
    echo '<tr>
            <th style="width: 100px;  border: 2px; border-style: solid; border-color:  #009900;">Felhasználónév</th>
            <th style="width: 400px;  border: 2px; border-style: solid; border-color:  #009900;">üzenet</th>
            <th style="width: 100px;  border: 2px; border-style: solid; border-color:  #009900;">dátum</th>
           
        </tr>';
    
       foreach ($table as $sor){
           echo '<tr>';
           
           
           
               
           
           echo '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["felhasznalonev"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; " >'.$sor["uzenet"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; " >'.$sor["uzenet_date"].'</td>';              
           
         
           print '</tr>';
       }
    echo '</table>';  







if (!isset($_SESSION["email"])){
//    echo '<tr><td colspan=3>Üzenetet csak regisztrált felhasználók írhatnak.<br/>Lépj be vagy regisztrálj!</td></tr></table>';  
    echo '<div><br/><br/><br/>Üzenetet csak regisztrált felhasználók írhatnak.<br/><br/>Lépj be vagy regisztrálj!</div>';
}



else{
//    echo '</table>';  
if (isset($_POST["btn_uzenetkuld"])){
    
        $uzenet= $_POST["uzenet"];

        $sql="INSERT INTO `uzenet` (`felhasznalonev`, `uzenet`, `uzenet_date`) VALUES ('$username', '$uzenet', '$uzenet_datum');";
        mysql_query($sql);
        if(mysql_errno()==0){
                ob_end_clean();
    header("Location:aluzenet.php");
    die();
        }
        else{
            die("SQL hiba".mysql_error());
        }
    

    
}





?>





<form method="POST" action="">
    
    <table cellpadding="5px">
        <tr>
            <td>Üzenet:</td><td><textarea  rows="5" cols="50" name="uzenet"></textarea></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center"><input type="submit" name="btn_uzenetkuld" value="Küldés"></td>
    </tr>
    
    
    </table>
</form>
<?php } 





?>