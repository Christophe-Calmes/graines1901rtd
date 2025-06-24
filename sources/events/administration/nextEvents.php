<?php
require ('sources/events/objets/templateEvents.php');
$past = false;
$lastEvents = new TemplateEvents ();
require ('functions/functionPagination.php');
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
$parPage = 9;
$nbrPastEvents = $lastEvents->numberOfEvent ($past);
$pages = ceil($nbrPastEvents/$parPage);
$firstPage = ($currentPage * $parPage ) - $parPage;
echo '<h2 class="subTitleSite">Evénement à venir</h2>';
echo '<p class="box">Page : '.$currentPage.'</p>';
$lastEvents->displayAdminEvents ($firstPage, $parPage, $past , $idNav);
for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }