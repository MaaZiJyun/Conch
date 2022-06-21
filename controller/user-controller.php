<?php
//Global setting
require_once '../configs/global.php';

//We load the controller and execute the action
if(isset($_GET["identity"])){
    // We load the instance of the corresponding controller
    $controllerObj=cargarControlador($_GET["identity"]);
    //We launch the action
    launchAction($controllerObj);
}else{
    // We load the default controller instance
    $controllerObj=cargarControlador(CONTROLLER_DEFECTO);
    // We launch the action
    launchAction($controllerObj);
}


function cargarControlador($controller){

    switch ($controller) {
        case 'owner':
            $strFileController='../controller/owner-controller.php';
            require_once $strFileController;
            $controllerObj=new OwnerController();
            break;
        
        default:
            $strFileController='../controller/tenant-controller.php';
            require_once $strFileController;
            $controllerObj=new TenantController();
            break;
    }
    return $controllerObj;
}

function launchAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(DEFECT_ACTION);
    }
}

?>