<!--suppress ALL -->

<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">


<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> وضعیت پیشرفت</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl ">نمودار پیشرفت برنامه</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">


            <script src="<?=RELA_DIR?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/highcharts.js"></script>
            <script src="<?=RELA_DIR?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/exporting.js"></script>
            <script src="<?=RELA_DIR?>templates/<?php echo CURRENT_SKIN; ?>/assets/js/export-data.js"></script>



            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


            <script>

                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'نمودار پیشرفت در سطح دانشگاه'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: <?=$chart[3]['categories']?>,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        max:100,
                        title: {
                            text: 'درصد'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 1
                        }
                    },
                    series: <?=$chart[3]['series'];?>




                });
            </script>

        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>

<div class="content-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl ">وضعیت پیشرفت</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">


            <div class="table-responsive table-responsive-datatables">
                <? if($msg != ''): ?>
                    <?=$msg;?>
                <? endif;?>

                <style>td{white-space: nowrap;}</style>
                <form action="<?=RELA_DIR?>admin/?component=form&action=sabt"  method="post">

                    <table id="example" class="table-bordered rtl" cellspacing="0" >
                        <thead>
                        <tr style="background-color: #772e53; color:#fff; text-align: center">

                            <td rowspan="2">هدف</td>
                            <td colspan="3">اعلامی</td>
                            <td colspan="3">تعدیلی</td>
                        </tr>
                        <tr style="background-color: #772e53; color:#fff; text-align: center">
                            <td>گروه</td>
                            <td>دانشکده</td>
                            <td>تجمیع</td>
                            <td>گروه</td>
                            <td>دانشکده</td>
                            <td>تجمیع</td>
                        </tr>
                        </thead>
                        <tbody>

                        <? foreach ($list['list'] as $kalan_no => $vKalan): ?>

                            <tr class="">
                                <td><?=$kalan_no?></td>
                                <td class="word-wrap" style="width:150px !important; display: inline-block">
                                    <div><?=$vKalan['kalan']?>
                                        <a class="show-more " data-level="kalan" data-kalan_no="<?=$vKalan['kalan_no']?>" href="#">◄</a>
                                        <a class="show-more-admin " data-level="kalan" data-kalan_no="<?=$vKalan['kalan_no']?>" href="#">▼ واحد</a>
                                    </div>
                                </td>
                                <td style="background-color: whitesmoke"></td>
                                <td style="background-color: whitesmoke"></td>
                                <td style="background-color: whitesmoke"></td>
                                <td></td>
                                <td><!--H1'---><?=substr($vKalan['darsad_elami_kalanuni1'],0,5)?></td>
                                <td></td>
                                <td><!--H1---><?=substr($vKalan['darsad_tadili_kalanuni1'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H2'---><?=substr($vKalan['darsad_elami_kalanuni2'],0,5)?></td>
                                <td></td>
                                <td><!--H2---><?=substr($vKalan['darsad_tadili_kalanuni2'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H3'---><?=substr($vKalan['darsad_elami_kalanuni3'],0,5)?></td>
                                <td></td>
                                <td><!--H3---><?=substr($vKalan['darsad_tadili_kalanuni3'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H4'---><?=substr($vKalan['darsad_elami_kalanuni4'],0,5)?></td>
                                <td></td>
                                <td><!--H4---><?=substr($vKalan['darsad_tadili_kalanuni4'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>

                            </tr>
                            <? foreach ($vKalan['admins'] as $id => $vAdmins):?>
                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-kalan-admins kalan-admin-<?=$vKalan['kalan_no']?>">
                                    <td></td>
                                    <td style="width:150px !important; display: inline-block"><?=$vAdmins['name'].' '.$vAdmins['family']?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><!--G1'---><?=substr($vAdmins['darsad_elami_kalan1'],0,5)?></td>
                                    <td></td>
                                    <td><!--G1---><?=substr($vAdmins['darsad_tadili_kalan1'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G2'---><?=substr($vAdmins['darsad_elami_kalan2'],0,5)?></td>
                                    <td></td>
                                    <td><!--G2---><?=substr($vAdmins['darsad_tadili_kalan2'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G3'---><?=substr($vAdmins['darsad_elami_kalan3'],0,5)?></td>
                                    <td></td>
                                    <td><!--G3---><?=substr($vAdmins['darsad_tadili_kalan3'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G4'---><?=substr($vAdmins['darsad_elami_kalan4'],0,5)?></td>
                                    <td></td>
                                    <td><!--G4---><?=substr($vAdmins['darsad_tadili_kalan4'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>

                                </tr>
                            <? endforeach;?>
                            <? foreach ($vKalan['amaliati'] as $amaliati_no => $vAmaliati):?>
                                <tr class="tr-amaliati kalan-<?=$vKalan['kalan_no']?>" >
                                    <td></td>
                                    <td></td>
                                    <td class="word-wrap" rowspan="<?=$vKalan['amaliatiRow']?>" style="width:150px !important; display: inline-block">
                                        <div><?=$vAmaliati['amaliati']?>
                                            <a class="show-more" data-level="amaliati" data-amaliati_no="<?=$vAmaliati['amaliati_no']?>" href="#">◄</a>
                                            <a class="show-more-admin " data-level="amaliati" data-amaliati_no="<?=$vAmaliati['amaliati_no']?>" href="#">▼ واحد</a>
                                        </div></td>

                                    <td style="background-color: whitesmoke"></td>
                                    <td style="background-color: whitesmoke"></td>
                                    <td></td>
                                    <td><!--F1'---><?=substr($vAmaliati['darsad_elami_amaliati1'],0,5)?></td>
                                    <td></td>
                                    <td><!--F1---><?=substr($vAmaliati['darsad_tadili_amaliati1'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F2'---><?=substr($vAmaliati['darsad_elami_amaliati2'],0,5)?></td>
                                    <td></td>
                                    <td><!--F2---><?=substr($vAmaliati['darsad_tadili_amaliati2'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F3'---><?=substr($vAmaliati['darsad_elami_amaliati3'],0,5)?></td>
                                    <td></td>
                                    <td><!--F3---><?=substr($vAmaliati['darsad_tadili_amaliati3'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F4'---><?=substr($vAmaliati['darsad_elami_amaliati4'],0,5)?></td>
                                    <td></td>
                                    <td><!--F4---><?=substr($vAmaliati['darsad_tadili_amaliati4'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                </tr>
                                <? foreach ($vAmaliati['admins'] as $id => $vAdmins):?>
                                    <tr style="background-color: rgb(212,247,255) !important;" class="tr-amaliati-admins amaliati-admin-<?=$vAmaliati['amaliati_no']?>">
                                        <td></td>
                                        <td></td>
                                        <td><?=$vAdmins['name'].' '.$vAdmins['family']?></td>
                                        <td></td>
                                        <td></td>
                                        <td><!--n---><?=$vAdmins['vazn_tadili_amaliati']?></td>
                                        <td><!--E1'---><?=substr($vAdmins['darsad_elami_amaliati1'],0,5)?></td>
                                        <td></td>
                                        <td><!--E1---><?=substr($vAdmins['darsad_tadili_amaliati1'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E2'---><?=substr($vAdmins['darsad_elami_amaliati2'],0,5)?></td>
                                        <td></td>
                                        <td><!--E2---><?=substr($vAdmins['darsad_tadili_amaliati2'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E3'---><?=substr($vAdmins['darsad_elami_amaliati3'],0,5)?></td>
                                        <td></td>
                                        <td><!--E3---><?=substr($vAdmins['darsad_tadili_amaliati3'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E4'---><?=substr($vAdmins['darsad_elami_amaliati4'],0,5)?></td>
                                        <td></td>

                                        <td><!--E4---><?=substr($vAdmins['darsad_tadili_amaliati4'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>

                                    </tr>
                                <? endforeach;?>
                                <? foreach ($vAmaliati['eghdam'] as $eghdam_id => $vEghdam):?>
                                    <tr class="tr-eghdam amaliati-<?=$vAmaliati['amaliati_no']?>">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td  class="word-wrap"  rowspan="<?=$vKalan['eghdamRow']?>" style="width:150px !important; display: inline-block">
                                            <div><?=$vEghdam['eghdam']?>
                                                <a class="show-more" data-level="eghdam" data-eghdam_no="<?=$vEghdam['eghdam_id']?>" href="#">◄</a>
                                                <a class="show-more-admin " data-level="eghdam" data-eghdam_no="<?=$vEghdam['eghdam_id']?>" href="#">▼ واحد</a>
                                            </div></td>

                                        <td style="background-color: whitesmoke"></td>
                                        <td></td>
                                        <td>D1'-<?=substr($vEghdam['darsad_elami_eghdam1'],0,5)?></td>
                                        <td></td>
                                        <td><!--D1---><?=substr($vEghdam['darsad_tadili_eghdam1_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D2'---><?=substr($vEghdam['darsad_elami_eghdam2'],0,5)?></td>
                                        <td></td>
                                        <td><!--D2---><?=substr($vEghdam['darsad_tadili_eghdam2_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D3'---><?=substr($vEghdam['darsad_elami_eghdam3'],0,5)?></td>
                                        <td></td>
                                        <td><!--D3---><?=substr($vEghdam['darsad_tadili_eghdam3_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D4'---><?=substr($vEghdam['darsad_elami_eghdam4'],0,5)?></td>
                                        <td></td>
                                        <td><!--D4---><?=substr($vEghdam['darsad_tadili_eghdam4_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                    </tr>
                                    <? foreach ($vEghdam['admins'] as $id => $vEAdmins):?>
                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-eghdam-admins eghdam-admin-<?=$vEghdam['eghdam_id']?>">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?=$vEAdmins['name'].' '.$vEAdmins['family']?><a class="show-more-group-eghdam show-more-admin-<?=$vEghdam['eghdam_vazn']?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$vEAdmins['admin_id']?>-<?=$vEghdam['eghdam_vazn']?>"  href="#">▼ </a>(fv:<?=$vEAdmins['eghdam_vazn']?>)</div></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><a class="show-more-group-eghdam show-more-admin-<?/*=$vEAdmins['eghdam_id']*/?> a-show-group-amaliati-<?/*=$amaliati_no*/?> a-show-group-kalan-<?/*=$kalan_no*/?> " data-admin_id="<?/*=$vEAdmins['admin_id']*/?>-<?/*=$vEghdam['eghdam_id']*/?>"  href="#">▼ </a>(fv:<?/*=$vEAdmins['eghdam_id']*/?>)</div></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><a class="show-more-group-eghdam show-more-admin-<?/*=$vEAdmins['eghdam_vazn']*/?> a-show-group-amaliati-<?/*=$amaliati_no*/?> a-show-group-kalan-<?/*=$kalan_no*/?> " data-admin_id="<?/*=$vEAdmins['admin_id']*/?>-<?/*=$vFaaliat['faaliat_id']*/?>"  href="#">▼ </a>(fv:<?/*=$vEAdmins['faaliat_vazn']*/?>)</div></td>


                                            <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><!--(ev:--><?/*=$vEAdmins['eghdam_vazn']['eghdam_vazn']*/?>
                                            <td></td>
                                            <td>m-<?=substr($vEAdmins['vazn_tadili_eghdam'],0,5)?></td>
                                            <td>C1'-<?=substr($vEAdmins['eghdam_vazn']['elami_eghdam1'],0,5)?></td>
                                            <td></td>

                                            <td><!--C1---><?=substr($vEAdmins['darsad_tadili_eghdam1'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_1]" value="<?=$vEAdmins['eghdam_vazn']['manager1_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_2]" value="<?=$vEAdmins['eghdam_vazn']['manager1_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_3]" value="<?=$vEAdmins['eghdam_vazn']['manager1_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil1_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil1_4']?></span></td>

                                            <td><!--C2'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam2'],0,5)?></td>
                                            <td></td>

                                            <td><!--C2---><?=substr($vEAdmins['darsad_tadili_eghdam2'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_1]" value="<?=$vEAdmins['eghdam_vazn']['manager2_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_2]" value="<?=$vEAdmins['eghdam_vazn']['manager2_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_3]" value="<?=$vEAdmins['eghdam_vazn']['manager2_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil2_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil2_4']?></span></td>


                                            <td><!--C3'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam3'],0,5)?></td>
                                            <td></td>

                                            <td><!--C3---><?=substr($vEAdmins['darsad_tadili_eghdam3'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_1]" value="<?=$vEAdmins['eghdam_vazn']['manager3_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_2]" value="<?=$vEAdmins['eghdam_vazn']['manager3_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_3]" value="<?=$vEAdmins['eghdam_vazn']['manager3_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil3_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil3_4']?></span></td>


                                            <td><!--C4'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam4'],0,5)?></td>
                                            <td></td>

                                            <td><!--C4---><?=substr($vEAdmins['darsad_tadili_eghdam4'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_1]" value="<?=$vEAdmins['eghdam_vazn']['manager4_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_2]" value="<?=$vEAdmins['eghdam_vazn']['manager4_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_3]" value="<?=$vEAdmins['eghdam_vazn']['manager4_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil4_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil4_4']?></span></td>

                                        </tr>
                                        <? foreach ($vEAdmins['group'] as $id => $vEGroup):?>
                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-eghdam-<?=$vEGroup['parent_id']?>  eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="word-wrap">|--- <?=$vEGroup['name'].' '.$vEGroup['family']?>
                                                </td>
                                                <td></td>
                                                <td>R1'-<?=substr($vEGroup['admin_percent1'],0,5)?>
                                                    <? if($vEGroup['admin_file1']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season1/<?=$vEghdam['eghdam_id']?>/<?=$vEGroup['admin_file1']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat1']?></td>

                                                <td>R1 -<?=substr($vEGroup['darsad_tadili_group1'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_1]" value="<?=$vEGroup['manager1_1']?>"><span style="display: none;"><?=$vEGroup['manager1_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_2]" value="<?=$vEGroup['manager1_2']?>"><span style="display: none;"><?=$vEGroup['manager1_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_3]" value="<?=$vEGroup['manager1_3']?>"><span style="display: none;"><?=$vEGroup['manager1_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_4]" value="<?=$vEGroup['tahlil1_4']?>"><span style="display: none;"><?=$vEGroup['tahlil1_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil1_4']?>
                                                    <? endif; ?>
                                                </td>

                                                <td><!--R2'---><?=substr($vEGroup['admin_percent2'],0,5)?>
                                                    <? if($vEGroup['admin_file2']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season2/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file2']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat2']?></td>

                                                <td><!--R2---><?=substr($vEGroup['darsad_tadili_group2'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_1]" value="<?=$vEGroup['manager2_1']?>"><span style="display: none;"><?=$vEGroup['manager2_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_2]" value="<?=$vEGroup['manager2_2']?>"><span style="display: none;"><?=$vEGroup['manager2_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_3]" value="<?=$vEGroup['manager2_3']?>"><span style="display: none;"><?=$vEGroup['manager2_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_4]" value="<?=$vEGroup['tahlil2_4']?>"><span style="display: none;"><?=$vEGroup['tahlil2_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil2_4']?>
                                                    <? endif; ?>
                                                </td>
                                                <td><!--R3'---><?=substr($vEGroup['admin_percent3'],0,5)?>
                                                    <? if($vEGroup['admin_file3']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season3/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file3']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat3']?></td>

                                                <td><!--R3---><?=substr($vEGroup['darsad_tadili_group3'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_1]" value="<?=$vEGroup['manager3_1']?>"><span style="display: none;"><?=$vEGroup['manager3_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_2]" value="<?=$vEGroup['manager3_2']?>"><span style="display: none;"><?=$vEGroup['manager3_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_3]" value="<?=$vEGroup['manager3_3']?>"><span style="display: none;"><?=$vEGroup['manager3_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_4]" value="<?=$vEGroup['tahlil3_4']?>"><span style="display: none;"><?=$vEGroup['tahlil3_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil3_4']?>
                                                    <? endif; ?>
                                                </td>
                                                <td><!--R4'---><?=substr($vEGroup['admin_percent4'],0,5)?>
                                                    <? if($vEGroup['admin_file4']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season4/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file4']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat4']?></td>
                                                <td><!--R4---><?=substr($vEGroup['darsad_tadili_group4'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_1]" value="<?=$vEGroup['manager4_1']?>"><span style="display: none;"><?=$vEGroup['manager4_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_2]" value="<?=$vEGroup['manager4_2']?>"><span style="display: none;"><?=$vEGroup['manager4_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_3]" value="<?=$vEGroup['manager4_3']?>"><span style="display: none;"><?=$vEGroup['manager4_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_4]" value="<?=$vEGroup['tahlil4_4']?>"><span style="display: none;"><?=$vEGroup['tahlil4_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil4_4']?>
                                                    <? endif; ?>
                                                </td>
                                            </tr>
                                        <? endforeach;?>
                                    <? endforeach;?>



                                    <? foreach ($vEghdam['faaliat'] as $faaliat_id => $vFaaliat):?>
                                        <tr class="tr-faaliat eghdam-<?=$vEghdam['eghdam_id']?>">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="word-wrap" style="width:150px !important; display: inline-block"><div><?=$vFaaliat['faaliat']?>
                                                    <a class="show-more-admin " data-level="faaliat" data-faaliat_no="<?=$vFaaliat['faaliat_id']?>" href="#">▼ واحد</a>
                                                </div></td>
                                            <td></td>
                                            <td><!--B1'---><?=substr($vFaaliat['darsad_elami_faaliat1'],0,5)?></td>
                                            <td></td>
                                            <td><!--B1---><?=substr($vFaaliat['darsad_tadili_faaliat1'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B2'---><?=substr($vFaaliat['darsad_elami_faaliat2'],0,5)?></td>
                                            <td></td>
                                            <td><!--B2---><?=substr($vFaaliat['darsad_tadili_faaliat2'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B3'---><?=substr($vFaaliat['darsad_elami_faaliat3'],0,5)?></td>
                                            <td></td>
                                            <td><!--B3---><?=substr($vFaaliat['darsad_tadili_faaliat3'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B4'---><?=substr($vFaaliat['darsad_elami_faaliat4'],0,5)?></td>
                                            <td></td>
                                            <td><!--B4---><?=substr($vFaaliat['darsad_tadili_faaliat4'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>

                                        </tr>
                                        <? foreach ($vFaaliat['admins'] as $id => $vFAdmins):?>
                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-faaliat-admins faaliat-admin-<?=$vFaaliat['faaliat_id']?>">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="word-wrap"><div><!--تجمیع--> <?=$vFAdmins['name'].' '.$vFAdmins['family']?><a class="show-more-group-faaliat show-more-admin-<?=$vFaaliat['faaliat_id']?> a-show-group-eghdam-<?=$eghdam_id?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$vFAdmins['admin_id']?>-<?=$vFaaliat['faaliat_id']?>"  href="#">▼ </a>(fv:<?=$vFAdmins['faaliat_vazn']?>)</div></td>
                                                <td>Z-<?=substr($vFAdmins['vazn_tadili_faaliat'],0,5)?></td>
                                                <td><!--A1'---><?=substr($vFAdmins['admin_percent1'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file1']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season1/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file1']*/?>">دانلود فایل</a>
                                                <?/* endif;*/?></td>-->
                                                <td></td>
                                                <td><!--A1---><?=substr($vFAdmins['darsad_tadili_faaliat1'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_1"  name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_1]" value="<?/*=$vFAdmins['manager1_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_2]" value="<?/*=$vFAdmins['manager1_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_3]" value="<?/*=$vFAdmins['manager1_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>

                                                <td><!--A2'---><?=substr($vFAdmins['admin_percent2'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file2']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season2/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file2']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A2---><?=substr($vFAdmins['darsad_tadili_faaliat2'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_1]" value="<?/*=$vFAdmins['manager2_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_2]" value="<?/*=$vFAdmins['manager2_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_3]" value="<?/*=$vFAdmins['manager2_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                                <td><!--A3'---><?=substr($vFAdmins['admin_percent3'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file3']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season3/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file3']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A3---><?=substr($vFAdmins['darsad_tadili_faaliat3'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_1]" value="<?/*=$vFAdmins['manager3_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_2]" value="<?/*=$vFAdmins['manager3_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_3]" value="<?/*=$vFAdmins['manager3_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                                <td><!--A4'---><?=substr($vFAdmins['admin_percent4'],0,5)?>
                                                    <!-- <?/* if($vFAdmins['admin_file4']):*/?>
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season4/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file4']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A4---><?=substr($vFAdmins['darsad_tadili_faaliat4'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_1]" value="<?/*=$vFAdmins['manager4_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_2]" value="<?/*=$vFAdmins['manager4_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_3]" value="<?/*=$vFAdmins['manager4_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                            </tr>
                                            <? foreach ($vFAdmins['group'] as $id => $vFGroup):?>
                                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-<?=$vFGroup['parent_id']?>-<?=$vFGroup['faaliat_id']?> faaliat-no-group-<?=$vFGroup['faaliat_id']?> eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="word-wrap">|--- <?=$vFGroup['name'].' '.$vFGroup['family']?>
                                                    </td>
                                                    <td></td>
                                                    <td>O1'-<?=substr($vFGroup['admin_percent1'],0,5)?>
                                                        <? if($vFGroup['admin_file1']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season1/<?=$vEghdam['eghdam_id']?>/<?=$vFGroup['admin_file1']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat1']?></td>

                                                    <td>O1 -<?=substr($vFGroup['darsad_tadili_group1'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_1]" value="<?=$vFGroup['manager1_1']?>"><span style="display: none;"><?=$vFGroup['manager1_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_2]" value="<?=$vFGroup['manager1_2']?>"><span style="display: none;"><?=$vFGroup['manager1_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_3]" value="<?=$vFGroup['manager1_3']?>"><span style="display: none;"><?=$vFGroup['manager1_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_4]" value="<?=$vFGroup['tahlil1_4']?>"><span style="display: none;"><?=$vFGroup['tahlil1_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil1_4']?>
                                                        <? endif; ?>
                                                    </td>

                                                    <td><!--O2'---><?=substr($vFGroup['admin_percent2'],0,5)?>
                                                        <? if($vFGroup['admin_file2']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season2/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file2']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat2']?></td>

                                                    <td><!--O2---><?=substr($vFGroup['darsad_tadili_group2'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_1]" value="<?=$vFGroup['manager2_1']?>"><span style="display: none;"><?=$vFGroup['manager2_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_2]" value="<?=$vFGroup['manager2_2']?>"><span style="display: none;"><?=$vFGroup['manager2_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_3]" value="<?=$vFGroup['manager2_3']?>"><span style="display: none;"><?=$vFGroup['manager2_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_4]" value="<?=$vFGroup['tahlil2_4']?>"><span style="display: none;"><?=$vFGroup['tahlil2_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil2_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                    <td><!--O3'---><?=substr($vFGroup['admin_percent3'],0,5)?>
                                                        <? if($vFGroup['admin_file3']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season3/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file3']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat3']?></td>

                                                    <td><!--O3---><?=substr($vFGroup['darsad_tadili_group3'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_1]" value="<?=$vFGroup['manager3_1']?>"><span style="display: none;"><?=$vFGroup['manager3_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_2]" value="<?=$vFGroup['manager3_2']?>"><span style="display: none;"><?=$vFGroup['manager3_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_3]" value="<?=$vFGroup['manager3_3']?>"><span style="display: none;"><?=$vFGroup['manager3_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_4]" value="<?=$vFGroup['tahlil3_4']?>"><span style="display: none;"><?=$vFGroup['tahlil3_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil3_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                    <td><!--O4'---><?=substr($vFGroup['admin_percent4'],0,5)?>
                                                        <? if($vFGroup['admin_file4']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season4/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file4']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat4']?></td>
                                                    <td><!--O4---><?=substr($vFGroup['darsad_tadili_group4'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_1]" value="<?=$vFGroup['manager4_1']?>"><span style="display: none;"><?=$vFGroup['manager4_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_2]" value="<?=$vFGroup['manager4_2']?>"><span style="display: none;"><?=$vFGroup['manager4_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_3]" value="<?=$vFGroup['manager4_3']?>"><span style="display: none;"><?=$vFGroup['manager4_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_4]" value="<?=$vFGroup['tahlil4_4']?>"><span style="display: none;"><?=$vFGroup['tahlil4_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil4_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                </tr>
                                            <? endforeach;?>
                                        <? endforeach;?>
                                    <? endforeach;?>
                                <? endforeach;?>
                            <? endforeach;?>
                        <? endforeach;?>
                        </tbody>

                    </table>
                    <? if(($admin_info['status'] == 0 || $admin_info['status'] == 1) && $admin_info['parent_id']==0 ): ?>
                        <button name="submit" class="btn btn-block btn-primary fixed">ثبت موقت</button>
                    <? endif;?>

                    <? if((($admin_info['status'] == 0 || $admin_info['status'] == 1) && $admin_info['parent_id']==0 )&& $admin_info['name']=="مرکز"): ?>
                        <button name="submit2" class="btn btn-block btn-info">ثبت نهایی</button>
                    <? endif;?>

                </form>
            </div>
        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>




/** */


<div class="content-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">وضعیت پیشرفت</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">


            <!-- separator -->
            <!--            <div class="row smallSpace"></div>
            -->            <div class="table-responsive table-responsive-datatables">
                <? if($msg != ''): ?>
                    <?=$msg;?>
                <? endif;?>

                <style>td{white-space: nowrap;}</style>
                <form action="<?=RELA_DIR?>admin/?component=form&action=sabt"  method="post">

                    <a style="display: none" class="show-amaliati btn btn-info" >نمایش در سطح عملیاتی</a>

                    <label for="admin">در سطح:</label>

                    <script>

                    </script>
                    <select id="admin" class="show-admin" multiple >
                        <? foreach ($list['showAdmin'] as $k => $admins):?>
                            <option <? if(strpos($_GET['q'], ','.$admins['admin_id'].',') !== false){ echo 'selected';}?> value="<?=$admins['admin_id']?>"><?=$admins['name'].' '.$admins['family']?></option>
                        <? endforeach; ?>
                    </select>


                    <label for="level">در سطح:</label>

                    <select id="level" class="show-level">
                        <option value="kalan">نمایش در سطح کلان</option>
                        <option value="amaliati">نمایش در سطح عملیاتی</option>
                        <option value="eghdam">نمایش در سطح اقدام</option>
                        <option value="faaliat">نمایش در سطح فعالیت</option>


                    </select>

                    <label for="columns">نمایش:</label>
                    <select id="columns" class="show-columns" multiple>
                        <option selected value="0">1</option>
                        <option selected value="1">2</option>
                        <option selected value="2">3</option>
                        <option selected value="3">4</option>
                        <option selected value="4">5</option>
                        <option selected value="5">6</option>
                        <option selected value="6">7</option>

                        <option selected value="7">8</option>
                        <option selected value="8">9</option>
                        <? if($admin_info['parent_id']==0):?>
                            <option selected value="9">10</option>
                            <option selected value="10">11</option>
                            <option selected value="11">12</option>
                        <? endif;?>
                        <option selected value="12">13</option>


                        <option selected value="13">14</option>
                        <option selected value="14">15</option>
                        <option selected value="15">16</option>
                        <? if($admin_info['parent_id']==0):?>
                            <option selected value="16">17</option>
                            <option selected value="17">18</option>
                            <option selected value="18">19</option>
                        <? endif;?>
                        <option selected value="19">20</option>


                        <option selected value="20">21</option>
                        <option selected value="21">22</option>
                        <option selected value="22">23</option>
                        <? if($admin_info['parent_id']==0):?>
                            <option selected value="23">24</option>
                            <option selected value="24">25</option>
                            <option selected value="25">26</option>
                        <? endif;?>
                        <option selected value="26">27</option>

                        <option selected value="27">28</option>
                        <option selected value="28">29</option>
                        <option selected value="29">30</option>
                        <? if($admin_info['parent_id']==0):?>
                            <option selected value="30">31</option>
                            <option selected value="31">32</option>
                            <option selected value="32">33</option>
                        <? endif;?>
                        <option selected value="33">34</option>
                    </select>

                    <table id="example" class="  table-bordered rtl" cellspacing="0" >
                        <thead>
                        <tr>

                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>

                            <th style="background-color: #7dff7f; border: 0">7</th>
                            <th style="background-color: #7dff7f; border: 0">8</th>
                            <th style="background-color: #7dff7f; border: 0">9</th>

                            <? if($admin_info['parent_id']==0):?>
                                <th style="background-color: #7dff7f; border: 0">10</th>
                                <th style="background-color: #7dff7f; border: 0">11</th>
                                <th style="background-color: #7dff7f; border: 0">12</th>
                            <? endif;?>
                            <th style="background-color: #7dff7f; border: 0">13</th>

                            <th style="background-color: #f2a89e; border: 0">14</th>
                            <th style="background-color: #f2a89e; border: 0">15</th>
                            <th style="background-color: #f2a89e; border: 0">16</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th style="background-color: #f2a89e; border: 0">17</th>
                                <th style="background-color: #f2a89e; border: 0">18</th>
                                <th style="background-color: #f2a89e; border: 0">19</th>
                            <? endif;?>
                            <th style="background-color: #f2a89e; border: 0">20</th>


                            <th style="background-color: #ffbe62; border: 0">21</th>
                            <th style="background-color: #ffbe62; border: 0">22</th>
                            <th style="background-color: #ffbe62; border: 0">23</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th style="background-color: #ffbe62; border: 0">24</th>
                                <th style="background-color: #ffbe62; border: 0">25</th>
                                <th style="background-color: #ffbe62; border: 0">26</th>
                            <? endif; ?>
                            <th style="background-color: #ffbe62; border: 0">27</th>


                            <th style="background-color: #8DD4FF; border: 0">28</th>
                            <th style="background-color: #8DD4FF; border: 0">29</th>
                            <th style="background-color: #8DD4FF; border: 0">30</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th style="background-color: #8DD4FF; border: 0">31</th>
                                <th style="background-color: #8DD4FF; border: 0">32</th>
                                <th style="background-color: #8DD4FF; border: 0">33</th>
                            <? endif;?>
                            <th style="background-color: #8DD4FF; border: 0">34</th>

                        </tr>
                        <tr style="background-color: #772e53; color:#fff; text-align: center">
                            <th>کد</th>
                            <th>هدف کلان</th>
                            <th>هدف عملیاتی</th>
                            <th>اقدام</th>
                            <th>فعالیت</th>
                            <th>وزن</th>
                            <th>اعلامی واحد</th>
                            <th>توضیحات اعلامی واحد</th>
                            <th>درصد تعدیلی مرکز</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th>تطابق مستند با درصد اعلامی</th>
                                <th>تطابق سایت با درصد اعلامی</th>
                                <th>تطابق جلسه با درصد اعلامی</th>
                            <? endif;?>
                            <th>توضیحات مرکز</th>
                            <th>اعلامی واحد</th>
                            <th>توضیحات اعلامی واحد</th>
                            <th>درصد تعدیلی مرکز</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th>تطابق مستند با درصد اعلامی</th>
                                <th>تطابق سایت با درصد اعلامی</th>
                                <th>تطابق جلسه با درصد اعلامی</th>
                            <? endif;?>
                            <th>توضیحات مرکز</th>
                            <th>اعلامی واحد</th>
                            <th>توضیحات اعلامی واحد</th>
                            <th>درصد تعدیلی مرکز</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th>تطابق مستند با درصد اعلامی</th>
                                <th>تطابق سایت با درصد اعلامی</th>
                                <th>تطابق جلسه با درصد اعلامی</th>
                            <? endif;?>
                            <th>توضیحات مرکز</th>
                            <th>اعلامی واحد</th>
                            <th>توضیحات اعلامی واحد</th>
                            <th>درصد تعدیلی مرکز</th>
                            <? if($admin_info['parent_id']==0):?>
                                <th>تطابق مستند با درصد اعلامی</th>
                                <th>تطابق سایت با درصد اعلامی</th>
                                <th>تطابق جلسه با درصد اعلامی</th>
                            <? endif;?>
                            <th>توضیحات مرکز</th>
                        </tr>
                        </thead>
                        <tbody>

                        <? foreach ($list['list'] as $kalan_no => $vKalan): ?>

                            <tr class="">
                                <td><?=$kalan_no?></td>
                                <td class="word-wrap" style="width:150px !important; display: inline-block">
                                    <div><?=$vKalan['kalan']?>
                                        <a class="show-more " data-level="kalan" data-kalan_no="<?=$vKalan['kalan_no']?>" href="#">◄</a>
                                        <a class="show-more-admin " data-level="kalan" data-kalan_no="<?=$vKalan['kalan_no']?>" href="#">▼ واحد</a>
                                    </div>
                                </td>
                                <td style="background-color: whitesmoke"></td>
                                <td style="background-color: whitesmoke"></td>
                                <td style="background-color: whitesmoke"></td>
                                <td></td>
                                <td><!--H1'---><?=substr($vKalan['darsad_elami_kalanuni1'],0,5)?></td>
                                <td></td>
                                <td><!--H1---><?=substr($vKalan['darsad_tadili_kalanuni1'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H2'---><?=substr($vKalan['darsad_elami_kalanuni2'],0,5)?></td>
                                <td></td>
                                <td><!--H2---><?=substr($vKalan['darsad_tadili_kalanuni2'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H3'---><?=substr($vKalan['darsad_elami_kalanuni3'],0,5)?></td>
                                <td></td>
                                <td><!--H3---><?=substr($vKalan['darsad_tadili_kalanuni3'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>
                                <td><!--H4'---><?=substr($vKalan['darsad_elami_kalanuni4'],0,5)?></td>
                                <td></td>
                                <td><!--H4---><?=substr($vKalan['darsad_tadili_kalanuni4'],0,5)?></td>
                                <? if($admin_info['parent_id']==0):?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <? endif;?>
                                <td></td>

                            </tr>
                            <? foreach ($vKalan['admins'] as $id => $vAdmins):?>
                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-kalan-admins kalan-admin-<?=$vKalan['kalan_no']?>">
                                    <td></td>
                                    <td style="width:150px !important; display: inline-block"><?=$vAdmins['name'].' '.$vAdmins['family']?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><!--G1'---><?=substr($vAdmins['darsad_elami_kalan1'],0,5)?></td>
                                    <td></td>
                                    <td><!--G1---><?=substr($vAdmins['darsad_tadili_kalan1'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G2'---><?=substr($vAdmins['darsad_elami_kalan2'],0,5)?></td>
                                    <td></td>
                                    <td><!--G2---><?=substr($vAdmins['darsad_tadili_kalan2'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G3'---><?=substr($vAdmins['darsad_elami_kalan3'],0,5)?></td>
                                    <td></td>
                                    <td><!--G3---><?=substr($vAdmins['darsad_tadili_kalan3'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--G4'---><?=substr($vAdmins['darsad_elami_kalan4'],0,5)?></td>
                                    <td></td>
                                    <td><!--G4---><?=substr($vAdmins['darsad_tadili_kalan4'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>

                                </tr>
                            <? endforeach;?>
                            <? foreach ($vKalan['amaliati'] as $amaliati_no => $vAmaliati):?>
                                <tr class="tr-amaliati kalan-<?=$vKalan['kalan_no']?>" >
                                    <td></td>
                                    <td></td>
                                    <td class="word-wrap" rowspan="<?=$vKalan['amaliatiRow']?>" style="width:150px !important; display: inline-block">
                                        <div><?=$vAmaliati['amaliati']?>
                                            <a class="show-more" data-level="amaliati" data-amaliati_no="<?=$vAmaliati['amaliati_no']?>" href="#">◄</a>
                                            <a class="show-more-admin " data-level="amaliati" data-amaliati_no="<?=$vAmaliati['amaliati_no']?>" href="#">▼ واحد</a>
                                        </div></td>

                                    <td style="background-color: whitesmoke"></td>
                                    <td style="background-color: whitesmoke"></td>
                                    <td></td>
                                    <td><!--F1'---><?=substr($vAmaliati['darsad_elami_amaliati1'],0,5)?></td>
                                    <td></td>
                                    <td><!--F1---><?=substr($vAmaliati['darsad_tadili_amaliati1'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F2'---><?=substr($vAmaliati['darsad_elami_amaliati2'],0,5)?></td>
                                    <td></td>
                                    <td><!--F2---><?=substr($vAmaliati['darsad_tadili_amaliati2'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F3'---><?=substr($vAmaliati['darsad_elami_amaliati3'],0,5)?></td>
                                    <td></td>
                                    <td><!--F3---><?=substr($vAmaliati['darsad_tadili_amaliati3'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                    <td><!--F4'---><?=substr($vAmaliati['darsad_elami_amaliati4'],0,5)?></td>
                                    <td></td>
                                    <td><!--F4---><?=substr($vAmaliati['darsad_tadili_amaliati4'],0,5)?></td>
                                    <? if($admin_info['parent_id']==0):?>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    <? endif;?>
                                    <td></td>
                                </tr>
                                <? foreach ($vAmaliati['admins'] as $id => $vAdmins):?>
                                    <tr style="background-color: rgb(212,247,255) !important;" class="tr-amaliati-admins amaliati-admin-<?=$vAmaliati['amaliati_no']?>">
                                        <td></td>
                                        <td></td>
                                        <td><?=$vAdmins['name'].' '.$vAdmins['family']?></td>
                                        <td></td>
                                        <td></td>
                                        <td><!--n---><?=$vAdmins['vazn_tadili_amaliati']?></td>
                                        <td><!--E1'---><?=substr($vAdmins['darsad_elami_amaliati1'],0,5)?></td>
                                        <td></td>
                                        <td><!--E1---><?=substr($vAdmins['darsad_tadili_amaliati1'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E2'---><?=substr($vAdmins['darsad_elami_amaliati2'],0,5)?></td>
                                        <td></td>
                                        <td><!--E2---><?=substr($vAdmins['darsad_tadili_amaliati2'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E3'---><?=substr($vAdmins['darsad_elami_amaliati3'],0,5)?></td>
                                        <td></td>
                                        <td><!--E3---><?=substr($vAdmins['darsad_tadili_amaliati3'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>
                                        <td><!--E4'---><?=substr($vAdmins['darsad_elami_amaliati4'],0,5)?></td>
                                        <td></td>

                                        <td><!--E4---><?=substr($vAdmins['darsad_tadili_amaliati4'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?endif;?>
                                        <td></td>

                                    </tr>
                                <? endforeach;?>
                                <? foreach ($vAmaliati['eghdam'] as $eghdam_id => $vEghdam):?>
                                    <tr class="tr-eghdam amaliati-<?=$vAmaliati['amaliati_no']?>">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td  class="word-wrap"  rowspan="<?=$vKalan['eghdamRow']?>" style="width:150px !important; display: inline-block">
                                            <div><?=$vEghdam['eghdam']?>
                                                <a class="show-more" data-level="eghdam" data-eghdam_no="<?=$vEghdam['eghdam_id']?>" href="#">◄</a>
                                                <a class="show-more-admin " data-level="eghdam" data-eghdam_no="<?=$vEghdam['eghdam_id']?>" href="#">▼ واحد</a>
                                            </div></td>

                                        <td style="background-color: whitesmoke"></td>
                                        <td></td>
                                        <td>D1'-<?=substr($vEghdam['darsad_elami_eghdam1'],0,5)?></td>
                                        <td></td>
                                        <td><!--D1---><?=substr($vEghdam['darsad_tadili_eghdam1_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D2'---><?=substr($vEghdam['darsad_elami_eghdam2'],0,5)?></td>
                                        <td></td>
                                        <td><!--D2---><?=substr($vEghdam['darsad_tadili_eghdam2_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D3'---><?=substr($vEghdam['darsad_elami_eghdam3'],0,5)?></td>
                                        <td></td>
                                        <td><!--D3---><?=substr($vEghdam['darsad_tadili_eghdam3_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                        <td><!--D4'---><?=substr($vEghdam['darsad_elami_eghdam4'],0,5)?></td>
                                        <td></td>
                                        <td><!--D4---><?=substr($vEghdam['darsad_tadili_eghdam4_D'],0,5)?></td>
                                        <? if($admin_info['parent_id']==0):?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <? endif;?>
                                        <td></td>
                                    </tr>
                                    <? foreach ($vEghdam['admins'] as $id => $vEAdmins):?>
                                        <tr style="background-color: rgb(212,247,255) !important;" class="tr-eghdam-admins eghdam-admin-<?=$vEghdam['eghdam_id']?>">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?=$vEAdmins['name'].' '.$vEAdmins['family']?><a class="show-more-group-eghdam show-more-admin-<?=$vEghdam['eghdam_vazn']?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$vEAdmins['admin_id']?>-<?=$vEghdam['eghdam_vazn']?>"  href="#">▼ </a>(fv:<?=$vEAdmins['eghdam_vazn']?>)</div></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><a class="show-more-group-eghdam show-more-admin-<?/*=$vEAdmins['eghdam_id']*/?> a-show-group-amaliati-<?/*=$amaliati_no*/?> a-show-group-kalan-<?/*=$kalan_no*/?> " data-admin_id="<?/*=$vEAdmins['admin_id']*/?>-<?/*=$vEghdam['eghdam_id']*/?>"  href="#">▼ </a>(fv:<?/*=$vEAdmins['eghdam_id']*/?>)</div></td>
                                            <td class="word-wrap"><div><!--تجمیع--> <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><a class="show-more-group-eghdam show-more-admin-<?/*=$vEAdmins['eghdam_vazn']*/?> a-show-group-amaliati-<?/*=$amaliati_no*/?> a-show-group-kalan-<?/*=$kalan_no*/?> " data-admin_id="<?/*=$vEAdmins['admin_id']*/?>-<?/*=$vFaaliat['faaliat_id']*/?>"  href="#">▼ </a>(fv:<?/*=$vEAdmins['faaliat_vazn']*/?>)</div></td>


                                            <?/*=$vEAdmins['name'].' '.$vEAdmins['family']*/?><!--(ev:--><?/*=$vEAdmins['eghdam_vazn']['eghdam_vazn']*/?>
                                            <td></td>
                                            <td>m-<?=substr($vEAdmins['vazn_tadili_eghdam'],0,5)?></td>
                                            <td>C1'-<?=substr($vEAdmins['eghdam_vazn']['elami_eghdam1'],0,5)?></td>
                                            <td></td>

                                            <td><!--C1---><?=substr($vEAdmins['darsad_tadili_eghdam1'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_1]" value="<?=$vEAdmins['eghdam_vazn']['manager1_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_2]" value="<?=$vEAdmins['eghdam_vazn']['manager1_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_3]" value="<?=$vEAdmins['eghdam_vazn']['manager1_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager1_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_1_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][1_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil1_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil1_4']?></span></td>

                                            <td><!--C2'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam2'],0,5)?></td>
                                            <td></td>

                                            <td><!--C2---><?=substr($vEAdmins['darsad_tadili_eghdam2'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_1]" value="<?=$vEAdmins['eghdam_vazn']['manager2_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_2]" value="<?=$vEAdmins['eghdam_vazn']['manager2_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_3]" value="<?=$vEAdmins['eghdam_vazn']['manager2_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager2_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_2_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][2_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil2_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil2_4']?></span></td>


                                            <td><!--C3'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam3'],0,5)?></td>
                                            <td></td>

                                            <td><!--C3---><?=substr($vEAdmins['darsad_tadili_eghdam3'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_1]" value="<?=$vEAdmins['eghdam_vazn']['manager3_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_2]" value="<?=$vEAdmins['eghdam_vazn']['manager3_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_3]" value="<?=$vEAdmins['eghdam_vazn']['manager3_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager3_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_3_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][3_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil3_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil3_4']?></span></td>


                                            <td><!--C4'---><?=substr($vEAdmins['eghdam_vazn']['elami_eghdam4'],0,5)?></td>
                                            <td></td>

                                            <td><!--C4---><?=substr($vEAdmins['darsad_tadili_eghdam4'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_1" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_1]" value="<?=$vEAdmins['eghdam_vazn']['manager4_1']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_1']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_2" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_2]" value="<?=$vEAdmins['eghdam_vazn']['manager4_2']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_2']?></span></td>
                                                <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_3" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_3]" value="<?=$vEAdmins['eghdam_vazn']['manager4_3']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['manager4_3']?></span></td>
                                            <? endif;?>
                                            <td><input class="w100" data-input="manager" data-position="<?=$eghdam_id?>_<?=$vEAdmins['eghdam_vazn']['admin_id']?>_4_4" name="manager[<?=$vEAdmins['eghdam_vazn']['admin_id']?>][<?=$vEghdam['eghdam_id']?>][4_4]" value="<?=$vEAdmins['eghdam_vazn']['tahlil4_4']?>"><span style="display: none;"><?=$vEAdmins['eghdam_vazn']['tahlil4_4']?></span></td>

                                        </tr>
                                        <? foreach ($vEAdmins['group'] as $id => $vEGroup):?>
                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-eghdam-<?=$vEGroup['parent_id']?>  eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="word-wrap">|--- <?=$vEGroup['name'].' '.$vEGroup['family']?>
                                                </td>
                                                <td></td>
                                                <td>R1'-<?=substr($vEGroup['admin_percent1'],0,5)?>
                                                    <? if($vEGroup['admin_file1']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season1/<?=$vEghdam['eghdam_id']?>/<?=$vEGroup['admin_file1']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat1']?></td>

                                                <td>R1 -<?=substr($vEGroup['darsad_tadili_group1'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_1]" value="<?=$vEGroup['manager1_1']?>"><span style="display: none;"><?=$vEGroup['manager1_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_2]" value="<?=$vEGroup['manager1_2']?>"><span style="display: none;"><?=$vEGroup['manager1_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_3]" value="<?=$vEGroup['manager1_3']?>"><span style="display: none;"><?=$vEGroup['manager1_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_4]" value="<?=$vEGroup['tahlil1_4']?>"><span style="display: none;"><?=$vEGroup['tahlil1_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil1_4']?>
                                                    <? endif; ?>
                                                </td>

                                                <td><!--R2'---><?=substr($vEGroup['admin_percent2'],0,5)?>
                                                    <? if($vEGroup['admin_file2']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season2/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file2']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat2']?></td>

                                                <td><!--R2---><?=substr($vEGroup['darsad_tadili_group2'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_1]" value="<?=$vEGroup['manager2_1']?>"><span style="display: none;"><?=$vEGroup['manager2_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_2]" value="<?=$vEGroup['manager2_2']?>"><span style="display: none;"><?=$vEGroup['manager2_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_3]" value="<?=$vEGroup['manager2_3']?>"><span style="display: none;"><?=$vEGroup['manager2_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_4]" value="<?=$vEGroup['tahlil2_4']?>"><span style="display: none;"><?=$vEGroup['tahlil2_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil2_4']?>
                                                    <? endif; ?>
                                                </td>
                                                <td><!--R3'---><?=substr($vEGroup['admin_percent3'],0,5)?>
                                                    <? if($vEGroup['admin_file3']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season3/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file3']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat3']?></td>

                                                <td><!--R3---><?=substr($vEGroup['darsad_tadili_group3'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_1]" value="<?=$vEGroup['manager3_1']?>"><span style="display: none;"><?=$vEGroup['manager3_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_2]" value="<?=$vEGroup['manager3_2']?>"><span style="display: none;"><?=$vEGroup['manager3_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_3]" value="<?=$vEGroup['manager3_3']?>"><span style="display: none;"><?=$vEGroup['manager3_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_4]" value="<?=$vEGroup['tahlil3_4']?>"><span style="display: none;"><?=$vEGroup['tahlil3_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil3_4']?>
                                                    <? endif; ?>
                                                </td>
                                                <td><!--R4'---><?=substr($vEGroup['admin_percent4'],0,5)?>
                                                    <? if($vEGroup['admin_file4']):?>
                                                        <br>
                                                        <a href="<?=RELA_DIR?>statics/files/<?=$vEGroup['admin_id']?>/season4/<?=$vFaaliat['faaliat_id']?>/<?=$vEGroup['admin_file4']?>">دانلود فایل</a>
                                                    <? endif;?>
                                                </td>
                                                <td><?=$vEGroup['admin_tozihat4']?></td>
                                                <td><!--R4---><?=substr($vEGroup['darsad_tadili_group4'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_1" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_1]" value="<?=$vEGroup['manager4_1']?>"><span style="display: none;"><?=$vEGroup['manager4_1']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_2" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_2]" value="<?=$vEGroup['manager4_2']?>"><span style="display: none;"><?=$vEGroup['manager4_2']?></span></td>
                                                    <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_3" name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_3]" value="<?=$vEGroup['manager4_3']?>"><span style="display: none;"><?=$vEGroup['manager4_3']?></span></td>
                                                <?endif;?>
                                                <td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <input class="w100"  name="manager_group[<?=$vEGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_4]" value="<?=$vEGroup['tahlil4_4']?>"><span style="display: none;"><?=$vEGroup['tahlil4_4']?></span>
                                                    <? else:?>
                                                        <?=$vEGroup['tahlil4_4']?>
                                                    <? endif; ?>
                                                </td>
                                            </tr>
                                        <? endforeach;?>
                                    <? endforeach;?>



                                    <? foreach ($vEghdam['faaliat'] as $faaliat_id => $vFaaliat):?>
                                        <tr class="tr-faaliat eghdam-<?=$vEghdam['eghdam_id']?>">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="word-wrap" style="width:150px !important; display: inline-block"><div><?=$vFaaliat['faaliat']?>
                                                    <a class="show-more-admin " data-level="faaliat" data-faaliat_no="<?=$vFaaliat['faaliat_id']?>" href="#">▼ واحد</a>
                                                </div></td>
                                            <td></td>
                                            <td><!--B1'---><?=substr($vFaaliat['darsad_elami_faaliat1'],0,5)?></td>
                                            <td></td>
                                            <td><!--B1---><?=substr($vFaaliat['darsad_tadili_faaliat1'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B2'---><?=substr($vFaaliat['darsad_elami_faaliat2'],0,5)?></td>
                                            <td></td>
                                            <td><!--B2---><?=substr($vFaaliat['darsad_tadili_faaliat2'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B3'---><?=substr($vFaaliat['darsad_elami_faaliat3'],0,5)?></td>
                                            <td></td>
                                            <td><!--B3---><?=substr($vFaaliat['darsad_tadili_faaliat3'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>
                                            <td><!--B4'---><?=substr($vFaaliat['darsad_elami_faaliat4'],0,5)?></td>
                                            <td></td>
                                            <td><!--B4---><?=substr($vFaaliat['darsad_tadili_faaliat4'],0,5)?></td>
                                            <? if($admin_info['parent_id']==0):?>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            <?endif;?>
                                            <td></td>

                                        </tr>
                                        <? foreach ($vFaaliat['admins'] as $id => $vFAdmins):?>
                                            <tr style="background-color: rgb(212,247,255) !important;" class="tr-faaliat-admins faaliat-admin-<?=$vFaaliat['faaliat_id']?>">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="word-wrap"><div><!--تجمیع--> <?=$vFAdmins['name'].' '.$vFAdmins['family']?><a class="show-more-group-faaliat show-more-admin-<?=$vFaaliat['faaliat_id']?> a-show-group-eghdam-<?=$eghdam_id?> a-show-group-amaliati-<?=$amaliati_no?> a-show-group-kalan-<?=$kalan_no?> " data-admin_id="<?=$vFAdmins['admin_id']?>-<?=$vFaaliat['faaliat_id']?>"  href="#">▼ </a>(fv:<?=$vFAdmins['faaliat_vazn']?>)</div></td>
                                                <td>Z-<?=substr($vFAdmins['vazn_tadili_faaliat'],0,5)?></td>
                                                <td><!--A1'---><?=substr($vFAdmins['admin_percent1'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file1']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season1/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file1']*/?>">دانلود فایل</a>
                                                <?/* endif;*/?></td>-->
                                                <td></td>
                                                <td><!--A1---><?=substr($vFAdmins['darsad_tadili_faaliat1'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_1"  name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_1]" value="<?/*=$vFAdmins['manager1_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_2]" value="<?/*=$vFAdmins['manager1_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_1_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][1_3]" value="<?/*=$vFAdmins['manager1_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager1_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>

                                                <td><!--A2'---><?=substr($vFAdmins['admin_percent2'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file2']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season2/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file2']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A2---><?=substr($vFAdmins['darsad_tadili_faaliat2'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_1]" value="<?/*=$vFAdmins['manager2_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_2]" value="<?/*=$vFAdmins['manager2_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_2_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][2_3]" value="<?/*=$vFAdmins['manager2_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager2_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                                <td><!--A3'---><?=substr($vFAdmins['admin_percent3'],0,5)?>
                                                    <?/* if($vFAdmins['admin_file3']):*/?><!--
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season3/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file3']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A3---><?=substr($vFAdmins['darsad_tadili_faaliat3'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_1]" value="<?/*=$vFAdmins['manager3_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_2]" value="<?/*=$vFAdmins['manager3_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_3_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][3_3]" value="<?/*=$vFAdmins['manager3_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager3_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                                <td><!--A4'---><?=substr($vFAdmins['admin_percent4'],0,5)?>
                                                    <!-- <?/* if($vFAdmins['admin_file4']):*/?>
                                                    <br>
                                                    <a href="<?/*=RELA_DIR*/?>statics/files/<?/*=$vFAdmins['admin_id']*/?>/season4/<?/*=$vFaaliat['faaliat_id']*/?>/<?/*=$vFAdmins['admin_file4']*/?>">دانلود فایل</a>
                                                --><?/* endif;*/?>
                                                </td>
                                                <td></td>

                                                <td><!--A4---><?=substr($vFAdmins['darsad_tadili_faaliat4'],0,5)?></td>
                                                <? if($admin_info['parent_id']==0):?>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_1" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_1]" value="<?/*=$vFAdmins['manager4_1']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_1']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_2" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_2]" value="<?/*=$vFAdmins['manager4_2']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_2']*/?></span>--></td>
                                                    <td><!--<input class="w100" data-input="manager_faaliat_<?/*=$eghdam_id*/?>_<?/*=$vFAdmins['admin_id']*/?>_4_3" name="manager_faaliat[<?/*=$vFAdmins['admin_id']*/?>][<?/*=$vFaaliat['faaliat_id']*/?>][4_3]" value="<?/*=$vFAdmins['manager4_3']*/?>"><span style="display: none;"><?/*=$vFAdmins['manager4_3']*/?></span>--></td>
                                                <?endif;?>
                                                <td></td>
                                            </tr>
                                            <? foreach ($vFAdmins['group'] as $id => $vFGroup):?>
                                                <tr style="background-color: rgb(212,247,255) !important;" class="tr-admins-group admins-group-<?=$vFGroup['parent_id']?>-<?=$vFGroup['faaliat_id']?> faaliat-no-group-<?=$vFGroup['faaliat_id']?> eghdam-no-group-<?=$eghdam_id?> amaliati-no-group-<?=$amaliati_no?> kalan-no-group-<?=$kalan_no?> " >
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="word-wrap">|--- <?=$vFGroup['name'].' '.$vFGroup['family']?>
                                                    </td>
                                                    <td></td>
                                                    <td>O1'-<?=substr($vFGroup['admin_percent1'],0,5)?>
                                                        <? if($vFGroup['admin_file1']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season1/<?=$vEghdam['eghdam_id']?>/<?=$vFGroup['admin_file1']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat1']?></td>

                                                    <td>O1 -<?=substr($vFGroup['darsad_tadili_group1'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_1]" value="<?=$vFGroup['manager1_1']?>"><span style="display: none;"><?=$vFGroup['manager1_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_2]" value="<?=$vFGroup['manager1_2']?>"><span style="display: none;"><?=$vFGroup['manager1_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_1_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_3]" value="<?=$vFGroup['manager1_3']?>"><span style="display: none;"><?=$vFGroup['manager1_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][1_4]" value="<?=$vFGroup['tahlil1_4']?>"><span style="display: none;"><?=$vFGroup['tahlil1_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil1_4']?>
                                                        <? endif; ?>
                                                    </td>

                                                    <td><!--O2'---><?=substr($vFGroup['admin_percent2'],0,5)?>
                                                        <? if($vFGroup['admin_file2']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season2/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file2']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat2']?></td>

                                                    <td><!--O2---><?=substr($vFGroup['darsad_tadili_group2'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_1]" value="<?=$vFGroup['manager2_1']?>"><span style="display: none;"><?=$vFGroup['manager2_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_2]" value="<?=$vFGroup['manager2_2']?>"><span style="display: none;"><?=$vFGroup['manager2_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_2_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_3]" value="<?=$vFGroup['manager2_3']?>"><span style="display: none;"><?=$vFGroup['manager2_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][2_4]" value="<?=$vFGroup['tahlil2_4']?>"><span style="display: none;"><?=$vFGroup['tahlil2_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil2_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                    <td><!--O3'---><?=substr($vFGroup['admin_percent3'],0,5)?>
                                                        <? if($vFGroup['admin_file3']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season3/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file3']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat3']?></td>

                                                    <td><!--O3---><?=substr($vFGroup['darsad_tadili_group3'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_1]" value="<?=$vFGroup['manager3_1']?>"><span style="display: none;"><?=$vFGroup['manager3_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_2]" value="<?=$vFGroup['manager3_2']?>"><span style="display: none;"><?=$vFGroup['manager3_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_3_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_3]" value="<?=$vFGroup['manager3_3']?>"><span style="display: none;"><?=$vFGroup['manager3_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][3_4]" value="<?=$vFGroup['tahlil3_4']?>"><span style="display: none;"><?=$vFGroup['tahlil3_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil3_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                    <td><!--O4'---><?=substr($vFGroup['admin_percent4'],0,5)?>
                                                        <? if($vFGroup['admin_file4']):?>
                                                            <br>
                                                            <a href="<?=RELA_DIR?>statics/files/<?=$vFGroup['admin_id']?>/season4/<?=$vFaaliat['faaliat_id']?>/<?=$vFGroup['admin_file4']?>">دانلود فایل</a>
                                                        <? endif;?>
                                                    </td>
                                                    <td><?=$vFGroup['admin_tozihat4']?></td>
                                                    <td><!--O4---><?=substr($vFGroup['darsad_tadili_group4'],0,5)?></td>
                                                    <? if($admin_info['parent_id']==0):?>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_1" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_1]" value="<?=$vFGroup['manager4_1']?>"><span style="display: none;"><?=$vFGroup['manager4_1']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_2" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_2]" value="<?=$vFGroup['manager4_2']?>"><span style="display: none;"><?=$vFGroup['manager4_2']?></span></td>
                                                        <td><input class="w100" data-input="manager_faaliat_<?=$eghdam_id?>_<?=$vFAdmins['admin_id']?>_4_3" name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_3]" value="<?=$vFGroup['manager4_3']?>"><span style="display: none;"><?=$vFGroup['manager4_3']?></span></td>
                                                    <?endif;?>
                                                    <td>
                                                        <? if($admin_info['parent_id']==0):?>
                                                            <input class="w100"  name="manager_group[<?=$vFGroup['admin_id']?>][<?=$vFaaliat['faaliat_id']?>][4_4]" value="<?=$vFGroup['tahlil4_4']?>"><span style="display: none;"><?=$vFGroup['tahlil4_4']?></span>
                                                        <? else:?>
                                                            <?=$vFGroup['tahlil4_4']?>
                                                        <? endif; ?>
                                                    </td>
                                                </tr>
                                            <? endforeach;?>
                                        <? endforeach;?>
                                    <? endforeach;?>
                                <? endforeach;?>
                            <? endforeach;?>
                        <? endforeach;?>
                        </tbody>

                    </table>
                    <? if(($admin_info['status'] == 0 || $admin_info['status'] == 1) && $admin_info['parent_id']==0 ): ?>
                        <button name="submit" class="btn btn-block btn-primary fixed">ثبت موقت</button>
                    <? endif;?>

                    <? if((($admin_info['status'] == 0 || $admin_info['status'] == 1) && $admin_info['parent_id']==0 )&& $admin_info['name']=="مرکز"): ?>
                        <button name="submit2" class="btn btn-block btn-info">ثبت نهایی</button>
                    <? endif;?>

                </form>
            </div>
        </div>
        <div class="panel-footer clearfix"></div>
    </div>
</div>

<!--<p>
    <input type="submit" class="btn btn-info btn-white" name="submit" id="submit" value="ثبت" />
</p>-->
<!--/content-body -->

