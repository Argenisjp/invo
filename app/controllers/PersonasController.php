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
     * Muestra la acción del índice.
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
     * Buscar personas según los criterios actuales
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
     * Muestra el formulario para crear nuevas personas.
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
     * Editar  personas basado en su id
     * @param string $id
     * 
     */
    public function editAction($personasid)
    {

        

        if (!$this->request->isPost()) {
            $personas = personas::findFirst([
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
            
            $this->view->datapersonas = $personas;
        }
    }

    /**
     * 
     * Crea nuevas personas
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

        $personas = new Personas();
        $data = $this->request->getPost();            
                
        $createdSql = $personas->createPersona($data['nombre'], $data['apellido'], $data['fechanacimiento'], $data['edad'], $data['salario'], $data['status']);
        $response = $createdSql->fetch(PDO::FETCH_ASSOC);
        $createdSql->closeCursor(); // Cerrar procedimiento almacenado

        
        if($response['code'] == 200){
     

           // $form->clear();

            $this->flash->success("persona Creado con exito");
    
            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );

        }else{
            print_r('no registro');die;
        }
      
    }

    /**
     * Guarda las personas actuales en la pantalla
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
            $this->flash->error("Personas no exist");

            return $this->dispatcher->forward(
                [
                    "controller" => "personas",
                    "action"     => "index",
                ]
            );
        }

      
        $form = new PersonasForm;
        $data = $this->request->getPost();  
        
        $updateSql = $personas->actualizarPersona($data['personasid'],$data['nombre'], $data['apellido'], $data['fechanacimiento'], $data['edad'], $data['salario'], $data['status']);
        $response = $updateSql->fetch(PDO::FETCH_ASSOC);
        $updateSql->closeCursor(); // Cerrar procedimiento almacenado
 
       // $form = new ProveedoresForm;

       
        
        if($response['code'] == 200){

            $form->clear();
    
            $this->flash->success("Persona actualizado con exito");
    
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

         //llamamos al modelo personas
         $personas = new Personas();
         $data = $this->request->getPost();  
         $deleteSql = $personas->inactivarPersona($personasid);
         $response = $deleteSql->fetch(PDO::FETCH_ASSOC);
         $deleteSql->closeCursor(); // Cerrar procedimiento almacenado
       
     
            
        

        $this->flash->success("Persona Inactivada con Exito");

        return $this->dispatcher->forward(
            [
                "controller" => "personas",
                "action"     => "index",
            ]
        );
    }
}
