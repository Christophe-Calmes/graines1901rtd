<?php
require('modules/accouting/objets/templateAccounting.php');
$accounting = new templateAccounting ();
$accounting->displayActualBilan ($idNav);
echo '<h1 class="titleSite">Archive bilan</h1>';
$accounting->displayOldBilan ();

