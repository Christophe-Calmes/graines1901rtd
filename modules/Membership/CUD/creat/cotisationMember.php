<?php
// encodeRoutage(143)
require_once ('../modules/Membership/objects/SQLmembership.php');
require_once ('../functions/functionToken.php');
$addNewMember = new SQLmembership ();
$arrayKeys = ['idUser'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $addNewMember->checkIdUserExiste (filter($_POST[$arrayKeys[0]])));
    array_push($mark, 1);
}

if($mark == $controle_POST) {
    $_POST['MemberNumber'] = date('Y').genToken (8);
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $addNewMember->creatNewMember ($param);
    header('location:../index.php?message=New member success to record&idNav='.$idNav);
} else {
    header('location:../index.php?message=New fail to record&idNav='.$idNav);
}