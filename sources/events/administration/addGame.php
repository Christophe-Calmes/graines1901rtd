<?php
require('sources/events/objets/templateEvents.php');
$addGame = new TemplateEvents ();
$addGame->formAddGame ($idNav);
require_once ('sources/events/administration/administrationGames.php');
