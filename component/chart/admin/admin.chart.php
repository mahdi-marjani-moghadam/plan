<?php
include_once(ROOT_DIR. "component/chart/controllers/chart.controller.php");


global $admin_info;

$controller = new chartController();

if($admin_info['parent_id'] != 0  ){
    if($admin_info['group_admin'] != 1){
        switch ($_GET['action']) {
            case '1':
                $controller->groupChart1();
                break;
            case '2':
                $controller->groupChart2();
                break;
        }
    }else{
        switch ($_GET['action']){
            case '1':
                $controller->vahedChart1();
                break;
            case '2':
                $controller->vahedChart2();
                break;
            case '3':
                $controller->vahedChart3();
                break;
            case '4':
                $controller->vahedChart4();
                break;
        }
    }

}else{
    switch ($_GET['action']){
        case '1':
            $controller->managerChart1();
            break;
        case '2':
            $controller->managerChart2();
        break;
    }
}

?>