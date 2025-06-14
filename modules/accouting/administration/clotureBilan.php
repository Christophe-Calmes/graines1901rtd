<?php
require('modules/accouting/objets/templateAccounting.php');
$accounting = new templateAccounting ();
$accounting->displayActualBilan ($idNav);
$accounting->displayOldBilan ();
require ('javaScript/magicButtonMenus.php');
