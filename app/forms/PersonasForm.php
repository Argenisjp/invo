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

class PersonasForm extends Form
{
    /**
     * Initialize the personas form
     */
    public function initialize($entity = null, $options = null)
    {
        if (!isset($options['edit'])) {
            $element = new Text("personasid");

            $this->add(
                $element->setLabel("personasid")
            );
        } else {
            $this->add(
                new Hidden("personasid")
            );
        }

        $nombres = new Text("nombres");

        $nombres->setLabel("Nombres");

        $nombres->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $nombres->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'nombres is required',
                    ]
                ),
            ]
        );

        $this->add($nombres);



        $apellidos = new Text("apellidos");

        $apellidos->setLabel("Apellidos");

        $apellidos->setFilters(
            [
                'striptags',
                'string',
            ]
        );

        $apellidos->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'apellidos is required',
                    ]
                ),
            ]
        );

        $this->add($apellidos);



        $fechanacimiento = new Date("fechanacimiento");

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



        $edad = new Numeric("edad");

        $edad->setLabel("Edad");

        $edad->setFilters(
            [
                'striptags',
                'numeric',
            ]
        );

        $edad->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'edad is required',
                    ]
                ),
            ]
        );

        $this->add($edad);


        $salario = new Numeric("salario");

        $salario->setLabel("Salario");

        $salario->setFilters(
            [
                'striptags',
                'numeric',
            ]
        );

        $salario->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => 'salario is required',
                    ]
                ),
            ]
        );

        $this->add($salario);

        
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
