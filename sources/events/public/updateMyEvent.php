<?php
require ('sources/events/objets/templateEvents.php');

$idEvent = filter($_GET['idEvent']);
if(!empty($idEvent)) {
    $updateEvent = new TemplateEvents ();
    $updateEvent->updateFormEvent ($idEvent, $idNav);
} else {
    echo '<h2 class="subTitleSite">Donnée inaccessible, contacter l\'administrateur ?</h2>';
}

