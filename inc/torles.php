<?php
session_start();
include ("connect.php");

if(!isset($_SESSION["belepve"])){
    echo "Be kell lépned";
}
 else {
     $email=$_SESSION["email"];
     $toId = ($_GET["id"]);
     $fajl = "SELECT `fajlnev` FROM `rendeles` WHERE `id`=$toId AND `felhasznalo_email`='$email'";
     $fajlnev_lekeres = mysql_query($fajl) or die(mysql_error());
     if(mysql_num_rows($fajlnev_lekeres)==1){
         $fajlnev= mysql_fetch_assoc($fajlnev_lekeres);
         $table= array();
         
         $table[]=$fajlnev;
         if(file_exists("upload/".$fajlnev["fajlnev"])){
             unlink("upload/".$fajlnev["fajlnev"]);
         echo $fajlnev["fajlnev"];
         }
         

         
         
         
     }
     $sql = "DELETE FROM `rendeles` WHERE `id`=$toId AND `felhasznalo_email`='$email' AND `vegleges`='FALSE'";
     $lekeres=  mysql_query($sql) or die(mysql_error());

     
     ob_end_clean();
     header("Location:../alkosar.php");
     die(); 
 }
?>