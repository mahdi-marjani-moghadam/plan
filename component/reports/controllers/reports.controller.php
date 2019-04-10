<?php

include_once ROOT_DIR.'component/reports/model/reports.model.php';

class reportsController
{
    public $exportType;
    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';
    }
    public function template($list = array(), $msg='')
    {
        global $messageStack,$member_info;

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
        die();
    }


    function reportsProcess2(){


        /**
         * faaliat and eghdam for this admin
         */
        $child = $this->child2();

        /**
         * get kalan list
         */
        $list = $this->getKalanList($child);

        return $list;

        //print_r_debug($list['kalans'][1]['amaliatis'][11]);
    }
    function child2(){
        global $admin_info;

        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $adminObj = new admin();

        if($admin_info['group_admin'] == 1 ){

            /**
             * login by daneshkade va manager va arzyab
             */
            $child = $adminObj->getAll()->select('admin.admin_id');

            if($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1){
                /**
                 * arzyab
                 */
                $child =   $child->join('admin_faaliat','admin_faaliat.child','=',' admin.admin_id');
                $child =   $child->where('admin_faaliat.admin_id','=',$admin_info['admin_id']);
            }
            else if($admin_info['admin_id'] != 1)
            {
                /**
                 *  vahed
                 */
                $child =   $child->where('parent_id','=',$admin_info['parent_id']);
            }

            $child = $child->getList()['export']['list'];

            $childstr = '';
            foreach ($child as $k => $v){
                if(strpos($childstr,$v['admin_id']) === false){
                    $childstr .= $v['admin_id'].',';
                }
            }
            $childstr = substr($childstr,0,-1);

        }
        else{
            /**
             * login by group
             */
            $childstr = $admin_info['admin_id'];
        }


        return $childstr;


    }
    function getKalanList($child = ''){
        include_once ROOT_DIR . 'component/group_list/model/group_list.model.php';
        $groupListObj = new group_list();
        /*$rows = $eghdamObj
            ->leftJoin('faaliat'      ,'faaliat.eghdam_id'       ,'=', 'eghdam.eghdam_id')
            ->leftJoin('faaliat_vazn' ,'faaliat_vazn.faaliat_id' ,'=', 'faaliat.faaliat_id')
            ->leftJoin('admin'        ,'faaliat_vazn.admin_id'   ,'=', 'admin.admin_id')
            ->leftJoin('group_list'   ,'admin.admin_id'        ,'=', 'group_list.parent_id')
            ->select('kalan,kalan_no,amaliati,amaliati_no,eghdam,eghdam.eghdam_id,faaliat.faaliat,faaliat.faaliat_id,faaliat_vazn.admin_id,admin.name as admin_name,admin.family')
            ->where('faaliat_vazn.admin_id','in',$child)
            ->getList();*/

        $rowsObj = $groupListObj
            ->select('
            e.kalan,e.kalan_no,
            e.amaliati,e.amaliati_no, 
            e.eghdam,e.eghdam_id,
            f.faaliat,f.faaliat_id,
            group_list.parent_id as admin_id, 
            aa.name as admin_name,group_list.admin_id as group_id , ag.name as group_name, ag.family as group_family,
            fv.faaliat_vazn,
            
            group_list.admin_percent1,
            group_list.admin_percent2,
            group_list.admin_percent3,
            group_list.admin_percent4,
            
            group_list.manager1_1,
            group_list.manager1_2,
            group_list.manager1_3,
            
            
            group_list.manager2_1,
            group_list.manager2_2,
            group_list.manager2_3,
            
            
            group_list.manager3_1,
            group_list.manager3_2,
            group_list.manager3_3,
            
            
            group_list.manager4_1,
            group_list.manager4_2,
            group_list.manager4_3,
            
            
            group_list.max1,
            group_list.max2,
            group_list.max3,
            group_list.max4,
            
            group_list.max_manager1,
            group_list.max_manager2,
            group_list.max_manager3,
            group_list.max_manager4,
            
            group_list.admin_file1,
            group_list.admin_file2,
            group_list.admin_file3,
            group_list.admin_file4,
            
            group_list.admin_tozihat1,
            group_list.admin_tozihat2,
            group_list.admin_tozihat3,
            group_list.admin_tozihat4,
            
            group_list.tahlil1,
            group_list.tahlil2,
            group_list.tahlil3,
            group_list.tahlil4,
            
            group_list.tahlil_manager1,
            group_list.tahlil_manager2,
            group_list.tahlil_manager3,
            group_list.tahlil_manager4
            
            ')
            ->leftJoin('faaliat as f'      ,'f.faaliat_id','=','group_list.faaliat_id')
            ->leftJoin('eghdam as e'       ,'e.eghdam_id','=','f.eghdam_id')
            ->leftJoin('admin as aa'       ,'aa.admin_id','=','group_list.parent_id')
            ->leftJoin('admin as ag'       ,'ag.admin_id','=','group_list.admin_id')
            ->leftJoin('faaliat_vazn as fv','fv.faaliat_id','=','group_list.faaliat_id and fv.admin_id = aa.admin_id');

        if($child){
            $rowsObj = $rowsObj->where('group_list.admin_id' ,'in',$child);
        }
        $rowsObj = $rowsObj->orderBy('kalan_no,amaliati_no,eghdam_id,faaliat_id,admin_id,group_id' , 'desc');



        $rows = $rowsObj->getList();
        //print_r_debug($rows);




        $export = $sumOO = $sumO = $sumZZ = $sumZ = array();
        foreach ($rows['export']['list'] as $row)
        {
            /**
             * kalan
             */
            $export['kalans'][$row['kalan_no']]['kalan_name'] = $row['kalan'];
//            $export['kalans'][$row['kalan_no']]['admins'][$row['admin_id']]['admin_name'] = $row['admin_name'];
//            $export['kalans'][$row['kalan_no']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['group_name'] = $row['group_name'].' '.$row['group_family'];
            /**
             * amaliati
             */
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['amaliati_name'] = $row['amaliati'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['admins'][$row['admin_id']]['admin_name'] = $row['admin_name'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['group_name'] = $row['group_name'].' '.$row['group_family'];
            /**
             * eghdam
             */
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['eghdam_name'] = $row['eghdam'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['admins'][$row['admin_id']]['admin_name'] = $row['admin_name'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['group_name'] = $row['group_name'].' '.$row['group_family'];
            /**
             * faaliat
             */
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['faaliat_name'] = $row['faaliat'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['admin_name'] = $row['admin_name'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['group_name'] = $row['group_name'].' '.$row['group_family'];

            /**
             * OO
             */
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['OO1'] = $row['admin_percent1'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['OO2'] = $row['admin_percent2'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['OO3'] = $row['admin_percent3'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['OO4'] = $row['admin_percent4'];
            /**
             * O
             */
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O1'] = $row['admin_percent1'] * $row['max1'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O2'] = $row['admin_percent2'] * $row['max2'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O3'] = $row['admin_percent3'] * $row['max3'];
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O4'] = $row['admin_percent4'] * $row['max4'];

            /**
             * AA
             */
            $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][1] += $row['admin_percent1'];
            $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][2] += $row['admin_percent2'];
            $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][3] += $row['admin_percent3'];
            $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][4] += $row['admin_percent4'];
            $groupCounts = count($export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups']);

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['AA1'] =
                $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][1] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['AA2'] =
                $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][2] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['AA3'] =
                $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][3] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['AA4'] =
                $sumOO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][4] / $groupCounts;

            /**
             * A
             */
            $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][1] += $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O1'] ;
            $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][2] += $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O2'];
            $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][3] += $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O3'];
            $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][4] += $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['O4'];


            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['A1'] =
                $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][1] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['A2'] =
                $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][2] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['A3'] =
                $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][3] / $groupCounts;

            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['A4'] =
                $sumO[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['faaliat_id']][$row['admin_id']][4] / $groupCounts;


            /**
             * sum zz
             */
            $sumZZ[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['admin_id']][$row['group_id']]['sumZZ']  += $row['faaliat_vazn'];


            /**
             * sum z
             */

            $sumZ[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['admin_id']]['sumZ']  += $row['faaliat_vazn'];



