<?php
if (!session_id()) session_start();
class BookingController{

    private $conectar;
    private $Connection;

    public function __construct() {
		require_once  "../core/Conectar.php";
        require_once  "../model/booking-model.php";
        
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
        $booking=new Booking($this->Connection);
        
        //We get all the Owners
        $bookings=$booking->getAll();
       
        return $bookings;
    }

    /**
    * Loads the Owners home page with the list of
     * Owners getting from the model.
    *
    */ 
    public function detail($id){
        
        //We load the model
        $model = new Booking($this->Connection);
        //We recover the Owner from the BBDD
        $booking = $model->getById($id);
        //We load the detail view and pass values to it
        // $this->view("detail",array(
        //     "owner"=>$owner,
        //     "titulo" => "detail owner"
        // ));
        return $booking;
    }
    
   /**
    * Create a new Owner from the POST parameters
     * and reload the index.php.
    *
    */
    public function register(){

        // echo '<script> alert("'.$_POST["name"].'");</script>';

        // if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["mobile_no"]) && isset($_POST["pwd"])
        // && $_POST["name"] != '' && $_POST["email"] != '' && $_POST["mobile_no"] != '' && $_POST["pwd"] != ''){
            $booking=new Booking($this->Connection);
            $booking->setO_id($_POST["o_id"]);
            $booking->setT_id($_POST["t_id"]);
            $booking->setH_id($_POST["h_id"]);
            $booking->setPrice($_POST["price"]);
            $booking->setDuration($_POST["duration"]);
            $booking->setStatus($_POST["status"]);
            $save=$booking->save();

            header('Location: ../view/index.php');
        // }else{
        //     header('Location: ../view/logon-view.php');
        // }
    }

   /**
    * Update Owner from POST parameters
     * and reload the index.php.
    *
    */
    public function modify(){
        if(isset($_POST["b_id"])){
            //We create a user
            $booking=new Booking($this->Connection);
            $booking->setId($_POST["b_id"]);
            $booking->setStatus($_POST["status"]);
            $save=$booking->update();

        }
        header('Location: ../view/my-booking-view.php');
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