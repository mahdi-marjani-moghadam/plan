<!--suppress ALL -->
<style>
    @media print {
        table {
            direction: rtl
        }
    }
</style>
<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#level').change(function() {
            var season = $(this).val();

            location.href = window.location.origin + '/admin/?component=reports&s=' + season <?php echo  (isset($_GET['qq'])) ? "+'&qq=" . $_GET['qq'] . "'" : ''; ?>;
        });


        $('#tbl3 tbody tr').click(function() {
            //var head = $(this).closest('table').find('thead').clone();
            //$('.panel-body').append(head);
        });

        // Code goes here
        'use strict'
        window.onload = function() {
            var tableCont1 = document.querySelector('.table-cont1');
            var tableCont2 = document.querySelector('.table-cont2');
            var tableCont3 = document.querySelector('.table-cont3');
            /**
             * scroll handle
             * @param {event} e -- scroll event
             */
            function scrollHandle(e) {
                var scrollTop = this.scrollTop;
                //console.log(scrollTop);
                this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
            }

            tableCont1.addEventListener('scroll', scrollHandle)
            tableCont2.addEventListener('scroll', scrollHandle)
            tableCont3.addEventListener('scroll', scrollHandle)
        }

        /** change admin event */
        $('#admin').change(function() {

            var adminId = ',' + $(this).val() + ',';
            if ($(this).val() == 0) {
                location.href = window.location.origin + '/admin/?component=reports'
                <?php echo  (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>;
            } else {
                location.href = window.location.origin + '/admin/?component=reports&qq=' + adminId <?php echo  (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>;
            }
        });
    });
</script>

