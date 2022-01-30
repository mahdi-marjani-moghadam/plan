<?php

include_once ROOT_DIR . "component/chart/controllers/arzyabiChart.controller.php";


switch ($_GET['action']) {

        // گروهها
    case 'g1':
        $controller = new arzyabiChartController();
        $controller->groupChart1();
        break;


        // واحد ها
    case 'v2':
        $controller = new arzyabiChartController();
        $controller->daneshkadeChart2();
        break;
    case 'v3':
        $controller = new arzyabiChartController();
        $controller->daneshkadeChart3();
        break;




        // دانشگاه
    case 'u1':
        $controller = new arzyabiChartController();
        $controller->uniChart1();
        break;
    case 'u2':
        $controller = new arzyabiChartController();
        $controller->uniChart1();
        break;


    default:
        dd('Error Url broken!!');
        break;
}
