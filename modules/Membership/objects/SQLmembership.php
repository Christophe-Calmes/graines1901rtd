<?php
class SQLmembership

{
    protected function getMember () {
        $sql = "SELECT `idUser`, `email`, `prenom`, `nom`, `login`,  `valide`, `dateCreation` FROM `users` WHERE `role` = 1 AND `valide` = 1;";
        return ActionDB::select($sql, [], 0);
    }
    public function checkIdUserExiste ($idUser) {
        $sql = "SELECT COUNT(`idUser`) AS `nbrUser` FROM `users` WHERE `idUser` = :idUser;";
        $param = [['prep'=>':idUser', 'variable' => $idUser]];
        $result = ActionDB::select($sql, $param, 0);
        if(1 == 1) {
            return true;
        } 
        return false;
    }
    public function creatNewMember ($param) {
        $insert = "INSERT INTO `membership` (`MemberNumber`, `id_users`) VALUES (:MemberNumber, :idUser);";
        ActionDB::access($insert, $param, 0);
    }
}
