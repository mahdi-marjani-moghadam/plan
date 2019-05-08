<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__)."/admin.form.model.php");

/**
 * Class form1Controller
 */
class adminFormController
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
    function template($list = array(), $msg = '')
    {
        global $admin_info, $messageStack;


        if ($msg == '') {
            $msg = $messageStack->output('message');
        }


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



    public function showList($fields=array()){

        global $admin_info;
        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $obj = new reportsController();
        if (isset($_GET['old'])) {
            $list = $obj->reportsProcess2();
        }else
        {
            $list = $obj->reportsProcess();

        }
        if(isset($_GET['array'])){
            print_r_debug($list);
        }

        /** show-admin */
        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $objAdmin = new admin();
        if($admin_info['parent_id'] != 0 && $admin_info['group_admin'] !=1   ){
            /**  */
            $result3 = $objAdmin->getAll()
                ->select('admin_id,name,family')
                ->where('admin_id','=',$admin_info['admin_id'])
                ->getList();
        }
        else if($admin_info['parent_id'] != 0 && $admin_info['group_admin'] ==1   ){
            $result3 = $objAdmin->getAll()
                ->select('admin_id,name,family')
                ->where('parent_id','=',$admin_info['parent_id'])
                ->getList();
        }
        else{
            $result3 = $objAdmin->getAll()
                ->select('admin_id,name,family')
                ->getList();
        }

        $list['showAdmin'] = $result3['export']['list'];

//        print_r_debug($list);

        if (isset($_GET['old'])) {
            $this->fileName = 'admin.form1.showList.old.php';
        }else{

            $this->fileName = 'admin.form1.showList.php';
        }
        $this->template($list);
        die();
    }







    /** submit markaz arzyabi */
    function sabt($fields){

        global $admin_info;

        include_once ROOT_DIR.'component/kalan_tahlil/model/kalan_tahlil.model.php';

        foreach ($fields['kalan_tahlil'] as $kalan_no => $v){
            foreach ($v as $group_id => $v2){

                $res = kalan_tahlil::getBy_group_id_and_kalan_no($group_id,$kalan_no)->get();
                if($res['export']['recordsCount']>0){

                    if($admin_info['admin_id'] == 1){
                        $res['export']['list'][0]->kalan_tahlil_manager1 = $v2['1-m'];
                    }else{
                        $res['export']['list'][0]->kalan_tahlil_arzyab1 = $v2['1-a'];
                        $res['export']['list'][0]->kalan_tahlil_manager1 = $v2['1-a'];
                    }

                    if($admin_info['admin_id'] == 1){
                        $res['export']['list'][0]->kalan_tahlil_manager2 = $v2['2-m'];
                    }else{
                        $res['export']['list'][0]->kalan_tahlil_arzyab2 = $v2['2-a'];
                        $res['export']['list'][0]->kalan_tahlil_manager2 = $v2['2-a'];
                    }

                    if($admin_info['admin_id'] == 1){
                        $res['export']['list'][0]->kalan_tahlil_manager3 = $v2['3-m'];
                    }else{
                        $res['export']['list'][0]->kalan_tahlil_arzyab3 = $v2['3-a'];
                        $res['export']['list'][0]->kalan_tahlil_manager3 = $v2['3-a'];
                    }

                    if($admin_info['admin_id'] == 1){
                        $res['export']['list'][0]->kalan_tahlil_manager4 = $v2['4-m'];
                    }else{
                        $res['export']['list'][0]->kalan_tahlil_arzyab4 = $v2['4-a'];
                        $res['export']['list'][0]->kalan_tahlil_manager4 = $v2['4-a'];
                    }



                    /*$res['export']['list'][0]->kalan_tahlil_arzyab1 = $v2['1-a'];
                    $res['export']['list'][0]->kalan_tahlil_manager1 = $v2['1-m'];

                    $res['export']['list'][0]->kalan_tahlil_arzyab2 = $v2['2-a'];
                    $res['export']['list'][0]->kalan_tahlil_manager2 = $v2['2-m'];

                    $res['export']['list'][0]->kalan_tahlil_arzyab3 = $v2['3-a'];
                    $res['export']['list'][0]->kalan_tahlil_manager3 = $v2['3-m'];

                    $res['export']['list'][0]->kalan_tahlil_arzyab4 = $v2['4-a'];
                    $res['export']['list'][0]->kalan_tahlil_manager4 = $v2['4-m'];*/

                    $res['export']['list'][0]->save();
                }else{
                    $res = new kalan_tahlil();
                    $res->group_id = $group_id;
                    $res->kalan_no = $kalan_no;
                    $res->kalan_tahlil_arzyab1 = $v2['1-a'];
                    $res->kalan_tahlil_manager1 = $v2['1-m'];

                    $res->kalan_tahlil_arzyab2 = $v2['2-a'];
                    $res->kalan_tahlil_manager2 = $v2['2-m'];

                    $res->kalan_tahlil_arzyab3 = $v2['3-a'];
                    $res->kalan_tahlil_manager3 = $v2['3-m'];

                    $res->kalan_tahlil_arzyab4 = $v2['4-a'];
                    $res->kalan_tahlil_manager4 = $v2['4-m'];
                    $res->save();
                }

            }

        }
        global $messageStack,$admin_info;
        include_once ROOT_DIR.'component/eghdam_vazn/model/eghdam_vazn.model.php';

        foreach ($fields['manager'] as $admin_id => $v){
            foreach ($v as $eghdam_id => $v2){
                $res = eghdam_vazn::getBy_admin_id_and_eghdam_id($admin_id,$eghdam_id)->get();

                $res['export']['list'][0]->manager1_1 = $v2['1_1'];
                $res['export']['list'][0]->manager1_2 = $v2['1_2'];
                $res['export']['list'][0]->manager1_3 = $v2['1_3'];
                $max = (($v2['1_1'] > $v2['1_2'])? $v2['1_1']:$v2['1_2']);
                $max = (($max > $v2['1_3'])? $max:$v2['1_3']);
                $res['export']['list'][0]->max_manager1 = $max;
                $res['export']['list'][0]->tarzyab1_4 = $v2['1_4'];
                $res['export']['list'][0]->tmanager1_5 = $v2['1_5'];


                $res['export']['list'][0]->manager2_1 = $v2['2_1'];
                $res['export']['list'][0]->manager2_2 = $v2['2_2'];
                $res['export']['list'][0]->manager2_3 = $v2['2_3'];
                $max = (($v2['2_1'] > $v2['2_2'])? $v2['2_1']:$v2['2_2']);
                $max = (($max > $v2['2_3'])? $max:$v2['2_3']);
                $res['export']['list'][0]->max_manager2 = $max;
                $res['export']['list'][0]->tarzyab2_4 = $v2['2_4'];
                $res['export']['list'][0]->tmanager2_5 = $v2['2_5'];

                $res['export']['list'][0]->manager3_1 = $v2['3_1'];
                $res['export']['list'][0]->manager3_2 = $v2['3_2'];
                $res['export']['list'][0]->manager3_3 = $v2['3_3'];
                $max = (($v2['3_1'] > $v2['3_2'])? $v2['3_1']:$v2['3_2']);
                $max = (($max > $v2['3_3'])? $max:$v2['3_3']);
                $res['export']['list'][0]->max_manager3 = $max;
                $res['export']['list'][0]->tarzyab3_4 = $v2['3_4'];
                $res['export']['list'][0]->tmanager3_5 = $v2['3_5'];

                $res['export']['list'][0]->manager4_1 = $v2['4_1'];
                $res['export']['list'][0]->manager4_2 = $v2['4_2'];
                $res['export']['list'][0]->manager4_3 = $v2['4_3'];
                $max = (($v2['4_1'] > $v2['4_2'])? $v2['4_1']:$v2['4_2']);
                $max = (($max > $v2['4_3'])? $max:$v2['4_3']);
                $res['export']['list'][0]->max_manager4 = $max;
                $res['export']['list'][0]->tarzyab4_4 = $v2['4_4'];
                $res['export']['list'][0]->tmanager4_5 = $v2['4_5'];


                $res['export']['list'][0]->save();


            }

        }

        unset($res);
        include_once ROOT_DIR.'component/group_list/model/group_list.model.php';
        foreach ($fields['manager_group'] as $admin_id => $v){

            foreach ($v as $faaliat_id => $v2){
                $res = group_list::getBy_admin_id_and_faaliat_id($admin_id,$faaliat_id)->get();

                if($res['export']['recordsCount']==0){
                    //print_r_debug($admin_id);
                }

                if($admin_info['admin_id'] == 1){
                    $res['export']['list'][0]->max_manager1 = $v2['max_manager1'];
                    $res['export']['list'][0]->tahlil_manager1 = $v2['tahlil_manager1'];
                }
                else{
                    $res['export']['list'][0]->manager1_1 = $v2['1_1'];
                    $res['export']['list'][0]->manager1_2 = $v2['1_2'];
                    $res['export']['list'][0]->manager1_3 = $v2['1_3'];
                    $max = (($v2['1_1'] > $v2['1_2'])? $v2['1_1']:$v2['1_2']);
                    $max = (($max > $v2['1_3'])? $max:$v2['1_3']);
                    $res['export']['list'][0]->max1 = $max;
                    $res['export']['list'][0]->tahlil1 = $v2['tahlil1'];
                    //if($res['export']['list'][0]->max_manager1 == 0.00 || $res['export']['list'][0]->max_manager1 == ''){
                        $res['export']['list'][0]->max_manager1 = $max;
                        $res['export']['list'][0]->tahlil_manager1 = $v2['tahlil1'];
                    //}
                }

                if($admin_info['admin_id'] == 1){
                    $res['export']['list'][0]->max_manager2 = $v2['max_manager2'];
                    $res['export']['list'][0]->tahlil_manager2 = $v2['tahlil_manager2'];
                }
                else{
                    $res['export']['list'][0]->manager2_1 = $v2['2_1'];
                    $res['export']['list'][0]->manager2_2 = $v2['2_2'];
                    $res['export']['list'][0]->manager2_3 = $v2['2_3'];
                    $max = (($v2['2_1'] > $v2['2_2'])? $v2['2_1']:$v2['2_2']);
                    $max = (($max > $v2['2_3'])? $max:$v2['2_3']);
                    $res['export']['list'][0]->max2 = $max;
                    $res['export']['list'][0]->tahlil2 = $v2['tahlil2'];
                    //if($res['export']['list'][0]->max_manager2 == 0.00 || $res['export']['list'][0]->max_manager2 == ''){
                        $res['export']['list'][0]->max_manager2 = $max;
                        $res['export']['list'][0]->tahlil_manager2 = $v2['tahlil2'];
                    //}
                }

                if($admin_info['admin_id'] == 1){
                    $res['export']['list'][0]->max_manager3 = $v2['max_manager3'];
                    $res['export']['list'][0]->tahlil_manager3 = $v2['tahlil_manager3'];
                }
                else{
                    $res['export']['list'][0]->manager3_1 = $v2['3_1'];
                    $res['export']['list'][0]->manager3_2 = $v2['3_2'];
                    $res['export']['list'][0]->manager3_3 = $v2['3_3'];
                    $max = (($v2['3_1'] > $v2['3_2'])? $v2['3_1']:$v2['3_2']);
                    $max = (($max > $v2['3_3'])? $max:$v2['3_3']);
                    $res['export']['list'][0]->max3 = $max;
                    $res['export']['list'][0]->tahlil3 = $v2['tahlil3'];
                    //if($res['export']['list'][0]->max_manager3 == 0.00 || $res['export']['list'][0]->max_manager3 == ''){
                        $res['export']['list'][0]->max_manager3 = $max;
                        $res['export']['list'][0]->tahlil_manager3 = $v2['tahlil3'];
                    //}
                }

                if($admin_info['admin_id'] == 1){
                    $res['export']['list'][0]->max_manager4 = $v2['max_manager4'];
                    $res['export']['list'][0]->tahlil_manager4 = $v2['tahlil_manager4'];
                }
                else{
                    $res['export']['list'][0]->manager4_1 = $v2['4_1'];
                    $res['export']['list'][0]->manager4_2 = $v2['4_2'];
                    $res['export']['list'][0]->manager4_3 = $v2['4_3'];
                    $max = (($v2['4_1'] > $v2['4_2'])? $v2['4_1']:$v2['4_2']);
                    $max = (($max > $v2['4_3'])? $max:$v2['4_3']);
                    $res['export']['list'][0]->max4 = $max;
                    $res['export']['list'][0]->tahlil4 = $v2['tahlil4'];
                    //if($res['export']['list'][0]->max_manager4 == 0.00 || $res['export']['list'][0]->max_manager4 == ''){
                        $res['export']['list'][0]->max_manager4 = $max;
                        $res['export']['list'][0]->tahlil_manager4 = $v2['tahlil4'];
                    //}
                }
                $res['export']['list'][0]->save();
            }

        }


        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $obj = admin::find($admin_info['admin_id']);

        if(isset($_POST['submit'])){
            $obj->status = 1;
        }
        elseif(isset($_POST['submit2'])){
            $obj->status = 4;
        }


        $obj->save();

        $messageStack->add_session('message','عملیات با موفقیت انجام شد','success');
        redirectPage(RELA_DIR.'admin/?component=form&q=,null,','عملیات با موفقیت انجام شد');
//        print_r_debug($fields);
    }










    /** self / khod arzyabi */
    function showMyForm()
    {
        global $admin_info, $messageStack, $dataStack;

        $list = '';

            $this->fileName = 'admin.form1.addForm.php';

        $this->template($list);
        die();
    }
    public function search($fields)
    {
        global $admin_info;


        include_once(ROOT_DIR . "model/datatable.converter.php");
        $i = 0;
        $columns = array(
            array('db' => 'faaliat_id', 'dt' => $i++),
            array('db' => 'kalan', 'dt' => $i++),
            array('db' => 'amaliati', 'dt' => $i++),
            array('db' => 'eghdam', 'dt' => $i++),
            array('db' => 'faaliat', 'dt' => $i++),
            array('db' => 'fid', 'dt' => $i++),
        );
        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();


        include_once ROOT_DIR . 'component/plan/model/plan.model.php';
        $obj = new plan();
        /* /*if($searchFields['filter'] == '')
         {
             $searchFields['where'] = " admin_id in ($admins) ";
         }
         else{
             $searchFields['where'] .= "  admin_id in ($admins) and ";
         }*/




        $query = "select 
  `group_list`.`id` AS `fid`,
  `group_list`.`faaliat_id`,
  `group_list`.`admin_id`,
   group_list.admin_percent1 * group_list.max_manager1 as O1,
   group_list.admin_percent2 * group_list.max_manager2 as O2,
   group_list.admin_percent3 * group_list.max_manager3 as O3,
   group_list.admin_percent4 * group_list.max_manager4 as O4,
   eghdam.eghdam_id,
   eghdam.kalan,
   eghdam.amaliati,
   eghdam.eghdam,
   faaliat.faaliat,
  `group_list`.`admin_percent1`,
  `group_list`.`admin_percent2`,
  `group_list`.`admin_percent3`,
  `group_list`.`admin_percent4`,
  `group_list`.`admin_tozihat1`,
  `group_list`.`admin_tozihat2`,
  `group_list`.`admin_tozihat3`,
  `group_list`.`admin_tozihat4`,
  `group_list`.`admin_file1`,
  `group_list`.`admin_file2`,
  `group_list`.`admin_file3`,
  `group_list`.`admin_file4`,
  admin.start_date,
  admin.finish_date,
  admin.status,
  admin.group_admin
 from group_list 
  LEFT JOIN faaliat ON `faaliat`.`faaliat_id` = group_list.faaliat_id
  LEFT JOIN eghdam ON eghdam.eghdam_id = faaliat.eghdam_id
  Left JOIN admin ON admin.admin_id = group_list.admin_id
  where group_list.admin_id = {$admin_info['admin_id']}";

        $result = $obj->getByFilter('', $query);


        $list['list'] = $result['export']['list'];

        $list['paging'] = $result['export']['recordsCount'];

        $other['3'] = array(
            'formatter' => function ($list) {

                include_once ROOT_DIR.'component/khoroji_eghdam/model/khoroji_eghdam.model.php';
                $res = khoroji_eghdam::getBy_eghdam_id_and_admin_id($list['eghdam_id'],$list['admin_id'])
                    ->select('khoroji_eghdam,id')
                    ->getList()['export']['list'][0];

                $st = $list['eghdam'].'<a  data-toggle="modal" data-target="#exampleModalCenter'.$res['id'].'" ><i class="far fa fa-question-circle"></i></a>';
                $st .= '
                    <div class="modal fade" id="exampleModalCenter'.$res['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content"><div class="modal-header"><h3 class="modal-title" id="exampleModalCenterTitle">مستندات مورد نیاز</h3></div>
                          <div class="modal-body">';
                $st .= $res['khoroji_eghdam'];
                $st .='</div></div>
                      </div>
                    </div>';
                return $st;
            });


        $other['5'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $st = '';
                    $plan_id = $list['fid'];
                    if(STEP_FORM1 == 1 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')){
                        $st .= "<input data-season='1-{$list['fid']}' class='form-control ltr ' pattern='^([0-9]|[1-9][0-9]|100)$' title='.درصد پیشرفت وارد شده مجاز نمی باشد' autocomplete='off'  name='menu[$plan_id][1]' type='text'  value='{$list['admin_percent1']}' style='width: 150px'>";
                        $st .= "<input  name='menu[$plan_id][1]' type='file'   >";
                    }
                    else{
                        $st .= 'اعلامی: <br>'.$list['admin_percent1'].'<br> نهایی: ' ." <div data-season='1-{$list['fid']}'>".$list['O1']."</div>";
                    }


                    if ($list['admin_file1']){
                        $st .= "<br>"."<a class='btn btn-default'  href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season1/{$list['eghdam_id']}/{$list['admin_file1']}"."'>دانلود فایل</a>";
                        $st .= "<a class='btn btn-danger text-white btn-xs'  href='".RELA_DIR."admin/?component=form&action=deleteFile&s=1&e={$list['eghdam_id']}&f={$list['faaliat_id']}' style='color: red;'>حذف فایل</a>";

                    }
                }
                else
                {
                    $st =$list['admin_percent1'];
                    if ($list['admin_file1']){
                        $st .="<a  class='btn btn-default' href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season1/{$list['eghdam_id']}/{$list['admin_file1']}"."'>دانلود فایل </a>";

                    }
                }


                return $st;
            }
        );

        $other['6'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==1 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st = "<textarea name='admin_tozihat[$plan_id][1]'  type='text' class='form-control' rows='3'>{$list['admin_tozihat1']}</textarea>";
                    }
                    else{
                        $st .= $list['admin_tozihat1'];
                    }
                }
                else
                {
                    $st =$list['admin_tozihat1'];

                }
                return $st;
            }
        );

        $other['7'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st = '';
                    if(STEP_FORM1==2 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')){
                        $st .= "<input data-season='2-{$list['fid']}' class='form-control ltr percent-input' pattern='^([0-9]|[1-9][0-9]|100)$' title='.درصد پیشرفت وارد شده مجاز نمی باشد' autocomplete='off'  name='menu[$plan_id][2]' type='text'  value='{$list['admin_percent2']}' style='width: 150px'>";
                        $st .= "<input  name='menu[$plan_id][2]' type='file'   >";
                    }
                    else{
                        $st .= 'اعلامی: <br>'.$list['admin_percent2'].'<br> نهایی: ' ." <div data-season='2-{$list['fid']}'>".$list['O2']."</div>";

                    }
                    if ($list['admin_file2']){
                        $st .="<br>"."<a  class='btn btn-success btn-xs' data-season='2' href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season2/{$list['eghdam_id']}/{$list['admin_file2']}"."'>دانلود فایل</a>";
                        $st .= "<a class='btn btn-danger text-white btn-xs'  onclick=\" return confirm('آیا میخواهید فایل را حذف نمایید؟');\"     href='".RELA_DIR."admin/?component=form&action=deleteFile&s=2&e={$list['eghdam_id']}&f={$list['faaliat_id']}' style='color: red;'>حذف فایل</a>";
                    }
                }
                else
                {
                    $st =$list['admin_percent2'];
                    if ($list['admin_file2']){
                        $st .="<a  class='btn btn-default btn-xs' href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season2/{$list['eghdam_id']}/{$list['admin_file2']}"."'>دانلود فایل</a>";

                    }
                }


                return $st;
            }
        );

        $other['8'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==2 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st = "<textarea name='admin_tozihat[$plan_id][2]'  type='text' class='form-control' rows='3'>{$list['admin_tozihat2']}</textarea>";
                    }
                    else{
                        $st .= $list['admin_tozihat2'];
                    }
                }
                else
                {
                    $st =$list['admin_tozihat2'];

                }
                return $st;
            }
        );


        $other['9'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==3 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st .= "<input data-season='3-{$list['fid']}' class='form-control ltr percent-input' pattern='^([0-9]|[1-9][0-9]|100)$' title='.درصد پیشرفت وارد شده مجاز نمی باشد' autocomplete='off'  name='menu[$plan_id][3]' type='text'  value='{$list['admin_percent3']}' style='width: 150px'>";
                        $st .= "<input  name='menu[$plan_id][3]' type='file'   >";
                    }
                    else{
                        $st .= 'اعلامی: <br>'.$list['admin_percent3'].'<br> نهایی: ' ." <div data-season='3-{$list['fid']}'>".$list['O3']."</div>";

                    }
                    if ($list['admin_file3']){
                        $st .="<br>"."<a  class='btn btn-success btn-xs' data-season='3' href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season1/{$list['eghdam_id']}/{$list['admin_file3']}"."'>دانلود فایل</a>";
                        $st .= "<a class='btn btn-danger text-white btn-xs' onclick=\" return confirm('آیا میخواهید فایل را حذف نمایید؟');\"   href='".RELA_DIR."admin/?component=form&action=deleteFile&s=3&e={$list['eghdam_id']}&f={$list['faaliat_id']}' style='color: red;'>حذف فایل</a>";
                    }
                }
                else
                {
                    $st =$list['admin_percent3'];
                    if ($list['admin_file3']){
                        $st .="<a href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season1/{$list['eghdam_id']}/{$list['admin_file3']}"."'>دانلود فایل</a>";
                    }
                }
                return $st;
            }
        );

        $other['10'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==3 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st = "<textarea name='admin_tozihat[$plan_id][3]'  type='text' class='form-control' rows='3'>{$list['admin_tozihat3']}</textarea>";
                    }
                    else{
                        $st .= $list['admin_tozihat3'];
                    }
                }
                else
                {
                    $st =$list['admin_tozihat3'];

                }
                return $st;
            }
        );

        $other['11'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];
                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==4 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st .= "<input data-season='4-{$list['fid']}' class='form-control ltr percent-input' pattern='^([0-9]|[1-9][0-9]|100)$' title='.درصد پیشرفت وارد شده مجاز نمی باشد' autocomplete='off'  name='menu[$plan_id][4]' type='text'  value='{$list['admin_percent4']}' style='width: 150px'>";
                        $st .= "<input  name='menu[$plan_id][4]' type='file'   >";
                    }
                    else{
                        $st .= 'اعلامی: <br>'.$list['admin_percent4'].'<br> نهایی: ' ." <div data-season='4-{$list['fid']}'>".$list['O4']."</div>";
                    }
                    if ($list['admin_file4']){
                        $st .="<br>"."<a   class='btn btn-success btn-xs' data-season='4' href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season4/{$list['eghdam_id']}/{$list['admin_file4']}"."'>دانلود فایل</a>";
                        $st .= "<a class='btn btn-danger text-white btn-xs'  onclick=\" return confirm('آیا میخواهید فایل را حذف نمایید؟');\"  href='".RELA_DIR."admin/?component=form&action=deleteFile&s=4&e={$list['eghdam_id']}&f={$list['faaliat_id']}' style='color: red;'>حذف فایل</a>";
                    }
                }
                else
                {
                    $st =$list['admin_percent4'];
                    if ($list['admin_file4']){
                        $st .="<a href='".RELA_DIR."statics/files/{$admin_info['admin_id']}/season4/{$list['eghdam_id']}/{$list['admin_file4']}"."'>دانلود فایل</a>";
                    }
                }

                return $st;
            }
        );

        $other['12'] = array(
            'formatter' => function ($list) {
                global $admin_info;
                $status = $list['status'];

                if($status == 0 || ($status == 1)  )
                {
                    $plan_id = $list['fid'];
                    $st='';
                    if(STEP_FORM1==4 and $list['start_date'] <= date('Y-m-d') and $list['finish_date'] >= date('Y-m-d')) {
                        $st = "<textarea name='admin_tozihat[$plan_id][4]'  type='text' class='form-control' rows='3'>{$list['admin_tozihat4']}</textarea>";
                    }
                    else{
                        $st .= $list['admin_tozihat4'];
                    }
                }
                else
                {
                    $st =$list['admin_tozihat4'];

                }

                return $st;
            }
        );


        $internalVariable['showstatus'] = $fields['status'];


        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
