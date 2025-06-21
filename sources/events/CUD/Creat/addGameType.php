<?php
// encodeRoutage(159)
require ('../sources/events/objets/sqlEvents.php');
$gameType = new sqlEvents ();
$arrayKeys =  ['typeGame', 'valid'];
$controle_POST = array();
$mark = [0];
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 40));
    array_push($controle_POST, filter($_POST[$arrayKeys[1]]));
    array_push($mark, true);
   
}
 array_pop($_POST);
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $gameType->insertNewGameType ($param); 
    header('location:../index.php?message=New game type success to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
} else {
    header('location:../index.php?message=New game type fail to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
} 