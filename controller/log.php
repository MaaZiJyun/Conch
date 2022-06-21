<?php
session_start();
if (isset($_GET["action"])) {
    # code...
    $strFileController='../controller/log-controller.php';
    require_once $strFileController;
    $controllerObj=new LogController();
    $controllerObj->run($_GET["action"]);
}