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
                        <td>شماره شاخص</td>
                        <td>هدف کلان</td>
                        <td>نام شاخص</td>
                        <td>نوع</td>
                        <td>فرمول</td>
                        <td></td>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($shakhes as $k => $sh) : ?>
                        <tr>
                            <td><?php echo  $k ?></td>
                            <td><?php echo  $kalans[$sh['kalan_no']]['kalan'] ?></td>
                            <td><?php echo   $sh['shakhes'] ?></td>
                            <td>
                                <?php
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
                                    case 'average':
                                        echo 'میانگین';
                                        break;
                                }

                                ?>
                            </td>
                            <td dir="ltr"><?php echo  $sh['logic']['function'] ?></td>
                            <td>
                                <a class="btn btn-warning edit" data-shakhesid="<?php echo  $k ?>" data-kalanno="<?php echo  $sh['kalan_no'] ?>" data-toggle="modal" data-target="#edit">ویرایش</a>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=delete&id=<?php echo  $sh['id'] ?>" class="btn btn-danger " onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                                <a class="btn btn-info copy" data-shakhesid="<?php echo  $k ?>" data-toggle="modal" data-target="#copy">کپی و ساخت شاخص جدید</a>





                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Edit -->
<div id="edit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ویرایش </h4>
            </div>
            <div class="modal-body">
                <input id="shakhes_id" type="hidden">
                <div class="col-md-12 col-xs-12 col-sm-12">
                    <label>نام شاخص</label>
                </div>

                <input id="edit-shakhes" value="" class="form-control ">


                <br>
                <div>
                    <label class=" col-md-12 col-xs-12 col-sm-12">هدف کلان</label><br>
                    <select class="edit-kalan">
                        <option  value="null">لطفا یکی را انتخاب نمایید ...</option>
                        <?php foreach ($kalans as $key => $k) : ?>
                            <option value="<?php echo  $k['kalan_no'] ?>"><?php echo  $k['kalan'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div>

                    <label class="col-md-12 col-xs-12 col-sm-12"> فرمول</label>
                    <select class="type">
                        <option class="" value="null">لطفا یکی را انتخاب نمایید ...</option>
                        <option class="select-equal" value="equal" data-sh="<?php echo  $k ?>">تساوی</option>
                        <option class="select-sum" value="sum" data-sh="<?php echo  $k ?>">مجموع</option>
                        <option class="select-divid" value="divid" data-sh="<?php echo  $k ?>">نسبت</option>
                        <option class="select-average" value="average" data-sh="<?php echo  $k ?>">میانگین</option>
                    </select>
                </div>


                <div class="edit-equal">
                    <label class=" col-md-12 col-xs-12 col-sm-12">قلم</label><br>
                    <select class="edit-equal">
                        <option class="" value="null">لطفا یکی را انتخاب نمایید ...</option>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>



                <div class="row edit-sum">
                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                    <select class="edit-sum" multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="edit-divid">

                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام (صورت کسر)</label><br>
                    <select class=" edit-divid-up   " multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>


                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام (مخرج کسر)</label><br>
                    <select class=" edit-divid-down   " multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>


                <div class="row edit-average">
                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                    <select class="edit-average" multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>

                <button type="button" class="btn btn-success edit-submit">ویرایش</button>
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
                <h4 class="modal-title">ساخت شاخص </h4>
            </div>
            <div class="modal-body">
                <input id="shakhes_id" type="hidden">
                <div class="">
                    <label>(لطفا نام شاخص را تغییر دهید) نام شاخص</label>
                </div>
                <input id="copy-shakhes" value="" class="form-control ">
                <br>

                <label class=""> هدف کلان</label>
                <br>
                <select class="type">
                    <option class="select-equal" value="equal" data-sh="<?php echo  $k ?>">تساوی</option>
                    <option class="select-sum" value="sum" data-sh="<?php echo  $k ?>">مجموع</option>
                    <option class="select-divid" value="divid" data-sh="<?php echo  $k ?>">نسبت</option>
                    <option class="select-average" value="average" data-sh="<?php echo  $k ?>">میانگین</option>
                </select>

                <label class=""> فرمول</label>
                <br>
                <select class="type">
                    <option class="select-equal" value="equal" data-sh="<?php echo  $k ?>">تساوی</option>
                    <option class="select-sum" value="sum" data-sh="<?php echo  $k ?>">مجموع</option>
                    <option class="select-divid" value="divid" data-sh="<?php echo  $k ?>">نسبت</option>
                    <option class="select-average" value="average" data-sh="<?php echo  $k ?>">میانگین</option>
                </select>


                <div class="copy-equal">
                    <label class="copy-equal col-md-12 col-xs-12 col-sm-12">قلم</label><br>
                    <select class="copy-equal">
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>



                <div class="row copy-sum">
                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                    <select class="copy-sum" multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="copy-divid">

                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام (صورت کسر)</label><br>
                    <select class=" copy-divid-up   " multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>


                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام (مخرج کسر)</label><br>
                    <select class=" copy-divid-down   " multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>


                <div class="row copy-average">
                    <label class=" col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                    <select class="copy-average" multiple>
                        <?php foreach ($ghalam as $k => $gh) : ?>
                            <option value="<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>

                <button type="button" class="btn btn-success copy-submit">ایجاد</button>
            </div>
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

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <label> هدف کلان</label>
                        <div class="row">
                            <select class="add-kalan col-md-12 col-xs-12 col-sm-12 ">
                                <?php foreach ($kalans as $k => $kalan) : ?>
                                    <option value="$g<?php echo  $kalan['kalan_no'] ?>"><?php echo  $kalan['kalan'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                    </div>



                    <label class="col-md-12 col-xs-12 col-sm-12"> فرمول</label>
                    <br>
                    <select id="add-select-box" class="col-md-6 col-xs-6 col-sm-6 pull-right">
                        <option>نوع عملیات را انتخاب کنید</option>
                        <option value="equal" class="select-equal">تساوی</option>
                        <option value="sum" class="select-sum">مجموع</option>
                        <option value="divid" class="select-divid">نسبت</option>
                        <option value="average" class="select-average">میانگین</option>
                    </select>
                    <div id="add-select-box-error" class="alert alert-danger col-md-6 col-xs-6 col-sm-6" style="padding: 6px 15px; display: none">لطفا یکی را انتخاب نمایید</div>
                    <br>
                    <br>

                    <div class="row">
                        <label class="add-equal col-md-12 col-xs-12 col-sm-12">قلم</label><br>
                        <select class="add-equal col-md-6 col-xs-6 col-sm-6 pull-right">
                            <?php foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="row">
                        <label class="add-sum col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                        <select class="add-sum col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <?php foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="row">
                        <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (صورت کسر)</label><br>
                        <select class="add-divid add-divid-up col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <?php foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <br>
                        <label class="add-divid col-md-12 col-xs-12 col-sm-12">اقلام (مخرج کسر)</label><br>
                        <select class="add-divid add-divid-down col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <?php foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>


                    <div class="row">
                        <label class="add-average col-md-12 col-xs-12 col-sm-12">اقلام</label><br>
                        <select class="add-average col-md-6 col-xs-6 col-sm-6 pull-right" multiple>
                            <?php foreach ($ghalam as $k => $gh) : ?>
                                <option value="$g<?php echo  $gh['ghalam_id'] ?>"><?php echo  $gh['ghalam'] ?></option>
                            <?php endforeach ?>
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

        var shakhes = JSON.parse(`<?php echo  json_encode($shakhes) ?>`);


        /** add form*/
        $("#add .add-equal, #add .add-sum, #add .add-divid, #add .add-average").hide();
        $('#add-select-box').change(function(e) {
            $("#add .add-equal, #add .add-sum, #add .add-divid, #add .add-average").hide();
            $('.add-' + $(this).val()).show();
        });

        $('#add .add-submit').click(function(e) {
            e.preventDefault();
            $('#add #add-select-box-error').hide();

            var type = $('#add-select-box').val();

            if (["equal", "sum", "divid","average"].includes(type)) {
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








        /** copy link  */
        $('#copy').on('show.bs.modal', function(event) {
            var a = $(event.relatedTarget);
            var shakhes_id = a.data('shakhesid');

            var modal = $(this);
            modal.find('#shakhes_id').val(shakhes_id);

            // before has a type 
            if (typeof shakhes[shakhes_id].logic !== 'undefined') {

                var type = shakhes[shakhes_id].logic.type;

                // modal.find('.modal-title').text('ویرایش ' + shakhes[shakhes_id].shakhes);
                modal.find('#copy-shakhes').val(shakhes[shakhes_id].shakhes);

                modal.find('.type').val(type);
                modal.find('.type').trigger('change');


                if (type === 'equal') {
                    modal.find('.copy-equal').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.copy-equal').trigger('change');
                } else if (type === 'sum') {
                    modal.find('.copy-sum').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.copy-sum').trigger('change');
                } else if (type === 'divid') {
                    modal.find('.copy-divid-up').val(shakhes[shakhes_id].logic.ghalams.up);
                    modal.find('.copy-divid-up').trigger('change');

                    modal.find('.copy-divid-down').val(shakhes[shakhes_id].logic.ghalams.down);
                    modal.find('.copy-divid-down').trigger('change');
                } else if($type === 'average'){
                    modal.find('.copy-average').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.copy-average').trigger('change');
                }

            } else {
                modal.find('.copy-sum').hide();
                modal.find('.copy-divid').hide();
                modal.find('.copy-average').hide();
            }

        });
        $('#copy .type').change(function() {

            var type = $(this).val();
            var shakhesId = $(this).parents('.modal').attr('id').replace('copy', '');
            // console.log(type, shakhesId);

            $(this).parents('.modal').find('.copy-equal ,.copy-sum , .copy-divid ,.copy-average ').hide();
            $(this).parents('.modal').find('.copy-' + type).show();


            if (["equal", "sum", "divid","average"].includes(type)) {
                //
            }
        });
        $('#copy .copy-submit').click(function(e) {
            e.preventDefault();
            // $('#copy #edit-select-box-error').hide();
            var modal = $('#edit .modal-body');
            var type = $('#copy').find('.type').val();
            var shakhes = modal.find('#edit-shakhes').val();

            /** انتخاب فرمول */
            var type = modal.find('.type').select2('val');
            if (type === 'null') {
                alert('لطفا فرمول را انتخاب نمایید');
                return false;
            }


            /** انتخاب اقلام */
            if (type === 'equal') {
                var ghalams = modal.find('.edit-equal').select2('val');
                if (ghalams === 'null') {
                    alert('لطفا قلم را انتخاب نمایید');
                    return false;
                }
            } else if (type === 'sum') {
                var ghalams = modal.find('.edit-sum').select2('val').filter(onlyUnique);
                if (Object.keys(ghalams).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

            } else if (type === 'divid') {
                var up = modal.find('.edit-divid-up').select2('val').filter(onlyUnique),
                    down = modal.find('.edit-divid-down').select2('val').filter(onlyUnique);

                if (Object.keys(up).length === 0 || Object.keys(down).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

                var ghalams = {
                    up: up,
                    down: down
                };

            }else if (type === 'average') {
                var ghalams = modal.find('.edit-average').select2('val').filter(onlyUnique);
                if (Object.keys(ghalams).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

            }
            // console.log('ssss ');
            console.log(type, shakhes);


            return false;

            if (["equal", "sum", "divid","average"].includes(type)) {
                $.ajax({
                    url: '/admin/?component=shakhes&action=settingAdd',
                    method: 'post',
                    data: {
                        'type': type,
                        'shakhes': shakhes
                    },
                    success: function(data, status, xhr) {
                        // console.log(data);
                        // window.location = '/?component=shakhes&action=setting'
                    },
                    error: function(data, status, xhr) {
                        console.log(data);
                        alert('مشکلی در سرور بوجود آمده است.');
                    }
                });
            } else {

                //alert('لطفا یکی از توابع را انتخاب نمایید');
                $('#copy #copy-select-box-error').show();
            }
        });
        /** end copy */








        /** edit */
        $('#edit').on('show.bs.modal', function(event) {
            var a = $(event.relatedTarget);
            var shakhes_id = a.data('shakhesid');
            var kalanNo = a.data('kalanno');

            var modal = $(this);
            modal.find('#shakhes_id').val(shakhes_id);

            modal.find('.edit-kalan').val(kalanNo);
            modal.find('.edit-kalan').trigger('change');

            // مقدار دادن به اسم شاخص
            modal.find('#edit-shakhes').val(shakhes[shakhes_id].shakhes);

            if (typeof shakhes[shakhes_id].logic !== 'undefined') {
                // نوعش قبلا انتخاب شده 

                var type = shakhes[shakhes_id].logic.type;

                modal.find('.modal-title').text('ویرایش ' + shakhes[shakhes_id].shakhes);


                modal.find('.type').val(type);
                modal.find('.type').trigger('change');


                if (type === 'equal') {
                    modal.find('.edit-equal').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.edit-equal').trigger('change');
                } else if (type === 'sum') {
                    modal.find('.edit-sum').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.edit-sum').trigger('change');
                } else if (type === 'divid') {
                    modal.find('.edit-divid-up').val(shakhes[shakhes_id].logic.ghalams.up);
                    modal.find('.edit-divid-up').trigger('change');

                    modal.find('.edit-divid-down').val(shakhes[shakhes_id].logic.ghalams.down);
                    modal.find('.edit-divid-down').trigger('change');
                } else if (type === 'average') {
                    modal.find('.edit-average').val(shakhes[shakhes_id].logic.ghalams);
                    modal.find('.edit-average').trigger('change');
                }

            } else {
                modal.find('.edit-sum').hide();
                modal.find('.edit-divid').hide();
                modal.find('.edit-average').hide();
                modal.find('.type').val('null');
                modal.find('.type').trigger('change');
            }




        });

        $('#edit .type').change(function() {

            var type = $(this).val();
            var shakhesId = $(this).parents('.modal').attr('id').replace('edit', '');
            // console.log(type, shakhesId);

            $(this).parents('.modal').find('.edit-equal ,.edit-sum , .edit-divid , .edit-average').hide();
            $(this).parents('.modal').find('.edit-' + type).show();


            if (["equal", "sum", "divid", "average"].includes(type)) {
                //
            }
        });

        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        $('#edit .edit-submit').click(function(e) {
            e.preventDefault();
            $('#edit #edit-select-box-error').hide();
            var modal = $('#edit .modal-body');
            var shakhes_id = modal.find('#shakhes_id').val();
            var shakhes = modal.find('#edit-shakhes').val();
            var kalanNo = modal.find('.edit-kalan').select2('val');
            if (kalanNo === 'null') {
                alert('لطفا هدف کلان را انتخاب نمایید');
                return false;
            }

            /** انتخاب فرمول */
            var type = modal.find('.type').select2('val');
            if (type === 'null') {
                alert('لطفا فرمول را انتخاب نمایید');
                return false;
            }


            /** انتخاب اقلام */
            if (type === 'equal') {
                var ghalams = modal.find('.edit-equal').select2('val');
                if (ghalams === 'null') {
                    alert('لطفا قلم را انتخاب نمایید');
                    return false;
                }
            } else if (type === 'sum') {
                var ghalams = modal.find('.edit-sum').select2('val').filter(onlyUnique);
                if (Object.keys(ghalams).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

            } else if (type === 'divid') {
                var up = modal.find('.edit-divid-up').select2('val').filter(onlyUnique),
                    down = modal.find('.edit-divid-down').select2('val').filter(onlyUnique);

                if (Object.keys(up).length === 0 || Object.keys(down).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

                var ghalams = {
                    up: up,
                    down: down
                };

            } else if (type === 'average') {
                var ghalams = modal.find('.edit-average').select2('val').filter(onlyUnique);
                if (Object.keys(ghalams).length === 0) {
                    alert('لطفا اقلام را انتخاب نمایید');
                    return false;
                }

            }

            // console.log(shakhes_id, shakhes, type, ghalams);

            /** ارسال به فایل shakhes.controler  */
            $.ajax({
                url: '/admin/?component=shakhes&action=settingEdit',
                method: 'post',
                data: {
                    'type': type,
                    'shakhes_id': shakhes_id,
                    'shakhes': shakhes,
                    'kalan_no':kalanNo,
                    'ghalams': ghalams
                },
                success: function(data, status, xhr) {
                    // console.log(data);
                    window.location = '/admin/?component=shakhes&action=setting'
                },
                error: function(data, status, xhr) {
                    alert('مشکلی در سرور بوجود آمده است.');
                }
            });

        });
        /** end edit */

    });
</script>