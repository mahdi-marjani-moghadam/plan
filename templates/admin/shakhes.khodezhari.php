<div class="row smallSpace"></div>

<div class="content-body">
    <!-- separator -->

    <div id="panel-1" class="panel panel-default border-green">

        <div class="panel-body">
            <div class="alert alert-danger">توجه: در خصوص تکمیل فرم‌های ارزیابی ضروری است واحدها نسبت به تکمیل فرمهای
                مربوطه طبق تفکیک ذکر شده در زیر دکمه هر فرم اقدام نمایند. لازم به ذکر است در صورت عدم تکمیل فرم‌ها،
                امتیاز مربوط به فعالیتهای مربوطه کسر خواهد شد. از آنجا که اطلاعات مستخرج از فرمها در شاخصهای عملکرد
                واحدها نیز لحاظ می‌شود در صورت عدم تکمیل آنها، امتیازی به شاخص‌های مربوطه تعلق نمی‌گیرد.</div>
            <div class="alert alert-warning"> بازه تکمیل فرم ها از تاریخ <?php echo convertDate($this->time['start_date']) ?>
                تا تاریخ <?php echo convertDate($this->time['finish_date']) ?>می باشد </div>
            <!--<div class="alert alert-warning"> بازه تایید فرم ها توسط واحد مافوق از تاریخ <?/*=convertDate($this->time['finish_date_confirm'])*/ ?> تا تاریخ  <?/*=convertDate($this->time['start_date_confirm'])*/ ?> می باشد </div>-->
            <a class="btn btn-info btn-lg btn-block" href="<?php echo RELA_DIR ?>admin/?component=shakhes&action=jalasat">فرم
                برگزاری جلسات و نشست ها</a>
            <div class="alert alert-danger">فرم برگزاری جلسات و نشستها: دانشکده‌ها؛ شعبه ارومیه؛
                </div>
            <a class="btn btn-info btn-lg btn-block" href="<?php echo RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte">فرم جلب مشارکت دانش آموختگان و
                دانشجویان</a>
            <div class="alert alert-danger">فرم جلب مشارکت دانش آموختگان و دانشجویان:  دانشکده ها؛ گروه‌های آموزشی؛ شعبه ارومیه؛ معاونت پژوهشی و فناوری </div>
            <a class="btn btn-info btn-lg btn-block" href="<?php echo RELA_DIR ?>admin/?component=shakhes&action=ruydad"> فرم
                رویدادهای برگزار شده</a>
            <div class="alert alert-danger">فرم رویدادهای برگزار شده: دانشکده‌ها؛ گروه‌ها؛ معاونت فرهنگی و اجتماعی؛ شعبه
                ارومیه؛ پژوهشکده زنان؛ نهاد رهبری؛ ستاد شاهد و ایثارگر؛ مرکز پوشکین </div>
            <a class="btn btn-info btn-lg btn-block" href="<?php echo RELA_DIR ?>admin/?component=shakhes&action=shora">فرم
                عضویت در شوراهای برون دانشگاهی</a>
            <div class="alert alert-danger">فرم عضویت در شوراها و کمیته های برون دانشگاهی: گروه‌های آموزشی؛
               روابط عمومی؛ مرکز پوشکین</div>

        </div>


        <div class="panel-heading bg-green" id="topOfTable">
            <h3 class="panel-title rtl "> فرم خود اظهاری</h3>
        </div>








        <div class="panel-body">
            <div id="container">
                <div class='table-cont1'>
                    <div class="alert alert-warning">برای تایید بر اساس کل یک واحد فیلتر کنید</div>
                    <div class="row">
                        <div class="col-md-6">
                            <form id="filterAdminForm" action="/admin/?component=shakhes&action=khodezhari#topOfTable" method="get">
                                <input type="hidden" name="component" value="shakhes">
                                <input type="hidden" name="action" value="khodezhari">
                                <label for="filterAdmin">فیلتر بر اساس:</label>
                                <select name="filterAdmin" id="filterAdmin">
                                    <option value="">همه واحدها</option>
                                    <?php foreach ($filterAdminsSelectbox as $admin) : ?>
                                        <option value="<?php echo $admin['admin_id'] ?>" <?php echo ($admin['admin_id'] == $_GET['filterAdmin']) ? 'selected' : ''; ?>>
                                            <?php echo $admin['name'] . ' ' . $admin['family'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <button class="btn btn-info">اعمال فیلتر</button>
                            </form>
                        </div>
                        <div class="col-md-12">

                            <?php // نمایش وضعیت واحدها
                            foreach ($importStatus as $k => $admin) : ?>

                                <span class="admins-status">
                                    <?php echo $adminName[$admin['motevali_admin_id']]['name'] . ' ' . $adminName[$admin['motevali_admin_id']]['family'] ?>
                                    در مرحله

                                    <?php if (STEP_FORM1 <= 2) : ?>


                                        <?php if ($admin['status6'] == '0') : ?>
                                            <span class="btn-default p-1"> عدم ورود اطلاعات</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'sendToConfirm1') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده اول</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'sendToConfirm2') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده دوم</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'sendToConfirm3') : ?>
                                        <span class="btn-warning2 p-1">ارسال به تایید کننده سوم</span>
                                    <?php endif; ?>
                                    <?php if ($admin['status6'] == 'sendToConfirm4') : ?>
                                        <span class="btn-warning2 p-1">ارسال به تایید کننده چهارم</span>
                                    <?php endif; ?>
                                        <?php if ($admin['status6'] == 'finish') : ?>
                                            <span class="btn-success p-1">اتمام</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'backToEdit') : ?>
                                            <span class="btn-warning2 p-1">نیاز به اصلاح</span>
                                        <?php endif; ?>

                                    <?php else : ?>

                                        <?php if ($admin['status12'] == '0') : ?>
                                            <span class="btn-default p-1"> عدم ورود اطلاعات</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'sendToConfirm1') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده اول</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'sendToConfirm2') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده دوم</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'sendToConfirm3') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده سوم</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'sendToConfirm4') : ?>
                                            <span class="btn-warning p-1">ارسال به تایید کننده چهارم</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'finish') : ?>
                                            <span class="btn-success p-1">اتمام</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'backToEdit') : ?>
                                            <span class="btn-warning2 p-1">نیاز به اصلاح</span>
                                        <?php endif; ?>
                                        می باشد.
                                </span>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        </div>
                    </div>









                    <form action="/admin/?component=shakhes&action=khodezhari" method="POST">
                        <input name="filterAdmin" value="<?php echo $_GET['filterAdmin'] ?>" type="hidden">
                        <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                            <thead>
                                <tr style="text-align: center">
                                    <td colspan="1">کد قلم</td>
                                    <td colspan="1" bgcolor=#fff8dc>قلم آماری</td>
                                    <td colspan="1" bgcolor=#fff8dc>متولی </td>

                                    <td colspan="1" bgcolor=#f2a89e>شش ماهه</td>
                                    <td colspan="1" bgcolor=#f2a89e>توضیحات</td>

                                    <td colspan="1" bgcolor=#8DD4FF>یکساله</td>
                                    <td colspan="1" bgcolor=#8DD4FF>توضیحات</td>

                                </tr>
                            </thead>
                            <div class="col-md-12 col-sm-12 col-sx-12">
                                <?php
                                $msg = $messageStack->output('message');
                                if ($msg != '') :
                                    echo $msg;
                                endif;
                                ?>
                                <?php foreach ($child as $v) : ?>
                                    <div class="col-md-2 col-xs-12 col-sm-12 ">

                                        <div class="col-md-12 confirm-vahed ">
                                            <div class="col-md-12" style="height: 50px">
                                                <label for=""><?php echo $v['name'] . ' ' . $v['family'] ?></label>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="<?php echo RELA_DIR ?>admin/?component=reports&action=confirm&id=<?php echo $v['admin_id'] ?>&s=1" class="btn btn-primary btn-block">تایید</a>
                                                <a href="<?php echo RELA_DIR ?>admin/?component=reports&action=confirm&id=<?php echo $v['admin_id'] ?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php
                            $sentToConfirm1_6 = $sentToConfirm1_12 = 'sendToConfirm1';
                            $sentToConfirm2_6 = $sentToConfirm2_12 = 'sendToConfirm2';
                            $sentToConfirm3_6 = $sentToConfirm3_12 = 'sendToConfirm3';
                            $sentToConfirm4_6 = $sentToConfirm4_12 = 'sendToConfirm4';
                            $activeImportButton = $activeSendToConfirm1 = $activeSendToConfirm2 = $activeSendToConfirm3 = $activeSendToConfirm4 = false;

                            foreach ($imports as $import) :
                                $status6 = $import['status6'];
                                $status12 = $import['status12'];
                                if (STEP_FORM1 <= 2) {
                                    $status = $import['status6'];
                                    $season = 6;
                                } else {
                                    $status = $import['status12'];
                                    $season = 12;
                                }

                                if ($admin_info['admin_id'] == $import['import']) {

                                    $value6 = $import['value6_import'];
                                    $tozihat6 = $import['import_tozihat6'];
                                    $value12 = $import['value12_import'];
                                    $tozihat12 = $import['import_tozihat12'];
                                } else if (in_array($admin_info['admin_id'], [$import['confirm1'], $import['confirm2']])) {

                                    $value6 = $import['value6_import'];
                                    $tozihat6 = $import['import_tozihat6'];
                                    $value12 = $import['value12_import'];
                                    $tozihat12 = $import['import_tozihat12'];
                                } else if ($admin_info['admin_id'] == $import['confirm3']) {

                                    $value6 = $import['value6_arzyab'];
                                    $tozihat6 = $import['arzyab_tozihat6'];
                                    $value12 = $import['value12_arzyab'];
                                    $tozihat12 = $import['arzyab_tozihat12'];
                                } else if ($admin_info['admin_id'] == $import['confirm4']) {

                                    $value6 = $import['value6'];
                                    $tozihat6 = $import['confirm3_tozihat6'];
                                    $value12 = $import['value12'];
                                    $tozihat12 = $import['confirm3_tozihat12'];
                                } else {

                                    $value6 = $import['value6'];
                                    $tozihat6 = $import['tozihat6'];
                                    $value12 = $import['value12'];
                                    $tozihat12 = $import['tozihat12'];
                                }

                                // وقتی یکی از تایید کنندگان میاد
                                if (
                                    $status == 'sendToConfirm1' &&
                                    in_array($admin_info['admin_id'], [$import['confirm1'], $import['confirm2'], $import['confirm3']])
                                ) : ?>
                                    <input type="hidden" name="imports[]" value="<?php echo $import['id'] ?>">
                                    <input type="hidden" name="motevali[]" value="<?php echo $import['motevali_admin_id'] ?>">
                                <?php endif; ?>

                                <tr class="<?php echo $import['motevali_admin_id'] ?>">
                                    <td><?php echo $import['ghalam_id'] ?></td>
                                    <td><?php echo $ghalamName[$import['ghalam_id']]['ghalam'] ?></td>
                                    <td style="color:#<?php echo $import['motevali_admin_id'] ?>00"><?php echo $adminName[$import['motevali_admin_id']]['name'] . ' ' . $adminName[$import['motevali_admin_id']]['family'] ?>
                                    </td>




                                    <td>

                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه
                                        if (
                                            STEP_FORM1 <= 2 &&
                                            in_array($admin_info['admin_id'], [$import['import'], $import['confirm3'], $import['confirm4']]) &&
                                            (
                                                ($admin_info['admin_id'] == $import['import'] && ($status12 == '0' || $status12 == 'backToEdit')) ||
                                                ($admin_info['admin_id'] == $import['confirm3'] && $status12 == 'sendToConfirm3') ||
                                                ($admin_info['admin_id'] == $import['confirm4'] && $status12 == 'sendToConfirm4')) &&
                                            isset($_GET['filterAdmin'])
                                        ) : ?>
                                            <input name="import[<?php echo $import['id'] ?>][value6_import]" step="0.1" type="text" pattern="[0-9]+([,\.][0-9]+)?" value="<?php echo $value6 ?>" autocomplete="off" class="form-control ltr en w-100">


                                        <?php // بعد از ثبت نهایی
                                        else : ?>
                                            <?php echo $value6 ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه 
                                        if (
                                            STEP_FORM1 <= 2 &&
                                            in_array($admin_info['admin_id'], [$import['import'], $import['confirm3'], $import['confirm4']]) &&
                                            (
                                                ($admin_info['admin_id'] == $import['import'] && ($status12 == '0' || $status12 == 'backToEdit')) ||
                                                ($admin_info['admin_id'] == $import['confirm3'] && $status12 == 'sendToConfirm3') ||
                                                ($admin_info['admin_id'] == $import['confirm4'] && $status12 == 'sendToConfirm4')) &&
                                            isset($_GET['filterAdmin'])
                                        ) : ?>

                                            <input name="import[<?php echo $import['id'] ?>][import_tozihat6]" value="<?php echo $tozihat6 ?>" autocomplete="off" class="form-control">
                                            <?php echo ($import['confirm1_tozihat6'] != '') ? '<br>' . $import['confirm1_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm2_tozihat6'] != '') ? '<br>' . $import['confirm2_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm3_tozihat6'] != '') ? '<br>' . $import['confirm3_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm4_tozihat6'] != '') ? '<br>' . $import['confirm4_tozihat6'] : ''; ?>
                                        <?php else : ?>
                                            <?php echo $import['import_tozihat6'] ?>
                                            <?php echo ($import['confirm1_tozihat6'] != '') ? '<br>' . $import['confirm1_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm2_tozihat6'] != '') ? '<br>' . $import['confirm2_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm3_tozihat6'] != '') ? '<br>' . $import['confirm3_tozihat6'] : ''; ?>
                                            <?php echo ($import['confirm4_tozihat6'] != '') ? '<br>' . $import['confirm4_tozihat6'] : ''; ?>
                                        <?php endif; ?>
                                    </td>






                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه
                                        if (
                                            (STEP_FORM1 > 2 && STEP_FORM1 <= 4) &&
                                            in_array($admin_info['admin_id'], [$import['import'], $import['confirm3'], $import['confirm4']]) &&
                                            (
                                                ($admin_info['admin_id'] == $import['import'] && ($status12 == '0' || $status12 == 'backToEdit')) ||
                                                ($admin_info['admin_id'] == $import['confirm3'] && $status12 == 'sendToConfirm3') ||
                                                ($admin_info['admin_id'] == $import['confirm4'] && $status12 == 'sendToConfirm4')) &&

                                            isset($_GET['filterAdmin'])
                                        ) : ?>
                                            <input name="import[<?php echo $import['id'] ?>][value12_import]" step="0.1" type="text" pattern="[0-9]+([,\.][0-9]+)?" value="<?php echo $value12 ?>" autocomplete="off" class="form-control en ltr w-100">
                                        <?php else : ?>
                                            <?php echo $value12 ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه 
                                        if (
                                            STEP_FORM1 > 2 && STEP_FORM1 <= 4 &&
                                            in_array($admin_info['admin_id'], [$import['import'], $import['confirm3'], $import['confirm4']]) &&
                                            (
                                                ($admin_info['admin_id'] == $import['import'] && ($status12 == '0' || $status12 == 'backToEdit')) ||
                                                ($admin_info['admin_id'] == $import['confirm3'] && $status12 == 'sendToConfirm3') ||
                                                ($admin_info['admin_id'] == $import['confirm4'] && $status12 == 'sendToConfirm4')) &&
                                            isset($_GET['filterAdmin'])
                                        ) : ?>
                                            <input name="import[<?php echo $import['id'] ?>][import_tozihat12]" value="<?php echo $tozihat12 ?>" autocomplete="off" class="form-control">
                                            <?php echo ($import['import_tozihat12'] != '') ? '<br>' . $import['import_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm1_tozihat12'] != '') ? '<br>' . $import['confirm1_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm2_tozihat12'] != '') ? '<br>' . $import['confirm2_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm3_tozihat12'] != '') ? '<br>' . $import['confirm3_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm4_tozihat12'] != '') ? '<br>' . $import['confirm4_tozihat12'] : ''; ?>

                                        <?php else : ?>
                                            <?php echo $import['import_tozihat12'] ?>
                                            <?php echo ($import['confirm1_tozihat12'] != '') ? '<br>' . $import['confirm1_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm2_tozihat12'] != '') ? '<br>' . $import['confirm2_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm3_tozihat12'] != '') ? '<br>' . $import['confirm3_tozihat12'] : ''; ?>
                                            <?php echo ($import['confirm4_tozihat12'] != '') ? '<br>' . $import['confirm4_tozihat12'] : ''; ?>

                                        <?php endif; ?>
                                    </td>




                                    <?php if (
                                        ($status == 'sendToConfirm1' && $admin_info['admin_id'] == $import['confirm1'])
                                        || ($status == 'sendToConfirm2' && $admin_info['admin_id'] == $import['confirm2'])
                                    ) : ?>
                                        <td>

                                            <a class="btn btn-warning btn-white " data-toggle="modal" data-target="#backToEdit" data-season="<?php echo $season ?>" data-import="<?php echo $import['id'] ?>" data-motevali="<?php echo $adminName[$import['motevali_admin_id']]['name'] . ' ' . $adminName[$import['motevali_admin_id']]['family'] ?>" data-confirmnumber="<?php echo str_replace('sendToConfirm', '', $status) ?>" data-ghalamname="<?php echo $ghalamName[$import['ghalam_id']]['ghalam'] ?>" onclick="return confirm(' پس از ارسال به اصلاح، \nامکان تایید برای باقی قلم ها تا زمانی که تمام اقلام کامل شوند، وجود ندارد.\n آیا مطمئن هستید؟')">نیاز به اصلاح</a>

                                        </td>
                                    <?php endif; ?>
                                </tr>

                            <?php

                                if ($status6 != 'sendToConfirm1') $sentToConfirm1_6 = '0';
                                if ($status12 != 'sendToConfirm1') $sentToConfirm1_12 = '0';

                                if ($status6 != 'sendToConfirm2') $sentToConfirm2_6 = '0';
                                if ($status12 != 'sendToConfirm2') $sentToConfirm2_12 = '0';

                                if ($status6 != 'sendToConfirm3') $sentToConfirm3_6 = '0';
                                if ($status12 != 'sendToConfirm3') $sentToConfirm3_12 = '0';

                                if ($status6 != 'sendToConfirm4') $sentToConfirm4_6 = '0';
                                if ($status12 != 'sendToConfirm4') $sentToConfirm4_12 = '0';



                                if ($status == '0' || $status == 'backToEdit') $activeImportButton = true;
                                if ($status == 'sendToConfirm1') $activeSendToConfirm1 = true;
                                if ($status == 'sendToConfirm2') $activeSendToConfirm2 = true;
                                if ($status == 'sendToConfirm3') $activeSendToConfirm3 = true;
                                if ($status == 'sendToConfirm4') $activeSendToConfirm4 = true;

                                $importsIdSendToConfirm[$import['id']] = $import['id'];


                            endforeach;

                            ?>

                        </table>



                        <div id="panel-1" class="panel panel-default border-green">
                            <div>


                                <style type="text/css">
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs " role="tablist">
                                    <?php foreach ($groups as $head_admin_id) :
                                        if (
                                            $adminName[$head_admin_id]['parent_id'] == 1
                                            // || $adminName[$head_admin_id]['status' . $season]  != 7
                                        ) {
                                            continue;
                                        } ?>
                                        <li role="presentation" class="pull-right"><a href="#home<?= $head_admin_id ?>" aria-controls="home<?= $head_admin_id ?>" role="tab" data-toggle="tab">
                                                <?php echo  $adminName[$head_admin_id]['name'] . ' ' . $adminName[$head_admin_id]['family'] ?>
                                            </a></li>
                                    <?php endforeach; ?>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" id="tahlil-kalan">

                                    <?php foreach ($groups as $head_admin_id) :

                                        if (
                                            $adminName[$head_admin_id]['parent_id'] == 1
                                            // || $adminName[$head_admin_id]['status' . $season]  != 7
                                        ) {
                                            continue;
                                        } ?>
                                        <?/* if ($vKGroup['group_status'] == 6):*/ ?>

                                        <div role="tabpanel" class="tab-pane fade" id="home<?= $head_admin_id ?>">
                                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <?php foreach ($kalans as $kalan_no => $kalan_value) : ?>

                                                    <?php //if (isset($kalanTahlilArray[$head_admin_id][$kalan_no])) : 
                                                    ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne<?= $head_admin_id . $kalan_no ?>">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?= $head_admin_id . $kalan_no ?>" aria-expanded="true" aria-controls="collapseOne<?= $head_admin_id . $kalan_no ?>">
                                                                    <?php if ($kalanTahlilArray[$head_admin_id][$kalan_no] != '') : ?>
                                                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                                                    <?php endif; ?>

                                                                    <?php echo  ' ' . $kalan_value['kalan'] ?>
                                                                </a>
                                                            </h4>
                                                        </div>

                                                        <div id="collapseOne<?= $head_admin_id . $kalan_no ?>" class="panel-collapse collapse " style="padding: 15px" role="tabpanel" aria-labelledby="headingOne<?= $head_admin_id . $kalan_no ?>">


                                                          

                                                            <?php //   مربوط به تایید کننده سوم
                                                            if (
                                                                $activeSendToConfirm3  && $activeImportButton == false &&
                                                                in_array($admin_info['admin_id'], [$import['confirm3']])
                                                            ) : ?>
                                                                <?php foreach($kalanTahlilArray as $adminId => $kalanTahlil):?>
                                                                <?php echo '<br>' . 'مدیر:'.$kalanTahlil[$kalan_no] ?>
                                                                <?php endforeach ?>
                                                                <textarea class="sh_kalan_tahlil" data-manager-or-arzyab='arzyab' data-kalan-no='<?php echo $kalan_no ?>' data-admin-id='<?php echo $head_admin_id ?>' data-season='<?php echo $season ?>' cols="30" rows="2"><?php echo  nl2br($kalanTahlilArrayArzyab[$head_admin_id][$kalan_no]) ?></textarea>

                                                                <?php echo 'ارزیاب : '.  nl2br($kalanTahlilArrayArzyab[$head_admin_id][$kalan_no]) ?>

                                                            <?php endif ?>

                                                            <?php //   مربوط به تایید کننده چهارم
                                                            if (
                                                                $activeSendToConfirm4  && $activeImportButton == false &&
                                                                in_array($admin_info['admin_id'], [$import['confirm4']])
                                                            ) : ?>
                                                                <textarea class="sh_kalan_tahlil" data-manager-or-arzyab='manager' data-kalan-no='<?php echo $kalan_no ?>' data-admin-id='<?php echo $head_admin_id ?>' data-season='<?php echo $season ?>' cols="30" rows="2"><?php echo  nl2br($kalanTahlilArrayArzyab[$head_admin_id][$kalan_no]) ?></textarea>
                                                                <?php echo 'ارزیاب'.  nl2br($kalanTahlilArrayArzyab[$head_admin_id][$kalan_no]) ?>

                                                            <?php endif ?>

                                                            <?php echo 'مدیر'.  nl2br($kalanTahlilArray[$head_admin_id][$kalan_no]) ?>


                                                        </div>

                                                    </div>
                                                    <?php //endif;
                                                    ?>
                                                <?php endforeach; ?>
                                            </div><!-- panel-group -->
                                        </div>
                                        <?/* endif; */ ?>

                                    <?php endforeach; ?>

                                </div>

                            </div>


                            <script>
                                $('.sh_kalan_tahlil').on('blur', function(event) {
                                    var kalanNo = $(this).data('kalan-no');
                                    var adminId = $(this).data('admin-id');
                                    var season = $(this).data('season');
                                    var managerOrArzyab = $(this).data('manager-or-arzyab');
                                    var tahlil = $(this).val();
                                    var element = $(this);

                                    $('.kalan-tahlil-success').remove();

                                    $.ajax({
                                        type: "POST",
                                        url: "/admin/?component=shakhes&action=khodezhari&func=shKalanTahlil",
                                        data: {
                                            kalanNo: kalanNo,
                                            adminId: adminId,
                                            tahlil: tahlil,
                                            season: season,
                                            managerOrArzyab: managerOrArzyab
                                        },
                                        success: function(result) {
                                            element.after('<div class="kalan-tahlil-success">ذخیره شد</div>');
                                            
                                        }
                                    });
                                    
                                    // console.log(kalanNo, adminId, tahlil);
                                });
                            </script>
                        </div>









                        <?php // دکمه های مربوط به وارد کننده 

                        if (
                            $activeImportButton &&
                            in_array($admin_info['admin_id'], [$import['import']]) &&
                            isset($_GET['filterAdmin'])
                        ) : ?>

                            <input type="submit" class="btn btn-info btn-white btn-large btn-large2" name="temporary" value="ذخیره موقت" />
                            <?php if (isset($_GET['filterAdmin'])) : ?>
                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2" name="sendToConfirm1" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')" value="ارسال به مافوق" />
                            <?php else : ?>
                                برای ثبت نهایی بر اساس واحد فیلتر نمایید
                            <?php endif; ?>
                        <?php endif; ?>




                        <input type="hidden" name="importsIdSendToConfirm" value="<?php echo implode(',', $importsIdSendToConfirm) ?>">


                        <?php // دکمه های مربوط به تایید کننده اول
                        if (
                            $activeSendToConfirm1   && $activeImportButton == false &&
                            in_array($admin_info['admin_id'], [$import['confirm1']])
                        ) : ?>

                            <?php if (isset($_GET['filterAdmin'])) : ?>

                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2 sendToConfirm" name="sendToConfirm2" value="تایید" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')">

                            <?php endif; ?>
                        <?php endif; ?>


                        <?php // دکمه های مربوط به تایید کننده دوم
                        if (
                            $activeSendToConfirm2  && $activeImportButton == false &&
                            in_array($admin_info['admin_id'], [$import['confirm2']])
                        ) : ?>
                            <?php if (isset($_GET['filterAdmin'])) : ?>

                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2 sendToConfirm" name="sendToConfirm3" value="ارسال به ارزیاب" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')">

                            <?php endif; ?>
                        <?php endif; ?>

                        <?php // دکمه های مربوط به تایید کننده سوم
                        if (
                            $activeSendToConfirm3  && $activeImportButton == false &&
                            in_array($admin_info['admin_id'], [$import['confirm3']])
                        ) : ?>
                            <?php if (isset($_GET['filterAdmin'])) : ?>
                                <input type="submit" class="btn btn-info btn-white btn-large btn-large2" name="temporary" value="ذخیره موقت" />

                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2 sendToConfirm" name="sendToConfirm4" value="ارسال به مدیریت" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')">

                            <?php endif; ?>
                        <?php endif; ?>

                        <?php // دکمه های مربوط به تایید کننده چهارم
                        if (
                            $activeSendToConfirm4  && $activeImportButton == false &&
                            in_array($admin_info['admin_id'], [$import['confirm4']])
                        ) : ?>

                            <?php if (isset($_GET['filterAdmin'])) : ?>
                                <input type="submit" class="btn btn-info btn-white btn-large btn-large2" name="temporary" value="ذخیره موقت" />


                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2 sendToConfirm" name="finish" value="تایید نهایی" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')">

                            <?php endif; ?>
                        <?php endif; ?>
                    </form>
                </div>








            </div>
        </div>

    </div>



