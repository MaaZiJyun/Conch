<?php
class Booking{
    private $table = "booking";
    private $Connection;

    private $id;
    private $o_id;
    private $t_id;
    private $h_id;
    private $price;
    private $duration;
    private $status;

    public function __construct($Connection){
        $this->Connection = $Connection;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getO_id(){
		return $this->o_id;
	}

	public function setO_id($o_id){
		$this->o_id = $o_id;
	}

	public function getT_id(){
		return $this->t_id;
	}

	public function setT_id($t_id){
		$this->t_id = $t_id;
	}

	public function getH_id(){
		return $this->h_id;
	}

	public function setH_id($h_id){
		$this->h_id = $h_id;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getDuration(){
		return $this->duration;
	}

	public function setDuration($duration){
		$this->duration = $duration;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}

    public function save(){
        echo '<script> alert("'.$this->duration.'");</script>';
        $consultation = $this->Connection->prepare(
            "INSERT INTO ".$this->table
            ."(o_id, t_id, h_id, price, duration, status)"
            ."VALUES(:o_id, :t_id, :h_id, :price, :duration, :status)");
            $result = $consultation->execute(array(
                "o_id"=>$this->o_id,
                "t_id"=>$this->t_id,
                "h_id"=>$this->h_id,
                "price"=>$this->price,
                "duration"=>$this->duration,
                "status"=>$this->status
            ));
            $this->Connection = null;
            return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                status = :status
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "status"=>$this->status
        ));
        $this->Connection = null;

        return $resultado;
    }

    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT * FROM ".$this->table);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;

    }
    
    
    public function getById($id){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->table . "  WHERE id = :id");
        $consultation->execute(array(
            "id" => $id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $result = $consultation->fetchObject();
        $this->Connection = null; //connection closure
        return $result;
    }

    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->table . " WHERE :column = :value");
        $consultation->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //connection closure
        return $resultados;
    }
    
    public function deleteById($id){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
            $consultation->execute(array(
                "id" => $id
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
    
    public function deleteBy($column,$value){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->table . " WHERE :column = :value");
            $consultation->execute(array(
                "column" => $value,
                "value" => $value,
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteBy): ' . $e->getMessage();
            return -1;
        }
    }
}