<?php
  require ('functions/functionPagination.php');
  require ('functions/functionDateTime.php');
?>
<section>
<?php
// Paramètre de pagination
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
$parPage = 25;
$param = [];
$requetteSQL = "SELECT COUNT(`idConnexion`) AS `nbrConnexion` FROM `journaux`";
$dataNbrC = ActionDB::select($requetteSQL, $param);
$nbrArticle = $dataNbrC[0]['nbrConnexion'];
$pages = ceil($nbrArticle/$parPage);
$premier = ($currentPage * $parPage) - $parPage;
$requetteSQL = "SELECT *
FROM `journaux`
ORDER BY `idConnexion` DESC LIMIT {$premier}, {$parPage}";
$dataTraiter = ActionDB::select($requetteSQL, $param);
$yes = ['Non', 'Oui'];
 ?>
 <div class="flex-rows">
   <?php
   if(!empty($dataTraiter)) {
    echo '<table>
      <caption>Journaux de connexion des utilisateurs et des visiteurs.</caption>
              <tr>
              <th>IdConnexion</th>
              <th>Id User</th>
              <th>login</th>
              <th>Mot de passe hacker</th>
              <th>IP de connexion</th>
              <th>date et heure de connexion</th>
              <th>Connexion réussit ?</th>
              <th>Ban IP</th>
            </tr>';
    foreach ($dataTraiter as $key => $value) {
      $date = $value['dateHeure'];
      echo '<tr>
             <td>'.$value['idConnexion'].'</td>
             <td>'.$value['idUser'].'</td>
             <td>'.$value['login'].'</td>
             <td>'.$value['mdpHacker'].'</td>
             <td>'.$value['ipUser'].'</td>
             <td>'.brassageDate($date).' - heure = '.substr($date,10,6).'</td>
             <td>'.$yes[$value['okConnexion']].'</td>
             <td>
               <form class="flex-colonne" action="'.encodeRoutage(65).'" method="post">
                 <input type="hidden" name="BanIP" value="'.$value['ipUser'].'"/>
                 <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Add IP ban</button>
               </form>
             </td>
           </tr>';
    }
    echo '</table>';
   } else {
     echo '<h3>No data in the log</h3>';
   }
    ?>
</div>
  <br />
  <?php
  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
   ?>
 <div class="flex-rows">
 <form class="flex-colonne" action="<?php echo encodeRoutage(19); ?>" method="post">
   <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Vider le journal</button>
 </form>
 </section>
