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
    public function checkIdLocation ($idLocation) {
        $select = "SELECT COUNT(`id`) AS `check` FROM `locations` WHERE `id`= :idLocation;";
               $param = [['prep'=>':idLocation', 'variable'=>$idLocation]];
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
    protected function getOneLocation ($idLocation) {
        $select = "SELECT `id`, 
            `nameLocation`, 
            `adress`, 
            `city`, 
            `zipCode`, 
            `phone`
            FROM `locations` 
            WHERE `id` = :idLocation;";
        $param = [['prep'=>':idLocation', 'variable'=>$idLocation]];
        return ActionDB::select($select, $param, 2)[0];

    }
    public function updateLocation ($param) {
        $update = "UPDATE `locations` SET 
        `nameLocation`=:nameLocation, 
        `adress`=:adress, 
        `city`=:city, 
        `zipCode`=:zipCode, 
        `phone`=:phone,
        `valid`=:valid
        WHERE `id`=:idLocation;";
        return ActionDB::access($update, $param, 2);
    }
    protected function getAllGameByType ($gameType) {
        $select = "SELECT `id`, `nameGame` 
        FROM `nameGames` 
        WHERE `valid` = 1 AND `idTypeGame` = :gameType
        ORDER BY `nameGame`;";
            $param = [['prep'=>':gameType', 'variable'=>$gameType]];
            return ActionDB::select($select, $param, 2);
    }
    protected function getAllLocation () {
        $select = "SELECT `id`, `nameLocation`, `adress`, `city`
        FROM `locations` 
        WHERE `private` = 0 AND `valid` = 1;";
        return ActionDB::select($select, [], 2);

    }
    protected function getAllGameTypes () {
        $select = "SELECT `id`, `typeGame` FROM `typeGames` WHERE `valid` = 1 ORDER BY `typeGame`;";
        return ActionDB::select($select, [], 2);
    }
    public function checkValideDate($dateEvent, $format = 'Y-m-d') { 
        $today = new DateTime();
        $today->setTime(0, 0, 0); 
        $eventDate = DateTime::createFromFormat($format, $dateEvent);
            if (!$eventDate || $eventDate->format($format) !== $dateEvent) {
                return false;
            }
            $eventDate->setTime(0, 0, 0);
            if ($eventDate >= $today) {
                return true; 
            } else {
                return false; 
            }
    }
    public function isValidTime($hourEvent, $format = 'H:i') {
        $time = DateTime::createFromFormat($format, $hourEvent);
        if ($time && $time->format($format) === $hourEvent) {
            return true;
        } else {
            return false; 
        }
    }
    public function isNumberOfParticipant ($number, $limit) {
            $filteredNumber = filter_var($number, FILTER_VALIDATE_INT, [
            "options" => [
                "min_range" => $limit[0],
                "max_range" => $limit[1]
        ]
    ]);
        return $filteredNumber !== false;
    }
    public function checkGame ($idGame) {
        $select = "SELECT COUNT(`id`) AS `check` FROM `nameGames` WHERE `id` = :idGame AND `valid` = 1;";
        $param = [['prep'=>':idGame', 'variable'=>$idGame]];
         return ActionDB::select($select,$param, 2)[0]['check'];
    }
    public function recordNewEvent ($param) {
        $insert = "INSERT INTO `events`( `nameEvent`, `objetEvent`, `dateEvent`, `hourEvent`, `numberParticipants`, `idNameGame`, `idLocation`, `idOwner`) 
        VALUES (:nameEvent, :objetEvent, :dateEvent ,  :hourEvent, :numberParticipants, :idNameGame, :idLocation, :idUser);";
        return ActionDB::access($insert, $param, 2);
    }
}
