<?php 
// encodeRoutage(64)
require ('../modules/journaux/objects/SQLbanIP.php');
$arrayKey = ['membre1', 'membre2', 'membre3', 'membre4'];
$controlePostData = array();
if(checkPostFields ($arrayKey, $_POST)) {
    array_push($controlePostData, $checkId->controleInteger($_POST['membre1']));
    array_push($controlePostData, $checkId->controleInteger($_POST['membre2']));
    array_push($controlePostData, $checkId->controleInteger($_POST['membre3']));
    array_push($controlePostData, $checkId->controleInteger($_POST['membre4']));
}
$ipBan = filter($_POST['membre1']).'.'.filter($_POST['membre2']).'.'.filter($_POST['membre3']).'.'.filter($_POST['membre4']);

$mark = [1, 1, 1, 1];
if($mark == $controlePostData) {
    $insertBanIP = new SQLFireWall ();
    $insertBanIP->addIPBan ($ipBan);
    return header('location:../index.php?idNav='.$idNav.'&message=Add delete IP success');
} else {
    return header('location:../index.php?idNav='.$idNav.'&message=Add delete IP fail');
}