<?php
if (isset($_POST["btn_regsubmit"])){
    if (trim($_POST["username"])==""){
        $hiba[]="A felhasználónév nem lehet üres!";
    }
    if (!preg_match( '/[.+a-zA-Z0-9_-]+@[a-zA-Z0-9-]+.[a-zA-Z]+/', $_POST["email"])) {
        $hiba[]="Valós e-mail címet kell megadnod!";
    }
    if (strlen($_POST["pass1"])<6){
        $hiba[]="Jelszó nem lehet kevesebb, mint 6 karakter!";
    }
    if ($_POST["pass1"]!=$_POST["pass2"]) {
        $hiba[]="A két jelszó nem egyezik!";
    }
    if (!is_numeric($_POST["tel"])){
        $hiba[]="Telefonszám csak szám lehet!";
    }
    if(!isset($hiba)){
    
        $email = mysql_real_escape_string($_POST["email"]);
        $username = mysql_real_escape_string($_POST["username"]);
        $pass1=  md5($_POST["pass1"]);
        $tel = mysql_real_escape_string($_POST["tel"]);
        $sql="INSERT INTO `felhasznalo` (`email`, `felhasznalonev`, `jelszo`, `telefonszam`) VALUES ('$email', '$username', '$pass1', '$tel');";
        mysql_query($sql);
        if(mysql_errno()==1062){
            echo "Felhasználónév már foglalt!";
        }
        elseif(mysql_errno()==0){
            echo "Sikeres regisztráció";
        }
        else{
            die("SQL hiba".mysql_error());
        }
    }
 else {
        echo "<br/><h1 style='color:red'>A következő hibák vannak:</h1><br/><br/>";
        echo implode("<br/>", $hiba);
    }
    
}

$username= isset($_POST["username"]) ? $_POST["username"] : '';
$email= isset($_POST["email"]) ? $_POST["email"] : '';
$tel= isset($_POST["tel"]) ? $_POST["tel"] : '';



?>


<link href="css.css" rel="stylesheet" type="text/css" />

<div style="padding-top: 50px;">
    <h1 style=" font-family: monospace; font-size: large">Minden mező kitöltése kötelező!</h1><br/>
<form method="POST" action="">
    <table cellpadding="5px" style=" font-size:  medium">
        <tr>
            <td>Felhasználónév:</td><td> <input type="text" name="username" value="<?php echo $username ?>"><br/></td>
        </tr>
        <tr>
            <td>Email:</td><td> <input type="text" name="email" value="<?php echo $email ?>"><br/></td>
        </tr>
        <tr>
            <td>Jelszó:</td> <td><input type="password" name="pass1" value=""><br/></td>
        </tr>
        <tr>
            <td>Jelszó még egyszer:</td><td> <input type="password" name="pass2" value=""><br/></td>
        </tr>
        <tr>
            <td>Telefonszám:</td><td> <input type="text" name="tel" value="<?php echo $tel ?>"><br/></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center"><input type="submit" style=" background-color: #009900; width: 200px; height: 50px; font-size: large; font-family: monospace; font-weight: bold" name="btn_regsubmit" value="Regisztrálok"></td>
        </tr>
    
    </table>
    
</form>
</div>