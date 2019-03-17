<?php
/**
 * Created by PhpStorm.
 * User: mahdi
 * Date: 12/22/2016
 * Time: 10:35 PM
 */
include_once dirname(__FILE__).'/admin.model.php';

class adminController
{
    public $exportType;
    public $fileName;
    public function __construct()
    {
        $this->exportType = 'html';
    }
    public function template($list = array(), $msg='')
    {
        // global $conn, $lang;
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/title.inc.php';
                include ROOT_DIR.'templates/'.CURRENT_SKIN."/$this->fileName";
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/tail.inc.php';
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

    function showALL($fields)
    {
        $admin = new admin();
        $obj = $admin->getByFilter($fields);
        //print_r_debug($obj);
        $export['list']  = $obj['export']['list'];
        $this->fileName = 'admin.php';
        $this->template($export);
    }

    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->fileName = 'admin.php';
            $this->template('', $msg);
            die();
        }
        //$activity = new activityModel();
        //$result = $activity->getActivityById($_input);

        $result = admin::find($_input);


        if (!is_object($result)) {
            $this->fileName = 'admin.php';
            $this->template('', $result['msg']);
            die();
        }



        $this->fileName = 'admin.showMore.php';
        $this->template($result->fields);
        die();
    }
}