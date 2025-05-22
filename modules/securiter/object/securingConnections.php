<?php
Class SecuringConnections {
    
    private $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function ipIsProhibited () {
        $count = "SELECT COUNT(`id`) AS `nbrOfBan` FROM `banIP` WHERE `BanIP` = :banIP;";
        $param = [['prep'=>':banIP', 'variable'=>$this->ip]];
        $dataCount = ActionDB::select($count, $param, 0);
        return ($dataCount[0]['nbrOfBan'] > 0);
    }
    public function BanIP () {
        $count = "SELECT COUNT(`idConnexion`) AS `nbrConnexionFail` 
        FROM `journaux` 
        WHERE `ipUser` = :ipUser 
        AND `idUser` = 0 
        AND `okConnexion` = 0";
        $param = [['prep'=>':ipUser', 'variable'=>$this->ip]];
        $dataCount = ActionDB::select($count, $param, 0);
        $nbrFailConnection = $dataCount[0]['nbrConnexionFail'];
        if($nbrFailConnection >= 5) {
            $insert = "INSERT INTO `banIP`(`BanIP`) VALUES (:ipUser)";
            ActionDB::access($insert, $param, 0);
            return false;
        } 
        return true;
    }
    public function securingAttackAccount ($login) {
        $select = "SELECT COUNT(`idConnexion`) AS `nb_occurrences`
        FROM `journaux`
        WHERE `login` = :login AND okConnexion = 0;";
        $param = [['prep'=>':login', 'variable'=>$login]];
        $dataNbrAttack = ActionDB::select($select, $param, 0);
        if($dataNbrAttack > 5) {
            $selectLogin = "SELECT`login`, `idUser` FROM `users` WHERE `login` = :login";
            $dataLogin = ActionDB::select($select, $param, 0);
            if($dataLogin[0]['login'] == $login) {
                $update = "UPDATE `users` SET `valide` = 0 WHERE `idUser` = :idUser";
                $param = [['prep'=>':idUser', 'variable'=>$selectLogin[0]['idUser']]];
                ActionDB::access($select, $param, 0);
                return true;
            }
        }
        return false;
    }
}
