<?php
require ('../functions/functionToken.php');
$arrayKey = ['login', 'mdp'];
if(checkPostFields ($arrayKey, $_POST)) {
    if($ipCheck->checkSecurityAndConnect  ($_POST)) {
       return header('location:../index.php?message=Welcome '.$_SESSION['login']);
       exit();
    }  
     else {
      return header('location:../index.php?message=Authentication error');
      exit();
    }
} else {
    $ipCheck->BanIP ();
    $ipCheck->recordHackerLogUser ($_POST);
    return header('location:../index.php?message=Authentication error');
    exit();
}