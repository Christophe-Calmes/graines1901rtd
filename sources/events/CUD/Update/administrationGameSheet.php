<?php
//  encodeRoutage(152)
require ('../sources/events/objets/sqlEvents.php');
$events = new sqlEvents ();
$arrayKeys =  ['nameGame','typeGame', 'valid', 'idGame'];
$controle_POST = array();
$mark = [0];
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($controle_POST, $events->checkIdTypeGame (filter($_POST[$arrayKeys[1]]))); 
    array_push($mark, 1);
}

if($mark == $controle_POST) {
  
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $events->updateGame ($param);
    header('location:../index.php?message=Update game success to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
} else {
    header('location:../index.php?message=Update game fail to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
} 