<?php
session_start(); 
ob_start();
include ("inc/connect.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css.css" rel="stylesheet" type="text/css" />
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>

<body>
    <div align="center" >
<div align="center" id="main">
<!--header kezdete-->
	<div id="header">
    	<div id="reklam">
 
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="670" height="50" id="FlashID2" title="reklam_flash">
          <param name="movie" value="flash/reklam.swf" />
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" />
          <param name="swfversion" value="15.0.0.0" />
          <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you donâ€™t want users to see the prompt. -->
          <param name="expressinstall" value="Scripts/expressInstall.swf" />
          <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
          <!--[if !IE]>-->
          <object type="application/x-shockwave-flash" data="flash/reklam.swf" width="670" height="50">
            <!--<![endif]-->
            <param name="quality" value="high" />
            <param name="wmode" value="opaque" />
            <param name="swfversion" value="15.0.0.0" />
            <param name="expressinstall" value="Scripts/expressInstall.swf" />
            <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
            <div>
              <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
              <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
            </div>
            <!--[if !IE]>-->
          </object>
          <!--<![endif]-->
        </object>
      </div>
            <div id="logo"><a href="index.php">LOGO</a></div>



	</div>
<!-- header vĂ©ge-->
<!-- tartalom kezdete-->
<div id="tartalom">
    <div id="left">
    <div id="oldalmenu">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="150" height="570" id="FlashID" title="oldalmenu_flash">
  <param name="movie" value="flash/oldalmenu.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="15.0.0.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you donâ€™t want users to see the prompt. -->
  <param name="expressinstall" value="Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="flash/oldalmenu.swf" width="150" height="570">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="15.0.0.0" />
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
</div>
<!-- lehetĹ‘sĂ©gek kezdet -->

<div id="lehetosegek">
    
    
    
            <?php
            
            include ("inc/foto.php");
            
            ?>
        



</div>
<!-- lehetĹ‘sĂ©gek vĂ©ge -->
</div>
<div id="right">
      
      <div id="bejelentkezes">
        <div id="bejelentkezes_text">
            <?php 
                include ("inc/belepesurlap.php")
            ?>
          </div>
                    
        </div>

      
      <div id="almenu">
      <a href="#">Árlista</a><br/><br/>
      <a href="#">Rólunk</a><br/><br/>
      <a href="aluzenet.php">Üzenőfal</a><br/><br/>
      <a href="#">AKCIÓK</a><br/><br/>
      </div>
    </div>
</div>
</div>
<!-- tartalom vége-->
    </div>
</body>
</html>

