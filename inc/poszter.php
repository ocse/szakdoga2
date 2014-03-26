<?php
//session_start();
require_once ("csere.php");
include ("connect.php");

if (!isset($_SESSION["belepve"])) {
    echo "Rendeléshez be kell lépned" . "<br/>"."Ha még nem regisztráltál, most megteheted";
            include ("regisztracio.php");
} else {
    if (isset($_POST["btn_rendeles"])) {

        //datum beállítása
        $t = time();
        $rendeles_datum = date("Y.m.d", $t);


        //session email hozzáadása az email változóhoz
        $email = $_SESSION["email"];
        //nyomtatas hozzáadása szolgáltatás id-hez
        $nyomtatas = 1;
        // van-e feltöltve fájl ellenőrzése
        if ($_FILES["nyomtatnivalo"]["name"] == "") {
            $hiba[] = "Nem töltöttél fel fájlt!" . "<br/>";
        } else {
            $types = array("pdf");
            $maxsize = 5120000;
            $efilename = $_FILES["nyomtatnivalo"]["name"];
            $filename = ekezetnelkul($_FILES["nyomtatnivalo"]["name"]);
            //kiterjesztes ellenorzese
            $modname = strtolower(array_pop(explode(".", $filename)));
            $filename = ekezetnelkul(strtolower($_SESSION["username"] . time() . $_FILES["nyomtatnivalo"]["name"]));
            if (!in_array($modname, $types)) {
                $hiba[] = "Csak pdf fájlt tölthetsz fel!" . "<br/>";
            }
            //méret ellenőrzése
            if ($_FILES["nyomtatnivalo"]["size"] > $maxsize) {
                $hiba[] = "Túl nagy a fájl mérete!" . "<br/>";
            }
            move_uploaded_file($_FILES["nyomtatnivalo"]["tmp_name"], "inc/upload/" . $filename);
//                echo $filename;
        }


        //rádiógomb ellenőrzés
        

        //mennyiség ellenőrzés
        $mennyiseg = mysql_real_escape_string($_POST["mennyiseg"]);

        if (!is_numeric($mennyiseg) || $mennyiseg <= 0) {
            $hiba[] = "A mennyiség csak 0-nál nagyobb szám lehet!<br/>";
        }
        
        if (!isset($_POST["minoseg"])) {
            $hiba[] = "Minőséget kell választanod!" . "<br/>";
        }
        //sikeres rendelés esetén
        if (!isset($hiba)) {

            
            $minoseg = $_POST["minoseg"];
            $formatum = "-";
            $hordozo = $_POST["hordozo"];


//            echo "Sikeres rendeles";
            $szin = "-";
            $meret = $_POST["meret"];
           
//            echo $formatum."<br/>";
//            echo $minoseg."<br/>";
//            echo $mennyiseg."<br/>";
            $sql = "INSERT INTO `rendeles` (`szolgaltatas_id`, `fajlnev`, `efajlnev`, `minoseg`, `formatum`,`meret`, `mennyiseg`, `kotes`, `felhasznalo_email`, `rendeles_datum`)"
                    . " VALUES ('$nyomtatas', '$filename', '$efilename', '$minoseg', '$formatum','$meret', '$mennyiseg', '$szin', '$email', '$rendeles_datum');";
            mysql_query($sql);

            ob_end_clean();
            header("Location:alkosar.php");
            die();
            if (mysql_errno() == 0) {
//                echo "Sikeres beiras";
            } else {
                die("SQL hiba" . mysql_error());
            }





//            $adatok=array("print_filename"=>$filename, "mennyiseg"=>$mennyiseg, "szin"=>$szin, "mode"=> $modname, "print_formatum"=> $_POST["formatum"], "print_minoseg"=>$_POST["minoseg"]);
//            if(!isset($_SESSION["kosar"][$termekid]))
//            {
//                $_SESSION["kosar"][$termekid]=$adatok;
//                    print_r($_SESSION["kosar"][$termekid]);
//            }
        } else {
            echo "<br/><h1 style='color:red'>A következő hibák vannak:</h1><br/>" . "<br/>";
            echo implode("<br/>", $hiba) . "<br/>";
        }
    }
    ?>
<div style="padding-top: 10px;">
    <h1 style=" font-family: monospace; font-size: large">Itt rendelheted meg a fotónyomtatásod!</h1></div>
    <form method="POST" action="" enctype="multipart/form-data"/>
    
    
        <table cellpadding="5px">
        <tr>
            <td>Töltsd fel a pdf fájlt!</td><td><input type="file" name="nyomtatnivalo"/></td>
    </tr>
    <tr>
        <td>Minőség:</td> <td><input type="radio" name="minoseg" value="fekete"/>Fekete<input type="radio" name="minoseg" value="szines"/>Szines</td>
    </tr>
       
    
    <tr>
        <td colspan="2" style="text-align: center">Méret: <select  name="meret" >
        <option value="A/0">A/0</option>
        <option value="A/1">A/1</option>
        <option value="A/2">A/2</option>
       


    </select></td>
    </tr>
    
        <tr>
        <td colspan="2" style="text-align: center">Hordozó: <select  name="meret" >
        <option value="vászon">vászon</option>
        <option value="180gr matt">180gr matt</option>
        <option value="180gr fényes fotópapir">180gr fényes fotópapir</option>
       


    </select></td>
    </tr>

    <tr>
        <td>Írja be a kért mennyiséget:</td><td><input type="text" name="mennyiseg" value=""/></td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center"><input type="submit" name="btn_rendeles" value="Kosárba"/></td>
    </tr>



    </table>

    
    </form>


    <?php
}
?>





