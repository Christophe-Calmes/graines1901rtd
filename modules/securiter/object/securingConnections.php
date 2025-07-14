<?php

Class SecuringConnections {
    private $ip;
    private $numberErrorMDP;

    public function __construct($ip)
    {
        $this->ip = $ip;
        $this->numberErrorMDP = 10;
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
        if($nbrFailConnection >= $this->numberErrorMDP) {
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
    public function recordHackerLogUser ($post) {
        $param = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
            ['prep'=>':login', 'variable'=>filter($post['login'])],
            ['prep'=>':mdpHacker', 'variable'=>filter($post['mdp'])],];
            $insert="INSERT INTO `journaux`(`ipUser`, `login`, `mdpHacker`)
        VALUES (:ipUser, :login, :mdpHacker)";
          ActionDB::access($insert, $param, 0);
    }
    private function checkPassWord ($post) {
        $select = "SELECT `idUser`, `login`, `mdp`, `role` FROM `users` WHERE `login` = :login AND `valide` = 1";
        $param = [['prep'=>':login', 'variable'=>filter($post['login'])]];
        $dataTraiter = ActionDB::select($select, $param, 0);
        if (!empty($dataTraiter)) {
            if(password_verify(filter($post['mdp']), $dataTraiter[0]['mdp'])) {
                return $dataTraiter;
            }
            return false;
        }
        return false;
    }
    private function genTokenConnexionAndRecord ($dataTraiter) {
        $token = genToken(16);
        $update = "UPDATE `users` SET `token`= :token WHERE `idUser` = :idUser";
        $param = [['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']], ['prep'=>':token', 'variable'=>$token]];
        ActionDB::access($update, $param, 0);
        return $token;
    }
    private function recordJourneauxLog ($dataTraiter) {
        $insert = "INSERT INTO `journaux`(`ipUser`, `idUser`, `login`, `okConnexion`)
            VALUES (:ipUser, :idUser, :login, 1)";
            $param = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
                    ['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']],
                    ['prep'=>':login', 'variable'=>$dataTraiter[0]['login']]];
            ActionDB::access($insert, $param, 0);
    }
    private function creatSession ($dataTraiter, $token) {
        $_SESSION['tokenConnexion'] = $token;
        $_SESSION['role'] = $dataTraiter[0]['role'];
        $_SESSION['login'] = $dataTraiter[0]['login'];
        $_SESSION['time'] = time() + 3600;
        return true;
    }

    public function checkSecurityAndConnect  ($post) {
        if (!isset($post['login'], $post['mdp'])) {
                return false;
        }
        $dataTraiter = $this->checkPassword($post);
        if($dataTraiter !== false) {
            $token = $this->genTokenConnexionAndRecord ($dataTraiter);
            $this->recordJourneauxLog ($dataTraiter);
            $this->creatSession ($dataTraiter, $token);
            return true;
        } else {
            $this->recordHackerLogUser ($post);
            $this->BanIP ();
            return false;
        }
    }
    private function idUser () {
        $idUser = new Controles ();
        return $idUser->idUser($_SESSION);
    }
    public function disconnectUser () {
            $dataTraiter = array();
             array_push($dataTraiter, ['idUser'=>$this->idUser()]);
            $this->genTokenConnexionAndRecord ($dataTraiter);
                session_destroy();
                session_unset();
            return header('location:index.php?message=Vous êtes déconnecté');
            // header('location: urlsite');
    }
}
