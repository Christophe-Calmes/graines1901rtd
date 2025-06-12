<?php
// encodeRoutage(149)
require('../modules/accouting/objets/SQLaccounting.php');
require ('../modules/Membership/objects/SQLmembership.php');
$member = new SQLmembership ();
$accouting = new SQLaccounting ();
$arrayKeys = ['idBilan'];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, $accouting-> checkBilan (filter($_POST[$arrayKeys[0]])));
    array_push($mark, true);
}
if($mark == $controle_POST) {
    print_r($_POST);
    echo '<br/>';
    $idUser = $checkId->idUser($_SESSION);
    $accouting->closeAndOpenBilan ($idUser);
    $member->resetCotisation ();
    header('location:../index.php?message=Close Bilan success&idNav='.$idNav);
} else {
    header('location:../index.php?message=Close bilan fail to record&idNav='.$idNav);
}

/*
List 
Recupérer la date d'ouverture dans la table bilans
Déterminer la balance => stoker la somme dans "balanceBilanClose"
passer toutes les ligne bilan 0 à bilan 1
Fermer le bilan dans la tables bilan (update => closeCompta)
Ouvrir un nouveau bilan (insert)
Ajouter une ligne report avec l'ancienne balance => virement => somme balanceBilanClose"
Passer tous les cotisation à 0 dans "membership" 
*/