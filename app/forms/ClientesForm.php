<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\DateTime;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class ClientesForm extends Form
{
    /**
     * Initialize the Clientes form
     */
    public function initialize($entity = null, $options = null)
    {
        if (!isset($options['edit'])) {
            $element = new Text("clienteid");

            $this->add(
                $element->setLabel("clienteid ")
            );
        } else {
            $this->add(
                new Hidden("clienteid ")
            );
        }

        $nombre = new Text("nombre");

        $nombre->setLabel("Nombre");

        $nombre->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $nombre->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El Nomobre es requerido',
                    ]
                ),
            ]
        );

        $this->add($nombre);



        $apellido = new Text("apellido");

        $apellido->setLabel("Apellido");

        $apellido->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $apellido->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'Apellido es requerido',
                    ]
                ),
            ]
        );

        $this->add($apellido);



  /*       $fechanacimiento = new Date("fechanacimiento");

        $fechanacimiento->setLabel("Fecha de nacimiento");

        $fechanacimiento->setFilters(
            [
                'striptags',
                'date',
            ]
        );

        $fechanacimiento->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'fechanacimiento is required',
                    ]
                ),
            ]
        );

        $this->add($fechanacimiento);
 */


        $celular = new Numeric("celular");

        $celular->setLabel("Celular");

        $celular->setFilters(
            [
                'striptags',
                'numeric',
            ]
        );

        $celular->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El campo Celular es requerido',
                    ]
                ),
            ]
        );

        $this->add($celular);
        
        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getTipodocumento();        

        foreach ($tipodocumentoSql as $list) {
            
            $data = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }
        
               //print_r($data);die;   
        $tipodocumento =  new Select(
            'tipodocumento',
            $data,
           
        );
      

        $tipodocumento->setLabel("tipodocumento");

        $tipodocumento->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $tipodocumento->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El campo tipo de documento es requerido',
                    ]
                ),
            ]
        );

        $this->add($tipodocumento);

        
        $documento = new Numeric("documento");

        $documento->setLabel("N° de documento");

        $documento->setFilters(
            [
                'striptags',
                'numeric',
            ]
        );

        $documento->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El campo documento es requerido',
                    ]
                ),
            ]
        );

        $this->add($documento);
      
      
        $correo = new Text("correo");

        $correo->setLabel("Correo Electronico");

        $correo->setFilters(
            [
                'striptags',
                'email',
            ]
        );

        $correo->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El campo correo es requerido',
                    ]
                ),
            ]
        );

        $this->add($correo);
    }
}
