<?php

use Phalcon\Mvc\Model;

class Tipocontrato extends Model
{
    /**
     * @var integer
     */
    public $tipocontratoid ;

    /**
     * @var string
     */
    public $nombre;

    // Lista de tipos de contrato

    public function getTipocontrato(){
        $sql = "SELECT * FROM tipocontrato";
        $prepare = $this->getDi()->getShared("db")->prepare($sql);
        $prepare->execute();
        return $prepare;
    }
}
