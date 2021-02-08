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


        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم خود اظهاری</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>

                    <div class="panel-body">
                        <div id="container">
                            <div class='table-cont1'>
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
                                    foreach ($imports as $import) :
                                    ?>
                                        <tr>
                                            <td><?= $import['ghalam_id'] ?></td>
                                            <td><?= $ghalamName[$import['ghalam_id']]['ghalam'] ?></td>
                                            <td><?=$adminName[$import['motevali_admin_id']]['name'].' '.$adminName[$import['motevali_admin_id']]['family'] ?></td>
                                            <td><input name="value6" value="<?= $data['value6'] ?>" autocomplete="off" class="form-control"></td>
                                            <td><input name="value12" value="<?= $data['value12'] ?>" autocomplete="off" class="form-control"></td>
                                            <td><input name="admin_tozihat6" value="<?= $data['admin_tozihat6'] ?>" autocomplete="off" class="form-control"></td>
                                            <td><input name="admin_tozihat12" value="<?= $data['admin_tozihat12'] ?>" autocomplete="off" class="form-control"></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>

                                </table>
                                <input type="submit" class="btn btn-info btn-white btn-large " style="font-size: 20px" name="temporary" value="ذخیره موقت" />
                                <input type="submit" class="btn btn-success btn-white btn-large" style="font-size: 20px" name="final" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')" value="ارسال به مافوق" />
                            </div>
                        </div>
                    </div>
                </tr>
            </table>
        </div>
    </div>