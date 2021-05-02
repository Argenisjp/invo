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
    public $tipodocumento;

    /**
     * @var integer
     */
    public $documento;

      /**
     * @var datetime
     */
    public $fechaafiliacion;

      /**
     * @var integer
     */
    public $tipocontrato;
      /**
     * @var integer
     */
    public $status;

    

        // Lista de tipos de documento
        public function getDatosProveedores(){
          $sql = "SELECT c.*, tc.nombre as tipocontrato, td.nombre as tipodocumento FROM proveedores c JOIN tipocontrato as tc ON tc.tipocontratoid = c.tipocontratoid JOIN tipodocumento as td ON td.tipodocumentoid = c.tipodocumentoid";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

        // Consulta para crear un proveedor por medio del procedimiento almacenado
        public function createProveedor($nombre,$apellido,$tipodocumento,$documento,$tipocontratoid,$status){
          $sql = "call crear_proveedor('$nombre', '$apellido', '$tipodocumento', '$documento','$tipocontratoid','$status');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }
        // Consulta para actualizar un proveedor por medio del procedimiento almacenado
        public function actualizarProveedor($proveedorid,$nombre,$apellido,$tipodocumentoid,$documento,$tipocontratoid,$status){
          $sql = "call actualizar_proveedor('$proveedorid','$nombre', '$apellido', '$tipodocumentoid', '$documento','$tipocontratoid','$status');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

       // Consulta para inactivar un proveedor por medio del procedimiento almacenado
       public function inactivarProveedor($proveedorid){
        $sql = "call inactivar_proveedor('$proveedorid');";
        $prepare = $this->getDi()->getShared("db")->prepare($sql);
        $prepare->execute();
        return $prepare;
    }
}
