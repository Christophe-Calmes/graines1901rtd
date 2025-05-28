<?php
require('modules/Membership/objects/SQLmembership.php');
require('functions/functionDateTime.php');

class templateMembership extends SQLmembership
{

    private function addMemberFirstTime ($idUser, $idNav) {
        echo '<td>
            <form method="post" action="'.encodeRoutage(143).'">';
            echo '<input type="hidden" name="idUser" value="' . htmlspecialchars($idUser) . '">';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Premier adhésion</button>';
            echo '</form>
        </td>';
    }

    public function displayMember($idNav)
    {
       $dataMember = $this->getMember();
         if (empty($dataMember)) {
              echo "No members found.";
         } else {
                echo '<h2 class="subTitleSite">List des membres du site non adhérant</h2>';
                echo '<table class="tableWebSite" border="1">';
                    echo "<tr><th>Email</th><th>Prenom</th><th>Nom</th><th>Pseudo</th><th>Valid</th><th>Date de création</th><th>Cotiser ?</th></tr>";
                    foreach ($dataMember as $member) {
                        echo "<tr>";
                        echo '<td><a href="mailto:' . htmlspecialchars($member['email']) . '">'. htmlspecialchars($member['prenom']) .' '. htmlspecialchars($member['nom']) .'</a></td>';
                        echo "<td>" . htmlspecialchars($member['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($member['login']) . "</td>";
                        echo "<td>" . ($member['valide'] ? 'Yes' : 'No') . "</td>";
                        echo "<td>" . htmlspecialchars(brassageDate($member['dateCreation'])) . "</td>";
                        $this->addMemberFirstTime ($member['idUser'], $idNav);
                        echo "</tr>";
                }
              echo "</table>";
         }
    }
}
