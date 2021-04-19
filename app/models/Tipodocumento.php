<?php

use Phalcon\Mvc\Model;

class Tipodocumento extends Model
{
    /**
     * @var integer
     */
    public $tipodocumentoid ;

    /**
     * @var string
     */
    public $nombre;

    // Lista de tipos de documento

    public function getTipodocumento(){
        $sql = "SELECT * FROM tipodocumento";
        $prepare = $this->getDi()->getShared("db")->prepare($sql);
        $prepare->execute();
        return $prepare;
    }
}
