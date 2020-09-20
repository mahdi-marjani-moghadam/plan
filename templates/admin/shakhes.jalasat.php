<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl ">  فرم برگزاری جلسات توجیهی تحصیلات تکمیلی</h3>
        </div>
        <div class="panel-body">

            <? 
            if($msg){
                echo $msg;
            }
            ?>

            <div class="alert alert-warning">زمان اتمام: <?=convertDate($this->time['finish_date'])?></div>
            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                <table class="form">
                    <tr>
                        <td>واحد*</td>
                        <td colspan="3">
                            <select style="display: block" name="admin_id">
                                <option value="<?=$admin_info['admin_id']?>"> خودم</option>
                                <? foreach($this->selectBoxAdmins as $admin):?>
                                    <option <?= ($data['admin_id'] === $admin['admin_id']) ? 'selected' : '' ?> value="<?= $admin['admin_id'] ?>"><?= $admin['name'].' ',$admin['family'] ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>زمان برگزاری*</td>
                        <td><input name="date" value="<?= $data['date'] ?>" autocomplete="off" class="form-control date"></td>

                        <td>اعضای هیات رئیسه حاضر در جلسه*</td>
                        <td><input name="manager_list" value="<?= $data['manager_list'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>تعداد شرکت کنندگان*</td>
                        <td><input name="member_count" value="<?= $data['member_count'] ?>" type="number" min="1" max="99999" class="form-control"></td>

                        <td>مقطع*</td>
                        <td>
                            <select name="grade">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['jalasat']['grade'] as $item):?>
                                <option <?= ($data['grade'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>رشته*</td>
                        <td><input name="course"  class="form-control" value="<?= $data['course'] ?>"></td>

                        <td>تعداد کل دانشجویان مشمول*</td>
                        <td><input name="eligible_students" type="number" min="1" max="99999" class="form-control" value="<?= $data['eligible_students'] ?>"></td>
                    </tr>
                    <tr>
                        <td>رئوس موضوعات طرح شده در جلسه*</td>
                        <td><input name="subject" class="form-control" value="<?= $data['subject'] ?>"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
            </form>
            
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست جلسات</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>زمان برگزاری</th>
                    <th>اعضای هیات رئیسه حاضر در جلسه</th>
                    <th>تعداد شرکت کنندگان*</th>
                    <th>مقطع</th>
                    <th>رشته</th>
                    <th>تعداد کل دانشجویان مشمول</th>
                    <th>رئوس موضوعات طرح شده در جلسه*</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($jalasat['recordsCount'] > 0) :
                    foreach ($jalasat['list'] as $v) :
                        $v['confirm1'] = $this->permissions[$v['admin_id']]['confirm1'];
                        $v['confirm2'] = $this->permissions[$v['admin_id']]['confirm2'];

                        $v['name'] = $this->admins[$v['admin_id']]['name'];
                        $v['family'] = $this->admins[$v['admin_id']]['family'];
                ?>
                        <tr>
                            <td><?= $v['name'].' '.$v['family'] ?></td>
                            <td><?= convertDate($v['date']) ?></td>
                            <td><?= $v['manager_list'] ?></td>
                            <td><?= $v['member_count'] ?></td>
                            <td><?= $v['grade'] ?></td>
                            <td><?= $v['course'] ?></td>
                            <td><?= $v['eligible_students'] ?></td>
                            <td><?= $v['subject'] ?></td>
                            <td>
                                <?php if ($this->time['import_time'] == 1): ?>

                                    <? if( in_array($admin_info['admin_id'], [$v['import_admin']]) ):?>

                                        <? if(($v['status'] == 0 || $v['status'] == 1) ):  ?>
                                            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                                                <button name="sendToParent" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')"
                                                        class="btn btn-xs btn-block btn-success pull-right">ارسال به مافوق</button>
                                            </form>
                                            <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat&method=delete&id=<?= $v['id'] ?>"
                                               class="btn btn-xs btn-block btn-danger pull-right" onclick="return confirm('آیا برای حذف مطمئن هستید؟')">حذف</a>
                                        <? else:?>
                                            <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>

                                        <? endif;?>
                                    <? else:
                                        if(($v['status'] == 0 || $v['status'] == 1)):?>
                                            در حال ورود اطلاعات
                                        <? else:?>
                                            <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <? endif;?>
                                    <? endif;?>
                                <? endif;?>

                                <?php if ($this->time['confirm_time'] == 1): ?>
                                    <? if($admin_info['admin_id'] == $v['confirm1']):?>
                                        <? if($v['status'] == 2 ):?>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat&edit" method="post">
                                            <button name="edit" value="<?= $v['id'] ?>" onclick="confirm('مطمئن هستید که نیازمند اصلاح می باشد؟')"
                                                    class="btn btn-block btn-xs btn-warning pull-right">نیازمند اصلاح</button>
                                        </form>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat&confirm" method="post">
                                            <button name="confirm"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تایید مطمئن هستید؟')"
                                                    class="btn btn-xs btn-block btn-success pull-right">تایید</button>
                                        </form>
                                        <? else:?>
                                            <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <? endif;?>
                                    <? endif;?>


                                    <? if($admin_info['admin_id'] == $v['confirm2']):?>
                                        <? if($v['status'] == 3):?>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat&confirmFinal" method="post">
                                            <button name="confirmFinal"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تایید مطمئن هستید؟')"
                                                    class="btn btn-xs btn-success pull-right">تایید نهایی</button>
                                        </form>

                                        <? else:?>
                                            <?= ($v['status'] == 1) ? 'تاکنون اطلاعاتی وارد نشده' : '' ?>
                                            <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <? endif;?>
                                    <? endif;?>
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
