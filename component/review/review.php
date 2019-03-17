<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/10/2016
 * Time: 10:21 AM
 */

include_once(dirname(__FILE__). "/model/review.controller.php");

global $admin_info,$PARAM;

$reviewController = new reviewController();
if(isset($exportType))
{
    $reviewController->exportType=$exportType;
}

if(isset($PARAM[1]))
{
    $reviewController->showMore($PARAM[1]);
    die();
}else
{

    //$fields['filter']['title']='sdf';

    $fields['limit']['start']=(isset($page))?($page-1)*PAGE_SIZE:'0';
    $fields['limit']['length']=PAGE_SIZE;
    $fields['order']['Review_id']='DESC';
    $reviewController->showALL($fields);
    die();
}


?>