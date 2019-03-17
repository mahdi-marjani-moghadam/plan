x<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/22/2016
 * Time: 10:34 PM
 */

include_once(dirname(__FILE__). "/model/admin.controller.php");
global $PARAM;
$adminController = new adminController();
if(isset($exportType))
{
    $adminController->exportType=$exportType;
}
if(isset($PARAM[1]))
{
    $adminController->showMore($PARAM[1]);
    die();
}else
{
    //$fields['filter']['title']='sdf';
    $fields['limit']['start']=(isset($page))?($page-1)*PAGE_SIZE:'0';
    $fields['limit']['length']=PAGE_SIZE;
    $fields['order']['priority']='ASC';


    $adminController->showALL($fields);
    die();
}