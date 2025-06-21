<?php
require ('sources/events/objets/templateEvents.php');
$gameType = new TemplateEvents ();
$gameType->formGameType ($idNav);
$gameType->displayGameType ($idNav);