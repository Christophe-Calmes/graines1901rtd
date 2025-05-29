<?php
require ('modules/accouting/objets/SQLaccounting.php');
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

    public function contributForYear ($idUser, $idNav) {
        $year = date('Y');
        echo '<aside class="item">';
            echo '<form class="formulaireClassique" method="post" action="'.encodeRoutage(144).'">';
            echo '<input type="hidden" name="idUser" value="' . htmlspecialchars($idUser) . '">';
            $this->globalSelect ('Type de transaction', 'type', $this->typeBankTransaction, 'type');
            echo '<label for="numeroTransaction">Numéro de transaction :</label>';
            echo '<input id="numeroTransaction" type="text" name="numeroTransaction" id="numeroTransactio" placeholder="numero de transaction"/>';

            echo '<p>Cotisation annuel : '. $this->annualCotisation .' €</p>';
            echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Adhésion '.$year.' / '.($year + 1).'</button>';
            echo '</form>';
        echo '</aside>';
    }

}
