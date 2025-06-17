<?php
require_once ('sources/events/objets/templateEvents.php');
$location = new TemplateEvents ();
$idLocation = filter($_GET['idLocation']);
$location->updateFormLocation ($idLocation, $idNav);
