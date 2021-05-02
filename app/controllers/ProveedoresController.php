<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class proveedoresController extends ControllerBase
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
        $DatosproveedoresSql = $Datosproveedores->getDatosProveedores();  
         
        foreach ($DatosproveedoresSql as $list) {
          
            $data[] = [
                "id"                  =>  $list['proveedorid'],
                "nombre"              =>  $list['nombre'],
                "apellido"            =>  $list['apellido'],
                "tipodocumento"       =>  $list['tipodocumento'],
                "documento"           =>  $list['documento'],
                "fechaafiliacion"     =>  $list['fechaafiliacion'],
                "tipocontratoid"      =>  $list['tipocontrato'],
                "status"              =>  $list['status'],
            ];
           /*  print_r($data);die; */
        }
        
        $data = json_encode($data);
        $this->view->proveedores = json_decode($data);
       
       
    }

    /**
     * Buscar al Proveedor según los criterios actuales
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
        //consulta para traer los tipos de documentos desde base
        $Datotipodocumento = new Tipodocumento;
        $tipodocumentoSql = $Datotipodocumento->getTipodocumento();        

        //recorre con un foreach la consulta de tipo de documento
        foreach ($tipodocumentoSql as $list) {
            
            $datatipodocumento[] = [
                "id"        => $list['tipodocumentoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }

        //codificar la datatipodocumento que bota el foreach
        $datatipodocumento = json_encode($datatipodocumento);
        //decodificar la datatipodocumento que bota el foreach y enviar los datos a la vista con la variable tipodocumento
        $this->view->tipodocumento = json_decode($datatipodocumento);
        
        //consulta para traer los tipos de contratos desde base
        $Datotipocontrato = new Tipocontrato;
        $tipocontratoSql = $Datotipocontrato->getTipocontrato();        

        foreach ($tipocontratoSql as $list) {
            
            $datacontrato[] = [
                "id"        =>  $list['tipocontratoid'],
                "nombre"    =>  $list['nombre'],
            ];

        }

        $datacontrato = json_encode($datacontrato);
        $this->view->tipocontrato = json_decode($datacontrato);
        

        $this->view->form = new ProveedoresForm(
            null,
            [
                'edit' => true,
            ]
        );


      /*  
 */

     
    }

    /**
     * Editar  proveedores basado en su id
     * @param string $id
     * 
     */
    public function editAction($proveedorid)
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
     
     
        $Datotipocontrato = new Tipocontrato;        
        $tipocontratoSql = $Datotipocontrato->getTipocontrato();              
        foreach ($tipocontratoSql as $list) {
            
            $datatipocontrato[] = [
                "id"        => $list['tipocontratoid'],
                "nombre"    =>  $list['nombre'],
            ];
     

        }
      
        $datatipocontrato = json_encode($datatipocontrato);
        $this->view->tipocontrato = json_decode($datatipocontrato);

        if (!$this->request->isPost()) {
            $proveedores = proveedores::findFirst([
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

        $proveedores = new Proveedores();
        $data = $this->request->getPost();            
                
        $createdSql = $proveedores->createProveedor($data['nombre'], $data['apellido'], $data['tipodocumentoid'], $data['documento'], $data['tipocontratoid'], $data['status']);
        $response = $createdSql->fetch(PDO::FETCH_ASSOC);
        $createdSql->closeCursor(); // Cerrar procedimiento almacenado

        
        if($response['code'] == 200){
     

           // $form->clear();

            $this->flash->success("proveedor Creado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "proveedores",
                    "action"     => "index",
                ]
            );

        }else{
            print_r('no registro');die;
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
        
        //verificar si el id de la proveedor existe
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
        
        $updateSql = $proveedores->actualizarProveedor($data['proveedorid'],$data['nombre'], $data['apellido'], $data['tipodocumento'], $data['documento'], $data['tipocontrato'], $data['status']);
        $response = $updateSql->fetch(PDO::FETCH_ASSOC);
        $updateSql->closeCursor(); // Cerrar procedimiento almacenado
 
       // $form = new ProveedoresForm;

       
        
        if($response['code'] == 200){

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
    public function deleteAction($proveedorid)
    {

         //llamamos al modelo proveedores
         $proveedores = new proveedores();
         $data = $this->request->getPost();  
 
         $deleteSql = $proveedores->inactivarProveedor($proveedorid);
         $response = $deleteSql->fetch(PDO::FETCH_ASSOC);
         $deleteSql->closeCursor(); // Cerrar procedimiento almacenado

     
            
        

        $this->flash->success("Proveedor Inactivado  con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "proveedores",
                "action"     => "index",
            ]
        );
    }
}
