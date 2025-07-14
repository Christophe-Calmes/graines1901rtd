<?php
// encodeRoutage(149)
require('../modules/accouting/objets/SQLaccounting.php');
require ('../modules/Membership/objects/SQLmembership.php');
$member = new SQLmembership ();
$accouting = new SQLaccounting ();
$arrayKeys = ['idBilan', 'valid'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $accouting-> checkBilan (filter($_POST[$arrayKeys[0]])));
    array_push($mark, true);
    array_push($controle_POST, filter($_POST[$arrayKeys[1]]));
    array_push($mark, true);
}
unset($_POST['valid']);
if($mark == $controle_POST) {
    $idUser = $checkId->idUser($_SESSION);
    $accouting->closeAndOpenBilan ($idUser);
    $member->resetCotisation ();
    header('location:../index.php?message=Close Bilan success&idNav='.$idNav);
    exit();
} else {
    header('location:../index.php?message=Close bilan fail to record&idNav='.$idNav);
    exit();
}
