<?php
require_once ('sources/events/objets/templateEvents.php');
require ('functions/functionPagination.php');
$games = new TemplateEvents ();

  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
    $parPage = 10;
    $nbrArticle = $games->numberGames ();
    $premier = ($currentPage * $parPage) - $parPage;
    $pages = ceil($nbrArticle/$parPage);
    $games->displayPaginationGames ($premier, $parPage);

for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }