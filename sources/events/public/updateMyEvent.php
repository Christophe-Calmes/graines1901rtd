<?php
require ('sources/events/objets/templateEvents.php');
if(isset($_GET['idEvent'])) {
$idEvent = filter($_GET['idEvent']);
        $updateEvent = new TemplateEvents ();
        $updateEvent->updateFormEvent ($idEvent, $idNav);
} else {
    echo '<h2 class="subTitleSite">Donnée inaccessible, contacter l\'administrateur ?</h2>';
}

