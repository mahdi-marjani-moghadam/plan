<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم شورا</h3>
        </div>
        <div class="panel-body">

            <? 
            if($msg){
                echo $msg;
            }
            ?>

            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora" method="post">
                <table class="form">
                    <tr>
                        <td>عنوان شورا/کارگروه/انجمن*</td>
                        <td><input name="shora_type" value="<?= $data['shora_type'] ?>" class="form-control"></td>

                        <td>نام و نام خانوادگی*</td>
                        <td><input name="name_family" value="<?= $data['name_family'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>شروع عضویت*</td>
                        <td><input name="start_date" value="<?= $data['start_date'] ?>" autocomplete="off" class="form-control date"></td>

                        <td>خاتمه عضویت</td>
                        <td><input name="finish_date" value="<?= $data['finish_date'] ?>" autocomplete="off" class="form-control date"></td>
                    </tr>
                    <tr>
                        <td>ملی/بین‌المللی*</td>
                        <td>
                            <select name="nationality">
                                <? foreach($options['nationality'] as $item):?>
                                <option <?= ($data['nationality'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>سمت/پست*</td>
                        <td>
                            <select name="position">
                                <? foreach($options['position'] as $item):?>
                                <option <?= ($data['position'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>درج عضویت در صفحه شخصی عضو هیات علمی*</td>
                        <td>
                            <select name="position">
                                <? foreach($options['position'] as $item):?>
                                <option <?= ($data['position'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>توضیحات</td>
                        <td><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <button name="final" value="2" class="btn btn-success btn-large"> ارسال به مافوق</button>
            </form>
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست شورا</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>عنوان شورا/کارگروه/انجمن</th>
                    <th>نام و نام خانوادگی</th>
                    <th>شروع عضویت</th>
                    <th>خاتمه عضویت</th>
                    <th>ملی/بین‌المللی</th>
                    <th>سمت/پست</th>
                    <th>درج عضویت در صفحه شخصی عضو هیات علمی</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($shora['recordsCount'] > 0) :
                    foreach ($shora['list'] as $v) :
                ?>
                        <tr>
                            <td><?= $v['admin_id'] ?></td>
                            <td><?= $v['shora_type'] ?></td>
                            <td><?= $v['name_family'] ?></td>
                            <td><?= convertDate($v['start_date']) ?></td>
                            <td><?= convertDate($v['finish_date']) ?></td>
                            <td><?= $v['nationality'] ?></td>
                            <td><?= $v['position'] ?></td>
                            <td><?= $v['personal_page'] ?></td>
                            <td><?= $v['tozihat'] ?></td>
                            <td>
                                <?= ($v['status'] == 0) ? '' : 'ارسال به مافوق' ?>
                                <? if($v['status'] == 0):  ?>
                                <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora" method="post">
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