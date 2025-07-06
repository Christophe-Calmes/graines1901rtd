<?php
Class PrintUser extends GetUser{
private $role;
private $yes;
  public function __construct() {
    $ROLES = $this->getRoles();
    $roles = array();
    foreach ($ROLES as $key => $value) {
      array_push($roles, ['name'=>$value['typeRole'], 'role'=>$value['accreditation']]);
    }
    $this->role = $roles;
    $this->yes = ['Non', 'Oui'];
  }
  public function setRoles () {
    return $this->role;
  }
  public  function userTable ($variable, $idNav) {
    if ($variable == []) {
      echo '<p>Pas de données</p>';
    } else {
    echo '<table class="tableWebSite" border="1">';
      echo '<tr>
            <th>Login</th>
            <th>Date d\'inscription</th>
            <th>Status</th>
            <th>Administrer</th>
          </tr>';
          foreach ($variable as $key => $value) {
            echo '<tr>
                    <td>'.$value['login'].'</td>
                    <td>'.brassageDate($value['dateCreation']).'</td>
                    <td class="celulleLeft fullHeigt">
                      <form action="'.encodeRoutage(14).'" method="post">
                        <div class="celulleLeft">
                        <label for="valide">Valider</label>
                        <select  id="valide" name="valide">';
                        for ($i=0; $i < count($this->yes) ; $i++) {
                          if($value['valide'] == $i) {
                            echo '<option value="'.$i.'" selected>'.$this->yes[$value['valide']].'</option>';
                          } else {
                            echo '<option value="'.$i.'">'.$this->yes[$i].'</option>';
                          }
                        }
                        echo'</select>
                        </div>
                        <div class="celulleLeft">
                        <label for="role">Niveau d\'accréditation</label>
                        <select id="role" name="role">';
                          foreach ($this->role as $keyRole => $valueRole) {
                            if($valueRole['role'] == $value['role']) {
                              echo '<option value="'.$valueRole['role'].'" selected>'.$valueRole['name'].'</option>';
                            } else {
                              echo '<option value="'.$valueRole['role'].'">'.$valueRole['name'].'</option>';
                            }
                          }

                        echo'</select>
                        
                        <input type="hidden" name="idUser" value="'.$value['idUser'].'" />
                        </div>
                        </td>
                        <td><button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button></td>
                      </form>
                    </td>
                  </tr>';
          }
    echo '</table>';}
    
  }
  public function printProfilUser () {
      $dataUser = $this->getProfil($_SESSION['tokenConnexion']);
      echo '<aside class="box">';
      echo '<ul class="listeProfil">';
        echo '<li><h4 class="titleEventItem">Votre profil</h4></li>';
        $value = $dataUser[0];
          echo '<li>Identité : '.$value['prenom'].' '.$value['nom'].'</li>';
          echo '<li>Pseudo : '.$value['login'].'</li>';
          echo '<li>Role : '.$this->role[$value['role']]['name'].'</li>';
          echo '<li class="alignLi">Date d\'inscription au site : <p class="displayDate">'.brassageDate($value['dateCreation']).'</p></li>';
          if ($value['role']== 4) {
          $member = $this->getTypeCotisation ($value['idUser']);
          echo '<li>Numéro adhérant : '.$member['MemberNumber'].'</li>';
          echo '<li>Membre association depuis le '.brassageDate($member['creat_date']).'</li>';
               switch ($member['cotisation']) {
                            case 0:
                                echo '<br/>Date inscription : '.brassageDate($member['update_date']);
                                echo '<br/>Pas de cotisation';
                                break;
                            case 1:
                                echo '<br/>Date cotisation : '.brassageDate($member['update_date']);
                                echo '<br/>Cotisation Individuel';
                                break;
                            case 2:
                                echo '<br/>Date cotisation : '.brassageDate($member['update_date']);
                                echo '<br/>Cotisation Famille';
                                break;
                            case 3:
                                echo '<br/>Date cotisation : '.brassageDate($member['update_date']);
                                echo '<br/>Cotisation demi année';
                                break;
                            case 9:
                                $data = $this->linkIdentity ($dataUser[0]['idUser']);
                                echo '<br/>Date cotisation : '.brassageDate($member['update_date']);
                                echo '<br/>Cotisation familliale affilié à '.$data['prenom'].' '.$data['nom'];
                                break;
                            
                            default:
                                echo 'Non';
                                break;
                        }
          }
        echo '</ul>';
      if(($value['role']== 1)||($value['role']== 4)){
        echo '<p>Vous avez accepté les CGU :</>';
        echo '<br/>';
        if(($value['role']== 4)) {
          echo '<a href="'.findTargetRoute(260).'">Voir les CGU</a>';
          echo '<a href="'.findTargetRoute(259).'">Voir la compta en cours</a>';
        } else {
          echo '<a href="'.findTargetRoute(104).'">Voir les CGU</a>';
        }
        
        
      }
  
      echo '</aside>';
    return $dataUser;
  }
  public function delUser($idNav, $delUserFormRoute) {
      echo '<form action="'.encodeRoutage($delUserFormRoute).'" method="post">
              <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Désinscription</button>
            </form>';
  }
  public function printRoles($valide) {
    $dataRoles = $this->getRoles($valide);
    $displayValide  = ['Non valide', 'Valide'];
       if($dataRoles != []) {
         ///$displayValide = 'Non valide';
         echo '<ul class="listClass">';
         echo '<li><h4>'.$displayValide[$valide].'</h4></li>';
         foreach ($dataRoles as $key => $value) {
           echo '<li>Type = '.$value['typeRole'].' Accréditation = '.$value['accreditation'].'</li>';
         }
         echo '</ul>';
       }
    }
    public function formProfil ($dataUser, $idNav) {
        $adressForm = [
                      ['updateEmail'=>16, 'updateSpeudo'=>17, 'updateMdP'=>18, 'delUser'=>22],
                      ['updateEmail'=>163, 'updateSpeudo'=>164, 'updateMdP'=>165, 'delUser'=>173],
                      ['updateEmail'=>168, 'updateSpeudo'=>166, 'updateMdP'=>169, 'delUser'=>174],
                      ['updateEmail'=>170, 'updateSpeudo'=>171, 'updateMdP'=>172, 'delUser'=>175]];
        switch ($dataUser[0]['role']) {
              case 1:
                // Membre
              $profilAdress = $adressForm[0];
               $delUserFormRoute = $profilAdress['delUser'];
              break;
              case 2:
                // Administrateur
              $profilAdress = $adressForm[1];
               $delUserFormRoute = $profilAdress['delUser'];
              break;
              case 3:
                // Gestionnaire
              $profilAdress = $adressForm[2];
               $delUserFormRoute = $profilAdress['delUser'];
              break;
              case 4:
                // Adéherant
              $profilAdress = $adressForm[3];
              $delUserFormRoute = $profilAdress['delUser'];
              break;
          
          default:
            echo '<h3>Error !</h3>';
            break;
        }
        $formModifierProfil = [['name'=>'email', 'message'=>'Email', 'type'=>0, 'lastInput'=>$dataUser[0]['email']]];
        $button = 'Modifier email';
        formModification($profilAdress['updateEmail'], $formModifierProfil, $idNav, $button);
        //Login
        $formModifierProfil = [['name'=>'login', 'message'=>'Pseudo', 'type'=>0, 'lastInput'=>$dataUser[0]['login']]];
        $button = 'Modifier pseudo';
        formModification($profilAdress['updateSpeudo'], $formModifierProfil, $idNav, $button);
        //mdp
        $formModifierProfil = [['name'=>'mdp', 'message'=>'Nouveau mot de passe', 'type'=>0, 'lastInput'=>genToken (12)],
                          ['name'=>'mdpA', 'message'=>'Confirmer nouveau mot de passe', 'type'=>9, 'lastInput'=>'????']];
        $button = 'Modifier mot de passe';
        formModification($profilAdress['updateMdP'], $formModifierProfil, $idNav, $button);
        $this->delUser($idNav, $delUserFormRoute);
    }
}
