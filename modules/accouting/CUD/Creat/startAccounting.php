<?php
//  encodeRoutage(150)
require('../modules/accouting/objets/SQLaccounting.php');
$accouting = new SQLaccounting ();
$arrayKeys = ['valid'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, filter($_POST[$arrayKeys[0]]));
    array_push($mark, true);

}
unset($_POST['valid']);
if($mark == $controle_POST) {
    $accouting->openNewBilan ();
    header('location:../index.php?message=Start accounting success&idNav='.$idNav);
    exit();
} else {
    header('location:../index.php?message=Start accounting  fail&idNav='.$idNav);
    exit();
}
