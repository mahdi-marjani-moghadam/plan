<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__)."/admin.vazn.model.php");

/**
 * Class vazn1Controller
 */
class adminVaznController
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



    public function getAllJson()
    {

        global $admin_info;

        $obj = new adminVaznModel();
        $fields['where'] = " semat='".handleData($_POST['semat']) ."' ";
        $result = $obj->getByFilter($fields);
        //$obj = adminVaznModel::getAll()->getList();

//        print_r_debug($result['export']['list'][0]);





        $this->template($result['export']['list'][0]);
        die();
    }


}
?>