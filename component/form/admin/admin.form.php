<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */

include_once(dirname(__FILE__). "/model/admin.form.controller.php");


global $admin_info,$PARAM;

$form1Controller = new adminFormController();
if(isset($exportType))
{
    $form1Controller->exportType=$exportType;
}

switch ($_GET['action'])
{
    case 'nazar':
        if(isset($_POST) && count($_POST)>0)
        {
            $form1Controller->submitForm($_POST);
        }
        else
        {
            $input=handleData($_GET['id']);
            $form1Controller->showForm($input, '');
        }
        break;
    case 'myForm':// self
        if(isset($_POST) && count($_POST)>0)
        {
            $form1Controller->submitMyForm($_POST);
        }
        else
        {
            $form1Controller->showMyForm($_POST);
        }
        break;
    case 'sabt':
        $form1Controller->sabt($_POST);
        break;
    case 'search':
        //self
        $form1Controller->search($_GET);
        break;
    case 'search2':
        //universe
        $form1Controller->search2($_GET);
        break;

    case 'chart':
        $form1Controller->chart($_GET);
        break;

    case 'deleteFile':
        $res = $form1Controller->deleteFile($_GET);
        redirectPage(RELA_DIR.'admin/?component=form&action=myForm',$res['msg']);
        break;
    default://universe

        $form1Controller->showList($_GET['q']);
        break;
}

?>