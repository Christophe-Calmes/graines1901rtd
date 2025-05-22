<?php
// encodeRoutage(63)
require('../modules/journaux/objects/SQLbanIP.php');
$controlePostData = array();
array_push($controlePostData, $checkId->controleInteger($_POST['id']));
$mark = [1];
if($mark == $controlePostData) {
    $deleteIPBan = new SQLFireWall ();
    $deleteIPBan->delIPban (filter($_POST['id']));
    return header('location:../index.php?idNav='.$idNav.'&message=Delete IP success');
} else {
    return header('location:../index.php?idNav='.$idNav.'&message=Delete IP fail');
}