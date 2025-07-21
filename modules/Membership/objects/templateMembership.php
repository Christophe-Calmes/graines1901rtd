<?php
require('modules/Membership/objects/SQLmembership.php');
//include_once ('modules/accouting/objets/SQLaccounting.php');
require('functions/functionDateTime.php');

class templateMembership extends SQLmembership
{

    private function addMemberFirstTime ($idUser, $idNav) {
        echo '<td>
            <form method="post" action="'.encodeRoutage(143).'">';
            echo '<input type="hidden" name="idUser" value="' . htmlspecialchars($idUser) . '">';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Adhérant</button>';
            echo '</form>
        </td>';
    }
    private function memberShip($idUser, $idNav, $cotisation) {
        if(!$cotisation) {
            echo '<td>
                <a href="'.findTargetRoute(237).'&idUser='.$idUser.'">Cotisation</a>
            </td>';
        } else {
            echo '<td><button class="redButton notPossible">Cotisation</button></td>';
        }
        
    }

    public function displayMember($idNav, $accreditation)
        {
            $dataMember = $this->getMember($accreditation);
      
         if (empty($dataMember)) {
              echo '<h2 class="subTitleSite">No members found.</h2>';
         } else {
                echo '<h2 class="subTitleSite">Liste des membres du site adhérants</h2>';
                  echo '<article class="gallery">';
                     foreach ($dataMember as $member) {
                        echo '<div class="item">';
                            echo '<ul class="listeProfil">';
                                echo '<li>Email : <a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></li>';
                                echo '<li>Identité : '. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</li>';
                                echo '<li>Pseudo : '. htmlspecialchars($member['login']).'</li>';
                                echo '<li>'.htmlspecialchars($member['typeRole']).'</li>';
                                echo '<li>'.htmlspecialchars(brassageDate($member['dateCreation'])).'</li>';
                                 switch ($member['cotisation']) {
                            case 0:
                                echo '<li>Date inscription : '.brassageDate($member['update_date']).'</li>';
                                echo '<li>Pas de cotisation</li>';
                                break;
                            case 1:
                                echo '<li>Date cotisation : '.brassageDate($member['update_date']).'</li>';
                                echo '<li>Cotisation Individuel</li>';
                                break;
                            case 2:
                                echo '<li>Date cotisation : '.brassageDate($member['update_date']).'</li>';
                                echo '<li>Cotisation Famille</li>';
                                break;
                            case 3:
                                echo '<li>Date cotisation : '.brassageDate($member['update_date']).'</li>';
                                echo '<li>Cotisation demi année</li>';
                                break;
                            case 9:
                                $data = $this->linkIdentity ($member['idUser']);
                                echo '<li>Date cotisation : '.brassageDate($member['update_date']).'</li>';
                                echo '<li>Cotisation familliale affilié à '.$data['prenom'].' '.$data['nom'].'</li>';
                                break;
                            
                            default:
                                echo '<li>Non</li>';
                                break;
                        }
                        if($member['role'] == 1) {
                            echo '<li>'.$this->addMemberFirstTime ($member['idUser'], $idNav).'</li>';
                        }
                        if($member['role'] == 4) {
                            echo '<li>'.$this->memberShip($member['idUser'], $idNav, $member['cotisation']).'</li>';
                        } 
                            echo '</ul>';
                        echo '</div>';
                }
              echo "</table>";
         }
    }
    public function NewMembership ($idNav) {
             
             $dataMember = $this->getNewMember();
             if(!empty($dataMember)) {
                echo '<h2 class="subTitleSite">Liste des membres du site</h2>';
                    echo '<article class="gallery">';
                     foreach ($dataMember as $member) {
                        echo '<div class="item">';
                            echo '<ul class="listeProfil">';
                                echo '<li>Email : <a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></li>';
                                echo '<li>Identité : '. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</li>';
                                echo '<li>Pseudo : '. htmlspecialchars($member['login']).'</li>';
                                echo '<li>'.htmlspecialchars($member['typeRole']).'</li>';
                                echo '<li>'.htmlspecialchars(brassageDate($member['dateCreation'])).'</li>';
                                echo '<li>'.$this->addMemberFirstTime ($member['idUser'], $idNav).'</li>';
                            echo '</ul>';
                        echo '</div>';
                     }
                    echo '</article>';
             } else {
                echo '<h2 class="subTitleSite">No members found.</h2>';
             }
            
    }
    public function dataSheetMemberShip ($idUser) {
        $year = date('Y');
        $dataMembership = $this->getAllInfoMemberShip ($idUser);
    
        echo '<aside class="item">';    
        echo '<h2 class="subTitleSite">Données du membre</h2>';
            echo '<ul class="listeProfil">';
                echo '<li>Numéro d\'adéhrant : '.$dataMembership['MemberNumber'].'</li>';
                echo '<li>Identité : '.$dataMembership['prenom'].' '.$dataMembership['nom'].'</li>';
                echo '<li>Speudo : '.$dataMembership['login'].'</li>';
                echo '<li>Date d\'inscription : '.brassageDate($dataMembership['dateCreation']).'</li>';
                if($dataMembership['cotisation'] == 1) {
                        echo '<li> Date de cotisation : '.brassageDate($dataMembership['update_date']).'</li>';
                        echo '<li>Cotisation année '.($year-1).'/'.$year.':'.($dataMembership['cotisation']? 'Oui' : 'Non').'</li>';
                } else {
                    echo '<li>Cotisation en court : '.($dataMembership['cotisation']? 'Oui' : 'Non').'</li>';
                }
            echo '</ul>';
        echo '</aside>';

    }
}
