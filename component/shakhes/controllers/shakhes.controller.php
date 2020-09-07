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
        $query = 'select sh.shakhes_id, shakhes ,r_g_sh.ghalam_id , type from sh_shakhes sh
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
        $this->template(compact('shakhes', 'ghalam'));
        die();
    }


    function shakhesDelete($post)
    {

        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";

        $shakhes = shakhes::find($post['id']);

        dd($shakhes);
    }

    function settingAdd($post)
    {

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
        $result['post'] = $post;

        /** تغییر شاخص */
        include_once ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        $shakhes = shakhes::getBy_shakhes_id($post['shakhes_id'])->get();
        if ($shakhes['export']['recordsCount'] == 0) {
            $result = array('result' => -1, 'msg' => 'شاخص یافت نشد.');
            return $result;
        }
        $shakhesObj = $shakhes['export']['list'][0];
        $shakhesObj->shakhes = $post['shakhes'];
        $shakhesObj->save();
        //$result['sh_shakhes2'] = $shakhesObj->fields;

        /** پاک کردن کل اقلام اون شاخص */
        include_once ROOT_DIR . "component/shakhes/model/rel.ghalam.shakhes.model.php";
        $relGhalamShakhes = relGhalamShakhes::getBy_shakhes_id($post['shakhes_id'])->get();
        if ($relGhalamShakhes['export']['recordsCount'] != 0) {
            foreach ($relGhalamShakhes['export']['list'] as $v) {
                $v->delete();
            }
        }

        /** اضافه کردن اقلام جدید */
        if ($post['type'] == 'equal') {
            $newRelGhalamShakhes = new relGhalamShakhes();
            $newRelGhalamShakhes->shakhes_id = $post['shakhes_id'];
            $newRelGhalamShakhes->ghalam_id = $post['ghalams'];
            $newRelGhalamShakhes->type =  $post['type'];
            $newRelGhalamShakhes->save();
        } else if ($post['type'] == 'sum') {
            foreach ($post['ghalams'] as $ghalam_id) {
                $newRelGhalamShakhes = new relGhalamShakhes();
                $newRelGhalamShakhes->shakhes_id = $post['shakhes_id'];
                $newRelGhalamShakhes->ghalam_id = $ghalam_id;
                $newRelGhalamShakhes->type = $post['type'];
                $newRelGhalamShakhes->save();
            }
        } else if ($post['type'] == 'divid') {
            foreach ($post['ghalams']['up'] as $ghalam_id) {
                $newRelGhalamShakhes = new relGhalamShakhes();
                $newRelGhalamShakhes->shakhes_id = $post['shakhes_id'];
                $newRelGhalamShakhes->ghalam_id = $ghalam_id;
                $newRelGhalamShakhes->type = 'up';
                $newRelGhalamShakhes->save();
            }
            foreach ($post['ghalams']['down'] as $ghalam_id) {
                $newRelGhalamShakhes = new relGhalamShakhes();
                $newRelGhalamShakhes->shakhes_id = $post['shakhes_id'];
                $newRelGhalamShakhes->ghalam_id = $ghalam_id;
                $newRelGhalamShakhes->type = 'down';
                $newRelGhalamShakhes->save();
            }
        }

        //$result['sh_rel_ghalam_shakhes1'] = $newRelGhalamShakhes->fields;


        $result['status'] = 1;
        $result['msg'] = 'با موفقیت ویرایش شد.';
        return $result;
    }


    function khodezhari()

    {
        global $admin_info;

        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";


        // پیدا کردن قلم ها و کلان
        $obj = new shakhes();
        $query = 'select g.ghalam_id , r_k_s.kalan_no , g.ghalam   from sh_ghalam g
        inner join sh_rel_ghalam_shakhes r_g_s on g.ghalam_id = r_g_s.ghalam_id
        inner join sh_rel_kalan_shakhes r_k_s on r_g_s.shakhes_id = r_k_s.shakhes_id
        group by ghalam_id';
        $res = $obj->query($query)->getList();
        $ghalams = ($res['export']['recordsCount'] > 0) ?  $res['export']['list'] : array();



        //فیلترینگ
/*        if (isset($_GET['filter_columns'])) {
            $this->_selectedAdmins = explode(',', $_GET['filter_columns']);
        }*/
        $this->fileName = 'shakhes.khodezhari.php';
        $this->template(compact('shakhes', 'ghalams'));

        die();
    }
    // پیدا کردن قلم ها و کلان



    function jalasat()
    {
        global $messageStack, $dataStack;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        /* باید اول یک ذخیره موقت داشته باشن بعد ارسال به مافوق */
        include_once ROOT_DIR . 'component/shakhes/jalasat/jalasat.model.php';
        $jalasatObj = new jalasat;
        $jalasat = $jalasatObj->getAll()->getList()['export'];

        $options = $this->options('sh_jalasat');

        $this->fileName = 'shakhes.jalasat.php';
        $this->template(compact('jalasat', 'msg', 'options', 'data'));
        die();
    }

    function jalasatOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/jalasat/jalasat.model.php';
        $jalasatObj = new jalasat;


        /* اگه فرم درست پر نشه ارور بده */
        $filedsCount = 8 - count(array_filter(
            $post,
            function ($x) {
                return $x !== '';
            }
        ));
        if ($filedsCount !== 0 && !isset($post['confirm'])) {
            $result['msg'] = 'فیلد ها به درستی پر نشده اند. ' . (int) $filedsCount  . ' فیلد خالی می باشد.';
            $result['type'] = 'error';

            $dataStack->add_session('data', $post);
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $result['msg']);
        }



        /* ارسال فرم */
        if (isset($post['temporary'])) {
            $jalasatObj->setFields($post);
            $jalasatObj->date = convertJToGDate($jalasatObj->date);
            $jalasatObj->admin_id = $admin_info['admin_id'];
            $jalasatObj->status = 0;
            $jalasatObj->save();

            $result['msg'] = 'ثبت موقت انجام شد.';
            $result['type'] = 'warning';
        } elseif (isset($post['final'])) {
            $jalasatObj->setFields($post);
            $jalasatObj->date = convertJToGDate($jalasatObj->date);
            $jalasatObj->admin_id = $admin_info['admin_id'];
            $jalasatObj->status = 1;
            $jalasatObj->save();

            // محاسبه جدول import
            // اگر status 1 بود


            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } elseif (isset($post['confirm'])) {
            /* فقط برای اونایی که تایید میخوان */
            $jalasat = $jalasatObj::find((int)$post['confirm']);
            $jalasat->status = 1;
            $jalasat->save();

            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } else {
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $result['msg']);
    }

    function daneshamukhte()
    {
        global $messageStack, $dataStack;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        /* باید اول یک ذخیره موقت داشته باشن بعد ارسال به مافوق */
        include_once ROOT_DIR . 'component/shakhes/daneshamukhte/daneshamukhte.model.php';
        $daneshamukhteObj = new daneshamukhte;
        $daneshamukhte = $daneshamukhteObj->getAll()->getList()['export'];

        $options = $this->options('sh_daneshamukhte');

        $this->fileName = 'shakhes.daneshamukhte.php';
        $this->template(compact('daneshamukhte', 'msg', 'options', 'data'));
        die();
    }
    function daneshamukhteOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/daneshamukhte/daneshamukhte.model.php';
        $daneshamukhteObj = new daneshamukhte;


        /* اگه فرم درست پر نشه ارور بده */
        $error = 0;
        if($post['name_family'] == ''){
            $result['msg'] = 'فیلد نام و نام خانوادگی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['graduated_date'] == ''){
            $result['msg'] = 'فیلد تاریخ فارغ التحصیلی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['grade'] == ''){
            $result['msg'] = 'فیلد مقطع تکمیل نشده است.';
            $error = 1;
        }
        else if($post['course'] == ''){
            $result['msg'] = 'فیلد رشته تکمیل نشده است.';
            $error = 1;
        }
        else if($post['employed_status'] == ''){
            $result['msg'] = 'فیلد وضعیت اشتغال تکمیل نشده است.';
            $error = 1;
        }
        else if($post['organ_name'] == ''){
            $result['msg'] = 'فیلد نام سازمان مشغول به کار تکمیل نشده است.';
            $error = 1;
        }
        else if($post['continue_education'] == ''){
            $result['msg'] = 'فیلد وضعیت ادامه تحصیل تکمیل نشده است.';
            $error = 1;
        }

        if ($error == 1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
        }



        /* ارسال فرم */
        if (isset($post['temporary'])) {
            $daneshamukhteObj->setFields($post);
            $daneshamukhteObj->graduated_date = convertJToGDate($daneshamukhteObj->graduated_date);
            $daneshamukhteObj->admin_id = $admin_info['admin_id'];
            $daneshamukhteObj->status = 0;
            $daneshamukhteObj->save();

            $result['msg'] = 'ثبت موقت انجام شد.';
            $result['type'] = 'warning';
        } elseif (isset($post['final'])) {
            $daneshamukhteObj->setFields($post);
            $daneshamukhteObj->graduated_date = convertJToGDate($daneshamukhteObj->graduated_date);
            $daneshamukhteObj->admin_id = $admin_info['admin_id'];
            $daneshamukhteObj->status = 1;
            $daneshamukhteObj->save();

            // محاسبه جدول import
            // اگر status 1 بود


            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } elseif (isset($post['confirm'])) {
            /* فقط برای اونایی که تایید میخوان */
            $daneshamukhte = $daneshamukhteObj::find((int)$post['confirm']);
            $daneshamukhte->status = 1;
            $daneshamukhte->save();

            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } else {
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
    }

    


    function ruydad()
    {
        global $messageStack, $dataStack;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        /* باید اول یک ذخیره موقت داشته باشن بعد ارسال به مافوق */
        include_once ROOT_DIR . 'component/shakhes/ruydad/ruydad.model.php';
        $ruydadObj = new ruydad;
        $ruydad = $ruydadObj->getAll()->getList()['export'];

        /* عملیاتی */
        include_once ROOT_DIR . 'component/eghdam/model/eghdam.model.php';
        $eghdamObj = new eghdam;
        $eghdamTemp = $eghdamObj->getAll()->getList()['export']['list'];
        foreach ($eghdamTemp as $v) {
            //$amaliati[$v['amaliati_no']]['amaliati_no'] = $v['amaliati_no'];
            $amaliati[$v['amaliati_no']] = $v['amaliati'];
        }
        

        $options = $this->options('sh_ruydad');

        $this->fileName = 'shakhes.ruydad.php';
        $this->template(compact('ruydad', 'amaliati', 'msg', 'options', 'data'));
        die();
    }

    function ruydadOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/ruydad/ruydad.model.php';
        $ruydadObj = new ruydad;


        /* اگه فرم درست پر نشه ارور بده */
        /*$filedsCount = 20 - count(array_filter(
            $post,
            function ($x) {
                return $x !== '';
            }
        ));
        if ($filedsCount !== 0 && !isset($post['confirm'])) {
            $result['msg'] = 'فیلد ها به درستی پر نشده اند. ' . (int) $filedsCount  . ' فیلد خالی می باشد.';
            $result['type'] = 'error';

            $dataStack->add_session('data', $post);
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $result['msg']);
        }*/
        $error = 0;
        if($post['type'] == ''){
            $result['msg'] = 'فیلد قلم تکمیل نشده است.';
            $error = 1;
        }
        else if($post['title'] == ''){
            $result['msg'] = 'فیلد عنوان رویداد تکمیل نشده است.';
            $error = 1;
        }
        else if($post['startdate'] == ''){
            $result['msg'] = 'فیلد ابتدای دوره تکمیل نشده است.';
            $error = 1;
        }
        else if($post['finishdate'] == ''){
            $result['msg'] = 'فیلد انتهای دوره تکمیل نشده است.';
            $error = 1;
        }
        else if($post['time'] == ''){
            $result['msg'] = 'فیلد مدت زمان برگزاری (ساعت) تکمیل نشده است.';
            $error = 1;
        }
        else if($post['nationality'] == ''){
            $result['msg'] = 'فیلد وضعیت ملی/بین المللی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['main_executor'] == ''){
            $result['msg'] = 'فیلد مجری/برگزار کننده اصلی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['execute_type'] == ''){
            $result['msg'] = 'فیلد نحوه برگزاری تکمیل نشده است.';
            $error = 1;
        }
        else if($post['income'] == ''){
            $result['msg'] = 'فیلد درآمد کسب شده تکمیل نشده است.';
            $error = 1;
        }
        else if($post['website_link'] == ''){
            $result['msg'] = 'فیلد لینک رویداد بر روی سایت تکمیل نشده است.';
            $error = 1;
        }
        else if($post['hami_type'] == ''){
            $result['msg'] = 'فیلد عنوان حامی تکمیل نشده است.';
            $error = 1;
        }

        if ($error == 1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
        }


        /* ارسال فرم */
        if (isset($post['temporary'])) {
            $ruydadObj->setFields($post);
            $ruydadObj->startdate = convertJToGDate($ruydadObj->startdate);
            $ruydadObj->finishdate = convertJToGDate($ruydadObj->finishdate);
            $ruydadObj->admin_id = $admin_info['admin_id'];
            $ruydadObj->status = 0;
            $ruydadObj->save();

            $result['msg'] = 'ثبت موقت انجام شد.';
            $result['type'] = 'warning';
        } elseif (isset($post['final'])) {
            $ruydadObj->setFields($post);
            $ruydadObj->startdate = convertJToGDate($ruydadObj->startdate);
            $ruydadObj->finishdate = convertJToGDate($ruydadObj->finishdate);
            $ruydadObj->admin_id = $admin_info['admin_id'];
            $ruydadObj->status = 1;
            $ruydadObj->save();

            // محاسبه جدول import
            // اگر status 1 بود

            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } elseif (isset($post['confirm'])) {
            /* فقط برای اونایی که تایید میخوان */
            $ruydad = $ruydadObj::find((int)$post['confirm']);
            $ruydad->status = 1;
            $ruydad->save();

            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } else {
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $result['msg']);
    }

    function shora()
    {
        global $messageStack, $dataStack;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        /* باید اول یک ذخیره موقت داشته باشن بعد ارسال به مافوق */
        include_once ROOT_DIR . 'component/shakhes/shora/shora.model.php';
        $shoraObj = new shora;
        $shora = $shoraObj->getAll()->getList()['export'];

        $options = $this->options('sh_shora');

        $this->fileName = 'shakhes.shora.php';
        $this->template(compact('shora', 'msg', 'options', 'data'));
        die();
    }

    function shoraOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/shora/shora.model.php';
        $shoraObj = new shora;

        /* اگه فرم درست پر نشه ارور بده */
        $error = 0;
        if($post['shora_type'] == ''){
            $result['msg'] = 'فیلد عنوان شورا/کارگروه/انجمن تکمیل نشده است.';
            $error = 1;
        }
        else if($post['name_family'] == ''){
            $result['msg'] = 'فیلد نام و نام خانوادگی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['start_date'] == ''){
            $result['msg'] = 'فیلد شروع عضویت تکمیل نشده است.';
            $error = 1;
        }
        else if($post['nationality'] == ''){
            $result['msg'] = 'فیلد ملی/بین‌المللی تکمیل نشده است.';
            $error = 1;
        }
        else if($post['position'] == ''){
            $result['msg'] = 'فیلد درج عضویت در صفحه شخصی عضو هیات علمی تکمیل نشده است.';
            $error = 1;
        }


        if ($error == 1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
        }



        /* ارسال فرم */
        if (isset($post['temporary'])) {
            $shoraObj->setFields($post);
            $shoraObj->start_date = convertJToGDate($shoraObj->start_date);
            $shoraObj->finish_date = convertJToGDate($shoraObj->finish_date);
            $shoraObj->admin_id = $admin_info['admin_id'];
            $shoraObj->status = 0;
            $shoraObj->save();

            $result['msg'] = 'ثبت موقت انجام شد.';
            $result['type'] = 'warning';
        } elseif (isset($post['final'])) {
            $shoraObj->setFields($post);
            $shoraObj->start_date = convertJToGDate($shoraObj->start_date);
            $shoraObj->finish_date = convertJToGDate($shoraObj->finish_date);
            $shoraObj->admin_id = $admin_info['admin_id'];
            $shoraObj->status = 1;
            $shoraObj->save();

            // محاسبه جدول import
            // اگر status 1 بود


            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } elseif (isset($post['confirm'])) {
            /* فقط برای اونایی که تایید میخوان */
            $shora = $shoraObj::find((int)$post['confirm']);
            $shora->status = 1;
            $shora->save();

            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
        } else {
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $result['msg']);
    }

    function options($table)
    {
        include_once ROOT_DIR . 'component/shakhes/options/options.model.php';
        $optionsObj = new options();


        foreach ($optionsObj::getBy_table($table)->getList()['export']['list'] as $kl => $v) {
            $options[$v['field']][] = $v['option'];
        }

        return $options;
    }
}
