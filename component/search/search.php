<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/10/2016
 * Time: 10:21 AM.
 */
include_once dirname(__FILE__).'/model/search.controller.php';

global $admin_info,$PARAM;

$searchController = new searchController();
if (isset($exportType)) {
    $searchController->exportType = $exportType;
}

unset($_SESSION['companyBreadcrumb']);
unset($_SESSION['productBreadcrumb']);


$fields['type'] = $_REQUEST['type'];
$fields['q'] = $_REQUEST['q'];
$fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
$fields['limit']['length'] = PAGE_SIZE;



$searchController->showALL($fields);
die();
