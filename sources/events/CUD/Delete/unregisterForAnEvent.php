<?php
// encodeRoutage(158)
require ('../sources/events/objets/sqlEvents.php');
$events = new sqlEvents ();
$arrayKeys =  ['idEvent'];
$controle_POST = array();
$mark = [1];
if (checkPostFields($arrayKeys, $_POST)) {
      array_push($controle_POST, $events->checkIdEvent(filter($_POST[$arrayKeys[0]])));
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $events->DeleteEventParticipant ($param);
    header('location:../index.php?message=Successful event registration!&idNav='.$idNav);
} else {
    header('location:../index.php?message=Event registration failed!&idNav='.$idNav);
}