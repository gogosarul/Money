<?php

class pagesModel extends AppModel{
    
    public function __construct(){
        parent::__construct();
    }
    

     public function getcuentaTransaccion($id){
        $transacciones = $this->_db->prepare("SELECT * FROM transactions 
        INNER JOIN categories ON transactions.category_id=categories.id 
        INNER JOIN accounts ON transactions.account_id=accounts.id
        WHERE account_id=:id");
        $transacciones->bindParam(":id",$id);
        $transacciones->execute();
         
        foreach(range(0, $transacciones->columnCount()-1) as $column_index){
            $meta[] = $transacciones->getColumnMeta($column_index);
        }
         
        $resultado = $transacciones->fetchAll(PDO::FETCH_NUM);
         if($resultado){
                for($i=0; $i < count($resultado); $i++){
                $j=0;
                    
                foreach($meta as $value){
                    $rows[$i][$value["table"]][$value["name"]] = $resultado[$i][$j];
                    $j++;
                }
            }

            return $rows;
         }else {
             return false;
         }
        
    }
    
     public function guardar($datos = array()){
		$consulta = $this->_db->prepare(
			"INSERT INTO transactions 
			 (description, date, amount,category_id, account_id)
			 VALUES
			 (:description, :date, :amount, :category_id, :account_id)"
		);
		
		$consulta->bindParam(":description" , $datos["description"]);
		$consulta->bindParam(":date" , $datos["date"]);
		$consulta->bindParam(":amount" , $datos["amount"]);
		$consulta->bindParam(":category_id" , $datos["category_id"]);
        $consulta->bindParam(":account_id" , $datos["account_id"]);

		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}

	}
    
    public function actualizar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"UPDATE transactions SET
				 description=:descripcion,
				 date=:fecha,
				 amount=:monto,
				 category_id=:categoria_id,
				 account_id=:cuenta_id
				 WHERE id=:id"
			);


			$consulta->bindParam(":id",$datos["id"]);
			$consulta->bindParam(":descripcion",$datos["description"]);
			$consulta->bindParam(":fecha",$datos["date"]);
			$consulta->bindParam(":monto",$datos["amount"]);
			$consulta->bindParam(":categoria_id",$datos["category_id"]);
            $consulta->bindParam(":cuenta_id",$datos["account_id"]);
        
			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
    
    public function buscarPorId($id){
        $transaccion = $this->_db->prepare("SELECT * FROM transactions WHERE id=:id");
        $transaccion->bindParam(":id",$id);
        $transaccion->execute();
        $registro = $transaccion->fetch();
        
        if($registro){
            return $registro;
        }  else{
            return false;
        }
    }

    public function eliminarPorId($id){
		$consulta = $this->_db->prepare("DELETE from transactions WHERE id=:id");
		$consulta->bindParam(":id",$id);
		if ($consulta->execute()) {
			return true;
		}else{
			return false;
		}
	}
   
}