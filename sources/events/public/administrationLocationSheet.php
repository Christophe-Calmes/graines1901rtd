<?php
require_once 'sources/events/objets/templateEvents.php';
$idLocation = filter_input(INPUT_GET, 'idLocation', FILTER_VALIDATE_INT);
if ($idLocation === null || $idLocation === false) {
    header('Location: index.php?message=Bad request');
    exit();
}
$location = new TemplateEvents();
if ($location->checkOwnerLocation($idLocation) === 1) {
    $location->updateFormLocation($idLocation, $idNav, 1);
} else {
    header('Location: index.php?message=Bad request');
    exit();
}


