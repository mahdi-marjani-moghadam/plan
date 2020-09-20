<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم عضویت در شوراها و کمیته های برون دانشگاهی</h3>
        </div>
        <div class="panel-body">

            <?php
            if ($msg) {
                echo $msg;
            }
            ?>
            <?php if ($this->time['import_time'] == 1): ?>
            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora" method="post">
                <table class="form">
                    <tr>
                        <td>واحد*</td>
                        <td colspan="1">
                            <select style="display: block" name="admin_id">
                                <option value="<?=$admin_info['admin_id']?>"> خودم</option>
                                <?php foreach ($this->selectBoxAdmins as $admin):?>
                                    <option <?= ($data['admin_id'] === $admin['admin_id']) ? 'selected' : '' ?> value="<?= $admin['admin_id'] ?>"><?= $admin['name'].' ',$admin['family'] ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
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
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($this->options['shora']['nationality'] as $item):?>
                                <option <?= ($data['nationality'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>سمت/پست*</td>
                        <td>
                            <select name="position">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($this->options['shora']['position'] as $item):?>
                                <option <?= ($data['position'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>درج عضویت در صفحه شخصی سایت*</td>
                        <td>
                            <select name="personal_page">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($this->options['shora']['personal_page'] as $item):?>
                                <option <?= ($data['personal_page'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>توضیحات</td>
                        <td><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                
            </form>
            <?php endif;?>
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
                    <th>درج عضویت در صفحه شخصی سایت</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($shora['recordsCount'] > 0) :
                    foreach ($shora['list'] as $v) :
                        
                        $v['confirm1'] = $this->permissions[$v['admin_id']]['confirm1'];
                        $v['confirm2'] = $this->permissions[$v['admin_id']]['confirm2'];
                        
                        $v['name'] = $this->admins[$v['admin_id']]['name'];
                        $v['family'] = $this->admins[$v['admin_id']]['family'];

                ?>

                        <tr>
                            <td><?= $v['name'].' '.$v['family'] ?></td>
                            <td><?= $v['shora_type'] ?></td>
                            <td><?= $v['name_family'] ?></td>
                            <td><?= convertDate($v['start_date']) ?></td>
                            <td><?= convertDate($v['finish_date']) ?></td>
                            <td><?= $v['nationality'] ?></td>
                            <td><?= $v['position'] ?></td>
                            <td><?= $v['personal_page'] ?></td>
                            <td><?= readMore($v['tozihat'], 10) ?></td>
                            <td>
                                <?php if (in_array($admin_info['admin_id'], [$v['import_admin'],$v['admin_id']])):?>
                                    <?php if (($v['status'] == 0 || $v['status'] == 1)):  ?>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora" method="post">
                                        <button name="sendToParent" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')"
                                                class="btn btn-xs btn-block btn-success pull-right">ارسال به مافوق</button>
                                    </form>
                                    <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=shora&method=delete&id=<?= $v['id'] ?>"
                                       class="btn btn-xs btn-block btn-danger pull-right" onclick="return confirm('آیا برای حذف مطمئن هستید؟')">حذف</a>
                                    <?php else:?>
                                        <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                        <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                        <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                    <?php endif;?>
                                <?php endif;?>

                                <?php if ($admin_info['admin_id'] == $v['confirm1']):?>
                                    <?php if ($v['status'] == 2):?>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora&edit" method="post">
                                        <button name="edit" value="<?= $v['id'] ?>" onclick="confirm('مطمئن هستید که نیازمند اصلاح می باشد؟')"
                                                class="btn btn-block btn-xs btn-warning pull-right">نیازمند اصلاح</button>
                                    </form>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora&confirm" method="post">
                                        <button name="confirm"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تائید مطمئن هستید؟')"
                                                class="btn btn-xs btn-block btn-success pull-right">تائید</button>
                                    </form>
                                    <?php else:?>
                                        <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                        <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                    <?php endif;?>
                                <?php endif;?>


                                <?php if ($admin_info['admin_id'] == $v['confirm2']):?>
                                    <?php if ($v['status'] == 3):?>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=shora&confirmFinal" method="post">
                                        <button name="confirmFinal"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تائید مطمئن هستید؟')"
                                                class="btn btn-xs btn-success pull-right">تائید نهایی</button>
                                    </form>

                                    <?php else:?>
                                        <?= ($v['status'] == 1) ? 'هنوز اطلاعاتی وارد نشده' : '' ?>
                                        <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                        <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                    <?php endif;?>
                                <?php endif;?>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">تحلیل</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('.readMore').click(function (e) {
            e.preventDefault();
            $('myModal').modal('hide');

            var text = $(this).data("text");
            //alert(text);
            $('#myModal .modal-body').html("<p>" + nl2br(text) + "</p>");
            $('#myModal').modal('show');
        })
    });

    function nl2br (str, replaceMode, isXhtml) {

        var breakTag = (isXhtml) ? '<br />' : '<br>';
        var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
    }
</script>
