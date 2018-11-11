<?php

class cuentasController extends AppController
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$cuentas = $this->loadmodel("cuenta");
		$this->_view->cuentas = $cuentas->getCuentas();

		$this->_view->titulo = "Listado de cuentas";
		$this->_view->renderizar("index");
	}
    
    public function agregar(){

		if ($_POST) {
			$cuentas = $this->loadmodel("cuenta");
			$this->_view->cuentas = $cuentas->guardar($_POST);
            $this->redirect(array("controller"=>"cuentas"));
		}

		$this->_view->titulo = "Agregar cuenta";
		$this->_view->renderizar("agregar");
	}
    
    public function editar($id=null){
        if($_POST){
            $cuentas = $this->loadmodel("cuenta");
            
            if ($cuentas->actualizar($_POST)) {
                $this->_view->flashMessage = "Datos guardados correctamente...";
                $this->redirect(array("controller"=>"cuentas"));
            }else{
                $this->_view->flashMessage = "Error al guardar los datos...";

                $this->redirect(array("controller"=>"cuentas", "action"=>"/editar/".$id));
            }     
        }
        $cuentas = $this->loadmodel("cuenta");
        $this->_view->cuenta = $cuentas->buscarPorId($id);
        
        $this->_view->titulo = "Editar cuenta";
		$this->_view->renderizar("editar");
        
    }
    
    public function eliminar($id){
    	$cuenta = $this->loadmodel("cuenta");
    	$registro = $cuenta->buscarPorId($id);

    	if (!empty($registro)) {
    		$cuenta->eliminarPorId($id);
    		$this->redirect(array("controller"=>"cuentas"));
    	}
    }
}

