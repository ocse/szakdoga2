<?php
//session_start();
require_once "connect.php";

if (!isset($_SESSION["belepve"]) && !isset($_SESSION["email"])){
    echo "Előbb be kell jelentkezned";
}
 else {
     if(isset($_POST["btn_jelszovalt"])){
//         echo    $_SESSION["belepve"].$_SESSION["email"];
         if(empty($_POST["rpass"]) || empty($_POST["ujpass1"]) || empty($_POST["ujpass2"]) ){
//             echo "Minden mező kitöltése kötelező";
         }
         
         else{
             $email=$_SESSION["email"];
             $rpass=md5($_POST["rpass"]);
             $ujpass1=md5($_POST["ujpass1"]);
             $ujpass2=md5($_POST["ujpass2"]);
             
             $sql="SELECT * FROM felhasznalo WHERE email='$email'";
             $lekeres=  mysql_query($sql) or die(mysql_error());
             
             $user=  mysql_fetch_assoc($lekeres);
             if($ujpass1!=$ujpass2){
                 echo "<br/><h1 style='color:red'>Nem egyezik a két megadott jelszó</h1><br/><br/>";
             }
             else{
                 if($rpass== $user["jelszo"]){
                     $sql1="UPDATE felhasznalo SET jelszo='".$ujpass1."' WHERE email='".$email."'";
                     mysql_query($sql1);
                     echo "Sikeres változtatás";
                     
                 
                }
                else{
                    echo "<br/><h1 style='color:red'>A régi jelszó nem megfelelő</h1><br/><br/>";
                }
             }
                 
             
         }
     }


?>
<div style="padding-top: 50px;">
    <h1 style=" font-family: monospace; font-size: large">Minden mező kitöltése kötelező!</h1><br/>
<form method="POST" action="">
    <table cellpadding="5px" style=" font-size:  medium">
        <tr>
            <td>Régi jelszó:</td><td><input type="password" name="rpass" value=""></td><br/>
    </tr>
    <tr>
        <td>Új jelszó</td><td><input type="password" name="ujpass1" value=""></td><br/>
    </tr>
    <tr>
        <td>Új jelszó ismét</td><td><input type="password" name="ujpass2" value=""></td><br/>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center"><input type="submit" style=" background-color: #009900; width: 200px; height: 50px; font-size: large; font-family: monospace; font-weight: bold" name="btn_jelszovalt" value="Módosít"></td><br/>
    </tr>
    
    </table>
    
</form>
</div>
 <?php } ?>