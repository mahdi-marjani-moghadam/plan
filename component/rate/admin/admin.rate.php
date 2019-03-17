<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */

include_once(dirname(__FILE__). "/model/admin.rate.controller.php");

global $admin_info,$PARAM;

$rate1Controller = new adminRateController();
if(isset($exportType))
{
    $rate1Controller->exportType=$exportType;
}


switch ($_GET['action'])
{
    case 'nazar':
        if(isset($_POST) && count($_POST)>0)
        {
            $rate1Controller->submitRate($_POST);
        }
        else
        {
            $input=handleData($_GET['id']);
            $rate1Controller->showRate($input, '');
        }
        break;
    case 'showResult':

        $input=handleData($_GET['id']);
        $rate1Controller->showResult($input);
        break;
    case 'search':
        $rate1Controller->search($_GET);
        break;
    default:
        $rate1Controller->showList($fields);
        break;
}

?>