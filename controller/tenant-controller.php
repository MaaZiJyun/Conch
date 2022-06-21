<?php
session_start();
class TenantController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  "../core/Conectar.php";
        require_once  "../model/tenant-model.php";
        
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
            case "login" :
                $this->login();
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
    public function login(){
        // echo '<script> alert("'.$_POST["pwd"].'");</script>';
        $tenant=new Tenant($this->Connection);
        $pwd=$_POST["pwd"];
        $email=$_POST["email"];

        $result=$tenant->getAuth($email, $pwd);
        if ($result) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['id'] = $result['t_id'];
            $_SESSION['name'] = $result['fname'];
            $_SESSION['identity'] = 'tenant';
            $_SESSION['userdata'] = array(
                "t_id" =>$result['t_id'],
                "fname"=>$result['fname'],
                "lname"=>$result['lname'],
                "email"=>$result['email'],
                "pwd"=>$result['pwd'],
                "mobile_no"=>$result['mobile_no'],
                "occupation"=>$result['occupation']
            );
            // header('Location: ../index.php');
            echo '<script> alert("Login Successfully"); window.location.href="../index.php"</script>';
        } else {
            echo '<script> alert("Login failed"); window.location.href="../view/login-view.html"</script>';
        }
        
    }
    
   /**
    * Loads the Owners home page with the list of
    * Owners getting from the model.
    *
    */ 
    public function index(){
        
        //We create the Owner object
        $tenant=new Tenant($this->Connection);
        
        //We get all the Owners
        $tenants=$tenant->getAll();
       
        //We load the index view and pass values to it
        $this->view("index",array(
            "tenants"=>$tenants,
            "titulo" => "PHP MVC"
        ));
    }

    /**
    * Loads the Owners home page with the list of
     * Owners getting from the model.
    *
    */ 
    public function detail(){
        
        //We load the model
        $model = new Tenant($this->Connection);
        //We recover the Owner from the BBDD
        $tenant = $model->getById($_GET["id"]);
        //We load the detail view and pass values to it
        $this->view("detail",array(
            "tenant"=>$tenant,
            "titulo" => "detail owner"
        ));
    }
    
   /**
    * Create a new Owner from the POST parameters
     * and reload the index.php.
    *
    */
    public function register(){

        // echo '<script> alert("'.$_POST["name"].'");</script>';

        if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["mobile_no"]) && isset($_POST["pwd"])
        && $_POST["fname"] != '' && $_POST["lname"] != '' && $_POST["email"] != '' && $_POST["mobile_no"] != '' && $_POST["pwd"] != ''){
            //Creamos un usuario
            $tenant=new Tenant($this->Connection);
            $tenant->setFname($_POST["fname"]);
            $tenant->setLname($_POST["lname"]);
            $tenant->setEmail($_POST["email"]);
            $tenant->setPwd($_POST["pwd"]);
            $tenant->setMobile_no($_POST["mobile_no"]);
            $tenant->setOccupation($_POST["occupation"]);
            $save=$tenant->save();

            header('Location: ../view/login-view.php');
        }else{
            header('Location: ../view/logon-view.php');
        }
    }

   /**
    * Update Owner from POST parameters
     * and reload the index.php.
    *
    */
    public function modify(){
        if(isset($_POST["id"])){
            
            //We create a user
            $tenant=new Tenant($this->Connection);
            $tenant->setT_id($_POST["id"]);
            $tenant->setFname($_POST["fname"]);
            $tenant->setLname($_POST["lname"]);
            $tenant->setEmail($_POST["email"]);
            // $tenant->setPwd($_SESSION["pwd"]);
            $tenant->setMobile_no($_POST["mobile_no"]);
            $tenant->setOccupation($_POST["occupation"]);
            $save=$tenant->update();

            $_SESSION['userdata'] = array(
                "t_id" =>$_POST["id"],
                "fname"=>$_POST['fname'],
                "lname"=>$_POST['lname'],
                "email"=>$_POST['email'],
                // "pwd"=>$_POST['pwd'],
                "mobile_no"=>$_POST['mobile_no'],
                "occupation"=>$_POST['occupation']
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