<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 9:21 AM
 */
include_once(dirname(__FILE__). "/model/register.controller.php");

global $admin_info,$PARAM;

$registerController = new registerController();
if(isset($exportType))
{
    $registerController->exportType=$exportType;
}


if(isset($_POST['action']) & $_POST['action']=='add')
{
    $registerController->addRegister($_POST);
    //http://php.net/manual/en/function.mysql-real-escape-string.php
}
else
{
    $registerController->showRegisterForm();
}
die();


?>