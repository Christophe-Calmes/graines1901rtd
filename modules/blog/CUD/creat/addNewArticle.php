<?php 
// encodeRoutage(129)
require ('../modules/blog/objects/sqlBlog.php');
$addNewArticle = new SQLBlog ();
$arrayKeys = ['title', 'article', 'meta', 'publish', 'id_subject'];
$controle_POST = array();
$mark = [true];
if(checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $checkId->controleInteger(filter($_POST[$arrayKeys[3]])));
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[2]]), 60));
    array_push($mark, 0);
    array_push($mark, 0);
}
if($mark == $controle_POST) {
    $id_subject =  filter($_POST['id_subject']);
    array_pop($_POST);
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $addNewArticle ->creatNewArticle ($param, $id_subject);
    header('location:../index.php?message=New article success to record&idNav='.$idNav);
    exit();
} else {
    header('location:../index.php?message=New article fail to record&idNav='.$idNav);
    exit();
}