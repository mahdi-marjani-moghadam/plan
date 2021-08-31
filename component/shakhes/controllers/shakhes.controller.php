<?php


class shakhesController
{
    private $_selectedAdmins = array();
    private $admins = array();
    private $options = array();
    private $selectBoxAdmins = array();
    private $permissions = array();
    private $time = array();

    public function __construct()
    {
        global $admin_info;

        $this->exportType = 'html';
        /* همه ادمین ها */
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $adminObj = new admin;
        $this->admins = $adminObj->getAll()->keyBy('admin_id')->getList()['export']['list'];

        /* options */
        $this->options['jalasat'] = $this->options('sh_jalasat');
        $this->options['daneshamukhte'] = $this->options('sh_daneshamukhte');
        $this->options['ruydad'] = $this->options('sh_ruydad');
        $this->options['shora'] = $this->options('sh_shora');



        /* permissions */
        include_once ROOT_DIR . 'component/shakhes/model/forms_permission.model.php';
        $formsPermission = new formsPermission;
        $permissions = $formsPermission->getAll()->getList()['export']['list'];
        foreach ($permissions as  $item) {
            $this->permissions[$item['admin_id']]['admin_id'] = $item['admin_id'];
            $this->permissions[$item['admin_id']]['import_admin'] = $item['import_admin'];
            $this->permissions[$item['admin_id']]['confirm1'] = $item['confirm1'];
            $this->permissions[$item['admin_id']]['confirm2'] = $item['confirm2'];
        }

        /* زمان */
        $this->time = $this->checkAdminStatus($admin_info['admin_id']);
        // dd($this->time);
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

    public function selected($admins)
    {
        foreach ($admins as &$admin) {
            $admin['selected'] = 'false';

            if (in_array($admin['admin_id'], $this->_selectedAdmins)) {
                $admin['selected'] = 'true';
            }
        }


        return $admins;
    }

    public function childs($admins)
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

    public function showList()
    {
        global $admin_info;

        // اول بدست آوردن بچه ها از جدول admin , import_status
        $groups = $this->child();


        /** season */
        $rules = array('6', '12');
        if (in_array($_GET['s'], $rules)) {
            $season = handleData($_GET['s']);
        } else {
            if (in_array(STEP_FORM1, [1, 2])) {
                $season = '6';
            }

            if (in_array(STEP_FORM1, [3, 4])) {
                $season = '12';
            }

            $_GET['s'] = $season;
        }

        if (isset($_GET['y'])) {
            $year = explode('-', handleData($_GET['y']));
        } else {
            $year = array(1398, 1399);
        }

        /** admins filter */
        $list['showAdmin'] = $this->showAdmin();


        //دوم بدست آوردن قلم ها از جدول import
        $ghalamsNext = $this->getGhalam($groups, $year[1], $season);
        $ghalamsPrev = $this->getGhalam($groups, $year[0], $season);

        //           dd($ghalamsNext[102001]['admins'][1102]);
        //           dd($ghalamsPrev[102001]['admins'][1102]);

        // سوم برای بدست آوردن شاخص ها از جدول ghalam_shakhes , shakhes
        $shakhesNext = $this->getShakhesByGhalam($ghalamsNext);
        $shakhesPrev = $this->getShakhesByGhalam($ghalamsPrev);

        //         dd($shakhesNext);

        $reports = $this->getReports($shakhesNext, $ghalamsNext, $ghalamsPrev, $groups);

        $kalans = $reports['kalan'];
        unset($reports['kalan']);


        $this->fileName = 'shakhes.showList.php';
        $this->template(compact(
            'shakhesNext',
            'shakhesPrev',
            'reports',
            'kalans',
            'list',
            'groups',
            'ghalamsNext',
            'ghalamsPrev',
            'season',
            'child',
            'kalanTahlilArray'
        ));
        die();
    }

    private function child()
    {
        global $admin_info;


        /** filter by q  */
        $admin_id = $admin_info['admin_id'];
        $parent_id = $admin_info['parent_id'];
        $group_admin = $admin_info['group_admin'];
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';


        $admin = new admin();

        $admin->select('DISTINCT admin.admin_id, admin.name, admin.family, admin.group_admin, admin.parent_id, admin.groups, admin.flag');
        $admin->keyBy('admin_id');
        $admin->leftJoin('sh_import', 'admin.admin_id', '=', 'sh_import.motevali_admin_id');
        $admin->orderBy('`groups`,`flag`', 'asc');


        $admin->whereOpen('admin.parent_id', '<>', '0'); // <> 1


        if ($group_admin == 1 && $parent_id != 0) {
            /** login by daneshkade get danesdhkae and group */
            $admin->andWhere('admin.parent_id', '=', $parent_id); // 2111,2112,2113,2114,2115,2116
            $admin->orWhere('admin.admin_id', '=', $parent_id); // 211
        } else if ($admin_info['group_admin'] != 1) {
            /** login by group */
            $admin->andWhere('admin.admin_id', '=', $admin_id); // 2111
        }


        // از جدول import استفاده می کند

        $admin->orWhereOpen('sh_import.motevali_admin_id', '=', $admin_info['admin_id']); // 1102
        $admin->orWhere('sh_import.import', '=', $admin_info['admin_id']); // 1102
        $admin->orWhere('sh_import.confirm1', '=', $admin_info['admin_id']); // 1102
        $admin->orWhere('sh_import.confirm2', '=', $admin_info['admin_id']); // 1102
        $admin->orWhereClose('sh_import.confirm3', '=', $admin_info['admin_id']); // 1102

        $admin->andWhereClose('1', '=', '1');

        if (isset($_GET['qq'])) {



            $admin_id = '';
            $parent_id = trim($_GET['qq'], ',');
            $admin2 = $admin;
            $adminsinfo = $admin2->getAll()->select('admin.admin_id, admin.parent_id, admin.group_admin')
                ->where('parent_id', 'in', $parent_id)
                ->getList()['export']['list'];
            foreach ($adminsinfo as $admininfo) {
                $admin_id    .= $admininfo['admin_id'] . ',';
            }
            $admin_id = trim($admin_id, ',') . ',' . $parent_id;

            $admin->andWhere('admin.admin_id', 'in', $admin_id);
        }


        $groups = $admin->getList()['export']['list'];
        // dd($admin);
        // dd($groups);

        return $groups;
    }

    private function showAdmin()
    {
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $objAdmin = new admin();
        $result3 = $objAdmin->getAll()
            ->select('admin_id,name,family')
            ->where('parent_id', '=', 1);

        $result3 = $result3->getList();

        $list['showAdmin'] = $result3['export']['list'];
        return $list['showAdmin'];
    }


    public function getGhalam($admins, $year = '1399', $season = 6)
    {

        include_once ROOT_DIR . 'component/shakhes/model/import.model.php';
        $import = new import();
        $import->select('
        sh_ghalam.ghalam,
        sh_import.motevali_admin_id,
        sh_import.import,
        sh_import.ghalam_id,
        sh_import.value' . $season . '_import as value_import,
        sh_import.value' . $season . ' as value
        ');
        // $import->keyBy('ghalam_id');
        $import->leftJoin('sh_ghalam', 'sh_ghalam.ghalam_id', '=', 'sh_import.ghalam_id');
        $import->where('sh_import.motevali_admin_id', 'in', array_column($admins, 'admin_id'));
        $import->andWhere('year', '=', $year);
        $imports = $import->getList()['export']['list'];
        // dd($imports);
        $ghalam = array();
        foreach ($imports as $item) {
            // dd($item);
            $ghalam[$item['ghalam_id']]['ghalam'] = $item['ghalam'];
            $ghalam[$item['ghalam_id']]['ghalam_id'] = $item['ghalam_id'];
            $ghalam[$item['ghalam_id']]['admins'][$item['motevali_admin_id']]['motevali_admin_id'] = $item['motevali_admin_id'];
            $ghalam[$item['ghalam_id']]['admins'][$item['motevali_admin_id']]['import'] = $item['import'];

            $ghalam[$item['ghalam_id']]['admins'][$item['motevali_admin_id']]['value_import'] = $item['value_import'];
            $ghalam[$item['ghalam_id']]['admins'][$item['motevali_admin_id']]['value'] = $item['value'];
        }

        // dd($ghalam);
        return $ghalam;
    }

    public function getShakhesByGhalam($ghalams)
    {
        //         dd($ghalams);
        include_once ROOT_DIR . 'component/shakhes/model/rel.ghalam.shakhes.model.php';
        $relGhalamShakhes = new relGhalamShakhes();
        $relGhalamShakhes->select(' 
        sh_shakhes.shakhes, 
        sh_shakhes.shakhes_id, 
        sh_rel_kalan_shakhes.kalan_no,
        sh_rel_ghalam_shakhes.ghalam_id,
        sh_rel_ghalam_shakhes.type
        ');
        // $relGhalamShakhes->keyBy('sh_shakhes.id');
        $relGhalamShakhes->leftJoin('sh_shakhes', 'sh_shakhes.shakhes_id', '=', 'sh_rel_ghalam_shakhes.shakhes_id');
        $relGhalamShakhes->leftJoin('sh_rel_kalan_shakhes', 'sh_rel_kalan_shakhes.shakhes_id', '=', 'sh_rel_ghalam_shakhes.shakhes_id');
        $relGhalamShakhes->where('sh_rel_ghalam_shakhes.ghalam_id', 'in', implode(',', array_unique(array_keys($ghalams))));
        $rels = $relGhalamShakhes->getList()['export']['list'];
        // dd($rels);
        foreach ($rels as $rel) {
            // dd($ghalams);
            $shakhes[$rel['shakhes_id']]['shakhes'] = $rel['shakhes'];
            $shakhes[$rel['shakhes_id']]['shakhes_id'] = $rel['shakhes_id'];
            $shakhes[$rel['shakhes_id']]['kalan_no'] = $rel['kalan_no'];
            $shakhes[$rel['shakhes_id']]['function'] = $this->shakhesFunction($rel['shakhes_id']);
            // $functionsRequirement[$rel['shakhes_id']][$rel['type']][$rel['ghalam_id']]['admins'] = $ghalams[$rel['ghalam_id']];
        }

        //         dd($shakhes);

        // $shakhes = $this->getAllShakhesFunctionsKeyByShakhesId($functionsRequirement, $shakhes);
        // dd($shakhes);

        // dd($relGhalamShakhes);

        return $shakhes;
    }

    private function getAllShakhesFunctionsKeyByShakhesId($requirement, $shakhes)
    {
        // dd($requirement);
        foreach ($requirement as $shakhes_id => $sh) {

            foreach ($sh as $type => $ghalamAdmin) {
                foreach ($ghalamAdmin as $ghalam_id => $gh) {
                    // dd($shakhes);
                    foreach ($gh['admins'] as $motevali => $import) {
                        $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['ghalam'] = $import['ghalam'];

                        // dd($shakhes);
                        if ($type == 'equal') {
                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard6'] = $import['value6'];
                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard12'] = $import['value12'];
                            // dd($shakhes);
                        } else if ($type == 'sum') {
                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard6'] = $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard6'] + $import['value6'];
                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard12'] = $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard12'] + $import['value12'];

                            // dd('s');
                        } else {
                            $up6 = $up12 = $down6 = $down12 = 0;
                            if ($type == 'up') {
                                $up6 = $up6 + $import['value6'];
                                $up12 = $up12 + $import['value12'];
                            } else {
                                $down6 = $down6 + $import['value6'];
                                $down12 = $down12 + $import['value12'];
                            }

                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard6'] = $up6 / $down6;
                            $shakhes[$shakhes_id]['ghalams'][$ghalam_id]['admins'][$motevali]['amalkard12'] = $up12 / $down12;


                            // dd('ss');
                        }
                    }
                }
            }
        }

        // dd($shakhes);
        return $shakhes;
    }

    public function shakhesFunction($skakhesId = '0')
    {
        include_once ROOT_DIR . 'component/shakhes/model/rel.ghalam.shakhes.model.php';
        $relGhalamShakhes = new relGhalamShakhes();

        $resp = $relGhalamShakhes->where('shakhes_id', '=', $skakhesId)->getList()['export']['list'];
        // dd($resp);   
        $func = '';
        foreach ($resp as  $sh) {
            $type = $sh['type'];
            if ($type == 'equal') {
                $func = $sh['ghalam_id'];
            } else if ($type == 'sum') {
                $func = $func . '+' . $sh['ghalam_id'];
            } else {

                if ($type == 'up') {
                    $up = $up . '+' . $sh['ghalam_id'];
                } else {
                    $down = $down . '+' . $sh['ghalam_id'];
                }
                $func = trim($up, '+') . '/' . trim($down, '+');

                // dd('ss');
            }
            // dd($sh);
        }

        return trim($func, '+');
    }

    public function getReports($sh, $ghN, $ghP, $admins)
    {

        foreach ($sh as $shakhes_id => $shakhes) {

            $function = $shakhes['function'];

            $amalkardNext = $this->calcuteFunction($function, $ghN);
            // dd($amalkardNext);
            $amalkardPrev = $this->calcuteFunction($function, $ghP);
            $data[$shakhes_id] = $EupNext = $EupPrev = $EdownNext = $EdownPrev =  array();
            // dd($admins);
            foreach ($admins as $motevali => $admin) {

                // اول واحد ها پر میشن بعد کل واحد 
                //برای اینکه دچار مشکل نشه وقتی به کل واحد میرسیم ازش با شرط زیر رد میشیم

                if ($admin['parent_id'] != 1) {
                    //براي واحد ها
                    //نهايي
                    $nerkh[$motevali]['value'] = (($amalkardNext[$motevali]['value'] / $amalkardPrev[$motevali]['value']) - 1) * 100;
                    $darsad[$motevali]['value'] = ($amalkardNext[$motevali]['value'] / $this->standard($shakhes_id, $motevali)) * 100;

                    $data[$shakhes_id][$motevali]['amalkardNext']['value'] = $amalkardNext[$motevali]['value'];
                    $data[$shakhes_id][$motevali]['amalkardPrev']['value'] = $amalkardPrev[$motevali]['value'];
                    $data[$shakhes_id][$motevali]['nerkh']['value'] = $nerkh[$motevali]['value'];
                    $data[$shakhes_id][$motevali]['darsad']['value'] = $darsad[$motevali]['value'];

                    $data['kalan'][$shakhes['kalan_no']][$motevali]['darsad']['value'] += $data[$shakhes_id][$motevali]['darsad']['value'] * $this->shakhesVazn($shakhes_id, $motevali);
                    $data['kalan'][$shakhes['kalan_no']][$motevali]['darsad']['value_import'] += $data[$shakhes_id][$motevali]['darsad']['value_import'] * $this->shakhesVazn($shakhes_id, $motevali);

                    // اعلامي
                    $nerkh[$motevali]['value_import'] = (($amalkardNext[$motevali]['value_import'] / $amalkardPrev[$motevali]['value_import']) - 1) * 100;
                    $darsad[$motevali]['value_import'] = ($amalkardNext[$motevali]['value_import'] / $this->standard($shakhes_id, $motevali)) * 100;

                    $data[$shakhes_id][$motevali]['amalkardNext']['value_import'] = $amalkardNext[$motevali]['value_import'];
                    $data[$shakhes_id][$motevali]['amalkardPrev']['value_import'] = $amalkardPrev[$motevali]['value_import'];
                    $data[$shakhes_id][$motevali]['nerkh']['value_import'] = $nerkh[$motevali]['value_import'];
                    $data[$shakhes_id][$motevali]['darsad']['value_import'] = $darsad[$motevali]['value_import'];



                    //براي  کل واحد
                    // Ez

                    for ($i = 1; $i <= 2; $i++) {

                        $tmp = array(1 => 'value', 2 => 'value_import');

                        $EupNext[$tmp[$i]] +=  $amalkardNext[$motevali]['up'][$tmp[$i]];
                        if (isset($amalkardNext[$motevali]['down'][$tmp[$i]])) {
                            $EdownNext[$tmp[$i]] +=  $amalkardNext[$motevali]['down'][$tmp[$i]];
                        } else {
                            $EdownNext[$tmp[$i]] += 0;
                        }

                        $EupPrev[$tmp[$i]] +=  $amalkardPrev[$motevali]['up'][$tmp[$i]];
                        if (isset($amalkardPrev[$motevali]['down'][$tmp[$i]])) {
                            $EdownPrev[$tmp[$i]] +=  $amalkardPrev[$motevali]['down'][$tmp[$i]];
                        } else {
                            $EdownPrev[$tmp[$i]] += 0;
                        }

                        // if ($admin['parent_id'] == 110 && $i == 1) {
                        //     echo 'motevali:' . $motevali . ' -';
                        //     // echo ' parent:'.$admin['parent_id'].' -';
                        //     echo ' EupNex:'.$EupNext[$tmp[$i]] . ' -';
                        //     echo ' EdownNex:'.$EdownNext[$tmp[$i]] . ' - ';
                        //     echo ' amaliati:' . $EupNext[$tmp[$i]] / (($EdownNext[$tmp[$i]] == 0) ? 1 : $EdownNext[$tmp[$i]]) . ' <br>';
                        // }
                        $data[$shakhes_id][$admin['parent_id']]['amalkardNext'][$tmp[$i]] = $EupNext[$tmp[$i]] / (($EdownNext[$tmp[$i]] == 0) ? 1 : $EdownNext[$tmp[$i]]);
                        $data[$shakhes_id][$admin['parent_id']]['amalkardPrev'][$tmp[$i]] = $EupPrev[$tmp[$i]] / (($EdownPrev[$tmp[$i]] == 0) ? 1 : $EdownPrev[$tmp[$i]]);

                        $data[$shakhes_id][$admin['parent_id']]['nerkh'][$tmp[$i]] = (($data[$shakhes_id][$admin['parent_id']]['amalkardNext'][$tmp[$i]] / $data[$shakhes_id][$admin['parent_id']]['amalkardPrev'][$tmp[$i]]) - 1) * 100;
                        $data[$shakhes_id][$admin['parent_id']]['darsad'][$tmp[$i]] = ($data[$shakhes_id][$admin['parent_id']]['amalkardNext'][$tmp[$i]] / $this->standard($shakhes_id, $admin['parent_id'])) * 100;

                        // if ($admin['parent_id'] == 110 && $i == 1) {
                        //     echo $data[$shakhes_id][$admin['parent_id']]['amalkardNext'][$tmp[$i]].'-';
                        //     echo $data[$shakhes_id][$admin['parent_id']]['darsad'][$tmp[$i]];
                        //     echo '<br>';
                        // }
                        $data['kalan'][$shakhes['kalan_no']][$admin['parent_id']]['darsad'][$tmp[$i]] += $data[$shakhes_id][$admin['parent_id']]['darsad'][$tmp[$i]] * $this->shakhesVazn($shakhes_id, $admin['parent_id']);
                    }
                } else {
                    //ترتیب این خط خیلی مهمه برای محاسبه کل واحد باید اینجا ریست بشه
                    //برای حل مشکل کل واحد الهیات اینجا گذاشته شده
                    $EupNext = $EupPrev = $EdownNext = $EdownPrev = array();
                }
            }
            // dd(1);
            // dd($data);
        }
        return $data;
    }
    private function calcuteFunction($func, $gh)
    {
        // $func = '101109+101109/101109+101109';
        // $func = '101109/101109';
        // $func = '101109';

        $f = explode('/', $func);
        $functionUp = explode('+', $f[0]);
        $v = $d = array();
        foreach ($functionUp as $ghId) {
            foreach ($gh[$ghId]['admins'] as $g) {
                //براي واحد ها
                $v[$g['motevali_admin_id']]['value'] += $g['value'];
                $v[$g['motevali_admin_id']]['value_import'] += $g['value_import'];

                $v[$g['motevali_admin_id']]['up']['value'] = $v[$g['motevali_admin_id']]['value'];
                $v[$g['motevali_admin_id']]['up']['value_import'] = $v[$g['motevali_admin_id']]['value_import'];
            }
        }
        // dd($v);

        if (isset($f[1])) {
            $functionDown = explode('+', $f[1]);
            $lastFunctionDown = count($functionDown);

            foreach ($functionDown as $ghId) {
                $lastFunctionDown--;

                foreach ($gh[$ghId]['admins'] as $g) {
                    $d[$g['motevali_admin_id']]['value'] += $g['value'];
                    $d[$g['motevali_admin_id']]['value_import'] += $g['value_import'];


                    $v[$g['motevali_admin_id']]['down']['value'] = $d[$g['motevali_admin_id']]['value'];
                    $v[$g['motevali_admin_id']]['down']['value_import'] = $d[$g['motevali_admin_id']]['value_import'];

                    if ($lastFunctionDown == 0) {
                        $v[$g['motevali_admin_id']]['value'] = $v[$g['motevali_admin_id']]['value'] / $v[$g['motevali_admin_id']]['down']['value'];
                        $v[$g['motevali_admin_id']]['value_import'] = $v[$g['motevali_admin_id']]['value_import'] / $v[$g['motevali_admin_id']]['down']['value_import'];
                    }
                }
            }


            // dd($g['motevali_admin_id']);
        }
        // dd($d);
        // dd($v);
        return $v;
    }
    private function standard($shakhes, $admin)
    {
        include_once ROOT_DIR . 'component/shakhes/model/rel.shakhes.admin.model.php';
        $relShakhesAdmin = new relShakhesAdmin();
        $resp = $relShakhesAdmin->where('shakhes_id', '=', $shakhes)->andWhere('admin_id', '=', $admin)->first();

        return $resp->shakhes_standard;
    }
    private function shakhesVazn($shakhes, $admin)
    {
        include_once ROOT_DIR . 'component/shakhes/model/rel.shakhes.admin.model.php';
        $relShakhesAdmin = new relShakhesAdmin();
        $resp = $relShakhesAdmin->where('shakhes_id', '=', $shakhes)->andWhere('admin_id', '=', $admin)->first();

        return $resp->shakhes_vazn;
    }

















    public function adminSetting()
    {
        global $admin_info, $PARAM, $messageStack;
        $msg = $messageStack->output('message');


        //پیدا کردن شماره صفحه
        $SUB_FOLDER = 'admin';
        $url_main = substr($_SERVER['REQUEST_URI'], strlen($SUB_FOLDER) + 1);
        $url_main = urldecode($url_main);
        $PARAM = explode('/', $url_main);
        $PARAM = array_filter($PARAM, 'strlen');
        if (array_search('page', $PARAM)) {
            $index_pageSize = array_search('page', $PARAM);
            $page = $PARAM[$index_pageSize + 1];
        } else {
            $page = 1;
        }


        include_once ROOT_DIR . "component/shakhes/model/ghalam.model.php";
        $ghalam = new ghalam();
        include_once ROOT_DIR . "component/shakhes/model/import.model.php";
        $obj = new import();


        $PAGE_SIZE = 10;
        $filter['limit']['start'] = (isset($page)) ? ($page - 1) * $PAGE_SIZE : '0';
        $filter['limit']['length'] = $PAGE_SIZE;

        $res = $obj->getByFilter($filter);
        $pagination = $this->pagination($res, $PAGE_SIZE)['export']['list'];

        $import = ($res['export']['recordsCount'] > 0) ?  $res['export']['list'] : array();

        $ghalamStr = implode(',', array_column($import, 'ghalam_id'));
        // dd($ghalamStr);
        $ghalams = $ghalam->where('ghalam_id', 'in', $ghalamStr)->keyBy('ghalam_id')->getList();
        $ghalamName = ($ghalams['export']['recordsCount'] > 0) ?  $ghalams['export']['list'] : array();

        include_once ROOT_DIR . "component/admin/model/admin.model.php";
        // پیدا کردن ستون های واحد
        if ($admin_info['parent_id'] == 0 || $admin_info['admin_id'] == 3121 || $admin_info['admin_id'] == 6) { // مدیریت دانشگاه

            $query = 'select admin_id,name,family from admin where  parent_id <> 1 or parent_id <> 0 order by parent_id';
            $admins = $obj->query($query)->getList()['export']['list'];
            $admins = $this->selected($admins);

            //$child = $this->childs($admins);
            //print_r_debug($admins);
        } elseif ($admin_info['group_admin'] == 1) { // دانشکده
        } else { // واحد
        }



        $this->fileName = 'shakhes.adminSetting.php';
        $this->template(compact('import', 'admins', 'ghalamName', 'pagination', 'msg', 'page'));
        die();
    }
    public function adminSettingOnSubmmit()
    {
        global $messageStack;
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/model/import.model.php';
        include_once ROOT_DIR . 'component/shakhes/model/import_confirm.model.php';
        foreach ($post['import'] as $id => $import) {
            /* ghalam */
            $importObj = import::getBy_id($id);
            if ($importObj->get()['export']['recordsCount'] > 0) {
                $importObj = $importObj->first();
            } else {
                $importObj = new import;
            }

            $importObj->ghalam_id = $importObj->ghalam_id;
            $importObj->motevali_admin_id = $import['motevali_admin_id'];
            $importObj->import = $import['import'];
            $importObj->confirm1 = $import['confirm1'];
            $importObj->confirm2 = $import['confirm2'];
            $importObj->confirm3 = $import['confirm3'];
            $importObj->confirm4 = 1;
            $importObj->value6 = 0;
            $importObj->value12 = 0;
            $importObj->year = explode('/', convertDate(date('Y')))[0];
            $importObj->save();
        }

        $result['msg'] = 'با موفقیت انجام شد.';
        $messageStack->add_session('message', $result['msg'], 'success');
        redirectPage(RELA_DIR . 'admin/page/1/?component=shakhes&action=adminSetting', $result['msg']);
    }
    private function pagination($res = array(), $PAGE_SIZE = 10)
    {
        $pageCount = ceil($res['export']['recordsCount'] / $PAGE_SIZE);


        $pagination = array();
        $temp = 1;
        $SUB_FOLDER = 'admin';
        $url_main = substr($_SERVER['REQUEST_URI'], strlen($SUB_FOLDER) + 1);
        $url_main = urldecode($url_main);

        $PARAM = explode('/', $url_main);


        $PARAM = array_filter($PARAM, 'strlen');


        if (array_search('page', $PARAM)) {
            $index_pageSize = array_search('page', $PARAM);

            unset($PARAM[$index_pageSize]);
            unset($PARAM[$index_pageSize + 1]);

            $PARAM = implode('/', $PARAM);

            $PARAM = explode('/', $PARAM);
            $PARAM = array_filter($PARAM, 'strlen');
        }


        for ($i = 1; $i <= $pageCount; $i++) {
            $pagination[] = RELA_DIR . 'admin' . '/page/' . $temp . '/' . $PARAM[0];
            $temp = $temp + 1;
        }

        $result['result'] = 1;
        $result['export']['list'] = $pagination;
        return $result;
    }
    /**
      تنظیمات شاخص
      نمایش لیست شاخص ها
     */
    public function shakhesSetting()
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

        include_once ROOT_DIR . 'component/eghdam/model/eghdam.model.php';
        $obj3 = new eghdam();
        $kalans = $obj3->getAll()->groupBy('kalan_no')->keyBy('kalan_no')->getList()['export']['list'];



        $this->fileName = 'shakhes.setting.showList.php';
        $this->template(compact('shakhes', 'ghalam', 'kalans'));
        die();
    }


