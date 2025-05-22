<?php
require('modules/blog/objects/templateBlog.php');
require ('functions/functionPagination.php');
$blog = new TemplateBlog ();
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
$parPage = 10;
$nbrArticles = $blog->numberOfArticleAllSubject (0);
$pages = ceil($nbrArticles/$parPage);
$firstPage = ($currentPage * $parPage ) - $parPage;
echo '<p>Page : '.$currentPage.'</p>';
$blog->adminDisplayPreloadArticle ($firstPage, $parPage, 0);

for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }