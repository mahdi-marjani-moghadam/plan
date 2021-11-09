<?php
include_once(ROOT_DIR . "component/shakhes/controllers/shakhes.controller.php");


global $admin_info;

$controller = new shakhesController();



switch ($_GET['action']) {
        /** تنظیمات شاخص ها  */
    case 'settingAdd':
        $result = $controller->settingAdd($_POST);
        echo json_encode($result);
        break;
    case 'settingEdit':
        $result = $controller->settingEdit($_POST);
        echo json_encode($result);
        break;
    case 'setting':
        $controller->shakhesSetting();
        break;
    case 'adminSetting':
        if ($_POST) {
            $controller->adminSettingOnSubmmit();
        } else {
            $controller->adminSetting();
        }
        break;

        /** توابع شاخص ها  */
    case 'delete':
        $controller->shakhesDelete($_GET);
        break;

        /** خوداظهاری شاخص */
    case 'khodezhari':
        if ($_GET['method'] == 'delete') {
            $controller->onDelete('khodezhari');
        }
        if ($_GET['func'] == 'backToEdit') {
            $controller->backToEdit();
        }
        if ($_GET['func'] == 'shKalanTahlil') {
            $controller->shKalanTahlilStore();
        }
        if ($_POST) {
            $controller->khodezhariOnSubmit();
        } else {
            $controller->khodezhari();
        }
        break;

        /** جلسات */
    case 'jalasat':
        if ($_GET['method'] == 'delete') {
            $controller->onDelete('jalasat');
        }

        if ($_POST) {
            $controller->jalasatOnSubmit();
        } else {
            $controller->jalasat();
        }
        break;

        /* دانش اموخته */
    case 'daneshamukhte':
        if ($_GET['method'] == 'delete') {
            $controller->onDelete('daneshamukhte');
        }
        if ($_POST) {
            $controller->daneshamukhteOnSubmit();
        } else {
            $controller->daneshamukhte();
        }
        break;

        /* رویداد */
    case 'ruydad':
        if ($_GET['method'] == 'delete') {
            $controller->onDelete('ruydad');
        }
        if ($_POST) {
            $controller->ruydadOnSubmit();
        } else {
            $controller->ruydad();
        }
        break;

        /* شورا */
    case 'shora':
        if ($_GET['method'] == 'delete') {
            $controller->onDelete('shora');
        }
        if ($_POST) {
            $controller->shoraOnSubmit();
        } else {
            $controller->shora();
        }
        break;



    default:
        $controller->showList();
}
