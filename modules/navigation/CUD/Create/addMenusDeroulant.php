<?php
include ('../functions/functionToken.php');
$arrayKeys = ['titreMenu', 'niveau', 'idModule'];
$addNewMenu = new GetNavigation ();
$controle_POST = array();
$mark = [0];
if(checkPostFields($arrayKeys, $_POST)) {
  array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[0]]), 30));
  array_push($controle_POST, $addNewMenu->checkAccreditionExist (filter($_POST[$arrayKeys[1]])));
  array_push($mark, true);
  array_push($controle_POST, $addNewMenu->checkIdModuleExist (filter($_POST[$arrayKeys[2]])));
  array_push($mark, true);

}
if($mark == $controle_POST) {
  $paramMenuNav = [['prep'=>':titreMenu', 'variable'=>filter($_POST['titreMenu'])]];
  $idNewMenu = $addNewMenu->RecordNewMenu ($paramMenuNav);
  $dataBank = [filter($_POST['titreMenu']), filter($_POST['niveau']), filter($_POST['idModule']), $idNewMenu];
    $_POST = array();
    $_POST['nomNav'] = $dataBank[0];
    $_POST['cheminNav'] = 'modules/navigation/erreurNav.php';
    $_POST['menuVisible'] = 1;
    $_POST['zoneMenu'] = 0;
    $_POST['ordre'] = 0;
    $_POST['niveau'] =  $dataBank[1];
    $_POST['deroulant'] = $dataBank[3];
    $_POST['targetRoute'] = IntToken (12);
    $_POST['idModule'] = $dataBank[2];
    $parametre = new Preparation ();
    $param = $parametre->creationPrep ($_POST);
    $addNewMenu->insertNewMenu ($param);
 header('location:../index.php?message=New drop-down menu saved&idNav='.$idNav);
 exit();
} else {
  header('location:../index.php?message=New drop-down menu not saved&idNav='.$idNav);
   exit();
}