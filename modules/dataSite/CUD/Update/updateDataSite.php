<?php
require '../modules/dataSite/objets/cudDataSite.php';
print_r($_POST);
$arrayKeys =  ['titre','titreHTML','sousTitre','description'];
$sizeTable = [50, 120, 100, 750];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    for ($i=0; $i < count($_POST) ; $i++) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[$i]]), $sizeTable[$i]));
    array_push($mark, 0);
    }
}
if(($mark == $controle_POST)&&($mark != [])) {
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $fields = [];
  $table = '`dataSite`';
  $conditionsClause = [['champs'=>'idDataSite', 'operator'=>'=', 'param'=>1]];
  $set = ['`titre`=:titre','`sousTitre`=:sousTitre','`description`=:description','`titreHTML`=:titreHTML'];
  $actionUpdate = new CUDdataSite ($fields, $table, $conditionsClause, $set);
  $actionUpdate->updateDataSite ($param, $_POST);
    header('location:../index.php?idNav='.$idNav.'&message=Update du site pris en compte');
} else {
  header('location:../index.php?idNav='.$idNav.'&message=Un des champs est trop long');
}


/*
$qualiter = Qualiter($sizeTable);

if($qualiter == $controleForm) {
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $fields = [];
  $table = '`dataSite`';
  $conditionsClause = [['champs'=>'idDataSite', 'operator'=>'=', 'param'=>1]];
  $set = ['`titre`=:titre','`sousTitre`=:sousTitre','`description`=:description','`titreHTML`=:titreHTML'];
  $actionUpdate = new CUDdataSite ($fields, $table, $conditionsClause, $set);
  $actionUpdate->updateDataSite ($param, $_POST);
    header('location:../index.php?idNav='.$idNav.'&message=Update du site pris en compte');
} else {
  header('location:../index.php?idNav='.$idNav.'&message=Un des champs est trop long');
}*/