    public function shakhesDelete($post)
    {
        include ROOT_DIR . "component/shakhes/model/shakhes.model.php";

        $shakhes = shakhes::find($post['id']);

        dd($shakhes);
    }

    public function settingAdd($post)
    {

        /** اخرین شاخص */
        include_once ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        $query = 'select max(shakhes_id) from sh_shakhes';
        $res = $obj->query($query)->getList();

        echo json_encode($res);
        die();


        /** shakhes */


        /** rel ghalam shakhes */

        /** nerkh */

        /** kalan shakhes */



        $result['status'] = 1;
        $result['msg'] = 'با موفقیت ساخته شد.';
        return $result;
    }

    public function settingEdit($post)
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
        } elseif ($post['type'] == 'sum') {
            foreach ($post['ghalams'] as $ghalam_id) {
                $newRelGhalamShakhes = new relGhalamShakhes();
                $newRelGhalamShakhes->shakhes_id = $post['shakhes_id'];
                $newRelGhalamShakhes->ghalam_id = $ghalam_id;
                $newRelGhalamShakhes->type = $post['type'];
                $newRelGhalamShakhes->save();
            }
        } elseif ($post['type'] == 'divid') {
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


    public function khodezhari()
    {

        global $messageStack, $dataStack, $admin_info;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');


        // پیدا کردن قلم ها و کلان
        include_once ROOT_DIR . "component/shakhes/model/shakhes.model.php";
        include_once ROOT_DIR . "component/shakhes/model/ghalam.model.php";
        // include_once ROOT_DIR . "component/shakhes/model/import_status.model.php";
        include_once ROOT_DIR . "component/admin/model/admin_status.model.php";
        include_once ROOT_DIR . "component/admin/model/admin.model.php";
        $obj = new shakhes();
        $ghalam = new ghalam();
        // $importStatus = new importStatus(); 
        $admin = new admin();



        // 1
        // همه شاخص ها
        $shakhes = $obj->getAll()->getList()['export'];



        // 2
        // مقادیر داخل باکس فیلتر
        $filterAdminsSelectbox = $admin->getAll()->keyBy('admin_id')->select('admin_id,name,family')->where('parent_id', '=', 1)->getList();
        $filterAdminsSelectbox = ($filterAdminsSelectbox['export']['recordsCount'] > 0) ?  $filterAdminsSelectbox['export']['list'] : array();



        // 3
        //فیلتر کردن بر اساس filterAdmin
        if (isset($_GET['filterAdmin']) && is_numeric($_GET['filterAdmin'])) {
            $temp = $admin->where('parent_id', '=', $_GET['filterAdmin'])->getList();
            $temp = ($temp['export']['recordsCount'] > 0) ?  $temp['export']['list'] : array();
            $filter['admins'] = 'and motevali_admin_id in (' . implode(',', array_column($temp, 'admin_id')) . ')';
        }




        // 4
        // قلم ها و مقادیر وارد شده - وضعیت - توضیحاتی تایید کننده ها
        $query = "select 
            i.*
        from sh_import i
        where i.ghalam_id not in (select ghalam_id from sh_rel_ghalam_zir_ghalam)
        and (i.import = '{$admin_info['admin_id']}'
        or i.confirm1 = '{$admin_info['admin_id']}'
        or i.confirm2 = '{$admin_info['admin_id']}'
        or i.confirm3 = '{$admin_info['admin_id']}'
        or i.confirm4 = '{$admin_info['admin_id']}')
        {$filter['admins']}
        and year = " . KHODEZHARI_YEAR . "
        order by i.ghalam_id ";
        $res = $obj->query($query)->getList();
        $imports = ($res['export']['recordsCount'] > 0) ?  $res['export']['list'] : array();

        // dd($imports);




        // 5
        // کل قلم ها
        $ghalams = $ghalam->getAll()->keyBy('ghalam_id')->getList();
        $ghalamName = ($ghalams['export']['recordsCount'] > 0) ?  $ghalams['export']['list'] : array();
        // dd($ghalams);



        // 6
        //ادمین ها
        $admins = $admin->getAll()->keyBy('admin_id')->select('admin_id,name,family,parent_id')->getList();
        $adminName = ($admins['export']['recordsCount'] > 0) ?  $admins['export']['list'] : array();



        // 7
        //وضعیت قلم های ارسالی
        // $motevali =  implode(',', array_unique(array_column($imports, 'motevali_admin_id')));
        // $query = "SELECT import,motevali,status6,status12 FROM sh_import_status 
        // WHERE motevali IN($motevali) 
        // AND (import = {$admin_info['admin_id']} 
        // OR confirm1 = {$admin_info['admin_id']} 
        // OR confirm2 = {$admin_info['admin_id']} 
        // OR confirm3 = {$admin_info['admin_id']})
        // ";
        // $importStatus = $importStatus->query($query)->keyBy('motevali')->getList();
        // $adminStatus = ($importStatus['export']['recordsCount'] > 0) ?  $importStatus['export']['list'] : array();

        // 7
        // وضعیت متولی
        $query = "select 
        i.motevali_admin_id,i.status6, i.status12
        from sh_import i
        where i.ghalam_id not in (select ghalam_id from sh_rel_ghalam_zir_ghalam)
        and (i.import = '{$admin_info['admin_id']}'
        or i.confirm1 = '{$admin_info['admin_id']}'
        or i.confirm2 = '{$admin_info['admin_id']}'
        or i.confirm3 = '{$admin_info['admin_id']}'
        or i.confirm4 = '{$admin_info['admin_id']}')
        {$filter['admins']}
        and year = " . KHODEZHARI_YEAR . "
        and (status6 != 'finish' or status12 = 'finish')
        group by status12,motevali_admin_id
         ";
        $res2 = $obj->query($query)->getList();
        $importStatusAll = ($res2['export']['recordsCount'] > 0) ?  $res2['export']['list'] : array();
        
        
        $statusA = array_flip(array('finish','sendToConfirm4','sendToConfirm3','sendToConfirm2','sendToConfirm1','backToEdit','0'));
        
        foreach ($importStatusAll as $k => $v) {
            $importStatus[$v['motevali_admin_id']]['motevali_admin_id'] = $v['motevali_admin_id'];


            for ($i = 1; $i <= 2; $i++) {
                $j = $i * 6;
                
                if(!isset($importStatus[$v['motevali_admin_id']]['status' . $j])){
                    $importStatus[$v['motevali_admin_id']]['status' . $j] = $v['status' . $j];
                }
 
                if($statusA[$v['status' . $j]] > $statusA[$importStatus[$v['motevali_admin_id']]['status' . $j]])
                {
                    $importStatus[$v['motevali_admin_id']]['status' . $j] = $v['status' . $j];
                }
                

            }

        }
        
        $this->fileName = 'shakhes.khodezhari.php';
        $this->template(compact('shakhes', 'imports', 'ghalamName', 'adminName', 'filterAdminsSelectbox', 'importStatus'));

        die();
    }


    public function khodezhariOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;
        include_once ROOT_DIR . 'component/shakhes/model/import.model.php';
        // include_once ROOT_DIR . 'component/shakhes/model/import_status.model.php';
        $importObj = new import();
        // $importStatusObj = new importStatus();

        if (STEP_FORM1 <= 2) {
            $val = 'value6';
            $tozihat = 'import_tozihat6';
            $status = 'status6';
        } elseif (STEP_FORM1 > 2 && STEP_FORM1 <= 4) {
            $val = 'value12';
            $tozihat = 'import_tozihat12';
            $status = 'status12';
        }




        /* ارسال فرم */
        if (isset($post['temporary'])) {

            // همه قلم ها مقدار دهی میشن
            foreach ($post['import'] as $id => $item) {
                $import = $importObj->find($id);

                $import->$val = $item[$val];
                $import->$tozihat = $item[$tozihat];
                $import->year = explode('/', convertDate(date('Y')))[0];
                $import->save();
            }

            // $allMotevali = implode(',', $allMotevali);

            $result['msg'] = 'ثبت موقت انجام شد.';
            $result['type'] = 'warning';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari', $result['msg']);
        } elseif (isset($post['sendToConfirm1'])) {


            // $post['import'] = $importObj->where('id', 'in', $post['importsIdSendToConfirm'])->get()['export']['list'];


            // همه قلم ها مقدار دهی میشن
            foreach ($post['import'] as $id => $item) {
                $import = $importObj->find($id);

                $import->$val = $post['import'][$id][$val];
                $import->$tozihat = $post['import'][$id][$tozihat];

                if ($import->confirm1 != 0) {
                    $import->$status = 'sendToConfirm1';
                } elseif ($import->confirm2 != 0) {
                    $import->$status = 'sendToConfirm2';
                } elseif ($import->confirm3 != 0) {
                    $import->$status = 'sendToConfirm3';
                } else {
                    $import->$status = 'sendToConfirm4';
                }

                $import->save();
            }


            $result['msg'] = '.ثبت نهایی انجام شد';
            $result['type'] = 'success';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari&filterAdmin=' . $post['filterAdmin'] . '#topOfTable', $result['msg']);
        } elseif (isset($post['backToEdit'])) {

            //تغییر ساختار
            dd(1);

            // include_once ROOT_DIR . "component/admin/model/admin_status.model.php";
            // $adminStatus = new adminStatus();
            // $motevali = implode(',', array_unique($post['motevali']));
            // $adminStatus = $adminStatus->where('admin_id', 'in', $motevali)->get();
            // foreach ($adminStatus['export']['list'] as $s) {
            //     $s->$status = 'backToEdit';
            //     $s->save();
            // }

            // $result['msg'] = 'نیاز به اصلاح ارسال شد.';
            // $result['type'] = 'success';
            // $messageStack->add_session('message', $result['msg'], $result['type']);
            // redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari' . '', $result['msg']);
        } elseif (isset($post['sendToConfirm2'])) {


            $post['import'] = $importObj->where('id', 'in', $post['importsIdSendToConfirm'])->get()['export']['list'];


            // همه قلم ها مقدار دهی میشن
            foreach ($post['import'] as $id => $import) {


                if ($import->confirm2 != 0) {
                    $import->$status = 'sendToConfirm2';
                } elseif ($import->confirm3 != 0) {
                    $import->$status = 'sendToConfirm3';
                } else {
                    $import->$status = 'sendToConfirm4';
                }

                $import->save();
            }




            $result['msg'] = '.تایید اطلاعات صورت گرفت و برای واحد مربوطه ارسال شد';
            $result['type'] = 'success';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari&filterAdmin=' . $post['filterAdmin'] . '#topOfTable', $result['msg']);
        } elseif (isset($post['sendToConfirm3'])) {


            $post['import'] = $importObj->where('id', 'in', $post['importsIdSendToConfirm'])->get()['export']['list'];


            // همه قلم ها مقدار دهی میشن
            foreach ($post['import'] as $id => $import) {


                if ($import->confirm3 != 0) {
                    $import->$status = 'sendToConfirm3';
                } else {
                    $import->$status = 'sendToConfirm4';
                }
                $import->save();
            }


            $result['msg'] = '. ارسال2 صورت گرفت';
            $result['type'] = 'success';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari&filterAdmin=' . $post['filterAdmin'] . '#topOfTable', $result['msg']);
        } elseif (isset($post['sendToConfirm4'])) {

            // همه قلم ها مقدار دهی میشن
            $post['import'] = $importObj->where('id', 'in', $post['importsIdSendToConfirm'])->get()['export']['list'];

            foreach ($post['import'] as $id => $import) {
                $import->$status = 'sendToConfirm4';
                $import->save();
            }

            $result['msg'] = '. ارسال3 صورت گرفت';
            $result['type'] = 'success';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari&filterAdmin=' . $post['filterAdmin'] . '#topOfTable', $result['msg']);
        } elseif (isset($post['finish'])) {


            // همه قلم ها مقدار دهی میشن
            $post['import'] = $importObj->where('id', 'in', $post['importsIdSendToConfirm'])->get()['export']['list'];

            foreach ($post['import'] as $id => $import) {
                $import->$status = 'finish';
                $import->save();
            }

            $result['msg'] = '. تایید نهایی';
            $result['type'] = 'success';
            $messageStack->add_session('message', $result['msg'], $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=khodezhari&filterAdmin=' . $post['filterAdmin'] . '#topOfTable', $result['msg']);
        }
    }

    public function backToEdit()
    {

        include_once ROOT_DIR . 'component/shakhes/model/import.model.php';
        $importObj = new import();
        $import = $importObj::find($_POST['importid']);
        $field  = $_POST['tozihatFieldName'];
        $status = 'status' . $_POST['season'];
        $import->$field = $_POST['tozihat'];
        $import->$status = 'backToEdit';
        $import->save();

        echo true;
        die();
    }



    public function jalasat()
    {
        global $messageStack, $dataStack, $admin_info;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');


        $this->selectBoxAdmins('jalasat');
        $importAdmins = $this->importAdmins('jalasat');

        // dd($importAdmins);
        /* اول باید ببینیم کسی که لاگین کرده چه
        import_admin
        رو میبینه */
        include_once ROOT_DIR . 'component/shakhes/model/jalasat.model.php';
        $jalasatObj = new jalasat;

        $jalasatObj->select('sh_jalasat.*');
        $jalasatObj->where('sh_jalasat.admin_id', 'in', $importAdmins['admins'])->orWhere('sh_jalasat.import_admin', 'in', $importAdmins['admins']);
        $jalasatObj->orderBy('id', 'desc');
        $jalasat = $jalasatObj->getList()['export'];

        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }

        if (count($data) <= 1 && isset($_GET['id']) && is_numeric($_GET['id'])) {

            $editObj = $jalasatObj::find($_GET['id']);

            if (!is_object($editObj) && $editObj['result'] == -1) {
                $messageStack->add_session('message', $editObj['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $editObj['msg']);
            }
            if ($editObj->status != 0 && $editObj->status != 1) {
                $result['msg'] = 'شما نمی توانید این فرم را ویرایش کنید.';
                $messageStack->add_session('message', $result['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $result['msg']);
            }
            $data = $editObj->fields;
        } else {
            $data['date'] = convertJToGDate($data['date']);
        }


        $this->fileName = 'shakhes.jalasat.php';
        $this->template(compact('jalasat', 'msg', 'data', 'importAdmins'));
        die();
    }



    public function jalasatOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/model/jalasat.model.php';
        $jalasatObj = new jalasat;


        if ($this->time['import_time'] == -1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $msg = 'تاریخ اتمام ' . convertDate($this->time['finish_date']) . ' می باشد.';
            $messageStack->add_session('message', $msg, $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $msg);
        }


        /* ارسال فرم */
        if (isset($post['temporary']) || isset($post['edit'])) {
            /* اگه فرم درست پر نشه ارور بده */
            /* اگه فرم درست پر نشه ارور بده */
            $error = 0;
            $this->selectBoxAdmins('jalasat');
            if (count($this->selectBoxAdmins) == 0) {
                $result['msg'] = 'نیاز به تکمیل این فرم برای شما نمی باشد';
                $error = 1;
            } elseif ($post['session'] == '') {
                $result['msg'] = 'فیلد جلسه تکمیل نشده است.';
                $error = 1;
            } elseif ($post['date'] == '') {
                $result['msg'] = 'فیلد زمان برگزاری تکمیل نشده است.';
                $error = 1;
            } elseif ($post['manager_list'] == '') {
                $result['msg'] = 'فیلد اعضای هیات رئیسه حاضر در جلسه تکمیل نشده است.';
                $error = 1;
            } elseif ($post['member_count'] == '') {
                $result['msg'] = 'فیلد تعداد شرکت کنندگان تکمیل نشده است.';
                $error = 1;
            } elseif ($post['grade'] == '') {
                $result['msg'] = 'فیلد مقطع تکمیل نشده است.';
                $error = 1;
            } elseif ($post['course'] == '') {
                $result['msg'] = 'فیلد رشته تکمیل نشده است.';
                $error = 1;
            } elseif ($post['eligible_students'] == '') {
                $result['msg'] = 'فیلد تعداد کل دانشجویان مشمول تکمیل نشده است.';
                $error = 1;
            } elseif ($post['subject'] == '') {
                $result['msg'] = 'فیلد رئوس موضوعات طرح شده در جلسه تکمیل نشده است.';
                $error = 1;
            } elseif (isset($post['edit']) && !is_numeric($post['edit'])) {
                $result['msg'] = 'Error id!';
                $error = 1;
            }

            if ($error == 1) {
                $result['type'] = 'error';
                $dataStack->add_session('data', $post);
                $messageStack->add_session('message', $result['msg'], $result['type']);
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat' . ((isset($post['edit'])) ? '&id=' . $post['edit'] : ''), $result['msg']);
            }

            if (isset($post['edit']) && isset($post['edit'])) {

                $editObj = $jalasatObj::find((int) $post['edit']);

                if (!is_object($editObj) && $editObj['result'] == -1) {
                    $messageStack->add_session('message', $editObj['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $editObj['msg']);
                }
                if ($editObj->status != 0  && $editObj->status != 1) {
                    $result['msg'] = 'شما نمی توانید این شورا را ویرایش کنید.';
                    $messageStack->add_session('message', $result['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $result['msg']);
                }
                $jalasatObj = $editObj;
            }

            $jalasatObj->setFields($post);
            $jalasatObj->date = convertJToGDate($jalasatObj->date);
            $jalasatObj->status = 1;
            $jalasatObj->import_admin = $admin_info['admin_id'];
            $jalasatObj->save();
            // dd($jalasatObj);
            $result['msg'] = (isset($post['edit'])) ? 'ویرایش انجام شد' : 'ثبت موقت انجام شد.';
            $result['type'] = (isset($post['edit'])) ? 'success' : 'warning';
        } else {
            $result = $this->onSubmitZirGhalam($jalasatObj, $post);
            $jalasatObj = $result['obj'];
        }

        if (isset($post['confirmFinal'])) {
            /* اینجا باید فرم خوداظهاری اپدیت بشه */
            $this->updateImport($jalasatObj, 208, 'member_count');
            $this->updateImport($jalasatObj, 209, 'eligible_students');
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=jalasat', $result['msg']);
    }



    public function daneshamukhte()
    {
        global $messageStack, $dataStack, $admin_info;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        $this->selectBoxAdmins('daneshamukhte');
        $importAdmins = $this->importAdmins('daneshamukhte');




        include_once ROOT_DIR . 'component/shakhes/model/daneshamukhte.model.php';
        $daneshamukhteObj = new daneshamukhte;

        $daneshamukhteObj->select('sh_daneshamukhte.*');
        $daneshamukhteObj->where('sh_daneshamukhte.admin_id', 'in', $importAdmins['admins'])->orWhere('sh_daneshamukhte.import_admin', 'in', $importAdmins['admins']);
        $daneshamukhteObj->orderBy('id', 'desc');
        $daneshamukhte = $daneshamukhteObj->getList()['export'];


        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }

        if (count($data) <= 1 && isset($_GET['id']) && is_numeric($_GET['id'])) {

            $editObj = $daneshamukhteObj::find($_GET['id']);

            if (!is_object($editObj) && $editObj['result'] == -1) {
                $messageStack->add_session('message', $editObj['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $editObj['msg']);
            }
            if ($editObj->status != 0 && $editObj->status != 1) {
                $result['msg'] = 'شما نمی توانید این فرم را ویرایش کنید.';
                $messageStack->add_session('message', $result['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
            }
            $data = $editObj->fields;
        } else {
            $data['graduated_date'] = convertJToGDate($data['graduated_date']);
        }



        $this->fileName = 'shakhes.daneshamukhte.php';
        $this->template(compact('daneshamukhte', 'msg', 'data', 'importAdmins'));
        die();
    }


    public function daneshamukhteOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/model/daneshamukhte.model.php';
        $daneshamukhteObj = new daneshamukhte;

        if ($this->time['import_time'] == -1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $msg = 'تاریخ اتمام ' . convertDate($this->time['finish_date']) . ' می باشد.';
            $messageStack->add_session('message', $msg, $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $msg);
        }



        /* ارسال فرم */
        if (isset($post['temporary']) || isset($post['edit'])) {
            /* اگه فرم درست پر نشه ارور بده */
            $error = 0;
            $this->selectBoxAdmins('daneshamukhte');

            if (count($this->selectBoxAdmins) == 0) {
                $result['msg'] = '.نیاز به تکمیل این فرم برای شما نمی باشد';
                $error = 1;
            } elseif ($post['student_status'] == '') {
                $result['msg'] = 'فیلد دانشجو/دانش آموخته تکمیل نشده است.';
                $error = 1;
            } elseif ($post['name_family'] == '') {
                $result['msg'] = 'فیلد نام و نام خانوادگی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['graduated_date'] == '') {
                $result['msg'] = 'فیلد تاریخ فارغ التحصیلی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['grade'] == '') {
                $result['msg'] = 'فیلد مقطع تکمیل نشده است.';
                $error = 1;
            } elseif ($post['course'] == '') {
                $result['msg'] = 'فیلد رشته تکمیل نشده است.';
                $error = 1;
            } elseif ($post['employed_status'] == '') {
                $result['msg'] = 'فیلد وضعیت اشتغال تکمیل نشده است.';
                $error = 1;
            } elseif ($post['organ_name'] == '') {
                $result['msg'] = 'فیلد نام سازمان مشغول به کار تکمیل نشده است.';
                $error = 1;
            } elseif ($post['continue_education'] == '') {
                $result['msg'] = 'فیلد وضعیت ادامه تحصیل تکمیل نشده است.';
                $error = 1;
            } elseif (isset($post['edit']) && !is_numeric($post['edit'])) {
                $result['msg'] = 'Error id!';
                $error = 1;
            }

            if ($error == 1) {
                $result['type'] = 'error';
                $dataStack->add_session('data', $post);
                $messageStack->add_session('message', $result['msg'], $result['type']);
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte' . ((isset($post['edit'])) ? '&id=' . $post['edit'] : ''), $result['msg']);
            }

            if (isset($post['edit']) && isset($post['edit'])) {

                $editObj = $daneshamukhteObj::find((int) $post['edit']);

                if (!is_object($editObj) && $editObj['result'] == -1) {
                    $messageStack->add_session('message', $editObj['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $editObj['msg']);
                }
                if ($editObj->status != 0  && $editObj->status != 1) {
                    $result['msg'] = 'شما نمی توانید این مورد را ویرایش کنید.';
                    $messageStack->add_session('message', $result['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
                }
                $daneshamukhteObj = $editObj;
            }


            $daneshamukhteObj->setFields($post);
            $daneshamukhteObj->graduated_date = convertJToGDate($daneshamukhteObj->graduated_date);
            $daneshamukhteObj->import_admin = $admin_info['admin_id'];
            $daneshamukhteObj->status = 0;
            $daneshamukhteObj->save();

            $result['msg'] = (isset($post['edit'])) ? 'ویرایش انجام شد' : 'ثبت موقت انجام شد.';
            $result['type'] = (isset($post['edit'])) ? 'success' : 'warning';
        } else {
            $result = $this->onSubmitZirGhalam($daneshamukhteObj, $post);
            $daneshamukhteObj = $result['obj'];
        }


        if (isset($post['confirmFinal'])) {

            /* اینجا باید فرم خوداظهاری اپدیت بشه */
            $this->updateImport($daneshamukhteObj, 210, 'continue_education');
            $this->updateImport($daneshamukhteObj, 211, 'employed_status');
            $this->updateImport($daneshamukhteObj, 212, '');
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=daneshamukhte', $result['msg']);
    }




    public function ruydad()
    {
        global $messageStack, $dataStack, $admin_info;

        include_once ROOT_DIR . 'component/shakhes/model/ruydad.model.php';
        $ruydadObj = new ruydad;

        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        $this->selectBoxAdmins('ruydad');
        $importAdmins = $this->importAdmins('ruydad');
        // dd($importAdmins);

        $ruydadObj->select('sh_ruydad.*');
        // $ruydadObj->leftJoin('sh_forms_permission', 'sh_forms_permission.admin_id', '=', 'sh_ruydad.import_admin');
        $ruydadObj->where('sh_ruydad.admin_id', 'in', $importAdmins['admins'])->orWhere('sh_ruydad.import_admin', 'in', $importAdmins['admins']);
        // $ruydadObj->andWhere('sh_forms_permission.table','=','ruydad');
        $ruydadObj->orderBy('id', 'desc');
        $ruydad = $ruydadObj->getList()['export'];

        // $ruydad = $this->getFormsPermisstion($importAdmins,'ruydad');

        // dd($ruydadObj);
        // dd($ruydad);

        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }

        if (count($data) <= 1 && isset($_GET['id']) && is_numeric($_GET['id'])) {

            $editObj = $ruydadObj::find($_GET['id']);

            if (!is_object($editObj) && $editObj['result'] == -1) {
                $messageStack->add_session('message', $editObj['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $editObj['msg']);
            }
            if ($editObj->status != 0 && $editObj->status != 1) {
                $result['msg'] = 'شما نمی توانید این رویداد را ویرایش کنید.';
                $messageStack->add_session('message', $result['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $result['msg']);
            }
            $data = $editObj->fields;
        } else {
            $data['startdate'] = convertJToGDate($data['startdate']);
            $data['finishdate'] = convertJToGDate($data['finishdate']);
        }

        $this->fileName = 'shakhes.ruydad.php';
        $this->template(compact('ruydad', 'msg', 'data', 'importAdmins'));
        die();
    }

    public function ruydadOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/model/ruydad.model.php';
        $ruydadObj = new ruydad;

        if ($this->time['import_time'] == -1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $msg = 'تاریخ اتمام ' . convertDate($this->time['finish_date']) . ' می باشد.';
            $messageStack->add_session('message', $msg, $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $msg);
        }


        /* ارسال فرم */
        if (isset($post['temporary']) || isset($post['edit'])) {
            /* اگه فرم درست پر نشه ارور بده */
            $error = 0;
            $this->selectBoxAdmins('ruydad');
            if (count($this->selectBoxAdmins) == 0) {
                $result['msg'] = 'نیاز به تکمیل این فرم برای شما نیاز به تکمیل این فرم برای شما نمی باشد';
                $error = 1;
            } elseif ($post['type'] == '') {
                $result['msg'] = 'فیلد نوع رویداد تکمیل نشده است.';
                $error = 1;
            } elseif ($post['amaliati_no'] == '') {
                $result['msg'] = 'فیلد هدف اصلی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['title'] == '') {
                $result['msg'] = 'فیلد عنوان رویداد تکمیل نشده است.';
                $error = 1;
            } elseif ($post['startdate'] == '') {
                $result['msg'] = 'فیلد ابتدای دوره تکمیل نشده است.';
                $error = 1;
            } elseif ($post['finishdate'] == '') {
                $result['msg'] = 'فیلد انتهای دوره تکمیل نشده است.';
                $error = 1;
            } elseif ($post['time'] == '') {
                $result['msg'] = 'فیلد مدت زمان برگزاری (ساعت) تکمیل نشده است.';
                $error = 1;
            } elseif ($post['nationality'] == '') {
                $result['msg'] = 'فیلد وضعیت ملی/بین المللی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['main_executor'] == '') {
                $result['msg'] = 'فیلد مجری/برگزار کننده اصلی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['execute_type'] == '') {
                $result['msg'] = 'فیلد نحوه برگزاری تکمیل نشده است.';
                $error = 1;
            } elseif ($post['income'] == '') {
                $result['msg'] = 'فیلد درآمد کسب شده تکمیل نشده است.';
                $error = 1;
            } elseif ($post['cost'] == '') {
                $result['msg'] = 'فیلد مبلغ هزینه شده تکمیل نشده است.';
                $error = 1;
            } elseif ($post['website_link'] == '') {
                $result['msg'] = 'فیلد لینک رویداد بر روی سایت تکمیل نشده است.';
                $error = 1;
            } elseif (isset($post['edit']) && !is_numeric($post['edit'])) {
                $result['msg'] = 'Error id!';
                $error = 1;
            }
            if ($error == 1) {
                $result['type'] = 'error';
                $dataStack->add_session('data', $post);
                $messageStack->add_session('message', $result['msg'], $result['type']);
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad' . ((isset($post['edit'])) ? '&id=' . $post['edit'] : ''), $result['msg']);
            }

            if (isset($post['edit']) && isset($post['edit'])) {

                $editObj = $ruydadObj::find((int) $post['edit']);

                if (!is_object($editObj) && $editObj['result'] == -1) {
                    $messageStack->add_session('message', $editObj['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $editObj['msg']);
                }
                if ($editObj->status != 0  && $editObj->status != 1) {
                    $result['msg'] = 'شما نمی توانید این رویداد را ویرایش کنید.';
                    $messageStack->add_session('message', $result['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $result['msg']);
                }
                $ruydadObj = $editObj;
            }

            $ruydadObj->setFields($post);
            $ruydadObj->startdate = convertJToGDate($ruydadObj->startdate);
            $ruydadObj->finishdate = convertJToGDate($ruydadObj->finishdate);
            $ruydadObj->import_admin = $admin_info['admin_id'];
            $ruydadObj->status = 0;
            $ruydadObj->save();
            // dd($ruydadObj);

            $result['msg'] = (isset($post['edit'])) ? 'ویرایش انجام شد' : 'ثبت موقت انجام شد.';
            $result['type'] = (isset($post['edit'])) ? 'success' : 'warning';
        } else {
            $result = $this->onSubmitZirGhalam($ruydadObj, $post);
            $ruydadObj = $result['obj'];
        }
        if (isset($post['confirmFinal'])) {

            /* اینجا باید فرم خوداظهاری اپدیت بشه */
            $this->updateImport($ruydadObj, 213, 'income');
            $this->updateImport($ruydadObj, 214, 'cost');
            $this->updateImport($ruydadObj, 215, '');

            //$this->updateImport($ruydad, 209, 'eligible_students');
        }


        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=ruydad', $result['msg']);
    }




    public function shora()
    {
        global $messageStack, $dataStack, $admin_info;
        $msg = $messageStack->output('message');
        $data = $dataStack->output('data');

        $this->selectBoxAdmins('shora');
        $importAdmins = $this->importAdmins('shora');


        include_once ROOT_DIR . 'component/shakhes/model/shora.model.php';
        $shoraObj = new shora;

        $shoraObj->select('sh_shora.*');
        $shoraObj->where('.sh_shora.admin_id', 'in', $importAdmins['admins'])->orWhere('sh_shora.import_admin', 'in', $importAdmins['admins']);
        $shoraObj->orderBy('id', 'desc');
        $shora = $shoraObj->getList()['export'];



        if (isset($_GET['id'])) {
            $data['id'] = $_GET['id'];
        }

        if (count($data) <= 1 && isset($_GET['id']) && is_numeric($_GET['id'])) {

            $editObj = $shoraObj::find($_GET['id']);

            if (!is_object($editObj) && $editObj['result'] == -1) {
                $messageStack->add_session('message', $editObj['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $editObj['msg']);
            }
            if ($editObj->status != 0 && $editObj->status != 1) {
                $result['msg'] = 'شما نمی توانید این شورا را ویرایش کنید.';
                $messageStack->add_session('message', $result['msg'], 'error');
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $result['msg']);
            }
            $data = $editObj->fields;
        } else if (count($data) > 0) {

            $data['start_date'] = convertJToGDate($data['start_date']);
            $data['finish_date'] = convertJToGDate($data['finish_date']);
        }


        $this->fileName = 'shakhes.shora.php';
        $this->template(compact('shora', 'msg', 'data', 'importAdmins'));
        die();
    }

    public function shoraOnSubmit()
    {
        global $messageStack, $admin_info, $dataStack;
        $result = array();
        $post = $_POST;

        include_once ROOT_DIR . 'component/shakhes/model/shora.model.php';
        $shoraObj = new shora;

        if ($this->time['import_time'] == -1) {
            $result['type'] = 'error';
            $dataStack->add_session('data', $post);
            $msg = 'تاریخ اتمام ' . convertDate($this->time['finish_date']) . ' می باشد.';
            $messageStack->add_session('message', $msg, $result['type']);
            redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $msg);
        }





        /* ارسال فرم */
        if (isset($post['temporary']) || isset($post['edit'])) {
            /* اگه فرم درست پر نشه ارور بده */
            $error = 0;
            $this->selectBoxAdmins('shora');
            if (count($this->selectBoxAdmins) == 0) {
                $result['msg'] = 'نیاز به تکمیل این فرم برای شما نمی باشد';
                $error = 1;
            } elseif ($post['shora_type'] == '') {
                $result['msg'] = 'فیلد عنوان شورا/کارگروه/انجمن تکمیل نشده است.';
                $error = 1;
            } elseif ($post['name_family'] == '') {
                $result['msg'] = 'فیلد نام و نام خانوادگی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['start_date'] == '') {
                $result['msg'] = 'فیلد شروع عضویت تکمیل نشده است.';
                $error = 1;
            } elseif ($post['nationality'] == '') {
                $result['msg'] = 'فیلد ملی/بین‌المللی تکمیل نشده است.';
                $error = 1;
            } elseif ($post['position'] == '') {
                $result['msg'] = 'فیلد سمت/پست تکمیل نشده است.';
                $error = 1;
            } elseif ($post['personal_page'] == '') {
                $result['msg'] = 'فیلد درج عضویت در صفحه شخصی عضو هیات علمی تکمیل نشده است.';
                $error = 1;
            } elseif (isset($post['edit']) && !is_numeric($post['edit'])) {
                $result['msg'] = 'Error id!';
                $error = 1;
            }


            if ($error == 1) {
                $result['type'] = 'error';
                $dataStack->add_session('data', $post);
                $messageStack->add_session('message', $result['msg'], $result['type']);
                redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora' . ((isset($post['edit'])) ? '&id=' . $post['edit'] : ''), $result['msg']);
            }

            if (isset($post['edit']) && isset($post['edit'])) {

                $editObj = $shoraObj::find((int) $post['edit']);

                if (!is_object($editObj) && $editObj['result'] == -1) {
                    $messageStack->add_session('message', $editObj['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $editObj['msg']);
                }
                if ($editObj->status != 0  && $editObj->status != 1) {
                    $result['msg'] = 'شما نمی توانید این شورا را ویرایش کنید.';
                    $messageStack->add_session('message', $result['msg'], 'error');
                    redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $result['msg']);
                }
                $shoraObj = $editObj;
            }

            $shoraObj->setFields($post);
            $shoraObj->start_date = convertJToGDate($shoraObj->start_date);
            $shoraObj->finish_date = convertJToGDate($shoraObj->finish_date);
            $shoraObj->import_admin = $admin_info['admin_id'];
            $shoraObj->status = 0;
            $shoraObj->save();

            $result['msg'] = (isset($post['edit'])) ? 'ویرایش انجام شد' : 'ثبت موقت انجام شد.';
            $result['type'] = (isset($post['edit'])) ? 'success' : 'warning';
        } else {
            $result = $this->onSubmitZirGhalam($shoraObj, $post);
            $shoraObj = $result['obj'];
        }
        if (isset($post['confirmFinal'])) {
            /* اینجا باید فرم خوداظهاری اپدیت بشه */
            $this->updateImport($shoraObj, 216, '');


            //$this->updateImport($ruydad, 209, 'eligible_students');
        }



        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=shora', $result['msg']);
    }




    private function onSubmitZirGhalam($class, $post)
    {
        if (isset($post['sendToParent'])) {
            /* فقط برای اونایی که تایید میخوان */
            $obj = $class::find((int)$post['sendToParent']);
            $obj->status = 2;
            $obj->save();

            $result['obj'] = $obj;
            $result['msg'] = '. ارسال به مافوق انجام شد';
            $result['type'] = 'success';
        } elseif (isset($post['sendToEdit'])) {
            $obj = $class::find((int)$post['sendToEdit']);
            $obj->status = 1;
            $obj->save();

            $result['obj'] = $obj;
            $result['msg'] = '.نیاز به اصلاح';
            $result['type'] = 'success';
        } elseif (isset($post['confirm'])) {
            $obj = $class::find((int)$post['confirm']);
            $obj->status = 3;
            $obj->save();

            $result['obj'] = $obj;
            $result['msg'] = '.   تایید مافوق';
            $result['type'] = 'success';
        } elseif (isset($post['confirmFinal'])) {
            $obj = $class::find((int)$post['confirmFinal']);
            $obj->status = 4;
            $obj->save();

            $result['obj'] = $obj;
            $result['msg'] = '.   تایید نهایی ';
            $result['type'] = 'success';
        }
        return $result;
    }

    public function onDelete($className)
    {
        global  $messageStack;
        $id = $_GET['id'];
        include_once ROOT_DIR . 'component/shakhes/model/' . $className . '.model.php';
        $Obj = $className::find($id);
        $Obj->delete();

        $result['msg'] = 'با موفقیت انجام شد.';
        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=' . $className, $result['msg']);
    }


    public function edit($className)
    {
        dd('edit()');
        global $messageStack;
        $id = $_POST['edit'];
        include_once ROOT_DIR . 'component/shakhes/model/' . $className . '.model.php';
        $Obj = $className::find($id);
        $Obj->status = 1;

        $Obj->save();

        $result['msg'] = 'با موفقیت انجام شد.';
        $messageStack->add_session('message', $result['msg'], $result['type']);
        redirectPage(RELA_DIR . 'admin/?component=shakhes&action=' . $className, $result['msg']);
    }


    public function options($table)
    {
        include_once ROOT_DIR . 'component/shakhes/model/options.model.php';
        $optionsObj = new options();


        foreach ($optionsObj::getBy_table($table)->getList()['export']['list'] as $kl => $v) {
            $options[$v['field']][] = $v['option'];
        }

        return $options;
    }

    public function updateImport($zirGhalam, $ghalam_id, $field)
    {
        $value = (STEP_FORM1 < 3) ? 'value6' : 'value12';
        include_once ROOT_DIR . 'component/shakhes/model/import.model.php';
        $importObj = new import;
        $import = $importObj::getBy_motevali_admin_id_and_ghalam_id($zirGhalam->admin_id, $ghalam_id)->get()['export'];
        if ($import['recordsCount'] == 0) {
            $importObj->motevali_admin_id = $zirGhalam->admin_id;
            $importObj->ghalam_id = $ghalam_id;
            $importObj->$value = 0;
            $importObj->year = explode('/', convertDate(date('Y')))[0];
        } else {
            $importObj = $import['list'][0];
        }

        if (in_array($ghalam_id, [209, 213, 214])) { // jalasat
            $importObj->$value = $importObj->$value + $zirGhalam->$field;
            $importObj->save();
        } elseif (
            in_array($ghalam_id, [210]) && $zirGhalam->$field == 'شاغل به تحصیل در مقطع بالاتر'
            || in_array($ghalam_id, [211]) && $zirGhalam->$field == 'شاغل'
        ) {
            $importObj->$value = $importObj->$value + 1;
            $importObj->save();
        } elseif (in_array($ghalam_id, [208, 212, 215, 216])) {
            $importObj->$value = $importObj->$value + 1;
            $importObj->save();
        }

        // include_once ROOT_DIR . 'component/shakhes/model/import_confirm.model.php';
        // $impConfObj = new importConfirm;
        // $impConf = $impConfObj::getBy_sh_import_id($importObj->id)->get()['export'];
        // if ($impConf['recordsCount'] == 0) {
        //     $impConfObj->sh_import_id = $importObj->id;
        //     $impConfObj->admin = $importObj->motevali_admin_id;
        //     $impConfObj->admin_type = 'external';
        //     $impConfObj->$value = 0;
        // } else {
        //     $impConfObj = $impConf['list'][0];
        // }
        // if (in_array($ghalam_id, [208, 209, 212, 213, 214, 215, 216])) {
        //     $impConfObj->$value = $importObj->$value;
        //     $impConfObj->save();
        // } elseif (
        //     in_array($ghalam_id, [210]) && $zirGhalam->$field == 'شاغل به تحصیل در مقطع بالاتر'
        //     || in_array($ghalam_id, [211]) && $zirGhalam->$field == 'شاغل'
        // ) {
        //     $impConfObj->$value = $importObj->$value;
        //     $impConfObj->save();
        // }


        // return compact('importObj', 'impConfObj');
        return compact('importObj');
    }

    private function importAdmins($table)
    {
        global $admin_info;
        include_once ROOT_DIR . 'component/shakhes/model/jalasat.model.php';
        $jalasatObj = new jalasat;
        $query = "select distinct(admin_id) from sh_forms_permission p
                    where p.table = '" . $table . "'
                        and (p.admin_id = {$admin_info['admin_id']}
                        or   p.import_admin = {$admin_info['admin_id']}
                        or  p.confirm1 = {$admin_info['admin_id']}
                        or p.confirm2 = {$admin_info['admin_id']})";

        $ids['admins'] = array_column($jalasatObj->query($query)->getList()['export']['list'], 'admin_id');

        array_push($ids['admins'], $admin_info['admin_id']);
        $ids['admins'] = array_unique($ids['admins']);


        include_once ROOT_DIR . 'component/shakhes/model/forms_permission.model.php';
        $formsPermission = new formsPermission();

        $formsPermission->select('admin_id,confirm1,confirm2');
        $formsPermission->keyBy('admin_id');
        $formsPermission->where('admin_id', 'in', $ids['admins']);
        $formsPermission->andWhere('`table`', '=', $table);
        $ids['confirms'] = $formsPermission->getList()['export']['list'];


        // dd($formsPermission);

        // dd($ids);
        return $ids;
    }


    private function checkAdminStatus($adminId)
    {
        /* manager */
        if ($adminId == 1) {
            return array(
                'result' => 1,
                'import_time' => 1,
                'confirm_time' => 1
            );
        }


        include_once ROOT_DIR . 'component/shakhes/model/admin_status.model.php';
        $obj = new adminStatus;
        $adminStatusObj = $obj::getBy_admin_id($adminId)->get()['export'];

        if ($adminStatusObj['recordsCount'] == 0) {
            $result['import_time'] = -1;
            $result['confirm_time'] = -1;
            $result['status'] = -1;
            $result['msg'] = 'زمانی برای این ادمین پیدا نشد';
        }
        $adminStatusObj = $adminStatusObj['list'][0];


        $result['start_date'] = $adminStatusObj->start_date;
        $result['finish_date'] = $adminStatusObj->finish_date;
        // $result['start_date_confirm'] = $adminStatusObj->start_date_confirm;
        // $result['finish_date_confirm'] = $adminStatusObj->finish_date_confirm;
        $result['status6'] = $adminStatusObj->status6;
        $result['status12'] = $adminStatusObj->status12;


        if (date('Y-m-d') >= $adminStatusObj->start_date && date('Y-m-d') <= $adminStatusObj->finish_date) {
            $result['import_time'] = 1;
        } else {
            $result['import_time'] = -1;
        }
        // if (date('Y-m-d') >= $adminStatusObj->start_date_confirm && date('Y-m-d') <= $adminStatusObj->finish_date_confirm) {
        //     $result['confirm_time'] = 1;
        // } else {
        //     $result['confirm_time'] = -1;
        // }


        return $result;
    }

    private  function selectBoxAdmins($table)
    {
        global $admin_info;
        /* ادمین هایی که توی لیست میشه انتخاب کرد */
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $adminObj = new admin();
        $query = "select a.name,a.family,a.admin_id from admin a
                    inner join sh_forms_permission s
                    on a.admin_id = s.admin_id
                    
                    where a.parent_id not in (0,1) and s.table='$table' and s.import_admin = '{$admin_info['admin_id']}'";

        $this->selectBoxAdmins = $adminObj->query($query)->getList()['export']['list'];
        return true;
    }




    private function shakhesReport($shakhes, $ghalams)
    {
        // dd($ghalams);

        // o اعلامی = value_import
        // o' نهایی = value6 / value12
        // A نرخ رشد = amalkard 99 / amalkard 98 - 1 * 100
        // B درصد تحقق = A / shakhes_standard * amalkard 99
        // C =  E (B * shakhes_vazn) وزن شاخص در هر هدف

        // o'o' = E (value_import * ghalam_vazn)
        // oo = E (value_import * ghalam_vazn)

    }



    private function nerkhRoshd($amalkard, $prevAmalkard)
    {
    }
}
