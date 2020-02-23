<?php


class shakhesController
{
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

    function showList()
    {
        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";

        $obj = new shakhes();

        print_r_debug($obj);

        $this->fileName = 'shakhes.showList.php';
        $this->template(compact('charts','list'));
        die();
    }
}
