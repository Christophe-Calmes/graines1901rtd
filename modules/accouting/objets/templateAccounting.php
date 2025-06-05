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

    public function displayActualAccounting ($date) {
        $data = $this->getActualAccouting ($date);
        print_r($data);
    }

}
