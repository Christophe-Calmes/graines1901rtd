<?php
class sqlEvents
{
    protected function getGamesTypes () {
        $select = "SELECT `id` AS `idTypeGame`, `typeGame` FROM `typeGames` WHERE `valid` = 1;";
        return ActionDB::select($select, [], 2);
    }
    public function checkIdTypeGame ($idTypeGame) {
        $select = "SELECT COUNT(`id`) AS `check` 
                    FROM `typeGames` 
                    WHERE `id` = :idTypeGame;";
        $param = [['prep'=>':idTypeGame', 'variable'=>$idTypeGame]];
        return ActionDB::select($select, $param, 2)[0]['check'];
    }
    public function recordNewGame ($param) {
        $insert = "INSERT INTO `nameGames`(`nameGame`, `idTypeGame`) VALUES (:nameGame, :typeGame)";
        return ActionDB::access($insert, $param, 2);
    }
}
