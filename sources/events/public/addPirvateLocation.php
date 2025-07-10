<?php
require('sources/events/objets/templateEvents.php');
echo '<div>
<button type="button" id="magic" class="open">Ajouter un lieu privé</button>
</div>';
$addPrivateLocation = new templateEvents ();
echo '<div id="hiddenForm">';
$addPrivateLocation->formAddLocation ($idNav, 1);
echo '</div>';
$addPrivateLocation->displayPrivateOwnerLocation (1);
$addPrivateLocation->displayPrivateOwnerLocation (0);
require ('javaScript/magicButtonMenus.php');