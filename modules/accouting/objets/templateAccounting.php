<?php
require ('modules/accouting/objets/SQLaccounting.php');
require_once ('functions/functionDateTime.php');
class templateAccounting extends SQLaccounting 
{

    private function globalSelect ($label, $fields, $array, $nameFields) {
            echo '<label class="labelFirstLetter" for="'.$fields.'">'.$label.'</label>';
            echo '<select id="'.$fields.'"name="'.$fields.'">';
                foreach ($array as $value) {
                    echo '<option value="'.$value['id'].'">'.$value[$nameFields].'</option>';
                }
            echo '</select>';
    }
        public function contributFamily ($idUser, $idNav) {
        $dataFamilyMember = $this->getFamilyMembership ();
        if(!empty($dataFamilyMember)) {
        $year = date('Y');
            echo '<form class="formulaireClassique" method="post" action="'.encodeRoutage(145).'">';
            echo '<input type="hidden" name="idUser" value="'. $idUser.'">';
             echo '<label class="labelFirstLetter" for="idFamily">Adhésion famille nom principal</label>';
            echo '<select id="idFamily" name="idFamily">';
                foreach ($dataFamilyMember as $value) {
                    echo '<option value="'.$value['idUser'].'">'.$value['nom'].' '.$value['prenom'].'</option>';
                }
            echo '</select>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Adhésion Familliale '.$year.' / '.($year + 1).'</button>';
            echo '</form>';
        }

    }

    public function contributForYear ($idUser, $idNav) {
        $year = date('Y');
        echo '<aside class="item">';
            echo '<form class="formulaireClassique" method="post" action="'.encodeRoutage(144).'">';
            echo '<input type="hidden" name="idUser" value="'. $idUser.'">';
            $this->globalSelect ('Type de transaction', 'formeBanquaire', $this->typeBankTransaction, 'type');
            echo '<label for="numeroTransaction">Numéro de transaction ou chèque :</label>';
            $this->globalSelect ('Cotisation', 'montant', $this->annualCotisation, 'type');
            echo '<input id="numeroTransaction" type="text" name="numeroTransaction" placeholder="numero de transaction"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Adhésion '.$year.' / '.($year + 1).'</button>';
            echo '</form>';
            $this->contributFamily ($idUser, $idNav);
        echo '</aside>';
        
    }

    public function displayActualAccounting () {
        $data = $this->getActualAccouting ();
        echo '<table class="tableWebSite" border="1">';
            echo '<tr>
                    <th>Ordre transaction</th>
                    <th>Date mouvement</th>
                    <th>Date modification</th>
                    <th>Numéro de transaction</th>
                    <th>object</th>
                    <th>Montant</th>
                    <th>Type bancaire</th>
                    <th>Auteur de la transaction</th>
                    <th>Balance</th>
                    <th>Bilan actif</th>
                </tr>';
            foreach ($data as $value) {
                $name = $this->identification ($value['auteurActes']);
                echo '<tr>
                        <td>'.$value['idActe'].'</td>
                        <td>'.formatDateHeureFr($value['dateActe']).'</td>
                        <td>'.formatDateHeureFr($value['date_update']).'</td>
                        <td>'.$value['numeroTransaction'].'</td>
                        <td>'.$value['objet'].'</td>
                        <td>'.$value['montant'].' €</td>
                        <td>'.$this->typeBankTransaction[$value['formeBanquaire']]['type'].'</td>
                        <td>'.$name['prenom'].' '.$name['nom'].'</td>
                        <td>'.($value['balance'] ? 'Recette' : 'Débit').'</td>
                        <td>'.($value['bilan'] ? 'Non' : 'Oui').'</td>
                    </tr>';
                    
            }
        echo '</table>';
    }

}
