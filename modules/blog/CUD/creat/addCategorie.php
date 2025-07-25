<?php
// encodeRoutage(130)
require ('../modules/blog/objects/sqlBlog.php');
$addNewCategorie = new SQLBlog ();
$arrayKeys = ['subject', 'occurance'];
$controle_POST = [0];
$mark = array();
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($mark, 0);
    array_push($mark, 0);
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $addNewCategorie->creatNewCategorie ($param);
    header('location:../index.php?message=New subject success to record&idNav='.$idNav);
        exit();
} else {
    header('location:../index.php?message=New subject fail to record&idNav='.$idNav);
        exit();
}