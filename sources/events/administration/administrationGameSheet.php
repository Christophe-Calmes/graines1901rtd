<?php
require ('sources/events/objets/templateEvents.php');
$idGame = filter($_GET['idGame']);
$game = new TemplateEvents ();
$game->displayAdminGame ($idGame, $idNav);