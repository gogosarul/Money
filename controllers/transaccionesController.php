<?php

class transaccionesController extends AppController
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$transacciones = $this->loadmodel("transaccion");
		$this->_view->transacciones = $transacciones->getTransacciones();

		$this->_view->titulo = "Listado de transacciones";
		$this->_view->renderizar("index");
	}
    
    public function agregar(){

		if ($_POST) {
			$transacciones = $this->loadmodel("transaccion");
			$this->_view->transacciones = $transacciones->guardar($_POST);
            $this->redirect(array("controller"=>"transacciones"));
		}

		$categorias = $this->loadmodel("categoria");
		$this->_view->categorias = $categorias->getCategorias();
        
        $cuentas = $this->loadmodel("cuenta");
		$this->_view->cuentas = $cuentas->getCuentas();

		$this->_view->titulo = "Agregar transaccion";
		$this->_view->renderizar("agregar");
	}
    
    public function editar($id=null){
        if($_POST){
            $transacciones = $this->loadmodel("transaccion");
            
            if ($transacciones->actualizar($_POST)) {
                $this->_view->flashMessage = "Datos guardados correctamente...";
                $this->redirect(array("controller"=>"transacciones"));
            }else{
                $this->_view->flashMessage = "Error al guardar los datos...";

                $this->redirect(array("controller"=>"transacciones", "action"=>"/editar/".$id));
            }     
        }
        $transacciones = $this->loadmodel("transaccion");
        $this->_view->transaccion = $transacciones->buscarPorId($id);
        
        $categorias = $this->loadmodel("categoria");
		$this->_view->categorias = $categorias->getCategorias();
        
        $cuentas = $this->loadmodel("cuenta");
		$this->_view->cuentas = $cuentas->getCuentas();
        
        $this->_view->titulo = "Editar transaccion";
		$this->_view->renderizar("editar");
        
    }
    
    public function eliminar($id){
    	$transaccion = $this->loadmodel("transaccion");
    	$registro = $transaccion->buscarPorId($id);

    	if (!empty($registro)) {
    		$transaccion->eliminarPorId($id);
    		$this->redirect(array("controller"=>"transacciones"));
    	}
    }
    
    
}
