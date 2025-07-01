<?php
  $yes = ['Non', 'Oui'];
  require ('modules/users/objets/getUser.php');
  require ('modules/users/objets/printUser.php');
  $roles = new PrintUser();
  $internaute = $roles->setRoles();
  $dataMenuDeroulant = $readNav->getMenuDeroulant();
  $readNav->AddLienNavigation ($dev, $internaute, $dataMenuDeroulant, $idNav);

echo '<h3>Les menus</h3>';

$internaute = array_reverse($internaute);
      foreach ($internaute as $key => $value) {
        echo '<h3>'.$value['name'].'</h3>';
        $dataNavBandeau = $readNav->getNav($value['role']);
        $readNav->bandeauHaut($dataNavBandeau);
      }
 ?>
