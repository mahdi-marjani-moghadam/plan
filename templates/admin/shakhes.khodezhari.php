<div class="row smallSpace"></div>

<div class="content-body">
    <!-- separator -->

    <div id="panel-1" class="panel panel-default border-green">

        <div class="panel-body">
            <div class="alert alert-danger">توجه: ورود اطلاعات فرم ها و تکمیل فرایند آنها در طی تاریخ تعیین شده ضرورت دارد. در صورت عدم تکمیل هریک از فرم ها ............</div>
            <div class="alert alert-warning"> بازه تکمیل فرم ها از تاریخ <?=convertDate($this->time['start_date'])?> تا تاریخ <?=convertDate($this->time['finish_date'])?>می باشد </div>
            <div class="alert alert-warning"> بازه تایید فرم ها توسط واحد مافوق از تاریخ <?=convertDate($this->time['confirm_finish_date'])?> تا تاریخ  <?=convertDate($this->time['confirm_start_date'])?> می باشد </div>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat">فرم جلسات توجیهی تحصیلات تکمیلی</a>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte">فرم همکاری دانش آموختگان و دانشجویان</a>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad"> فرم رویدادهای برگزار شده</a>
            <a class="btn btn-info btn-lg btn-block" href="<?= RELA_DIR ?>admin/?component=shakhes&action=shora">فرم عضویت در شوراهای برون دانشگاهی</a>
        </div>


<!--        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم خود اظهاری</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <>

                    <div class="panel-body">
                        <div id="container">
                            <div class='table-cont1'>
                                <table  id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                                    <thead>
                                    <tr style="text-align: center">
                                        <td colspan="1" >کد قلم</td>
                                        <td colspan="1" bgcolor= #fff8dc>قلم آماری</td>
                                        <td colspan="1" bgcolor= #f2a89e>شش ماهه</td>
                                        <td colspan="1" bgcolor= #f2a89e>توضیحات</td>
                                        <td colspan="1" bgcolor= #8DD4FF>یکساله</td>
                                        <td colspan="1" bgcolor= #8DD4FF>توضیحات</td>
                                    </tr>
                                    </thead>
                                    <div class="col-md-10 col-sm-12 col-sx-12">
                                        <?/*
                                        $msg = $messageStack->output('message');
                                        if($msg != ''):
                                            echo $msg;
                                        endif;
                                        */?>
                                        <?/* foreach ($child as $v):*/?>
                                            <div class="col-md-2 col-xs-12 col-sm-12 ">

                                                <div class="col-md-12 confirm-vahed ">
                                                    <div class="col-md-12" style="height: 50px">
                                                        <label for=""><?/*=$v['name'].' '.$v['family']*/?></label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a href="<?/*=RELA_DIR*/?>admin/?component=reports&action=confirm&id=<?/*=$v['admin_id']*/?>&s=1" class="btn btn-primary btn-block">تایید</a>
                                                        <a href="<?/*=RELA_DIR*/?>admin/?component=reports&action=confirm&id=<?/*=$v['admin_id']*/?>&s=2" class="btn btn-primary btn-block">نیازمند اصلاح</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?/* endforeach;*/?>
                                    </div>
                                    <?php
/*                                    foreach ($ghalams as $ghalam):
                                    */?>
                                    <tr>
                                    <td><?/*=$ghalam['ghalam_id']*/?></td>
                                    <td><?/*=$ghalam['ghalam']*/?></td>
                                    <td><input class="form-control"></td>
                                    <td><input class="form-control"></td>
                                    <td><input class="form-control"></td>
                                    <td><input class="form-control"></td>-->
                                    <td><input name="value6" value="<?/*= $data['value6'] */?>" autocomplete="off" class="form-control"></td>
                                    <td><input name="value12" value="<?/*= $data['value12'] */?>" autocomplete="off" class="form-control"></td>
                                    <td><input name="admin_tozihat6" value="<?/*= $data['admin_tozihat6'] */?>" autocomplete="off" class="form-control"></td>
                                    <td><input name="admin_tozihat12" value="<?/*= $data['admin_tozihat12'] */?>" autocomplete="off" class="form-control"></td>
                                    </tr>
                                    <?php
/*                                       endforeach;
                                    */?>

            </table>
                                <!--<input type="submit" class="btn btn-info btn-white btn-large " style="font-size: 20px" name="temporary" value="ذخیره موقت" />
                                <input type="submit" class="btn btn-success btn-white btn-large" style="font-size: 20px" name="final" onclick="return confirm(' پس از ثبت نهایی، امکان ویرایش اطلاعات وجود ندارد. آیا مطمئن هستید؟')"  value="ارسال به مافوق" />
                            --></div>
                        </div>
                    </div>
</div>-->
</div>
