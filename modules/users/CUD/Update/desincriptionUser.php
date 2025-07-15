<?php
// encodeRoutage(22)
$update = "UPDATE `users` SET `valide` = 0 WHERE `idUser` = :idUser";
$param = [['prep'=>':idUser', 'variable'=>$checkId->idUser($_SESSION)]];
ActionDB::access($update, $param, 0);
session_destroy();
session_unset();
header('location:../index.php?message=You have deactivated your account.');
exit();