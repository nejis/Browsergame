<?php

if(!isset($_SESSION["benutzer"]))
  {
    echo '<td>Kein Zugang zum Spiel!</td></tr></table>';
    echo '<p><a href="index.php">zur&uuml;ck zur Hauptseite</a></p>';
    exit;
  }

?>