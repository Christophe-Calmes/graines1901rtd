<?php
require ('modules/accouting/objets/templateAccounting.php');
$accounting = new templateAccounting ();

$accounting->displayActualAccounting ($date);