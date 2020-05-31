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

    function childs($admins)
    {
        $obj = new shakhes();
        //print_r_debug(array_column($admins, 'selected'));
        //$selectedAdmin = array_search('true', array_column($admins, 'selected'));
        //print_r_debug($selectedAdmin);

        // foreach($admins as &$admin){
        //     if($admin['selected'] == 'true'){

        //     }
        // }

        $query = 'select admin_id,name,family from admin where  parent_id = 1 order by parent_id';
        $childs = $obj->query($query)->getList()['export']['list'];
        //print_r_debug($childs);
    }

    /**
        اول باید اهداف اون ادمینی که اومده تو رو ببینیم
        بعد شاخص این ادمینی که اومده بیرون میکشیم
        یه قسمت داشته باشیم که ادمین های کسی که اومده پیدا بشه
        ا ۶ تا جدول به ازا اهداف داشته باشیم
        اونایی که group_admin اونها ۱ باشه میتونن همه رو ببینن
     */
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
        if ($admin_info['parent_id'] == 0 || $admin_info['admin_id'] == 3121 || $admin_info['admin_id'] == 6) { // مدیریت دانشگاه

            $query = 'select admin_id,name,family from admin where  parent_id = 1 order by parent_id';
            $admins = $obj->query($query)->getList()['export']['list'];
            $admins = $this->selected($admins);

            //$child = $this->childs($admins);
            //print_r_debug($admins);



        } else if ($admin_info['group_admin'] == 1) { // دانشکده

        } else { // واحد

        }

        
        
        $this->fileName = 'shakhes.showList.php';
        $this->template(compact('charts', 'list', 'ghalam', 'admins'));
        die();
    }


    /**
      تنظیمات شاخص
      نمایش لیست شاخص ها
     */
    function shakhesSetting()
    {


        /** لیست شاخص */
        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        $obj = new shakhes();
        $query = 'select sh.shakhes_id, shakhes, sh.shakhes_id ,r_g_sh.ghalam_id , type from sh_shakhes sh
        left join sh_rel_ghalam_shakhes r_g_sh on sh.shakhes_id = r_g_sh.shakhes_id';
        $res = $obj->query($query)->getList();
        // dd($res);
        if ($res['export']['recordsCount']) {
            foreach ($res['export']['list'] as $sh) {
                $shakhes[$sh['shakhes_id']]['id'] = $sh['shakhes_id'];
                $shakhes[$sh['shakhes_id']]['shakhes'] = $sh['shakhes'];
                switch ($sh['type']) {
                    case 'equal':
                        $shakhes[$sh['shakhes_id']]['logic']['type'] = 'equal';
                        $shakhes[$sh['shakhes_id']]['logic']['function'] = '$g' . $sh['ghalam_id'];
                        $shakhes[$sh['shakhes_id']]['logic']['ghalams'][]  = $sh['ghalam_id'];
                        break;

                    case 'sum':
                        $shakhes[$sh['shakhes_id']]['logic']['type'] = 'sum';
                        $shakhes[$sh['shakhes_id']]['logic']['function'] = $shakhes[$sh['shakhes_id']]['logic']['function'] . '+$g' . $sh['ghalam_id'];
                        $shakhes[$sh['shakhes_id']]['logic']['ghalams'][]  = $sh['ghalam_id'];
                        break;

                    case 'up':
                        $shakhes[$sh['shakhes_id']]['logic']['type'] = 'divid';
                        $shakhes[$sh['shakhes_id']]['logic']['up'] = $shakhes[$sh['shakhes_id']]['logic']['up'] . '+$g' . $sh['ghalam_id'];
                        $shakhes[$sh['shakhes_id']]['logic']['function'] = $shakhes[$sh['shakhes_id']]['logic']['up'] . '/' . $shakhes[$sh['shakhes_id']]['logic']['down'];
                        $shakhes[$sh['shakhes_id']]['logic']['ghalams']['up'][] = $sh['ghalam_id'];
                        
                        break;

                    case 'down':
                        $shakhes[$sh['shakhes_id']]['logic']['type'] = 'divid';
                        $shakhes[$sh['shakhes_id']]['logic']['down'] = $shakhes[$sh['shakhes_id']]['logic']['down'] . '+$g' . $sh['ghalam_id'];
                        $shakhes[$sh['shakhes_id']]['logic']['function'] = $shakhes[$sh['shakhes_id']]['logic']['up'] . '/' . $shakhes[$sh['shakhes_id']]['logic']['down'];
                        $shakhes[$sh['shakhes_id']]['logic']['ghalams']['down'][] = $sh['ghalam_id'];
                        break;
                }
            }
        }


        // پیدا کردن قلم ها و کلان
        $obj2 = new shakhes();
        $query = 'select g.ghalam_id , r_k_s.kalan_no , g.ghalam   from sh_ghalam g
        left join sh_rel_ghalam_shakhes r_g_s on g.ghalam_id = r_g_s.ghalam_id
        left join sh_rel_kalan_shakhes r_k_s on r_g_s.shakhes_id = r_k_s.shakhes_id ';
        $res2 = $obj2->query($query)->getList();
        $ghalam = ($res2['export']['recordsCount'] > 0) ?  $res2['export']['list'] : array();
        
        // dd($ghalam);
    

        $this->fileName = 'shakhes.setting.showList.php';
        $this->template(compact('shakhes','ghalam'));
        die();
    }


    function shakhesDelete($post)
    {
        
        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        
        $shakhes = shakhes::find($post['id']);

        dd($shakhes);
    }

    function settingAdd($post){

        /** اخرین شاخص */
        include_once ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        $query = 'select max(shakhes_id) from sh_shakhes';
        $res = $obj->query($query)->getList();
        
        echo json_encode($res);
        die();


        /** shakhes */
        
        // $sh = new shakhes();
        // $sh->shakhes_id = 

        /** rel ghalam shakhes */

        /** nerkh */

        /** kalan shakhes */



        $result['status'] = 1;
        $result['msg'] = 'با موفقیت ساخته شد.';
        return $result;
    }

    function settingEdit($post)
    {
        $result['status'] = 1;
        $result['msg'] = 'با موفقیت ویرایش شد.';
        return $result;
    }
}
