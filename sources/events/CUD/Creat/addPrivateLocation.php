<?php
//  encodeRoutage(176)
require ('../sources/events/objets/sqlEvents.php');
$events = new sqlEvents ();
$arrayKeys =  ['nameLocation','adress','city','zipCode','phone'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    $controle = [120, 255, 90, 5, 18];
    for ($i=0; $i <count($controle) ; $i++) { 
        array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[$i]]), $controle[$i]));
        array_push($mark, 0);
    }
}
if(($mark == $controle_POST)&&($mark != [])) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $events->recordNewPrivateLocation ($param);
    header('location:../index.php?message=New private location success to record&idNav='.$idNav);
} else {
    header('location:../index.php?message=New private location fail to record&idNav='.$idNav);
}
