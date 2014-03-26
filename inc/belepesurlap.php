<?php
if(isset($_SESSION["belepve"])){
    echo "<h1 style=' font-family: monospace; font-size: large'>Kedves ".$_SESSION["username"]."</h1><br/>"
            . "<font style=' font-family: monospace; font-size: large'> Be vagy lépve</font><br/></br><br/>";
    echo "<a href=inc/kilep.php><font style=' font-size:  large '>KILÉPÉS</a></font><br/><br/></br>";
    echo "<a href=jelszovalt.php><font style=' font-size:  large '>Jelszóváltoztatás</font></a>";
    echo '<div id="kosar">
        <a href="alkosar.php"><img src="image/kosar.png" width="50" height="50" alt="kosar" /><font style=" font-size:  large ">KOSÁR</font></a>
        </div>';
    
    
}

else{
    if (isset($_POST["btn_login"])){
        if(empty($_POST["email"]) || empty($_POST["pass"])){
            echo "Felhasználónév és jelszó kötelező";
        }
        else{
//            echo "beléptetés";
            $email=$_POST["email"];
            $sql="SELECT * FROM felhasznalo WHERE email='$email'";
            $lekeres= mysql_query($sql) or die(mysql_error());
            
            if(mysql_num_rows($lekeres)==1){
//                echo "létező felhasználó";
                $user= mysql_fetch_assoc($lekeres);
                if(md5($_POST["pass"]) == $user["jelszo"]){
                    $_SESSION["belepve"]=1;
                    $_SESSION["email"]=$user["email"];
                    $_SESSION["username"]=$user["felhasznalonev"];

                    ob_end_clean();
                    header("Location:index.php");
                    die();
                                      
                }
                else{
                    echo"Nem jó a jelszó";
                }
            }
        
            else {
                echo "Nem létező felhasználó";
            }
        
    }
    }
    ?>






<form method="POST" action="">
    <br/><br/>
    <font style=" font-family: monospace; font-size: large">
    E-mail:</font><br/>
    <input type="text" name="email" value=""><br/><br/>
    <font style=" font-family: monospace; font-size: large">
    Jelszó:</font><br/>
    <input type="password" name="pass" value=""><br/><br/>
    <input type="submit" style=" background-color: #009900; width: 100px; height: 25px; font-size:  medium; font-family: monospace;" name="btn_login" value="Belépés"><br/><br/><br/><br/>
    <a href="ujjelszokeres.php"><font style=" font-size:  large ">Új jelszó kérése</font></a><br/><br/><br/><br/>
    <a href="alregisztracio.php"><font style=" font-size:  large ">REGISZTRÁCIÓ</font></a><br/><br/>

   
   
    
    
        
</form>
<?php } ?>
