<?php
require 'modules/dataSite/objets/getDataSite.php';
require 'modules/dataSite/objets/printDataSite.php';
$fields = ['titre', 'sousTitre', 'description'];
$table = 'dataSite';
$condition = [['champs'=>'idDataSite', 'operator'=>'=', 'param'=>1]];
$dataSite = new PrintDataSite();
$dataSiteDB = $dataSite->getElementSite($fields, $table, $condition);
$title = $dataSiteDB[0]['titre'];
$description = $dataSiteDB[0]['description'];
