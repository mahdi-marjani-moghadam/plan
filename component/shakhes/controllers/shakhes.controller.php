<?php


class shakhesController
{
    private $_selectedAdmins = array();
    public function __construct()
    {
        $this->exportType = 'html';
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

    function selected($admins)
    {

        foreach ($admins as &$admin) {
            $admin['selected'] = 'false';

            if (in_array($admin['admin_id'], $this->_selectedAdmins)) {
                $admin['selected'] = 'true';
            }
        }


        return $admins;
    }

    function showList()
    {
        global $admin_info;

        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";

        // پیدا کردن قلم ها و کلان
        $obj = new shakhes();
        $query = 'select g.ghalam_id , r_k_s.kalan_no , g.ghalam   from sh_ghalam g
        left join sh_rel_ghalam_shakhes r_g_s on g.ghalam_id = r_g_s.ghalam_id
        left join sh_rel_kalan_shakhes r_k_s on r_g_s.shakhes_id = r_k_s.shakhes_id';
        $res = $obj->query($query)->getList();
        $ghalam = ($res['export']['recordsCount'] > 0) ?  $res['export']['list'] : array();




        //فیلترینگ
        if (isset($_GET['filter_columns'])) {
            $this->_selectedAdmins = explode(',', $_GET['filter_columns']);
        }



        include ROOT_DIR . "component/admin/model/admin.model.php";
        // پیدا کردن ستون های واحد
        if ($admin_info['parent_id'] == 0 || $admin_info['admin_id'] == 3151) { // مدیریت دانشگاه
            $query = 'select admin_id,name,family from admin where parent_id <> 0 and parent_id <> 1 order by parent_id';
            $admins = $obj->query($query)->getList()['export']['list'];

            $admins = $this->selected($admins);
        } else if ($admin_info['group_admin'] == 1) { // دانشکده

        } else { // واحد

        }


        $this->fileName = 'shakhes.showList.php';
        $this->template(compact('charts', 'list', 'ghalam', 'admins'));
        die();
    }
}
