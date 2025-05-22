<?php
$formInscription = [['name'=>'login', 'message'=>'Votre login', 'type'=>0],
                    ['name'=>'mdp', 'message'=>'Votre mot de passe', 'type'=>9]];
$button = 'Connexion';
formAction(2, $formInscription, 0, $button);
 ?>
<div class="down">
<button type="button" id="magic" class="open">Autres options ?</button>
</div>
<div id="hiddenForm">
    <aside>
        <a href="<?php echo findTargetRoute(73); ?>">Créer un compte ?</a>
        <a href="<?php echo findTargetRoute(136); ?>">Voir les CGU</a>
        <a href="<?php echo findTargetRoute(140); ?>">Vous avez perdu votre mot de passe ?</a>
    </aside>
</div>
 <?php include 'javaScript/magicButtonMenus.php'; ?>