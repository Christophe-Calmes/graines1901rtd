<?php
class SQLaccounting 
{
    protected $typeBankTransaction;
    protected $annualCotisation;

    public function __construct () {
        $this->typeBankTransaction = [['id'=>0, 'type'=>'Liquide'], ['id'=>1, 'type'=>'Virement'], ['id'=>2, 'type'=>'Chéque']];
        $this->annualCotisation = [
        ['id'=>0, 'type'=>'Année compléte 25 €', 'price'=>25, 'cotisation'=>1], 
        ['id'=>1, 'type'=>'Famille  50€', 'price'=>50, 'cotisation'=>2], 
        ['id'=>2, 'type'=>'demi année 15 €', 'price'=>15, 'cotisation'=>3]];
    }
    public function cleanCurrencyString(string $input): string {
            $input = (string) $input;
            $cleaned = str_replace(' ', '', $input);
            $symbols = ['€', '$', '£', '¥', '₹', 'CAD', 'USD', 'EUR', 'GBP'];
            $cleaned = str_replace($symbols, '', $cleaned);
            $cleaned = str_replace(',', '.', $cleaned);
            $cleaned = preg_replace('/[^0-9.-]/', '', $cleaned);
            $parts = explode('.', $cleaned);
            if (count($parts) > 2) {
                $cleaned = $parts[0] . '.' . implode('', array_slice($parts, 1));
            }
            if (substr_count($cleaned, '-') > 1 || (substr_count($cleaned, '-') === 1 && $cleaned[0] !== '-')) {
                return ''; 
            }
            return $cleaned;
        }
    public function isNumber ($data) {
        $dataClean = $this->cleanCurrencyString($data);
        $pattern = '/^[-+]?(\d+|\d+\.\d{1,2})$/';
        return preg_match($pattern, $dataClean) === 1;
    }
    public function checkIndexTranscation ($id) {
        if (isset($this->typeBankTransaction[$id])) {
            return true;
        }
        return false;
    }
    public function getTypeCotisation ($index) {
        return $this->annualCotisation[$index]['type'];
    }
    public function getCotisation ($index) {
        return $this->annualCotisation[$index]['cotisation'];
    }
    public function checkIndexCotisation ($index) {
        if (isset($this->annualCotisation [$index])) {
            return true;
        }
        return false;
    }
    public function amount ($index) {
        return $this->annualCotisation[$index]['price'];
    }
    public function addActe ($param) {
        $insert = "INSERT INTO `compta`(  `formeBanquaire`,`montant`, `numeroTransaction`, `objet`,  `auteurActes` ) 
        VALUES (:formeBanquaire, :montant, :numeroTransaction,  :objet, :idUser)";
        return ActionDB::access($insert, $param, 2);
    }
    private function getDateStartBalanceSheet () {
        $select = "SELECT `openCompta` FROM `bilans` WHERE `valid` = 1 AND `archive` = 0 ORDER BY `openCompta` DESC LIMIT 1;";
        return ActionDB::select($select, [],2)[0]['openCompta'];
    }
    protected function getActualAccouting () {
        $dateOpening = $this->getDateStartBalanceSheet ();
        $param = [['prep'=>':dateActe', 'variable'=>$dateOpening]];
        $select = "SELECT `idActe`, 
                `dateActe`, 
                `date_update`, 
                `numeroTransaction`, 
                `objet`, 
                `montant`, 
                `formeBanquaire`, 
                `auteurActes`, 
                `auteurDel`, 
                `valide`, 
                `bilan`,
                `balance`
        FROM `compta`
        WHERE `dateActe` >= :dateActe AND `valide`=1;";
        return ActionDB::select($select, $param, 2);
    }
    protected function identification ($idUser)  {
        $select = "SELECT `prenom`, `nom` FROM `users` WHERE `idUser`=:idUser;";
        $param = [['prep'=>':idUser', 'variable'=>$idUser]];
        return ActionDB::select($select, $param, 0)[0];
    }
    protected function getFamilyMembership () {
        $select = "SELECT `cotisation`, `nom`, `prenom`, `idUser`
                    FROM `membership` 
                    INNER JOIN `users` ON `idUser`=`id_users`
                    WHERE `cotisation` = 2;";
        return actionDB::select($select, [], 0);
    }
    public function addAccountingActe ($param) {
        $insert = "INSERT INTO `compta`(`formeBanquaire`, `montant`, `balance`, `numeroTransaction`, `objet`, `auteurActes`) 
        VALUES (:formeBanquaire, :montant , :balance , :numeroTransaction,:objet, :idUser);";
        return actionDB::access($insert, $param, 2);
    }
    protected function balanceAccounting () {
        $result = array();
        $DateStartBilan = $this->getDateStartBalanceSheet ();
        $param = [['prep'=>':startDateBilan', 'variable'=>$DateStartBilan]];
        $select = "SELECT SUM(`montant`) AS `sumBilan` FROM `compta` WHERE `balance` = 1 AND `dateActe` >= :startDateBilan AND bilan = 0 AND valide=1;";
        array_push($result, ActionDB::select($select, $param, 2)[0]['sumBilan']);
        $select = "SELECT SUM(`montant`) AS `sumBilan` FROM `compta` WHERE `balance` = 0 AND `dateActe` >= :startDateBilan AND bilan = 0 AND valide=1;";
        array_push($result, ActionDB::select($select, $param, 2)[0]['sumBilan']);
        array_push($result, $result[0]-$result[1]);
        return $result;
    }
    protected function unvalideActe ($idCompta) {
        $param = [['prep'=>':id', 'variable'=>$idCompta]];
        $update = "UPDATE `compta` SET `valide`= 0 WHERE `idActe`=:id AND `bilan`=0;";
        ActionDB::access($update, $param, 2);
    }

}
