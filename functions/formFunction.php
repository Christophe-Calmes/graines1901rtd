<?php
function encodeRoutage($id) {
  $select = "SELECT `route` FROM `routageForm` WHERE `idForm` = :idForm AND `valide` = 1";
  $param = [['prep'=>':idForm', 'variable'=>$id]];
  $data = ActionDB::select($select, $param);
  return 'formulaires/DBaccess.php?route='.$data[0]['route'];
}
function formAction($id, $variable, $idNav, $button) {
  // Idnav On / off => $idNav = 0
  if($idNav == 0) {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="0">'.$button.'</button>';
  } else {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$button.'</button>';
  }
$type =  ['text',  'date', 'time', 'email',
'datetime-local', 'file', 'hidden',
'month', 'number', 'password', 'radio', 'range', 'search', 'checkbox', 'url' ];
  echo '<form class="formulaireClassique" action="'.encodeRoutage($id).'" method="post">';
  foreach ($variable as $key => $value) {
    echo '<label for="'.$value['name'].'">'.$value['message'].'</label>
            <input id="'.$value['name'].'" type="'.$type[$value['type']].'" name="'.$value['name'].'" required>';
  }
  echo $NavButton;
  echo '</form>';
}
function formModification($id, $variable, $idNav, $button) {
  // Idnav On / off => $idNav = 0
  if($idNav == 0) {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="0">'.$button.'</button>';
  } else {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$button.'</button>';
  }
$type =  ['text',  'date', 'time', 'email',
'datetime-local', 'file', 'hidden',
'month', 'number', 'password', 'radio', 'range', 'search', 'checkbox', 'url' ];
  echo '<form class="formulaireClassique" action="'.encodeRoutage($id).'" method="post">';
  foreach ($variable as $key => $value) {
    echo '<label for="'.$value['name'].'">'.$value['message'].'</label>
            <input id="'.$value['name'].'" type="'.$type[$value['type']].'" name="'.$value['name'].'" value="'.$value['lastInput'].'" required>';
  }
  echo $NavButton;
  echo '</form>';
}
function optionSelect($status) {
  $option = [['value'=>0, 'label'=>'Non'], ['value'=>1, 'label'=>'Oui']];
  foreach ($option as  $value) {
      $selected = null;
      if($value['value'] == $status) {
          $selected = 'selected';
      } 
      echo '<option value="'.$value['value'].'" '.$selected.'>'.$value['label'].'</option>';
  }
}
function printingPage () {
  echo '<div class="printingButton"><button class="printingButton" onclick="window.print()">Imprimer</button></div>';
}
