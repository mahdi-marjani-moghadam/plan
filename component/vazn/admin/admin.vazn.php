<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 11:40 AM
 */
include_once(dirname(__FILE__). "/model/admin.vazn.controller.php");

global $admin_info,$PARAM;

$vaznController = new adminVaznController();
if(isset($_POST['exportType']))
{

    $vaznController->exportType=handleData($_POST['exportType']);
}

if($admin_info == -1)
{
    die('not access');
}

switch ($_REQUEST['action'])
{
    case 'getAllVaznJson':

        $vaznController->getAllJson();
        break;
   
   
    default:
        /*
        $fields['limit']['start']=(isset($_GET['page']))?($_GET['page']-1)*PAGE_SIZE:'0';
        $fields['limit']['length']=PAGE_SIZE;
        $fields['order']['Contact_id']='DESC';
        $vaznController->showList($fields);
        break;*/
}

?>