<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/22/2016
 * Time: 11:30 PM
 */

include_once(dirname(__FILE__). "/model/admin.admin.controller.php");

global $admin_info,$PARAM;


$adminController = new adminadminController();
if(isset($exportType))
{
    $adminController->exportType=$exportType;
}


switch ($_GET['action'])
{

    case 'deleteadmin':

        $input['admin_id']=$_GET['id'];
        $adminController->deleteadmin($input);

        break;
    case 'addadmin':
        if(isset($_POST['action']) & $_POST['action']=='add')
        {

            $adminController->addadmin($_POST);
        }
        else
        {
            $adminController->showadminAddForm('','');
        }
        break;
    case 'editadmin':
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {

            $adminController->editadmin($_POST);
        }
        else
        {
            $input['admin_id']=$_GET['id'];
            $adminController->showadminEditForm($input, '');
        }
        break;
    default:

        //$fields['order']['admin_id'] = 'DESC';
        $adminController->showList($fields);
        break;
}

?>