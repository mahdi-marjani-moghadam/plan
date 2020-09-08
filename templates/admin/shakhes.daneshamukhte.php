<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم دانش آموختگان</h3>
        </div>
        <div class="panel-body">

            <? 
            if($msg){
                echo $msg;
            }
            ?>

            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte" method="post">
                <table class="form">
                    <tr>
                        <td>نام و نام خانوادگی*</td>
                        <td><input name="name_family" value="<?= $data['name_family'] ?>" class="form-control"></td>

                        <td>تاریخ فارغ التحصیلی*</td>
                        <td><input name="graduated_date" value="<?= $data['graduated_date'] ?>" autocomplete="off" class="form-control date"></td>

                        <td>مقطع*</td>
                        <td>
                            <select name="grade">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['grade'] as $item):?>
                                <option <?= ($data['grade'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>رشته*</td>
                        <td><input name="course" class="form-control" value="<?= $data['course'] ?>"></td>

                        <td>نوع ارتباط/همکاری با دانشگاه</td>
                        <td>
                            <select name="relation_type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['relation_type'] as $item):?>
                                <option <?= ($data['relation_type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>وضعیت اشتغال*</td>
                        <td>
                            <select name="employed_status">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['employed_status'] as $item):?>
                                <option <?= ($data['employed_status'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>نام سازمان مشغول به کار*</td>
                        <td><input name="organ_name" value="<?= $data['organ_name'] ?>" class="form-control"></td>

                        <td>پست سازمانی</td>
                        <td><input name="organ_position" value="<?= $data['organ_position'] ?>" class="form-control"></td>

                        <td>وضعیت ادامه تحصیل*</td>
                        <td>
                            <select name="continue_education">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['continue_education'] as $item):?>
                                <option <?= ($data['continue_education'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>نام دانشگاه مقطع بالاتر</td>
                        <td><input name="continue_university" value="<?= $data['continue_university'] ?>" class="form-control"></td>

                        <td>افتخارات و موفقیت‌ها</td>
                        <td><input name="successes" value="<?= $data['successes'] ?>" class="form-control"></td>

                        <td>توضیحات</td>
                        <td><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <button name="final" value="2" class="btn btn-success btn-large"> ارسال به مافوق</button>
            </form>
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست دانش آموختگان</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>نام و نام خانوادگی</th>
                    <th>تاریخ فارغ التحصیلی</th>
                    <th>مقطع</th>
                    <th>رشته</th>
                    <th>نوع ارتباط/همکاری با دانشگا</th>
                    <th>وضعیت اشتغال</th>
                    <th>نام سازمان مشغول به کار</th>
                    <th>پست سازمانی</th>
                    <th>وضعیت ادامه تحصیل</th>
                    <th>نام دانشگاه مقطع بالاتر</th>
                    <th>افتخارات و موفقیت‌ها</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($daneshamukhte['recordsCount'] > 0) :
                    foreach ($daneshamukhte['list'] as $v) :
                ?>
                        <tr>
                            <td><?= $v['admin_id'] ?></td>
                            <td><?= $v['name_family'] ?></td>
                            <td><?= convertDate($v['graduated_date']) ?></td>
                            <td><?= $v['grade'] ?></td>
                            <td><?= $v['course'] ?></td>
                            <td><?= $v['relation_type'] ?></td>
                            <td><?= $v['employed_status'] ?></td>
                            <td><?= $v['organ_name'] ?></td>
                            <td><?= $v['organ_position'] ?></td>
                            <td><?= $v['continue_education'] ?></td>
                            <td><?= $v['continue_university'] ?></td>
                            <td><?= $v['successes'] ?></td>
                            <td><?= $v['tozihat'] ?></td>
                            <td>
                                <?= ($v['status'] == 0) ? '' : 'ارسال به مافوق' ?>
                                <? if($v['status'] == 0):  ?>
                                <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte" method="post">
                                    <button name="confirm" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')" class="btn btn-xs btn-success pull-right">ارسال به مافوق</button>
                                </form>
                                <? endif;?>
                            </td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </table>
        </div>
    </div>
</div>

<style>
    form {
        text-align: center;
    }

    .form {
        margin: auto;
    }

    .form td {
        padding: 1em;
        text-align: left;
    }
</style>