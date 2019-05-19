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
                $temp2[$i]['name'] = 'خود اظهاری 1';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )){
                $i = (in_array($result,[2]))?0:1;
                $temp2[$i]['name'] = 'نهایی 1';
                $temp2[$i]['color'] = '#654c97';
            }

        }
        if($season >= 2){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?1:2;
                $temp2[$i]['name'] = 'خود اظهاری 2';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?1:3;
                $temp2[$i]['name'] = 'نهایی 2';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if($season >= 3){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?2:4;
                $temp2[$i]['name'] = 'خود اظهاری 3';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?2:5;
                $temp2[$i]['name'] = 'نهایی 3';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if($season >= 4){
            if(in_array($result,[1,3])){
                $i = (in_array($result,[3]))?3:6;
                $temp2[$i]['name'] = 'خود اظهاری 4';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if(in_array($result,[1,2] )) {
                $i = (in_array($result,[2]))?3:7;
                $temp2[$i]['name'] = 'نهایی 4';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        return $temp2;
    }


    public function groupChart1()
    {
        global $admin_info;
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        $temp2 = $this->categoryName($season,$result);

        $tempCat = array();


        foreach ($report['kalans'] as $kalan){



            $tempCat[] =  $kalan['kalan_name'];

            if($season >= 1){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?0:0;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['QQ1'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['Q1'],0,5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['QQ2'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?1:3;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['Q2'],0,5);
                }
            }
            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['QQ3'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?2:5;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['Q3'],0,5);
                }
            }
            if($season >=4){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['QQ4'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?3:7;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['groups'][$admin_info['admin_id']]['Q4'],0,5);
                }
            }



        }//next kalan





        $charts[0]['name'] = 'مقایسه اهداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function groupChart2()
    {
        $season = $this->_season;
        $result = $this->_result;

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




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart1()
    {

        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no => $kalan){

            $tempCat = $temp2 = array();

            $temp2 = $this->categoryName($season,$result);




                    foreach ($kalan['admins'] as $admins){
                        foreach ($admins['groups'] as $group){

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




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
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




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart2()
    {
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan){
            foreach ($kalan['amaliatis'] as $amaliati){
                foreach ($amaliati['eghdams'] as $eghdam_id => $eghdam){
                    $tempCat = $temp2 = array();
                    
                    $temp2 = $this->categoryName($season,$result);
                    
                    foreach ($eghdam['admins'] as $admins){
                        foreach ($admins['groups'] as $group){

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




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart3()
    {
        $season = $this->_season;
        $result = $this->_result;

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
                        }
                }// net eghdam

            }// next amaliati

            $charts[$kalan_no]['name'] = $kalan['kalan_name'];
            $charts[$kalan_no]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan_no]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart4()
    {
        global $admin_info;

        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();


        $tempCat = array();

        $temp2 = $this->categoryName($season,$result);

        foreach ($report['kalans'] as $kalan){



            $tempCat[] =  $kalan['kalan_name'];

            if($season >= 1){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?0:0;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG1'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?0:1;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G1'],0,5);
                }
            }
            if($season >= 2){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?1:2;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG2'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?1:3;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G2'],0,5);
                }
            }
            if($season >= 3){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?2:4;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG3'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?2:5;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G3'],0,5);
                }
            }
            if($season >=4){
                if(in_array($result,[1,3])){
                    $i = (in_array($result,[3]))?3:6;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG4'],0,5);
                }
                if(in_array($result,[1,2] )) {
                    $i = (in_array($result,[2]))?3:7;
                    $temp2[$i]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G4'],0,5);
                }
            }



        }//next kalan




        $charts[0]['name'] = 'مقایسه اعداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function managerChart1()
    {
        $season = $this->_season;
        $result = $this->_result;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no =>$kalan){

            $tempCat = $temp2 = array();

            $temp2 = $this->categoryName($season,$result);


            foreach ($kalan['admins'] as $admins){

                if($admins['flag'] == 3) {

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




        $this->fileName = 'report.groupandvahed.php';
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




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }

}
