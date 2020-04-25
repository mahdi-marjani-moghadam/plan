<?php
include_once(ROOT_DIR. "component/shakhes/controllers/shakhes.controller.php");


global $admin_info;

$controller = new shakhesController();



switch($_GET['action']){
    case 'setting':
        $controller->shakhesSetting();
    break;
    case 'delete':
        $controller->shakhesDelete($_GET);
        break;
    default:
        $controller->showList();
}

?>