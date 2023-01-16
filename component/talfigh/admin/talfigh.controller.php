<?php

class talfighController
{

    public function __construct()
    {
        
        $this->exportType = 'html';
        
        
        /* همه ادمین ها */
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $adminObj = new admin;
        $this->admins = $adminObj->getAll()->keyBy('admin_id')->getList()['export']['list'];


        
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
    }




    public function chart()
    {

        $kalan = $this->allKalan();

        $session = ($_GET['s'] == 4 ||  (STEP_FORM1 == 4 && !isset($_GET['s'])))? 4:2;

        include_once ROOT_DIR.'component/chart/controllers/chart.controller.php';
        $chartController = new chartController();
        $reportChartTalfigh = $chartController->reportChartTalfigh($session,$_GET['qq']);

        $cArray = $cArray2 = $cArray3 = [];
        foreach ($reportChartTalfigh['chart'] as $c) {
            $cArray[] = (int) $c;
            $cArray2[] = 0;
            $cArray3[] = 0;


        }

        $cArray2 = [40,40,50,50,30,20];
        $cArray3 = [57,57,53,50,33,38];

        $charts[0]['name'] = ' میزان پیشرفت برنامه عملیاتی ';
        $charts[0]['categories'] = json_encode($kalan,JSON_UNESCAPED_UNICODE );
        $charts[0]['series'] = json_encode([
            ['name'=>'پایش','color'=>'url(#highcharts-default-pattern-1)','data'=>$cArray],
            ['name'=>'ارزیابی','color'=>'url(#highcharts-default-pattern-5)','data'=>$cArray2],
            ['name'=>'تلفیق','color'=>'url(#highcharts-default-pattern-2)','data'=>$cArray3]
        ],JSON_UNESCAPED_UNICODE );




        $this->fileName = 'talfigh.chart.php';
        $this->template(compact(
            'charts' ,
            'kalan',
            'reportChartTalfigh'
        ));
    }


    public function list()
    {
        $this->fileName = 'talfigh.list.php';
        $shakhes = array();
        $this->template(compact(
            'shakhes'
        ));
    }
         /*   //رسم نمودار گیج
          https://stackoverflow.com/questions/70113117/how-to-update-google-gauge-chart-using-ajax-call//*/



    private  function allKalan()
    {
        include_once ROOT_DIR . 'component/kalan/model/kalan.model.php';
        $obj = new kalan();
        $kalans = $obj->select('kalan,kalan_no')->getList()['export']['list'];

        foreach ($kalans as $kalan_no => $kalan) {
            $temp[$kalan_no] = $kalan['kalan'];
        }
        return $temp;
    }
}
