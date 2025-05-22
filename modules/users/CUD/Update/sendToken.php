<?php
//encodeRoutage(56)
require('../functions/functionToken.php');
require('../modules/users/objets/getUser.php');
$sendToken = new GetUser();
if($sendToken->testUser(filter($_POST['email'])) == 1){
    $token = genToken (14);
    $sendToken->updateToken(filter($_POST['email']),$token);
    /*$to = filter($_POST['email']);
    $subject = 'Votre token de sécurité';
    $message = $token.' votre token de sécurité pour modifier votre mot de passe.';
    $headers = 'From: no-reply@guyajeux.graines1901.fr';
    mail($to, $subject, $message, $headers);*/
    return header('location:../index.php?message=Email correctement envoyé.&idNav='.$idNav);
} else {
    return header('location:../index.php?message=Votre mail n\'existe pas.&idNav='.$idNav);
}


