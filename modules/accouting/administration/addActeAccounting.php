<?php
require ('modules/accouting/objets/templateAccounting.php');
$accouting = new templateAccounting ();
$accouting->displayAddAct($idNav);

$array = ['12.5€', 12.5, 18, 75.985, '125, 5Euro'];
$controle = array();
$cleanMonay = array();


