<?php
  require ('functions/functionPagination.php');
  require ('modules/journaux/objects/TemplateFireWall.php');
?>
<section>
<?php
// Paramètre de pagination
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
    $journaux = new TemplateFireWall ();
    $parPage = 20;
    $nbrArticle = $journaux->countNbrConnexion ();
    $pages = ceil($nbrArticle/$parPage);
    $premier = ($currentPage * $parPage) - $parPage;
    $journaux->printJourneaux ($premier, $parPage, $idNav);

  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
   ?>
 <div class="flex-rows">
 <form class="flex-colonne" action="<?php echo encodeRoutage(19); ?>" method="post">
   <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Vider le journal</button>
 </form>
 </section>
