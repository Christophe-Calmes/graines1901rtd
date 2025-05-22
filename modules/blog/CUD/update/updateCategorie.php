<?php
// encodeRoutage(131)
require ('../modules/blog/objects/sqlBlog.php');
$updateCategorie = new SQLBlog ();
$arrayKeys = ['subject', 'id', 'valid', 'occurance'];
$controle_POST = array();;
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($controle_POST, $updateCategorie->idCategorieExist (filter($_POST[$arrayKeys[1]])));
    array_push($mark, true);
    array_push($controle_POST, $checkId->controleInteger(filter($_POST[$arrayKeys[2]])));
    array_push($mark, true);
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $updateCategorie->updateCategorie ($param);
    header('location:../index.php?message=New subject success to update&idNav='.$idNav);
} else {
    header('location:../index.php?message=New subject fail to update&idNav='.$idNav);
}
