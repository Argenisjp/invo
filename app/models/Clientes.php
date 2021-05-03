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

       // Consulta para crear un cliento por medio del procedimiento almacenado
        public function createCliente($nombre,$apellido,$celular,$tipodocumento,$documento,$correo,$saldo,$status){
          $sql = "call crear_cliente('$nombre', '$apellido', '$celular', '$tipodocumento', '$documento', '$correo', '$saldo', '$status');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

       // Consulta para Actualizar un cliento por medio del procedimiento almacenado
        public function actualizarCliente($clienteid,$nombre,$apellido,$celular,$tipodocumento,$documento,$correo,$status){
          $sql = "call actualizar_cliente('$clienteid','$nombre', '$apellido', '$celular', '$tipodocumento', '$documento', '$correo', '$status');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }
       
      
      // Consulta para Eliminar un cliento por medio del procedimiento almacenado
        public function eliminarCliente($clienteid){
          $sql = "call eliminar_cliente('$clienteid');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

         // Consulta para inactivar un cliente por medio del procedimiento almacenado
         public function inactivarCliente($clienteid){
          $sql = "call inactivar_cliente('$clienteid');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

        // Consulta para recargar un cliento por medio del procedimiento almacenado
        public function recargarCliente($clienteid,$saldo){
          $sql = "call recargaCliente('$clienteid','$saldo');";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }

        // Lista de tipos de documento
        public function getDatosClientesActivos(){
          $sql = "SELECT clienteid, CONCAT(nombre,' ',apellido) as cliente FROM invo.clientes WHERE status = 1;";
          $prepare = $this->getDi()->getShared("db")->prepare($sql);
          $prepare->execute();
          return $prepare;
      }
}
