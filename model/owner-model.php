<?php
class Owner{
    private $identity = "Owner";
    private $Connection;

    private $o_id;
    private $name;
    private $email;
    private $pwd;
    private $mobile_no;
    private $occupation;
    private $no_of_houses;
    private $country;
    private $state;
    private $city;
    private $address;
    
    public function __construct($Connection){
        $this->Connection = $Connection;
    }

    public function getIdentity(){
		return $this->identity;
	}

	public function setIdentity($identity){
		$this->identity = $identity;
	}

	public function getO_id(){
		return $this->o_id;
	}

	public function setO_id($o_id){
		$this->o_id = $o_id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
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

	public function getNo_of_houses(){
		return $this->no_of_houses;
	}

	public function setNo_of_houses($no_of_houses){
		$this->no_of_houses = $no_of_houses;
	}

	public function getCountry(){
		return $this->country;
	}

	public function setCountry($country){
		$this->country = $country;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getCity(){
		return $this->city;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setAddress($address){
		$this->address = $address;
	}

    public function save(){
        $consultation = $this->Connection->prepare(
            "INSERT INTO ".$this->identity
            ."(name, email, pwd, mobile_no, occupation, no_of_houses, country, state, city, address)"
            ."VALUES(:name, :email, :pwd, :mobile_no, :occupation, :no_of_houses, :country, :state, :city, :address)");
            $result = $consultation->execute(array(
                "name"=>$this->name,
                "email"=>$this->email,
                "pwd"=>$this->pwd,
                "mobile_no"=>$this->mobile_no,
                "occupation"=>$this->occupation,
                "no_of_houses"=>$this->no_of_houses,
                "country"=>$this->country,
                "state"=>$this->state,
                "city"=>$this->city,
                "address"=>$this->address
            ));
            $this->Connection = null;
            return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->identity . " 
            SET 
                name = :name,
                email = :email,
                mobile_no = :mobile_no,
                occupation = :occupation,
                no_of_houses = :no_of_houses,
                country = :country,
                state = :state,
                city = :city,
                address = :address
            WHERE o_id = :o_id 
        ");

        $resultado = $consultation->execute(array(
            "o_id" => $this->o_id,
            "name"=>$this->name,
            "email"=>$this->email,
            "mobile_no"=>$this->mobile_no,
            "occupation"=>$this->occupation,
            "no_of_houses"=>$this->no_of_houses,
            "country"=>$this->country,
            "state"=>$this->state,
            "city"=>$this->city,
            "address"=>$this->address
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
    
    
    public function getById($o_id){
        $consultation = $this->Connection->prepare("SELECT * FROM " . $this->identity . "  WHERE o_id = :o_id");
        $consultation->execute(array(
            "o_id" => $o_id
        ));
        /*Fetch all of the remaining rows in the result set*/
        $result = $consultation->fetch();
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
            $consultation = $this->Connection->prepare("DELETE FROM " . $this->identity . " WHERE o_id = :o_id");
            $consultation->execute(array(
                "o_id" => $o_id
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