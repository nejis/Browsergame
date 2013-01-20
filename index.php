<?php
session_start();

if (isset($_GET['index']) && $_GET['index'] == "1")
  {
    session_destroy(); 
		$_SESSION = array(); 
		session_start();
  }
      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <title>Star Evolution</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <!--<script src="js/allgemein.js" type="text/javascript" charset="utf-8"></script>-->
    <link rel="stylesheet" type="text/css" href="css/effeckte.css">
    <link rel="stylesheet" type="text/css" href="css/menue.css">   
  </head>
  <body>
  <div id="horizont">
    <div id="einloggen">
  <?php
    include "einloggen.php";
    include "schutz_seite_index_inc.php";
  ?>
    </div>
  </div>
  
  <?php  
  
   echo' <div id="wrapper">';
   echo' <div id="kopf">
           <div id="menu">
             <ul><li><a href="index.php?art=startseite">Home</a></li></ul>
             <ul><li><a href="index.php?art=spiel">&Uuml;ber ?</a></li></ul>
             <ul><li><a href="index.php?art=media">Media</a></li></ul>  
             <ul><li><a href="index.php?art=registrieren">Registrieren</a></li></ul> 
           </div>  
         </div>';
         
   echo' <div id="text">'; 
   
   if (!isset($_GET['art']))
	{
		$_GET['art'] = "startseite";
	}   
         switch($_GET['art']) 
         {
             case "startseite":
              echo'Hier kommt ein Bild mit Text rein.';            
             break;
             case "spiel":
             echo'Hier kommt alles wichtige &uuml;ber das Spiel rein.'; 
             break;
             case "media":
             echo'Hier kann man sich Videos und Bilder angucken? Was f&uuml;r welche ka mal sehen.'; 
             break;
             case "registrieren":      
                    
             echo'<table>             
					        <form action="index.php?art=registrieren2" method="post">
					     	  <tr><td>Vorname:</td><td><input type="text" name="vorname" maxlength="30" /></td></tr>
					     	  <tr><td>Nachname:</td><td><input type="text" name="nachname"  maxlength="30" /></td></tr>
						      <tr><td>Spielername:</td><td><input type="text" name="nickname"  maxlength="20" /></td></tr>
						      <tr><td>E-Mail:</td><td><input type="text" name="email"  maxlength="30" /></td></tr>
						      <tr><td>Passwort:</td><td><input type="password" name="passwort[0]"  maxlength="30" /></td></tr>
						      <tr><td>Passwort wdh.:</td><td><input type="password" name="passwort[1]"  maxlength="30" /></td></tr>
						      <tr>
						      <td>Geb.:</td>
						      <td>';
             
             echo '<select name="tag">';
          	 for ($tag = "1";$tag <= "31";$tag++)
          			{    						
          			  echo '<option value="'.$tag.'" selected="selected">'.$tag.'</option>';	    							
          			}
          	 echo '</select>';
          	 
          	 echo '<select name="monat">';
          	 for ($monat = "1";$monat <= "12";$monat++)
          			{
          			  echo '<option value="'.$monat.'" selected="selected">'.$monat.'</option>';	    							
          			}
          	 echo '</select>';
          	 
          	 echo '<select name="jahr">';
          	 
          	 for ($jahr = "1950";$jahr <= date("Y");$jahr++)
          			{
          			  echo '<option value="'.$jahr.'" selected="selected">'.$jahr.'</option>';	    							
          			}
          	 echo '</select>';
                    
						 echo'</td></tr>
						      <tr><td><input type="submit" value="Fertig" name="register" /></td></tr>
						      </form>
						      </table>'; 						 					      
						               
             break;
             case "registrieren2":             
                                     
            if(!empty($_POST["vorname"]) && !empty($_POST["nachname"]) && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["passwort"]))	{
            		
            			if($_POST["passwort"][0] !== $_POST["passwort"][1])	{
                	$error_msg = "Die Passwörter stimmen nicht überein.";
                	}
                  
                  $_POST["passwort"] = md5($_POST["passwort"][0]);
              
                  if(strlen($_POST["nickname"]) > 20)	{
                  	$error_msg = "Der Benutzername ist zu lang.";	                  	
                  }
                  
                  $_POST["nickname"] = trim($_POST["nickname"]);
                  
                  if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))	{
                  	$error_msg = "Die E-Mail-Adresse ist ungültig.";                  	
                  }            
                           				
                }                
                else  {
                  $error_msg = "Das Formular wurde nicht vollständig ausgefüllt.";	
                } 
                
                if(!isset($error_msg))  {
                
                	$serverhost  = "ftp.lima-city.de";
									$serverlogin = "starevolution";
									$serverpass  = "linux2012p1";
									$dbname 		 = "db_270008_1";
							                      
                  $db = new mysqli($serverhost, $serverlogin, $serverpass, $dbname) or die("Keine Verbindung zum Server!");                  
                  $sql = "INSERT INTO `member`(`Vorname`, `Nachname`, `Spielername`, `Email`, `Passwort`, `Datum`) VALUES (?, ?, ?, ?, ?, NOW())";
                                      
                  $stmt = $db->prepare($sql);
                  $stmt->bind_param('sssss', $_POST["vorname"], $_POST["nachname"], $_POST["nickname"], $_POST["email"], $_POST["passwort"]);
                  
                  if(!$stmt->execute())	{                  	
                  	if(strpos($db->error, 'Duplicate') !== false)	{
                  			$error_msg = "Der Benutzername oder die E-Mail wurde bereits verwendet.";
                  			 if(isset($error_msg) && !empty($error_msg)) {  						 
			        						 echo'<div style="border:2px solid red; padding:10px;">';
			        						 echo $error_msg;
			        						 echo'</div>';        						 
		        						 } 
                  	} else {                   	                 	
                  	 		$error_msg = "Es ist ein Fehler aufgetreten.";
                  	}                  	
                  }
                  else {
                  $success_msg = "Das Benutzerkonto ".htmlspecialchars($_POST["nickname"])." wurde erfolgreich angelegt.";
                  
	                  if(isset($success_msg) && !empty($success_msg)) {         						 
		        					echo'<div style="border:2px solid green; padding:10px;">';
		        					echo $success_msg;
		        					echo'</div>';
	        					}  
                  }
                  
                  $stmt->close();
                  $db->close();        					                    
                }
                else {
                
                	echo'<table>             
					        <form action="index.php?art=registrieren2" method="post">
					     	  <tr><td>Vorname:</td><td><input type="text" name="vorname" maxlength="30" /></td></tr>
					     	  <tr><td>Nachname:</td><td><input type="text" name="nachname"  maxlength="30" /></td></tr>
						      <tr><td>Spielername:</td><td><input type="text" name="nickname"  maxlength="20" /></td></tr>
						      <tr><td>E-Mail:</td><td><input type="text" name="email"  maxlength="30" /></td></tr>
						      <tr><td>Passwort:</td><td><input type="password" name="passwort[0]"  maxlength="30" /></td></tr>
						      <tr><td>Passwort wdh.:</td><td><input type="password" name="passwort[1]"  maxlength="30" /></td></tr>
						      <tr>
						      <td>Geb.:</td>
						      <td>';
             
			             echo '<select name="tag">';
			          	 for ($tag = "1";$tag <= "31";$tag++)
			          			{    						
			          			  echo '<option value="'.$tag.'" selected="selected">'.$tag.'</option>';	    							
			          			}
			          	 echo '</select>';
			          	 
			          	 echo '<select name="monat">';
			          	 for ($monat = "1";$monat <= "12";$monat++)
			          			{
			          			  echo '<option value="'.$monat.'" selected="selected">'.$monat.'</option>';	    							
			          			}
			          	 echo '</select>';
			          	 
			          	 echo '<select name="jahr">';
			          	 
			          	 for ($jahr = "1950";$jahr <= date("Y");$jahr++)
			          			{
			          			  echo '<option value="'.$jahr.'" selected="selected">'.$jahr.'</option>';	    							
			          			}
			          	 echo '</select>';
			                    
									 echo'</td></tr>
									      <tr><td><input type="submit" value="Fertig" name="register" /></td></tr>
									      </form>
									      </table>';
                
                     if(isset($error_msg) && !empty($error_msg)) {  
						 
        						 echo'<div style="border:2px solid red; padding:10px;">';
        						 echo $error_msg;
        						 echo'</div>';        						 
        						 } 
                }     
                 
             break;
         }   
   echo' </div>';
   echo' </div>';
   echo'
   <div id="fuss">
   <div id="fuss_2"><p><a>Impressum</a> | <a>Datenschutzerkl&auml;rung</a></p></div>
   <div id="fuss_3"><p><a>Kontakt</a></p></div>
   </div>';  
   ?>
  </body>
</html>