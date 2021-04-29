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

            location.href = window.location.origin + '/admin/?component=shakhes&s=' + season <?= (isset($_GET['qq'])) ? "+'&qq=" . $_GET['qq'] . "'" : ''; ?> <?= (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
        });

        $('#year').change(function() {
            var year = $(this).val();

            location.href = window.location.origin + '/admin/?component=shakhes&y=' + year <?= (isset($_GET['qq'])) ? "+'&qq=" . $_GET['qq'] . "'" : ''; ?> <?= (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>;
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
            if ($(this).val() == 0 || $(this).val() == null) {
                location.href = window.location.origin + '/admin/?component=shakhes'
                <?= (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?>
                <?= (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
            } else {
                location.href = window.location.origin + '/admin/?component=shakhes&qq=' + adminId <?= (isset($_GET['s'])) ? "+'&s=" . $_GET['s'] . "'" : ''; ?> <?= (isset($_GET['y'])) ? "+'&y=" . $_GET['y'] . "'" : ''; ?>;
            }
        });
    });
</script>

<style>
    .table-cont1,
    .table-cont2,
    .table-cont3 {
        /* max-height: 400px; */
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
                <option value="6" <?= ($_GET['s'] == '6') ? 'selected' : ''; ?>>شش ماهه</option>
                <option value="12" <?= ($_GET['s'] == '12') ? 'selected' : ''; ?>>یکساله</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-4">
            <label style="width: 100%;" for="result">واحد :</label>

            <select id="admin" multiple>
                <option value="0">انتخاب کنید</option>
                <? foreach ($list['showAdmin'] as $k => $admins) : ?>
                    <option <? if (strpos($_GET['qq'], ',' . $admins['admin_id'] . ',') !== false) {
                                echo 'selected';
                            } ?> value="<?= $admins['admin_id'] ?>">
                        <?= $admins['name'] . ' ' . $admins['family'] ?>
                    </option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-4">
            <label for="level">سال :</label>
            <select name="season" id="year">
                <option value="1398-1399" <?= ($_GET['y'] == '1398-1399') ? 'selected' : ''; ?>>۱۳۹۸-۱۳۹۹</option>
                <option value="1399-1400" <?= ($_GET['y'] == '1399-1400') ? 'selected' : ''; ?>>۱۳۹۹-۱۴۰۰</option>
                <option value="1400-1401" <?= ($_GET['y'] == '1400-1401') ? 'selected' : ''; ?>>۱۴۰۰-۱۴۰۱</option>
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
            <?
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

                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?= count($groups) ?>">خوداظهاری</td>
                                <td style="background-color: #654c97; color:#fff; " colspan="<?= count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">
                                <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?= $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <? endforeach; ?>
                                <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td><?= $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <? endforeach; ?>

                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($shakhesNext as $shakhes_id => $sh) : ?>
                                <tr>
                                    <td class="text-center"><?= $sh['kalan_no'] ?></td>
                                    <td><?= $sh['shakhes'] ?></td>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td style="direction: ltr;">
                                            1
                                        </td>
                                    <? endforeach; ?>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <td>
                                            A98:<?= $reports[$shakhes_id][$head_admin_id]['amalkardPrev']  ?>
                                            A99:<?= $reports[$shakhes_id][$head_admin_id]['amalkardNext'] ?>
                                            <br>
                                            <br>
                                            نرخ رشد:<?= $reports[$shakhes_id][$head_admin_id]['nerkh'] ?>
                                            <br>
                                            <br>
                                            درصد تحقق:<?= $reports[$shakhes_id][$head_admin_id]['roshd'] ?>
                                            
                                        </td>
                                    <? endforeach; ?>
                                </tr>
                            <? endforeach; ?>


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

                                <td width="300" style="background-color: #45639b; color:#fff; " colspan="<?= count($groups) ?>">خوداظهاری</td>
                                <td width="300" style="background-color: #654c97; color:#fff; " colspan="<?= count($groups) ?>">نهایی(تائیدشده)</td>
                            </tr>
                            <tr style="text-align: center">

                                <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?= 300 / count($groups) ?>"><?= $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <? endforeach; ?>
                                <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                    <td width="<?= 300 / count($groups) ?>"><?= $head_admin_info['name'] . ' ' . $head_admin_info['family'] ?></td>
                                <? endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            $i = 0;
                            foreach ($ghalamsNext as $ghalam_id => $gh) : ?>
                                <? $i++; ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td width="50" class="text-center"><?= $shakhes_id ?></td>
                                    <td width="50"><?= $gh['ghalam'] ?>
                                        <?= $gh['ghalam_id'] ?>

                                    </td>
                                    <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <?

                                        $amalkardPrev = $ghalamsPrev[$ghalam_id]['admins'][$head_admin_id]['value_import'] ;
                                        $amalkardNext = $gh['admins'][$head_admin_id]['value_import'] ;

                                        ?>
                                        <td style="direction: ltr;" width="<?= 300 / count($groups) ?>">

                                            A98:<?= $amalkardPrev  ?>
                                            A99:<?= $amalkardNext ?>
                                            <br>
                                            N:<?= (($amalkardNext / $amalkardPrev) - 1) * 100 ?>

                                        </td>
                                    <? endforeach; ?>

                                    <? foreach ($groups as $head_admin_id => $head_admin_info) : ?>
                                        <?
                                        $amalkardPrev = $ghalamsPrev[$ghalam_id]['admins'][$head_admin_id]['value'] ;
                                        $amalkardNext = $gh['admins'][$head_admin_id]['value'] ;
                                        ?>
                                        <td width="<?= 300 / count($groups) ?>">

                                            A98:<?= $amalkardPrev  ?>
                                            A99:<?= $amalkardNext ?>
                                            <br>
                                            <br>
                                            N:<?= (($amalkardNext / $amalkardPrev) - 1) * 100 ?>

                                        </td>
                                    <? endforeach; ?>
                                </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer clearfix"></div>
</div>
</div>