<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/22/2016
 * Time: 11:34 PM
 */

include_once(dirname(__FILE__)."/admin.admin.model.php");
global $admin_info;
class adminadminController
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
        $this->exportType = 'html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list = array(), $msg='')
    {
        global $messageStack;

        if($msg == '')
        {
            $msg = $messageStack->output('message');
        }


       // print_r_debug($list);
        switch ($this->exportType) {
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
        $admin = adminadminModel::find($admin_info['admin_id']);


        if(!is_object($admin))
        {
            $this->fileName='admin.admin.showList.php';
            $this->template('',$admin['msg']);
            die();
        }

        $export['list']=$admin->fields;

        $export['recordsCount']=1;
        //print_r_debug($export);
        $this->fileName='admin.admin.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showadminAddForm($fields,$msg)
    {


        $this->fileName='admin.admin.addForm.php';
        $this->template($fields,$msg);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function addadmin($fields)
    {
        global $messageStack;
        $admin=new adminadminModel();
        $result=$admin->setFields($fields);
        if($result['result']==-1)
        {
            $this->showadminAddForm($fields,$result['msg']);
            //return $result;
        }
        $res = $admin->validator();
        if($res['result']==-1)
        {
            $this->showadminAddForm($fields,$res['msg']);
            //return $result;
        }


        $admin->save();


        if(file_exists($_FILES['image']['tmp_name'])){

            $type  = explode('/',$_FILES['image']['type']);

            $input['upload_dir'] = ROOT_DIR.'statics/admin/';
            $result = fileUploader($input,$_FILES['image']);
            if($result['result'] == -1)
            {
                $messageStack->add_session('message',$result['msg'],'error');
                redirectPage(RELA_DIR . "admin/index.php?component=admin", $result['msg']);
            }

            $admin->image = $result['image_name'];
            $result = $admin->save();
        }


        if($result['result']!='1')
        {
            $this->showadminAddForm($fields,$result['msg']);
        }

        $msg='عملیات با موفقیت انجام شد';
        $messageStack->add_session('message',$msg,'success');
        redirectPage(RELA_DIR . "admin/index.php?component=admin", $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showadminEditForm($fields,$msg)
    {
        global $admin_info;

        $admin = adminadminModel::find($admin_info['admin_id']);

        if(!is_object($admin))
        {
            $msg=$admin['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=admin", $msg);
        }

        $export=$admin->fields;



        $this->fileName='admin.admin.editForm.php';
        $this->template($export,$msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editadmin($fields)
    {
        global $messageStack;

        global $admin_info;

        $admin = adminadminModel::find($admin_info['admin_id']);

        if(!is_object($admin))
        {
            $msg=$admin['msg'];
            $messageStack->add_session('message',$msg,'error');
            redirectPage(RELA_DIR . "admin/index.php?component=admin", $msg);
        }


        $result=$admin->setFields($fields);

        if($result['result']!=1)
        {
            $this->showadminEditForm($fields,$result['msg']);
        }

        $admin->save();

        if(file_exists($_FILES['image']['tmp_name'])){

            $type  = explode('/',$_FILES['image']['type']);

            $input['upload_dir'] = ROOT_DIR.'statics/admin/';
            $result = fileUploader($input,$_FILES['image']);
            fileRemover($input['upload_dir'],$admin->fields['image']);
            $admin->image = $result['image_name'];

            $result = $admin->save();
        }

        if($result['result']!='1')
        {
            $this->showadminEditForm($fields,$result['msg']);
        }
        $msg='عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=admin", $msg);
        die();
    }



    function showChild()
    {
        global $admin_info;
        if($admin_info['parent_id'] == 0){
            $adminId = 1;
        }elseif($admin_info['group_admin'] == 1){
            $adminId = $admin_info['parent_id'];
        }
        $export = $this->myStaff($adminId);

        $this->fileName = 'admin.staff.showList.php';
        $this->template($export);
        die();
    }

    function myStaff($admin_id,$tt=array())
    {
        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $obj = new adminadminModel();
        $fields['where'] = " parent_id = $admin_id ";
        $result = $obj->getByFilter($fields);

        if($result['export']['recordsCount'] > 0)
        {
            foreach ($result['export']['list'] as $kk => $vv)
            {
                $tt[] = $vv;
                $tt = $this->myStaff($vv['admin_id'],$tt);
            }
        }

        return $tt;
    }
}
