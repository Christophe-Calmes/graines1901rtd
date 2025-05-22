<?php
// encodeRoutage(133)
require ('../modules/blog/objects/sqlBlog.php');
$deleteArticle = new SQLBlog ();
$arrayKeys = ['idArticle'];
$controle_POST = array();
$mark = [true];
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $deleteArticle->checkIdArticle (filter($_POST[$arrayKeys[0]])));
}
if($mark == $controle_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $deleteArticle->deleteArticleByOwner ($param);
    header('location:../index.php?message=Delete article success');
} else {
    header('location:../index.php?message=Delete article fail');
}