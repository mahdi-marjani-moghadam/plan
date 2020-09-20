<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم جلب همکاری با دانش آموختگان و دانشجویان</h3>
        </div>
        <div class="panel-body">

            <? 
            if($msg){
                echo $msg;
            }
            ?>
            
            <div class="alert alert-warning">زمان اتمام: <?=convertDate($this->time['finish_date'])?></div>
            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte" method="post">
                <table class="form">
                    <tr>
                        <td>واحد*</td>
                        <td >
                            <select style="display: block" name="admin_id">
                                <option value="<?=$admin_info['admin_id']?>"> خودم</option>
                                <? foreach($this->selectBoxAdmins as $admin):?>
                                    <option <?= ($data['admin_id'] === $admin['admin_id']) ? 'selected' : '' ?> value="<?= $admin['admin_id'] ?>"><?= $admin['name'].' ',$admin['family'] ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>دانشجو/دانش آموخته*</td>
                        <td><select name="student_status">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['daneshamukhte']['student_status'] as $item):?>
                                    <option <?= ($data['student_status'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select></td>

                        <td>نام و نام خانوادگی*</td>
                        <td><input name="name_family" value="<?= $data['name_family'] ?>" class="form-control"></td>

                        <td>تاریخ فارغ التحصیلی</td>
                        <td><input name="graduated_date" value="<?= $data['graduated_date'] ?>" autocomplete="off" class="form-control date"></td>
                    </tr>
                    <tr>
                        <td>مقطع*</td>
                        <td>
                            <select name="grade">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['daneshamukhte']['grade'] as $item):?>
                                    <option <?= ($data['grade'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                        <td>رشته*</td>
                        <td><input name="course" class="form-control" value="<?= $data['course'] ?>"></td>

                        <td>نوع ارتباط/همکاری با دانشگاه</td>
                        <td>
                            <select name="relation_type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['daneshamukhte']['relation_type'] as $item):?>
                                <option <?= ($data['relation_type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>وضعیت اشتغال*</td>
                        <td>
                            <select name="employed_status">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['daneshamukhte']['employed_status'] as $item):?>
                                    <option <?= ($data['employed_status'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                        <td>نام سازمان مشغول به کار*</td>
                        <td><input name="organ_name" value="<?= $data['organ_name'] ?>" class="form-control"></td>

                        <td>پست سازمانی</td>
                        <td><input name="organ_position" value="<?= $data['organ_position'] ?>" class="form-control"></td>

                    </tr>
                    <tr>
                        <td>وضعیت ادامه تحصیل*</td>
                        <td>
                            <select name="continue_education">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['daneshamukhte']['continue_education'] as $item):?>
                                    <option <?= ($data['continue_education'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                        <td>نام دانشگاه مقطع بالاتر</td>
                        <td><input name="continue_university" value="<?= $data['continue_university'] ?>" class="form-control"></td>

                        <td>افتخارات و موفقیت‌ها</td>
                        <td><input name="successes" value="<?= $data['successes'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>توضیحات</td>
                        <td colspan="5"><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                
            </form>
            
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست دانش آموختگان</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>دانشجو/دانش آموخته</th>
                    <th>نام و نام خانوادگی</th>
                    <th>تاریخ فارغ التحصیلی</th>
                    <th>مقطع</th>
                    <th>رشته</th>
                    <th>نوع ارتباط/همکاری با دانشگاه</th>
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
                        $v['confirm1'] = $this->permissions[$v['admin_id']]['confirm1'];
                        $v['confirm2'] = $this->permissions[$v['admin_id']]['confirm2'];

                        $v['name'] = $this->admins[$v['admin_id']]['name'];
                        $v['family'] = $this->admins[$v['admin_id']]['family'];

                ?>
                        <tr>
                            <td><?= $v['name'].' '.$v['family'] ?></td>
                            <td><?= $v['student_status'] ?></td>
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
                            <td><?= readMore($v['tozihat'],10) ?></td>
                            <td>
                                <?php if ($this->time['import_time'] == 1): ?>
                                    <? if( in_array($admin_info['admin_id'], [$v['import_admin'],$v['admin_id']]) ):?>

                                        <? if(($v['status'] == 0 || $v['status'] == 1) ):  ?>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte" method="post">
                                            <button name="sendToParent" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')"
                                                    class="btn btn-xs btn-block btn-success pull-right">ارسال به مافوق</button>
                                        </form>
                                        <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte&method=delete&id=<?= $v['id'] ?>"
                                        class="btn btn-xs btn-block btn-danger pull-right" onclick="return confirm('آیا برای حذف مطمئن هستید؟')">حذف</a>
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
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte&edit" method="post">
                                        <button name="edit" value="<?= $v['id'] ?>" onclick="confirm('مطمئن هستید که نیازمند اصلاح می باشد؟')"
                                                class="btn btn-block btn-xs btn-warning pull-right">نیازمند اصلاح</button>
                                    </form>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte&confirm" method="post">
                                        <button name="confirm"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تائید مطمئن هستید؟')"
                                                class="btn btn-xs btn-block btn-success pull-right">تائید</button>
                                    </form>
                                    <? else:?>
                                        <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                        <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                    <? endif;?>
                                <? endif;?>

                                        
                                <? if($admin_info['admin_id'] == $v['confirm2']):?>
                                
                                    <? if($v['status'] == 3):?>
                                    <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=daneshamukhte&confirmFinal" method="post">
                                        <button name="confirmFinal"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تائید مطمئن هستید؟')"
                                                class="btn btn-xs btn-success pull-right">تائید نهایی</button>
                                    </form>

                                    <? else:?>
                                        <?= ($v['status'] == 1) ? 'هنوز اطلاعاتی وارد نشده' : '' ?>
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
