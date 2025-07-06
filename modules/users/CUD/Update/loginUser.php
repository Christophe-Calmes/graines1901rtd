<?php
require('../modules/users/objets/getUser.php');
$changePseudo = new GetUser ();
$arrayKeys = ['login'];
$control_POST = array();
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
  array_push($control_POST, sizePost(filter($_POST[$arrayKeys[0]]), 15));
  array_push($control_POST, $changePseudo->checkNoUsedPseudoBeforChange (filter($_POST[$arrayKeys[0]])));
  array_push($mark, true);
}
if($mark == $control_POST) {
   $parametre = new Preparation ();
  $param = $parametre->creationPrepIdUser ($_POST);
  $changePseudo->changePseudo ($param);
  header('location:../index.php?message=Update pseudo succefulld&idNav='.$idNav);
    exit();
} else {
    header('location:../index.php?message=Pseudo is not available&idNav='.$idNav);
      exit();
}
