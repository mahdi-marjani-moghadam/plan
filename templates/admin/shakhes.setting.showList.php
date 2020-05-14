<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl">شاخص</h3>
        </div>
        <div class="panel-body">
            <div id="container">
                <a data-toggle="modal" data-target="#add" class="btn btn-success" href="">افزودن شاخص جدید</a>
                <br>
                <br>
                <table class="table table-striped table-bordered rtl">
                    <tr>
                        <td></td>
                        <td>نام شاخص</td>
                        <td>نوع</td>
                        <td>فرمول</td>
                        <td></td>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($shakhes as $k => $sh) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $sh['shakhes'] ?></td>
                            <td>
                                <?
                                switch ($sh['logic']['type']) {
                                    case 'equal':
                                        echo 'تساوی';
                                        break;
                                    case 'sum':
                                        echo 'مجموع';
                                        break;
                                    case 'divid':
                                        echo 'نسبت';
                                        break;
                                }

                                ?>
                            </td>
                            <td dir="ltr"><?= $sh['logic']['function'] ?></td>
                            <td>
                                <a class="btn btn-warning " data-toggle="modal" data-target="#edit<?= $k ?>">ویرایش</a>
                                <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=delete&id=<?= $sh['id'] ?>" class="btn btn-danger " onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                                <a class="btn btn-info copy" data-toggle="modal" data-target="#copy">کپی و ساخت شاخص جدید</a>


                                <!-- Edit -->
                                <div id="edit<?= $k ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">ویرایش <?= $sh['shakhes'] ?></h4>
                                            </div>
                                            <div class="modal-body">

                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <label>نام شاخص</label>

                                                </div>
                                                <input id="add-shakhes" value="<?= $sh['shakhes'] ?>" class="form-control ">
                                                
                                                <label class="col-md-12 col-xs-12 col-sm-12"> فرمول</label>
                                                <select class="">
                                                    <option class="select-equal" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'equal') ? 'selected' : '' ?>>تساوی</option>
                                                    <option class="select-sum" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'sum') ? 'selected' : '' ?>>مجموع</option>
                                                    <option class="select-divid" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'divid') ? 'selected' : '' ?>>نسبت</option>
                                                </select>
                                                <br>
                                                <br>
                                                <?php if ($sh['logic']['type'] == 'equal') : ?>
                                                    <!-- <input class="form-control" style="font-family: Verdana" dir='ltr' value="<? //= $sh['logic']['function'] 
                                                                                                                                    ?>"> -->
                                                    <label class="add-equal col-md-12 col-xs-12 col-sm-12">قلم</label><br>
                                                    <select>
                                                        <? foreach ($ghalam as $k => $gh) : ?>
                                                            <option <?= (in_array($gh['ghalam_id'], $sh['logic']['ghalams'])) ? 'selected' : ''; ?> value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                                                        <? endforeach ?>
                                                    </select>
                                                <?php endif; ?>

                                                <?php if ($sh['logic']['type'] == 'sum') : ?>
                                                    <!-- <input class="form-control" style="font-family: Verdana" dir='ltr' value="<? //= $sh['logic']['function'] 
                                                                                                                                    ?>"> -->
                                                    <label class="add-equal col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                                                    <select multiple>
                                                        <? foreach ($ghalam as $k => $gh) : ?>
                                                            <option <?= (in_array($gh['ghalam_id'], $sh['logic']['ghalams'])) ? 'selected' : ''; ?> value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                                                        <? endforeach ?>
                                                    </select>
                                                <?php endif; ?>

                                                <?php if ($sh['logic']['type'] == 'divid') : ?>
                                                    <!-- <input class="form-control" style="font-family: Verdana" dir='ltr' value="<? //= $sh['logic']['up'] 
                                                                                                                                    ?>"> -->
                                                    <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (صورت کسر)</label><br>
                                                    <select multiple>
                                                        <? foreach ($ghalam as $k => $gh) : ?>
                                                            <option <?= (in_array($gh['ghalam_id'], $sh['logic']['ghalams']['up'])) ? 'selected' : ''; ?> value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                                                        <? endforeach ?>
                                                    </select>
                                                    <br>
                                                    <!-- <input class="form-control" style="font-family: Verdana" dir='ltr' value="<? //= $sh['logic']['down'] 
                                                                                                                                    ?>"> -->
                                                    <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (مخرج کسر)</label><br>
                                                    <select multiple>
                                                        <? foreach ($ghalam as $k => $gh) : ?>
                                                            <option <?= (in_array($gh['ghalam_id'], $sh['logic']['ghalams']['down'])) ? 'selected' : ''; ?> value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                                                        <? endforeach ?>
                                                    </select>
                                                <?php endif; ?>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>

                                                <button type="button" class="btn btn-success">تایید</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Copy -->
