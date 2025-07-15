<?php

include '../functions/functionToken.php';
// Security tests
$arrayKey = ['email', 'prenom', 'nom', 'login', 'mdp', 'mpdA', 'idNav'];
$security = array();
$stamp = array();
$test = false;
if(checkPostFields ($arrayKey, $_POST)) {
  if((filter($_POST['mpdA']) == filter($_POST['mdp']))){
    array_push($security, 0);
  } else {
    array_push($security, 1);
    return header('location:../index.php?message=Your confirmation password is different from your initial password');
  }
  if(strlen(filter($_POST['mpdA']))>9) {
    array_push($security, 0);
  } else {
    array_push($security, 1);
    $sizeMDP = strlen(filter($_POST['mpdA']));
    $sub = 9-$sizeMDP;
    return header('location:../index.php?message=Your password is too short  '.$sub.' characters.');
  }
  $elements = [['post'=>'email', 'size'=>80], ['post'=>'prenom', 'size'=>60], ['post'=>'nom', 'size'=>60], ['post'=>'login', 'size'=>60], ['post'=>'mdp', 'size'=>120]];
  foreach ($elements as $key => $value) {
      array_push($security,sizePost(filter($_POST[$value['post']]), $value['size']));
  }
  // Check doublons
  $controle = new Controles();
  $arrayDoublon = [['sql'=>"SELECT`email`FROM `users` WHERE `email` = :email", 'preparation'=>':email', 'valeur'=>filter($_POST['email'])],
  ['sql'=>"SELECT`login`FROM `users` WHERE `login` = :login", 'preparation'=>':login', 'valeur'=>filter($_POST['login'])]];
  foreach ($arrayDoublon as $key => $value) {
    array_push($security, $controle->doublon($value['sql'], $value['preparation'] , $value['valeur']));
  }
  for ($i=0; $i <count($security); $i++) {
    array_push($stamp, 0);
  }
}
$stock = ['login'=>filter($_POST['login']), 'mdp'=>filter($_POST['mdp'])];

if($security === $stamp) {
  $test = true;
  array_pop($_POST);
  unset($_POST['mpdA']);
  $_POST['mdp'] = haschage(filter($_POST['mdp']));
  $_POST['token'] = genToken(16);
}
if($test) {
  $sql = new InsertRequest();
  $insert = $sql->requestInsert($_POST, 3, 'users');
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  ActionDB::access($insert, $param, 0);
  $_POST = array();
  $_POST['login'] = $stock['login'];
  $_POST['mdp'] = $stock['mdp'];
  $ipCheck->checkSecurityAndConnect  ($_POST);
  return header('location:../index.php?message=Welcome '.$_SESSION['login']);
  exit();
} else {
  header('location:../index.php?message=Treatment concerns');
  exit();
}
