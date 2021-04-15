<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PersonasController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your personas');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;

        $this->view->form = new PersonasForm;

        $personas = Personas::find();

        if (count($personas) == 0) {
            $this->flash->notice("No hay datos");
        }

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                "Personas",
                $this->request->getPost()
            );

            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $paginator = new Paginator(
            [
                "data"  => $personas,
                "limit" => 10,
                "page"  => $numberPage,
            ]
        );

        $this->view->page = $paginator->getPaginate();
        $this->view->personas = $personas;
    }

    /**
     * Search personas based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                "Personas",
                $this->request->getPost()
            );

            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $personas = Personas::find($parameters);
        if (count($personas) == 0) {
            $this->flash->notice("The search did not find any personas");

            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(
            [
                "data"  => $personas,
                "limit" => 10,
                "page"  => $numberPage,
            ]
        );

        $this->view->page = $paginator->getPaginate();
        $this->view->personas = $personas;
    }

    /**
     * Shows the form to create a new personas
     */
    public function newAction()
    {
        $this->view->form = new PersonasForm(
            null,
            [
                'edit' => true,
            ]
        );
    }

    /**
     * Editar  personas based on its id
     * @param string $id
     * 
     */
    public function editAction($personasid)
    {

        

        if (!$this->request->isPost()) {
            $personas = Personas::findFirst([
                "personasid = :id:" ,
                'bind' => ['id' => $personasid]
            ]);

            if (!$personas) {
                $this->flash->error("Error para editar");

                return $this->dispatcher->forward(
                    [
                        "controller" => "personas",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new PersonasForm(
                $personas,
                [
                    'edit' => true,
                ]
            );
        }
    }

    /**
     * Creates a new personas
     */
    public function createAction()
    {
      
        
        if (!$this->request->isPost()) {
           
            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );
        }

        $form = new PersonasForm;
        $personas = new Personas();

        $data = $this->request->getPost();
        
        $personas->nombres = $data['nombres'];
        $personas->apellidos = $data['apellidos'];
        $personas->fechanacimiento = $data['fechanacimiento'];
        $personas->edad = $data['edad'];
        $personas->salario = $data['salario'];
        $personas->status = $data['status'];
        
        if($personas->save()){

            $form->clear();
    
            $this->flash->success("personas Creada con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );

        }
      
    }

    /**
     * Saves current personas in screen
     *
     * @param string $personasid
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "personasid = :id:" ,
                    'bind' => ['id' => $personasid]
                ]
            );
        }

        $id = $this->request->getPost("personasid", "int");
        
        //verificar si el id de la persona existe
        $personas =  Personas::findFirst([
            "conditions" => "personasid = ?1",
            "bind" => array(1 =>  $id)
        ]); 
                
        if (!$personas) {
            $this->flash->error("Personas does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );
        }

        $form = new PersonasForm;

        $data = $this->request->getPost();        
        
        $personas->nombres = $data['nombres'];
        $personas->apellidos = $data['apellidos'];
        $personas->fechanacimiento = $data['fechanacimiento'];
        $personas->edad = $data['edad'];
        $personas->salario = $data['salario'];
        $personas->status = $data['status'];
        
        if($personas->save()){

            $form->clear();
    
            $this->flash->success("persona actualizada con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );

        }

    }

    /**
     * Eliminar personas
     *
     * @param string $id
     */
    public function deleteAction($personasid)
    {
        $personas = Personas::findFirst([
            "personasid = :id:" ,
            'bind' => ['id' => $personasid]
        ]);       

        if (!$personas) {
            $this->flash->error("Error al tratar eliminar a esta persona ");

            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );
        }

        if (!$personas->delete()) {
            foreach ($personas->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Personas Eliminada con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "personas",
                "action"     => "index",
            ]
        );
    }
}
