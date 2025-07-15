<?php
//  encodeRoutage(144)
require('../modules/accouting/objets/SQLaccounting.php');
require('../modules/Membership/objects/SQLmembership.php');
$member = new SQLmembership ();
$accouting = new SQLaccounting ();
$arrayKeys = ['idUser','formeBanquaire','montant', 'numeroTransaction' ];
$controle_POST = array();
$mark = array();
if (checkPostFields($arrayKeys, $_POST)) {
    array_push($controle_POST, sizePost(filter($_POST[$arrayKeys[3]]), 60));
    array_push($mark, 0);
    array_push($controle_POST, $member->checkMember(filter($_POST[$arrayKeys[0]])));
    array_push($mark, 1);
    array_push($controle_POST, $accouting->checkIndexTranscation(filter($_POST[$arrayKeys[1]])));
    array_push($mark, 1);
    array_push($controle_POST, $accouting->checkIndexCotisation(filter($_POST[$arrayKeys[2]])));
    array_push($mark, 1);
}

if($mark == $controle_POST) {
    $actualYear = date('Y');
    $infosMember = $member->infosMember (filter($_POST[$arrayKeys[0]]));
    if(date('n')>1 && date('n')<6) {
        $_POST['objet'] = 'Cotisation '.$accouting->getTypeCotisation (filter($_POST[$arrayKeys[2]])).' pour '.($actualYear-1).' à septembre '.$actualYear.' de '.$infosMember[1]['prenom'].' '.$infosMember[1]['nom'].' numéro adhérant: '.$infosMember[0]['MemberNumber']; 
    } else {
      $_POST['objet'] = 'Cotisation '.$accouting->getTypeCotisation (filter($_POST[$arrayKeys[2]])).' pour  '.($actualYear).' à septembre '.($actualYear + 1).' de '.$infosMember[1]['prenom'].' '.$infosMember[1]['nom'].' numéro adhérant: '.$infosMember[0]['MemberNumber']; 
    }
    $member->recordCotisation (filter($_POST[$arrayKeys[0]]), $accouting->getCotisation (filter($_POST[$arrayKeys[2]])));
    $_POST['montant'] = $accouting->amount (filter($_POST[$arrayKeys[2]]));
        array_shift($_POST);
            $parametre = new Preparation ();
            $param = $parametre->creationPrepIdUser ($_POST);
            $accouting->addActe ($param);
        header('location:../index.php?message=New membership success to record');
        exit();
} else {
    header('location:../index.php?message=New membership fail to record');
    exit();
}