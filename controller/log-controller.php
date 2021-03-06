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
        // echo '<script> alert("New booking created successfully"); window.location.href="../index.php"</script>';

    }

   /**
    * Update Owner from POST parameters
     * and reload the index.php.
    *
    */
    public function modify(){
        if(isset($_POST["id"])){
            //We create a user
            $log=new Log($this->Connection);
            $log->setId($_POST["id"]);
            $log->setViewed("1");
            $save=$log->update();
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