<?php
session_start();

include "schutz_seite_spiel_inc.php";

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
    <title>New Document</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="css/spiel_effeckte.css">
    <link rel="stylesheet" type="text/css" href="css/spiele_menue.css">    
		<script src="js/allgemein.js" type="text/javascript" charset="utf-8"></script>
    
  </head>
  <body onload="UHR_Start()">

    <div id="horizont">
    <div id="einloggen">
    	
    <?php
    echo'<table><tr><td>';
    echo'<font id="ur" color="#fff"></font>';
    echo" Willkommen zurück Commander ".$_SESSION["benutzer"]."</td>";
    echo'
    <td><form action="index.php" method="post">  
    <input type="submit" value="zur&uuml;ck" id="logoff" />
    </form></td>
    <td><form action="index.php?index=1" method="post">  
    <input type="submit" value="Logoff" id="logoff" />
    </form></td>    
    </tr>
    </table>
    </div>
    </div>
     <div id="wrapper">
      <div id="main">
       <div id="text_links">
        <div id="menu">
        <ul><object data="flash/planeten/planet1.swf" type="image/svg+xml" width="180">
            <param name="planet" >
            Ihr Browser kann das Objekt leider nicht anzeigen!
            </object></ul>
          <ul><li><a href="spiel.php?art=planet">Planet</a></li></ul>
          <ul>
            <li><a>Geb&auml;ude</a>
              <ul>      	
				      	<li><a href="spiel.php?art=infrastruktur">Infrastruktur</a></li>
				        <li><a href="spiel.php?art=militaer">Milit&auml;r</a></li>
                <li><a href="spiel.php?art=abbau">Abbau</a></li>
				      </ul>
            </li>
          </ul>
          <ul>
            <li><a>Forschung</a>
              <ul>      	
				      	<li><a href="spiel.php?art=f_gebaeude">Geb&auml;ude</a></li>
				        <li><a href="spiel.php?art=f_fahrzeuge">Fahrzeuge</a></li>
                <li><a href="spiel.php?art=f_raumschiffe">Raumschiffe</a></li>
                <li><a href="spiel.php?art=f_verteidigung">Verteidigung</a></li>
				      </ul>
            </li>
          </ul>  
          <ul><li><a href="spiel.php?art=fahrzeuge">Fahrzeuge</a></li></ul>
          <ul><li><a href="spiel.php?art=schiffe">Schiffe</a></li></ul> 
          <ul>
            <li><a>Verteidigung</a>
              <ul>      	
				      	<li><a href="spiel.php?art=landwehr">Landwehr</a></li>
				        <li><a href="spiel.php?art=raumwehr">Raumwehr</a></li>
				      </ul>
            </li>
          </ul>
          <ul><li><a href="spiel.php?art=commandanten">Commandanten Kaufen</a></li></ul>
          <ul><li><a href="spiel.php?art=punkte">Punkte Kaufen</a></li></ul>
          <ul><li><a href="spiel.php?art=kolonien">Kolonien</a></li></ul>
          <ul><li><a href="spiel.php?art=corperation">Corperation</a></li></ul>
          <ul><li><a href="spiel.php?art=karte">Galaxis Karte</a></li></ul>
        </div>  
       </div>';
        echo'<div id="text_rechts">';
         
         switch($_GET['art'])
         {
            case "planet":            
            echo'<h1>Planet:PX501</h1><object data="flash/laga.swf" type="image/svg+xml" width="750" height="565" id="basis">
            <param name="planet" >
            Ihr Browser kann das Objekt leider nicht anzeigen!
            </object>Hier kommt der Planet und eine &Uuml;bersicht &uuml;ber alles m&ouml;glich hin.';
            break;
            case "infrastruktur":
            echo'<h1 id="test">2</h1>Hier kommen Geb&auml;ude hin die den Planeten helfen und ausbauen.';
            break;
            case "militaer":
            echo'<h1>3</h1>Hier kommen Geb&auml;ude f&uuml;r den Bau von schiffen Fahrzeugen und Defence hin.';
            break;
            case "abbau":           
            echo'<h1>4</h1>Hier kommen Geb&auml;ude f&uuml;r den Abbau von Reccourcen hin.';
            break;
            case "f_gebaeude":
            echo'<h1>5</h1>Hier werden Geb&auml;ude erforscht.';
            break;
            case "f_fahrzeuge":
            echo'<h1>6</h1>Hier werden Fahrzeuge und Waffen etc. erforscht.';
            break;
            case "f_raumschiffe":
            echo'<h1>7</h1>Hier werden Schiffe und Waffen etc. erforscht.';
            break;
            case "f_verteidigung":
            echo'<h1>8</h1>Hier wird Verteidigung und Waffen etc. erforscht.';
            break;
            case "fahrzeuge":
            echo'<h1>9</h1>Hier werden Fahrzeuge Gebaut.';
            break;
            case "schiffe":
            echo'<h1>10</h1>Hier werden Schiffe Gebaut.';
            break;
            case "landwehr":
            echo'<h1>11</h1>Hier wird boden Verteidigung gebaut.';
            break;
            case "raumwehr":
            echo'<h1>12</h1>Hier wird Planetare Verteidigung gebaut.';
            break;
            case "commandanten":
            echo'<h1>13</h1>Hier kann man Commandaten f&uuml;e Boden, Luft, Abbau, Forschung Kaufen die Bonus bringen.';
            break;
            case "punkte":
            echo'<h1>14</h1>Hier kann man Punkte kaufen mit dem man sich Rohstoffe und Commandantewn Kaufen kann.';
            break;
            case "kolonien":
            echo'<h1>15</h1>Hier werden deine Kolonien und Routen angezeigt wo du auch Transportieren kannst.';
            break;
            case "corperation":
            echo'<h1>16</h1>Hier wird deine Corp aufgelistet mit Membern und etc..';
            break;
            case "karte":
            echo'<h1>17</h1>Hier ist die Galaxis Karte mit allen Planeten und Spielern.';
            break;
         }        
         
       echo'</div>';
       echo'</div>';
       echo' <div id="fuss">
          <div id="fuss_2"><p><a>Impressum</a> | <a>Datenschutzerkl&auml;rung</a> </p></div>
          <div id="fuss_3"><p><a>Kontakt</a></p></div>
        </div>
     </div>';
   ?>
  </body>
</html>