<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/06/2016
 * Time: 12:08 AM
 */

include_once(dirname(__FILE__)."/admin.review.model.php");

/**
 * Class reviewController
 */

class adminReviewController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     *
     */
    public function __construct()
    {
        $this->exportType='html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list=[],$msg)
    {
        global $admin_info;


        switch($this->exportType)
        {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
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




    /**
     * @param $fields
     */
    public function showList($fields)
    {
        global $admin_info;

        if($admin_info['semat'] == 'مرکز')
        {
            $review = adminReviewModel::getAll()->getList();
        }
        else{
            $field['where'] = ' admin_id='.$admin_info['admin_id'] .' ';
            $obj = new adminReviewModel();
            $review = $obj->getByFilter($field);
        }
        //print_r_debug($review);


        if($review['result']!='1')
        {
            $this->fileName='admin.review.showList.php';
            $this->template('',$review['msg']);
            die();
        }

        $export['list']=$review['export']['list'];

        $export['recordsCount']=$review['export']['recordsCount'];
        $this->fileName='admin.review.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showReviewAddForm($fields,$msg)
    {


        $this->fileName='admin.review.addForm.php';
        $this->template($fields,$msg);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function addReview($fields)
    {
        global $admin_info;

        $review=new adminReviewModel();

        $result=$review->setFields($fields);
        $review->date = date('Y-m-d h:i:s');
        $review->admin_id = $admin_info['admin_id'];


        if($result['result']==-1)
        {
            $this->showReviewAddForm($fields,$result['msg']);
            //return $result;
        }
        $review->save();

        if(file_exists($_FILES['file']['tmp_name'])){

            $type  = explode('/',$_FILES['file']['type']);

            $input['upload_dir'] = ROOT_DIR.'statics/review/';
            $result = fileUploader($input,$_FILES['file']);
            $review->file = $result['image_name'];
            $result = $review->save();
        }


        //$result=$review->add();

        if($result['result']!='1')
        {
            $this->showReviewAddForm($fields,$result['msg']);
        }
        $msg='عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showReviewEditForm($fields,$msg)
    {
        if(!validator::required($fields['Review_id']) and !validator::Numeric($fields['Review_id']))
        {
            $msg= 'یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        }

        $review = adminReviewModel::find($fields['Review_id']);

        if(!is_object($review))
        {
            $msg=$review['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        }

        $export=$review->fields;



        $this->fileName='admin.review.editForm.php';
        $this->template($export,$msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editReview($fields)
    {
        //$review=new adminReviewModel();

        if(!validator::required($fields['Review_id']) and !validator::Numeric($fields['Review_id']))
        {
            $msg= 'یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        }

        $review = adminReviewModel::find($fields['Review_id']);

        if(!is_object($review))
        {
            $msg=$review['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        }


        $result=$review->setFields($fields);



        if($result['result']!=1)
        {
            $this->showReviewEditForm($fields,$result['msg']);
        }



        $review->save();

        if(file_exists($_FILES['image']['tmp_name'])){

            $type  = explode('/',$_FILES['image']['type']);

            $input['upload_dir'] = ROOT_DIR.'statics/review/';
            $result = fileUploader($input,$_FILES['image']);
            fileRemover($input['upload_dir'],$review->fields['image']);
            $review->image = $result['image_name'];

            $result = $review->save();
        }




        if($result['result']!='1')
        {
            $this->showReviewEditForm($fields,$result['msg']);
        }
        $msg='عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        die();
    }


    public function deleteReview($fields)
    {

        if(!validator::required($fields['Review_id']) and !validator::Numeric($fields['Review_id']))
        {

            $this->showReviewEditForm($fields,translate('not found'));
        }

        $obj = adminReviewModel::find($fields['Review_id']);

        if(!is_object($obj))
        {
            $msg=$obj['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        }

        $dir = ROOT_DIR.'statics/review/';
        fileRemover($dir,$obj->fields['image']);
        $result = $obj->delete();


        if($result['result']!=1)
        {
            $this->showReviewEditForm($fields,$result['msg']);
        }
        $msg='عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=review", $msg);
        die();
    }
}
?>