<?php 
// encodeRoutage(65)
require ('../modules/journaux/objects/SQLbanIP.php');
$regex = '/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/';
$arrayKey = ['BanIP'];
$controlePostData = array();
if(checkPostFields ($arrayKey, $_POST)) {
    array_push($controlePostData, sizePost($_POST['BanIP'], 15));
    if (preg_match($regex, filter($_POST['BanIP']))) {
        array_push($controlePostData, 1);
    }        
}
$mark = [0, 1];
if($controlePostData == $mark) {
    $insertBanIP = new SQLFireWall ();
    $insertBanIP->addIPBan (filter($_POST['BanIP']));
    return header('location:../index.php?idNav='.$idNav.'&message=Add delete IP success');
} else {
    return header('location:../index.php?idNav='.$idNav.'&message=Add delete IP fail');
}
