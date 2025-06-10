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
            $this->globalSelect ('Cotisation', 'montant', $this->annualCotisation, 'type');
            echo '<label for="numeroTransaction">Numéro de transaction ou chèque :</label>';
            echo '<input id="numeroTransaction" type="text" name="numeroTransaction" placeholder="numero de transaction"/>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Adhésion '.$year.' / '.($year + 1).'</button>';
            echo '</form>';
            $this->contributFamily ($idUser, $idNav);
        echo '</aside>';
        
    }
    private function balance () {
        $resultat = $this->balanceAccounting ();
        if($resultat[2]>0) {
            $warning = 'green';
        } else {
            $warning = 'red';
        }
        echo '<table class="tableWebSite" border="1">';
            echo '<tr>
                    <th>Recette</th>
                    <th>Debit</th>
                    <th>Balance</th>
                </tr>';
            echo '<tr>
                <td>'.round($resultat[0], 2).' €</td>
                <td>'.round($resultat[1], 2).' €</td>
                <td class="'.$warning.'">'.round($resultat[2], 2).' €</td>
            </tr>';
            

        echo '</table>';

    }
    private function formUnvalideActe ($idActe, $idNav) {
        echo '<td>';
            echo '<form method="post" action="'.encodeRoutage(147).'">';
                echo '<input type="hidden" name="id" value="'. $idActe.'">';
                echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Del</button>';
            echo '</form>';
        echo '</td>';
    }

    public function displayActualAccounting ($idNav) {
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
                    <th>Administration</th>
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
                        <td>'.($value['bilan'] ? 'Non' : 'Oui').'</td>';
                        $this->formUnvalideActe ($value['idActe'], $idNav);
                echo'</tr>';
                    
            }
        echo '</table>';
        echo '<aside class="customerForm">';
        $this->balance();
        echo '</aside>';
    }

    public function displayAddAct($idNav) {
   
            echo '<form class="customerForm" method="post" action="'.encodeRoutage(146).'">';
                $this->globalSelect ('Type de transaction', 'formeBanquaire', $this->typeBankTransaction, 'type');
                echo '<label for="montant">Valeur absolu montant en €</label>';
                echo '<input type="number" id="montant" name="montant" step="0.01" min="0" placeholder="0.00 €">';
                echo '<label for="balance">Recette ou Débit</label>';
                    echo '<select id="balance" name="balance">';
                        echo '<option value="1">Recette + </option>';
                        echo '<option value="0">Débit -</option>';
                    echo '</select>';
                echo '<label for="numeroTransaction">Numéro de transaction ou chèque :</label>';
                echo '<input id="numeroTransaction" type="text" name="numeroTransaction" placeholder="numero de transaction"/>';
                echo '<label for="objet">Objet</label>';
                echo '<input id="objet" type="text" name="objet" placeholder="Motif de la transaction"/>';
                echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Add</button>';
            echo '</form>';
    }
    private function displayBilan ($dataBilan) {
    
        if(!empty($dataBilan)) {
            echo '<table class="tableWebSite" border="1">';
                echo '<tr><th>Numéro bilan</th><th>Date ouverture</th><th>Date fermeture</th><th>Visualiser</th></tr>';
                foreach ($dataBilan as $value) {
                    echo '<tr>';
                        echo '<td>'.$value['id'].'</td>';
                        echo '<td>'.brassageDate($value['openCompta']).'</td>';
                        echo '<td>'.brassageDate($value['closeCompta']).'</td>';
                        echo '<td></td>';
                    echo '</tr>';
                }
            echo '</table>';
        } else {
            echo '<h2>No data !</h2>';
        }

    }
    public function displayOldBilan () {
        $dataBilan = $this->getOldBilan ();
        echo '<h2 class="subTitleSite">Date des anciens bilans</h2>';
        $this->displayBilan ($dataBilan);
    }
    public function displayActualBilan () {
        $dataBilan = $this->getActualBilan ();
        echo '<h2 class="subTitleSite">Date du bilan actuel</h2>';
        $this->displayBilan ($dataBilan);
    }

}
