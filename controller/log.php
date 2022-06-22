<?php
session_start();
if (isset($_GET['nolog'])) {
    
    $controllerObj=cargarControlador($_GET["table"]);
    launchAction($controllerObj);

}elseif (isset($_GET["method"]) && isset($_GET['table'])) {
    $strFileController1='../controller/log-controller.php';
    require_once $strFileController1;
    $controllerL=new LogController();
    $controllerL->run('register');

    
    $controllerObj=cargarControlador($_GET["table"]);
    launchAction($controllerObj);

}elseif (isset($_GET["method"])) {
    $strFileController1='../controller/log-controller.php';
    require_once $strFileController1;
    $controllerL=new LogController();
    $controllerL->run($_GET["method"]);
}

function cargarControlador($controller){

    switch ($controller) {
        case 'booking':
            $strFileController='../controller/booking-controller.php';
            require_once $strFileController;
            $controllerObj=new BookingController();
            break;

        case 'house':
            $strFileController='../controller/house-controller.php';
            require_once $strFileController;
            $controllerObj=new HouseController();
            break;
        
        default:
            $strFileController='../controller/booking-controller.php';
            require_once $strFileController;
            $controllerObj=new TenantController();
            break;
    }
    return $controllerObj;
}

function launchAction($controllerObj){
    if(isset($_GET["method"])){
        $controllerObj->run($_GET["method"]);
    }else{
        $controllerObj->run(DEFECT_ACTION);
    }
}