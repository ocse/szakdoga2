<?php
//session_start();
require_once "connect.php";
if (isset($_POST["btn_ujpass"])){
    if (empty($_POST["email"])){
        echo "<br/><h1 style='color:red'>Kötelező megadni az email címet!</h1><br/><br/>";
    }
    else{
        $randpass=  rand(1000, 9999);
        $email=$_POST["email"];

        $sql="SELECT * FROM felhasznalo WHERE email='$email'";
        $lekeres= mysql_query($sql) or die(mysql_error());
        
        if(mysql_num_rows($lekeres)==1){

//            echo $randpass;
            $kuldo="csempi@freemail.hu";
            $sql="UPDATE felhasznalo SET jelszo=md5('".$randpass."') WHERE email='".$email."'";
            mysql_query($sql);
//            echo "módosítva a jelszo";
//            echo $randpass;
//            echo $email;
           
require("class.phpmailer.php"); 
 require 'class.smtp.php';

$mail = new PHPMailer(); 

/**** SMTP szerver használata ****/ 
 $mail->IsSMTP();  // telling the class to use SMTP
            $mail->SMTPDebug = 2;
            $mail->Mailer = "smtp";
            $mail->SMTPSecure='tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;                                      

/**** E-mail cím ****/ 
$mail->Username = "teszt.elem134";                 

/**** Jelszó ****/ 
$mail->Password = "tesztelem134"; 

/**** Feladó e-mail címe ****/ 
/**** FONTOS!!! ÉRVÉNYES, SZERVEREN LÉTEZŐ E-MAIL LEGYEN! ****/ 
/**** FELADÓ HAMISÍTÁSA NEM LEHETSÉGES ****/ 
$mail->From = "teszt.elem134@gmail.com";                         

/**** Feladó neve ****/ 
$mail->FromName = "Easyprint";                         

/**** Címzett e-mail címe, neve ****/ 
$mail->AddAddress($email, $email);         
//$mail->AddAddress("cim@cegnev.hu");  
// címzett e-mail címe, név nem kötelező 

//$mail->AddReplyTo("webmaster@linuxweb.hu", "Webmaster"); 

$mail->WordWrap = 50;    // sortörés 50 karakter 
$mail->IsHTML(true);    // HTML formátum beállítása 

$mail->Subject = "Jelszókérés";                             
$mail->Body    = "az uj jelszavad:$randpass"; 

if(!$mail->Send()) 
{ 
       echo "Nem sikerült az e-mail küldése. <p>"; 
       echo "Hiba: " . $mail->ErrorInfo; 
       exit; 
} 
else echo "Levél sikeresen elküldve."; 

            
//            require("class.phpmailer.php");  
//  
//$mail = new PHPMailer();  
//  
//$mail->IsSMTP();                                   // SMTP-n keresztüli küldés  
//$mail->Host     = "smtp.gmail.com"; // SMTP szerverek  
//$mail->SMTPAuth = true; // SMTP autentikáció bekapcs  
//$mail->Port = 567;
//$mail->Username = "lego.mechwart";                         // SMTP felhasználó  
//$mail->Password = "L4e4g4o4";                        // SMTP jelszó  
// $mail->smtpConnect();
// 
//$mail->From     = "lego.mechwart@.com";                // Feladó e-mail címe  
//$mail->FromName = "Mailer";                        // Feladó neve  
//$mail->AddAddress($email);   // Címzett és neve  
//$mail->Subject = "Jelszóemlékeztető";            // A levél tárgya  
//$mail->Body    = "az uj jelszavad:$randpass";   // A levél tartalma  
//  
//if (!$mail->Send()) {  
//  echo "A levél nem került elküldésre";  
//  echo "A felmerült hiba: " . $mail->ErrorInfo;  
//  exit;  
//}  
// else {
//   echo "A levelet sikeresen kiküldtük a $email címre";  
//}
// 

            $_SESSION["email1"]=$email;
            ob_end_clean();
            header("Location:ujjelszokesz.php");
            die();
            
            
        }
    }
}


?>
<div style="padding-top: 50px">
<form method="POST" action="">
    <h1 style=" font-family: monospace; font-size: large">Itt kérhetsz új jelszót a regisztrált e-mail címedhez</h1><br/>
        
    <font style=" font-family: monospace; font-size: large">E-mail cím:</font>
    <br/><br/>
    <input type="text" name="email" value=""><br/><br/>
    <input type="submit"  style=" background-color: #009900; width: 200px; height: 50px; font-size: large; font-family: monospace; font-weight: bold" name="btn_ujpass" value="Új jelszó">
    
</form>
</div>
