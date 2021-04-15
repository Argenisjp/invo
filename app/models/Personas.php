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
}