//        print_r_debug($export);
        echo json_encode($export);
        die();
    }
    /** submit khod arzyabi */
    function submitMyForm($fields)
    {
        global $messageStack, $admin_info, $dataStack;

        /** faaliat vazn  */
        include_once ROOT_DIR . 'component/group_list/model/group_list.model.php';

        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        include_once ROOT_DIR . 'component/faaliat/model/faaliat.model.php';

        foreach ($fields['menu'] as $fid => $columns)
        {
            $obj =  group_list::find($fid);
            if(STEP_FORM1 == 1){
                $obj->admin_percent1 = $columns[1];
                //$obj->cdate1 = date('Y-m-d');
            }elseif (STEP_FORM1 == 2){
                $obj->admin_percent2 = $columns[2];

                //$obj->cdate2 = date('Y-m-d');
            }elseif (STEP_FORM1 == 3){
                $obj->admin_percent3 = $columns[3];

                //$obj->cdate3 = date('Y-m-d');
            }elseif (STEP_FORM1 == 4) {
                $obj->admin_percent4 = $columns[4];
            }

            $obj->save();



            /** LOG  */
            if(isset($_POST['submit1'])){
                include_once ROOT_DIR . 'component/group_data/model/group_data.model.php';

                $obj1= new group_data();

                $obj1->admin_id = $obj->admin_id;
                $obj1->parent_id = $obj->parent_id;
                $obj1->faaliat_id = $obj->faaliat_id;
                $obj1->insert_date = date('Y-m-d H:i:s');
                $obj1->season = STEP_FORM1;

                if(STEP_FORM1 == 1){
                    $obj1->group_percent = $columns[1];
                }elseif (STEP_FORM1 == 2){
                    $obj1->group_percent = $columns[2];
                }elseif (STEP_FORM1 == 3){
                    $obj1->group_percent = $columns[3];
                }elseif (STEP_FORM1 == 4) {
                    $obj1->group_percent = $columns[4];
                }

                $obj1->save();

            }





            $obj2 = faaliat::find($obj->faaliat_id);

            $eghdam_id = $obj2->eghdam_id;

            /** save file */
            foreach ($_FILES['menu']['tmp_name'][$fid] as $k => $v){
                if($_FILES['menu']['tmp_name'][$fid][$k]){
                    $file['tmp_name'] = $_FILES['menu']['tmp_name'][$fid][$k];
                    $file['name'] = $_FILES['menu']['name'][$fid][$k];
                    $file['size'] = $_FILES['menu']['size'][$fid][$k];
                    $fieldName = 'admin_file'.$k;
                    //$type  = explode('/',$file['type']);
                    $input['max_size'] = $file['size'];
                    $input['new_name'] = 'faaliat-id-'.$obj->faaliat_id;
                    $input['upload_dir'] = ROOT_DIR."statics/files/{$admin_info['admin_id']}/season$k/$eghdam_id/";
                    fileRemover($input['upload_dir'], $obj->$fieldName);
                    $result = fileUploader($input,$file );

                    if ($result['result'] != 1)
                    {
//                        $msg='فایل  ارسالی شما مجاز نمی باشد.';\
                        $ms = $result['msg'];
                        $_SESSION['fileMessage'] = $ms;
                        $dataStack->add_session('data', $_POST);
                        $messageStack->add_session('message', $ms, 'error');
                        redirectPage(RELA_DIR . 'admin/?component=form&action=myForm', $ms);
                        die();
                    }
                    $obj->$fieldName = $result['image_name'];
                    $obj->save();

                }
            }
        }



        foreach ($fields['admin_tozihat'] as $fid => $columns) {
            $obj = group_list::find($fid);
            if(STEP_FORM1 == 1){
                $obj->admin_tozihat1 = $columns[1];
            }elseif (STEP_FORM1 == 2){
                $obj->admin_tozihat2 = $columns[2];
            }elseif (STEP_FORM1 == 3){
                $obj->admin_tozihat3 = $columns[3];
            }elseif (STEP_FORM1 == 4) {
                $obj->admin_tozihat4 = $columns[4];
            }
            $obj->save();
        }

        unset($_SESSION['fileMessage']);

        /** admin status = 1 */

        $adminObj = admin::find($admin_info['admin_id']);
        if(isset($_POST['submit'])){
            $adminObj->status = 1;
        }
        elseif(isset($_POST['submit1'])){
            $adminObj->status = 2;
        }
        elseif(isset($fields['submit2'])){
            $adminObj->status = 4;
        }

        if(STEP_FORM1 == 1) {
            $adminObj->cdate1 = date('Y-m-d');
        }elseif (STEP_FORM1 == 2){
            $adminObj->cdate2 = date('Y-m-d');
        }elseif (STEP_FORM1 == 3){
            $adminObj->cdate3 = date('Y-m-d');
        }elseif (STEP_FORM1 == 4) {
            $adminObj->cdate4 = date('Y-m-d');
        }
        $adminObj->save();





        //$dataStack->add_session('data',$_POST);
        $ms = 'عملیات با موفقیت انجام شد.';
        $messageStack->add_session('message', $ms, 'success');
        redirectPage(RELA_DIR . 'admin/?component=form&action=myForm', $ms);

        //print_r_debug($obj);


    }








    function chart()
    {
        global $admin_info, $messageStack, $dataStack;

        $list = '';
        $this->fileName = 'chart.php';
        $this->template($list);
        die();
    }



    function deleteFile($input){
        global $admin_info,$messageStack;



        include_once ROOT_DIR.'component/group_list/model/group_list.model.php';
        $obj = new group_list();
        $res = $obj->getAll()
            ->where('admin_id','=',$admin_info['admin_id'])
            ->andWhere('faaliat_id','=',$input['f'])
            ->get();

        if($res['export']['recordsCount']==0){
            $messageStack->add('message','یافت نشد','danger');
            $result['msg']    = 'یافت نشد';
            $result['result'] = -1;
            return $result;
        }

        $filename = $res['export']['list'][0]->fields['admin_file'.$input['s']];

        if(file_exists(ROOT_DIR.'statics/files/'.$admin_info['admin_id'].'/season'.$input['s'].'/'.$input['e'].'/'.$filename)){

            $input['upload_dir'] = ROOT_DIR.'statics/files/'.$admin_info['admin_id'].'/season'.$input['s'].'/'.$input['e'].'/';

            fileRemover($input['upload_dir'],$filename);

            $res['export']['list'][0]->{admin_file.$input['s']} = '';

            $res['export']['list'][0]->save();



        }

//        print_r_debug($input);


        $messageStack->add_session('message','فایل حذف شد.','success');

        $result['msg']    = 'فایل حذف شد.';
        $result['result'] = 1;
        return $result;

    }


}