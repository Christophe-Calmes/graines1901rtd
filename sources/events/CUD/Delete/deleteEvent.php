<?php
// encodeRoutage(156)
require ('../sources/events/objets/sqlEvents.php');
$deleteEvent = new sqlEvents ();
$arrayKeys =['valid', 'idEvent'];
$controle_POST = array();
$mark = [true];
if (checkPostFields($arrayKeys, $_POST)) {
// checkIdEvent ($idEvent)
    array_push($controle_POST, filter($_POST[$arrayKeys[0]]));
    array_push($controle_POST, $deleteEvent->checkIdEvent(filter($_POST[$arrayKeys[1]])));
    array_push($mark, 1);
}
array_shift($_POST);
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $deleteEvent->deleteOneEventByOwner ($param);
    header('location:../index.php?message=Delete event success to record&idNav='.$idNav);
} else {
    header('location:../index.php?message=Delete event fail to record&idNav='.$idNav);
}