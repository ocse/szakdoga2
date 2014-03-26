<?php
//session_start();
include ("connect.php");

if(!isset($_SESSION["belepve"])){
    echo "Be kell lépned";
}
 else {
     $email=$_SESSION["email"];
     $sql="SELECT * FROM `rendeles` WHERE `felhasznalo_email`='$email' AND `vegleges`=FALSE";
     $lekeres=  mysql_query($sql) or die(mysql_error());
     
     $sor=mysql_num_rows($lekeres);
//     echo $sor;
     if($sor==0){
         echo "Üres a kosarad";
     }
     else{
     
     $table = array();
     while ($sor = mysql_fetch_assoc($lekeres)){
         $table[] = $sor;
     }
    echo ' <div style="padding-top: 10px;">
    <h1 style=" font-family: monospace; font-size: large">Itt láthadod a kosarad tartalmát!</h1><br/></div>  <table style="width: 600px;">';
    echo '<tr>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">szolgáltatás</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">File</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Minőség</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Formátum</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Mennyiség</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Kötés</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Hordozó</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Méret</th>
            <th style="border: 2px; border-style: solid; border-color:  #009900;">Törlés</th>
        </tr>';
    $idszam = -1;
       foreach ($table as $sor){
           echo '<tr>';
           $idszam=$sor["id"];
           if($sor["szolgaltatas_id"]==0)
           {
               $ki = "nyomtatas";
           }
           else if ($sor["szolgaltatas_id"]==1) {
           $ki="poszter";    
           }
           else if ($sor["szolgaltatas_id"]==2) {
               $ki="foto";
           }
           else if ($sor["szolgaltatas_id"]==3) {
               $ki="tezis";
           }
           
           if($sor["vegleges"]==FALSE){
               
           
           echo '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$ki.'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["efajlnev"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["minoseg"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["formatum"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["mennyiseg"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["kotes"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["hordozo"].'</td>'
                   . '<td style="border: 2px; border-style: solid; border-color:  #009900; ">'.$sor["meret"].'</td>';              
           }
           echo '<td style="border: 2px; border-style: solid; border-color:  #009900; "><form action="inc/torles.php" method="get">
                    <input name="id" type="hidden" value="'.$idszam.'">
                    <input name="what" type="submit" value="DELETE">
                </form></td>';
           print '</tr>';
       }
    echo '</table>';
    
    if(isset($_POST["btn_rendeles"])){
        
 require 'class.phpmailer.php'; 
 require 'class.smtp.php';

$mail = new PHPMailer(); 
$mail->IsSMTP();  
            $mail->SMTPDebug = 2;
            $mail->Mailer = "smtp";
            $mail->SMTPSecure='tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;                                      

$mail->Username = "teszt.elem134";                 
$mail->Password = "tesztelem134"; 
$mail->From = "teszt.elem134@gmail.com";                         
$mail->FromName = "Easyprint";                         
$mail->AddAddress("teszt.elem134@gmail.com");         
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Rendelés";
$mail->Body = "<table border = 1><tr>
            <th>szolgáltatás</th>
            <th>File</th>
            <th>Minőség</th>
            <th>Formátum</th>
            <th>Mennyiség</th>
            <th>Kötés</th>
            <th>Hordozó</th>
            <th>Méret</th>
            <th>Email</th>
            <th>Dátum</th>
        </tr>
                </table>";

        foreach ($table as $sor){
            if($sor["szolgaltatas_id"]==0){
               $ki = "nyomtatas";
             }
             else if ($sor["szolgaltatas_id"]==1){
               $ki="poszter";    
             }
            $mail->Body = $mail->Body.'<tr><td>'.$ki.'</td><td>'.$sor["fajlnev"].'</td><td>'.$sor["minoseg"].'</td><td>'.$sor["formatum"].'</td><td>'.$sor["mennyiseg"].'</td><td>'.$sor["kotes"].'</td><td>'.$sor["hordozo"].'</td><td>'.$sor["meret"].'</td><td>'.$sor["felhasznalo_email"].'</td><td>'.$sor["rendeles_datum"].'</td></tr>';              
           
            $vegleges_sql="UPDATE `rendeles` SET `vegleges`=TRUE WHERE `felhasznalo_email`='$email'";
            mysql_query($vegleges_sql);
        }
        $mail->Send();

    ob_end_clean();
    header("Location:alelkuld.php");
    die();
    }

     
?>
<form method="POST" action="">
    <input type="submit" name="btn_rendeles" value="RENDELÉS"/>
    
</form>

<?php
    
}

 }
?>