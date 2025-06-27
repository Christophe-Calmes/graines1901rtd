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
    echo '<div class="flex-rows">
            <table>';
      echo '<tr>
            <th>Login</th>
            <th>Date d\'inscription</th>
            <th>Modifier</th>
          </tr>';
          foreach ($variable as $key => $value) {
            echo '<tr>
                    <td>'.$value['login'].'</td>
                    <td>'.brassageDate($value['dateCreation']).'</td>
                    <td>
                      <form action="'.encodeRoutage(14).'" method="post">
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
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
                      </form>
                    </td>
                  </tr>';
          }
    echo '</table>
    </div>';}
    
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
          if(($value['role']== 1)||($value['role']== 4)) {
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
                                $data = $this->linkIdentity ($member['idUser']);
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
  public function delUser($idNav) {
      echo '<form action="'.encodeRoutage(22).'" method="post">
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
}
