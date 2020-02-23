<?php
include_once(ROOT_DIR. "component/shakhes/controllers/shakhes.controller.php");


global $admin_info;

$controller = new shakhesController();

$controller->showList();

?>