<?php
//session_start();
require_once ("csere.php");
include ("connect.php");

if (!isset($_SESSION["belepve"])) {
    echo "<br/>Rendeléshez be kell lépned" . "<br/>"."Ha még nem regisztráltál, most megteheted";
            include ("regisztracio.php");
} else {
    if (isset($_POST["btn_rendeles"])) {

        //datum beállítása
        $t = time();
        $rendeles_datum = date("Y.m.d", $t);


        //session email hozzáadása az email változóhoz
        $email = $_SESSION["email"];
        //nyomtatas hozzáadása szolgáltatás id-hez
        $nyomtatas = 0;
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
        if (!isset($_POST["minoseg"]) || !isset($_POST["formatum"])) {
            $hiba[] = "Minőséget kell választanod!" . "<br/>";
        }

        //mennyiség ellenőrzés
        $mennyiseg = mysql_real_escape_string($_POST["mennyiseg"]);

        if (!is_numeric($mennyiseg) || $mennyiseg <= 0) {
            $hiba[] = "A mennyiség csak 0-nál nagyobb szám lehet!";
        }
        //sikeres rendelés esetén
        if (!isset($hiba)) {

            $formatum = $_POST["formatum"];
            $minoseg = $_POST["minoseg"];
            $meret="-";
            $hordozo="-";



//            echo "Sikeres rendeles";
            $szin = "-";
            if (isset($_POST["szin"])) {
                echo "lett szin valasztva" . "<br/>";
                $szin = $_POST["szinvalaszt"];
//                echo $szin."<br/>";
            }
//            echo $formatum."<br/>";
//            echo $minoseg."<br/>";
//            echo $mennyiseg."<br/>";
            $sql = "INSERT INTO `rendeles` (`szolgaltatas_id`, `fajlnev`, `efajlnev`, `minoseg`, `formatum`, `meret`, `hordozo`, `mennyiseg`, `kotes`, `felhasznalo_email`, `rendeles_datum`)"
                    . " VALUES ('$nyomtatas', '$filename', '$efilename', '$minoseg', '$formatum', '$meret', '$hordozo', '$mennyiseg', '$szin', '$email', '$rendeles_datum');";
            mysql_query($sql);
            


            if (mysql_errno() == 0) {
//                echo "Sikeres beiras";
            } else {
                die("SQL hiba" . mysql_error());
            }
                        ob_end_clean();
            header("Location:alkosar.php");
            die();





//            $adatok=array("print_filename"=>$filename, "mennyiseg"=>$mennyiseg, "szin"=>$szin, "mode"=> $modname, "print_formatum"=> $_POST["formatum"], "print_minoseg"=>$_POST["minoseg"]);
//            if(!isset($_SESSION["kosar"][$termekid]))
//            {
//                $_SESSION["kosar"][$termekid]=$adatok;
//                    print_r($_SESSION["kosar"][$termekid]);
//            }
        } else {
            echo "<br/><h1 style='color:red'>A következő hibák vannak:</h1><br/>";
            echo implode("<br/>", $hiba) . "<br/>";
        }
    }
    ?>
<div style="padding-top: 10px;">
    <h1 style=" font-family: monospace; font-size: large">Itt rendelheted meg a nyomtatásod!</h1></div>
    <form method="POST" action="" enctype="multipart/form-data"/>
    <table cellpadding="5px">
        <tr>
            <td>Töltsd fel a pdf fájlt!</td><td><input type="file" name="nyomtatnivalo"/></td>
    </tr>
    <tr>
        <td>Minőség:</td> <td><input type="radio" name="minoseg" value="fekete"/>Fekete<input type="radio" name="minoseg" value="szines"/>Szines</td>
    </tr>
    <tr >
        <td rowspan="4"  style=" border-left:  3px; border-left-style: dotted; border-left-color:  #009900; 
            border-top:  3px; border-top-style: dotted; border-top-color:  #009900;
            border-bottom:   3px; border-bottom-style: dotted; border-bottom-color:  #009900"  >Formátum:</td>
        <td style=" border-right:  3px; border-right-style: dotted; border-right-color:  #009900; border-top:  3px; border-top-style: dotted; border-top-color:  #009900;"> 
            <input type="radio" name="formatum" value="egyoldalas"/>Egyoldalas</td>
    </tr>
    <tr>
        <td style=" border-right:  3px; border-right-style: dotted; border-right-color:  #009900"><input type="radio" name="formatum" value="ketoldalas"/>Kétoldalas</td>
    </tr>
    <tr>
        <td style=" border-right:  3px; border-right-style: dotted; border-right-color:  #009900"><input type="radio" name="formatum" value="egyoldalas_kicsi"/>Egyoldalas kicsinyített</td>
    </tr>
    <tr>
        <td style=" border-right:  3px; border-right-style: dotted; border-right-color:  #009900; border-bottom:   3px; border-bottom-style: dotted; border-bottom-color:  #009900"><input type="radio" name="formatum" value="ketoldalas_kicsi"/>Kétoldalas kicsinyített</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center">Kérek kötést<input type="checkbox" name="szin" value="1"/></td>
    </tr>
    <tr>
    <td colspan="2" style="text-align: center"><select  name="szinvalaszt" >
        <option value="fekete">Fekete</option>
        <option value="feher">Fehér</option>
        <option value="kek">Kék</option>
        <option value="zold">Zöld</option>
        <option value="sarga">Sárga</option>
        <option value="piros">Piros</option>


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



