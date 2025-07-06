<?php
require('../modules/users/objets/getUser.php');
$changePassword = new GetUser ();
$arrayKeys = ['mdp', 'mdpA'];
$control_POST = array();
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
  array_push($control_POST, sizePost(filter($_POST[$arrayKeys[0]]), 15));
  array_push($control_POST, $changePassword->passwordControle ($_POST));
  array_push($mark, true);
}
if($mark == $control_POST) {
  array_pop($_POST);
  $_POST['mdp'] = haschage(filter($_POST['mdp']));
  $parametre = new Preparation();
  $param = $parametre->creationPrepIdUser ($_POST);
  $changePassword->changePassword ($param);
  session_destroy();
  $_SESSION = array();
  header('location:../index.php?message=Update password succefulld');
  exit();
} else {
    header('location:../index.php?message=Your new password is not available&idNav='.$idNav);
    exit();
}
