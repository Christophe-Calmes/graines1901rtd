<?php
// encodeRoutage(154)
require ('../sources/events/objets/sqlEvents.php');
$events = new sqlEvents ();
$arrayKeys =  ['nameLocation','adress','city','zipCode','phone', 'valid', 'idLocation'];
$controle_POST = array();
$mark = [1];
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $events->checkIdLocation (filter($_POST[$arrayKeys[6]])));
    $controle = [120, 255, 90, 5, 18];
    for ($i=0; $i <count($controle) ; $i++) { 
        array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[$i]]), $controle[$i]));
        array_push($mark, 0);
    }
}

if(($mark == $controle_POST)&&($mark != [])) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    print_r($param);
    $events->updateLocation ($param);
    header('location:../index.php?message=Update location success to record&idNav='.$idNav.'&idLocation='.filter($_POST[$arrayKeys[6]]));
} else {
    header('location:../index.php?message=Update location fail to record&idNav='.$idNav.'&idLocation='.filter($_POST[$arrayKeys[6]]));
}