</div>
<div class="modal fade" id="backToEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">نیاز به اصلاح</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="backToEditForm" action="">
                    <input type="hidden" name="import" id="import" value="">
                    <input type="hidden" id="season" value="">
                    <input type="hidden" id="confirmnumber" value="">
                    <input type="text" class="form-control" name="" placeholder="دلیل اصلاح را بنویسید" id="tozihat">
                    <br>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف </button>
                    <button class="btn btn-warning">ارسال به اصلاح مجدد</button>
                </form>
            </div>

        </div>
    </div>
</div>
<style>
    .en {
        font-family: Arial, Helvetica, sans-serif;
    }

    .w-100 {
        width: 80px;
    }

    .p-1 {
        padding: 2px 5px;
        border-radius: 5px;
    }

    .report td {
        border: 1px solid #eee;
        padding: 3px;
    }

    .btn-warning2 {
        color: #000;
        font-weight: bold;
    }

    .btn-large2 {
        font-size: 20px;
    }

    .admins-status {
        background-color: #ccc;
        padding: 3px 6px;
        margin: 2px;
        float: right;
    }

    .admins-status .default-span {
        background-color: #fff;
    }
</style>
<script>
    $("input[type=number]").blur(function() {
        this.value = parseFloat(this.value).toFixed(2);

        /*if (this.value < 0 || this.value > 100) {
            alert('مقدار وارد شده اشتباه است. و باید بین ۰ تا ۱۰۰ باشد.');
            this.focus();
        }*/
    });


    //فیلترینگ
    $('form#filterAdminForm').submit(function(e) {

        var filterAdmin = parseInt($('#filterAdmin').val());

        console.log(typeof filterAdmin);

        if (Number.isInteger(filterAdmin)) {
            return true;
        } else {
            e.preventDefault();
            document.location = '/admin/?component=shakhes&action=khodezhari#topOfTable';
        }
    });

    var modal;
    $('#backToEdit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);


        var importId = button.data('import');
        var ghalamName = button.data('ghalamname');
        var motevali = button.data('motevali');
        var confirmnumber = button.data('confirmnumber');
        var season = button.data('season');



        modal = $(this);
        modal.find('.modal-title').text(ghalamName + '-' + motevali);
        modal.find('input#import').val(importId);
        modal.find('input#confirmnumber').val(confirmnumber);
        modal.find('input#season').val(season);


        setTimeout(function() {
            $('#tozihat').focus();

        }, 500);





    });

    $(document).ready(function() {

        $('.modal form').submit(function(e) {

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "/admin/?component=shakhes&action=khodezhari&func=backToEdit",
                data: {
                    importid: $('input#import').val(),
                    season: $('input#season').val(),
                    tozihatFieldName: 'confirm' + $('input#confirmnumber').val() + '_tozihat' + $('input#season').val(),
                    tozihat: $('input#tozihat').val()
                },
                success: function(result) {
                    modal.modal('hide');
                    $('a[data-import=' + $('input#import').val() + ']').before('بازگشت به اصلاح');
                    $('a[data-import=' + $('input#import').val() + ']').hide();
                    $('input.sendToConfirm').hide();
                }
            });
        });
    });
</script>