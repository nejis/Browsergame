<?php

if(check_login() == false)	{
    echo'
    <table>
     <tr>
      <form name="login" action="index.php" method="post">
        <td>Benutzername: </td><td><input type="text" name="benutzer" id="login" /></td>
        <td>Passwort: </td><td><input type="password" name="passwort" id="login" /></td>
        <td><input type="submit" name="login" value="Anmelden" id="login" /></td>
      </form>';      
			$db = "";
			if(isset($error_msg) && !empty($error_msg)) {  						 
				echo $error_msg;
			}
}	else { 	
    echo'
    <table>
     <tr>
	     <td>Willkommen zurück Commander '.$_SESSION["benutzer"].'</td>
	     <td><form action="index.php?index=1" method="post">  
	     <input type="submit" value="Logoff" id="login" />
	     </form></td>
	     <td><form action="spiel.php?art=planet" method="post">  
	     <input type="submit" value="Spielen" id="login" />
	     </form></td>
     </tr>
    </table>';
}   

if(!isset($_POST["login"]))	return;

if(empty($_POST["benutzer"])&& empty($_POST["passwort"]))	{
	$error_msg = "Das Formular wurde nicht vollständig ausgefüllt.";
	return;
}

if(login($_POST["benutzer"], $_POST["passwort"], $db))	{
	header('Location: http://starevolution.lima-city.de/index.php');
}	else {
 	$error_msg = "Der Benutzername oder das Passwort ist falsch.";
}

function login($benutzer, $passwort, $db)	{
	$passwort = md5($passwort);
	
	$serverhost  = "ftp.lima-city.de";
	$serverlogin = "starevolution";
	$serverpass  = "linux2012p1";
	$dbname 		 = "db_270008_1";
                 
  $db = new mysqli($serverhost, $serverlogin, $serverpass, $dbname) or die("Keine Verbindung zum Server!");
	$sql = "SELECT COUNT(*) FROM member WHERE Spielername = ? AND Passwort = ?";
	$stmt = $db->prepare($sql);
	$stmt->bind_param('ss', $benutzer, $passwort);
	$stmt->execute();
	$stmt->bind_result($result);
	$stmt->fetch();
	$stmt->close();
	
	if($result == 1)	{
		$_SESSION["logged_in"] = true;
		$_SESSION["benutzer"] = $benutzer;
		return true;
	} else {
		return false;
	}
}

function check_login()	{
	if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true)	{
		return true;
	}
		return false;
}

/*$serverhost  = "ftp.lima-city.de";
$serverlogin = "starevolution";
$serverpass  = "linux2012p1";
$dbname 		 = "db_270008_1";*/