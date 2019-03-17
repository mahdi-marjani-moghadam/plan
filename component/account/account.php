<?php

include_once dirname(__FILE__).'/model/account.controller.php';

global $PARAM;

$accountController = new accountController();

if (isset($exportType)) {
    $accountController->exportType = $exportType;
}

if($member_info == -1){

    redirectPage(RELA_DIR.'login');
}

switch ($PARAM[1]) {
    case 'showMore':
        $accountController->showMore($_GET['id']);
        break;
    case 'addPackage':


        if (isset($_POST['action']) & $_POST['action'] == 'add') {

            $accountController->addPackage($_POST);

        } else {
            $accountController->showPackageAddForm('', '');
        }
        break;
    case 'editPackage':

        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
          $accountController->editPackage($_POST);
        }
        else
        {
    
            $input['Package_id']=$_GET['id'];
            $accountController->showPackageEditForm($input, '');
        }
        break;
    case 'deletePackage':
       $input['Package_id'] = $_GET['id'];
    //    print_r_debug($input);
        $accountController->deletePackage($input);
        break;
    case 'showProductList':

        $fields['limit']['start']=(isset($page))?($page-1)*PAGE_SIZE:'0';
        $fields['limit']['length']=PAGE_SIZE;
        $fields['order']['Artists_products_id']='DESC';
        $accountController->showProductList($fields);
        break;
    case 'showInvoiceList':

        $fields['limit']['start']=(isset($page))?($page-1)*PAGE_SIZE:'0';
        $fields['limit']['length']=PAGE_SIZE;
        $fields['order']['Invoice_id']='DESC';
        $accountController->showInvoiceList($fields);
        break;
    case 'addProduct':

        if (isset($_POST['action']) & $_POST['action'] == 'add') {

            $accountController->addProduct($_POST);
        }
        else
        {
            $accountController->showProductAddForm($input, '');
        }
        break;

    case 'editProduct':

        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $accountController->editProduct($_POST);
        }
        else
        {
            $input['product_id']=$PARAM[2];
            $accountController->showProductEditForm($input, '');
        }
        break;
    case 'editProfile':

        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $accountController->editProfile($_POST);
        }
        else
        {

            $accountController->showProfileEditForm();
        }
        break;
    case 'deleteProduct':

        $accountController->deleteProduct($PARAM[2]);
        break;
    default:
        
        $accountController->showPanel();
        break;
}
