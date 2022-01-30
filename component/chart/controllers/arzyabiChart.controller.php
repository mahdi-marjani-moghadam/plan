<?php

class arzyabiChartController
{

    private $fileName;
    private $exportType = 'html';
    private $shakhes;

    public function __construct()
    {
        include_once ROOT_DIR . 'component/shakhes/controllers/shakhes.controller.php';
        $this->shakhes = new shakhesController;

        $this->_season = (isset($_GET['s'])) ? handleData($_GET['s']) : 2;
        $this->_result = (isset($_GET['r'])) ? handleData($_GET['r']) : 1;
    }




    ////////////////////////////////////////////
    ///            نمودار گروه ها            ///
    ////////////////////////////////////////////
    public function groupChart1()
    {
        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }




























    ////////////////////////////////////////////
    ///            نمودار دانشکده ها         ///
    ////////////////////////////////////////////
    public function daneshkadeChart2()
    {
        global $admin_info;

        $parent = $admin_info['parent_id'];

        if ($admin_info['parent_id'] == 0) {
            if (isset($_GET['qq'])) {
                $parent = $this->getParentIdByAdminId(trim($_GET['qq'], ','));
            }
        }

        $season = $this->_season;
        $result = $this->_result;


        $report = $this->report();

        $charts = array();

        $tempCat = array();

        $temp2 = $this->categoryName($season, $result);


        $kalanName = $this->allKalan();
        


        foreach ($report['kalan'] as $kalan_no =>  $kalan) {

            if (!isset($kalan[$parent])) {
                continue;
            }


            $tempCat[] =  $kalanName[$kalan_no];
            
            if ($season >= 2) {
                if (in_array($result, [1, 3])) {
                    $i = (in_array($result, [3])) ? 1 : 2;
                    $temp2[$i]['data'][] =   (float) substr($kalan[$parent]['darsad']['value'], 0, 5);
                }
                // dd($temp2);

                if (in_array($result, [1, 2])) {
                    $i = (in_array($result, [2])) ? 1 : 3;
                    $temp2[$i]['data'][] = (float) substr($kalan[$parent]['darsad']['value_import'], 0, 5);
                }
            }
            if ($season >= 4) {
                if (in_array($result, [1, 3])) {
                    $i = (in_array($result, [3])) ? 3 : 6;
                    $temp2[$i]['data'][] = (float) substr($kalan[$parent]['darsad']['value'], 0, 5);
                }
                if (in_array($result, [1, 2])) {
                    $i = (in_array($result, [2])) ? 3 : 7;
                    $temp2[$i]['data'][] = (float) substr($kalan[$parent]['darsad']['value'], 0, 5);
                }
            }
        } //next kalan

        // dd($temp2);

        $charts[0]['name'] = 'مقایسه اهداف';
        $charts[0]['series'] = json_encode($temp2, JSON_UNESCAPED_UNICODE);
        $charts[0]['categories'] = json_encode($tempCat, JSON_UNESCAPED_UNICODE);

        // dd($charts);
        $list['showAdmin'] = $this->showAdmin();

        $this->fileName = 'arzyabi/chart/daneshkade2.php';
        $this->template(compact(
            'list',
            'charts'
        ));
    }

    public function daneshkadeChart3()
    {



        $this->fileName = 'arzyabi/chart/group.php';
        $this->template();
    }





























    ////////////////////////////////////////////
    ///            نمودار دانشگاه            ///
    ////////////////////////////////////////////
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





























    private function getParentIdByAdminId($admin_id)
    {
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $adminObj = new admin();
        $parent = $adminObj->getAll()->select('parent_id')->where('admin_id', '=', $admin_id)->getList()['export']['list'][0]['parent_id'];
        return $parent;
    }
    private function showAdmin()
    {
        global $admin_info;
        if ($admin_info['parent_id'] == 0) {
            include_once ROOT_DIR . 'component/admin/model/admin.model.php';
            $objAdmin = new admin();
            $result3 = $objAdmin->getAll()
                ->select('admin_id,name,family');


            if ($_GET['action']  == 'g1') {
                $result3 = $result3->where('parent_id', 'not in', '0,1')->andWhere('group_admin', '=', 0);
            } else if ($_GET['action']  == 'v1' || $_GET['action']  == 'v2' || $_GET['action']  == 'v3' || $_GET['action']  == 'v4') {
                $result3 = $result3->where('parent_id', 'not in', '0,1')->andWhere('group_admin', '=', 1)->andWhere('parent_id', 'not in', '0,1');
            } else if ($_GET['action']  == 'u1' | $_GET['action']  == 'u2') {
                $result3 = $result3->Where('flag', 'in', '3,13');
            }
            $result3 = $result3->getList();

            $list['showAdmin'] = $result3['export']['list'];
            return $list['showAdmin'];
        }
        return true;
    }

