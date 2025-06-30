<?php
  // Réinitialisation du token
  require_once ('functions/functionToken.php');
  require('modules/securiter/object/securingConnections.php');

  $disconnectUser = new SecuringConnections ($_SERVER['REMOTE_ADDR']);
  $disconnectUser->disconnectUser ();
