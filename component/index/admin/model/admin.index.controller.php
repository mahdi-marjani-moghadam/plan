<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__)."/admin.index.model.php");


class adminIndexController
{

    public $exportType;
    public $fileName;

    public function __construct()
    {
        $this->exportType='html';

    }

    function template($list=array(),$msg='')
    {
        global $messageStack,$admin_info, $lang;
        if($msg==''){
            $msg = $messageStack->output('message');
        }
        switch($this->exportType)
        {
            case 'html':
                extract($list);
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



    public function showList($fields)
    {
        include_once(ROOT_DIR."component/admin/admin/model/admin.admin.model.php");
        $result = adminadminModel::query('select count(distinct(admin_id)) as count from sessions_admin')->getList();
        $export['admin_count'] = $result['export']['list'][0]['count'];

        /** status */
        if(STEP_FORM1 == 1){$season = 'سه ماهه';}
        elseif(STEP_FORM1 == 2){$season = 'شش ماهه';}
        elseif(STEP_FORM1 == 3){$season = 'نه ماهه';}
        else{$season = 'یکساله';}


        $child = $this->myStaff();

//        print_r_debug($child);

        $this->fileName='admin.index.php';
        $this->template(compact('export','season','child'));
        die();
    }

    function myStaff()
    {
        global $admin_info;

        include_once ROOT_DIR.'component/admin/model/admin.model.php';

        $result = admin::getAll()->select('status'.STEP_FORM1.' as status,admin_id,name,family')->keyBy('admin_id');

        if($admin_info['parent_id'] == 0){
            /** manager , arzyab */
            $result = $result->where('parent_id','not in','0,1');
        }elseif( $admin_info['group_admin'] == 1){
            /** vahed */
            $result = $result->where('parent_id','=',$admin_info['parent_id']);
        }else{
            /** group */
            $result = $result->where('admin_id','=',$admin_info['admin_id']);
        }


        $result = $result->getList()['export']['list'];

//        $arr = array();
//        foreach ($result as $v){
//            $arr[$v['status']][]['name'] = $v['name'].' '.$v['family'];
//        }

        return $result;


    }

}
?>