    private function report()
    {


        // اول بدست آوردن بچه ها از جدول admin , import_status
        $groups = $this->shakhes->child();


        /** فصل */
        $rules = array('2', '4');
        if (in_array($_GET['s'], $rules)) {
            $season = handleData($_GET['s']) * 3;
        } else {
            if (in_array(STEP_FORM1, [1, 2])) {
                $season = '6';
            }

            if (in_array(STEP_FORM1, [3, 4])) {
                $season = '12';
            }

            $_GET['s'] = $season;
        }




        /* سال */
        if (isset($_GET['y'])) {
            $year = explode('-', handleData($_GET['y']));
        } else {
            $year = array(1398, 1399);
        }



        /** admins filter */
        // $list['showAdmin'] = $this->shakhes->showAdmin();





        //دوم بدست آوردن قلم ها از جدول import
        $ghalamsNext = $this->shakhes->getGhalam($groups, $year[1], $season);
        $ghalamsPrev = $this->shakhes->getGhalam($groups, $year[0], $season);





        // سوم برای بدست آوردن شاخص ها از جدول ghalam_shakhes , shakhes
        $shakhesNext = $this->shakhes->getShakhesByGhalam($ghalamsNext);

        $report = $this->shakhes->getReports($shakhesNext, $ghalamsNext, $ghalamsPrev, $groups);

        return $report;
    }

    public function categoryName($season, $result)
    {

        if ($season >= 1) {
            if (in_array($result, [1, 3])) {
                $i = (in_array($result, [2])) ? 0 : 0;
                $temp2[$i]['name'] = 'خود اظهاری سه ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if (in_array($result, [1, 2])) {
                $i = (in_array($result, [2])) ? 0 : 1;
                $temp2[$i]['name'] = 'نهایی سه ماهه';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if ($season >= 2) {
            if (in_array($result, [1, 3])) {
                $i = (in_array($result, [3])) ? 1 : 2;
                $temp2[$i]['name'] = 'خود اظهاری شش ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if (in_array($result, [1, 2])) {
                $i = (in_array($result, [2])) ? 1 : 3;
                $temp2[$i]['name'] = 'نهایی شش ماهه';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if ($season >= 3) {
            if (in_array($result, [1, 3])) {
                $i = (in_array($result, [3])) ? 2 : 4;
                $temp2[$i]['name'] = 'خود اظهاری نه ماهه';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if (in_array($result, [1, 2])) {
                $i = (in_array($result, [2])) ? 2 : 5;
                $temp2[$i]['name'] = 'نهایی نه ماهه';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        if ($season >= 4) {
            if (in_array($result, [1, 3])) {
                $i = (in_array($result, [3])) ? 3 : 6;
                $temp2[$i]['name'] = 'خود اظهاری یکساله';
                $temp2[$i]['color'] = 'url(#highcharts-default-pattern-3)';
            }
            if (in_array($result, [1, 2])) {
                $i = (in_array($result, [2])) ? 3 : 7;
                $temp2[$i]['name'] = 'نهایی یکساله';
                $temp2[$i]['color'] = '#654c97';
            }
        }
        return $temp2;
    }


    private  function allKalan()
    {
        include_once ROOT_DIR . 'component/kalan/model/kalan.model.php';
        $obj = new kalan();
        $kalans = $obj->select('kalan,kalan_no')->keyBy('kalan_no')->getList()['export']['list'];

        foreach($kalans as $kalan_no => $kalan){
            $temp[$kalan_no] = $kalan['kalan'];
        }
        return $temp;
        
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
}
