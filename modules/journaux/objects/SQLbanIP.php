<?php
Class SQLFireWall {
    protected function getAllBanIP () {
        $select = "SELECT `id`, `BanIP`, `dateCreat` 
        FROM `banIP` 
        ORDER BY `dateCreat`;";
        return ActionDB::select($select, [], 0);
    }
    public function delIPban ($idBanIP) {
        $delete = "DELETE FROM `banIP` WHERE `id` = :id;";
        $param = [['prep'=>':id', 'variable'=>$idBanIP]];
        return ActionDB::access($delete, $param, 0);
    }
    public function addIPBan ($ipBan) {
        $insert = "INSERT INTO `banIP`(`BanIP`) VALUES (:BanIP)";
        $param = [['prep'=>':BanIP', 'variable'=>$ipBan]];
        return ActionDB::access($insert, $param, 0);
    }
    public function countNbrConnexion () {
        $select = "SELECT COUNT(`idConnexion`) AS `nbrConnexion` FROM `journaux`";
        return ActionDB::select($select, [], 0)[0]['nbrConnexion'];

    }
    protected function dataJourneaux ($premier, $parPage) {
        $select = "SELECT  
                    `prenom`, 
                    `nom`, 
                    `journaux`.`login` AS `loginUser`, 
                    `typeRole`,
                    `ipUser`,  
                    `mdpHacker`, 
                    `dateHeure`, 
                    `okConnexion`
                FROM `journaux`
                LEFT JOIN `users` ON  `journaux`.`idUser` = `users`.`idUser`
                LEFT JOIN `roles` ON `users`.`role` = `roles`.`idRole`
                ORDER BY `idConnexion` DESC LIMIT 0, 10";
        return ActionDB::select($select, [], 0);
    }
}