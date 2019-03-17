<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__).'/account.model.php';


/**
 * Class packageController.
 */
class accountController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
     * @var
     */
    public $fileName;
    public $recordsCount;
    public $pagination;

    /**
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param string $list
     * @param $msg
     *
     * @return string
     */
    public function template($list = [], $msg='')
    {
        global $PARAM, $lang;

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/account.title.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/account.tail.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
                break;

            case 'json':
                echo json_encode($list);
                break;
            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;
            default:
                break;
        }
    }

    public function showPanel()
    {
        global $member_info;

        include_once ROOT_DIR."component/invoice/model/invoice.model.php";


        $invoice = invoice::getBy_member_id($member_info['Artists_id'])->getList();

        if($invoice['export']['recordsCount'] >0)
        {
            $export['invoice'] = $invoice['export']['list'];
        }



        $object=model::find('artists',$member_info['Artists_id']);
        if(is_array($object))
        {
            $this->fileName = 'account.showPanel.php';
            $this->template('',$object['msg']);
            die();
        }


        $export['list'] = $object->fields;

        include_once ROOT_DIR.'component/product/model/product.model.php';
        $products=new productModel();


        $result=$products->getProductByArtistsId($member_info['Artists_id']);
        if($result['result'] == -1)
        {
            $this->fileName = 'account.showPanel.php';
            $this->template('',$result['msg']);
            die();
        }

        $export['artistsProduct'] = $products->recordsCount;





        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
//        $breadcrumb->add('پیشخوان ', 'account', true);
        $breadcrumb->add(translate('پیشخوان '), 'account');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('پنل کاربری');

        $this->fileName = 'account.showPanel.php';
        $this->template($export);
        die();
    }


    /**
     * @param $fields
     * @param $msg
     */
    public function showProductList($fields, $msg='')
    {
        global $member_info;

        include_once ROOT_DIR.'component/product/model/product.model.php';
        $products=new productModel();

        $object=model::find('artists',$member_info['Artists_id']);
        if(is_array($object))
        {
            $this->fileName = 'account.showPanel.php';
            $this->template('',$object['msg']);
            die();
        }


        $export['list'] = $object->fields;

        $result=productModel::getBy_artists_id($member_info['Artists_id'])->getList();

        if($result['result'] == -1)
        {
            $this->fileName = 'account.productList.php';
            $this->template('',$result['msg']);
            die();
        }
        $export['artistsProductList'] = $result['export']['list'];


        $this->recordsCount = $result['export']['recordsCount'];


        $export['pagination'] = $result['pagination'];
        if ($products->recordsCount == '0') {
            $msg = 'رکوردی یافت نشد.';
        }





        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add(translate('پیشخوان '), 'account', true);
        $breadcrumb->add(translate('نمونه کارها'));
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('نمونه کارها');


        $this->fileName = 'account.productList.php';

        $this->template($export, $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showInvoiceList($fields, $msg='')
    {
        global $member_info;

        include_once ROOT_DIR.'component/invoice/model/invoice.model.php';
        $invoice=new invoice();


        $object=model::find('artists',$member_info['Artists_id']);
        if(is_array($object))
        {
            $this->fileName = 'account.showPanel.php';
            $this->template('',$object['msg']);
            die();
        }


        $export['list'] = $object->fields;

        $result=$invoice->getInvoiceByArtistsId($member_info['Artists_id'],$fields);
        if($result['result'] == -1)
        {
            $this->fileName = 'account.invoiceList.php';
            $this->template('',$result['msg']);
            die();
        }

        $export['artistsInvoiceList'] = $invoice->list;


        $this->recordsCount = $result['export']['recordsCount'];


        $export['pagination'] = $result['pagination'];
        if ($invoice->recordsCount == '0') {
            $msg = 'رکوردی یافت نشد.';
        }





        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add(translate('پیشخوان '), 'account', true);
        $breadcrumb->add(translate('لیست صورتحساب ها'));
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('لیست صورتحساب ها');



        $this->fileName = 'account.invoiceList.php';

        $this->template($export, $msg);
        die();
    }

    /**
     * @param $fields
     */

    public function showList($fields)
    {
        //$fields['where']['list']
       // print_r_debug($fields);
        $account = new accountModel();
        $result =$account->getByFilter();

        //print_r_debug($export);

        //$account=accountModel::getByFilter();
        //print_r_debug($account);
       // $account = new accountModel();
        //$result = $account->getPackage($fields);
        // print_r_debug($fields);
       if ($result['result'] != '1') {
            $this->fileName = 'account.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];
        $this->fileName = 'account.showList.php';
        $this->template($export);
        die();
    }



    public function addProduct($fields)
    {
        global $member_info,$lang;
        include_once ROOT_DIR.'component/product/model/product.model.php';
        $account = new productModel();
        $fields['category_id'] = ",".(implode(",",$fields['category_id'])).",";
        $fields['artists_id'] = $member_info['Artists_id'];

        if($lang == 'fa')
        {
            $fields['creation_date'] = convertJToGDate($fields['creation_date']);
        }

        $result =$account->setFields($fields);


        $account->save();
        
        if ($result['result'] == -1) {
            return $result;
        }



        if(file_exists($_FILES['file']['tmp_name'])){

            $type  = explode('/',$_FILES['file']['type']);
            $input['max_size'] = $_FILES['file']['size'];
            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$member_info['Artists_id'].'/';
            $result = fileUploader($input,$_FILES['file']);

            //fileRemover($input['upload_dir'],$product->fields['file']);

            $account->file_type = $type[0];
            $account->extension = $type[1];
            $account->file = $result['image_name'];
            $result = $account->save();
        }

        if(file_exists($_FILES['image']['tmp_name'])){

            $type  = explode('/',$_FILES['image']['type']);

            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$member_info['Artists_id'].'/';
            $result = fileUploader($input,$_FILES['image']);
            //fileRemover($input['upload_dir'],$product->fields['image']);
            $account->image = $result['image_name'];
            $result = $account->save();
        }
        if ($result['result'] != '1') {
            $this->showPackageAddForm($fields, $result['msg']);
        }



        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR . 'account/showProductList', $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showProductAddForm($fields, $msg)
    {
        global $member_info;

        include_once(ROOT_DIR."component/category/model/category.model.php");
        $category = new categoryModel();

        $resultCategory = $category->getCategoryOption();

        if($resultCategory['result'] == 1)
        {
            $export['category'] = $category->list;
        }

        $export['artists_id'] = $member_info['Artists_id'];

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add(translate('پیشخوان '), 'account', true);
        $breadcrumb->add(translate('افزودن اثر'), 'account');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('افزودن اثر');


        $this->fileName = 'account.addProductForm.php';
        $this->template($export, $msg);
        die();
    }


    public function editProduct($fields)
    {
        global $member_info,$lang;
        include_once ROOT_DIR.'component/product/model/product.model.php';


        $account = productModel::find($fields['artists_products_id']);
        if(!is_object($account))
        {
            redirectPage(RELA_DIR,$account['msg']);
        }


        $fields['category_id'] = ",".(implode(",",$fields['category_id'])).",";
        $fields['artists_id'] = $member_info['Artists_id'];
        $fields['status'] = 0;

        if($lang == 'fa')
        {
            $fields['creation_date'] = convertJToGDate($fields['creation_date']);
        }

        $result =$account->setFields($fields);

        $account->save();


        if(file_exists($_FILES['fileT']['tmp_name'])){

            $type  = explode('/',$_FILES['fileT']['type']);
            $input['max_size'] = $_FILES['fileT']['size'];
            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$member_info['Artists_id'].'/';
            $result = fileUploader($input,$_FILES['fileT']);

            fileRemover($input['upload_dir'],$account->fields['file']);

            $account->file_type = $type[0];
            $account->extension = $type[1];
            $account->file = $result['image_name'];
            $result = $account->save();
        }

        if(file_exists($_FILES['imageT']['tmp_name'])){

            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$member_info['Artists_id'].'/';
            $result = fileUploader($input,$_FILES['imageT']);
            fileRemover($input['upload_dir'],$account->fields['image']);
            $account->image = $result['image_name'];

            $result = $account->save();
        }




        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR . 'account/showProductList', $msg);
        die();
    }
    public function showProductEditForm($fields, $msg)
    {
        global $member_info;


        include_once "component/product/model/product.model.php";
        $obj = productModel::find($fields['product_id']);
        if(!is_object($obj))
        {
            redirectPage(RELA_DIR,$obj['msg']);
        }

        $export = $obj->fields;

        include_once(ROOT_DIR."component/category/model/category.model.php");
        $category = new categoryModel();

        $resultCategory = $category->getCategoryOption();

        if($resultCategory['result'] == 1)
        {
            $export['category'] = $category->list;
        }

        $export['artists_id'] = $member_info['Artists_id'];

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add(translate('پیشخوان '), 'account', true);
        $breadcrumb->add(translate('افزودن اثر'), 'account');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('افزودن اثر');

//        print_r_debug($export);
        $this->fileName = 'account.editProductForm.php';
        $this->template($export, $msg);
        die();
    }


    public function editProfile($fields)
    {
        global $member_info;
        include_once ROOT_DIR.'component/artists/model/artists.model.php';


        $account = artists::find($fields['Artists_id']);
        if(!is_object($account))
        {
            redirectPage(RELA_DIR,$account['msg']);
        }

        if(isset($fields['category_id'])){
            $fields['category_id'] = ",".(implode(",",$fields['category_id'])).",";
        }
        $fields['artists_id'] = $member_info['Artists_id'];
        $fields['status'] = 0;

        $account->setFields($fields);

        $result = $account->validator();

        $account->save();


        if(file_exists($_FILES['logo']['tmp_name'])){

            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$member_info['Artists_id'].'/';

            $result = fileUploader($input,$_FILES['logo']);
            fileRemover($input['upload_dir'],$account->fields['logo']);
            $account->logo = $result['image_name'];

            $result = $account->save();
        }



        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR . 'account/editProfile', $msg);
        die();
    }
    public function showProfileEditForm($fields='', $msg='')
    {
        global $member_info;

        include_once "component/artists/model/artists.model.php";
        $obj = artistsModel::find($member_info['Artists_id']);
        if(!is_object($obj))
        {
            redirectPage(RELA_DIR,$obj['msg']);
        }


        $export = $obj->fields;
        $export['category_id'] = explode(',',$export['category_id']);

        include_once(ROOT_DIR."component/category/model/category.model.php");
        $category = new categoryModel();

        $resultCategory = $category->getCategoryOption();

        if($resultCategory['result'] == 1)
        {
            $export['category'] = $category->list;
        }

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add(translate('پیشخوان '), 'account', true);
        $breadcrumb->add(translate('ویرایش پروفایل '), 'account');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['page_title'] = translate('ویرایش پروفایل');
//        print_r_debug($export);
        $this->fileName = 'account.editProfileForm.php';
        $this->template($export, $msg);
        die();
    }

    public function deleteProduct($id)
    {
        if (!validator::required($id) and !validator::Numeric($id)) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR.'account/showProductList', $msg);
        }

        include_once ROOT_DIR.'component/product/model/product.model.php';
        $obj = productModel::find($id);

        if (!is_object($obj)) {
            $msg = $obj['msg'];
            redirectPage(RELA_DIR.'account/showProductList', $msg);
        }

        $dir = ROOT_DIR.'statics/event/';
        fileRemover($dir,$obj->fields['image']);

        $result = $obj->delete();

        if ($result['result'] != '1') {
            redirectPage(RELA_DIR.'account/showProductList', $msg);
        }

        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR.'account/showProductList', $msg);
        die();
    }


    public function showPackageEditForm($fields, $msg)
    {

//        if (!validator::required($fields['Package_id']) and !validator::Numeric($fields['Package_id'])) {
//
//            $msg = 'یافت نشد';
//            redirectPage('');
//            redirectPage(RELA_DIR . 'admin/index.php?component=package', $msg);
//        }

        //$result = $account->getPackageById($fields['Package_id']);
        //$account = new accountModel();


        $account=accountModel::find($fields['Package_id']);




        /*if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=package', $msg);
        }*/
        //print_r_debug($account->fields);

        $export = $account->fields;
      //  print_r_debug($export);
        $this->fileName = 'account.editForm.php';
        $this->template($export, $msg);
        die();
    }


    /**
     * @param $fields
     */

   public function editPackage($fields)
    {

       // print_r_debug($fields);

        $Account=accountModel::find($fields['Package_id']);
        $Account->setFields($fields);

        //$n->title='omid111';
        $Account->save();
        //print_r_debug($Account->fields);




      /*  if (!validator::required($fields['Package_id']) and !validator::Numeric($fields['Package_id'])) {

            $msg = 'یافت نشد';
            redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        }

        $result = $account->getPackageById($fields['Package_id']);

        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        }

        $result = $account->setFields($fields);


        if ($result['result'] != 1) {
            $this->showPackageEditForm($fields, $result['msg']);
        }

        $result = $account->save();

        if ($result['result'] != '1') {
            $this->showPackageEditForm($fields, $result['msg']);
        }*/
        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        die();
    }


    /**
     * delete package by package_id.
     *
     * @param $fields
     *
     * @author malekloo,marjani
     * @date 2/24/2015
     *
     * @version 01.01.01
     */

    public function deletePackage($fields)
    {
        $account = new accountModel();

        if (!validator::required($fields['Package_id']) and !validator::Numeric($fields['Package_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        }
        $result = $account->getPackageById($fields['Package_id']);
     //   print_r_debug($result);
        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        }
        $result = $account->setFields($fields);
//print_r_debug($result);
        if ($result['result'] != 1) {
            $this->showPackageEditForm($fields, $result['msg']);
        }
        $result = $account->delete();

        if ($result['result'] != '1') {
            $this->showPackageEditForm($fields, $result['msg']);
        }
        $msg = translate('عملیات با موفقیت انجام شد');
        redirectPage(RELA_DIR.'admin/index.php?component=package', $msg);
        die();
    }



}
