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

            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                <table class="form">
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
                                <? foreach($options['grade'] as $item):?>
                                <option <?= ($data['grade'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>رشته*</td>
                        <td><input name="course" class="form-control"></td>

                        <td>تعداد کل دانشجویان مشمول*</td>
                        <td><input name="eligible_students" type="number" min="1" max="99999" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>رئوس موضوعات طرح شده در جلسه*</td>
                        <td><input name="subject" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <button name="final" value="2" class="btn btn-success btn-large"> ارسال به مافوق</button>
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
                ?>
                        <tr>
                            <td><?= $v['admin_id'] ?></td>
                            <td><?= convertDate($v['date']) ?></td>
                            <td><?= $v['manager_list'] ?></td>
                            <td><?= $v['member_count'] ?></td>
                            <td><?= $v['grade'] ?></td>
                            <td><?= $v['course'] ?></td>
                            <td><?= $v['eligible_students'] ?></td>
                            <td><?= $v['subject'] ?></td>
                            <td>
                                <?= ($v['status'] == 0) ? '' : 'ارسال به مافوق' ?>
                                <? if($v['status'] == 0):  ?>
                                <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat" method="post">
                                    <button name="confirm" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')" class="btn btn-xs btn-success pull-right">ارسال به مافوق</button>
                                </form>
                                    <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=jalasat&method=delete&id=<?= $v['id'] ?>" class="btn btn-danger " onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>

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
