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
    public function updateGame ($param) {
        $update = "UPDATE `nameGames` SET `nameGame`=:nameGame,`idTypeGame`=:typeGame, `valid`=:valid WHERE `id` = :idGame;";
        return ActionDB::access($update, $param, 2);
    }
    public function numberGames () {
        $select = "SELECT COUNT(`id`) AS `numberGame` FROM `nameGames` WHERE `valid` = 1;";
        return ActionDB::select($select, [], 2)[0]['numberGame'];
    }
    protected function paginationGames ($premier, $parPage) {
        $select = "SELECT `typeGame`, `nameGames`.`id` AS `idNameGame`, `typeGame`, `nameGame`
        FROM `nameGames`
        INNER JOIN `typeGames` ON `typeGames`.`id` = `nameGames`.`idTypeGame`
        WHERE `nameGames`.`valid` = 1
        ORDER BY `idTypeGame`, `nameGame`  LIMIT {$premier}, {$parPage};";
        return ActionDB::select($select, [], 2);

    }
    protected function getGameSheet ($idGame) {
        $select = "SELECT `nameGames`.`id` AS `idGame`, `nameGame`, `typeGame`, `idTypeGame`
                    FROM `nameGames`
                    INNER JOIN `typeGames` ON `typeGames`.`id` = `nameGames`.`idTypeGame`
                    WHERE `nameGames`.`id` = :idGame;";
         $param = [['prep'=>':idGame', 'variable'=>$idGame]];
         return ActionDB::select($select,$param, 2)[0];
    }
    public function recordNewLocation ($param) {
        $insert = "INSERT INTO `locations`(`nameLocation`, `adress`, `city`, `zipCode`, `phone`, `private`, `idOwner`) 
        VALUES (:nameLocation, :adress, :city, :zipCode, :phone, 0, :idUser);";
        return ActionDB::access($insert, $param, 2);
    }
    protected function getLocation ($valid, $private) {
        $select = "SELECT `id`, 
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`, 
        `private`, 
        `idOwner`, 
        `valid` 
        FROM `locations` 
        WHERE `valid` = :valide AND `private` = :private;";
        $param = [['prep'=>':valide', 'variable'=>$valid],
        ['prep'=>':private', 'variable'=>$private],];
        return ActionDB::select($select, $param, 2);
    }
}
