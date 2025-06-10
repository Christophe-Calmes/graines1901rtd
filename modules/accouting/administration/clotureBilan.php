<?php
require('modules/accouting/objets/templateAccounting.php');
$accounting = new templateAccounting ();
$accounting->displayOldBilan ();
$accounting->displayActualBilan ();
