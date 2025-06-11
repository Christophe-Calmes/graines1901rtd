<?php 
require('modules/accouting/objets/templateAccounting.php');
$idBilan = filter($_GET['idBilan']);
$accouting = new templateAccounting ();
$accouting->displayArchiveAccouting ($idBilan);
