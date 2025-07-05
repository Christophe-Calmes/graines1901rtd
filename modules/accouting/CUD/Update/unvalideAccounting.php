<?php
//  encodeRoutage(147)
require('../modules/accouting/objets/SQLaccounting.php');
$accouting = new SQLaccounting ();
$arrayKeys = ['id'];
$controle_POST = array();
$mark = [1];
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $accouting->getIdAct (filter($_POST[$arrayKeys[0]])));
    }
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $accouting->unvalideActe ($param);
    header('location:../index.php?message=Acte modification success to record&idNav='.$idNav);
} else {
    header('location:../index.php?message=Acte modification fail to record&idNav='.$idNav);
}