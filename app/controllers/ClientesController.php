<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class clientesController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your clientes');

        parent::initialize();
    }

    /**
     * Shows the index action
     */
    public function indexAction()
    {
        $this->session->conditions = null;

        $this->view->form = new clientesForm;

        $clientes = clientes::find();

        if (count($clientes) == 0) {
            $this->flash->notice("No hay datos");
        }

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                "Clientes",
                $this->request->getPost()
            );

            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $paginator = new Paginator(
            [
                "data"  => $clientes,
                "limit" => 10,
                "page"  => $numberPage,
            ]
        );

        $this->view->page = $paginator->getPaginate();
        $this->view->clientes = $clientes;
    }

    /**
     * Search clientes based on current criteria
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                "Clientes",
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

        $clientes = Clientes::find($parameters);
        if (count($clientes) == 0) {
            $this->flash->notice("The search did not find any clientes");

            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(
            [
                "data"  => $clientes,
                "limit" => 10,
                "page"  => $numberPage,
            ]
        );

        $this->view->page = $paginator->getPaginate();
        $this->view->clientes = $clientes;
    }

    /**
     * Shows the form to create a new clientes
     */
    public function newAction()
    {
        $this->view->form = new ClientesForm(
            null,
            [
                'edit' => true,
            ]
        );
    }

    /**
     * Editar  clientes based on its id
     * @param string $id
     * 
     */
    public function editAction($clienteid)
    {

        

        if (!$this->request->isPost()) {
            $clientes = clientes::findFirst([
                "clienteid = :id:" ,
                'bind' => ['id' => $clienteid]
            ]);

            if (!$clientes) {
                $this->flash->error("Error para editar");

                return $this->dispatcher->forward(
                    [
                        "controller" => "clientes",
                        "action"     => "index",
                    ]
                );
            }

            $this->view->form = new ClientesForm(
                $clientes,
                [
                    'edit' => true,
                ]
            );
        }
    }

    /**
     * Accion para Crear un nuevo cliente
     */
    public function createAction()
    {
      
       
        if (!$this->request->isPost()) {
           
            
            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );
        }

        $form = new ClientesForm;
        $clientes = new Clientes();
        $data = $this->request->getPost();
/* 
        print_r($data);die; */
        
        
        $clientes->nombre = $data['nombre'];
        $clientes->apellido = $data['apellido'];
        $clientes->celular = $data['celular'];
        $clientes->tipodocumento = $data['tipodocumento'];
        $clientes->documento = $data['documento'];
        $clientes->correo = $data['correo'];
       
        if($clientes->save()){
            

            $form->clear();
    
            $this->flash->success("cliente Creado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );

        }
      
    }

    /**
     * Saves current clientes in screen
     *
     * @param string $clienteid
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "clienteid = :id:" ,
                    'bind' => ['id' => $clienteid]
                ]
            );
        }

        $id = $this->request->getPost("clienteid", "int");
        
        //verificar si el id de la cliente existe
        $clientes =  Clientes::findFirst([
            "conditions" => "clienteid = ?1",
            "bind" => array(1 =>  $id)
        ]); 
                
        if (!$clientes) {
            $this->flash->error("clientes does not exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );
        }

        $form = new ClientesForm;

        $data = $this->request->getPost();        
        
        $clientes->nombre = $data['nombre'];
        $clientes->apellido = $data['apellido'];
        $clientes->celular = $data['celular'];
        $clientes->tipodocumento = $data['tipodocumento'];
        $clientes->documento = $data['documento'];
        $clientes->correo = $data['correo'];
        
        if($clientes->save()){

            $form->clear();
    
            $this->flash->success("cliente actualizado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );

        }

    }

    /**
     * Eliminar clientes
     *
     * @param string $id
     */
    public function deleteAction($clienteid)
    {
        $clientes = clientes::findFirst([
            "clienteid = :id:" ,
            'bind' => ['id' => $clienteid]
        ]);       

        if (!$clientes) {
            $this->flash->error("Error al tratar eliminar a esta persona ");

            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "index",
                ]
            );
        }

        if (!$clientes->delete()) {
            foreach ($clientes->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "clientes",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("cliente Eliminado  con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "clientes",
                "action"     => "index",
            ]
        );
    }
}
