<?php
class SQLmembership

{
    protected function getMember ($accreditation) {
        $sql = "SELECT `idUser`, `email`, `prenom`, `nom`, `login`,  `users`.`valide`, `dateCreation`, `typeRole`, `role`
        FROM `users`
        INNER JOIN `roles` ON `users`.`role` = `roles`.`accreditation`
        WHERE `role` = :accreditation AND  `users`.`valide` = 1;";
        $param = [['prep'=>':accreditation', 'variable'=>$accreditation]];
        return ActionDB::select($sql, $param, 0);
    }
    private function checkIdUser ($idUser) {
        $sql = "SELECT COUNT(`idUser`) AS `nbrUser` FROM `users` WHERE `idUser` = :idUser;";
        $param = [['prep'=>':idUser', 'variable' => $idUser]];
         ActionDB::select($sql, $param, 0);
        if(ActionDB::select($sql, $param, 0)[0]['nbrUser'] == 1) {
            return true;
        } 
        return false;
    }
    public function checkMember ($idUser) {
        $select = "SELECT COUNT(`id_users`) AS `nbrUser` FROM `membership` WHERE `id_users` = :idUser;";
                $param = [['prep'=>':idUser', 'variable' => $idUser]];
        $result = ActionDB::select($select, $param, 0);
        if(ActionDB::select($select, $param, 0)[0]['nbrUser'] == 1) {
            return true;
        } 
        return false;
    }
    public function  checkUserExiste ($idUser) {
        if($this->checkIdUser ($idUser) && !$this->checkMember ($idUser)) {
            return true;
        }
            return false;
    }
    public function creatNewMember ($param) {
        $insert = "INSERT INTO `membership` (`MemberNumber`, `id_users`) VALUES (:MemberNumber, :idUser);
        UPDATE `users` SET `role`=4 WHERE `idUser` = :idUser;";
        ActionDB::access($insert, $param, 0);
    }
    protected function getAllInfoMemberShip ($idUser) {
        $select = "SELECT 
        `email`, 
        `prenom`, 
        `nom`, 
        `login`,
        `dateCreation`, 
        `id`, 
        `MemberNumber`, 
        `update_date`, 
        `cotisation`, 
        `valid`
        FROM `users`
        INNER JOIN `membership` ON `idUser` = `id_users`
        WHERE `idUser` = :idUser;";
        $param = [['prep'=>':idUser', 'variable'=>$idUser]];
        return ActionDB::select($select, $param, 0)[0];
    }
}
