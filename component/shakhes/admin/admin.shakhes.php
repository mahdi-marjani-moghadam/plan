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
        /** توابع شاخص ها  */
    case 'delete':
        $controller->shakhesDelete($_GET);
        break;

        /** خوداظهاری شاخص */
    case 'khodezhari':
        $controller->khodezhari();
        break;

        /** جلسات */
    case 'jalasat':
        if ($_POST) {
            $controller->jalasatOnSubmit();
        } else {
            $controller->jalasat();
        }
        break;

        /* دانش اموخته */
    case 'daneshamukhte':
        if ($_POST) {
            $controller->daneshamukhteOnSubmit();
        } else {
            $controller->daneshamukhte();
        }
        break;

        /* رویداد */
    case 'ruydad':
        if ($_POST) {
            $controller->ruydadOnSubmit();
        } else {
            $controller->ruydad();
        }
        break;

        /* شورا */
    case 'shora':
        if ($_POST) {
            $controller->shoraOnSubmit();
        } else {
            $controller->shora();
        }
        break;

    default:
        $controller->showList();
}
