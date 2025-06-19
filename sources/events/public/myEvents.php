<?php
require ('sources/events/objets/templateEvents.php');
$myEvents = new TemplateEvents ();
$myEvents->adminMyEvent ([1, true, true], $idNav);
$myEvents->adminMyEvent ([1, false, true], $idNav);