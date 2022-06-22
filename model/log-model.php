<?php
class Log{
    private $table = "logs";
    private $Connection;

    private $id;
    private $ori_ide; //the identity of log creater
    private $tar_ide; // the identity of log receiver
    private $ori_id;
    private $tar_id;
    private $action;
    private $date;
    private $viewed;

    public function __construct($Connection){
        $this->Connection = $Connection;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getOri_ide(){
		return $this->ori_ide;
	}

	public function setOri_ide($ori_ide){
		$this->ori_ide = $ori_ide;
	}

	public function getTar_ide(){
		return $this->tar_ide;
	}

	public function setTar_ide($tar_ide){
		$this->tar_ide = $tar_ide;
	}

	public function getOri_id(){
		return $this->ori_id;
	}

	public function setOri_id($ori_id){
		$this->ori_id = $ori_id;
	}

	public function getTar_id(){
		return $this->tar_id;
	}

	public function setTar_id($tar_id){
		$this->tar_id = $tar_id;
	}

	public function getAction(){
		return $this->action;
	}

	public function setAction($action){
		$this->action = $action;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function getViewed(){
		return $this->viewed;
	}

	public function setViewed($viewed){
		$this->viewed = $viewed;
	}

    public function save(){
        $consultation = $this->Connection->prepare(
            "INSERT INTO ".$this->table
            ."(ori_ide, tar_ide, ori_id, tar_id, action, date, viewed)"
            ."VALUES(:ori_ide, :tar_ide, :ori_id, :tar_id, :action, :date, :viewed)");
            $result = $consultation->execute(array(
                "ori_ide"=>$this->ori_ide,
                "tar_ide"=>$this->tar_ide,
                "ori_id"=>$this->ori_id,
                "tar_id"=>$this->tar_id,
                "action"=>$this->action,
                "date"=>$this->date,
                "viewed"=>$this->viewed
            ));
            $this->Connection = null;
            return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                viewed = :viewed
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id"=>$this->id,
            "viewed"=>$this->viewed
        ));
        $this->Connection = null;

        return $resultado;
    }

    public function getAllFromReceiver(){

        $consultation = $this->Connection->prepare("SELECT * FROM ".$this->table." WHERE tar_ide=".$this->tar_ide." AND tar_id=".$this->tar_id." AND viewed=0");
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
        $result = $consultation->fetch();
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