<?php
// encodeRoutage(160)
require ('../sources/events/objets/sqlEvents.php');
$gameType = new sqlEvents ();
$arrayKeys =  ['idTypeGame'];
$controle_POST = array();
$mark = [1];
if (checkPostFields($arrayKeys, $_POST)) {
     array_push($controle_POST, $gameType->checkIdTypeGame (filter($_POST[$arrayKeys[0]]))); 
   
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $gameType->updateValideGameType ($param);
 header('location:../index.php?message=Update game type success to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
 exit();
} else {
    header('location:../index.php?message=Update game type fail to record&idNav='.$idNav.'&idGame='.filter($_POST['idGame']));
    exit();
} 
