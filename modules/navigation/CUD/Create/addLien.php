<?php
include ('../functions/functionToken.php');
$arrayKeys = ['nomNav','cheminNav','menuVisible','ordre','niveau','zoneMenu','deroulant','idModule'];
$addNewMenu = new GetNavigation ();
$controle_POST = array();
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
  array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 30));
  array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[1]]), 80));
  array_push($mark, 0);
  array_push($controle_POST, borneSelect(filter($_POST[$arrayKeys[2]]), 1));
  array_push($mark, 0);
  array_push($controle_POST,borneSelect(filter($_POST[$arrayKeys[3]]), 15));
  array_push($mark, 0);
  array_push($controle_POST, $addNewMenu->checkAccreditionExist (filter($_POST[$arrayKeys[4]])));
  array_push($mark,  true);
  array_push($controle_POST, borneSelect(filter($_POST[$arrayKeys[5]]), 15));
  array_push($mark, 0);
  array_push($controle_POST, borneSelect(filter($_POST[$arrayKeys[6]]), 1));
  array_push($mark, 0);
  array_push($controle_POST, $addNewMenu->checkIdModuleExist (filter($_POST[$arrayKeys[7]])));
  array_push($mark, true);
}
if($mark == $controle_POST)  {
  $_POST['targetRoute'] = IntToken (15);
  $parametre = new Preparation ();
  $param = $parametre->creationPrep ($_POST);
  $addNewMenu->insertNewMenu  ($param);

 header('location:../index.php?message=New menu saved&idNav='.$idNav);
 exit();
} else {
  header('location:../index.php?message=New menu not saved&idNav='.$idNav);
   exit();
}

/*include '../functions/functionToken.php';
$sizeTable = [30, 80, 1, 3, 3, 5, 3, 3];
$postKey = array_keys($_POST);
for ($i=0; $i < count($postKey) ; $i++) {
array_push($controleForm, sizePost(filter($_POST[$postKey[$i]]), $sizeTable[$i]));
}
$qualite = array();
for ($i=0; $i < 9 ; $i++) {
  array_push($qualite, 0);
}
$_POST['targetRoute'] =  IntToken (16);
if($controleForm == $qualite) {
  $request = new InsertRequest();
  $insert = $request->requestInsert($_POST, 1, 'navigation');
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  ActionDB::access($insert, $param);
  header('location:../index.php?message=Nouveau lien enregistré&idNav='.$idNav);
} else {
  header('location:../index.php?message=Soucis de traitement de votre formulaire');
}*/
