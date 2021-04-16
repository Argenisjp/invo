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
}
