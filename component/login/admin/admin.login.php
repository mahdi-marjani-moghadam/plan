<?php
/**
 * Created by PhpStorm.
 * User: marjani,ahmadloo
 * Date: 4/07/2016
 * Time: 9:21 AM
 */
include_once("../../../server.inc.php");
include_once(ROOT_DIR . "common/db.inc.php");
include_once(ROOT_DIR . "admin/init.inc.php");
include_once(ROOT_DIR . "common/func.inc.php");
include_once(ROOT_DIR."/common/validators.php");

include_once(dirname(__FILE__). "/model/admin.login.controller.php");

global $admin_info;


$loginController = new adminLoginController();
if(isset($exportType))
{
    $loginController->exportType=$exportType;
}

if($_REQUEST['action'] == 'logout')
{

    $loginController->callLogout();
}

if($admin_info['result'] != -1)
{

    header('Location: '.RELA_DIR.'admin/');
    die();
}

if($_POST['action'] == 'login')
{

    $loginController->callLogin($_POST);
}
else
{

         $loginController->showLoginform();
}



?>