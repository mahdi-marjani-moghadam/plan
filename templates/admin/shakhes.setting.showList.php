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
                        <td>فرمول</td>
                        <td></td>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($shakhes as $k => $sh) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $sh['shakhes'] ?></td>
                            <td dir="ltr"><?= $sh['logic']['function'] ?></td>
                            <td>
                                <a class="btn btn-warning " data-toggle="modal" data-target="#edit<?= $k ?>">ویرایش</a>
                                <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=delete&id=<?= $sh['id'] ?>" class="btn btn-danger " onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>
                                <a class="btn btn-info " data-toggle="modal" data-target="#edit<?= $k ?>">کپی و ساخت شاخص جدید</a>


                                <!-- Edit -->
                                <div id="edit<?= $k ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">ویرایش</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p><?= $sh['shakhes'] ?></p>

                                                <select class="">
                                                    <option class="select-equal" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'equal') ? 'selected' : '' ?>>Equal</option>
                                                    <option class="select-sum" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'sum') ? 'selected' : '' ?>>Sum</option>
                                                    <option class="select-divid" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'divid') ? 'selected' : '' ?>>Divid</option>
                                                </select>
                                                <br>
                                                <br>
                                                <?php if ($sh['logic']['type'] == 'equal') : ?>
                                                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['function'] ?>">
                                                <?php endif; ?>

                                                <?php if ($sh['logic']['type'] == 'sum') : ?>
                                                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['function'] ?>">
                                                <?php endif; ?>

                                                <?php if ($sh['logic']['type'] == 'divid') : ?>
                                                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['up'] ?>">
                                                    <br>
                                                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['down'] ?>">
                                                <?php endif; ?>




                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">تایید</button>
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


<!-- Add -->
<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ویرایش</h4>
            </div>
            <div class="modal-body">
                <p><?= $sh['shakhes'] ?></p>

                <select id="add-select-box" class="">
                    <option></option>
                    <option value="equal" class="select-equal" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'equal') ? 'selected' : '' ?>>Equal</option>
                    <option value="sum" class="select-sum" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'sum') ? 'selected' : '' ?>>Sum</option>
                    <option value="divid" class="select-divid" data-sh="<?= $k ?>" <?= ($sh['logic']['type'] == 'divid') ? 'selected' : '' ?>>Divid</option>
                </select>
                <br>
                <br>
                <?php if ($sh['logic']['type'] == 'equal') : ?>
                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['function'] ?>">
                <?php endif; ?>

                <?php if ($sh['logic']['type'] == 'sum') : ?>
                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['function'] ?>">
                <?php endif; ?>

                <?php if ($sh['logic']['type'] == 'divid') : ?>
                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['up'] ?>">
                    <br>
                    <input class="form-control" style="font-family: Verdana" dir='ltr' value="<?= $sh['logic']['down'] ?>">
                <?php endif; ?>

                <script>
                    $('#add-select-box').change(function(e){
                        alert($(this).val());
                    });
                </script>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">تایید</button>
            </div>
        </div>

    </div>
</div>

<script>
    $('.select-equal').click(function(e) {
        alert(1);
    });
    $('.select-sum').click(function(e) {
        alert(2);
    });
    $('.select-divid').click(function(e) {
        alert(3);
    });
</script>