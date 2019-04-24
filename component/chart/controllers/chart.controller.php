<?php
include_once dirname(__FILE__).'/chart.model.php';

class chartController
{
    public $exportType;
    public $fileName;
    public function __construct()
    {
        $this->exportType = 'html';
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



    public function groupChart1()
    {
        //TODO get season
        $season = 1;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();

        foreach ($report['list'] as $kalan){
            $temp = $temp2 = array();

            $temp2[0]['name'] = 'خود اظهاری 1';
            $temp2[0]['color'] = 'url(#highcharts-default-pattern-3)';
            $temp2[1]['name'] = '(نهایی (تایید شده 1';
            $temp2[1]['color'] = '#3F7FC7';

            $temp2[2]['name'] = 'خود اظهاری 2';
            $temp2[2]['color'] = 'url(#highcharts-default-pattern-3)';
            $temp2[3]['name'] = '(نهایی (تایید شده 2';
            $temp2[3]['color'] = '#3F7FC7';

            $temp2[4]['name'] = 'خود اظهاری 3';
            $temp2[4]['color'] = 'url(#highcharts-default-pattern-3)';
            $temp2[5]['name'] = '(نهایی (تایید شده 3';
            $temp2[5]['color'] = '#3F7FC7';

            $temp2[6]['name'] = 'خود اظهاری 4';
            $temp2[6]['color'] = 'url(#highcharts-default-pattern-3)';
            $temp2[7]['name'] = '(نهایی (تایید شده 4';
            $temp2[7]['color'] = "#3F7FC7";

            foreach ($kalan['amaliati'] as $amaliati){
                foreach ($amaliati['eghdam'] as $eghdam){


                    $temp[] =  ($eghdam['eghdam']);


                    foreach ($eghdam['admins'] as $admins){
                        foreach ($admins['group'] as $group){



                            $temp2[0]['data'][] = (float) substr($group['RR1'],0,5);
                            $temp2[1]['data'][] = (float) substr($group['R1'],0,5);
                            $temp2[2]['data'][] = (float) substr($group['RR2'],0,5);
                            $temp2[3]['data'][] = (float) substr($group['R2'],0,5);
                            $temp2[4]['data'][] = (float) substr($group['RR3'],0,5);
                            $temp2[5]['data'][] = (float) substr($group['R3'],0,5);
                            $temp2[6]['data'][] = (float) substr($group['RR4'],0,5);
                            $temp2[7]['data'][] = (float) substr($group['R4'],0,5);
                        }
                    }


                }// net eghdam

            }// next amaliati

            $charts[$kalan['kalan_no']]['name'] = $kalan['kalan'];
            $charts[$kalan['kalan_no']]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan['kalan_no']]['categories'] = json_encode($temp,JSON_UNESCAPED_UNICODE );


        }//next kalan




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function groupChart2()
    {
        global $admin_info;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();

        $tempCat = array();
        $temp2 = array();
        foreach ($report['list'] as $kalan){



            $tempCat[] =  $kalan['kalan'];

            $temp2[0]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['QQ1'],0,5);
            $temp2[1]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['Q1'],0,5);
            $temp2[2]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['QQ2'],0,5);
            $temp2[3]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['Q2'],0,5);
            $temp2[4]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['QQ3'],0,5);
            $temp2[5]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['Q3'],0,5);
            $temp2[6]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['QQ4'],0,5);
            $temp2[7]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['group'][$admin_info['admin_id']]['Q4'],0,5);


        }//next kalan


        $temp2[0]['name'] = 'خود اظهاری 1';
        $temp2[0]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[1]['name'] = '(نهایی (تایید شده 1';
        $temp2[1]['color'] = '#3F7FC7';

        $temp2[2]['name'] = 'خود اظهاری 2';
        $temp2[2]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[3]['name'] = '(نهایی (تایید شده 2';
        $temp2[3]['color'] = '#3F7FC7';

        $temp2[4]['name'] = 'خود اظهاری 3';
        $temp2[4]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[5]['name'] = '(نهایی (تایید شده 3';
        $temp2[5]['color'] = '#3F7FC7';

        $temp2[6]['name'] = 'خود اظهاری 4';
        $temp2[6]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[7]['name'] = '(نهایی (تایید شده 4';
        $temp2[7]['color'] = "#3F7FC7";

        $charts[0]['name'] = 'مقایسه اهداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart1()
    {
        //TODO get season
        $season = 1;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['kalans'] as $kalan_no => $kalan){

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
                        foreach ($admins['groups'] as $group){

                            $tempCat[] =  $group['group_name'].' '.$group['group_family'];


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
        //TODO get season
        $season = 1;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();
        foreach ($report['list'] as $kalan){
            foreach ($kalan['amaliati'] as $amaliati){
                foreach ($amaliati['eghdam'] as $eghdam){
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
                    foreach ($eghdam['admins'] as $admins){
                        foreach ($admins['group'] as $group){

                            $tempCat[] =  $group['name'].' '.$group['family'];


                            $temp2[0]['data'][] = (float) substr($group['RR1'],0,5);
                            $temp2[1]['data'][] = (float) substr($group['R1'],0,5);
                            $temp2[2]['data'][] = (float) substr($group['RR2'],0,5);
                            $temp2[3]['data'][] = (float) substr($group['R2'],0,5);
                            $temp2[4]['data'][] = (float) substr($group['RR3'],0,5);
                            $temp2[5]['data'][] = (float) substr($group['R3'],0,5);
                            $temp2[6]['data'][] = (float) substr($group['RR4'],0,5);
                            $temp2[7]['data'][] = (float) substr($group['R4'],0,5);
                        }//next group
                    }//next admin

                    $charts[$eghdam['eghdam_id']]['name'] = $eghdam['eghdam'];
                    $charts[$eghdam['eghdam_id']]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
                    $charts[$eghdam['eghdam_id']]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );
                }//next eghdam
            }//next amaliati
        }//next kalan




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart3()
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

            foreach ($kalan['amaliati'] as $amaliati){
                foreach ($amaliati['eghdam'] as $eghdam){

                    $tempCat[] =  ($eghdam['eghdam']);

                    foreach ($eghdam['admins'] as $admins){

                            $temp2[0]['data'][] = (float) substr($admins['eghdam_vazn']['CC1'],0,5);
                            $temp2[1]['data'][] = (float) substr($admins['C1'],0,5);
                            $temp2[2]['data'][] = (float) substr($admins['eghdam_vazn']['CC2'],0,5);
                            $temp2[3]['data'][] = (float) substr($admins['C2'],0,5);
                            $temp2[4]['data'][] = (float) substr($admins['eghdam_vazn']['CC3'],0,5);
                            $temp2[5]['data'][] = (float) substr($admins['C3'],0,5);
                            $temp2[6]['data'][] = (float) substr($admins['eghdam_vazn']['CC4'],0,5);
                            $temp2[7]['data'][] = (float) substr($admins['C4'],0,5);
                        }
                }// net eghdam

            }// next amaliati

            $charts[$kalan['kalan_no']]['name'] = $kalan['kalan'];
            $charts[$kalan['kalan_no']]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan['kalan_no']]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function vahedChart4()
    {
        global $admin_info;

        include_once ROOT_DIR.'component/reports/controllers/reports.controller.php';
        $reportsController = new reportsController();
        $report = $reportsController->reportsProcess();
        $charts = array();

        $tempCat = array();
        $temp2 = array();
        foreach ($report['list'] as $kalan){



            $tempCat[] =  $kalan['kalan'];

            $temp2[0]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG1'],0,5);
            $temp2[1]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G1'],0,5);
            $temp2[2]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG2'],0,5);
            $temp2[3]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G2'],0,5);
            $temp2[4]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG3'],0,5);
            $temp2[5]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G3'],0,5);
            $temp2[6]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['GG4'],0,5);
            $temp2[7]['data'][] = (float) substr($kalan['admins'][$admin_info['parent_id']]['G4'],0,5);



        }//next kalan


        $temp2[0]['name'] = 'خود اظهاری 1';
        $temp2[0]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[1]['name'] = '(نهایی (تایید شده 1';
        $temp2[1]['color'] = '#3F7FC7';

        $temp2[2]['name'] = 'خود اظهاری 2';
        $temp2[2]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[3]['name'] = '(نهایی (تایید شده 2';
        $temp2[3]['color'] = '#3F7FC7';

        $temp2[4]['name'] = 'خود اظهاری 3';
        $temp2[4]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[5]['name'] = '(نهایی (تایید شده 3';
        $temp2[5]['color'] = '#3F7FC7';

        $temp2[6]['name'] = 'خود اظهاری 4';
        $temp2[6]['color'] = 'url(#highcharts-default-pattern-3)';
        $temp2[7]['name'] = '(نهایی (تایید شده 4';
        $temp2[7]['color'] = "#3F7FC7";

        $charts[0]['name'] = 'مقایسه اعداف';
        $charts[0]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }
    public function managerChart1()
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
    public function managerChart1old()
    {

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
                if($admins['flag'] == 3) {
                    foreach ($admins['group'] as $group) {
                        if ($group['flag'] == 2) {
                            $tempCat[] = $group['name'] . ' ' . $group['family'];
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



            $charts[$kalan['kalan_no']]['name'] = $kalan['kalan'];
            $charts[$kalan['kalan_no']]['series'] = json_encode($temp2,JSON_UNESCAPED_UNICODE);
            $charts[$kalan['kalan_no']]['categories'] = json_encode($tempCat,JSON_UNESCAPED_UNICODE );


        }//next kalan




        $this->fileName = 'report.groupandvahed.php';
        $this->template(compact('charts'));
        die();
    }

}
