<?php

use Phalcon\Mvc\Model;

class Clientes extends Model
{
    /**
     * @var integer
     */
    public $clienteid ;

    /**
     * @var string
     */
    public $nombre;

    /**
     * @var string
     */
    public $apellido;

    /**
     * @var datetime
     */
    public $fecharegistro;

    /**
     * @var string
     */
    public $celular;

      /**
     * @var integer
     */
    public $tipodocumento;

      /**
     * @var integer
     */
    public $documento;
      /**
     * @var string
     */
    public $correo;

        // Lista de tipos de documento
        public function getDatosClientes(){
          $sql = "SELECT c.*, td.nombre tipodocumento FROM clientes c JOIN tipodocumento td ON td.tipodocumentoid = c.tipodocumentoid";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }
}
