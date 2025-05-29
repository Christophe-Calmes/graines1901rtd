<?php
class SQLaccounting 
{
    protected $typeBankTransaction;
    protected $annualCotisation;

    public function __construct () {
        $this->typeBankTransaction = [['type'=>'liquide'], ['type'=>'Virement'], ['type'=>'chéque']];
        $this->annualCotisation = 25;
    }
}
