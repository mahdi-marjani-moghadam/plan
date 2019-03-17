<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__)."/admin.rate.model.php");

/**
 * Class rate1Controller
 */
class adminRateController
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
    function template($list=array(),$msg='')
    {
        global $admin_info,$messageStack;


        if($msg == '')
        {
            $msg = $messageStack->output('message');
        }


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


    function myStaff($admin_id,$tt)
    {
        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $obj = new adminadminModel();
        $fields['where'] = " parent_id = $admin_id ";
        $result = $obj->getByFilter($fields);
//        print_r_debug($result);
        if($result['export']['recordsCount'] > 0)
        {
            foreach ($result['export']['list'] as $kk => $vv)
            {
                //echo "<pre>";
                $tt[] = $vv;
                //print_r($vv['admin_id']);
                //echo '....................';
                $tt = $this->myStaff($vv['admin_id'],$tt);
            }
        }

        return $tt;
    }

    /**
     * @param $fields
     */
    public function showList($fields)
    {
        global $admin_info;

        if($admin_info['semat'] != 'مرکز' )
        {
            redirectPage(RELA_DIR.'admin/?component=form','انتقال به فرم نظر سنجی');
        }

        $this->fileName='admin.rate1.showList.php';
        $this->template('');
        die();
    }

    public function search($fields)
    {
        global $admin_info;

        include_once(ROOT_DIR . "model/datatable.converter.php");
        $i=0;
        $columns = array(
            array( 'db' => 'admin_id', 'dt' =>$i++),

            array( 'db' => 'name', 'dt' =>$i++),
            array( 'db' => 'family', 'dt' =>$i++),
            /*array( 'db' => 'code_meli', 'dt' =>$i++),
            array( 'db' => 'posts', 'dt' => $i++ ),
            array( 'db' => 'vahed_asli',   'dt' => $i++),
            array( 'db' => 'vahed_fari', 'dt' => $i++ ),
            array( 'db' => 'semat', 'dt' => $i++ ),*/
            array( 'db' => 'status', 'dt' => $i++ ),

            array( 'db' => 'admin_id', 'dt' => $i++ )
        );
        $convert=new convertDatatableIO();
        $convert->input=$fields;
        $convert->columns=$columns;

        $searchFields= $convert->convertInput();




       /* $ttt = $this->myStaff($admin_info['admin_id'],'');
        if($ttt == '')
        {
            $ttt[] = $admin_info;
        }
        $admins = '';
        foreach ($ttt as $kk => $vv)
        {
            $admins.= ",".$vv['admin_id'];
        }
        $admins = substr($admins,1);*/
        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $obj = new adminadminModel();
        if($searchFields['filter'] == '')
        {
            $searchFields['where'] = " username <> 'مرکز' ";
        }
        else{
            $searchFields['where'] .= "  username <> 'مرکز' ";
        }

        $result = $obj->getByFilter($searchFields);

        //print_r_debug($searchFields);
        //$result = $artists->getArtists($searchFields);
        //print_r_debug($searchFields);



        $list['list']=$result['export']['list'];

        $list['paging']=$result['export']['recordsCount'];



        $other['8']=array(
            'formatter' =>function($list)
            {
                if($list['status']==0){$st='کارمند یا کارشناس یا کارشناس مسئول به خود نظری نداده';}
                else if($list['status']==1){$st='منتظر نظر مدیر بلافصل';}
                else if($list['status']==11){$st='منتظر نظر مدیر میانی';}
                else if($list['status']==111){$st='منتظر نظر تائید کننده نهایی';}
                return $st;
            }
        );

        $internalVariable['showstatus']=$fields['status'];
        $other[$i-1]=array(
            'formatter' =>function($list,$internal)
            {

                $st='<a href="'.RELA_DIR.'admin/?component=form&q=,'.$list['admin_id'].',">نمایش فرم</a>';
                return $st;
            }
        );

        $export= $convert->convertOutput($list,$columns,$other,$internalVariable);
        //print_r_debug($export);
        echo json_encode($export);
        die();
    }

    function showRate($id){

        global $admin_info,$messageStack;

        if($admin_info['semat'] != 'مرکز')
        {
            redirectPage(RELA_DIR.'admin/?component=rate&action=myRate','انتقال به فرم نظر سنجی');
        }


        /*$ttt = $this->myStaff($admin_info['admin_id'],'');
        if($ttt == '')
        {
            $ttt[] = $admin_info;
        }*/

        /*foreach ($ttt as $kk => $vv)
        {
            if($vv['admin_id'] == $id)
            {
                $check = 'true';
            }
        }

        if($check!= 'true')
        {
            $ms = 'عملیات ناموفق';
            $messageStack->add_session('message',$ms,'error');
            redirectPage(RELA_DIR.'admin/?component=rate',$ms);
        }*/


        include_once ROOT_DIR."component/admin/admin/model/admin.admin.model.php";

        $obj = adminadminModel::find($id);

        $ttt = adminadminModel::getAll()->getList()['export']['list'];


        //  get vazn
/*        include_once ROOT_DIR.'component/vazn/admin/model/admin.vazn.model.php';
        $obj2 = new adminVaznModel();
        $w['where'] = ' semat="'.$obj->fields['semat'].'" ';
        $res2 = $obj2->getByFilter($w);
        $vazn = $res2['export']['list'][0];*/

        $exists = array();

            /*if($obj->fields['status'] >= 11 or $obj->fields['semat'] == 'معاون')
            {*/

                //print_r_debug($_SESSION);
                global $dataStack;
                $post = $dataStack->output('data');

        //get data from database form1 or form2
        include_once ROOT_DIR . "component/form" . $obj->fields['form_id1'] . "/admin/model/admin.form" . $obj->fields['form_id1'] . ".model.php";
        if ($obj->fields['form_id1'] == 1) {
            $obj2 = new adminForm1Model();
        } else {
            $obj2 = new adminForm2Model();
        }
        $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' ';
        $res = $obj2->getByFilter($w);


        // earn vazn26 vazn27
       /* $count = 0;
        for($i=1;$i<=27;$i++)
        {
            if (($res['export']['list'][0]['menu'.$i] > 0 ) and $i >25)
            {

                $vazn['vazn'.$i] =$vazn['vazn'.$reserve[$i-26]];
            }
            else
            {
                if ($res['export']['list'][0]['menu'.$i] == 0 ){

                    $reserve[] = $i;
                }
            }
        }*/


        $exists['exists'] = $res['export']['list'];
        //////////////////////////////////////////////////////


        //get data from database form3 or form4
        include_once ROOT_DIR . "component/form" . $obj->fields['form_id2'] . "/admin/model/admin.form" . $obj->fields['form_id2'] . ".model.php";
        if ($obj->fields['form_id2'] == 3) {
            $obj2 = new adminForm3Model();
        } else {

            $obj2 = new adminForm4Model();
        }
        $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' and flag=1 ';
        $res = $obj2->getByFilter($w);
        $exists['exists2'] = $res['export']['list'];

        // earn vazn26 vazn27
        $count = 0;
        $reserve = '';

        for($u=1;$u<=27;$u++){
            //$vazn['vazn'.($u+27)] = $vazn['vazn'.$u];
        }
        for($u=1;$u<=27;$u++){
            $vazn['vazn'.($u+54)] = $vazn['vazn'.$u];
        }

        for($i=1;$i<=27;$i++)
        {
//            echo '<bre>'.$exists['exists2'][0]['menu'.$i];
            if (($exists['exists2'][0]['menu'.$i] > 0 ) and $i >25)
            {


                $vazn['vazn'.($i+54)] =$vazn['vazn'.$reserve[$i-26]];
            }
            else
            {
                if ($exists['exists2'][0]['menu'.$i] == 0 ){

                    $reserve[] = $i;
                }
            }
        }
        //print_r_debug($vazn);

        //////////////////////////////////////////////////////
        if(count($post)==0) {

            include_once ROOT_DIR . "component/rate" . $obj->fields['form_id3'] . "/admin/model/admin.rate" . $obj->fields['form_id3'] . ".model.php";
            if ($obj->fields['form_id3'] == 5) {
                $obj2 = new adminRate5Model();
            } else {

                $obj2 = new adminRate6Model();
            }
            $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' ';
            $res2 = $obj2->getByFilter($w);

            $exists['exists3'] = $res2['export']['list'][0];

            /*foreach ($res2['export']['list'] as $o=>$o2){
                for($p=1;$p<=27;$p++){
                    $exists['exists3'][0]['menu'.($p+27)] = $o2['menu'.$p];
                }
            }*/
//                    print_r_debug($exists);
            //  $exists['exists2'] = $res2['export']['list'];

        }
        else
        {

            /*//get data from database
            include_once ROOT_DIR . "component/form" . $obj->fields['form_id2'] . "/admin/model/admin.form" . $obj->fields['form_id2'] . ".model.php";

            if ($obj->fields['form_id2'] == 3) {
                $obj2 = new adminform3Model();
            } else {

                $obj2 = new adminRate4Model();
            }
            $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . '   ';
            $res = $obj2->getByFilter($w);

            print_r_debug($res);
            $exists['exists'] = $res['export']['list'];*/

            $count = 0;
            for($i=1;$i<28;$i++)
            {
                if ($post['menu'.$i] > 0 and $i >25)
                {
                    $vazn['vazn'.$i] =$vazn['vazn'.$reserve[$i-26]];
                }
                else
                {
                    if ($post['menu'.$i] == 0 ){
                        $reserve[] = $i;
                    }
                }
            }
            $exists['exists2'][] = $post;
        }



        foreach ($ttt as $key => $value){
            $admins['admins'][$value['admin_id']]['name'] = $value['name'];
            $admins['admins'][$value['admin_id']]['family'] = $value['family'];
        }
        $admins['admins'][$admin_info['admin_id']]['name'] = $admin_info['name'];
        $admins['admins'][$admin_info['admin_id']]['family'] = $admin_info['family'];



            /*}
            else
            {
                $ms = ' هنوز نظری به '.$obj->fields['name']. ' '.$obj->fields['family'].' داده نشده ';
                $messageStack->add_session('message',$ms,'error');
                redirectPage(RELA_DIR.'admin/?component=rate',$ms);
            }*/



        //print_r_debug($vazn);

        $tt = array_merge($exists,$admins,$vazn,$obj->fields,$post );

//        print_r_debug($tt);

        //print_r_debug($tt);
//        print_r_debug($this->fileName);
        $this->fileName='admin.rate'.$obj->fields['form_id3'].'.addForm.php';
        $this->template($tt);
        die();
    }
    function submitRate($fields)
    {
        global $admin_info, $messageStack, $dataStack;

        if($admin_info['semat'] != 'مرکز')
        {
            redirectPage(RELA_DIR.'admin/?component=form','انتقال به فرم نظر سنجی');
        }

        $id = $fields['admin'];
        //$ttt = $this->myStaff($admin_info['admin_id'], '');
        /*if($ttt == '')
        {
            $ttt[] = $admin_info;
        }*/


        /*foreach ($ttt as $kk => $vv) {
            if ($vv['admin_id'] == $id) {
                $check = 'true';
                $user = $vv;
            }
        }*/

        /*if ($check != 'true') {
            $ms = 'عملیات ناموفق';
            $messageStack->add_session('message', $ms, 'error');
            redirectPage(RELA_DIR . 'admin/?component=rate', $ms);
        }*/


        include_once ROOT_DIR."component/admin/admin/model/admin.admin.model.php";

        $obj = adminadminModel::find(handleData($_GET['id']));



        if(!is_object($obj)){
            $ms = 'کاربر یافت نشد.';
            $messageStack->add_session('message', $ms, 'error');
            redirectPage(RELA_DIR . 'admin/?component=rate', $ms);
        }

        //$ttt = adminadminModel::getAll()->getList()['export']['list'];



        // check submitted before
        include_once ROOT_DIR . 'component/rate' . $obj->fields['form_id3'] . '/admin/model/admin.rate' . $obj->fields['form_id3'] . '.model.php';
        if ($obj->fields['form_id3'] == 5) {

            $obj2 = new adminRate5Model();
            $w['where'] = ' admin_id = '.$obj->fields['admin_id'].' ';
            $res = $obj2->getByFilter($w);
            //print_r_debug($res);

        } else {
            $obj2 = adminRate6Model::find(handleData($_GET['id']));
            if(!is_object($obj2))
            {
                $obj2 = new adminRate6Model();
            }


        }



        /*$w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' and admin_id2=' . $admin_info['admin_id'] . ' ';
        $res = $obj->getByFilter($w);
        if ($res['export']['recordsCount'] > 0) {
            $ms = 'نظر شما ثبت شده است';
            $messageStack->add_session('message', $ms, 'warning');
            redirectPage(RELA_DIR . "admin/?component=rate&action=myRate&action=nazar&id={$user['admin_id']}", $ms);
        }*/


        //  get vazn
        /*include_once ROOT_DIR . 'component/vazn/admin/model/admin.vazn.model.php';
        $obj3 = new adminVaznModel();
        $w['where'] = ' semat="' . $admin_info['semat'] . '" ';
        $res2 = $obj3->getByFilter($w);
        $vazn = $res2['export']['list'][0];*/





        // check
        /*$count = $sumRate = $sematCount = 0;
        if ($admin_info['semat'] == 'معاون') {
            $sematCount = 0;
        } else if ($admin_info['semat'] == 'رئیس') {
            $sematCount = 27;
         } else if ($admin_info['semat'] == 'گروه') {
            $sematCount = 27;
        }*/
        $count = $sumRate = 0;
        for ($i = 1 ; $i <= 25 ; $i++) {
            //$res3 = $this->checkValueRate($fields['menu' . $i],$i);
            //if ($res3['result'] == 1) {
               // $count++;
                $rate['menu' . $i] = $fields['menu' . $i];
                //$sumRate += $fields['menu' . $i];
            //}
        }



        $obj2->setFields($rate);

        $obj2->Rate5_id = $res['export']['list'][0]['Rate5_id'];
        $obj2->admin_id = $obj->fields['admin_id'];
        $obj2->admin_id2 = $admin_info['admin_id'];
        $obj2->status= 1;
        $obj2->insert_date= date('Y-m-d');
//print_r_debug($obj2);
        //print_r_debug($obj2);

        //if($admin_info['semat'] == 'رئیس'){$obj->flag = 1;}else{$obj->flag = 0;}
        /*if(count($reserve) ==0){            $obj->newrow1= ''; $obj->newrow2= ''; $obj->newrow3= ''; $obj->newrow4= ''; }
        elseif (count($reserve) ==1){       $obj->newrow2= '';$obj->newrow4= ''; }*/


        $obj2->save();
        //print_r_debug($obj2);

        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        //$fields['where'] = ' admin_id = '.$user['admin_id'].' ';
        //$obj3= new adminadminModel();
        $res4 = adminadminModel::getBy_admin_id($obj->fields['admin_id'])->first();
        if($admin_info['semat'] == 'مرکز'){$res4->status = 2;}
        $res4->save();

        //print_r_debug($obj);


        $ms = 'نظر شما ثبت شد.';
        //$dataStack->add_session('data',$_POST);
        $messageStack->add_session('message',$ms,'success');
        redirectPage(RELA_DIR."admin/?component=rate&action=nazar&id={$obj->fields['admin_id']}",$ms);

    }
    public function search2($fields)
    {
        global $admin_info;


        include_once(ROOT_DIR . "model/datatable.converter.php");
        $i=0;
        $columns = array(
            array( 'db' => 'admin_id', 'dt' =>$i++),

            array( 'db' => 'kalan', 'dt' =>$i++),
            array( 'db' => 'amaliati', 'dt' =>$i++),
            array( 'db' => 'eghdam', 'dt' =>$i++),
            array( 'db' => 'eghdam_vazn', 'dt' => $i++ ),
            array( 'db' => 'eghdam_percent', 'dt' => $i++),
            array( 'db' => 'max_manager', 'dt' => $i++ ),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++),
            array( 'db' => 'admin_id', 'dt' =>$i++)
        );
        $convert=new convertDatatableIO();
        $convert->input=$fields;
        $convert->columns=$columns;
        $searchFields= $convert->convertInput();


        $ttt = $this->myStaff($admin_info['admin_id'],'');
        if($ttt == '')
        {
            $ttt[] = $admin_info;
        }
        $admins = '';
        foreach ($ttt as $kk => $vv)
        {
            $admins.= ",".$vv['admin_id'];
        }
        $admins = substr($admins,1);

        $obj = new adminadminModel();
        if($searchFields['filter'] == '')
        {
            $searchFields['where'] = " admin_id in ($admins) ";
        }
        else{
            $searchFields['where'] .= "  admin_id in ($admins) and ";
        }
        $query = 'SELECT
  `admin`.`admin_id`,
  `eghdam`.`kalan`,
  `eghdam`.`amaliati`,
  `eghdam`.`eghdam`,
  `eghdam_vazn1`.`eghdam_vazn`,
  `eghdam_vazn1`.`eghdam_percent`,
  `eghdam_vazn`.`manager1`,
  `eghdam_vazn`.`manager2`,
  `eghdam_vazn`.`manager3`
FROM
  `admin`
  INNER JOIN `eghdam_vazn` ON `eghdam_vazn`.`admin_id` = `admin`.`admin_id`
  INNER JOIN `eghdam` ON `eghdam`.`eghdam_id` = `eghdam_vazn`.`eghdam_id`
  INNER JOIN `eghdam_vazn` `eghdam_vazn1` ON `eghdam_vazn`.`eghdam_id` =
    `eghdam_vazn1`.`eghdam_id`';
        $result = $obj->getByFilter($searchFields,$query);
        //print_r_debug($result);
        //$result = $artists->getArtists($searchFields);
        //print_r_debug($searchFields);



        $list['list']=$result['export']['list'];

        $list['paging']=$result['export']['recordsCount'];

        include_once ROOT_DIR.'component/plan/model/plan.model.php';
        $obj = new plan();
        /*if($searchFields['filter'] == '')
        {
            $searchFields['where'] = " admin_id in ($admins) ";
        }
        else{
            $searchFields['where'] .= "  admin_id in ($admins) and ";
        }*/
        $query = '
SELECT
  `eghdam`.`kalan`,
  `eghdam`.`amaliati`,
  `eghdam`.`eghdam`,
  `eghdam_vazn`.`eghdam_vazn`,
  `faaliat_vazn`.`id` AS `fid`,
  `faaliat`.`faaliat`,
  `faaliat_vazn`.`faaliat_vazn`,
  `faaliat_vazn`.`admin_id`,
  `faaliat_vazn`.`admin_percent1`,
  `faaliat_vazn`.`admin_percent2`,
  `faaliat_vazn`.`admin_percent3`,
  `faaliat_vazn`.`admin_percent4`
FROM
  `eghdam`
  LEFT JOIN `eghdam_vazn` ON `eghdam`.`eghdam_id` = `eghdam_vazn`.`eghdam_id`
  LEFT JOIN `faaliat` ON `eghdam`.`eghdam_id` = `faaliat`.`eghdam_id`
  LEFT JOIN `faaliat_vazn` ON `faaliat_vazn`.`faaliat_id` =
    `faaliat`.`faaliat_id` AND `faaliat_vazn`.`admin_id` =
    `eghdam_vazn`.`admin_id`
    ';
        $result = $obj->getByFilter('',$query);
//        print_r_debug($result);
        //$result = $artists->getArtists($searchFields);
        //print_r_debug($searchFields);



        $list['list']=$result['export']['list'];

        $list['paging']=$result['export']['recordsCount'];


        $other['7']=array(
            'formatter' =>function($list)
            {
                $plan_id=$list['fid'];
                $file_name = $_FILES['UploadedFile']['name'];
                $st = "<input name='menu[$plan_id][]' type='text' value=''>";
                $st .= "<input  name='menu[$plan_id][]' type='file' >";

                return $st;
            }
        );

        $other['8']=array(
            'formatter' =>function($list)
            {
                $plan_id=$list['plan_id'];
                $st = "<input name='menu[$plan_id][]' type='text' value=''>";
                $st .= "<input  name='menu[$plan_id][]' type='file' >";
                return $st;
            }
        );

        $other['9']=array(
            'formatter' =>function($list)
            {
                $plan_id=$list['plan_id'];
                $st = "<input name='menu[$plan_id][]' type='text' value=''>";
                $st .= "<input  name='menu[$plan_id][]' type='file' >";
                return $st;
            }
        );

        $other['10']=array(
            'formatter' =>function($list)
            {
                $plan_id=$list['plan_id'];
                $st = "<input name='menu[$plan_id][]' type='text' value=''>";
                $st .= "<input  name='menu[$plan_id][]' type='file' >";                return $st;
            }
        );




        $internalVariable['showstatus']=$fields['status'];
        $other[$i-1]=array(
            'formatter' =>function($list,$internal)
            {
                global $admin_info;

                $result = $this->checkAccess($list['admin_id'],$admin_info['admin_id']);

                if($result['result'] == 1 ){
                    $check = 1;
                }


                if($check == 1)
                {
                    $st='<a href="'.RELA_DIR.'admin/?component=form&action=nazar&id='.$list['admin_id'].'">نمایش فرم</a>';
                }

                return $st;
            }
        );

        $export= $convert->convertOutput($list,$columns,$other,$internalVariable);
        //print_r_debug($export);
        echo json_encode($export);
        die();
    }



    function showResult($id){
        global $admin_info,$messageStack;

        //print_r_debug($_GET);

        $ttt = $this->myStaff($admin_info['admin_id'],'');
        if($ttt == '')
        {
            $ttt[] = $admin_info;
        }

        foreach ($ttt as $kk => $vv)
        {
            if($vv['admin_id'] == $id)
            {
                //$check = 'true';
            }
        }
//print_r_debug($ttt);
        //if($check!= 'true')
        //{
         //   $ms = 'عملیات ناموفق';
          //  $messageStack->add_session('message',$ms,'error');
          //  redirectPage(RELA_DIR.'admin/?component=rate',$ms);
        //}



        include_once ROOT_DIR."component/admin/admin/model/admin.admin.model.php";

        $obj = adminadminModel::find($id);

        //$ttt = adminadminModel::getAll()->getList()['export']['list'];

        $result = $this->checkAccess($id,$admin_info['admin_id']);

        if($result['result'] == -1 ){
            $messageStack->add_session('message',$result['msg'],'error');
            redirectPage(RELA_DIR.'admin/?component=form',$result['msg']);
        }
        else if($result['result'] == -2 ){
            $messageStack->add_session('message',$result['msg'],'error');
            redirectPage(RELA_DIR.'admin/',$result['msg']);
        }
        else if($result['result'] == -3 ){
            $messageStack->add_session('message',$result['msg'],'error');
            redirectPage(RELA_DIR.'admin/',$result['msg']);
        }
        //if($admin_info['admin_id'] == $id)
        //{
          //  $messageStack->add_session('message','انتقال به صفحه خود ارزیابی','error');
            //redirectPage(RELA_DIR.'admin/?component=form&action=myForm',$result['msg']);
        //}
        //print_r_debug($obj);

        //  get vazn
        include_once ROOT_DIR.'component/vazn/admin/model/admin.vazn.model.php';
        $obj2 = new adminVaznModel();
        $w['where'] = ' semat="'.$obj->fields['semat'].'" ';
        $res2 = $obj2->getByFilter($w);
        $vazn = $res2['export']['list'][0];

        $exists = array();

        $semat = 0;
        $start = 0;
        if($admin_info['admin_id'] == $obj->fields['admin1']){ $semat = 1;}
        else if($admin_info['admin_id'] == $obj->fields['admin2']){ $semat = 2;}
        else if($admin_info['admin_id'] == $obj->fields['admin3']){ $semat = 3;$start = 27;}

        /*if($obj->fields['status'] >= 11 or $obj->fields['semat'] == 'معاون')
        {*/

        //print_r_debug($_SESSION);


        //get data from database form1 or form2
        include_once ROOT_DIR . "component/form" . $obj->fields['form_id1'] . "/admin/model/admin.form" . $obj->fields['form_id1'] . ".model.php";
        if ($obj->fields['form_id1'] == 1) {
            $obj2 = new adminForm1Model();
        } else {

            $obj2 = new adminForm2Model();
        }
        $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' ';
        $res = $obj2->getByFilter($w);


        // earn vazn26 vazn27
        $count = 0;
        for($i=1;$i<28;$i++)
        {
            if (($res['export']['list'][0]['menu'.$i] > 0 ) and $i >25)
            {

                $vazn['vazn'.$i] =$vazn['vazn'.$reserve[$i-26]];
            }
            else
            {
                if ($res['export']['list'][0]['menu'.$i] == 0 ){

                    $reserve[] = $i;
                }
            }
        }

        $exists['exists'] = $res['export']['list'];
        //////////////////////////////////////////////////////


        //get data from database form3 or form4
        include_once ROOT_DIR . "component/form" . $obj->fields['form_id2'] . "/admin/model/admin.form" . $obj->fields['form_id2'] . ".model.php";
        if ($obj->fields['form_id2'] == 3) {
            $obj2 = new adminForm3Model();
        } else {

            $obj2 = new adminForm4Model();
        }
        $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' and flag =1 ';
        $res = $obj2->getByFilter($w);
        $exists['exists2'] = $res['export']['list'];

        for($u=1;$u<=27;$u++){
            //$vazn['vazn'.($u+27)] = $vazn['vazn'.$u];
        }
        for($u=1;$u<=27;$u++){
            $vazn['vazn'.($u+54)] = $vazn['vazn'.$u];
        }

        // earn vazn26 vazn27
        $count = 0;
        $reserve = '';
        for($i=1;$i<=27;$i++)
        {
            if (($exists['exists2'][0]['menu'.$i] > 0 ) and $i >25)
            {

                $vazn['vazn'.($i+54)] =$vazn['vazn'.$reserve[$i-26]];
            }
            else
            {
                if ($exists['exists2'][0]['menu'.$i] == 0 ){

                    $reserve[] = $i;
                }
            }
        }
        //  print_r_debug($reserve);
        //////////////////////////////////////////////////////


            include_once ROOT_DIR . "component/rate" . $obj->fields['form_id3'] . "/admin/model/admin.rate" . $obj->fields['form_id3'] . ".model.php";
            if ($obj->fields['form_id3'] == 5) {
                $obj2 = new adminRate5Model();
            } else {

                $obj2 = new adminRate6Model();
            }
            $w['where'] = ' admin_id=' . $obj->fields['admin_id'] . ' ';
            $res2 = $obj2->getByFilter($w);

            $exists['exists3'] = $res2['export']['list'][0];

            /*foreach ($res2['export']['list'] as $o=>$o2){
                for($p=1;$p<=27;$p++){
                    $exists['exists3'][0]['menu'.($p+27)] = $o2['menu'.$p];
                }
            }*/
//                    print_r_debug($exists);
            //  $exists['exists2'] = $res2['export']['list'];




        $tt = adminadminModel::getAll()->getList()['export']['list'];
        foreach ($tt as $key => $value){
            $admins['admins'][$value['admin_id']]['name'] = $value['name'];
            $admins['admins'][$value['admin_id']]['family'] = $value['family'];
        }
        $admins['admins'][$admin_info['admin_id']]['name'] = $admin_info['name'];
        $admins['admins'][$admin_info['admin_id']]['family'] = $admin_info['family'];



        /*}
        else
        {
            $ms = ' هنوز نظری به '.$obj->fields['name']. ' '.$obj->fields['family'].' داده نشده ';
            $messageStack->add_session('message',$ms,'error');
            redirectPage(RELA_DIR.'admin/?component=rate',$ms);
        }*/
        // emza
        include_once ROOT_DIR . "component/form" . $obj->fields['form_id2'] . "/admin/model/admin.form" . $obj->fields['form_id2'] . ".model.php";
        if ($obj->fields['form_id2'] == 3) {
            $obj2 = new adminForm3Model();
        } else {

            $obj2 = new adminForm4Model();
        }
        $w['where'] = ' admin_id = '.$obj->fields['admin_id'].' and admin_id2 = ' . $obj->fields['admin1'] .' ';
        $res = $obj2->getByFilter($w);
        $exists['emza'][0] = $res['export']['list'][0];

        $w['where'] = ' admin_id = '.$obj->fields['admin_id'].' and admin_id2 = ' . $obj->fields['admin2'] .' ';
        $res = $obj2->getByFilter($w);
        $exists['emza'][1] = $res['export']['list'][0];


        $w['where'] = ' admin_id = '.$obj->fields['admin_id'].' and admin_id2 = ' . $obj->fields['admin3'] .' ';
        $res = $obj2->getByFilter($w);
        $exists['emza'][2] = $res['export']['list'][0];

        $tt = array_merge($exists,$admins,$vazn,$obj->fields );

//        print_r_debug($tt);


        //print_r_debug($tt);
//        print_r_debug($this->fileName);
        $this->fileName='admin.rate'.$obj->fields['form_id4'].'.addForm.php';
        $this->template($tt);
        die();
    }
    function checkValue($val)
    {
        $arr = array(4,3.2,2.4,1.6,0.8,0);
        if(in_array($val,$arr))
        {
            $res['result']= 1;
            return $res;
        }
        else
        {
            $res['result']= -1;
            return $res;
        }
    }
    /*function checkValueRate($val,$i)
    {
        //$arr = array(4,3.2,2.4,1.6,0.8,0);
        if($i == 2 and $val > 0 and $val < )
        {

            $res['result']= 1;
            return $res;
        }
        else
        {
            $res['result']= -1;
            return $res;
        }
    }*/
    function checkAccess($id,$admin_id2)
    {
        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $obj1 = adminadminModel::find($id);
        //$obj2 = adminadminModel::find($admin_id2);

        //if($id == $admin_id2){ $res['result'] = -2;$res['msg'] = 'لطفا فرم نظرسنجی خود را پرنمایید'; return $res; }

        $status1 =  $obj1->fields['status'];
        //$semat1 =  $obj1->fields['semat'];

        //$semat2  =  $obj2->fields['semat'];

        if($id != $admin_id2 && $admin_id2 != $obj1->fields['admin1'] && $admin_id2 != $obj1->fields['admin2'] && $admin_id2 != $obj1->fields['admin3']){
            $res['result'] = -3;$res['msg'] = 'شما اجازه  دسترسی به این فرد را ندارید.'; return $res;
        }
        else if($id == $admin_id2 && $obj1->fields['status'] == 2){$res['result']=1;return $res;}
        else if($id == $admin_id2 && $obj1->fields['status'] != 2){$res['result']=-3;$res['msg']='در حال بررسی توسط مرکز ارزیابی و پایش عملکرد.';return $res;}
        //echo $id.'='.$admin_id2.'-'.$obj1->fields['status'];die();

        $msg = array(0=> 'کارمند یا کارشناس',1=>'مدیر بلافصل',11=>'مدیر میانی',111=>'مدیر',1111=>'مرکز');

        /// 1
        if($obj1->fields['admin1'] == $admin_id2  ){
            if($status1 == 0 || $status1 == 1){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 11){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 111){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 1111){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
        }
        /// 2
        else if($obj1->fields['admin2'] == $admin_id2  ){
            if($status1 == 11 ){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 111){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 1111){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
        }
        /// 3
        else if($obj1->fields['admin3'] == $admin_id2  ){
            if($status1 == 111 ){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 1111){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            if($status1 == 2){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
        }

        if($res['result'] != 1){
            $res['result'] = -1;
            $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';
        }




        /*if($semat1 == 'کارشناس' || $semat1 == 'کارمند' || $semat1 == 'کارشناس_مسئول'){
            $msg = array(0=> 'کارمند یا کارشناس',1=>'رئیس اداره',11=>'معاون',111=>'رئیس',1111=>'مرکز');
            if($status1 == 0 && $semat2 == 'رئیس_اداره' ){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            else if($status1 >= 1 && $semat2 == 'رئیس_اداره'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else if($status1 >= 11 && $semat2 == 'معاون'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else if($status1 >= 111 && $semat2 == 'رئیس'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else if($status1 >= 1111 && $semat2 == 'مرکز'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else{
                $res['result'] = -1;
                $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';
            }
        }
        else if($semat1 == 'رئیس_اداره'){
            $msg = array(0=>'رئیس اداره',1=>'رئیس اداره',11=>'معاون',111=>'رئیس',1111=>'مرکز');

            if($status1 >= 11  && $semat2 == 'معاون'){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            else if($status1 >= 111 && $semat2 == 'رئیس'){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            else if($status1 >= 1111 && $semat2 == 'مرکز'){ $res['result'] = 1;$res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.'; }
            else{
                $res['result'] = -1;
                $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';
            }
        }
        else if($semat1 == 'معاون'){
            $msg = array(0=>'معاون',111=>'رئیس',1111=>'مرکز');
            if($status1 >= 111 && $semat2 == 'رئیس'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else if($status1 >= 1111 && $semat2 == 'مرکز'){ $res['result'] = 1; $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';}
            else{
                $res['result'] = -1;
                $res['msg'] ='هنوز '.$msg[$status1].' نظری نداده اند.';
            }
        }*/

//        print_r_debug($res);
        return $res;


    }

}
?>