<?php
class House{
    private $table = "houses";
    private $Connection;

    private $id;
    private $owner_id;
    private $no_of_rooms;
    private $rate;
    private $pics;
    private $country;
    private $state;
    private $city;
    private $address;
    private $description;

    public function __construct($Connection){
        $this->Connection = $Connection;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getOwner_id(){
		return $this->owner_id;
	}

	public function setOwner_id($owner_id){
		$this->owner_id = $owner_id;
	}

	public function getNo_of_rooms(){
		return $this->no_of_rooms;
	}

	public function setNo_of_rooms($no_of_rooms){
		$this->no_of_rooms = $no_of_rooms;
	}

	public function getRate(){
		return $this->rate;
	}

	public function setRate($rate){
		$this->rate = $rate;
	}

	public function getPics(){
		return $this->pics;
	}

	public function setPics($pics){
		$this->pics = $pics;
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

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}
    

    public function save(){
        
        $consultation = $this->Connection->prepare(
        "INSERT INTO ".$this->table
        ."(owner_id, no_of_rooms, rate, pics, country, state, city, address, description)"
        ."VALUES(:owner_id, :no_of_rooms, :rate, :pics, :country, :state, :city, :address, :description)");

        $result = $consultation->execute(array(
            "owner_id"=>$this->owner_id,
            "no_of_rooms"=>$this->no_of_rooms,
            "rate"=>$this->rate,
            "pics"=>$this->pics,
            "country"=>$this->country,
            "state"=>$this->state,
            "city"=>$this->city,
            "address"=>$this->address,
            "description"=>$this->description
        ));

        echo $result;

        $this->Connection = null;
        return $result;
    }

    public function update(){

        $consultation = $this->Connection->prepare("
            UPDATE " . $this->table . " 
            SET 
                no_of_rooms = :no_of_rooms,
                rate = :rate,
                pics = :pics,
                country = :country,
                state = :state,
                city = :city,
                address = :address,
                description = :description
            WHERE id = :id 
        ");

        $resultado = $consultation->execute(array(
            "id" => $this->id,
            "no_of_rooms"=>$this->no_of_rooms,
            "rate"=>$this->rate,
            "pics"=>$this->pics,
            "country"=>$this->country,
            "state"=>$this->state,
            "city"=>$this->city,
            "address"=>$this->address,
            "description"=>$this->description
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