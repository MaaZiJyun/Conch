<?php
if (!session_id()) session_start();
class OwnerController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  "../core/Conectar.php";
        require_once  "../model/owner-model.php";
        
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
        $owner=new Owner($this->Connection);
        $pwd=$_POST["pwd"];
        $hash = md5($pwd);
        // echo '<script> alert("'.$hash.'"); </script>';
        $email=$_POST["email"];

        // $result=$owner->getAuth($email, $pwd);
        // add the hash to protect the password from user
        $result=$owner->getAuth($email, $hash);
        if ($result) {
            // session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['id'] = $result['o_id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['identity'] = 'owner';
            $_SESSION['userdata'] = array(
                "o_id" =>$result['o_id'],
                "name"=>$result['name'],
                "email"=>$result['email'],
                "pwd"=>$result['pwd'],
                "mobile_no"=>$result['mobile_no'],
                "occupation"=>$result['occupation'],
                "no_of_houses"=>$result['no_of_houses'],
                "country"=>$result['country'],
                "state"=>$result['state'],
                "city"=>$result['city'],
                "address"=>$result['address']
            );
            // header('Location: ../index.php');
            echo '<script> alert("Login Successfully"); window.location.href="../index.php"</script>';
        } else {
            echo '<script> alert("Login failed"); window.location.href="../view/login-view.php"</script>';
        }
        
    }


   /**
    * Loads the Owners home page with the list of
    * Owners getting from the model.
    *
    */ 
    public function index(){
        
        //We create the Owner object
        $owner=new Owner($this->Connection);
        
        //We get all the Owners
        $owners=$owner->getAll();
       
        //We load the index view and pass values to it
        $this->view("index",array(
            "owners"=>$owners,
            "titulo" => "PHP MVC"
        ));
    }

    /**
    * Loads the Owners home page with the list of
     * Owners getting from the model.
    *
    */ 
    public function detail($o_id){
        
        //We load the model
        $model = new Owner($this->Connection);
        //We recover the Owner from the BBDD
        $owner = $model->getById($o_id);
        //We load the detail view and pass values to it
        return $owner;
    }
    
   /**
    * Create a new Owner from the POST parameters
     * and reload the index.php.
    *
    */
    public function register(){

        // echo '<script> alert("'.$_POST["name"].'");</script>';

        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["mobile_no"]) && isset($_POST["pwd"])
        && $_POST["name"] != '' && $_POST["email"] != '' && $_POST["mobile_no"] != '' && $_POST["pwd"] != ''){
            //Creamos un usuario
            // add hashing method
            $pwd = $_POST["pwd"];
            $hash = md5($pwd);

            $owner=new Owner($this->Connection);
            $owner->setName($_POST["name"]);
            $owner->setEmail($_POST["email"]);
            // $owner->setPwd($_POST["pwd"]);
            $owner->setPwd($hash);
            $owner->setMobile_no($_POST["mobile_no"]);
            $owner->setOccupation($_POST["occupation"]);
            $owner->setNo_of_houses($_POST["no_of_houses"]);
            $owner->setCountry($_POST["country"]);
            $owner->setState($_POST["state"]);
            $owner->setCity($_POST["city"]);
            $owner->setAddress($_POST["address"]);
            $save=$owner->save();

            echo '<script> alert("Register Successfully"); window.location.href="../view/login-view.php"</script>';
        }else{
            echo '<script> alert("Register Failed"); window.location.href="../view/logon-view.php"</script>';
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