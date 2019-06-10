<!--suppress ALL -->
<style>
    @media print {
        table{direction: rtl}
    }
</style>
<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">
<script>
    $(document).ready(function () {
        $('#level').change(function () {
            var season = $(this).val();

            location.href = window.location.origin + '/admin/?component=reports&s='+season;
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
                <option value="STEP_FORM1" <?=($_GET['s'] == 'STEP_FORM1')?'selected':'';?>>سه ماهه</option>
                <option value="STEP_FORM2" <?=($_GET['s'] == 'STEP_FORM2')?'selected':'';?>>شش ماهه</option>
                <option value="STEP_FORM3" <?=($_GET['s'] == 'STEP_FORM3')?'selected':'';?>>نه ماهه</option>
                <option value="STEP_FORM4" <?=($_GET['s'] == 'STEP_FORM4')?'selected':'';?>>یکساله</option>
            </select>
        </div>
        <div class="col-md-1 col-xs-12  pull-left">
            <input type='button' class="btn btn-default btn-block pull-left" style="" id='btn' value='Print' onclick='printDiv();'>
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

                    //$('.yesPrint').show();

                    var divToPrint=document.getElementById('table1');
                    var tahlilKalan=document.getElementById('tahlil-kalan');
                    var divToPrint2=document.getElementById('table2');
                    var divToPrint3=document.getElementById('table3');

                    var newWin=window.open('','Print-Window');

                    newWin.document.open();

                    newWin.document.write('<html><body dir="rtl"  onload="window.print()"><style>td{font-family: Tahoma; font-size: 11px; padding: 5px}  table tr:nth-child(even){background: #f4f4f4}</style>'+divToPrint.innerHTML + tahlilKalan.innerHTML + divToPrint2.innerHTML + divToPrint3.innerHTML+'</body></html>');

                    newWin.document.close();

                    setTimeout(function(){newWin.close();},10);

                }
            </script>
        </div>

        <div class="col-md-10 col-sm-12 col-sx-12">
            <?
            $msg = $messageStack->output('message');
            if($msg != ''):
                echo $msg;
            endif;
            ?>
            <? foreach ($child as $v):?>
                <? if($v['finish_date'] >= date('Y-m-d')):?>
                    <div class="col-md-2 col-xs-12 col-sm-12 ">

                        <div class="col-md-12 confirm-vahed ">
                            <div class="col-md-12" style="height: 50px">
                                <label for=""><?=$v['name'].' '.$v['family']?></label>
                            </div>
                            <div class="col-md-12">
                                <a href="<?=RELA_DIR?>admin/?component=reports&action=confirm&id=<?=$v['admin_id']?>&s=1" class="btn btn-primary btn-block">تایید</a>
                                <a href="<?=RELA_DIR?>admin/?component=reports&action=confirm&id=<?=$v['admin_id']?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                            </div>
                            <?/* if($admin_info['status'] == 2):*/?><!--
                                <div class="alert alert-success">
                                    <strong >zzzzzz </strong>
                                </div>
                            --><?/* endif;*/?>
                        </div>
                    </div>
                <? endif;?>
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
                            <td><?=$kalan_value['kalan_name']?></td>
                            <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                <td><?
                                    if($head_admin_info['parent_id'] == 1 ){
                                        /** tajmi */
                                        echo substr($kalan_value['admins'][$head_admin_id]['GG'.$season],0,5);
                                    }
                                    else{
                                        /**  */
                                        echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['QQ'.$season],0,5);
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
                                        echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['Q'.$season],0,5);
                                    }
                                    ?></td>
                            <? endforeach;?>
                        </tr>
                    <? endforeach;?>

                    </tbody>
                </table>
                </div>


                <div class="col-md-12">
                    <style media="print">
                        .noPrint{ display: none; }
                        .yesPrint{ display: block !important; }
                    </style>

                    <style  type="text/css">
                        @media print {
                            .noPrint {display:none;}
                            .yesPrint{ display: block !important; }
                        }
                        .panel-group .panel {
                            border-radius: 0;
                            box-shadow: none;
                            border-color: #EEEEEE;
                        }

                        .panel-group .panel-default > .panel-heading {
                            padding: 0;
                            border-radius: 0;
                            color: #212121;
                            background-color: #FAFAFA;
                            border-color: #EEEEEE;
                        }

                        .panel-group .panel-title {
                            font-size: 14px;
                        }

                        .panel-group .panel-title > a {
                            display: block;
                            padding: 15px;
                            text-decoration: none;
                        }

                        .panel-group .more-less {
                            float: right;
                            color: #212121;
                        }

                        .panel-default > .panel-heading + .panel-collapse > .panel-body {
                            border-top-color: #EEEEEE;
                        }

                    </style>
                    <script>
                        function toggleIcon(e) {
                            $(e.target)
                                .prev('.panel-heading')
                                .find(".more-less")
                                .toggleClass('glyphicon-plus glyphicon-minus');
                        }
                        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
                        $('.panel-group').on('shown.bs.collapse', toggleIcon);
                    </script>

                    <div >
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs " role="tablist">
                            <? foreach ($groups as $head_admin_id => $head_admin_info): if($head_admin_info['parent_id'] == 1 ){ continue; }?>
                            <li role="presentation" class="pull-right"><a href="#home<?=$head_admin_id?>" aria-controls="home<?=$head_admin_id?>" role="tab" data-toggle="tab">
                                    <?=$head_admin_info['name'].' '.$head_admin_info['family']?>
                                </a></li>
                            <? endforeach;?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="tahlil-kalan">
                            <?  foreach ($groups as $head_admin_id => $head_admin_info):

                                if($head_admin_info['parent_id'] == 1 ){ continue; } ?>

                                <div role="tabpanel" class="tab-pane fade" id="home<?=$head_admin_id?>">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <? foreach ($reports as $kalan_no => $kalan_value):?>
                                        <? if(isset($kalanTahlilArray[$head_admin_id][$kalan_no])):?>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne<?=$head_admin_id.$kalan_no?>">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?=$head_admin_id.$kalan_no?>" aria-expanded="true"
                                                           aria-controls="collapseOne<?=$head_admin_id.$kalan_no?>">
                                                            <? if( $kalanTahlilArray[$head_admin_id][$kalan_no] != ''):?>
                                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                                            <? endif;?>
                                                            <span class="yesPrint" style="display: ">  <?=$head_admin_info['name'].' '.$head_admin_info['family']?> | </span>
                                                            <?=' '.$kalan_value['kalan_name']?>
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div id="collapseOne<?=$head_admin_id.$kalan_no?>" class="panel-collapse collapse " style="padding: 15px" role="tabpanel"
                                                     aria-labelledby="headingOne<?=$head_admin_id.$kalan_no?>">
                                                    <?=nl2br($kalanTahlilArray[$head_admin_id][$kalan_no]) ?>
                                                </div>

                                            </div>
                                        <? endif; ?>
                                    <?  endforeach;?>
                                    </div><!-- panel-group -->
                                </div>
                            <?  endforeach; ?>

                        </div>

                    </div>




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
                <div class='table-cont2' id="table2">
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
                        <? foreach ($kalan_value['amaliatis'] as $amaliati_no => $amaliati_value):?>
                            <? foreach ($amaliati_value['eghdams'] as $eghdam_id => $eghdam_value):?>
                                <tr>
                                    <td class="text-center"><?=$kalan_no?></td>
                                    <td ><?=$eghdam_value['eghdam_name']?></td>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                        <td><?
                                            if($head_admin_info['parent_id'] == 1 ){
                                                /** tajmi */
                                                echo substr($eghdam_value['admins'][$head_admin_id]['eghdam_vazn']['CC'.$season],0,5);
                                            }
                                            else{
                                                /**  */
                                                echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['RR'.$season],0,5);
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
                                                echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['R'.$season],0,5);
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
                <div class='table-cont3' id="table3">
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
                        <? foreach ($kalan_value['amaliatis'] as $amaliati_no => $amaliati_value):?>
                            <? foreach ($amaliati_value['eghdams'] as $eghdam_id => $eghdam_value):?>
                                <? foreach ($eghdam_value['faaliats'] as $faaliat_id => $faaliat_value):?>
                                    <tr>
                                        <td width="50" class="text-center"><?=$kalan_no?></td>
                                        <td width="50"><?=$eghdam_id?></td>
                                        <td width="300"><?=$faaliat_value['faaliat_name']?></td>
                                        <? foreach ($groups as $head_admin_id => $head_admin_info):?>
                                            <td width="<?=300/count($groups)?>"><?

                                                if($head_admin_info['parent_id'] == 1 ){
                                                    /** tajmi */
                                                    echo substr($faaliat_value['admins'][$head_admin_id]['AA'.$season],0,5);
                                                }
                                                else{
                                                    /**  */
                                                    echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['OO'.$season],0,5);
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
                                                    echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['O'.$season],0,5);
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


