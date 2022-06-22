<?php
if (!session_id()) session_start();
class HouseController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  "../core/Conectar.php";
        require_once  "../model/house-model.php";
        
        $this->conectar=new Conectar();
        $this->Connection=$this->conectar->Connection();

    }

   /**
    * Switch the actions
    *
    */
    public function run($action){
        switch($action)
        { 
            case "index" :
                $this->index();
                break;
            case "register" :
                $this->register();
                break;
            case "detail" :
                $this->detail();
                break;
            case "delete" :
                $this->delete();
                break;
            default:
                $this->index();
                break;
        }
    }
    
   /**
    * Loads the Owners home page with the list of
    * Owners getting from the model.
    *
    */ 
    public function index(){
        
        //We create the Owner object
        $house=new House($this->Connection);
        
        //We get all the Owners
        $houses=$house->getAll();
       
        return $houses;
    }

    /**
    * Loads the Owners home page with the list of
     * Owners getting from the model.
    *
    */ 
    public function detail($id){
        
        //We load the model
        $model = new House($this->Connection);
        //We recover the Owner from the BBDD
        $house = $model->getById($id);
        //We load the detail view and pass values to it
        // $this->view("detail",array(
        //     "owner"=>$owner,
        //     "titulo" => "detail owner"
        // ));
        return $house;
    }
    
   /**
    * Create a new Owner from the POST parameters
     * and reload the index.php.
    *
    */
    public function register(){
        if(isset($_POST["submit"])) {
            echo $_FILES['pics']['name'];
            $name = $_FILES['pics']['name'];
            $target_dir = "../uploads/house-image";
            $target_file = $target_dir . basename($_FILES["pics"]["name"]);
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                // Upload file
                echo move_uploaded_file($_FILES['pics']['tmp_name'], $target_file);
            }
        }
        // echo '<script> alert("'.$_POST["description"].'");</script>';
            $house=new House($this->Connection);
            $house->setOwner_id($_POST["owner_id"]);
            $house->setNo_of_rooms($_POST["no_of_rooms"]);
            $house->setRate($_POST["rate"]);
            $house->setPics($name);
            $house->setCountry($_POST["country"]);
            $house->setState($_POST["state"]);
            $house->setCity($_POST["city"]);
            $house->setAddress($_POST["address"]);
            $house->setDescription($_POST["description"]);
            $save=$house->save();

            header('Location: ../view/my-house-view.php');
    }

   /**
    * Update Owner from POST parameters
     * and reload the index.php.
    *
    */
    public function delete(){
        if(isset($_POST["id"])){
            //We create a user
            $house=new House($this->Connection);
            $house->deleteById($_POST["id"]);
        }
        header('Location: ../view/house-list-view.php');
    }
    
    
   /**
    * Create the view that we pass to it with the indicated data.
    *
    */
    public function view($vista,$datos){
        // $data = $datos;  
        // require_once  __DIR__ . "/../view/" . $vista . "View.php";

    }

}
?>