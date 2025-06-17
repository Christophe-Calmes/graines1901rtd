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
                echo '<h2 class="subTitleSite">Liste des membres du site adhérant</h2>';
                echo '<table class="tableWebSite" border="1">';
                    echo "<tr><th>Email</th><th>Prenom</th><th>Nom</th><th>Pseudo</th><th>Valid</th><th>Role</th><th>Date de création</th><th>Cotisation</th><th>Administration</th></tr>";
                    foreach ($dataMember as $member) {
                        echo "<tr>";
                        echo '<td><a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></td>';
                        echo "<td>" . htmlspecialchars($member['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['login']) . "</td>";
                        echo "<td>" . ($member['valide'] ? 'Oui' : 'Non') . "</td>";
                        echo '<td>'.htmlspecialchars($member['typeRole']).'</td>';
                        echo "<td>" . htmlspecialchars(brassageDate($member['dateCreation'])) . "</td>";
                        echo '<td>';
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
                        echo '</td>';
                        if($member['role'] == 1) {
                            $this->addMemberFirstTime ($member['idUser'], $idNav);
                        }
                        if($member['role'] == 4) {
                            $this->memberShip($member['idUser'], $idNav, $member['cotisation']);
                        } 
                        
                        echo "</tr>";
                }
              echo "</table>";
         }
    }
    public function NewMembership ($idNav) {
             
             $dataMember = $this->getNewMember();
             if(!empty($dataMember)) {
   echo '<h2 class="subTitleSite">Liste des membres du site adhérant</h2>';
                echo '<table class="tableWebSite" border="1">';
                    echo "<tr><th>Email</th><th>Prenom</th><th>Nom</th><th>Pseudo</th><th>Role</th><th>Date de création</th><th>Administration</th></tr>";
                    foreach ($dataMember as $member) {
                        echo "<tr>";
                        echo '<td><a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></td>';
                        echo "<td>" . htmlspecialchars($member['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['login']) . "</td>";
                        echo '<td>'.htmlspecialchars($member['typeRole']).'</td>';
                        echo "<td>" . htmlspecialchars(brassageDate($member['dateCreation'])) . "</td>";
                        $this->addMemberFirstTime ($member['idUser'], $idNav);
                        echo "</tr>";
                    }
                    echo "</table>";
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
