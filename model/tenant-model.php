<?php
class Tenant{
    private $identity = "Tenant";
    private $Connection;

    private $t_id;
    private $fname;
    private $name;
    private $email;
    private $pwd;
    private $mobile_no;
    private $occupation;
    
    public function __construct($Connection){
        $this->Connection = $Connection;
    }

    public function getIdentity(){
		return $this->identity;
	}

	public function setIdentity($identity){
		$this->identity = $identity;
	}

	public function getT_id(){
		return $this->t_id;
	}

	public function setT_id($t_id){
		$this->t_id = $t_id;
	}

	public function getFname(){
		return $this->fname;
	}

	public function setFname($fname){
		$this->fname = $fname;
	}

    public function getLname(){
		return $this->lname;
	}

	public function setLname($lname){
		$this->lname = $lname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPwd(){
		return $this->pwd;
	}

	public function setPwd($pwd){
		$this->pwd = $pwd;
	}

	public function getMobile_no(){
		return $this->mobile_no;
	}

	public function setMobile_no($mobile_no){
		$this->mobile_no = $mobile_no;
	}

	public function getOccupation(){
		return $this->occupation;
	}

	public function setOccupation($occupation){
		$this->occupation = $occupation;
	}

    public function save(){
        $consultation = $this->Connection->prepare(
            "INSERT INTO ".$this->identity
            ."(fname, lname, email, pwd, mobile_no, occupation)"
            ."VALUES(:fname, :lname, :email, :pwd, :mobile_no, :occupation)");
            $result = $consultation->execute(array(
                "fname"=>$this->fname,
                "lname"=>$this->fname,
                "email"=>$this->email,
                "pwd"=>$this->pwd,
                "mobile_no"=>$this->mobile_no,
                "occupation"=>$this->occupation
            ));
            $this->Connection = null;
            return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->identity . " 
            SET 
                fname = :fname,
                lname = :lname,
                email = :email,
                mobile_no = :mobile_no,
                occupation = :occupation
            WHERE t_id = :t_id 
        ");

        $resultado = $consultation->execute(array(
            "t_id" => $this->t_id,
            "fname"=>$this->fname,
            "lname"=>$this->fname,
            "email"=>$this->email,
            "mobile_no"=>$this->mobile_no,
            "occupation"=>$this->occupation
        ));
        $this->Connection = null;

        return $resultado;
    }

    public function getAll(){

        $consultation = $this->Connection->prepare("SELECT * FROM ".$this->identity);
        $consultation->execute();
        /* Fetch all of the remaining rows in the result set */
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //cierre de conexión
        return $resultados;

    }
    
    
    public function getById($t_id){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->identity . "  WHERE t_id = :t_id");
        $consultation->execute(array(
            "t_id" => $t_id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $result = $consultation->fetchObject();
        $this->Connection = null; //connection closure
        return $result;
    }

    public function getBy($column,$value){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->identity . " WHERE :column = :value");
        $consultation->execute(array(
            "column" => $column,
            "value" => $value
        ));
        $resultados = $consultation->fetchAll();
        $this->Connection = null; //connection closure
        return $resultados;
    }

    public function getAuth($email,$pwd){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->identity . " WHERE email = :email AND pwd = :pwd");
        $consultation->execute(array(
            "email" => $email,
            "pwd" => $pwd
        ));
        $result = $consultation->fetchAll();
        try {
            $single = $result[0];
            return $single;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function deleteById($id){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->identity . " WHERE t_id = :t_id");
            $consultation->execute(array(
                "t_id" => $t_id
            ));
            $Connection = null;
        } catch (Exception $e) {
            echo 'Failed DELETE (deleteById): ' . $e->getMessage();
            return -1;
        }
    }
    
    public function deleteBy($column,$value){
        try {
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->identity . " WHERE :column = :value");
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
?>