<?php
class SQLaccounting 
{
    protected $typeBankTransaction;
    protected $annualCotisation;

    public function __construct () {
        $this->typeBankTransaction = [['id'=>0, 'type'=>'Liquide'], ['id'=>1, 'type'=>'Virement'], ['id'=>2, 'type'=>'Chéque']];
        $this->annualCotisation = [
        ['id'=>0, 'type'=>'Année compléte 30 €', 'price'=>30, 'cotisation'=>1], 
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
    protected function getActualBilan () {
        $select = "SELECT `id`, `openCompta`, `closeCompta`, `archive`, `valid` FROM `bilans` WHERE `valid` = 1 AND `archive` = 0 ORDER BY `openCompta` DESC LIMIT 1;";
        return ActionDB::select($select, [],2);
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
    public function unvalideActe ($param) {
        $update = "UPDATE `compta` SET `valide`= 0, `date_update`= NOW(), `auteurDel`=:idUser  WHERE `idActe`=:id AND `bilan`=0;";
        ActionDB::access($update, $param, 2);
    }
    public function getIdAct ($id) {
        $select = "SELECT COUNT(`idActe`) AS `nbrActe` 
        FROM `compta` WHERE `idActe` = :id AND `valide` = 1;";
        $param = [['prep'=>':id', 'variable'=>$id]];
        return ActionDB::select($select,  $param, 2)[0]['nbrActe'];
    }
    protected function getOldBilan () {
        $select = "SELECT `id`, `openCompta`, `closeCompta`, `archive`, `valid` FROM `bilans` WHERE `archive` = 1 ORDER BY `openCompta` DESC;";
        return ActionDB::select($select, [],2);
    }
    private function getDateArchiveBilan ($idBilan) {
        $select = "SELECT `openCompta`, `closeCompta` FROM `bilans` WHERE `id` = :id AND `archive` = 1 AND `valid` = 1;";
        $param = [['prep'=>':id', 'variable'=>$idBilan]];
        return ActionDB::select($select, $param, 2)[0];
    }
    protected function getBilanArchive ($idBilan) {
        $datesOldBilan = $this->getDateArchiveBilan ($idBilan);
        $select = "SELECT `idActe`, `dateActe`, `date_update`, `numeroTransaction`, `objet`, `montant`, `formeBanquaire`, `auteurActes`, `auteurDel`, `valide`, `bilan`, `balance` 
        FROM `compta` 
        WHERE `dateActe` >= :OpenDate 
        AND `dateActe`<=:closeDate 
        AND `valide` = 1 
        AND `bilan` = 1
        ORDER BY `dateActe`;";
        $param = [['prep'=>':OpenDate', 'variable'=>$datesOldBilan['openCompta']],
        ['prep'=>':closeDate', 'variable'=>$datesOldBilan['closeCompta']]];
        return ActionDB::select($select, $param, 2);

    }
    protected function archiveBalanceAccounting ($idBilan) {
       $datesOldBilan = $this->getDateArchiveBilan ($idBilan);
        $result = array();
        $param = [['prep'=>':OpenDate', 'variable'=>$datesOldBilan['openCompta']],
        ['prep'=>':closeDate', 'variable'=>$datesOldBilan['closeCompta']]];
        $select = "SELECT SUM(`montant`) AS `sumBilan` FROM `compta` 
                    WHERE `balance` = 1 
                    AND `dateActe` >= :OpenDate 
                    AND `dateActe`<=:closeDate 
                    AND `bilan` = 1 
                    AND `valide`=1;";
        array_push($result, ActionDB::select($select, $param, 2)[0]['sumBilan']);
        $select = "SELECT SUM(`montant`) AS `sumBilan` FROM `compta` 
                    WHERE `balance` = 0 
                    AND `dateActe` >= :OpenDate 
                    AND `dateActe`<=:closeDate 
                    AND `bilan` = 1 
                    AND `valide`=1;";
        array_push($result, ActionDB::select($select, $param, 2)[0]['sumBilan']);
        array_push($result, $result[0]-$result[1]);
        return $result;
    }
    public function checkBilan ($idBilan) {
        $select = "SELECT COUNT(`id`) AS `checkID` 
        FROM `bilans` 
        WHERE `id` = :id AND `archive` = 0 AND `valid` = 1;";
        $param = [['prep'=>':id', 'variable'=>$idBilan]];
        if( ActionDB::select($select, $param, 2)[0]['checkID'] == 1) {
            return true;
        }
        return false;
    }
    private function closeActualBilan ($param) {
        $update = "UPDATE `compta` SET `bilan` = 1  WHERE `valide` = 1 AND `dateActe` >= :dateOldBilan;";
        ActionDB::access($update, $param, 2);
        return true;
    }
    private function closeBilanDateAndArchive ($param) {
        $update = "UPDATE `bilans` SET `closeCompta`=NOW(), `archive`=1 WHERE `openCompta` = :dateOldBilan;";
        ActionDB::access($update, $param, 2);
        return true;
    }
    public function openNewBilan () {
        $insert ="INSERT INTO `bilans` () VALUES ();";
        ActionDB::access($insert, [], 2);
    }

    public function closeAndOpenBilan ($idUser) {
        $solde = $this->balanceAccounting ();
        if($solde[2]>=0) {
            $balance = 1;
        } else {
            $balance = 0;
        }
        $dateOldBilan = $this->getDateStartBalanceSheet ();
        $param = [['prep'=>':dateOldBilan', 'variable'=>$dateOldBilan]];
        $this->closeActualBilan ($param);
        $this->closeBilanDateAndArchive ($param);
        $this->openNewBilan ();
        $param = [['prep'=>':formeBanquaire', 'variable'=>1],
        ['prep'=>':montant', 'variable'=>round($solde[2], 2)],
        ['prep'=>':balance', 'variable'=>$balance],
        ['prep'=>':numeroTransaction', 'variable'=>'report bilan'],
        ['prep'=>':objet', 'variable'=>'Report bilan année précédente'],
        ['prep'=>':idUser', 'variable'=>$idUser]];
        $this->addAccountingActe ($param);
        return true;
    }
   
}
