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
        $query = 'select g.ghalam_id , r_k_s.kalan_no , g.ghalam   from sh_ghalam g
        left join sh_rel_ghalam_shakhes r_g_s on g.ghalam_id = r_g_s.ghalam_id
        left join sh_rel_kalan_shakhes r_k_s on r_g_s.shakhes_id = r_k_s.shakhes_id';
        $res = $obj->query($query)->getList();

        $ghalam = ($res['export']['recordsCount'] > 0)?  $res['export']['list'] : array();


        

        $this->fileName = 'shakhes.showList.php';
        $this->template(compact('charts','list','ghalam'));
        die();
    }
}
