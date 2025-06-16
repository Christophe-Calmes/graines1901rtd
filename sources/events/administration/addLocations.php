<?php
require('sources/events/objets/templateEvents.php');
$addLocation = new TemplateEvents ();
$addLocation->formAddLocation ($idNav);
$addLocation->displayLocation (1, 0, $idNav);