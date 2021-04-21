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

class ProveedoresForm extends Form
{
    /**
     * Initialize the Proveedores form
     */
    public function initialize($entity = null, $options = null)
    {
        if (!isset($options['edit'])) {
            $element = new Text("proveedorid");

            $this->add(
                $element->setLabel("proveedorid ")
            );
        } else {
            $this->add(
                new Hidden("proveedorid ")
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





       
        
        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getTipodocumento();        

        foreach ($tipodocumentoSql as $list) {
            
            $data = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }
        
         
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
      

        
        $fechaafiliacion = new Date("fechaafiliacion");

        $fechaafiliacion->setLabel("Fecha de afiliacion");

        $fechaafiliacion->setFilters(
            [
                'striptags',
                'date',
            ]
        );

        $fechaafiliacion->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'fecha de afiliacion is required',
                    ]
                ),
            ]
        );

        $this->add($fechaafiliacion);

      
          
        $Datotipocontrato = new Tipocontrato;
        $tipocontratoSql = $Datotipocontrato->getTipocontrato();        

        foreach ($tipocontratoSql as $list) {
            
            $data = [
                "id"        =>  $list['tipocontratoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }
        
       /*  print_r($data);die; */
        $tipocontrato =  new Select(
            'tipocontrato',
            $data,
           
        );
      

        $tipocontrato->setLabel("tipocontrato");

        $tipocontrato->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $tipocontrato->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'El campo tipo de contrato es requerido',
                    ]
                ),
            ]
        );

        $this->add($tipocontrato);

        $status =  new Select(
            'status',
            [
                '1' => 'Activo',
                '2' => 'Inactivo',
            ]
            );
      

        $status->setLabel("Status");

        $status->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $status->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'status is required',
                    ]
                ),
            ]
        );

        $this->add($status);
    
    }


}