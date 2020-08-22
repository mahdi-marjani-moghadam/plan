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

        /** زیر قلم */
    case 'jalasat':
        if ($_POST) {
            $controller->jalasatOnSubmit();
        } else {
            $controller->jalasat();
        }

        break;

    case 'shora':
        $controller->shora();
        break;

    case 'daneshamokhte':
        $controller->daneshamokhte();
        break;

    case 'ruydad':
        $controller->ruydad();
        break;

    default:
        $controller->showList();
}
