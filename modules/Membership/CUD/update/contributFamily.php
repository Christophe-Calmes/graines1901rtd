<?php
// encodeRoutage(145)
require('../modules/Membership/objects/SQLmembership.php');
$member = new SQLmembership ();
$arrayKeys =['idUser','idFamily'];
$controle_POST = array();
$mark= array();
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $member->checkMember(filter($_POST[$arrayKeys[0]])));
    array_push($mark, 1);
    array_push($controle_POST, $member->checkMember(filter($_POST[$arrayKeys[1]])));
    array_push($mark, 1);
}
if($mark == $controle_POST) {
    $member->recordCotisation (filter($_POST[$arrayKeys[0]]), 9);
    $parametre = new Preparation ();
    $param = $parametre ->creationPrep ($_POST);
    $member->linkFamily ($param);
    header('location:../index.php?message=New membership success to record');
} else {
    header('location:../index.php?message=New membership fail to record');
}