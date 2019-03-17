<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */
include_once(dirname(__FILE__). "/model/login.model.php");

global $admin_info,$PARAM;


print_r_debug($_POST);
$login = new memberLogIn();


if($PARAM[1]  == 'logout')
{
    $login->logOut();
    redirectPage(RELA_DIR."account");
}

elseif($PARAM[1]  == 'sendForgot')
{


    $result = $login->sendPassword($_POST);
    echo  json_encode($result);
    die();

}

elseif($PARAM[1]  == 'changePass')
{
    $result = $login->checkCode($_GET);
    if($result['result'] == -1)
    {
        $login->showLoginForm($_POST,$result['msg']);
    }
    else
    {
        $login->showChangePassForm($_GET,'');
    }
}
elseif($PARAM[1] == 'changePassSubmit')
{
    $result = $login->changePass($_POST,$result['msg']);

    $login->showLoginForm($_POST,$result['msg']);

}
elseif($PARAM[1]  == 'register')
{

    if($_POST){
        $result = $login->register($_POST);
        if($result['result'] == -1)
        {
            $login->showLoginForm($result['msg']);

        }
        else
        {
            global $messageStack;
            $messageStack->add_session('login',$result['msg'],'success');
            redirectPage(RELA_DIR.'login',$result['msg']);
        }
    }
    $login->showLoginForm();


}

if($member_info != -1)
{
    redirectPage(RELA_DIR."account");
}

if(isset($exportType))
{
    $loginController->exportType=$exportType;
}

if ($_REQUEST["action"] == 'login') {



    $result = $login->logIn();

    if($result['result'] == -1)
    {
        $login->showLoginForm($_POST,$result['msg']);

    }
    else
    {
        redirectPage(RELA_DIR);
    }
}
else{


    $login->showLoginForm();

    //$loginController->showLoginForm();
}

die();

?>