<?php
require('modules/Membership/objects/SQLmembership.php');
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
    private function memberShip($idUser, $idNav) {
        echo '<td>
                <a href="'.findTargetRoute(237).'&idUser='.$idUser.'">Cotisation</a>
            </td>';
    }

    public function displayMember($idNav, $accreditation)
    {
       $dataMember = $this->getMember($accreditation);
         if (empty($dataMember)) {
              echo '<h2 class="subTitleSite">No members found.</h2>';
         } else {
                echo '<h2 class="subTitleSite">List des membres du site non adhérant</h2>';
                echo '<table class="tableWebSite" border="1">';
                    echo "<tr><th>Email</th><th>Prenom</th><th>Nom</th><th>Pseudo</th><th>Valid</th><th>Role</th><th>Date de création</th><th>Administration</th></tr>";
                    foreach ($dataMember as $member) {
                        echo "<tr>";
                        echo '<td><a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></td>';
                        echo "<td>" . htmlspecialchars($member['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['login']) . "</td>";
                        echo "<td>" . ($member['valide'] ? 'Yes' : 'No') . "</td>";
                        echo '<td>'.htmlspecialchars($member['typeRole']).'</td>';
                        echo "<td>" . htmlspecialchars(brassageDate($member['dateCreation'])) . "</td>";
                        if($member['role'] == 1) {
                            $this->addMemberFirstTime ($member['idUser'], $idNav);
                        }
                        if($member['role'] == 4) {
                            $this->memberShip($member['idUser'], $idNav);
                        }
                        
                        echo "</tr>";
                }
              echo "</table>";
         }
    }
    public function dataSheetMemberShip ($idUser) {
        $year = date('Y');
        $dataMembership = $this->getAllInfoMemberShip ($idUser);
    
        echo '<aside class="item">';    
        echo '<h2 class="subTitleSite">Donnée du membre</h2>';
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
