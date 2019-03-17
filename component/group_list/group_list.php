<?php

include_once(dirname(__FILE__). "/model/group_list.model.php");

global $admin_info,$PARAM;

$group_listController = new group_listController();
if(isset($exportType))
{
    $group_listController->exportType=$exportType;
}


switch ($_GET['action'])
{
    /*case 'nazar':
        if(isset($_POST) && count($_POST)>0)
        {
            $group_listController->sabt($_POST);
        }
        else
        {
            $group_listController->showForm();
        }
        break;*/

    default:
        $group_listController->showList();
        break;
}


