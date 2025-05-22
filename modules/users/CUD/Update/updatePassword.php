<?php
//encodeRoutage(57)
require('../functions/functionToken.php');
require('../modules/users/objets/getUser.php');
$AuthentificationUser = new GetUser();
$security = array();
$stamp = [0, 0, 0];
$test = false;
if((filter($_POST['mpdA']) == filter($_POST['mdp']))){
  array_push($security, 0);
} else {
  array_push($security, 1);
}
if(strlen(filter($_POST['mpdA']))>9) {
    array_push($security, 0);
  } else {
    array_push($security, 1);
  }
if($AuthentificationUser->authentificationTwoFactor(filter($_POST['email']), filter($_POST['token'])) ==1) {
    array_push($security, 0);
} else {
    array_push($security, 1);
}
if($stamp == $security) {
    print_r($_POST);
    echo '<br>';
    print_r($security);
    echo '<br>';
    print_r($stamp);
    $AuthentificationUser->updatePassword(haschage(filter($_POST['mdp'])), filter($_POST['token']), filter($_POST['email']));
    $AuthentificationUser->updateToken(filter($_POST['email']), genToken(10));
    return header('location:../index.php?message=Votre nouveau mot de passe est opérationnel.&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Problème indentification.&idNav='.$idNav);
}
 

