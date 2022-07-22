<?php
include_once(ROOT_DIR . "component/talfigh/admin/talfigh.controller.php");
$controller = new talfighController;

switch ($_GET['m']) {
    /** نمودار تلفیق  */
    case 'chart':
        $controller->chart($_POST);
        break;
    
    /** گزارش تلفیق  */
    case 'list':
        $controller->list($_POST);
        break;



    default:
        $controller->list();
        
}
