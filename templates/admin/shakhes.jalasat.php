<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم برگزاری جلسات و نشست ها</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger"> این فرم شامل جلسات و نشست های برگزار شده با دانشجویان یا دانش‌آموختگان نظیر: برگزاری جلسات توجیهی برای دانشجویان تحصیلات تکمیلی درباره شیوه نامه و دستورالعمل پایان نامه‏ ها، برگزاری نشست با دانش آموختگان، برگزاری جلسات سمینار برای دانشجویان دکتری با هدف رصد وضعیت پیشرفت رساله می باشد.</div>
            <?php if ($msg) {
                echo $msg;
            }
            ?>

            <div class="alert alert-warning">تاریخ اتمام بازه تکمیل فرم: <?php echo convertDate($this->time['finish_date']) ?></div>
            <form action="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                <table class="form">
                    <tr>
                        <td>واحد</td>
                        <td>
                            <select style="display: block" name="admin_id">
                                <?php if (count(array_keys(array_column($this->selectBoxAdmins, 'admin_id'), $admin_info['admin_id'])) == 1) : ?>
                                    <option value="<?php echo $admin_info['admin_id'] ?>"> خودم</option>
                                <?php endif; ?>
                                <?php foreach ($this->selectBoxAdmins as $admin) : ?>
                                    <option <?php echo ($data['admin_id'] === $admin['admin_id']) ? 'selected' : '' ?> value="<?php echo  $admin['admin_id'] ?>"><?php echo  $admin['name'] . ' ', $admin['family'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>جلسه*</td>
                        <td>
                            <select name="session">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($this->options['jalasat']['session'] as $item) : ?>
                                    <option <?php echo ($data['session'] === $item) ? 'selected' : '' ?> value="<?php echo  $item ?>"><?php echo  $item ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>زمان برگزاری*</td>
                        <td><input name="date" value="<?php echo  $data['date'] ?>" autocomplete="off" class="form-control date"></td>

                        <td>سمت اعضای هیات رئیسه حاضر در جلسه*</td>
                        <td><input name="manager_list" value="<?php echo  $data['manager_list'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>تعداد شرکت کنندگان*</td>
                        <td><input name="member_count" value="<?php echo  $data['member_count'] ?>" type="number" min="1" max="99999" class="form-control"></td>

                        <td>مقطع*</td>
                        <td>
                            <select name="grade">
                                <option value="">انتخاب کنید</option>
                                <?php foreach ($this->options['jalasat']['grade'] as $item) : ?>
                                    <option <?php echo ($data['grade'] === $item) ? 'selected' : '' ?> value="<?php echo  $item ?>"><?php echo  $item ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>رشته*</td>
                        <td><input name="course" class="form-control" value="<?php echo  $data['course'] ?>"></td>

                        <td>تعداد کل دانشجویان مشمول*</td>
                        <td><input name="eligible_students" type="number" min="1" max="99999" class="form-control" value="<?php echo  $data['eligible_students'] ?>"></td>
                    </tr>
                    <tr>
                        <td>رئوس موضوعات طرح شده در جلسه*</td>
                        <td><input name="subject" class="form-control" value="<?php echo  $data['subject'] ?>"></td>
                    </tr>

                </table>
                <?php if (isset($_GET['id']) && is_numeric($_GET['id'])) : ?>
                    <div style="display: flex; justify-content: center; ">
                        <div class="col-md-3">
                            <button name="edit" style="font-size:1.3em" value="<?php echo $_GET['id'] ?>" class="btn btn-info btn-large btn-block"> ویرایش</button>
                        </div>
                    </div>
                <?php else : ?>
                    <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <?php endif; ?>
            </form>

        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست جلسات</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>جلسه</th>
                    <th>زمان برگزاری</th>
                    <th>اعضای هیات رئیسه حاضر در جلسه</th>
                    <th>تعداد شرکت کنندگان</th>
                    <th>مقطع</th>
                    <th>رشته</th>
                    <th>تعداد کل دانشجویان مشمول</th>
                    <th>رئوس موضوعات طرح شده در جلسه</th>
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
                            <td><?php echo  $v['name'] . ' ' . $v['family'] ?></td>
                            <td><?php echo  ReadMore($v['session'], 20) ?></td>
                            <td><?php echo  convertDate($v['date']) ?></td>
                            <td><?php echo  ReadMore($v['manager_list'], 20) ?></td>
                            <td><?php echo  $v['member_count'] ?></td>
                            <td><?php echo  $v['grade'] ?></td>
                            <td><?php echo  ReadMore($v['course'], 20) ?></td>
                            <td><?php echo  $v['eligible_students'] ?></td>
                            <td><?php echo  ReadMore($v['subject'], 20) ?></td>
                            <td>
                                <?php if ($this->time['import_time'] == 1) : ?>

                                    <?php if (in_array($admin_info['admin_id'], [$v['import_admin']])) : ?>

                                        <?php if (($v['status'] == 0 || $v['status'] == 1)) :  ?>
                                            <form action="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                                                <button name="sendToParent" value="<?php echo  $v['id'] ?>" onclick="return confirm('آیا از ارسال به مافوق مطمئن هستید؟')" class="btn btn-xs btn-block btn-success pull-right">ارسال به مافوق</button>
                                            </form>
                                            <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat&method=delete&id=<?php echo  $v['id'] ?>" class="btn btn-xs btn-block btn-danger pull-right" onclick="return confirm('آیا برای حذف مطمئن هستید؟')">حذف</a>
                                            <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat&id=<?php echo  $v['id'] ?>" class="btn btn-xs btn-block btn-info pull-right" onclick="return confirm('آیا برای ویرایش مطمئن هستید؟')">ویرایش</a>
                                        <?php else : ?>
                                            <?php echo ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?php echo ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?php echo ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <?php endif; ?>
                                        <?php else :
                                        if (($v['status'] == 0 || $v['status'] == 1)) : ?>
                                            در حال ورود اطلاعات
                                            <?/* else:*/ ?>
                                            <!--
                                            <?/*= ($v['status'] == 2) ? 'ارسال به مافوق' : '' */ ?>
                                            <?/*= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' */ ?>
                                            --><?/*= ($v['status'] == 4) ? 'تایید نهایی ' : '' */ ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($this->time['import_time'] == 1) : ?>
                                    <?php if ($admin_info['admin_id'] == $importAdmins['confirms'][$v['admin_id']]['confirm1']) : ?>
                                        <?php if ($v['status'] == 2) : ?>
                                            <form action="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat&sendToEdit" method="post">
                                                <button name="sendToEdit" value="<?php echo  $v['id'] ?>" onclick="return confirm('مطمئن هستید که نیازمند اصلاح می باشد؟')" class="btn btn-block btn-xs btn-warning pull-right">نیازمند اصلاح</button>
                                            </form>
                                            <form action="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat&confirm" method="post">
                                                <button name="confirm" value="<?php echo  $v['id'] ?>" onclick="return confirm('آیا از تایید مطمئن هستید؟')" class="btn btn-xs btn-block btn-success pull-right">تایید</button>
                                            </form>
                                        <?php else : ?>
                                            <?php echo ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?php echo ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <?php if ($admin_info['admin_id'] == $importAdmins['confirms'][$v['admin_id']]['confirm2']) : ?>
                                        <?php if ($v['status'] == 3) : ?>
                                            <form action="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=jalasat&confirmFinal" method="post">
                                                <button name="confirmFinal" value="<?php echo  $v['id'] ?>" onclick="return confirm('آیا از تایید مطمئن هستید؟')" class="btn btn-xs btn-success pull-right">تایید نهایی</button>
                                            </form>

                                        <?php else : ?>
                                            <?php echo ($v['status'] == 1) ? '' : '' ?>
                                            <?php echo ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?php echo ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                <?php endif; ?>
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
    $(document).ready(function() {
        $('.readMore').click(function(e) {
            e.preventDefault();
            $('myModal').modal('hide');

            var text = $(this).data("text");
            //alert(text);
            $('#myModal .modal-body').html("<p>" + nl2br(text) + "</p>");
            $('#myModal').modal('show');
        })
    });

    function nl2br(str, replaceMode, isXhtml) {

        var breakTag = (isXhtml) ? '<br />' : '<br>';
        var replaceStr = (replaceMode) ? '$1' + breakTag : '$1' + breakTag + '$2';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
    }
</script>