<?php
//encodeRoutage(162)
require ('../sources/events/objets/sqlEvents.php');
$addEvent = new SQLEvents ();
$arrayKeys =['nameEvent', 'objetEvent', 'dateEvent', 'hourEvent', 'numberParticipants', 'idNameGame', 'idLocation', 'idEvent',  'valid'];
$controle_POST = array();
$mark = [1];
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $addEvent->checkValideDate(filter($_POST[$arrayKeys[2]]), 'Y-m-d'));
    array_push($controle_POST, $addEvent->isValidTime(filter($_POST[$arrayKeys[3]]), 'H:i'));
    array_push($mark, true);
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 80));
    array_push($mark, 0);
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[1]]), 750));
    array_push($mark, 0);
    array_push($controle_POST, $addEvent->isNumberOfParticipant (filter($_POST[$arrayKeys[4]]), [1, 6]));
    array_push($mark, true);
    array_push($controle_POST, $addEvent->checkGame(filter($_POST[$arrayKeys[5]])));
    array_push($mark, 1);
    array_push($controle_POST, filter($_POST[$arrayKeys[8]]));
    array_push($mark, true);
    array_push($controle_POST, $addEvent->checkIdLocation (filter($_POST[$arrayKeys[6]])));
    array_push($mark, 1);
    array_push($controle_POST,$addEvent->checkOwenerEvent (filter($_POST[$arrayKeys[7]])));
    array_push($mark, 1);
} else {
    header('location:../index.php?message=You didn\'t check the checkbox. &idNav='.$idNav.'&idEvent='.filter($_POST[$arrayKeys[7]]));
    exit();
}
array_pop($_POST);
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $eventAndDate = array();
    array_push($eventAndDate, $param[7]);
    array_push($eventAndDate, $param[2]);
    $addEvent->updateEventAndDate ($eventAndDate);
    $idEvent = $addEvent->updateEvent ($param);
    header('location:../index.php?message=Update event success to record&idNav='.$idNav.'&idEvent='.filter($_POST[$arrayKeys[7]]));
    exit();
} else {
    header('location:../index.php?message=Update event no update&idNav='.$idNav.'&idEvent='.filter($_POST[$arrayKeys[7]]));
    exit();
}