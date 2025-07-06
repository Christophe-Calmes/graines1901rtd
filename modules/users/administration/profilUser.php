<?php
  require 'functions/functionDateTime.php';
  require 'functions/functionToken.php';
  require 'modules/users/objets/getUser.php';
  require 'modules/users/objets/printUser.php';
  $user = new PrintUser();
  //$dataUser = $user->getProfil($_SESSION['tokenConnexion']);
  echo '<div class="flex-rows">';
  echo '<article class="flex-row-reverse-simple">';
  $dataUser = $user->printProfilUser ();
 
  echo '<button type="button" id="magic" class="open">Administrer</button>';
  echo '<aside class="flex-colonne" id="hiddenForm">';
  $user->formProfil ($dataUser, $idNav);
    echo '</aside>';
echo '</div>';
  include 'javaScript/magicButtonMenus.php';
   echo '</article>';
