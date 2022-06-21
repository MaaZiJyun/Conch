<?php
if (!session_id()) session_start();
class LogController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  "../core/Conectar.php";
        require_once  "../model/log-model.php";
        
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
            case "modify" :
                $this->modify();
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
        $log=new Log($this->Connection);
        $log->setTar_ide($_POST["name"]);
        $log->setTar_id($_POST["name"]);
        //We get all the Owners
        $logs=$log->getAllFromReceiver();
       
        return $logs;
    }

    /**
    * Loads the Owners home page with the list of
     * Owners getting from the model.
    *
    */ 
    public function detail($id){
        
        //We load the model
        $model = new Log($this->Connection);
        //We recover the Owner from the BBDD
        $log = $model->getById($id);
        //We load the detail view and pass values to it
        // $this->view("detail",array(
        //     "owner"=>$owner,
        //     "titulo" => "detail owner"
        // ));
        return $log;
    }
    
   /**
    * Create a new Owner from the POST parameters
     * and reload the index.php.
    *
    */
    public function register(){

        // echo '<script> alert("'.$_POST["name"].'");</script>';

        $log=new Log($this->Connection);
        $log->setOri_ide($_POST["ori_ide"]);
        $log->setTar_ide($_POST["tar_ide"]);
        $log->setOri_id($_POST["ori_id"]);
        $log->setTar_id($_POST["tar_id"]);
        $log->setAction($_POST["action"]);
        $log->setDate($_POST["date"]);
        $log->setViewed($_POST["viewed"]);

        $save=$log->save();
        echo '<script> alert("New booking created successfully"); window.location.href="../index.php"</script>';

    }

   /**
    * Update Owner from POST parameters
     * and reload the index.php.
    *
    */
    public function modify(){
        if(isset($_POST["id"])){
            //We create a user
            $owner=new Owner($this->Connection);
            $owner->setO_id($_POST["id"]);
            $owner->setName($_POST["name"]);
            $owner->setEmail($_POST["email"]);
            // $owner->setPwd($_SESSION["pwd"]);
            $owner->setMobile_no($_POST["mobile_no"]);
            $owner->setOccupation($_POST["occupation"]);
            $owner->setNo_of_houses($_POST["no_of_houses"]);
            $owner->setCountry($_POST["country"]);
            $owner->setState($_POST["state"]);
            $owner->setCity($_POST["city"]);
            $owner->setAddress($_POST["address"]);
            $save=$owner->update();

            $_SESSION['userdata'] = array(
                "o_id" =>$_POST["id"],
                "name"=>$_POST['name'],
                "email"=>$_POST['email'],
                // "pwd"=>$_POST['pwd'],
                "mobile_no"=>$_POST['mobile_no'],
                "occupation"=>$_POST['occupation'],
                "no_of_houses"=>$_POST['no_of_houses'],
                "country"=>$_POST['country'],
                "state"=>$_POST['state'],
                "city"=>$_POST['city'],
                "address"=>$_POST['address']
            );
        }
        header('Location: ../index.php');
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