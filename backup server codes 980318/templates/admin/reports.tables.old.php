<!--suppress ALL -->

<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">
<script>
    $(document).ready(function () {
        $('#level').change(function () {
            var season = $(this).val();

            location.href = window.location.origin + '/admin/?component=reports&q='+season;
        });


        $('#tbl3 tbody tr').click(function () {
            //var head = $(this).closest('table').find('thead').clone();
            //$('.panel-body').append(head);
        });

    // Code goes here
    'use strict'
    window.onload = function(){
        var tableCont1 = document.querySelector('.table-cont1');
        var tableCont2 = document.querySelector('.table-cont2');
        var tableCont3 = document.querySelector('.table-cont3');
        /**
         * scroll handle
         * @param {event} e -- scroll event
         */
        function scrollHandle (e){
            var scrollTop = this.scrollTop;
            //console.log(scrollTop);
            this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
        }

        tableCont1.addEventListener('scroll',scrollHandle)
        tableCont2.addEventListener('scroll',scrollHandle)
        tableCont3.addEventListener('scroll',scrollHandle)
    }

    });
</script>

<style>
    .table-cont1,.table-cont2,.table-cont3{
        max-height: 400px;
        overflow: auto;
    }

</style>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> گزارش عملکرد </a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="row xsmallSpace"></div>

