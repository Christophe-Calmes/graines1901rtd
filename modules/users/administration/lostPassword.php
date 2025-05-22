<h3 class="subTitleSite">Vous avez perdu votre mot de passe ?</h3>
<?php
//findTargetRoute(140)
$formInscription = [['name'=>'email', 'message'=>'Votre email', 'type'=>0]];
$button = 'Lancer la procédure';
formAction(56, $formInscription, 0, $button);
$formInscription = [['name'=>'email', 'message'=>'Votre email', 'type'=>0],
                    ['name'=>'token', 'message'=>'Token', 'type'=>0],
                    ['name'=>'mdp', 'message'=>'Votre mot de passe', 'type'=>9],
                    ['name'=>'mpdA', 'message'=>'Confirmer votre mot de passe', 'type'=>9]];
$button = 'Confirmer votre nouveau mot de passe';
echo '<h3 class="subTitleSite">Vous avez votre token de sécurité ?</h3>';
formAction(57, $formInscription, 0, $button);