//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager1_1'] = $row['manager1_1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager1_2'] = $row['manager1_2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager1_3'] = $row['manager1_3'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager2_1'] = $row['manager2_1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager2_2'] = $row['manager2_2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager2_3'] = $row['manager2_3'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager3_1'] = $row['manager3_1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager3_2'] = $row['manager3_2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager3_3'] = $row['manager3_3'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager4_1'] = $row['manager4_1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager4_2'] = $row['manager4_2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['manager4_3'] = $row['manager4_3'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max1'] = $row['max1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max2'] = $row['max2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max3'] = $row['max3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max4'] = $row['max4'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max_manager1'] = $row['max_manager1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max_manager2'] = $row['max_manager2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max_manager3'] = $row['max_manager3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['max_manager4'] = $row['max_manager4'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_file1'] = $row['admin_file1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_file2'] = $row['admin_file2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_file3'] = $row['admin_file3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_file4'] = $row['admin_file4'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_tozihat1'] = $row['admin_tozihat1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_tozihat2'] = $row['admin_tozihat2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_tozihat3'] = $row['admin_tozihat3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['admin_tozihat4'] = $row['admin_tozihat4'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil1'] = $row['tahlil1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil2'] = $row['tahlil2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil3'] = $row['tahlil3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil4'] = $row['tahlil4'];

