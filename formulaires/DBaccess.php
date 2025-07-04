<?php
session_start();
require('../formulaires/subMissionRouterForm.php');
include ('../objets/objetsGeneraux.php');
include ('../functions/fonctionsDB.php');
include ('../modules/securiter/object/securingConnections.php');
include ('../modules/navigation/objets/getNavigation.php');
$ipCheck = new SecuringConnections ($_SERVER['REMOTE_ADDR']);
if($ipCheck->ipIsProhibited ()) {
  return header('location:../index.php?message=Can you contact the administrator with reference BLACK ICE 2093 ?');
  exit();
} else {
  $route = filter($_GET['route']);
  if(!empty($_SESSION)) {
  $checkId = new Controles();
  $border = $checkId->doublon("SELECT `token` FROM `users` WHERE `token` = :token", ':token' , $_SESSION['tokenConnexion']);
  } else {
    $border = 0;
  }
  $dataRoute = new GetNavigation();
  $form = new SecurityAndRouterForm ($_SESSION, $dataRoute->getFrom($route), $_SERVER['REQUEST_METHOD'], $_POST, $border);
  $idNav =  $form->setIdNav ();
  array_pop($_POST);
  include ($form->routingForm ());
  exit();
}
