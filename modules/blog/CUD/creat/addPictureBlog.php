<?php
// encodeRoutage(134)
require ('../modules/blog/objects/sqlBlog.php');
require('../functions/functionToken.php');
$addPictureForBlog = new SQLBlog ();
$arrayKeys = ['altImg', 'carrousellePicture'];
$controle_POST = array();
$mark = [0];
if(checkPostFields ($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 60));
    array_push($controle_POST, controlePicture($_FILES, 120000, 'name_picture'));
    array_push($mark, 1);
}
if($controle_POST == $mark) {
    $namePicture = genToken (5).date('Y').filter($_FILES['name_picture']['name']);
    $_POST['name_picture'] = $namePicture;
    if(file_exists('../modules/blog/blogPictures')) {
        if(move_uploaded_file($_FILES['name_picture']['tmp_name'], $f='../modules/blog/blogPictures/'.$namePicture)) {
            chmod($f, 0644);
            $parametre = new Preparation ();
            $param = $parametre->creationPrepIdUser ($_POST);
            $addPictureForBlog->recordPictureBlog($param);
            return header('location:../index.php?message=Record new picture sucess.&idNav='.$idNav);
            exit();
        } else {
            return header('location:../index.php?message=The target file is not found.');
            exit();
        }
    } else {
        return header('location:../index.php?message=Record error !');
    }

} else {
    return header('location:../index.php?message=Record error !');
}