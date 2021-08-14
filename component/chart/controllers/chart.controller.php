<?php
include_once dirname(__FILE__).'/chart.model.php';

class chartController
{
    public $exportType;
    public $fileName;
    private $_season;
    private $_result;
    public function __construct()
    {
        $this->exportType = 'html';
        $this->_season = (isset($_GET['s']))?handleData($_GET['s']):1;
        $this->_result = (isset($_GET['r']))?handleData($_GET['r']):1;
    }
    public function template($list = array(), $msg='')
    {
        global $messageStack,$admin_info;
        extract($list);
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

    public function categoryName($season,$result){
        if($season >= 1) {
            if(in_array($result,[1,3])){
                $i = (in_array($result,[2]))?0:0;
                $temp2[$i]['name'] = 'خود اظهاری سه ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )){
                $i = (in_array($result,[2]))?0:1;
                $temp2[$i]['name'] = 'نهایی سه ماهه';
                $temp2[$i]['color'] = '#654c97';
            }

        }
        if($season >= 2){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?1:2;
                $temp2[$i]['name'] = 'خود اظهاری شش ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?1:3;
                $temp2[$i]['name'] = 'نهایی شش ماهه';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if($season >= 3){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?2:4;
                $temp2[$i]['name'] = 'خود اظهاری نه ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?2:5;
                $temp2[$i]['name'] = 'نهایی نه ماهه';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if($season >= 4){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?3:6;
                $temp2[$i]['name'] = 'خود اظهاری یکساله';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?3:7;
                $temp2[$i]['name'] = 'نهایی یکساله';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        return $temp2;
    }

    private function showAdmin()
    {
        global $admin_info;
        if($admin_info['parent_id'] == 0){
            include_once ROOT_DIR.'component/admin/model/admin.model.php';
            $objAdmin = new admin();
            $result3 = $objAdmin->getAll()
                ->select('admin_id,name,family');


            if($_GET['action']  == 'g1' || $_GET['action']  == 'g2'){
                $result3 = $result3->where('parent_id','not in','0,1')->andWhere('group_admin','=',0);
            }else if($_GET['action']  == 'v1' || $_GET['action']  == 'v2' || $_GET['action']  == 'v3' || $_GET['action']  == 'v4'){
                $result3 = $result3->where('parent_id','not in','0,1')->andWhere('group_admin','=',1)->andWhere('parent_id','not in','0,1');
            }else if($_GET['action']  == '1'){
                $result3 = $result3->Where('flag','in','3,13');
            }
            $result3 = $result3->getList();

            $list['showAdmin'] = $result3['export']['list'];
            return $list['showAdmin'];
        }
        return true;

    }
    private function getParentIdByAdminId($admin_id){
        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $adminObj = new admin();
        $parent = $adminObj->getAll()->select('parent_id')->where('admin_id','=',$admin_id)->getList()['export']['list'][0]['parent_id'];
        return $parent;
    }

    public function groupChart1()
    {
        global $admin_info;

        $parent = $admin_info['parent_id'];
        $admin_id = $admin_info['admin_id'];
        if($admin_info['parent_id'] == 0){
            if(isset($_GET['qq'])){
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'],','));
                $admin_id = trim($_GET['qq'],',');
            }
        }
        
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        $temp2 = $this->categoryName($season,$result);

        $tempCat = array();


        foreach ($report['kalans'] as $kalan){

            if(!isset($kalan['admins'][$parent]['groups'][$admin_id])){continue;}

            $tempCat[] =  $kalan['kalan_name'];

            if($season >= 1){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?0:0;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['QQ1'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['Q1'],0,5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['QQ2'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?1:3;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['Q2'],0,5);
                }
            }
            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['QQ3'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?2:5;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['Q3'],0,5);
                }
            }
            if($season >=4){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['QQ4'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?3:7;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['groups'][$admin_id]['Q4'],0,5);
                }
            }



        }//next kalan





        $charts[0]['name'] = 'مقایسه اهداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );

        $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function groupChart2()
    {
        $season = $this->_season;
        $result = $this->_result;

        global $admin_info;
        if($admin_info['parent_id'] == 0 && $_GET['qq']){
            $_GET['q'] = $_GET['qq'];
        }

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();

        foreach ($report['kalans'] as $kalan_no => $kalan){
            $tempCat = $temp2 = array();

            $temp2 = $this->categoryName($season,$result);

            foreach ($kalan['amaliatis'] as $amaliati){
                foreach ($amaliati['eghdams'] as $eghdam){


                    $tempCat[] =  ($eghdam['eghdam_name']);


                    foreach ($eghdam['admins'] as $admins){
                        foreach ($admins['groups'] as $group){


                            if($season >= 1){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?0:0;
                                    $temp2[$i]['data'][] = (float) substr($group['RR1'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?0:1;
                                    $temp2[$i]['data'][] = (float) substr($group['R1'],0,5);
                                }
                            }
                            if($season >= 2){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?1:2;
                                    $temp2[$i]['data'][] = (float) substr($group['RR2'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?1:3;
                                    $temp2[$i]['data'][] = (float) substr($group['R2'],0,5);
                                }
                            }
                            if($season >= 3){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?2:4;
                                    $temp2[$i]['data'][] = (float) substr($group['RR3'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?2:5;
                                    $temp2[$i]['data'][] = (float) substr($group['R3'],0,5);
                                }
                            }
                            if($season >=4){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?3:6;
                                    $temp2[$i]['data'][] = (float) substr($group['RR4'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?3:7;
                                    $temp2[$i]['data'][] = (float) substr($group['R4'],0,5);
                                }
                            }
                        }
                    }


                }// net eghdam

            }// next amaliati

            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan

        $list['showAdmin'] = $this->showAdmin();


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function vahedChart1()
    {
        global $admin_info;

        $parent = $admin_info['parent_id'];
        $admin_id = $admin_info['admin_id'];
        if($admin_info['parent_id'] == 0){
            if(isset($_GET['qq'])){
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'],','));
                $admin_id = trim($_GET['qq'],',');
            }
        }

        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        
        $charts = array();
        foreach ($report['kalans'] as $kalan_no => $kalan){
            // dd($kalan['admins']);
            if(!isset($kalan['admins'][$parent])){continue;}
            // dd($report['kalans']);
            $tempCat = $temp2 = array();
            
            $temp2 = $this->categoryName($season,$result);

                    foreach ($kalan['admins'] as $admins){
                        foreach ($admins['groups'] as $group_id => $group){
                            if(!isset($kalan['admins'][$parent]['groups'][$group_id])){continue;}

                            $tempCat[] =  $group['group_name'].' '.$group['group_family'];

                            if($season >= 1){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?0:0;
                                    $temp2[$i]['data'][] = (float) substr($group['QQ1'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?0:1;
                                    $temp2[$i]['data'][] = (float) substr($group['Q1'],0,5);
                                }
                            }
                            if($season >= 2){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?1:2;
                                    $temp2[$i]['data'][] = (float) substr($group['QQ2'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?1:3;
                                    $temp2[$i]['data'][] = (float) substr($group['Q2'],0,5);
                                }
                            }
                            if($season >= 3){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?2:4;
                                    $temp2[$i]['data'][] = (float) substr($group['QQ3'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?2:5;
                                    $temp2[$i]['data'][] = (float)substr($group['Q3'], 0, 5);
                                }
                            }
                            if($season >=4){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?3:6;
                                    $temp2[$i]['data'][] = (float) substr($group['QQ4'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?3:7;
                                    $temp2[$i]['data'][] = (float)substr($group['Q4'], 0, 5);
                                }
                            }

                        }
                    }


            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan


        $list['showAdmin'] = $this->showAdmin();

     
        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function vahedChart1old()
    {
        //TODO get season
        $season = 1;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['list'] as $kalan){

            $tempCat = $temp2 = array();

            $temp2[0]['name'] = 'خود اظهاری 1';
            $temp2[0]['color'] = '#45639b';
            $temp2[1]['name'] = '(نهایی (تایید شده 1';
            $temp2[1]['color'] = '#654c97';
            $temp2[2]['name'] = 'خود اظهاری 2';
            $temp2[2]['color'] = '#45639b';
            $temp2[3]['name'] = '(نهایی (تایید شده 2';
            $temp2[3]['color'] = '#654c97';
            $temp2[4]['name'] = 'خود اظهاری 3';
            $temp2[4]['color'] = '#45639b';
            $temp2[5]['name'] = '(نهایی (تایید شده 3';
            $temp2[5]['color'] = '#654c97';
            $temp2[6]['name'] = 'خود اظهاری 4';
            $temp2[6]['color'] = '#45639b';
            $temp2[7]['name'] = '(نهایی (تایید شده 4';
            $temp2[7]['color'] = '#654c97';


            foreach ($kalan['admins'] as $admins){
                foreach ($admins['group'] as $group){

                    $tempCat[] =  $group['name'].' '.$group['family'];


                    $temp2[0]['data'][] = (float) substr($group['QQ1'],0,5);
                    $temp2[1]['data'][] = (float) substr($group['Q1'],0,5);
                    $temp2[2]['data'][] = (float) substr($group['QQ2'],0,5);
                    $temp2[3]['data'][] = (float) substr($group['Q2'],0,5);
                    $temp2[4]['data'][] = (float) substr($group['QQ3'],0,5);
                    $temp2[5]['data'][] = (float) substr($group['Q3'],0,5);
                    $temp2[6]['data'][] = (float) substr($group['QQ4'],0,5);
                    $temp2[7]['data'][] = (float) substr($group['Q4'],0,5);
                }
            }



            $charts[$kalan['kalan_no']]['name'] = $kalan['kalan'];
            $charts[$kalan['kalan_no']]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan['kalan_no']]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan

        $list['showAdmin'] = $this->showAdmin();


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function vahedChart2()
    {
        global $admin_info;

        $parent = $admin_info['parent_id'];
        $admin_id = $admin_info['admin_id'];
        if($admin_info['parent_id'] == 0){
            if(isset($_GET['qq'])){
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'],','));
                $admin_id = trim($_GET['qq'],',');
            }
        }

        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan){
            foreach ($kalan['amaliatis'] as $amaliati){
                foreach ($amaliati['eghdams'] as $eghdam_id => $eghdam){
                    if(!isset($eghdam['admins'][$parent])){continue;}

                    $tempCat = $temp2 = array();

                    $temp2 = $this->categoryName($season,$result);
                    
                    foreach ($eghdam['admins'] as $admins){
                        foreach ($admins['groups'] as $group_id => $group){

                            //print_r_debug($eghdam['admins'][$parent]['groups'][$group_id]);
                            if(!isset($eghdam['admins'][$parent]['groups'][$group_id])){continue;}

                            $tempCat[] =  $group['group_name'].' '.$group['group_family'];

                            if($season >= 1){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?0:0;
                                    $temp2[$i]['data'][] = (float) substr($group['RR1'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?0:1;
                                    $temp2[$i]['data'][] = (float) substr($group['R1'],0,5);
                                }
                            }
                            if($season >= 2){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?1:2;
                                    $temp2[$i]['data'][] = (float) substr($group['RR2'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?1:3;
                                    $temp2[$i]['data'][] = (float) substr($group['R2'],0,5);
                                }
                            }
                            if($season >= 3){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?2:4;
                                    $temp2[$i]['data'][] = (float) substr($group['RR3'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?2:5;
                                    $temp2[$i]['data'][] = (float)substr($group['R3'], 0, 5);
                                }
                            }
                            if($season >=4){
                                if(in_array($result,[1,3])){
                                    $i = (in_array($result,[3]))?3:6;
                                    $temp2[$i]['data'][] = (float) substr($group['RR4'],0,5);
                                }
                                if(in_array($result,[1,2] )) {
                                    $i = (in_array($result,[2]))?3:7;
                                    $temp2[$i]['data'][] = (float)substr($group['R4'], 0, 5);
                                }
                            }
                            
                        }//next group
                    }//next admin

                    $charts[$eghdam_id]['name'] = $eghdam['eghdam_name'];
                    $charts[$eghdam_id]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
                    $charts[$eghdam_id]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );
                }//next eghdam
            }//next amaliati
        }//next kalan


        $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function vahedChart3()
    {
        $season = $this->_season;
        $result = $this->_result;

        global $admin_info;
        $parent = $admin_info['parent_id'];

        if($admin_info['parent_id'] == 0){
            if(isset($_GET['qq'])){
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'],','));
            }
        }

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no => $kalan){

            if(!isset($kalan['admins'][$parent])){continue;}

            $tempCat = $temp2 = array();

            $temp2 = $this->categoryName($season,$result);

            foreach ($kalan['amaliatis'] as $amaliati){
                foreach ($amaliati['eghdams'] as $eghdam){

                    if(!isset($eghdam['admins'][$parent]['CC1'])){continue;}
                    $tempCat[] =  ($eghdam['eghdam_name']);


                    //print_r_debug($eghdam['admins'][$parent]['CC1']);

                    if($season >= 1){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?0:0;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['CC1'],0,5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?0:1;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['C1'],0,5);
                        }
                    }
                    if($season >= 2){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?1:2;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['CC2'],0,5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?1:3;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['C2'],0,5);
                        }
                    }
                    if($season >= 3){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?2:4;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['CC3'],0,5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?2:5;
                            $temp2[$i]['data'][] = (float)substr($eghdam['admins'][$parent]['C3'], 0, 5);
                        }
                    }
                    if($season >=4){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?3:6;
                            $temp2[$i]['data'][] = (float) substr($eghdam['admins'][$parent]['CC4'],0,5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?3:7;
                            $temp2[$i]['data'][] = (float)substr($eghdam['admins'][$parent]['C4'], 0, 5);
                        }
                    }


                    /*foreach ($eghdam['admins'] as $admins){
                        if($season >= 1){
                            if(in_array($result,[1,3])){
                                $i = (in_array($result,[3]))?0:0;
                                $temp2[$i]['data'][] = (float) substr($admins['CC1'],0,5);
                            }
                            if(in_array($result,[1,2] )) {
                                $i = (in_array($result,[2]))?0:1;
                                $temp2[$i]['data'][] = (float) substr($admins['C1'],0,5);
                            }
                        }
                        if($season >= 2){
                            if(in_array($result,[1,3])){
                                $i = (in_array($result,[3]))?1:2;
                                $temp2[$i]['data'][] = (float) substr($admins['CC2'],0,5);
                            }
                            if(in_array($result,[1,2] )) {
                                $i = (in_array($result,[2]))?1:3;
                                $temp2[$i]['data'][] = (float) substr($admins['C2'],0,5);
                            }
                        }
                        if($season >= 3){
                            if(in_array($result,[1,3])){
                                $i = (in_array($result,[3]))?2:4;
                                $temp2[$i]['data'][] = (float) substr($admins['CC3'],0,5);
                            }
                            if(in_array($result,[1,2] )) {
                                $i = (in_array($result,[2]))?2:5;
                                $temp2[$i]['data'][] = (float)substr($admins['C3'], 0, 5);
                            }
                        }
                        if($season >=4){
                            if(in_array($result,[1,3])){
                                $i = (in_array($result,[3]))?3:6;
                                $temp2[$i]['data'][] = (float) substr($admins['CC4'],0,5);
                            }
                            if(in_array($result,[1,2] )) {
                                $i = (in_array($result,[2]))?3:7;
                                $temp2[$i]['data'][] = (float)substr($admins['C4'], 0, 5);
                            }
                        }
                    }*/ // next admin
                }// next eghdam
            }// next amaliati

            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan


        $list['showAdmin'] = $this->showAdmin();


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function vahedChart4()
    {
        global $admin_info;

        $parent = $admin_info['parent_id'];

        if($admin_info['parent_id'] == 0){
            if(isset($_GET['qq'])){
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'],','));
            }
        }

        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();


        $tempCat = array();

        $temp2 = $this->categoryName($season,$result);

        foreach ($report['kalans'] as $kalan){
            if(!isset($kalan['admins'][$parent])){continue;}


            $tempCat[] =  $kalan['kalan_name'];

            if($season >= 1){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?0:0;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['GG1'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['G1'],0,5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['GG2'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?1:3;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['G2'],0,5);
                }
            }
            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['GG3'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?2:5;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['G3'],0,5);
                }
            }
            if($season >=4){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['GG4'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?3:7;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$parent]['G4'],0,5);
                }
            }



        }//next kalan




        $charts[0]['name'] = 'مقایسه اهداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );

        $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }
    public function managerChart1()
    {
        $season = $this->_season;
        $result = $this->_result;

        if(isset($_GET['qq'])){$adminid = trim($_GET['qq'],',');}

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no =>$kalan){

            if( isset($adminid) && !isset($kalan['admins'][$adminid])){continue;}
            $tempCat = $temp2 = array();

            $temp2 = $this->categoryName($season,$result);


            foreach ($kalan['admins'] as $admin_id =>  $admins){

                if(isset($adminid) && $adminid != $admin_id ){continue;}

                if($admins['flag'] == 3 || $admins['flag'] == 13) {

                    $tempCat[] = $admins['admin_name'] . ' ' . $admins['admin_family'];
                    if($season >= 1){
                        if(in_array($result,[1,3])) {
                            $i = (in_array($result, [3])) ? 0 : 0;
                            $temp2[$i]['data'][] = (float)substr($admins['GG1'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?0:1;
                            $temp2[$i]['data'][] = (float)substr($admins['G1'], 0, 5);
                        }
                    }
                    if($season >= 2){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?1:2;
                            $temp2[$i]['data'][] = (float)substr($admins['GG2'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 1 : 3;
                            $temp2[$i]['data'][] = (float)substr($admins['G2'], 0, 5);
                        }
                    }
                    if($season >= 3){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?2:4;
                            $temp2[$i]['data'][] = (float)substr($admins['GG3'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 2 : 5;
                            $temp2[$i]['data'][] = (float)substr($admins['G3'], 0, 5);
                        }
                    }
                    if($season >= 4) {
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?3:6;
                            $temp2[$i]['data'][] = (float)substr($admins['GG4'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 3 : 7;
                            $temp2[$i]['data'][] = (float)substr($admins['G4'], 0, 5);
                        }
                    }
                }

            }



            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan

        $list['showAdmin'] = $this->showAdmin();


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }


    public function managerChart2()
    {
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        $tempCat = $temp2 = array();

        $temp2 = $this->categoryName($season,$result);
        foreach ($report['kalans'] as $kalan_no =>$kalan){



                $tempCat[] =  ($kalan['kalan_name']);

                    if($season >= 1){
                        if(in_array($result,[1,3])) {
                            $i = (in_array($result, [3])) ? 0 : 0;
                            $temp2[$i]['data'][] = (float)substr($kalan['HH1'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result,[2]))?0:1;
                            $temp2[$i]['data'][] = (float)substr($kalan['H1'], 0, 5);
                        }
                    }
                    if($season >= 2){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?1:2;
                            $temp2[$i]['data'][] = (float)substr($kalan['HH2'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 1 : 3;
                            $temp2[$i]['data'][] = (float)substr($kalan['H2'], 0, 5);
                        }
                    }
                    if($season >= 3){
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?2:4;
                            $temp2[$i]['data'][] = (float)substr($kalan['HH3'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 2 : 5;
                            $temp2[$i]['data'][] = (float)substr($kalan['H3'], 0, 5);
                        }
                    }
                    if($season >= 4) {
                        if(in_array($result,[1,3])){
                            $i = (in_array($result,[3]))?3:6;
                            $temp2[$i]['data'][] = (float)substr($kalan['HH4'], 0, 5);
                        }
                        if(in_array($result,[1,2] )) {
                            $i = (in_array($result, [2])) ? 3 : 7;
                            $temp2[$i]['data'][] = (float)substr($kalan['H4'], 0, 5);
                        }
                    }


        }//next kalan



        $charts[0]['name'] = 'وضعیت دانشگاه در سطح هدف کلان';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $tempCat = $temp2 = array();

        $temp2 = $this->categoryName($season,$result);

        foreach ($report['kalans'] as $kalan_no =>$kalan){

            foreach ($kalan['amaliatis'] as $amaliati_no =>$amaliati){

                $tempCat[] =  ($amaliati['amaliati_name']);

                if($season >= 1){
                    if(in_array($result,[1,3])) {
                        $i = (in_array($result, [3])) ? 0 : 0;
                        $temp2[$i]['data'][] = (float)substr($amaliati['FF1'], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result,[2]))?0:1;
                        $temp2[$i]['data'][] = (float)substr($amaliati['F1'], 0, 5);
                    }
                }
                if($season >= 2){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?1:2;
                        $temp2[$i]['data'][] = (float)substr($amaliati['FF2'], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 1 : 3;
                        $temp2[$i]['data'][] = (float)substr($amaliati['F2'], 0, 5);
                    }
                }
                if($season >= 3){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?2:4;
                        $temp2[$i]['data'][] = (float)substr($amaliati['FF3'], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 2 : 5;
                        $temp2[$i]['data'][] = (float)substr($amaliati['F3'], 0, 5);
                    }
                }
                if($season >= 4) {
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?3:6;
                        $temp2[$i]['data'][] = (float)substr($amaliati['FF4'], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 3 : 7;
                        $temp2[$i]['data'][] = (float)substr($amaliati['F4'], 0, 5);
                    }
                }


            }//next amaliati
        }//next kalan



        $charts[1]['name'] = 'وضعیت دانشگاه در سطح هدف عملیاتی';
        $charts[1]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[1]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $this->fileName = 'report.managerChart2.php';
        $this->template(compact('charts'));
        die();
    }
    public function managerChart3()
    {
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $admins = new admin();
        $adminList = $admins->getAll()->select('admin_id')->where('flag','=','3')->getList()['export']['list'];
        $adminList = array_map(function($a) {  return $a['admin_id']; }, $adminList);
        $daneshkade = $adminList;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        $tempCat = $temp2 = array();
        $sumG1 = $sumGG1 = $sumG2 = $sumGG2 = $sumG3 = $sumGG3 = $sumG4 = $sumGG4 = array();

        $avgG1 = $avgGG1 = $avgG2 = $avgGG2 = $avgG3 = $avgGG3 = $avgG4 = $avgGG4 = array();
        $avgE1 = $avgEE1 = $avgE2 = $avgEE2 = $avgE3 = $avgEE3 = $avgE4 = $avgEE4 = array();
        $temp2 = $this->categoryName($season,$result);
        foreach ($report['kalans'] as $kalan_no =>$kalan){

            $tempCat[] =  ($kalan['kalan_name']);

            foreach ($kalan['admins'] as $admin_id =>$admin){

                if(!in_array($admin_id,$daneshkade)){
                    continue;
                }
                $sumG1[$kalan_no] += $admin['G1'];
                $sumGG1[$kalan_no] += $admin['GG1'];
                $sumG2[$kalan_no] += $admin['G2'];
                $sumGG2[$kalan_no] += $admin['GG2'];
                $sumG3[$kalan_no] += $admin['G3'];
                $sumGG3[$kalan_no] += $admin['GG3'];
                $sumG4[$kalan_no] += $admin['G4'];
                $sumGG4[$kalan_no] += $admin['GG4'];



            }//next admin

            $avgG1[$kalan_no] = $sumG1[$kalan_no]/count($adminList);
            $avgG2[$kalan_no] = $sumG2[$kalan_no]/count($adminList);
            $avgG3[$kalan_no] = $sumG3[$kalan_no]/count($adminList);
            $avgG4[$kalan_no] = $sumG4[$kalan_no]/count($adminList);
            $avgGG1[$kalan_no] = $sumGG1[$kalan_no]/count($adminList);
            $avgGG2[$kalan_no] = $sumGG2[$kalan_no]/count($adminList);
            $avgGG3[$kalan_no] = $sumGG3[$kalan_no]/count($adminList);
            $avgGG4[$kalan_no] = $sumGG4[$kalan_no]/count($adminList);

            if($season >= 1){
                if(in_array($result,[1,3])) {
                    $i = (in_array($result, [3])) ? 0 : 0;
                    $temp2[$i]['data'][] = (float)substr($avgGG1[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float)substr($avgG1[$kalan_no], 0, 5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float)substr($avgGG2[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 1 : 3;
                    $temp2[$i]['data'][] = (float)substr($avgG2[$kalan_no], 0, 5);
                }
            }

            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float)substr($avgGG3[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 2 : 5;
                    $temp2[$i]['data'][] = (float)substr($avgG3[$kalan_no], 0, 5);
                }
            }
            if($season >= 4) {
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float)substr($avgGG4[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 3 : 7;
                    $temp2[$i]['data'][] = (float)substr($avgG4[$kalan_no], 0, 5);
                }
            }

        }//next kalan





        $charts[0]['name'] = 'میانگین دانشکده ها به تفکیک هدف کلان';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );



        $tempCat = $temp2 = array();

        $temp2 = $this->categoryName($season,$result);

        foreach ($report['kalans'] as $kalan_no =>$kalan) {

            foreach ($kalan['amaliatis'] as $amaliati_no => $amaliati) {

                $tempCat[] = ($amaliati['amaliati_name']);
                $sumE1 = $sumEE1 = $sumE2 = $sumEE2 = $sumE3 = $sumEE3 = $sumE4 = $sumEE4 = array();
                foreach ($amaliati['admins'] as $admin_id =>$admin){
                    if(!in_array($admin_id,$daneshkade)){
                        continue;
                    }
                    $sumE1[$kalan_no] += $admin['E1'];
                    $sumEE1[$kalan_no] += $admin['EE1'];
                    $sumE2[$kalan_no] += $admin['E2'];
                    $sumEE2[$kalan_no] += $admin['EE2'];
                    $sumE3[$kalan_no] += $admin['E3'];
                    $sumEE3[$kalan_no] += $admin['EE3'];
                    $sumE4[$kalan_no] += $admin['E4'];
                    $sumEE4[$kalan_no] += $admin['EE4'];

                }//next admin
                $avgE1[$kalan_no] = $sumE1[$kalan_no]/count($adminList);
                $avgE2[$kalan_no] = $sumE2[$kalan_no]/count($adminList);
                $avgE3[$kalan_no] = $sumE3[$kalan_no]/count($adminList);
                $avgE4[$kalan_no] = $sumE4[$kalan_no]/count($adminList);
                $avgEE1[$kalan_no] = $sumEE1[$kalan_no]/count($adminList);
                $avgEE2[$kalan_no] = $sumEE2[$kalan_no]/count($adminList);
                $avgEE3[$kalan_no] = $sumEE3[$kalan_no]/count($adminList);
                $avgEE4[$kalan_no] = $sumEE4[$kalan_no]/count($adminList);

                if($season >= 1){
                    if(in_array($result,[1,3])) {
                        $i = (in_array($result, [3])) ? 0 : 0;
                        $temp2[$i]['data'][] = (float)substr($avgEE1[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result,[2]))?0:1;
                        $temp2[$i]['data'][] = (float)substr($avgE1[$kalan_no], 0, 5);
                    }
                }
                if($season >= 2){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?1:2;
                        $temp2[$i]['data'][] = (float)substr($avgEE2[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 1 : 3;
                        $temp2[$i]['data'][] = (float)substr($avgE2[$kalan_no], 0, 5);
                    }
                }

                if($season >= 3){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?2:4;
                        $temp2[$i]['data'][] = (float)substr($avgEE3[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 2 : 5;
                        $temp2[$i]['data'][] = (float)substr($avgE3[$kalan_no], 0, 5);
                    }
                }
                if($season >= 4) {
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?3:6;
                        $temp2[$i]['data'][] = (float)substr($avgEE4[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 3 : 7;
                        $temp2[$i]['data'][] = (float)substr($avgE4[$kalan_no], 0, 5);
                    }
                }
            }//next amaliati
        }//next kalan
        $charts[1]['name'] = 'میانگین دانشکده ها به تفکیک هدف عملیاتی';
        $charts[1]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[1]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );

        $this->fileName = 'report.managerChart2.php';
        $this->template(compact('charts'));
        die();
    }


    public function managerChart4()
    {
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $admins = new admin();
        $adminList = $admins->getAll()->select('admin_id')->where('flag','=','13')->getList()['export']['list'];
        $adminList = array_map(function($a) {  return $a['admin_id']; }, $adminList);
        $setad = $adminList;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        $tempCat = $temp2 = array();
        $sumG1 = $sumGG1 = $sumG2 = $sumGG2 = $sumG3 = $sumGG3 = $sumG4 = $sumGG4 = array();

        $avgG1 = $avgGG1 = $avgG2 = $avgGG2 = $avgG3 = $avgGG3 = $avgG4 = $avgGG4 = array();
        $avgE1 = $avgEE1 = $avgE2 = $avgEE2 = $avgE3 = $avgEE3 = $avgE4 = $avgEE4 = array();
        $temp2 = $this->categoryName($season,$result);
        foreach ($report['kalans'] as $kalan_no =>$kalan){

            $tempCat[] =  ($kalan['kalan_name']);

            foreach ($kalan['admins'] as $admin_id =>$admin){

                if(!in_array($admin_id,$setad)){
                    continue;
                }
                $sumG1[$kalan_no] += $admin['G1']*$admin['kalan_vazn_avg'];
                $sumGG1[$kalan_no] += $admin['GG1'];
                $sumG2[$kalan_no] += $admin['G2'];
                $sumGG2[$kalan_no] += $admin['GG2'];
                $sumG3[$kalan_no] += $admin['G3'];
                $sumGG3[$kalan_no] += $admin['GG3'];
                $sumG4[$kalan_no] += $admin['G4'];
                $sumGG4[$kalan_no] += $admin['GG4'];



            }//next admin


            if($season >= 1){
                if(in_array($result,[1,3])) {
                    $i = (in_array($result, [3])) ? 0 : 0;
                    $temp2[$i]['data'][] = (float)substr($avgGG1[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float)substr($avgG1[$kalan_no], 0, 5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float)substr($avgGG2[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 1 : 3;
                    $temp2[$i]['data'][] = (float)substr($avgG2[$kalan_no], 0, 5);
                }
            }

            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float)substr($avgGG3[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 2 : 5;
                    $temp2[$i]['data'][] = (float)substr($avgG3[$kalan_no], 0, 5);
                }
            }
            if($season >= 4) {
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float)substr($avgGG4[$kalan_no], 0, 5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result, [2])) ? 3 : 7;
                    $temp2[$i]['data'][] = (float)substr($avgG4[$kalan_no], 0, 5);
                }
            }

        }//next kalan





        $charts[0]['name'] = 'میانگین ستاد به تفکیک هدف کلان';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );



        $tempCat = $temp2 = array();

        $temp2 = $this->categoryName($season,$result);

        foreach ($report['kalans'] as $kalan_no =>$kalan) {

            foreach ($kalan['amaliatis'] as $amaliati_no => $amaliati) {

                $tempCat[] = ($amaliati['amaliati_name']);
                $sumE1 = $sumEE1 = $sumE2 = $sumEE2 = $sumE3 = $sumEE3 = $sumE4 = $sumEE4 = array();
                foreach ($amaliati['admins'] as $admin_id =>$admin){
                    if(!in_array($admin_id,$setad)){
                        continue;
                    }
                    $sumE1[$kalan_no] += $admin['E1']*$admin['amaliati_vazn_avg'];
                    $sumEE1[$kalan_no] += $admin['EE1'];
                    $sumE2[$kalan_no] += $admin['E2'];
                    $sumEE2[$kalan_no] += $admin['EE2'];
                    $sumE3[$kalan_no] += $admin['E3'];
                    $sumEE3[$kalan_no] += $admin['EE3'];
                    $sumE4[$kalan_no] += $admin['E4'];
                    $sumEE4[$kalan_no] += $admin['EE4'];

                }//next admin

                if($season >= 1){
                    if(in_array($result,[1,3])) {
                        $i = (in_array($result, [3])) ? 0 : 0;
                        $temp2[$i]['data'][] = (float)substr($avgEE1[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result,[2]))?0:1;
                        $temp2[$i]['data'][] = (float)substr($avgE1[$kalan_no], 0, 5);
                    }
                }
                if($season >= 2){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?1:2;
                        $temp2[$i]['data'][] = (float)substr($avgEE2[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 1 : 3;
                        $temp2[$i]['data'][] = (float)substr($avgE2[$kalan_no], 0, 5);
                    }
                }

                if($season >= 3){
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?2:4;
                        $temp2[$i]['data'][] = (float)substr($avgEE3[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 2 : 5;
                        $temp2[$i]['data'][] = (float)substr($avgE3[$kalan_no], 0, 5);
                    }
                }
                if($season >= 4) {
                    if(in_array($result,[1,3])){
                        $i = (in_array($result,[3]))?3:6;
                        $temp2[$i]['data'][] = (float)substr($avgEE4[$kalan_no], 0, 5);
                    }
                    if(in_array($result,[1,2] )) {
                        $i = (in_array($result, [2])) ? 3 : 7;
                        $temp2[$i]['data'][] = (float)substr($avgE4[$kalan_no], 0, 5);
                    }
                }
            }//next amaliati
        }//next kalan
        $charts[1]['name'] = 'میانگین ستاد به تفکیک هدف عملیاتی';
        $charts[1]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[1]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );

        $this->fileName = 'report.managerChart2.php'; /*؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟؟*/
        $this->template(compact('charts'));
        die();
    }







    public function managerChart1Old()
    {

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no =>$kalan){

            $tempCat = $temp2 = array();

            $temp2[0]['name'] = 'خود اظهاری 1';
            $temp2[0]['color'] = '#45639b';
            $temp2[1]['name'] = '(نهایی (تایید شده 1';
            $temp2[1]['color'] = '#654c97';
            $temp2[2]['name'] = 'خود اظهاری 2';
            $temp2[2]['color'] = '#45639b';
            $temp2[3]['name'] = '(نهایی (تایید شده 2';
            $temp2[3]['color'] = '#654c97';
            $temp2[4]['name'] = 'خود اظهاری 3';
            $temp2[4]['color'] = '#45639b';
            $temp2[5]['name'] = '(نهایی (تایید شده 3';
            $temp2[5]['color'] = '#654c97';
            $temp2[6]['name'] = 'خود اظهاری 4';
            $temp2[6]['color'] = '#45639b';
            $temp2[7]['name'] = '(نهایی (تایید شده 4';
            $temp2[7]['color'] = '#654c97';


            foreach ($kalan['admins'] as $admins){

                if($admins['flag'] == 3) {
                    foreach ($admins['groups'] as $group) {
                        if ($group['flag'] == 2) {
                            $tempCat[] = $group['group_name'] . ' ' . $group['group_family'];
                        }
                    }


                    $temp2[0]['data'][] = (float)substr($admins['GG1'], 0, 5);
                    $temp2[1]['data'][] = (float)substr($admins['G1'], 0, 5);
                    $temp2[2]['data'][] = (float)substr($admins['GG2'], 0, 5);
                    $temp2[3]['data'][] = (float)substr($admins['G2'], 0, 5);
                    $temp2[4]['data'][] = (float)substr($admins['GG3'], 0, 5);
                    $temp2[5]['data'][] = (float)substr($admins['G3'], 0, 5);
                    $temp2[6]['data'][] = (float)substr($admins['GG4'], 0, 5);
                    $temp2[7]['data'][] = (float)substr($admins['G4'], 0, 5);
                }

            }



            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan


        $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts','list'));
        die();
    }

}
