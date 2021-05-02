<?php

use Phalcon\Mvc\Model;

class Personas extends Model
{
    /**
     * @var integer
     */
    public $personasid;

    /**
     * @var string
     */
    public $nombres;

    /**
     * @var string
     */
    public $apellido;

    /**
     * @var date
     */
    public $fechaNacimiento;

    /**
     * @var string
     */
    public $edad;

      /**
     * @var datetime
     */
    public $fechaRegistro;

      /**
     * @var integer
     */
    public $estatus;



      // Consulta para crear un Persona por medio del procedimiento almacenado
   public function createPersona($nombre,$apellido,$fachanacimiento,$edad,$salario,$status){
    $sql = "call crear_persona('$nombre', '$apellido', '$fachanacimiento', '$edad','$salario','$status');";
    $prepare = $this->getDi()->getShared("db")->prepare($sql);
    $prepare->execute();
    return $prepare;

  }

   // Consulta para actualizar un Persona por medio del procedimiento almacenado
   public function actualizarPersona($personasid,$nombre,$apellido,$fachanacimiento,$edad,$salario,$status){
    $sql = "call actualizar_persona('$personasid','$nombre', '$apellido', '$fachanacimiento', '$edad','$salario','$status');";
    $prepare = $this->getDi()->getShared("db")->prepare($sql);
    $prepare->execute();
    return $prepare;
}

  // Consulta para Eliminar un persona por medio del procedimiento almacenado
  public function inactivarPersona($personasid){
    $sql = "call inactivar_persona('$personasid');";
    $prepare = $this->getDi()->getShared("db")->prepare($sql);
    $prepare->execute();
    return $prepare;
}


}

