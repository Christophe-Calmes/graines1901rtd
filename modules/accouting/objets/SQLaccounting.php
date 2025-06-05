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
        print_r($param);
        $insert = "INSERT INTO `compta`(  `formeBanquaire`,`montant`, `numeroTransaction`, `objet`,  `auteurActes` ) 
        VALUES (:formeBanquaire, :montant, :numeroTransaction,  :objet, :idUser)";
        return ActionDB::access($insert, $param, 2);
    }
    protected function getActualAccouting ($date) {
        return true;
    }
    protected function getFamilyMembership () {
        $select = "SELECT `cotisation`, `nom`, `prenom`, `idUser`
                    FROM `membership` 
                    INNER JOIN `users` ON `idUser`=`id_users`
                    WHERE `cotisation` = 2;";
        return actionDB::select($select, [], 0);
    }
}