<style>
    .table-cont1,
    .table-cont2,
    .table-cont3 {
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
            <select name="season" id="level">
                <option value="STEP_FORM1" <?php echo  ($_GET['s'] == 'STEP_FORM1') ? 'selected' : ''; ?>>سه ماهه</option>
                <option value="STEP_FORM2" <?php echo  ($_GET['s'] == 'STEP_FORM2') ? 'selected' : ''; ?>>شش ماهه</option>
                <option value="STEP_FORM3" <?php echo  ($_GET['s'] == 'STEP_FORM3') ? 'selected' : ''; ?>>نه ماهه</option>
                <option value="STEP_FORM4" <?php echo  ($_GET['s'] == 'STEP_FORM4') ? 'selected' : ''; ?>>یکساله</option>
            </select>
        </div>
        <?php if ($admin_info['parent_id'] == 0) : ?>
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label for="result">واحد :</label>
                <select id="admin" multiple>
                    <option value="0">انتخاب کنید</option>
                    <?php foreach ($list['showAdmin'] as $k => $admins) : ?>
                        <option <?php if (strpos($_GET['qq'], ',' . $admins['admin_id'] . ',') !== false) {
                                    echo 'selected';
                                } ?> value="<?php echo  $admins['admin_id'] ?>">
                            <?php echo  $admins['name'] . ' ' . $admins['family'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="col-md-1 col-xs-12  pull-left">
            <input type='button' class="btn btn-default btn-block pull-left" style="" id='btn' value='Print' onclick='printDiv();'>
            <style>
                @media print {
                    table {
                        direction: rtl;
                        float: right;
                    }

                    td {
                        float: right;
                    }
                }
            </style>
            <script>
                function printDiv() {

                    //$('.yesPrint').show();

                    var divToPrint = document.getElementById('table1');
                    var tahlilKalan = document.getElementById('tahlil-kalan');
                    var divToPrint2 = document.getElementById('table2');
                    var divToPrint3 = document.getElementById('table3');

                    var newWin = window.open('', 'Print-Window');

                    newWin.document.open();

                    newWin.document.write('<html><body dir="rtl"  onload="window.print()"><style>td{font-family: Tahoma; font-size: 11px; padding: 5px}  table tr:nth-child(even){background: #f4f4f4}</style>' + divToPrint.innerHTML + tahlilKalan.innerHTML + divToPrint2.innerHTML + divToPrint3.innerHTML + '</body></html>');

                    newWin.document.close();

                    setTimeout(function() {
                        newWin.close();
                    }, 10);

                }
            </script>
        </div>

        <div class="col-md-10 col-sm-12 col-sx-12">
            <?php
            $msg = $messageStack->output('message');
            if ($msg != '') :
                echo $msg;
            endif;
            ?>
            <?php foreach ($child as $v) : ?>
                <?php if ($v['finish_date'] >= date('Y-m-d')) : ?>
                    <div class="col-md-2 col-xs-12 col-sm-12 ">

                        <div class="col-md-12 confirm-vahed ">
                            <div class="col-md-12" style="height: 50px">
                                <label for=""><?php echo  $v['name'] . ' ' . $v['family'] ?></label>
                            </div>
                            <div class="col-md-12">
                                <a href="<?php echo  RELA_DIR ?>admin/?component=reports&action=confirm&id=<?php echo  $v['admin_id'] ?>&s=1" class="btn btn-primary btn-block">تایید</a>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=reports&action=confirm&id=<?php echo  $v['admin_id'] ?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                            </div>
                            <?/* if($admin_info['status'] == 2):*/ ?>
                            <!--
                                <div class="alert alert-success">
                                    <strong >zzzzzz </strong>
                                </div>
                            --><?/* endif;*/ ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
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
            <div id="container">


                <div class='table-cont1' id="table1">

                    <table class="table  table-bordered ">
                        <thead>
                            <tr style="text-align: center">

                                <td width="20%" style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                                <td style="background-color: #45639b; color:#fff; " colspan="<?php echo  count($groups) ?>">خود اظهاری</td>
                                <td style="background-color: #654c97; color:#fff; " colspan="<?php echo  count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $kalan_no => $kalan_value) : ?>
                                <tr>
                                    <td><?php echo  $kalan_value['kalan_name'] ?></td>
                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td><?php
                                            if ($head_admin_info['parent_id'] == 1) {
                                                /** tajmi */
                                                echo substr($kalan_value['admins'][$head_admin_id]['GG' . $season], 0, 5);
                                            } else {
                                                /**  */
                                                echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['QQ' . $season], 0, 5);
                                            }
                                            ?></td>
                                    <?php endforeach; ?>
                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td><?php
                                            if ($head_admin_info['parent_id'] == 1) {
                                                /** tajmi */
                                                echo substr($kalan_value['admins'][$head_admin_id]['G' . $season], 0, 5);
                                            } else {
                                                /**  */
                                                echo substr($kalan_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['Q' . $season], 0, 5);
                                            }
                                            ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <style media="print">
                        .noPrint {
                            display: none;
                        }

                        .yesPrint {
                            display: block !important;
                        }
                    </style>

                    <style type="text/css">
                        @media print {
                            .noPrint {
                                display: none;
                            }

                            .yesPrint {
                                display: block !important;
                            }
                        }

                        .panel-group .panel {
                            border-radius: 0;
                            box-shadow: none;
                            border-color: #EEEEEE;
                        }

                        .panel-group .panel-default>.panel-heading {
                            padding: 0;
                            border-radius: 0;
                            color: #212121;
                            background-color: #FAFAFA;
                            border-color: #EEEEEE;
                        }

                        .panel-group .panel-title {
                            font-size: 14px;
                        }

                        .panel-group .panel-title>a {
                            display: block;
                            padding: 15px;
                            text-decoration: none;
                        }

                        .panel-group .more-less {
                            float: right;
                            color: #212121;
                        }

                        .panel-default>.panel-heading+.panel-collapse>.panel-body {
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

                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs " role="tablist">
                            <?php foreach ($groups as $head_admin_id => $head_admin_info) : if ($head_admin_info['parent_id'] == 1  || $head_admin_info['status' . $season]  != 7) {
                                    continue;
                                } ?>
                                <li role="presentation" class="pull-right"><a href="#home<?php echo  $head_admin_id ?>" aria-controls="home<?php echo  $head_admin_id ?>" role="tab" data-toggle="tab">
                                        <?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?>
                                    </a></li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content" id="tahlil-kalan">

                            <?php foreach ($groups as $head_admin_id => $head_admin_info) :

                                if ($head_admin_info['parent_id'] == 1 || $head_admin_info['status' . $season]  != 7) {
                                    continue;
                                } ?>
                                <?/* if ($vKGroup['group_status'] == 6):*/ ?>

                                <div role="tabpanel" class="tab-pane fade" id="home<?php echo  $head_admin_id ?>">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <?php foreach ($reports as $kalan_no => $kalan_value) : ?>
                                            <?php if (isset($kalanTahlilArray[$head_admin_id][$kalan_no])) : ?>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading" role="tab" id="headingOne<?php echo  $head_admin_id . $kalan_no ?>">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo  $head_admin_id . $kalan_no ?>" aria-expanded="true" aria-controls="collapseOne<?php echo  $head_admin_id . $kalan_no ?>">
                                                                <?php if ($kalanTahlilArray[$head_admin_id][$kalan_no] != '') : ?>
                                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                                <?php endif; ?>
                                                                <span class="yesPrint" style="display: "> <?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?> | </span>
                                                                <?php echo  ' ' . $kalan_value['kalan_name'] ?>
                                                            </a>
                                                        </h4>
                                                    </div>

                                                    <div id="collapseOne<?php echo  $head_admin_id . $kalan_no ?>" class="panel-collapse collapse " style="padding: 15px" role="tabpanel" aria-labelledby="headingOne<?php echo  $head_admin_id . $kalan_no ?>">

                                                        <?php echo  nl2br($kalanTahlilArray[$head_admin_id][$kalan_no]) ?>
                                                    </div>

                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div><!-- panel-group -->
                                </div>
                                <?/* endif; */ ?>

                            <?php endforeach; ?>

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
            <div id="container">
                <div class='table-cont2' id="table2">
                    <table class="table  table-bordered ">
                        <thead>
                            <tr style="text-align: center">

                                <td style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                                <td width="300" style="background-color: #5f9846; color:#fff; " rowspan="2">اقدام</td>

                                <td style="background-color: #45639b; color:#fff; " colspan="<?php echo  count($groups) ?>">اعلامی</td>
                                <td style="background-color: #654c97; color:#fff; " colspan="<?php echo  count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $kalan_no => $kalan_value) : ?>
                                <?php foreach ($kalan_value['amaliatis'] as $amaliati_no => $amaliati_value) : ?>
                                    <?php foreach ($amaliati_value['eghdams'] as $eghdam_id => $eghdam_value) : ?>
                                        <tr>
                                            <td class="text-center"><?php echo  $kalan_no ?></td>
                                            <td><?php echo  $eghdam_value['eghdam_name'] ?></td>
                                            <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                                <td><?php
                                                    if ($head_admin_info['parent_id'] == 1) {
                                                        /** tajmi */
                                                        echo substr($eghdam_value['admins'][$head_admin_id]['CC' . $season], 0, 5);
                                                    } else {
                                                        /**  */
                                                        echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['RR' . $season], 0, 5);
                                                    }
                                                    ?></td>
                                            <?php endforeach; ?>
                                            <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                                <td><?php
                                                    if ($head_admin_info['parent_id'] == 1) {
                                                        /** tajmi */
                                                        echo substr($eghdam_value['admins'][$head_admin_id]['C' . $season], 0, 5);
                                                    } else {
                                                        /**  */
                                                        echo substr($eghdam_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['R' . $season], 0, 5);
                                                    }
                                                    ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>


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
            <div id="container">
                <div class='table-cont3' id="table3">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center">

                                <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                                <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">اقدام</td>
                                <td width="300" style="background-color: #5f9846; color:#fff; " rowspan="2">فعالیت</td>

                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?php echo  count($groups) ?>">خوداظهاری</td>
                                <td width="300" style="background-color: #654c97; color:#fff; " colspan="<?php echo  count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?php echo  300 / count($groups) ?>"><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?php echo  300 / count($groups) ?>"><?php echo  $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reports as $kalan_no => $kalan_value) : ?>
                                <?php foreach ($kalan_value['amaliatis'] as $amaliati_no => $amaliati_value) : ?>
                                    <?php foreach ($amaliati_value['eghdams'] as $eghdam_id => $eghdam_value) : ?>
                                        <?php foreach ($eghdam_value['faaliats'] as $faaliat_id => $faaliat_value) : ?>
                                            <tr>
                                                <td width="50" class="text-center"><?php echo  $kalan_no ?></td>
                                                <td width="50"><?php echo  $eghdam_id ?></td>
                                                <td width="300"><?php echo  $faaliat_value['faaliat_name'] ?></td>
                                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                                    <td width="<?php echo  300 / count($groups) ?>"><?php

                                                                                        if ($head_admin_info['parent_id'] == 1) {
                                                                                            /** tajmi */
                                                                                            echo substr($faaliat_value['admins'][$head_admin_id]['AA' . $season], 0, 5);
                                                                                        } else {
                                                                                            /**  */
                                                                                            echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['OO' . $season], 0, 5);
                                                                                        }
                                                                                        ?></td>
                                                <?php endforeach; ?>
                                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                                    <td width="<?php echo  300 / count($groups) ?>"><?php
                                                                                        if ($head_admin_info['parent_id'] == 1) {
                                                                                            /** tajmi */
                                                                                            echo substr($faaliat_value['admins'][$head_admin_id]['A' . $season], 0, 5);
                                                                                        } else {
                                                                                            /**  */
                                                                                            echo substr($faaliat_value['admins'][$head_admin_info['parent_id']]['groups'][$head_admin_id]['O' . $season], 0, 5);
                                                                                        }
                                                                                        ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer clearfix"></div>
</div>
</div>