<div class="content-body">
    <div class="row">

        <div class="col-md-2 col-sm-12 col-xs-12">
            <label for="level">دوره ارزیابی:</label>
            <select name="season" id="level" >
                <option value="STEP_FORM1" <?=($_GET['q'] == 'STEP_FORM1')?'selected':'';?>>سه ماهه</option>
                <option value="STEP_FORM2" <?=($_GET['q'] == 'STEP_FORM2')?'selected':'';?>>شش ماهه</option>
                <option value="STEP_FORM3" <?=($_GET['q'] == 'STEP_FORM3')?'selected':'';?>>نه ماهه</option>
                <option value="STEP_FORM4" <?=($_GET['q'] == 'STEP_FORM4')?'selected':'';?>>یکساله</option>
            </select>
        </div>
        <div class="col-md-10 col-sm-12 col-sx-12">
            <?
            $msg = $messageStack->output('message');
            if($msg != ''):
                echo $msg;
            endif;
            ?>
            <? foreach ($child as $v):?>
            <div class="col-md-2 col-xs-12 col-sm-12 ">

                <div class="col-md-12 confirm-vahed ">
                    <div class="col-md-12" style="height: 50px">
                        <label for=""><?=$v['name'].' '.$v['family']?></label>
                    </div>
                    <div class="col-md-12">
                        <a href="<?=RELA_DIR?>admin/?component=reports&action=confirm&id=<?=$v['admin_id']?>&s=1" class="btn btn-primary btn-block">تایید</a>
                        <a href="<?=RELA_DIR?>admin/?component=reports&action=confirm&id=<?=$v['admin_id']?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                    </div>
                </div>
            </div>
            <? endforeach;?>
        </div>
    </div>

    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">مقایسه عملکرد واحد در سطح هدف کلان</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div id="container"  >
                <input type='button' class="btn btn-info" id='btn' value='Print' onclick='printDiv();'>
                <style>
                    @media print{
                        table{direction: rtl;
                            float: right;}
                        td{
                            float: right;}
                    }
                </style>
                <script>
                    function printDiv()
                    {

                        var divToPrint=document.getElementById('table1');

                        var newWin=window.open('','Print-Window');

                        newWin.document.open();

                        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                        newWin.document.close();

                        setTimeout(function(){newWin.close();},10);

                    }
                </script>
                <div class='table-cont1' id="table1">

                <table class="table  table-bordered " >
                    <thead>
                    <tr style="text-align: center">

                        <td width="20%" style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                        <td style="background-color: #45639b; color:#fff; " colspan="<?=count($groups)?>">خود اظهاری</td>
                        <td style="background-color: #654c97; color:#fff; " colspan="<?=count($groups)?>">نهایی(تائیدشده)</td>
                    </tr>
                    <tr style="text-align: center">
                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                            <td><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                        <? endforeach;?>
                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                            <td><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                        <? endforeach;?>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($reports as $kalan_no => $kalan_value):?>
                        <tr>
                            <td><?=$kalan_value['kalan']?></td>
                            <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                <td><?
                                    if($head_admin_info['parent_id'] == 1 ){
                                        /** tajmi */
                                        echo substr($kalan_value['admins'][$head_admin_id]['GG'.$season],0,5);
                                    }
                                    else{
                                        /**  */
                                        echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['QQ'.$season],0,5);
                                    }
                                    ?></td>
                            <? endforeach;?>
                            <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                <td><?
                                    if($head_admin_info['parent_id'] == 1 ){
                                        /** tajmi */
                                        echo substr($kalan_value['admins'][$head_admin_id]['G'.$season],0,5);
                                    }
                                    else{
                                        /**  */
                                        echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['Q'.$season],0,5);
                                    }
                                    ?></td>
                            <? endforeach;?>
                        </tr>
                    <? endforeach;?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row xsmallSpace"></div>
    <div id="panel-2" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl ">مقایسه عملکرد واحد در سطح اقدام</h3>
            <div class="panel-actions">
                <button data-expand="#panel-2" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-2" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div id="container"  >
                <div class='table-cont2'>
                <table class="table  table-bordered ">
                    <thead>
                    <tr style="text-align: center">

                        <td  style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                        <td width="300" style="background-color: #5f9846; color:#fff; " rowspan="2">اقدام</td>

                        <td style="background-color: #45639b; color:#fff; " colspan="<?=count($groups)?>">اعلامی</td>
                        <td style="background-color: #654c97; color:#fff; " colspan="<?=count($groups)?>">نهایی(تائیدشده)</td>
                    </tr>
                    <tr style="text-align: center">
                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                            <td><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                        <? endforeach;?>
                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                            <td><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                        <? endforeach;?>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($reports as $kalan_no => $kalan_value):?>
                        <? foreach ($kalan_value['amaliati'] as $amaliati_no => $amaliati_value):?>
                            <? foreach ($amaliati_value['eghdam'] as $eghdam_id => $eghdam_value):?>
                                <tr>
                                    <td class="text-center"><?=$kalan_no?></td>
                                    <td ><?=$eghdam_value['eghdam']?></td>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                        <td><?
                                            if($head_admin_info['parent_id'] == 1 ){
                                                /** tajmi */
                                                echo substr($eghdam_value['admins'][$head_admin_id]['eghdam_vazn']['CC'.$season],0,5);
                                            }
                                            else{
                                                /**  */
                                                echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['RR'.$season],0,5);
                                            }
                                            ?></td>
                                    <? endforeach;?>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                        <td><?
                                            if($head_admin_info['parent_id'] == 1 ){
                                                /** tajmi */
                                                echo substr($eghdam_value['admins'][$head_admin_id]['C'.$season],0,5);
                                            }
                                            else{
                                                /**  */
                                                echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['R'.$season],0,5);
                                            }
                                            ?></td>
                                    <? endforeach;?>
                                </tr>
                            <? endforeach;?>
                        <? endforeach;?>
                    <? endforeach;?>


                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row xsmallSpace"></div>
    <div id="panel-3" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">مقایسه عملکرد واحد در سطح فعالیت</h3>
            <div class="panel-actions">
                <button data-expand="#panel-3" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-3" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div id="container"  >
                <div class='table-cont3'>
                    <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center">

                            <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                            <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">اقدام</td>
                            <td width="300" style="background-color: #5f9846; color:#fff; " rowspan="2">فعالیت</td>

                            <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?=count($groups)?>">خوداظهاری</td>
                            <td width="300" style="background-color: #654c97; color:#fff; " colspan="<?=count($groups)?>">نهایی(تائیدشده)</td>
                        </tr>
                        <tr style="text-align: center">
                            <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                <td width="<?=300/count($groups)?>"><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                            <? endforeach;?>
                            <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                <td width="<?=300/count($groups)?>"><?=$head_admin_info['name'].' '.$head_admin_info['family']?></td>
                            <? endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                    <? foreach ($reports as $kalan_no => $kalan_value):?>
                        <? foreach ($kalan_value['amaliati'] as $amaliati_no => $amaliati_value):?>
                            <? foreach ($amaliati_value['eghdam'] as $eghdam_id => $eghdam_value):?>
                                <? foreach ($eghdam_value['faaliat'] as $faaliat_id => $faaliat_value):?>
                                    <tr>
                                        <td width="50" class="text-center"><?=$kalan_value['kalan_no']?></td>
                                        <td width="50"><?=$eghdam_value['eghdam_id']?></td>
                                        <td width="300"><?=$faaliat_value['faaliat']?></td>
                                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                            <td width="<?=300/count($groups)?>"><?

                                                if($head_admin_info['parent_id'] == 1 ){
                                                    /** tajmi */
                                                    echo substr($faaliat_value['admins'][$head_admin_id]['AA'.$season],0,5);
                                                }
                                                else{
                                                    /**  */
                                                    echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['admin_percent'.$season],0,5);
                                                }
                                                ?></td>
                                        <? endforeach;?>
                                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                            <td width="<?=300/count($groups)?>"><?
                                                if($head_admin_info['parent_id'] == 1 ){
                                                    /** tajmi */
                                                    echo substr($faaliat_value['admins'][$head_admin_id]['A'.$season],0,5);
                                                }
                                                else{
                                                    /**  */
                                                    echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['group'][$head_admin_id]['O'.$season],0,5);
                                                }
                                                ?></td>
                                        <? endforeach;?>
                                    </tr>
                                <? endforeach;?>
                            <? endforeach;?>
                        <? endforeach;?>
                    <? endforeach;?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer clearfix"></div>
</div>
</div>

