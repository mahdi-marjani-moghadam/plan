<?php
include_once(ROOT_DIR. "component/reports/controllers/reports.controller.php");
$controller = new reportsController();

if(isset($exportType))
{
    $controller->exportType=$exportType;
}


switch ($_GET['action'])
{
    /*case 'search':
        //self
        $form1Controller->search($_GET);
        break;
    case 'search2':
        //universe
        $form1Controller->search2($_GET);
        break;
    case 'chart':
        $form1Controller->chart();
        break;*/

    case 'confirm':
        $controller->confirm($_GET['id']);
        break;
    default:
        $controller->showTableReports();
        break;
}

?>