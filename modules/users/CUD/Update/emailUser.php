<?php
require('../modules/users/objets/getUser.php');
$changeEmailUser = new GetUser ();
$arrayKeys = ['email'];
$control_POST = array();
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
      array_push($control_POST, sizePost(filter($_POST[$arrayKeys[0]]), 80));
      array_push($control_POST, $changeEmailUser->checkNoUseEmailBeforeChange (filter($_POST[$arrayKeys[0]])));
      array_push($mark, true);
}
if($mark == $control_POST) {
    $parametre = new Preparation ();
    $param = $parametre->creationPrepIdUser ($_POST);
    $changeEmailUser->changeEmailUser ($param);
  header('location:../index.php?message=Update email succefulld&idNav='.$idNav);
    exit();
} else {
    header('location:../index.php?message=Email is not available&idNav='.$idNav);
      exit();
}
