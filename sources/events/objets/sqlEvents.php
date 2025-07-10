<?php
class sqlEvents
{
    private function getIdUser () {
            $idUser = new Controles ();
            return $idUser->idUser($_SESSION);
    }
    protected function GetEvents ($firstPage, $parPage, $past) {
        if($past) {
              $select = "SELECT 
        `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`
            FROM `events`
            INNER JOIN `locations` ON `locations`.`id`= `idLocation`
            INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
            INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
            WHERE `dateEvent`<= NOW() AND `events`.`valid` = 1
            ORDER BY `dateEvent` DESC
            LIMIT {$firstPage}, {$parPage};";
 
        } else {
            $select = "SELECT 
        `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`
            FROM `events`
            INNER JOIN `locations` ON `locations`.`id`= `idLocation`
            INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
            INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
            WHERE `dateEvent`>= NOW() AND `events`.`valid` = 1
            ORDER BY `dateEvent` DESC
            LIMIT {$firstPage}, {$parPage};";
           
        }
       

    return ActionDB::select($select, [], 2);
    }
    protected function getOneEvent ($idEvent) {
        $select = "SELECT 
        `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`,
        `events`. `idNameGame`,
        `idLocation`,
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`
            FROM `events`
            INNER JOIN `locations` ON `locations`.`id`= `idLocation`
            INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
            INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
            WHERE `events`.`id`=:idEvent AND `events`.`idOwner` = :idUser;";
        $idUser = new Controles ();
        $idOwner = $idUser->idUser($_SESSION);
            $param = [['prep'=>':idEvent', 'variable'=>$idEvent],['prep'=>':idUser', 'variable'=>$idOwner]];
            return ActionDB::select ($select, $param, 2);
    }

    protected function getAllDateBilan () {
        $select = "SELECT
            b.id AS bilan_id,
            b.openCompta,
            b.closeCompta,
            COUNT(e.id) AS nombre_evenements
        FROM
            bilans AS b
        LEFT JOIN
            events AS e ON e.dateEvent >= DATE(b.openCompta)
                        AND (b.closeCompta IS NULL OR e.dateEvent <= DATE(b.closeCompta))
        GROUP BY
            b.id, b.openCompta, b.closeCompta
        ORDER BY
            b.id;";
        return ActionDB::select($select, [], 2);
    }

    protected function getGamesTypes () {
        $select = "SELECT `id` AS `idTypeGame`, `typeGame` FROM `typeGames` WHERE `valid` = 1;";
        return ActionDB::select($select, [], 2);
    }
        protected function getGamesTypesAdmin ($valid) {
        $param = [['prep'=>':valid', 'variable'=>$valid]];
        $select = "SELECT `id` AS `idTypeGame`, `typeGame`, `valid` FROM `typeGames` WHERE `valid` = :valid;";
        return ActionDB::select($select, $param, 2);
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
    public function checkOwnerLocation ($idLocation) {
        $select = "SELECT COUNT(`id`) AS `check` FROM `locations` WHERE `idOwner` = :idOwner AND `id`=:idLocation;";
        $param = [['prep'=>':idLocation', 'variable'=>$idLocation],
                ['prep'=>':idOwner', 'variable'=> $this->getIdUser ()]];
        return ActionDB::select($select, $param, 2)[0]['check'];
    }
    public function checkIdEvent ($idEvent) {
        $select ="SELECT COUNT(`id`) AS `check` FROM `events` WHERE `id` = :idEvent;";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        return ActionDB::select($select, $param, 2)[0]['check'];
    }


    public function checkOwenerEvent ($idEvent) {
        $select = "SELECT COUNT(`id`) AS `nbrEvent` FROM `events` WHERE `idOwner` = :idUser AND `id` = :idEvent;";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent],['prep'=>':idUser', 'variable'=>$this->getIdUser ()]];
        return ActionDB::select($select, $param, 2)[0]['nbrEvent'];
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
    public function recordNewPrivateLocation ($param) {
        $insert = "INSERT INTO `locations`(`nameLocation`, `adress`, `city`, `zipCode`, `phone`, `private`, `idOwner`) 
        VALUES (:nameLocation, :adress, :city, :zipCode, :phone, 1, :idUser);";
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
            `phone`,
            `valid`
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
        WHERE `valid` = 1 AND (
        `private` = 0 OR
        (`private` = 1 AND `idOwner` = :idOwner));";
         $param = [['prep'=>':idOwner', 'variable'=> $this->getIdUser ()]];
        return ActionDB::select($select, $param, 2);

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
         if (strlen($hourEvent) === 8 && strpos($hourEvent, ':') === 2 && strrpos($hourEvent, ':') === 5) {
            $format = 'H:i:s';
        }
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
    public function recordEventParticipant ($param) {
        $insert = "INSERT INTO `link_events_participants`(`idParticipant`, `idEvent`) VALUES (:idUser, :idEvent);";
        return ActionDB::access($insert, $param, 2);
    }
    public function DeleteEventParticipant ($param) {
        $insert = "DELETE FROM `link_events_participants` WHERE `idEvent` = :idEvent AND `idParticipant` =  :idUser;";
        return ActionDB::access($insert, $param, 2);
    }
    protected function countParticipantsOneEvent ($idEvent) {
        $select = "SELECT COUNT(`idParticipant`) AS `numberParticipants` FROM `link_events_participants` WHERE `idEvent` = :idEvent;";
         $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
         return ActionDB::select($select, $param, 2)[0]['numberParticipants'];
    }
    private function lastEvent () {
        $select = "SELECT `id` FROM `events` ORDER BY `id` DESC LIMIT 1;";
        return ActionDB::select($select, [], 2)[0]['id'];
    }
    public function recordNewEvent ($param) {
        $insert = "INSERT INTO `events`( `nameEvent`, `objetEvent`, `dateEvent`, `hourEvent`, `numberParticipants`, `idNameGame`, `idLocation`, `idOwner`) 
        VALUES (:nameEvent, :objetEvent, :dateEvent ,  :hourEvent, :numberParticipants, :idNameGame, :idLocation, :idUser);";
        ActionDB::access($insert, $param, 2);
        return $this->lastEvent ();
    }
    public function updateEvent ($param) {
        $update = "UPDATE `events` SET 
        `nameEvent`=:nameEvent,
        `objetEvent`=:objetEvent,
        `dateEvent`=:dateEvent,
        `hourEvent`=:hourEvent,
        `numberParticipants`=:numberParticipants, 
        `idNameGame`=:idNameGame,
        `idLocation`=:idLocation 
        WHERE `id` = :idEvent AND `idOwner`=:idUser;";
        ActionDB::access($update, $param, 2);
    }
    protected function getMyEvent ($valid, $moment) {
        // $moment = true (present & futur), false (past)
        $param = [['prep'=>':valid', 'variable'=>$valid], 
        ['prep'=>':dateEvent', 'variable'=>date('Y-m-d')],
        ['prep'=>':idOwner', 'variable'=> $this->getIdUser ()]];
    if($moment) {
       $select = "SELECT `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`

        FROM `events` 
        INNER JOIN `locations` ON `locations`.`id`= `idLocation`
        INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
        INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
        WHERE  `events`.`valid` = :valid AND `dateEvent`>= :dateEvent AND `events`.`idOwner` = :idOwner;";
        } else {
                   $select = "SELECT `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`
        FROM `events` 
        INNER JOIN `locations` ON `locations`.`id`= `idLocation`
        INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
        INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
        WHERE  `events`.`valid` = :valid AND `dateEvent`< :dateEvent AND `events`.`idOwner` = :idOwner;";
        }
        return ActionDB::select($select, $param, 2);
    }
    protected function getActualEvent () {
         $param = [['prep'=>':dateEvent', 'variable'=>date('Y-m-d')]];
       $select = "SELECT `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`, 
        `private`

        FROM `events` 
        INNER JOIN `locations` ON `locations`.`id`= `idLocation`
        INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
        INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
        WHERE  `events`.`valid` = 1 AND `dateEvent`>= :dateEvent 
        ORDER BY `dateEvent` LIMIT 9;";
        return ActionDB::select($select, $param, 2);
    }
    protected function registerEvent ($idEvent) {
        $select = "SELECT `login`, `idUser`
                    FROM `link_events_participants`
                    INNER JOIN `xgyd0647_rtdtech`.`users` ON `xgyd0647_rtdtech`.`users`.`idUser` = `idParticipant`
                    WHERE `idEvent` = :idEvent;";
        $param = [['prep'=>':idEvent', 'variable'=>$idEvent]];
        return ActionDB::select($select, $param, 2);
    }
    private function deleteAllEventParticipant ($param) {
        array_pop($param);
        $delete = "DELETE FROM `link_events_participants` WHERE `idEvent` = :idEvent;";
        return ActionDB::access($delete, $param, 2);
    }
    private function deleteAllEventParticipantByGestionnaire ($param) {
        $delete = "DELETE FROM `link_events_participants` WHERE `idEvent` = :idEvent;";
        return ActionDB::access($delete, $param, 2);
    }
    public function deleteOneEventByOwner ($param) {
        $this->deleteAllEventParticipant ($param);
        $update = "UPDATE `events` SET `valid`=0 WHERE `id` = :idEvent AND `idOwner` = :idUser;";
        ActionDB::access($update, $param, 2);  
    }
    public function deleteOneEventByGestionnaire ($param) {
        $this->deleteAllEventParticipantByGestionnaire ($param);
        $delete = "DELETE FROM `events` WHERE `id` = :idEvent;";
        return  ActionDB::access($delete, $param, 2);  
    }
    protected function getMyAgenda () {
             $param = [['prep'=>':dateEvent', 'variable'=>date('Y-m-d')],
                        ['prep'=>':idParticipant', 'variable'=> $this->getIdUser ()]];
            $select ="SELECT 
        `events`.`id` AS `idEvent`,  
        `events`.
        `nameEvent`, 
        `objetEvent`, 
        `dateEvent`, 
        `hourEvent`, 
        `numberParticipants`, 
        `events`.`valid` AS `validEvent`, 
        `creat_date`, 
        `nameGame`, 
        `typeGame`, 
        `typeGames`.`id` AS `idTypeGame`,
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`
        FROM `link_events_participants` 
            INNER JOIN `events` ON  `link_events_participants`.`idEvent` = `events`.`id`
            INNER JOIN `locations` ON `locations`.`id`= `idLocation`
            INNER JOIN `nameGames` ON `events`. `idNameGame` = `nameGames`.`id`
            INNER JOIN `typeGames` ON `nameGames`.`idTypeGame` = `typeGames`.`id`
            
            WHERE `idParticipant` = :idParticipant AND `dateEvent`>= :dateEvent 
            ORDER BY `dateEvent` LIMIT 12;"; 
        return ActionDB::select($select, $param, 2);
    }
    public function updateValideGameType ($param) {
        $update = "UPDATE `typeGames` SET `valid`= `valid`^1 WHERE `id` = :idTypeGame;";
        return ActionDB::select($update, $param, 2);
    }
    public function insertNewGameType ($param) {
        $insert = "INSERT INTO `typeGames`(`typeGame`) VALUES (:typeGame);";
        return ActionDB::access($insert, $param, 2);
    }
    public function numberOfEvent ($past) {
        if($past) {
            $select = "SELECT COUNT(`id`) AS `nbrEvents` FROM `events` WHERE`dateEvent`<= NOW() AND `valid`=1;";
        } else {
            $select = "SELECT COUNT(`id`) AS `nbrEvents` FROM `events` WHERE`dateEvent` >= NOW() AND `valid`=1;";
        }
        return ActionDB::select($select, [],2)[0]['nbrEvents'];
    }
    public function updateEventAndDate ($param) {
        //print_r($param);
        $idEvent = [$param[0]];
        $select = "SELECT `dateEvent` FROM `events` WHERE `id` = :idEvent;";
        $LastDateEvent = ActionDB::select($select,  $idEvent, 2)[0]['dateEvent'];
      
        if($param[1]['variable'] > $LastDateEvent) {

            $this->deleteAllEventParticipant ($param);
            array_push($idEvent, ['prep'=>':idUser', 'variable'=>$this->getIdUser ()]);
            print_r($idEvent);
            $this->recordEventParticipant ($idEvent);

        } 
        return false;
    }
    protected function getOwnerPrivateLocation ($valid) {
        $select = "SELECT `id`, 
        `nameLocation`, 
        `adress`, 
        `city`, 
        `zipCode`, 
        `phone`, 
        `valid` 
        FROM `locations` 
        WHERE `idOwner` = :idUser 
        AND `private` = 1 
        AND `valid` = :valid;";
        $param = [['prep'=>':valid', 'variable'=>$valid],
        ['prep'=>':idUser', 'variable'=>$this->getIdUser ()]];
        return ActionDB::select($select, $param, 2);

    }

}
