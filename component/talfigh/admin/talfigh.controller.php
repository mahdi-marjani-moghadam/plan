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
        
        $charts[0]['name'] = 'نمودار تلفیق پایش و ارزیابی';
        $charts[0]['categories'] = json_encode($kalan,JSON_UNESCAPED_UNICODE );
        $charts[0]['series'] = json_encode([
            ['name'=>'پایش','color'=>'url(#highcharts-default-pattern-1)','data'=>[10,10,10,10,10,10,10]],
            ['name'=>'ارزیابی','color'=>'url(#highcharts-default-pattern-5)','data'=>[40,40,40,40,40,40,40]],
            ['name'=>'تلفیق','color'=>'url(#highcharts-default-pattern-2)','data'=>[60,60,60,60,60,60,60]]
        ],JSON_UNESCAPED_UNICODE );

        $this->fileName = 'talfigh.chart.php';
        $shakhes = array();
        $this->template(compact(
            'charts',
        ));
    }


    public function list()
    {
        $this->fileName = 'talfigh.list.php';
        $shakhes = array();
        $this->template(compact(
            'shakhes',
        ));
    }


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
