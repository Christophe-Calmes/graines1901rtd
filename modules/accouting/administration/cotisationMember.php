<?php
require_once ('modules/Membership/objects/templateMembership.php');
require_once ('modules/accouting/objets/templateAccounting.php');
$idUser = filter($_GET['idUser']);
$cotisation = new templateMembership ();
if($cotisation->checkMember ($idUser)) {
    echo '<article class="gallery">';
        $cotisation->dataSheetMemberShip ($idUser);
        $accountingDisplay = new templateAccounting ();
        $accountingDisplay->contributForYear ($idUser, $idNav);
    echo '</article>';
} else {
    echo '<h2 class="subTitleSite">Ce membre ne fait pas partie de l\'association.</h2>';
}