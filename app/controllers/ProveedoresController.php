<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class proveedorController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Manage your proveedor');

        parent::initialize();
    }

    /**
     * Muestra la acción del índice.
     */
    public function indexAction()
    {
        //llamamos al modelo he imprimimos los datos de la consulta
        $Datosproveedores = new Proveedores;
        $DatosproveedoresSql = $Datosproveedores->getDatosProveedor();  

        foreach ($DatosproveedoresSql as $list) {
            
            $data[] = [
                "id"                  =>  $list['proveedorid'],
                "nombre"              =>  $list['nombre'],
                "apellido"            =>  $list['apellido'],
                "tipodocumento"       =>  $list['tipodocumento'],
                "fechaafiliacion"     =>  $list['fechaafiliacion'],
                "tipocontrato"        =>  $list['tipocontrato'],
                "status"              =>  $list['status'],
            ];

        }

        $data = json_encode($data);
        $this->view->proveedores = json_decode($data);
       
    }

    /**
     * Buscar Proveedor según los criterios actuales
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput(
                $this->di,
                "Proveedores",
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

        $proveedores = Proveedores::find($parameters);
        if (count($proveedores) == 0) {
            $this->flash->notice("The search did not find any proveedores");

            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );
        }

        $paginator = new Paginator(
            [
                "data"  => $proveedores,
                "limit" => 10,
                "page"  => $numberPage,
            ]
        );

        $this->view->page = $paginator->getPaginate();
        $this->view->proveedores = $proveedores;
    }

    /**
     * Muestra el formulario para crear nuevos proveedores.
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
        
        $this->view->form = new ProveedoresForm(
            null,
            [
                'edit' => true,
            ]
        );
    }

    /**
     * Editar  proveedores basado en su id
     * @param string $id
     * 
     */
    public function editAction($proveedorid)
    {
        
        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getDatosProveedores();        

        foreach ($tipodocumentoSql as $list) {
            
            $data[] = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }

        $data = json_encode($data);
        $this->view->tipodocumento = json_decode($data);
        

        if (!$this->request->isPost()) {
            $proveedores = Proveedores::findFirst([
                "proveedorid = :id:" ,
                'bind' => ['id' => $proveedorid]
            ]);

            

            if (!$proveedores) {
                $this->flash->error("Error para editar");

                return $this->dispatcher->forward(
                    [
                        "controller" => "proveedores",
                        "action"     => "index",
                    ]
                );
            }
            
            $this->view->dataproveedores = $proveedores;
        }
    }

    /**
     * Accion para Crear un nuevo proveedor
     */
    public function createAction()
    {
      
       
        if (!$this->request->isPost()) {
           
            
            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProvedoresForm;
        $proveedores = new Proveedores();
        $data = $this->request->getPost();            
        
        $proveedores->nombre            = $data['nombre'];
        $proveedores->apellido          = $data['apellido'];
        $proveedores->tipodocumentoid   = $data['tipodocumento'];
        $proveedores->documento         = $data['documento'];
        $proveedores->fechaafiliacion   = $data['fechaafiliacion'];
        $proveedores->tipocontrato      = $data['tipocontrato'];
        $proveedores->status            = $data['status'];
        
        if($proveedores->save()){
     

            $form->clear();
    
            $this->flash->success("proveedor Creado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );

        }
      
    }

    /**
     * Guarda a los proveedores actuales en la pantalla
     *
     * @param string $proveedorid
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(
                [
                    "proveedorid = :id:" ,
                    'bind' => ['id' => $proveedorid]
                ]
            );
        }

        $id = $this->request->getPost("proveedorid", "int");
        
        //verificar si el id de la cliente existe
        $proveedores =  Proveedores::findFirst([
            "conditions" => "proveedorid = ?1",
            "bind" => array(1 =>  $id)
        ]); 
                
        if (!$proveedores) {
            $this->flash->error("proveedores no existe");

            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );
        }

        $form = new ProveedoresForm;

        $data = $this->request->getPost();        
        
        $proveedores->nombre            = $data['nombre'];
        $proveedores->apellido          = $data['apellido'];
        $proveedores->tipodocumentoid   = $data['tipodocumento'];
        $proveedores->documento         = $data['documento'];
        $proveedores->fechaafiliacion   = $data['fechaafiliacion'];
        $proveedores->tipocontrato      = $data['tipocontrato'];
        $proveedores->status            = $data['status'];
        
        if($proveedores->save()){

            $form->clear();
    
            $this->flash->success("Proveedores actualizado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );

        }

    }

    /**
     * Eliminar proveedores
     *
     * @param string $id
     */
    public function deleteAction($provedorid)
    {
        $proveedores = proveedores::findFirst([
            "provedorid = :id:" ,
            'bind' => ['id' => $provedorid]
        ]);       

        if (!$proveedores) {
            $this->flash->error("Error al tratar eliminar a este proveedor ");

            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );
        }

        if (!$proveedores->delete()) {
            foreach ($proveedores->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "search",
                ]
            );
        }

        $this->flash->success("Proveedor Eliminado  con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "proveedores",
                "action"     => "index",
            ]
        );
    }
}
