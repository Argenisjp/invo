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
     * Muestra la acción del índice.
     */
    public function indexAction()
    {
        //llamamos al modelo he imprimimos los datos de la consulta
        $Datosclientes = new Clientes;
        $DatosclientesSql = $Datosclientes->getDatosClientes();  

        foreach ($DatosclientesSql as $list) {
            
            $data[] = [
                "id"                  =>  $list['clienteid'],
                "nombre"              =>  $list['nombre'],
                "apellido"            =>  $list['apellido'],
                "celular"             =>  $list['celular'],
                "tipodocumento"     =>  $list['tipodocumento'],
                "documento"           =>  $list['documento'],
                "correo"              =>  $list['correo'],
            ];

        }

        $data = json_encode($data);
        $this->view->clientes = json_decode($data);
       
    }

    /**
     * Buscar clientes según los criterios actuales
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
     * Muestra el formulario para crear nuevos clientes.
     */
    public function newAction()
    {

        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getTipodocumento();        

        foreach ($tipodocumentoSql as $list) {
            
            $data[] = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }

        $data = json_encode($data);
        $this->view->tipodocumento = json_decode($data);
        
        $this->view->form = new ClientesForm(
            null,
            [
                'edit' => true,
            ]
        );
    }

    /**
     * Editar  clientes basado en su id
     * @param string $id
     * 
     */
    public function editAction($clienteid)
    {
        
        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getTipodocumento();        

        foreach ($tipodocumentoSql as $list) {
            
            $data[] = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }

        $data = json_encode($data);
        $this->view->tipodocumento = json_decode($data);
        

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
            
            $this->view->dataclientes = $clientes;
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
        
        $clientes->nombre = $data['nombre'];
        $clientes->apellido = $data['apellido'];
        $clientes->celular = $data['celular'];
        $clientes->tipodocumentoid = $data['tipodocumento'];
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
     * Guarda a los clientes actuales en la pantalla
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
            $this->flash->error("clientes no existe");

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
        $clientes->tipodocumentoid = $data['tipodocumento'];
        $clientes->documento = $data['documento'];
        $clientes->correo = $data['correo'];
        
        if($clientes->save()){

            $form->clear();
    
            $this->flash->success("Cliente actualizado con exito");
    
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

        $this->flash->success("Cliente Eliminado  con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "clientes",
                "action"     => "index",
            ]
        );
    }
}