//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil_manager1'] = $row['tahlil_manager1'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil_manager2'] = $row['tahlil_manager2'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil_manager3'] = $row['tahlil_manager3'];
//            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['tahlil_manager4'] = $row['tahlil_manager4'];


        }

        foreach ($rows['export']['list'] as $row)
        {

            /**
             *  ZZ
             */
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['groups'][$row['group_id']]['ZZ']

                = $row['faaliat_vazn'] / $sumZZ[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['admin_id']][$row['group_id']]['sumZZ'];

            /**
             * Z
             */
            $export['kalans'][$row['kalan_no']]['amaliatis'][$row['amaliati_no']]['eghdams'][$row['eghdam_id']]['faaliats'][$row['faaliat_id']]['admins'][$row['admin_id']]['Z']     =

                $row['faaliat_vazn'] / $sumZ[$row['kalan_no']][$row['amaliati_no']][$row['eghdam_id']][$row['admin_id']]['sumZ'];
        }



        return $export;
    }







    public function reportsProcess()
    {
        global $admin_info;


        include_once ROOT_DIR . 'component/eghdam/model/eghdam.model.php';
        include_once ROOT_DIR . 'component/faaliat/model/faaliat.model.php';
        include_once ROOT_DIR . 'component/faaliat_vazn/model/faaliat_vazn.model.php';
        include_once ROOT_DIR . 'component/eghdam_vazn/model/eghdam_vazn.model.php';
        include_once ROOT_DIR . 'component/group_list/model/group_list.model.php';
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        include_once ROOT_DIR . 'component/amaliati_vazn/model/amaliati_vazn.model.php';
        include_once ROOT_DIR . 'component/admin/model/admin.model.php';
        $obj = new eghdam();
        $obj2 = new faaliat();
        $obj3 = new faaliat_vazn();
        $obj4 = new eghdam_vazn();
        $obj5 = new group_list();
        $obj6 = new amaliati_vazn();
        $obj7 = new admin();
        $obj_amaliati_vazn = new amaliati_vazn();

        $getAdmin = substr($_GET['q'],1,-1);

        $managerStatus = admin::find(1);


        /** faaliat and eghdam for this admin */
        $child = $this->child($obj7,$obj5,$obj2);
        $faaliat_str = $child['faaliat_str'];
        $eghdam_str = $child['eghdam_str'];

        /** kalan  */
        $list['list'] = $this->kalan($obj,$eghdam_str);
        foreach ($list['list'] as $kalan_no => $v1){

            $sumN = 0;
            $sumNN = array();

            /** amaliati  */
            $list['list'][$kalan_no]['amaliati'] = $this->amaliati($obj,$kalan_no,$eghdam_str);
            foreach ($list['list'][$kalan_no]['amaliati'] as $amaliati_no => $vAmaliati){

                $nextAmaliati = array();

                unset($elami1);
                unset($elami_eghdam1);
                unset($elami_eghdam2);
                unset($elami_eghdam3);
                unset($elami_eghdam4);
                $sumM = 0;
                $sumMM = array();


                /** eghdam  */
                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'] = $this->eghdam($obj,$amaliati_no,$eghdam_str);
                foreach ($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'] as $eghdam_id => $vEghdam){

                    $nextEghdam=array();
                    unset($c1);
                    unset($c2);
                    unset($c3);
                    unset($c4);

                    $sumZZ = array();
                    $sumZ = 0;

                    unset($rr1);
                    unset($rr2);
                    unset($rr3);
                    unset($rr4);


                    /** faaliat  */
                    $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'] = $this->faaliat($obj2,$eghdam_id,$faaliat_str);
                    foreach ($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'] as $faaliat_id => $vFaaliat) {


                        /** faaliat admins  info*/
                        $faaliatAdmins = $this->faaliatAdminInfo($obj3,$faaliat_id);
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'] = $faaliatAdmins;

                        $Eoo1[$faaliat_id]=$Eoo2[$faaliat_id]=$Eoo3[$faaliat_id]=$Eoo4[$faaliat_id] = 0;
                        $aa1[$faaliat_id]=$aa2[$faaliat_id]=$aa3[$faaliat_id]=$aa4[$faaliat_id] = 0;
                        foreach ($faaliatAdmins as $id => $faalaitAdminInfo){



                            /** eghdam admins  info*/
                            if(!is_array($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$faalaitAdminInfo['admin_id']])){
                                $aa['admin_id'] =  $faalaitAdminInfo['admin_id'];
                                $aa['name'] =  $faalaitAdminInfo['name'];
                                $aa['family'] =  $faalaitAdminInfo['family'];
                                $aa['eghdam_vazn'] =  $obj4::getAll()
                                    ->where('admin_id','=',$faalaitAdminInfo['admin_id'])
                                    ->andWhere('eghdam_id','=',$eghdam_id)
                                    ->getList()['export']['list'][0];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$faalaitAdminInfo['admin_id']] = $aa;


                                // TODO: ******** data is mistake and eghdam vazn
                                unset($aa);
                            }


                            /** amaliati admins  info*/
                            if(!is_array($list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$faalaitAdminInfo['admin_id']])){
                                $aa['admin_id'] =  $faalaitAdminInfo['admin_id'];
                                $aa['name'] =  $faalaitAdminInfo['name'];
                                $aa['family'] =  $faalaitAdminInfo['family'];
                                $aa['amaliati_vazn'] =  $obj_amaliati_vazn::getAll()
                                    ->select('amaliati_vazn')
                                    ->where('admin_id','=',$faalaitAdminInfo['admin_id'])
                                    ->andWhere('amaliati_no','=',$amaliati_no)
                                    ->getList()['export']['list'][0];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$faalaitAdminInfo['admin_id']] = $aa;

                            }

                            /** kalan admins  info*/
                            if(!is_array($list['list'][$kalan_no]['admins'][$faalaitAdminInfo['admin_id']])){
                                $aa['admin_id'] =  $faalaitAdminInfo['admin_id'];
                                $aa['name'] =  $faalaitAdminInfo['name'];
                                $aa['family'] =  $faalaitAdminInfo['family'];
                                $aa['flag'] =  $faalaitAdminInfo['flag'];
                                $list['list'][$kalan_no]['admins'][$faalaitAdminInfo['admin_id']] = $aa;
                            }


                            /** admin's group */
                            $groupResult = $this->adminGroup($obj5,$faaliatAdmins,$id,$faaliat_id,$getAdmin);
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['group'] = $groupResult;


                            /*****************************************
                             ****************************************
                             ****************************************/

                            $oCount = 0;
                            $Eo1[$faaliat_id]=$Eo2[$faaliat_id]=$Eo3[$faaliat_id]=$Eo4[$faaliat_id] = 0;


                            /** elami_eghdam*/
                            $faaliat_vazn = $faalaitAdminInfo['faaliat_vazn'];


                            /************************ sum z ***************/
                            $sumZ += $faaliat_vazn;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$faalaitAdminInfo['admin_id']]['sum_z'] = $sumZ;



                            /************************ sum m ***************/
                            $temp_eghdam_vazn2 = $obj4::getAll()
                                ->select('eghdam_vazn')
                                ->where('eghdam_id','=',$eghdam_id)
                                ->andWhere('admin_id','=',$faalaitAdminInfo['admin_id'])
                                ->getList()['export']['list'][0];
                            $eghdam_vazn = $temp_eghdam_vazn2['eghdam_vazn'];

                            if(count($nextEghdam[$amaliati_no]) == 0){
                                $sumM += $eghdam_vazn;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$faalaitAdminInfo['admin_id']]['sum_m'] = $sumM;
                            }



                            /************************ sum n ***************/
                            $temp_amaliati_vazn2 = $obj6::getAll()
                                ->select('amaliati_vazn')
                                ->where('amaliati_no','=',$amaliati_no)
                                ->andWhere('admin_id','=',$faalaitAdminInfo['admin_id'])
                                ->getList()['export']['list'][0];

                            $amaliati_vazn = $temp_amaliati_vazn2['amaliati_vazn'];

                            if(count($nextEghdam[$kalan_no]) == 0){
                                $sumN += $amaliati_vazn;
                                $list['list'][$kalan_no]['admins'][$faalaitAdminInfo['admin_id']]['sum_n'] = $sumN;
                            }


                            foreach ($groupResult as $gid => $groupInfo){


                                /** eghdam group info*/
                                if(!is_array($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id]['group'][$groupInfo['admin_id']])){
                                    $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id]['group'][$groupInfo['admin_id']] = $groupInfo;
                                }

                                /** amaliati group info*/
                                if(!is_array($list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$id]['group'][$groupInfo['admin_id']])){

                                    $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$id]['group'][$groupInfo['admin_id']] = $groupInfo;
                                }

                                /** kalan group info*/
                                if(!is_array($list['list'][$kalan_no]['admins'][$id]['group'][$groupInfo['admin_id']])){

                                    $list['list'][$kalan_no]['admins'][$id]['group'][$groupInfo['admin_id']] = $groupInfo;
                                }


                                /*****************************************
                                 ****************************************
                                 ****************************************/

                                /** sum zz */
                                $sumZZ[$eghdam_id][$gid] += $faalaitAdminInfo['faaliat_vazn'];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$faalaitAdminInfo['admin_id']]['group'][$gid]['sum_zz'] = $sumZZ[$eghdam_id][$gid];

                                /** sum mm */
                                if($nextEghdam[$amaliati_no][$gid]==0){
                                    $sumMM[$amaliati_no][$gid] += $eghdam_vazn;
                                    $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$faalaitAdminInfo['admin_id']]['group'][$gid]['sum_mm'] = $sumMM[$amaliati_no][$gid];
                                }
                                $nextEghdam[$amaliati_no][$gid] = 1;

                                /** sum nn */
                                if($nextAmaliati[$kalan_no][$gid]==0){
                                    $sumNN[$kalan_no][$gid] += $amaliati_vazn;
                                    $list['list'][$kalan_no]['admins'][$faalaitAdminInfo['admin_id']]['group'][$gid]['sum_nn'] = $sumNN[$kalan_no][$gid];
                                }
                                $nextAmaliati[$kalan_no][$gid] = 1;


                                $oCount ++;
                                /** darsad tadili faaliat / vahed (O)  */

                                $o1 =  $groupInfo['admin_percent1'] * $groupInfo['max_manager1'] / 100;
                                $o2 =  $groupInfo['admin_percent2'] * $groupInfo['max_manager2'] / 100;
                                $o3 =  $groupInfo['admin_percent3'] * $groupInfo['max_manager3'] / 100;
                                $o4 =  $groupInfo['admin_percent4'] * $groupInfo['max_manager4'] / 100;
                                if($managerStatus->status != 4 && $admin_info['parent_id'] != 0){
                                    if(STEP_FORM1 == 1){
                                        $o1 = 0;
                                    }elseif(STEP_FORM1 == 2){
                                        $o2 = 0;
                                    }elseif(STEP_FORM1 == 3){
                                        $o3 = 0;
                                    }elseif(STEP_FORM1 == 4){
                                        $o4 = 0;
                                    }
                                }

                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['group'][$gid]['O1']=$o1;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['group'][$gid]['O2']=$o2;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['group'][$gid]['O3']=$o3;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['group'][$gid]['O4']=$o4;


                                /** (A') (O') */
                                $oo1 =  $groupInfo['admin_percent1'];
                                $oo2 =  $groupInfo['admin_percent2'];
                                $oo3 =  $groupInfo['admin_percent3'];
                                $oo4 =  $groupInfo['admin_percent4'];

                                $Eoo1[$faaliat_id] += $oo1;
                                $Eoo2[$faaliat_id] += $oo2;
                                $Eoo3[$faaliat_id] += $oo3;
                                $Eoo4[$faaliat_id] += $oo4;

                                $aa1 = $Eoo1[$faaliat_id]/ $oCount;
                                $aa2 = $Eoo2[$faaliat_id]/ $oCount;
                                $aa3 = $Eoo3[$faaliat_id]/ $oCount;
                                $aa4 = $Eoo4[$faaliat_id]/ $oCount;

                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['AA1'] = $aa1;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['AA2'] = $aa2;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['AA3'] = $aa3;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['AA4'] = $aa4;



                                /** (A) */
                                $Eo1[$faaliat_id] += $o1;
                                $Eo2[$faaliat_id] += $o2;
                                $Eo3[$faaliat_id] += $o3;
                                $Eo4[$faaliat_id] += $o4;

                                $a1[$faaliat_id] = $Eo1[$faaliat_id]/$oCount;
                                $a2[$faaliat_id] = $Eo2[$faaliat_id]/$oCount;
                                $a3[$faaliat_id] = $Eo3[$faaliat_id]/$oCount;
                                $a4[$faaliat_id] = $Eo4[$faaliat_id]/$oCount;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['A1'] = $a1[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['A2'] = $a2[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['A3'] = $a3[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['admins'][$id]['A4'] = $a4[$faaliat_id];


                                /** darsad elami faaliat / uni (B') */
                                $vahed_vazn_faaliat = 1/$vFaaliat['vahed_vazn_faaliat'];
                                $bb1[$faaliat_id] = $aa1[$faaliat_id] * $vahed_vazn_faaliat;
                                $bb2[$faaliat_id] = $aa2[$faaliat_id] * $vahed_vazn_faaliat;
                                $bb3[$faaliat_id] = $aa3[$faaliat_id] * $vahed_vazn_faaliat;
                                $bb4[$faaliat_id] = $aa4[$faaliat_id] * $vahed_vazn_faaliat;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['BB1'] += $bb1[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['BB2'] += $bb2[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['BB3'] += $bb3[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['BB4'] += $bb4[$faaliat_id];


                                /** darsad tadili faaliat / uni (B) */
                                $b1[$faaliat_id] = $a1[$faaliat_id] * $vahed_vazn_faaliat ;
                                $b2[$faaliat_id] = $a2[$faaliat_id] * $vahed_vazn_faaliat ;
                                $b3[$faaliat_id] = $a3[$faaliat_id] * $vahed_vazn_faaliat ;
                                $b4[$faaliat_id] = $a4[$faaliat_id] * $vahed_vazn_faaliat ;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['B1'] += $b1[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['B2'] += $b2[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['B3'] += $b3[$faaliat_id];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id]['B4'] += $b4[$faaliat_id];







                            }//next group




                        }// next admin

                        


                        unset($b1);
                        unset($b2);
                        unset($b3);
                        unset($b4);



                    }//next faaliat

                    if(1==1){
                    /** (Z) */
                    foreach ($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'] as $faaliat_id_2 => $fv2) {
                        foreach ($fv2['admins'] as $id3 => $valueAdmin3)
                        {


                            $sum_z = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['sum_z'];
                            $z = $valueAdmin3['faaliat_vazn'] / $sum_z;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['Z'] = $z;


                            foreach ($valueAdmin3['group'] as $gid =>$groupDetail){


                                $sum_zz = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['group'][$gid]['sum_zz'];
                                $zz = $valueAdmin3['faaliat_vazn'] / $sum_zz;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$valueAdmin3['admin_id']]['group'][$gid]['ZZ'] = $zz;
                                /** R */
                                $o1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['group'][$gid]['O1'];
                                $o2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['group'][$gid]['O2'];
                                $o3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['group'][$gid]['O3'];
                                $o4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['group'][$gid]['O4'];
                                $r1[$valueAdmin3['admin_id']] = $o1 * $zz;
                                $r2[$valueAdmin3['admin_id']] = $o2 * $zz;
                                $r3[$valueAdmin3['admin_id']] = $o3 * $zz;
                                $r4[$valueAdmin3['admin_id']] = $o4 * $zz;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['R1'] += $r1[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['R2'] += $r2[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['R3'] += $r3[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['R4'] += $r4[$valueAdmin3['admin_id']];


                                /** R' */
                                $rr1[$valueAdmin3['admin_id']] = $groupDetail['admin_percent1'] * $zz;
                                $rr2[$valueAdmin3['admin_id']] = $groupDetail['admin_percent2'] * $zz;
                                $rr3[$valueAdmin3['admin_id']] = $groupDetail['admin_percent3'] * $zz;
                                $rr4[$valueAdmin3['admin_id']] = $groupDetail['admin_percent4'] * $zz;
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['RR1'] += $rr1[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['RR2'] += $rr2[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['RR3'] += $rr3[$valueAdmin3['admin_id']];
                                $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$id3]['group'][$groupDetail['admin_id']]['RR4'] += $rr4[$valueAdmin3['admin_id']];
                            }



                            /** darsad tadili eghdam / vahed (C)*/
                            $A1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['A1'];
                            $A2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['A2'];
                            $A3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['A3'];
                            $A4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['A4'];
                            $c1[$valueAdmin3['admin_id']] = $A1 * $z;
                            $c2[$valueAdmin3['admin_id']] = $A2 * $z;
                            $c3[$valueAdmin3['admin_id']] = $A3 * $z;
                            $c4[$valueAdmin3['admin_id']] = $A4 * $z;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['C1'] += $c1[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['C2'] += $c2[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['C3'] += $c3[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['C4'] += $c4[$valueAdmin3['admin_id']];

                            /** darsad elami eghdam / vahed (c')*/
                            $aa1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['AA1'];
                            $aa2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['AA2'];
                            $aa3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['AA3'];
                            $aa4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['admins'][$id3]['AA4'];
                            $elami1 = $aa1 * $z;
                            $elami2 = $aa2 * $z;
                            $elami3 = $aa3 * $z;
                            $elami4 = $aa4 * $z;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC1'] += $elami1;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC2'] += $elami2;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC3'] += $elami3;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC4'] += $elami4;



                            /** darsad tadili eghdam / uni (D) */
                                    $x = $fv2['x'];
                            $f_v_uni = $fv2['f_v_uni'];

                            $B1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['B1'];
                            $B2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['B2'];
                            $B3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['B3'];
                            $B4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['B4'];
                            $d1 = $B1 * $x * $f_v_uni;
                            $d2 = $B2 * $x * $f_v_uni;
                            $d3 = $B3 * $x * $f_v_uni;
                            $d4 = $B4 * $x * $f_v_uni;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['D1'] += $d1;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['D2'] += $d2;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['D3'] += $d3;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['D4'] += $d4;



                            /** darsad elami eghdam / uni (D') */
                            $BB1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['BB1'];
                            $BB2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['BB2'];
                            $BB3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['BB3'];
                            $BB4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['faaliat'][$faaliat_id_2]['BB4'];
                            $dd1 = $BB1 * $x * $f_v_uni;
                            $dd2 = $BB2 * $x * $f_v_uni;
                            $dd3 = $BB3 * $x * $f_v_uni;
                            $dd4 = $BB4 * $x * $f_v_uni;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['DD1'] += $dd1;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['DD2'] += $dd2;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['DD3'] += $dd3;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id]['DD4'] += $dd4;




                        }
                    }
                    }/////////////////////////////////


                }//next eghdam

                if(1==1){

                    /** (M) */
                foreach ($list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'] as $eghdam_id2 => $ev2) {
                    foreach ($ev2['admins'] as $adminid3 => $valueAdmin3)
                    {

                        $sum_m = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['sum_m'];
                        $m = $valueAdmin3['eghdam_vazn']['eghdam_vazn'] / $sum_m;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['M'] = $m;


                        foreach ($valueAdmin3['group'] as $gid =>$groupDetail) {

                            $sum_mm = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['group'][$gid]['sum_mm'];
                            $mm = $valueAdmin3['eghdam_vazn']['eghdam_vazn'] / $sum_mm;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$gid]['MM'] = $mm;

                            /** P */
                            $r1[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['R1'];
                            $r2[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['R2'];
                            $r3[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['R3'];
                            $r4[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['R4'];
                            $p1[$valueAdmin3['admin_id']] = $r1[$valueAdmin3['admin_id']] * $mm;
                            $p2[$valueAdmin3['admin_id']] = $r2[$valueAdmin3['admin_id']] * $mm;
                            $p3[$valueAdmin3['admin_id']] = $r3[$valueAdmin3['admin_id']] * $mm;
                            $p4[$valueAdmin3['admin_id']] = $r4[$valueAdmin3['admin_id']] * $mm;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P1'] += $p1[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P2'] += $p2[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['p3'] += $p3[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P4'] += $p4[$valueAdmin3['admin_id']];

                            /** P' */
                            $rr1[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['RR1'];
                            $rr2[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['RR2'];
                            $rr3[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['RR3'];
                            $rr4[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['group'][$groupDetail['admin_id']]['RR4'];
                            $pp1[$valueAdmin3['admin_id']] = $rr1[$valueAdmin3['admin_id']] * $mm;
                            $pp2[$valueAdmin3['admin_id']] = $rr2[$valueAdmin3['admin_id']] * $mm;
                            $pp3[$valueAdmin3['admin_id']] = $rr3[$valueAdmin3['admin_id']] * $mm;
                            $pp4[$valueAdmin3['admin_id']] = $rr4[$valueAdmin3['admin_id']] * $mm;
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP1'] += $pp1[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP2'] += $pp2[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP3'] += $pp3[$valueAdmin3['admin_id']];
                            $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP4'] += $pp4[$valueAdmin3['admin_id']];

                        }


                        /** darsad tadili amaliati / vahed (E) */
                        $C1[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['C1'];
                        $C2[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['C2'];
                        $C3[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['C3'];
                        $C4[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['C4'];
                        $e1 = $C1[$valueAdmin3['admin_id']] * $m;
                        $e2 = $C2[$valueAdmin3['admin_id']] * $m;
                        $e3 = $C3[$valueAdmin3['admin_id']] * $m;
                        $e4 = $C4[$valueAdmin3['admin_id']] * $m;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['E1'] += $e1;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['E2'] += $e2;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['E3'] += $e3;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['E4'] += $e4;


                        /** darsad elami amaliati / vahed (E') */
                        $CC1[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC1'];
                        $CC2[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC2'];
                        $CC3[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC3'];
                        $CC4[$valueAdmin3['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['admins'][$valueAdmin3['admin_id']]['eghdam_vazn']['CC4'];
                        $ee1 = $CC1[$valueAdmin3['admin_id']] * $m;
                        $ee2 = $CC2[$valueAdmin3['admin_id']] * $m;
                        $ee3 = $CC3[$valueAdmin3['admin_id']] * $m;
                        $ee4 = $CC4[$valueAdmin3['admin_id']] * $m;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['EE1'] += $ee1;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['EE2'] += $ee2;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['EE3'] += $ee3;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['admins'][$valueAdmin3['admin_id']]['EE4'] += $ee4;



                        $y = $ev2['y'];
                        /** darsad tadili amaliati / uni (F) */
                        $D1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['D1'];
                        $D2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['D2'];
                        $D3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['D3'];
                        $D4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['D4'];
                        $D1 = $D1 * $y;
                        $D2 = $D2 * $y;
                        $D3 = $D3 * $y;
                        $D4 = $D4 * $y;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['F1'] += $D1;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['F2'] += $D2;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['F3'] += $D3;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['F4'] += $D4;

                        /** darsad elami amaliati / uni (F') */
                        $DD1 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['DD1'];
                        $DD2 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['DD2'];
                        $DD3 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['DD3'];
                        $DD4 = $list['list'][$kalan_no]['amaliati'][$amaliati_no]['eghdam'][$eghdam_id2]['DD4'];

                        $DD1 = $DD1 * $y;
                        $DD2 = $DD2 * $y;
                        $DD3 = $DD3 * $y;
                        $DD4 = $DD4 * $y;

                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['FF1'] += $DD1;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['FF2'] += $DD2;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['FF3'] += $DD3;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_no]['FF4'] += $DD4;





                    }//next


                }//next eghdam

                }/////////////////////////////////


            }//next amaliati

            if(1==1){
            /** (N) */
            foreach ($list['list'][$kalan_no]['amaliati'] as $amaliati_id2 => $ev3) {

                foreach ($ev3['admins'] as $adminid3 => $valueAdmin4){


                    $sum_n = $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['sum_n'];
                    $n = $valueAdmin4['amaliati_vazn']['amaliati_vazn'] / $sum_n;
                    $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['N'] = $n;

                    foreach ($valueAdmin4['group'] as $gid =>$groupDetail) {

                        $sum_nn = $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['group'][$gid]['sum_nn'];

                        $nn = $valueAdmin4['amaliati_vazn']['amaliati_vazn'] / $sum_nn;
                        $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['group'][$gid]['NN'] = $nn;
                        /** Q */
                        $p1[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P1'];
                        $p2[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P2'];
                        $p3[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P3'];
                        $p4[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['P4'];
                        $q1[$valueAdmin4['admin_id']] = $p1[$valueAdmin4['admin_id']] * $nn;
                        $q2[$valueAdmin4['admin_id']] = $p2[$valueAdmin4['admin_id']] * $nn;
                        $q3[$valueAdmin4['admin_id']] = $p3[$valueAdmin4['admin_id']] * $nn;
                        $q4[$valueAdmin4['admin_id']] = $p4[$valueAdmin4['admin_id']] * $nn;
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['Q1'] += $q1[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['Q2'] += $q2[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['Q3'] += $q3[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['Q4'] += $q4[$valueAdmin4['admin_id']];


                        /** Q' */
                        $pp1[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP1'];
                        $pp2[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP2'];
                        $pp3[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP3'];
                        $pp4[$valueAdmin4['admin_id']] = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['PP4'];
                        $qq1[$valueAdmin4['admin_id']] = $pp1[$valueAdmin4['admin_id']] * $nn;
                        $qq2[$valueAdmin4['admin_id']] = $pp2[$valueAdmin4['admin_id']] * $nn;
                        $qq3[$valueAdmin4['admin_id']] = $pp3[$valueAdmin4['admin_id']] * $nn;
                        $qq4[$valueAdmin4['admin_id']] = $pp4[$valueAdmin4['admin_id']] * $nn;
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['QQ1'] += $qq1[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['QQ2'] += $qq2[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['QQ3'] += $qq3[$valueAdmin4['admin_id']];
                        $list['list'][$kalan_no]['admins'][$adminid3]['group'][$groupDetail['admin_id']]['QQ4'] += $qq4[$valueAdmin4['admin_id']];


                    }

                    /** darsad tadili kalan / vahed (G) */
                    $E1 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['E1'];
                    $E2 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['E2'];
                    $E3 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['E3'];
                    $E4 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['E4'];
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['G1'] += $E1 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['G2'] += $E2 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['G3'] += $E3 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['G4'] += $E4 * $n;


                    /** darsad elami kalan / vahed (G') */
                    $EE1 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['EE1'];
                    $EE2 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['EE2'];
                    $EE3 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['EE3'];
                    $EE4 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['admins'][$valueAdmin4['admin_id']]['EE4'];
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['GG1'] += $EE1 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['GG2'] += $EE2 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['GG3'] += $EE3 * $n;
                    $list['list'][$kalan_no]['admins'][$valueAdmin4['admin_id']]['GG4'] += $EE4 * $n;

                    /** darsad tadili kalan / uni (H) */
                    $amaliati_vazn_uni = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['amaliati_vazn_uni'];
                    $f1 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['F1'];
                    $f2 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['F2'];
                    $f3 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['F3'];
                    $f4 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['F4'];
                    $h1 = $f1 * $amaliati_vazn_uni;
                    $h2 = $f2 * $amaliati_vazn_uni;
                    $h3 = $f3 * $amaliati_vazn_uni;
                    $h4 = $f4 * $amaliati_vazn_uni;
                    $list['list'][$kalan_no]['H1'] += $h1;
                    $list['list'][$kalan_no]['H2'] += $h2;
                    $list['list'][$kalan_no]['H3'] += $h3;
                    $list['list'][$kalan_no]['H4'] += $h4;

                    /** darsad elami kalan/ uni (H') */
                    $ff1 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['FF1'];
                    $ff2 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['FF2'];
                    $ff3 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['FF3'];
                    $ff4 = $list['list'][$kalan_no]['amaliati'][$amaliati_id2]['FF4'];
                    $hh1 = $ff1 * $amaliati_vazn_uni;
                    $hh2 = $ff2 * $amaliati_vazn_uni;
                    $hh3 = $ff3 * $amaliati_vazn_uni;
                    $hh4 = $ff4 * $amaliati_vazn_uni;
                    $list['list'][$kalan_no]['HH1'] += $hh1;
                    $list['list'][$kalan_no]['HH2'] += $hh2;
                    $list['list'][$kalan_no]['HH3'] += $hh3;
                    $list['list'][$kalan_no]['HH4'] += $hh4;

                }
            }
            }/////////////////////////////////



        }//next kalan

        //print_r_debug($list);

        return $list;

    }


    function child($admin,$group_list,$obj2){

        global $admin_info;
        if($admin_info['group_admin'] == 1 ){
            /** login by daneshkade va manager */
            $child = $admin->getAll()
                ->select('distinct(admin.admin_id)');

            if($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1){
                $child =   $child->join('admin_faaliat','admin_faaliat.child','=',' admin.admin_id');
                $child =   $child->where('admin_faaliat.admin_id','=',$admin_info['admin_id']);
            }
            else{
                $child =   $child->where('parent_id','=',$admin_info['parent_id']);
            }


            $child = $child->getList()['export']['list'];


            $childstr = '';
            foreach ($child as $k => $v){
                $childstr .= $v['admin_id'].',';
            }
            $childstr = substr($childstr,0,-1);
        }
        else{
            /** login by group   */
            $childstr = $admin_info['admin_id'];
        }



        /** faaliat id */


        if($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1) {
            /** arzyab */

            $query = "SELECT group_list.faaliat_id FROM `group_list` 

inner join admin_faaliat on group_list.admin_id = admin_faaliat.child  and admin_faaliat.faaliat_id = group_list.faaliat_id

WHERE group_list.admin_id IN (select child from admin_faaliat where admin_id = {$admin_info['admin_id']} ) ";

            $faaliat_id = $group_list->getByFilter('',$query)['export']['list'];



        }
        else{
            $faaliat_id = $group_list->getAll()
                ->select('group_list.faaliat_id');
            $faaliat_id = $faaliat_id->where('group_list.admin_id','in',$childstr);
            $faaliat_id = $faaliat_id->getList()['export']['list'];
        }




        $str ='';
        foreach ($faaliat_id as $v){
            $str .= $v['faaliat_id'].',';
        }
        $faaliat_str = substr($str,0,-1);
        unset($faaliat_id);



        /** eghdam id */
        $eghdam_id = $obj2->getAll()
            ->select('eghdam_id')
            ->where('faaliat_id','in',$faaliat_str)
            ->groupBy('eghdam_id')
            ->getList()['export']['list'];
        $str ='';
        foreach ($eghdam_id as $v){
            $str .= $v['eghdam_id'].',';
        }
        $eghdam_str = substr($str,0,-1);
        unset($eghdam_id);

        $child['faaliat_str'] = $faaliat_str;
        $child['eghdam_str'] = $eghdam_str;



        return $child;
    }
    function kalan($obj,$eghdam_str){
        global $admin_info;
        $result = $obj->getAll()
            ->keyBy('kalan_no')
            ->select('kalan,kalan_no')
            ->groupBy('kalan_no,kalan');

        if($admin_info['parent_id'] != 0 || ($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1)){
            /** !manager */
            $result = $result->where('eghdam_id','in',$eghdam_str);
        }

        $result = $result->getList()['export']['list'];

        return $result;
    }
    function amaliati($eghdam,$kalan_no,$eghdam_str){
        global $admin_info;
        $result2 = $eghdam->getAll()
            ->leftJoin('amaliati','amaliati.amaliati_no','=','eghdam.amaliati_no')
            ->keyBy('amaliati_no')
            ->select('amaliati,eghdam.amaliati_no,amaliati_vazn_uni')
            ->groupBy('eghdam.amaliati_no,amaliati')
            ->where('kalan_no','=',$kalan_no);
        if($admin_info['parent_id'] != 0 || ($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1)){
            /** !manager */
            $result2 = $result2->andWhere('eghdam_id','in',$eghdam_str);
        }

        $result2 = $result2->getList()['export']['list'];



        return $result2;
    }
    function eghdam($eghdam,$amaliati_no,$eghdam_str){
        global $admin_info;
        $result2 = $eghdam->getAll()
            ->keyBy('eghdam_id')
            ->select('eghdam,eghdam_id,y')
            ->groupBy('eghdam_id')
            ->where('amaliati_no','=',$amaliati_no);
        if($admin_info['parent_id'] != 0 || ($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1)){
            /** !manager */
            $result2 = $result2->andWhere('eghdam_id','in',$eghdam_str);
        }

        $result2 = $result2->getList();
        $temp = $result2['export']['list'];

        return $temp;
    }
    function faaliat($obj2,$eghdam_id,$faaliat_str){
        global $admin_info;
        $result2 = $obj2->getAll()
            ->keyBy('faaliat_id')
            ->select('faaliat,faaliat_id,x,f_v_uni,vahed_vazn_faaliat')
            ->groupBy('faaliat_id')
            ->where('eghdam_id','=',$eghdam_id);

        if($admin_info['parent_id'] != 0 || ($admin_info['parent_id'] == 0 && $admin_info['admin_id'] != 1)){
            /** !manager */
            $result2 = $result2->andWhere('faaliat_id','in',$faaliat_str);
        }

        $result2 = $result2->getList();
        $temp = $result2['export']['list'];
        return $temp;
    }

    function faaliatAdminInfo($faaliat_vazn,$faaliat_id){
        global $admin_info;


        if($admin_info['admin_id'] == 1 || $admin_info['parent_id'] != 0){
            /** manager and group and vahed */
            $result2 = $faaliat_vazn->getAll()
                ->leftJoin('admin','admin.admin_id','=','faaliat_vazn.admin_id')
                ->keyBy('admin_id')
                ->select('admin.admin_id,name,family,faaliat_vazn.admin_id,faaliat_vazn,flag')
                ->where('faaliat_vazn.faaliat_id', '=', $faaliat_id);
            if($admin_info['parent_id'] != 1 && $admin_info['parent_id'] != 0  ){
                /** login by group and vahed (tajmi) */
                $rr = admin::find($admin_info['admin_id'])->parent_id;
                $result2= $result2->andWhere('admin.admin_id','=',$rr);
            }
            $result2 = $result2->getList()['export']['list'];

        }
        elseif($admin_info['parent_id'] != 1 && $admin_info['parent_id'] == 0 ){
            /** arzyab */
            $query = " SELECT faaliat_vazn.faaliat_id,name,family,faaliat_vazn.admin_id,faaliat_vazn,flag FROM faaliat_vazn 
LEFT JOIN admin ON admin.admin_id = faaliat_vazn.admin_id 
inner join admin_faaliat on  admin_faaliat.child = faaliat_vazn.admin_id and admin_faaliat.faaliat_id = faaliat_vazn.faaliat_id
WHERE faaliat_vazn.faaliat_id  = $faaliat_id  ";
            $temp = $faaliat_vazn->getByFilter('',$query)['export']['list'];
            foreach ($temp as $v){
                $result2[$v['admin_id']] = $v;
            }
        }



        return $result2;
    }
    function adminGroup($group_list,$temp,$id,$faaliat_id,$getAdmin){

        global $admin_info;
        if($admin_info['parent_id'] != 0 && $admin_info['group_admin'] !=1   ){
            /** login by group */
            $groupResult = $group_list::getAll()
                ->leftJoin('admin','admin.admin_id','=','group_list.admin_id')
                ->keyBy('admin_id')
                ->select('id','group_list.parent_id,group_list.faaliat_id,group_list.admin_id,name,family,admin_percent1,admin_tozihat1,admin_file1,admin_percent2,admin_tozihat2,admin_file2,admin_percent3,admin_tozihat3,admin_file3,admin_percent4,admin_tozihat4,admin_file4,manager1_1,manager1_2,manager1_3,manager2_1,manager2_2,manager2_3,manager3_1,manager3_2,manager3_3,manager4_1,manager4_2,manager4_3,max_manager1,max_manager2,max_manager3,max_manager4,tahlil1,tahlil2,tahlil3,tahlil4,max1,max2,max3,max4,tahlil_manager1,tahlil_manager2,tahlil_manager3,tahlil_manager4')
                ->where('group_list.parent_id', '=', $temp[$id]['admin_id'])
                ->andWhere('group_list.faaliat_id', '=', $faaliat_id)
                ->andWhere('admin.admin_id','=',$admin_info['admin_id'])
                ->getList()['export']['list'];

        }
        else if($admin_info['parent_id'] != 0 && $admin_info['group_admin'] ==1){
            /** login by vahed  */
            $groupResult = $group_list::getAll()
                ->leftJoin('admin','admin.admin_id','=','group_list.admin_id')
                ->keyBy('admin_id')
                ->select('id','group_list.parent_id,group_list.faaliat_id,group_list.admin_id,name,family,admin_percent1,admin_tozihat1,admin_file1,admin_percent2,admin_tozihat2,admin_file2,admin_percent3,admin_tozihat3,admin_file3,admin_percent4,admin_tozihat4,admin_file4,manager1_1,manager1_2,manager1_3,manager2_1,manager2_2,manager2_3,manager3_1,manager3_2,manager3_3,manager4_1,manager4_2,manager4_3,max_manager1,max_manager2,max_manager3,max_manager4,tahlil1,tahlil2,tahlil3,tahlil4,max1,max2,max3,max4,tahlil_manager1,tahlil_manager2,tahlil_manager3,tahlil_manager4')
                ->where('group_list.parent_id', '=', $temp[$id]['admin_id'])
                ->andWhere('group_list.faaliat_id', '=', $faaliat_id);
            if($getAdmin != null){
                //$groupResult = $groupResult->andWhere('group_list.faaliat_id', '=', $faaliat_id);
            }
            $groupResult = $groupResult->getList()['export']['list'];


        }
        else{
            /** login by manager*/

            if($admin_info['admin_id'] == 1){
                $groupResult = $group_list::getAll()
                    ->leftJoin('admin','admin.admin_id','=','group_list.admin_id')
                    ->keyBy('id')
                    ->select('id','group_list.parent_id,group_list.faaliat_id,group_list.admin_id,name,family,admin_percent1,admin_tozihat1,admin_file1,admin_percent2,admin_tozihat2,admin_file2,admin_percent3,admin_tozihat3,admin_file3,admin_percent4,admin_tozihat4,admin_file4,manager1_1,manager1_2,manager1_3,manager2_1,manager2_2,manager2_3,manager3_1,manager3_2,manager3_3,manager4_1,manager4_2,manager4_3,max_manager1,max_manager2,max_manager3,max_manager4,tahlil1,tahlil2,tahlil3,tahlil4,max1,max2,max3,max4,tahlil_manager1,tahlil_manager2,tahlil_manager3,tahlil_manager4,flag')
                    ->where('group_list.parent_id', '=', $temp[$id]['admin_id'])
                    ->andWhere('group_list.faaliat_id', '=', $faaliat_id)
                    ->getList()['export']['list'];
            }
            else{
                /** arzyab */
                $query = " SELECT group_list.id,group_list.parent_id,group_list.faaliat_id,group_list.admin_id,name,family,admin_percent1,admin_tozihat1,admin_file1,admin_percent2,admin_tozihat2,admin_file2,admin_percent3,admin_tozihat3,admin_file3,admin_percent4,admin_tozihat4,admin_file4,manager1_1,manager1_2,manager1_3,manager2_1,manager2_2,manager2_3,manager3_1,manager3_2,manager3_3,manager4_1,manager4_2,manager4_3,max_manager1,max_manager2,max_manager3,max_manager4,tahlil1,tahlil2,tahlil3,tahlil4,max1,max2,max3,max4,tahlil_manager1,tahlil_manager2,tahlil_manager3,tahlil_manager4,flag 
 FROM group_list 
LEFT JOIN admin ON admin.admin_id = group_list.admin_id 
inner join admin_faaliat on  admin_faaliat.child = group_list.admin_id and admin_faaliat.faaliat_id = group_list.faaliat_id
WHERE group_list.faaliat_id = $faaliat_id and  group_list.parent_id = {$temp[$id]['admin_id']}";
                $temp = $group_list->getByFilter('',$query)['export']['list'];
                foreach ($temp as $v){
                    $groupResult[$v['id']] = $v;
                }
            }



        }

        return $groupResult;
    }




    function showTableReports(){

        global $admin_info;
        $reports = $this->reportsProcess()['list'];
        if(isset($_GET['array'])){
            //print_r_debug($reports);
        }
        include_once ROOT_DIR.'component/admin/model/admin.model.php';
        $admin = new admin();

        $admin->getAll()
            ->select('admin_id,name,family,group_admin,parent_id');
        $admin->keyBy('admin_id');
        $admin->where('parent_id','<>','0');
        $admin->orderBy('groups,flag','asc');


        if($admin_info['group_admin'] == 1 && $admin_info['parent_id'] !=0)
        {
            /** login by daneshkade get daneshkade and group */
            $admin->andWhere('parent_id','=',$admin_info['parent_id']);

            /** get tajmi admin*/
            $admin->orWhere('admin_id','=',$admin_info['parent_id']);
        }
        else if($admin_info['group_admin'] != 1 )
        {
            /** login by group */
            $admin->andWhere('admin_id','=',$admin_info['admin_id']);
        }

        $groups = $admin->getList()['export']['list'];

        $rules = array('STEP_FORM1','STEP_FORM2','STEP_FORM3','STEP_FORM4');
        if(in_array($_GET['q'],$rules)){
            $season = str_replace('STEP_FORM','',handleData($_GET['q']));
        }
        else{
            $season = '1';
        }
        $adminId = '' ;
        if($admin_info['parent_id'] == 0){
            $adminId = 1;
        }elseif($admin_info['group_admin'] == 1){
            $adminId = $admin_info['parent_id'];
        }
        $child = $this->myStaff($adminId);

        $this->fileName = 'reports.tables.php';
        $this->template(compact('reports','groups','season','child'));
    }


    function myStaff($admin_id,$child='',$tt=array())
    {

        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $result = adminadminModel::getAll()
            ->where('parent_id','=',$admin_id)
            ->andWhere('status','=',2)
            ->andWhere('group_admin','<>',1);
        if($child != ''){
            $result = $result->andWhere('admin_id','=',$child);
        }

        $result = $result->getList();


        if($result['export']['recordsCount'] > 0)
        {

            foreach ($result['export']['list'] as $kk => $vv)
            {
                $tt[] = $vv;
                $tt = $this->myStaff($vv['admin_id'],'',$tt);
            }
        }


        return $tt;
    }

    function confirm($id){
        global $messageStack,$admin_info;
        $id = handleData($id);
        if(!is_numeric($id)){
            $messageStack->add_session('message','Ooops','error');
            redirectPage(RELA_DIR.'admin/?component=reports','Ooops!');
        }

        $adminId ='';
        if($admin_info['parent_id'] == 0){
            $adminId = 1;
        }elseif($admin_info['group_admin'] == 1){
            $adminId = $admin_info['parent_id'];
        }
        $child = $this->myStaff($adminId,$id);
        if(!count($child)){
            $messageStack->add_session('message','Ooops','error');
            redirectPage(RELA_DIR.'admin/?component=reports','Ooops!');
        }

        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $admin = adminadminModel::find($id);
        if($_GET['s']==1){
            $admin->status = 3;
        }
        else if($_GET['s']==2){
            $admin->status = 1;
        }
        $admin->save();

        if($_GET['s']==1){
           $msg = $admin->name.' '.$admin->family.' تایید شد.';
            $messageStack->add_session('message',$msg,'success');
            redirectPage(RELA_DIR.'admin/?component=reports',$msg);
        }
        else if($_GET['s']==2){
            $msg = $admin->name.' '.$admin->family.' نیازمند اصلاح اطلاعات می باشد. ';
            $messageStack->add_session('message',$msg,'success');
            redirectPage(RELA_DIR.'admin/?component=reports',$msg);
        }



    }


}
