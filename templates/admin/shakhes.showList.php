<!--suppress ALL -->
<style>
    @media print {
        table {
            direction: rtl
        }
    }
    .head{
        background-color: #fff;
    }
    thead{
        position: relative;
        z-index: 9  ;
    }
</style>
<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/buttons.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#level').change(function() {
            var season = $(this).val();

            location.href = window.location.origin + '/admin/?component=shakhes&s=' + season <?php echo (isset($_GET['qq'])) ? "+'&qq=" . $_GET['qq'] . "'" : ''; ?> <?php echo (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
        });

        $('#year').change(function() {
            var year = $(this).val();

            location.href = window.location.origin + '/admin/?component=shakhes&y=' + year <?php echo (isset($_GET['qq'])) ? "+'&qq=" . $_GET['qq'] . "'" : ''; ?> <?php echo (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>;
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

            function scrollHandle(e) {
                var scrollTop = this.scrollTop;
                this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';

                var scrollLeft = this.scrollLeft;
                var allTd = this.querySelectorAll('.head');
                allTd.forEach(function(userItem) {
                    userItem.style.transform = 'translateX(' + scrollLeft + 'px)';
                });
                



            }

            tableCont1.addEventListener('scroll', scrollHandle)
            tableCont2.addEventListener('scroll', scrollHandle)
            tableCont3.addEventListener('scroll', scrollHandle)





        }

        /** change admin event */
        $('#admin').change(function() {

            var adminId = ',' + $(this).val() + ',';
            if ($(this).val() == 0 || $(this).val() == null) {
                location.href = window.location.origin + '/admin/?component=shakhes'
                <?php echo (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>
                <?php echo (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
            } else {
                location.href = window.location.origin + '/admin/?component=shakhes&qq=' + adminId <?php echo (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?> <?php echo (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
            }
        });
    });
</script>

<style>
    .table-cont1,
    .table-cont2,
    .table-cont3 {
        max-height: 500px;
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

        <div class="col-md-2 col-sm-4 col-xs-4">
            <label for="level">دوره ارزیابی:</label>
            <select name="season" id="level">
                <option value="6" <?php echo ($_GET['s'] == '6') ? 'selected' : ''; ?>>شش ماهه</option>
                <option value="12" <?php echo ($_GET['s'] == '12') ? 'selected' : ''; ?>>یکساله</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-4">
            <label style="width: 100%;" for="result">واحد :</label>

            <select id="admin" multiple>
                <option value="0">انتخاب کنید</option>
                <?php foreach ($list['showAdmin'] as $k => $admins) : ?>
                    <option <?php if (strpos($_GET['qq'], ',' . $admins['admin_id'] . ',') !== false) {
                                echo 'selected';
                            } ?> value="<?php echo $admins['admin_id'] ?>">
                        <?php echo $admins['name'] . ' ' . $admins['family'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-4">
            <label for="level">سال :</label>
            <select name="season" id="year">
                <option value="1398-1399" <?php echo ($_GET['y'] == '1398-1399') ? 'selected' : ''; ?>>۱۳۹۸-۱۳۹۹</option>
                <option value="1399-1400" <?php echo ($_GET['y'] == '1399-1400') ? 'selected' : ''; ?>>۱۳۹۹-۱۴۰۰</option>
                <option value="1400-1401" <?php echo ($_GET['y'] == '1400-1401') ? 'selected' : ''; ?>>۱۴۰۰-۱۴۰۱</option>
                <option value="1401-1402" <?php echo ($_GET['y'] == '1401-1402') ? 'selected' : ''; ?>>1401-1402</option>
            </select>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-1  pull-left">
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


        </div>
    </div>











    <div class="row xsmallSpace"></div>
    <div id="panel-2" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl ">مقایسه عملکرد واحد در سطح کلان</h3>
            <div class="panel-actions">
                <button data-expand="#panel-2" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-2" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div id="container">
                <div class='table-cont1' id="table2">
                    <table class="table  table-bordered ">
                        <thead>
                            <tr style="text-align: center">
                                <td style="background-color: #5f9846; color:#fff; " rowspan="2">هدف</td>
                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?php echo count($groups) ?>">خوداظهاری</td>
                                <td style="background-color: #654c97; color:#fff; " colspan="<?php echo count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kalans as $kalan_no => $kalan) : ?>
                                <tr style=" text-align: center">
                                    <td class="head"><?php echo $kalan_no ?></td>

                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td dir="ltr" <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ebebeb"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#ccc"' : '' ?>>
                                            <?php echo floor($kalan[$head_admin_id]['darsad']['value_import'] * 100) / 100 ?>
                                        </td>
                                    <?php endforeach; ?>
                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td dir="ltr" <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ebebeb"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#ccc"' : '' ?>>
                                            <?php echo floor($kalan[$head_admin_id]['darsad']['value'] * 100) / 100 ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>




            <?php
            $msg = $messageStack->output('messageShakhesReportStore');
            if ($msg != '') :
                echo $msg;
            endif;
            if ($admin_info['admin_id'] == 1) :
            ?>

                <form action="/admin/" method="GET">
                    <input type="hidden" name="component" value="shakhes">
                    <input type="hidden" name="updateShakhesReport" value="">
                    <select name="y">
                        <option value="1398-1399">1398-1399</option>
                        <option value="1399-1400">1399-1400</option>
                        <option value="1400-1401">1400-1401</option>
                    </select>

                    <button class="btn btn-info">به روز رسانی جدول گزارش</button>
                </form>
            <?php
            endif;
            ?>
        </div>
    </div>























    <div class="row xsmallSpace"></div>
    <div id="panel-2" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl ">مقایسه عملکرد واحد در سطح شاخص</h3>
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
                                <td width="300" style="background-color: #5f9846; color:#fff; " rowspan="2">شاخص</td>

                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?php echo count($groups) ?>">خوداظهاری</td>
                                <td style="background-color: #654c97; color:#fff; " colspan="<?php echo count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($shakhesNext as $shakhes_id => $sh) : ?>
                                <tr>
                                    <td class="text-center head"><?php echo $sh['kalan_no'] ?></td>
                                    <td class="head"><?php echo $sh['shakhes'] ?></td>
                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ccc"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#999"' : '' ?>>
                                            <table class="fixed">
                                                <tr class="green">
                                                    <td colspan="2"> عملکرد سال</td>
                                                </tr>
                                                <tr class="green">
                                                    <td>پايه</td>
                                                    <td>آخر</td>
                                                </tr>
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['amalkardPrev']['value_import'] * 100) / 100  ?></td>
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['amalkardNext']['value_import'] * 100) / 100 ?></td>
                                                </tr>
                                                <tr class="green">
                                                    <td>نرخ رشد</td>
                                                    <td>درصد تحقق</td>
                                                </tr>
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo ($reports[$shakhes_id][$head_admin_id]['nerkh']['value_import'] != null)?floor($reports[$shakhes_id][$head_admin_id]['nerkh']['value_import'] * 100) / 100 : 'ناموجود'; ?> </td>
                                                    <td style="direction: ltr;"><?php echo ($reports[$shakhes_id][$head_admin_id]['darsad']['value_import'] != null)?floor($reports[$shakhes_id][$head_admin_id]['darsad']['value_import'] * 100) / 100 : 'ناموجود'; ?></td>
                                                </tr>



                                            </table>
                                        </td>
                                    <?php endforeach; ?>
                                    <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ccc"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#999"' : '' ?>>
                                            <table class="fixed">
                                                <tr class="green">
                                                    <td colspan="2"> عملکرد سال</td>
                                                </tr>
                                                <tr class="green">
                                                    <td>پايه</td>
                                                    <td>آخر</td>
                                                </tr>
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['amalkardPrev']['value'] * 100) / 100  ?></td>
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['amalkardNext']['value'] * 100) / 100 ?></td>
                                                </tr>
                                                <tr class="green">
                                                    <td>نرخ رشد</td>
                                                    <td>درصد تحقق</td>
                                                </tr>
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['nerkh']['value'] * 100) / 100 ?> </td>
                                                    <td style="direction: ltr;"><?php echo floor($reports[$shakhes_id][$head_admin_id]['darsad']['value'] * 100) / 100 ?></td>
                                                </tr>



                                            </table>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
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
            <h3 class="panel-title rtl">مقایسه عملکرد واحد در سطح اقلام</h3>
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
                                <td style="background-color: #5f9846;" rowspan="2"></td>
                                <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">شاخص</td>
                                <td width="50" style="background-color: #5f9846; color:#fff; " rowspan="2">قلم</td>

                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?php echo count($groups) ?>">خوداظهاری</td>
                                <td width="300" style="background-color: #654c97; color:#fff; " colspan="<?php echo count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">

                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?php echo 300 / count($groups) ?>"><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                                <?php foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?php echo 300 / count($groups) ?>"><?php echo $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = $amalkardPrevUniElami = $amalkardNextUniElami = 0;
                            foreach ($ghalamsNext as $ghalam_id => $gh) : ?>
                                <?php $i++; ?>
                                <tr>
                                    <td class="head"><?php echo $i ?></td>
                                    <td width="50" class="text-center head"><?php echo $shakhes_id ?></td>
                                    <td class="head" width="50"><?php echo $gh['ghalam'] ?>
                                        <?php echo $gh['ghalam_id'] ?>

                                    </td>
                                    <?php
                                    $amalkardPrevVahed = $amalkardNextVahed = 0;
                                    foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <?php
                                        $amalkardPrev = $ghalamsPrev[$ghalam_id]['admins'][$head_admin_id]['value_import'] ?? 0;
                                        $amalkardNext = $gh['admins'][$head_admin_id]['value_import'] ?? 0;

                                        $amalkardPrevUniElami = $ghalamsPrev[$ghalam_id]['admins'][100]['value_import'] ?? 0;
                                        $amalkardNextUniElami = $gh['admins'][100]['value_import'] ?? 0;
                                        // echo $head_admin_info['parent_id'].'<br>';
                                        // dd($head_admin_id);
                                        $amalkardPrevVahed += $amalkardPrev;
                                        $amalkardNextVahed += $amalkardNext;

                                        // $amalkardPrevUniElami += $amalkardPrev;
                                        // $amalkardNextUniElami += $amalkardNext;

                                        ?>
                                        <td width="<?php echo 300 / count($groups) ?>" <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ebebeb"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#ccc"' : '' ?>>
                                            <table class="fixed">
                                                <tr class="green">
                                                    <td colspan="2"> عملکرد سال</td>
                                                </tr>
                                                <tr class="green">
                                                    <td>پايه</td>
                                                    <td>آخر</td>
                                                </tr>
                                                <tr class="gray">
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo ($head_admin_info['parent_id'] != 1) ? $amalkardPrev : (($head_admin_id == 100) ? $amalkardPrevUniElami : $amalkardPrevVahed)  ?></td>
                                                    <td style="direction: ltr;"><?php echo ($head_admin_info['parent_id'] != 1) ? $amalkardNext : (($head_admin_id == 100) ? $amalkardNextUniElami : $amalkardNextVahed)  ?></td>
                                                </tr>
                                            </table>

                                        </td>

                                    <?php
                                        if ($head_admin_info['parent_id'] == 1) $amalkardPrevVahed = $amalkardNextVahed = 0;
                                    endforeach; ?>

                                    <?php
                                    $amalkardPrevVahed = $amalkardNextVahed = 0;
                                    foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <?php
                                        $amalkardPrev = $ghalamsPrev[$ghalam_id]['admins'][$head_admin_id]['value'] ?? 0;
                                        $amalkardNext = $gh['admins'][$head_admin_id]['value'] ?? 0;
                                        $amalkardPrevVahed += $amalkardPrev;
                                        $amalkardNextVahed += $amalkardNext;

                                        $amalkardPrevUniNahayi = $ghalamsPrev[$ghalam_id]['admins'][100]['value'] ?? 0;
                                        $amalkardNextUniNahayi = $gh['admins'][100]['value'] ?? 0;
                                        ?>
                                        <td width="<?php echo 300 / count($groups) ?>" <?php echo ($head_admin_info['parent_id'] == 1 && $head_admin_id != 100) ? 'style="background-color:#ebebeb"' : '' ?> <?php echo ($head_admin_id == 100) ? 'style="background-color:#ccc"' : '' ?>>
                                            <table class="fixed">
                                                <tr class="green">
                                                    <td colspan="2"> عملکرد سال</td>
                                                </tr>
                                                <tr class="green">
                                                    <td> پايه</td>
                                                    <td> آخر</td>
                                                </tr>
                                                <tr class="gray">
                                                    <td style="direction: ltr;"><?php echo ($head_admin_info['parent_id'] != 1) ? $amalkardPrev : (($head_admin_id == 100) ? $amalkardPrevUniNahayi : $amalkardPrevVahed)  ?></td>
                                                    <td style="direction: ltr;"><?php echo ($head_admin_info['parent_id'] != 1) ? $amalkardNext : (($head_admin_id == 100) ? $amalkardNextUniNahayi : $amalkardNextVahed)  ?></td>
                                                </tr>

                                            </table>
                                        </td>

                                    <?php
                                        if ($head_admin_info['parent_id'] == 1) $amalkardPrevVahed = $amalkardNextVahed = 0;
                                    endforeach; ?>
                                </tr>
                            <?php
                                $amalkardPrevUniElami = $amalkardNextUniElami = $amalkardPrevUniNahayi = $amalkardNextUniNahayi = 0;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer clearfix"></div>
</div>
</div>

<style>
    .fixed {
        text-align: center;
    }

    .fixed td {
        padding: 4px;
    }

    /*table.fixed tr:nth-child(2n+1){background: #f4f4f4;}*/
    table.fixed td:first-child {
        background: none !important;
    }

    table.fixed .gray {
        background-color: #f4f4f4 !important;
        direction: ltr
    }

    table.fixed .green td {
        background-color: #d3e6d4 !important;
        color: #000 !important
    }
</style>