<div id="copy" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن شاخص جدید</h4>
            </div>
            <form action="#" method="POST">
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-success add-submit">تایید</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add -->
<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">افزودن شاخص جدید</h4>
            </div>
            <form action="#" method="POST">
                <div class="modal-body">

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <label>نام شاخص</label>
                        <input id="add-shakhes" class="form-control ">
                    </div>

                    <label class="col-md-12 col-xs-12 col-sm-12"> فرمول</label>
                    <br>
                    <select id="add-select-box" class="col-md-6 col-xs-6 col-sm-6 pull-right">
                        <option>نوع عملیات را انتخاب کنید</option>
                        <option value="equal" class="select-equal">تساوی</option>
                        <option value="sum" class="select-sum">مجموع</option>
                        <option value="divid" class="select-divid">نسبت</option>
                    </select>
                    <div id="add-select-box-error" class="alert alert-danger col-md-6 col-xs-6 col-sm-6" style="padding: 6px 15px; display: none">لطفا یکی را انتخاب نمایید</div>
                    <br>
                    <br>

                    <div class="row">
                        <label class="add-equal col-md-12 col-xs-12 col-sm-12">قلم</label><br>
                        <select id="status" class="add-equal col-md-6 col-xs-6 col-sm-6 pull-right">
                            <? foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                            <? endforeach ?>
                        </select>
                    </div>

                    <div class="row">
                        <label class="add-sum col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                        <select id="status" class="add-sum col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <? foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                            <? endforeach ?>
                        </select>
                    </div>

                    <div class="row">
                        <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (صورت کسر)</label><br>
                        <select id="status" class="add-divid add-divid-up col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <? foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                            <? endforeach ?>
                        </select>
                        <br>
                        <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (مخرج کسر)</label><br>
                        <select id="status" class="add-divid add-divid-down col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <? foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?= $gh['ghalam_id'] ?>"><?= $gh['ghalam'] ?></option>
                            <? endforeach ?>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-success add-submit">تایید</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        /** add form*/
        $("#add .add-equal, #add .add-sum, #add .add-divid").hide();
        $('#add-select-box').change(function(e) {
            $("#add .add-equal, #add .add-sum, #add .add-divid").hide();
            $('.add-' + $(this).val()).show();
        });

        $('#add .add-submit').click(function(e) {
            e.preventDefault();
            $('#add #add-select-box-error').hide();

            var type = $('#add-select-box').val();

            if (["equal", "sum", "divid"].includes(type)) {
                $.ajax({
                    url: '/?component=shakhes&action=settingAdd',
                    method: 'post',
                    data: {
                        'type': type
                    },
                    success: function(data, status, xhr) {
                        //window.location = '/?component=shakhes&action=setting'
                    },
                    error: function(data, status, xhr) {
                        alert('مشکلی در سرور بوجود آمده است.');
                    }
                });
            } else {
                //alert('لطفا یکی از توابع را انتخاب نمایید');
                $('#add #add-select-box-error').show();
            }
        });

        $('#add-select-box').change(function() {
            $('#add #add-select-box-error').hide();
        });


        /** end add form */


        /**  */
        $('.copy').click(function(e) {
            $('#copy .modal-body').html($(this).next().find('.modal-body').html());

            console.log($(this));
        });

    });
</script>