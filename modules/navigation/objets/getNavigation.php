<?php
Class GetNavigation {
  public function checkAccreditionExist ($accreditation) {
       $param = [['prep'=>':accreditation', 'variable'=>$accreditation]];
    $select = "SELECT COUNT(`idRole`) AS `nbr` FROM `roles` WHERE `accreditation` = :accreditation;";
    $check = ActionDB::select($select, $param, 0)[0]['nbr'];
    if($check == 1) {
      return true;
    }
    return false;
  }
  public function checkIdModuleExist ($idModule) {
     $param = [['prep'=>':id', 'variable'=>$idModule]];
    $select = "SELECT COUNT(`id`) AS `nbr` FROM `modules` WHERE `id` = :id AND `valide` = 1;";
        $check = ActionDB::select($select, $param, 0)[0]['nbr'];
    if($check == 1) {
      return true;
    }
    return false;
  }
  public function RecordNewMenu ($param) {
    $insert = "INSERT INTO `menuNav`(`titreMenu`) VALUES (:titreMenu);";
    ActionDB::access($insert, $param, 0);
    $select = "SELECT `idMenuDeroulant` FROM `menuNav` ORDER BY `idMenuDeroulant` DESC LIMIT 1;";
    return ActionDB::select ($select, [], 0)[0]['idMenuDeroulant'];
  }
  public function insertNewMenu ($param) {
    $insert = "INSERT INTO `navigation`(`nomNav`, 
    `cheminNav`, 
    `menuVisible`, 
    `zoneMenu`, 
    `ordre`, 
    `niveau`,  
    `deroulant`, 
    `targetRoute`, 
    `idModule`) 
    VALUES 
    (:nomNav, 
    :cheminNav, 
    :menuVisible, 
    :zoneMenu, 
    :ordre, 
    :niveau, 
    :deroulant, 
    :targetRoute, 
    :idModule);";
    return ActionDB::access($insert, $param, 0);

  }
  protected function AuthenticNav ($value) {
    $select = "SELECT `idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
    FROM `navigation`
    WHERE `zoneMenu` = :zoneMenu AND `niveau` = :niveau AND `valide` = 1
    ORDER BY `ordre` ASC";
    $param = [
    ['prep'=>':zoneMenu', 'variable'=>$value['deroulant']],
    ['prep'=>':niveau', 'variable'=>$value['niveau']]];
    return ActionDB::select($select, $param);
  }

  public function getNav($zoneMenu) {
    $select = "SELECT `nomNav`, `cheminNav`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
    FROM `navigation`
    WHERE `valide` = 1 AND `niveau` = :niveau AND `menuVisible` = 1 AND `zoneMenu` = 0
    ORDER BY `ordre` ASC";
    $param = [['prep'=>':niveau', 'variable'=>$zoneMenu]];
    return ActionDB::select($select, $param);
  }
  public function getContenus($idNav) {
    $select = "SELECT  `cheminNav`,  `niveau`, `targetRoute` FROM `navigation` WHERE `targetRoute` = :targetRoute AND  `valide` = 1";
    $param = [['prep'=>':targetRoute', 'variable'=>$idNav]];
    return ActionDB::select($select, $param);

  }
  public function getFrom($idRoute) {
    $select = "SELECT `chemin`, `securiter` FROM `routageForm` WHERE `valide` = 1 AND `route` = :route";
    $param = [['prep'=>':route', 'variable'=>$idRoute]];
    return ActionDB::select($select, $param);

  }
  public function getMenuDeroulant() {
    $select = "SELECT `idMenuDeroulant`, `titreMenu` FROM `menuNav`";
    return ActionDB::select($select, []);

  }
  public function toutesRoutesForm() {
      $select = "SELECT `idForm`, `chemin`, `securiter` FROM `routageForm` WHERE `valide` = 1 ORDER BY `securiter` DESC, `idForm`";
      return ActionDB::select($select, []);
  }
  protected function getAllNav() {
    $select = "SELECT `idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
    FROM `navigation`;
    ORDER BY `niveau` AND `nomNav`";
    return ActionDB::select($select, []);

  }
  protected function getNavParam($id) {
    $select = "SELECT `idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
    FROM `navigation`
    WHERE `idNav` = :idNav;";
    $param = [['prep'=>':idNav', 'variable'=>$id]];
    return ActionDB::select($select, $param);
  }
  protected function getModules($valide = 1) {
    $select = "SELECT `id`, `module`, `valide` FROM `modules` WHERE `valide` = :valide";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    return ActionDB::select($select, $param);
  }
  protected function countIdNavAndIdForm () {
    $statRouting = [];
    $select = "SELECT COUNT(`idNav`) AS `nbrOfIdNav` FROM `navigation`;";
    array_push($statRouting, ['idNav'=>ActionDB::select($select, [], 0)[0]['nbrOfIdNav']]);
    $select = "SELECT COUNT(`idForm`) AS `nbrIdForm` FROM `routageForm`;";
    array_push($statRouting, ['idForm'=>ActionDB::select($select, [], 0)[0]['nbrIdForm']]);
    array_push($statRouting, ['total'=>$statRouting[0]['idNav'] + $statRouting[1]['idForm']]);
    return $statRouting;
  }

}
