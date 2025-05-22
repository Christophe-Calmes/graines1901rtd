<?php
// encodeRoutage(141)
require ('../modules/blog/objects/sqlBlog.php');
$deletePictureForBlog = new SQLBlog ();
$arrayKeys = ['idPicture'];
$controle_POST = array();
$mark = [true];
if(checkPostFields ($arrayKeys, $_POST)) {
    array_push($controle_POST, $deletePictureForBlog->checkPictureExist (filter($_POST[$arrayKeys[0]])));
}
if($controle_POST == $mark) {
    $pictureName = $deletePictureForBlog->deletePicture (filter($_POST[$arrayKeys[0]]));
    $pathPictureToDelete = '../modules/blog/blogPictures/'.$pictureName;
    if(file_exists($pathPictureToDelete)) {
        unlink($pathPictureToDelete);
        header('location:../index.php?idNav='.$idNav.'&message=Delete miniature');
    }
} else {
    header('location:../index.php?idNav='.$idNav.'&message=Fail delete miniature');
}