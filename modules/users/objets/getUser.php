<?php
Class GetUser {
  public function getUserCurrentPage($premier, $parPage, $valide) {
    $select = "SELECT `idUser`, `login`, `role`, `dateCreation`, `valide` 
    FROM `users` WHERE `valide`  = :valide 
    ORDER BY `login` LIMIT {$premier}, {$parPage}";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    return ActionDB::select($select, $param);
  }
  public function getProfil($token) {
    $select = "SELECT `token`, `email`, `prenom`, `nom`, `login`,`role`, `dateCreation`
    FROM `users`
    WHERE `token` = :token";
    $param = [['prep'=>':token', 'variable'=>$token]];
    return ActionDB::select($select, $param);
  }
  public function getRoles($valide = 1) {
    $sql = new SelectRequest (['typeRole', 'accreditation'], 'roles', [['champs'=>'valide', 'operator'=>'=', 'param'=>$valide]]);
    $select = $sql->requestSelect(0);
    return ActionDB::select($select, []);
  }
  public function testUser($email) {
    $select = "SELECT COUNT(`idUser`) AS `numberOne` FROM `users` WHERE `email`=:email;";
    $param=[['prep'=>':email', 'variable'=>$email]];
    $verifyUser = ActionDB::select($select, $param);
    return $verifyUser[0]['numberOne'];
  }
  public function updateToken($email, $token) {
    $update = "UPDATE `users` SET  `token`=:token WHERE `email` = :email;";
    $param=[['prep'=>':email', 'variable'=>$email],
            ['prep'=>':token', 'variable'=>$token]];
    return ActionDB::access($update, $param);
  }
  public function authentificationTwoFactor($email, $token){
    $select = "SELECT COUNT(`idUser`) AS `numberOne` FROM `users` WHERE `email`=:email AND `token`=:token ";
    $param=[['prep'=>':email', 'variable'=>$email],
            ['prep'=>':token', 'variable'=>$token]];
            $data = ActionDB::select($select, $param);
            return $data[0]['numberOne'];
  }
  public function updatePassword($mdp, $token, $email) {
    $update = "UPDATE `users` SET `mdp`=:mdp WHERE `token`=:token AND `email`=:email;";
    $param=[['prep'=>':mdp', 'variable'=>$mdp],
            ['prep'=>':email', 'variable'=>$email],
            ['prep'=>':token', 'variable'=>$token]];
            return ActionDB::access($update, $param);      
  }
}
