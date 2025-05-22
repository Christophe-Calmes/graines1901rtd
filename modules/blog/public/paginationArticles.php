<?php
require('modules/blog/objects/templateBlog.php');
require ('functions/functionPagination.php');
$idSubject = filter($_GET['idSubject']);
$blog = new TemplateBlog ();
$blog->menuCategorieBlog ();
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
$parPage = 10;
$nbrArticles = $blog->numberOfArticle ($idSubject, 1);
$pages = ceil($nbrArticles/$parPage);
$firstPage = ($currentPage * $parPage ) - $parPage;
echo '<h4>'.$blog->nameSubject ($idSubject).'</h4>';
echo '<p>Page : '.$currentPage.'</p>';
$blog->displayPreloadArticle ($firstPage, $parPage, $idSubject, 1);
for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'&idSubject='.$idSubject.'">'.$page.'</a>';
  }