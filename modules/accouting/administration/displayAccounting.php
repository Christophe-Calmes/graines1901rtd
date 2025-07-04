<?php
require ('modules/accouting/objets/templateAccounting.php');
$accounting = new templateAccounting ();
$accounting->displayActualAccounting ($idNav, 1);
$accounting->displayActualAccounting ($idNav, 0);