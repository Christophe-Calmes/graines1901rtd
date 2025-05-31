<?php
class SQLaccounting 
{
    protected $typeBankTransaction;
    protected $annualCotisation;

    public function __construct () {
        $this->typeBankTransaction = [['id'=>0, 'type'=>'Liquide'], ['id'=>1, 'type'=>'Virement'], ['id'=>2, 'type'=>'Chéque']];
        $this->annualCotisation = [['id'=>0, 'type'=>'Année compléte 25 €', 'price'=>25], ['id'=>0, 'type'=>'demi année 15 €', 'price'=>15]];
    }
    public function checkIndexTranscation ($id) {
        if (isset($this->typeBankTransaction[$id])) {
            return true;
        }
        return false;
    }
    public function checkIndexCotisation ($id) {
        if (isset($this->annualCotisation [$id])) {
            return true;
        }
        return false;
    }
    public function amount ($id) {
        return $this->annualCotisation[$id]['price'];
    }
    public function addActe ($param) {
        print_r($param);
        $insert = "INSERT INTO `compta`(  `formeBanquaire`,`montant`, `numeroTransaction`, `objet`,  `auteurActes` ) 
        VALUES (:formeBanquaire, :montant, :numeroTransaction,  :objet, :idUser)";
        return ActionDB::access($insert, $param, 2);
    }
}
