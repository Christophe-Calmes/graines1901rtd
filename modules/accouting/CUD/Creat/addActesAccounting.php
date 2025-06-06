<?php
// encodeRoutage(146)
require('../modules/accouting/objets/SQLaccounting.php');

$addActe = new SQLaccounting ();
$arrayKeys = ['formeBanquaire','montant','balance','numeroTransaction', 'objet'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[3]]), 60));
    array_push($mark, 0);
     array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[4]]), 255));
    array_push($mark, 0);
    array_push($controle_POST, $addActe->checkIndexTranscation(filter($_POST[$arrayKeys[0]])));
    array_push($mark, 1);
    array_push($controle_POST, $addActe->isNumber(filter($_POST[$arrayKeys[1]])));
    array_push($mark, 1);
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $addActe->addAccountingActe ($param);
    header('location:../index.php?message=New acte success to record&idNav='.$idNav);
} else {
    header('location:../index.php?message=New acte fail to record&idNav='.$idNav);
}