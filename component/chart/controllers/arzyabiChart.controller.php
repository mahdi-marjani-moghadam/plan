<?php

// namespace component\chart\controllers;


// use shakhesController;

class arzyabiChartController 
{

    private $fileName;
    private $exportType = 'html';

    public function __construct()
    {
       
    }

    public function template($list = array(), $msg = '')
    {
        global $messageStack, $admin_info;
        extract($list);
        switch ($this->exportType) {
            case 'html':

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
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
        die();
    }

    private function report(){
        include_once ROOT_DIR.'component/shakhes/controllers/shakhes.controller.php';
        $this->shakhes = new shakhesController;

        // اول بدست آوردن بچه ها از جدول admin , import_status
        $groups = $this->shakhes->child();


        /** season */
        $rules = array('6', '12');
        if (in_array($_GET['s'], $rules)) {
            $season = handleData($_GET['s']);
        } else {
            if (in_array(STEP_FORM1, [1, 2])) {
                $season = '6';
            }

            if (in_array(STEP_FORM1, [3, 4])) {
                $season = '12';
            }

            $_GET['s'] = $season;
        }

        if (isset($_GET['y'])) {
            $year = explode('-', handleData($_GET['y']));
        } else {
            $year = array(1398, 1399);
        }

        /** admins filter */
        $list['showAdmin'] = $this->shakhes->showAdmin();


        //دوم بدست آوردن قلم ها از جدول import
        $ghalamsNext = $this->shakhes->getGhalam($groups, $year[1], $season);
        $ghalamsPrev = $this->shakhes->getGhalam($groups, $year[0], $season);

        //   dd($ghalamsNext);
        //           dd($ghalamsNext[102001]['admins'][1102]);
        //           dd($ghalamsPrev[102001]['admins'][1102]);




        // سوم برای بدست آوردن شاخص ها از جدول ghalam_shakhes , shakhes
        $shakhesNext = $this->shakhes->getShakhesByGhalam($ghalamsNext);
        $shakhesPrev = $this->shakhes->getShakhesByGhalam($ghalamsPrev);


        $reports = $this->shakhes->getReports($shakhesNext, $ghalamsNext, $ghalamsPrev, $groups);

    }


    public function groupChart1()
    {
        
    

        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }


    public function daneshkadeChart2()
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

        // include_once ROOT_DIR.'component/shakhes/controllers/shakhes.controller.php';
        // $reportsController = new shakhesController();
        // $report = $reportsController->reportsProcess();
        $report = $this->report();
        $charts = array();


        $tempCat = array();

        // $temp2 = $this->categoryName($season,$result);

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

        // $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'arzyabi/chart/daneshkade2.php';
        $this->template();
    }

    public function daneshkadeChart3()
    {
        
    

        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }
    

    public function uniChart1()
    {
        
    

        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }
    
    public function uniChart2()
    {
        
    

        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }
    
}
