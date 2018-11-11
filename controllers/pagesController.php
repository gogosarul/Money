<?php 

class pagesController extends AppController
{
    public function __construct(){
		parent::__construct();
	}

	public function index(){
		$pages = $this->loadmodel("pages");
        
        $cuentas = $this->loadmodel("cuenta");
		$this->_view->cuentas = $cuentas->getCuentas();
        
		$this->_view->titulo = "Vista principal";
		$this->_view->renderizar("index");
	}
    
    public function indexcuenta($id){
        $pagess = $this->loadmodel("pages");
        $this->_view->pagess = $pagess->getcuentaTransaccion($id);
        
        $this->_view->titulo = "Transaccion de Cuenta";
		$this->_view->renderizar("indexcuenta");
    }
    
    /*public function Balance(){
        $suma=0;
                    <?php foreach ($this->pagess as $pag): $suma+=$pag["transactions"]["amount"];?>
                    <?php endforeach; ?>
    }*/
}

