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
}