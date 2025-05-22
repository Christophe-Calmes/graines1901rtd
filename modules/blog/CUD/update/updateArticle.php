<?php
// encodeRoutage(132)
require ('../modules/blog/objects/sqlBlog.php');
$addNewArticle = new SQLBlog ();
$arrayKeys = ['title', 'article', 'meta', 'publish', 'id_subject', 'idArticle'];
$controle_POST = array();
$mark = [true];
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $checkId->controleInteger(filter($_POST[$arrayKeys[3]])));
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[2]]), 120));
    array_push($mark, 0);
    array_push($mark, 0);
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $addNewArticle->updateArticle ($param);
    header('location:../index.php?message=Update article success to record&idNav='.$idNav.'&idArticle='.filter($_POST[$arrayKeys[5]]));
} else {
    header('location:../index.php?message=Udpate article fail to record&idNav='.$idNav.'&idArticle='.filter($_POST[$arrayKeys[5]]));
}