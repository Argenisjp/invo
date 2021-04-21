<?php

use Phalcon\Mvc\Model;

class Proveedores extends Model
{
    /**
     * @var integer
     */
    public $proveedorid ;

    /**
     * @var string
     */
    public $nombre;

    /**
     * @var string
     */
    public $apellido;

    /**
     * @var integer
     */
    public $tipodocumentoid;

    /**
     * @var integer
     */
    public $documento;

      /**
     * @var datetime
     */
    public $fechaafiliacion;

      /**
     * @var string
     */
    public $tipocontrato;
      /**
     * @var string
     */
    public $status;

    

        // Lista de tipos de documento
        public function getDatosProveedores(){
          $sql = "SELECT c.*, td.nombre tipodocumento FROM proveedores  c JOIN tipodocumento td ON td.tipodocumentoid = c.tipodocumentoid";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }
}
