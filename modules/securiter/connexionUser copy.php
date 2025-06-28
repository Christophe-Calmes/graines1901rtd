<?php
include '../functions/functionToken.php';
$arrayKey = ['login', 'mdp', 'idNav'];
if(checkPostFields ($arrayKey, $_POST)) {
function recordingLogs () {
    $insert="INSERT INTO `journaux`(`ipUser`, `login`, `mdpHacker`)
    VALUES (:ipUser, :login, :mdpHacker)";
    $log = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
            ['prep'=>':login', 'variable'=>filter($_POST['login'])],
            ['prep'=>':mdpHacker', 'variable'=>filter($_POST['mdp'])],];
            ActionDB::access($insert, $log);
}
//Vérifier le mot de passe :
$select = "SELECT `idUser`, `login`, `mdp`, `role` FROM `users` WHERE `login` = :login AND `valide` = 1";
$param = [['prep'=>':login', 'variable'=>filter($_POST['login'])]];
$dataTraiter = ActionDB::select($select, $param);
if (!empty($dataTraiter)) {
    if(password_verify(filter($_POST['mdp']), $dataTraiter[0]['mdp'])) {
  //Création du token de connexion
  $token = genToken(16);
  $update = "UPDATE `users` SET `token`= :token WHERE `idUser` = :idUser";
  $param = [['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']], ['prep'=>':token', 'variable'=>$token]];
  ActionDB::access($update, $param);
      //Identification en session
        $_SESSION['tokenConnexion'] = $token;
        $_SESSION['role'] = $dataTraiter[0]['role'];
        $_SESSION['login'] = $dataTraiter[0]['login'];
            //Enregistrement dans le journal de connexion
            $insert = "INSERT INTO `journaux`(`ipUser`, `idUser`, `login`, `okConnexion`)
            VALUES (:ipUser, :idUser, :login, 1)";
            $log = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
                    ['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']],
                    ['prep'=>':login', 'variable'=>$dataTraiter[0]['login']]];
            ActionDB::access($insert, $log);
            return header('location:../index.php?message=bienvenu '.$_SESSION['login']);
    } else {
      recordingLogs ();
      return header('location:../index.php?message=Authentication error');
    }
} else {
    $ipCheck->BanIP ();
    recordingLogs ();
  return header('location:../index.php?message=Authentication error');
}
} else {
  header('location:../index.php?message=Treatment concerns');
}