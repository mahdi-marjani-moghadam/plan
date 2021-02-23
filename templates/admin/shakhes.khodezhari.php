<div class="row smallSpace"></div>

<div class="content-body">
    <!-- separator -->

    <div id="panel-1" class="panel panel-default border-green">

        <div class="panel-body">
            <div class="alert alert-danger">توجه: در خصوص تکمیل فرم‌های ارزیابی ضروری است واحدها نسبت به تکمیل فرمهای مربوطه طبق تفکیک ذکر شده در زیر دکمه هر فرم اقدام نمایند. لازم به ذکر است در صورت عدم تکمیل فرم‌ها، امتیاز مربوط به فعالیتهای مربوطه کسر خواهد شد. از آنجا که اطلاعات مستخرج از فرمها در شاخصهای عملکرد واحدها نیز لحاظ می‌شود در صورت عدم تکمیل آنها، امتیازی به شاخص‌های مربوطه تعلق نمی‌گیرد.</div>
            <div class="alert alert-warning"> بازه تکمیل فرم ها از تاریخ <?= convertDate($this->time['start_date']) ?> تا تاریخ <?= convertDate($this->time['finish_date']) ?>می باشد </div>
            <!--<div class="alert alert-warning"> بازه تایید فرم ها توسط واحد مافوق از تاریخ <?/*=convertDate($this->time['finish_date_confirm'])*/?> تا تاریخ  <?/*=convertDate($this->time['start_date_confirm'])*/?> می باشد </div>-->
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat">فرم برگزاری جلسات و نشست ها</a>
            <div class="alert alert-danger">فرم برگزاری جلسات و نشستها: گروه‌های آموزشی؛ دانشکده‌ها؛ شعبه ارومیه؛ مرکز نوآوری</div>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte">فرم جلب مشارکت دانش آموختگان و دانشجویان</a>
            <div class="alert alert-danger">فرم جلب مشارکت دانش آموختگان و دانشجویان: گروه‌های آموزشی؛ دانشکده‌ها؛ شعبه ارومیه؛ مرکز نوآوری </div>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad"> فرم رویدادهای برگزار شده</a>
            <div class="alert alert-danger">فرم رویدادهای برگزار شده: دانشکده‌ها؛ گروه‌ها؛ مدیریت برنامه، بودجه و تحول سازمانی؛ مدیریت روابط عمومی؛ مرکز رشد واحدهای فناور؛ معاونت فرهنگی و اجتماعی؛ معاونت اداری مالی؛ شعبه ارومیه؛ پژوهشکده زنان؛ معاونت آموزشی و تحصیلات تکمیلی و مدیریت‌های زیرمجموعه شامل(مدیریت تحصیلات تکمیلی - مدیریت خدمات آموزشی - مرکز آموزش های آزاد و مجازی- مدیریت برنامه ریزی و توسعه آموزشی)؛ معاونت پژوهشی و فناوری و مدیریت‌های زیرمجموعه شامل( کتابخانه مرکزی- مدیریت امور پژوهشی-مرکز نوآوری و شکوفایی)؛ معاونت دانشجویی و مدیریت‌های زیرمجموعه شامل(مدیریت تربیت بدنی -مدیریت مرکز مشاوره، بهداشت و سلامت) </div>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=shora">فرم عضویت در شوراهای برون دانشگاهی</a>
            <div class="alert alert-danger">فرم عضویت در شوراها و کمیته های برون دانشگاهی: گروه‌های آموزشی؛ دانشکده‌ها؛ شعبه ارومیه؛ معاونت فرهنگی؛ پژوهشکده زنان</div>

        </div>


        <div class="panel-heading bg-green" id="topOfTable">
            <h3 class="panel-title rtl "> فرم خود اظهاری</h3>
        </div>

        <div class="panel-body">
            <div id="container">
                <div class='table-cont1'>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="filterAdminForm" action="/admin/?component=shakhes&action=khodezhari#topOfTable" method="get">
                                <input type="hidden" name="component" value="shakhes">
                                <input type="hidden" name="action" value="khodezhari">
                                <label for="filterAdmin">فیلتر بر اساس:</label>
                                <select name="filterAdmin" id="filterAdmin">
                                    <option value="">همه واحدها</option>
                                    <?php foreach ($filterAdminsSelectbox as $admin) : ?>
                                        <option value="<?= $admin['admin_id'] ?>" <?php echo ($admin['admin_id'] == $_GET['filterAdmin']) ? 'selected' : ''; ?>>
                                            <?= $admin['name'] . ' ' . $admin['family'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <button class="btn btn-info">اعمال فیلتر</button>
                            </form>
                        </div>
                        <div class="col-md-12">

                            <?php // نمایش وضعیت واحدها
                            foreach ($adminStatus as $admin) : ?>
                                <span class="admins-status">
                                    <?= $adminName[$admin['admin_id']]['name'] . ' ' . $adminName[$admin['admin_id']]['family'] ?> در مرحله

                                    <?php if (STEP_FORM1 <= 2) : ?>


                                        <?php if ($admin['status6'] == '0') : ?>
                                            <span class="btn-default p-1"> عدم ورود اطلاعات</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'sentToParent') : ?>
                                            <span class="btn-warning2 p-1">ارسال به مافوق</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status6'] == 'backToEdit') : ?>
                                            <span class="btn-warning p-1">نیاز به اصلاح</span>
                                        <?php endif; ?>

                                    <?php else : ?>

                                        <?php if ($admin['status12'] == '0') : ?>
                                            <span class="btn-default p-1"> عدم ورود اطلاعات</span>
                                        <?php endif; ?>
                                        <?php if ($admin['status12'] == 'sentToParent') : ?>
                                            <span class="btn-warning p-1">ارسال به مافوق</span>
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
                        <input name="filterAdmin" value="<?= $_GET['filterAdmin'] ?>" type="hidden">
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
                                            <label for=""><?= $v['name'] . ' ' . $v['family'] ?></label>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="<?= RELA_DIR ?>admin/?component=reports&action=confirm&id=<?= $v['admin_id'] ?>&s=1" class="btn btn-primary btn-block">تایید</a>
                                            <a href="<?= RELA_DIR ?>admin/?component=reports&action=confirm&id=<?= $v['admin_id'] ?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                                        </div>
                                    </div>
                                </div>
                                <? endforeach;?>
                            </div>
                            <?php
                            $sentToParent6 = $sentToParent12 = 'sentToParent';
                            foreach ($imports as $import) :
                                $status6 = $adminStatus[$import['motevali_admin_id']]['status6'];
                                $status12 = $adminStatus[$import['motevali_admin_id']]['status12'];

                                // وقتی یکی از تایید کنندگان میاد
                                if (
                                    ($status6 == 'sentToParent' or $status12 == 'sentToParent') &&
                                    in_array($admin_info['admin_id'], [$import['confirm1'], $import['confirm2'], $import['confirm3'], $import['confirm4']])
                                ) : ?>
                                    <input type="hidden" name="imports[]" value="<?= $import['id'] ?>">
                                    <input type="hidden" name="motevali[]" value="<?= $import['motevali_admin_id'] ?>">
                                <?php endif; ?>

                                <tr class="<?= $import['motevali_admin_id'] ?>">
                                    <td><?= $import['ghalam_id'] ?></td>
                                    <td><?= $ghalamName[$import['ghalam_id']]['ghalam'] ?></td>
                                    <td><?= $adminName[$import['motevali_admin_id']]['name'] . ' ' . $adminName[$import['motevali_admin_id']]['family'] ?></td>

                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه
                                        if (
                                            STEP_FORM1 <= 2 &&
                                            ($status6 == '0' || $status6 == 'backToEdit') &&
                                            in_array($admin_info['admin_id'], [$import['import']])
                                        ) : ?>
                                            <input name="import[<?= $import['id'] ?>][value6]" step="0.1" type="text" pattern="[0-9]+([,\.][0-9]+)?" value="<?= $import['value6'] ?>" autocomplete="off" class="form-control ltr en w-100">
                                        <?php // بعد از ثبت نهایی
                                        else : ?>
                                            <?= $import['value6'] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه 
                                        if (
                                            STEP_FORM1 <= 2 &&
                                            ($status6 == '0' || $status6 == 'backToEdit') &&
                                            in_array($admin_info['admin_id'], [$import['import']])
                                        ) : ?>
                                            <input name="import[<?= $import['id'] ?>][admin_tozihat6]" value="<?= $import['admin_tozihat6'] ?>" autocomplete="off" class="form-control">
                                        <?php else : ?>
                                            <?= $import['admin_tozihat6'] ?>
                                        <?php endif; ?>
                                    </td>






                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه
                                        if (
                                            (STEP_FORM1 > 2 && STEP_FORM1 <= 4) &&
                                            ($status12 == '0' || $status12 == 'backToEdit') &&
                                            in_array($admin_info['admin_id'], [$import['import']])
                                        ) : ?>
                                            <input name="import[<?= $import['id'] ?>][value12]" step="0.1" type="text" pattern="[0-9]+([,\.][0-9]+)?" value="<?= $import['value12'] ?>" autocomplete="off" class="form-control en ltr w-100">
                                        <?php else : ?>
                                            <?= $import['value12'] ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php // وقتی وارد کننده باشه و هنوز مقداری وارد نکرده باشه 
                                        if (
                                            STEP_FORM1 > 2 && STEP_FORM1 <= 4 &&
                                            ($status12 == '0' || $status12 == 'backToEdit') &&
                                            in_array($admin_info['admin_id'], [$import['import']])
                                        ) : ?>
                                            <input name="import[<?= $import['id'] ?>][admin_tozihat12]" value="<?= $import['admin_tozihat12'] ?>" autocomplete="off" class="form-control">
                                        <?php else : ?>
                                            <?= $import['admin_tozihat12'] ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php

                                if ($status6 != 'sentToParent') $sentToParent6 = '';
                                if ($status12 != 'sentToParent') {
                                    $sentToParent12 = '';
                                }
                            endforeach;
                            ?>

                        </table>

                        <?php // دکمه های مربوط به وارد کننده  

                        if (
                            (
                                (($adminStatus[$import['motevali_admin_id']]['status6'] == '0' || $adminStatus[$import['motevali_admin_id']]['status6'] == 'backToEdit') && STEP_FORM1 <= 2) ||
                                (($adminStatus[$import['motevali_admin_id']]['status12'] == '0' || $adminStatus[$import['motevali_admin_id']]['status12'] == 'backToEdit') && STEP_FORM1 >= 3)) &&
                            in_array($admin_info['admin_id'], [$import['import']])
                        ) : ?>
                            <?php if (isset($_GET['filterAdmin'])) : ?>
                                <input type="submit" class="btn btn-success btn-white btn-large btn-large2" name="sentToParent" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')" value="ارسال به مافوق" />
                            <?php endif; ?>
                            <input type="submit" class="btn btn-info btn-white btn-large btn-large2" name="temporary" value="ذخیره موقت" />
                        <?php endif; ?>




                        <?php // دکمه های مربوط به تایید کننده 
                        if (
                            ($sentToParent6 == 'sentToParent' or $sentToParent12 == 'sentToParent') &&
                            in_array($admin_info['admin_id'], [$import['confirm1'], $import['confirm2'], $import['confirm3'], $import['confirm4']])
                        ) : ?>

                            <input type="submit" class="btn btn-success btn-white btn-large btn-large2" name="confirm" value="تایید">
                            <input type="submit" class="btn btn-warning btn-white btn-large btn-large2" name="backToEdit" value="نیاز به اصلاح">

                        <?php endif; ?>

                    </form>
                </div>
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
</script>