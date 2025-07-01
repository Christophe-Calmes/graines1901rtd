<?php
  $valid = 1;
  require 'modules/users/objets/getUser.php';
  require 'modules/users/objets/printUser.php';
  include 'functions/functionPagination.php';
  include 'functions/functionDateTime.php';
  $users = new PrintUser();
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
    $parPage = 10;
    echo '<h3>Liste des utilisateurs | page : '.$currentPage.'</h3>';
      $nbrArticles =   $users->numberOfUser ($valid) ;
      $pages = ceil($nbrArticles/$parPage);
      $premier = ($currentPage * $parPage) - $parPage;
      $dataUsers = $users->getUserCurrentPage($premier, $parPage, $valid);
      $users->userTable($dataUsers, $idNav);
    for ($page=1; $page <= $pages ; $page++ ) {
      echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
    }
