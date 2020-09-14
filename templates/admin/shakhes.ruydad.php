<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم رویدادهای برگزار شده</h3>
        </div>
        <div class="panel-body">

            <? 
            if($msg){
                echo $msg;
            }
            ?>

            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad" method="post">
                <table class="form">
                    <tr>
                        <td>نوع رویداد*</td>
                        <td>
                            <select name="type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['type'] as $item):?>
                                <option <?= ($data['type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>هدف استراتژیک*</td>
                        <td>
                            <select name="amaliati_no">
                                <option value="">انتخاب کنید</option>
                                <?/* foreach($amaliati as $amaliati_no => $amaliati):*/?><!--
                                <option <?/*= ($data['amaliati_no'] === $amaliati_no) ? 'selected' : '' */?> value="<?/*= $amaliati_no */?>"><?/*= $amaliati */?></option>
                                --><?/*endforeach;*/?>
                                <? foreach($options['amaliati_no'] as $item):?>
                                    <option <?= ($data['amaliati_no'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>

                            </select>
                        </td>

                        <td>عنوان رویداد*</td>
                        <td><input name="title" value="<?= $data['title'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ابتدای دوره*</td>
                        <td><input name="startdate" value="<?= ($data['startdate']) ?>" autocomplete="off" class="form-control date"></td>

                        <td>انتهای دوره*</td>
                        <td><input name="finishdate" value="<?= ($data['finishdate']) ?>" autocomplete="off" class="form-control date"></td>

                        <td>مدت زمان برگزاری (ساعت)*</td>
                        <td><input name="time" type="number" value="<?= $data['time'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ملی/بین المللی*</td>
                        <td>
                            <select name="nationality">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['nationality'] as $item):?>
                                <option <?= ($data['nationality'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>عنوان مخاطب</td>
                        <td>
                            <select name="member_type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['member_type'] as $item):?>
                                <option <?= ($data['member_type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>تعداد مخاطب</td>
                        <td><input name="member_no" type="number" min="0" value="<?= $data['member_no'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>مجری/برگزار کننده اصلی*</td>
                        <td>
                            <select name="main_executor">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['main_executor'] as $item):?>
                                <option <?= ($data['main_executor'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>برگزار کننده همکار(دانشگاه/سازمان /انجمن علمی دانشجویی)</td>
                        <td><input name="sub_executor" value="<?= $data['sub_executor'] ?>" class="form-control"></td>

                        <td>نحوه برگزاری*</td>
                        <td>
                            <select name="execute_type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($options['execute_type'] as $item):?>
                                <option <?= ($data['execute_type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>محل برگزاری</td>
                        <td><input name="salon" value="<?= $data['salon'] ?>" class="form-control"></td>

                        <td>مبلغ هزینه شده*</td>
                        <td><input name="cost" type="number" min="0" value="<?= $data['cost'] ?>" class="form-control"></td>

                        <td>درآمد کسب شده*</td>
                        <td><input name="income" type="number" min="0" value="<?= $data['income'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>لینک رویداد بر روی سایت*</td>
                        <td><input name="website_link" value="<?= $data['website_link'] ?>" class="form-control"></td>

                        <td> عنوان حامی </td>
                        <td><input name="hami_type" value="<?= $data['hami_type'] ?>" class="form-control"></td>

                        <td> مبلغ حمایت جذب شده (ریال)</td>
                        <td><input name="hami_income" type="number" min="0" value="<?= $data['hami_income'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>توضیحات</td>
                        <td colspan="5"><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <button name="final" value="2" class="btn btn-success btn-large"> ارسال به مافوق</button>
            </form>
        </div>
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> لیست رویداد</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <tr>
                    <th>واحد</th>
                    <th>نوع رویداد</th>
                    <th>هدف استراتژیک</th>
                    <th>عنوان رویداد</th>
                    <th>ابتدای دوره</th>
                    <th>انتهای دوره</th>
                    <th>مدت زمان برگزاری (ساعت)</th>
                    <th>ملی/بین المللی</th>
                    <th>عنوان مخاطب</th>
                    <th>تعداد مخاطب</th>
                    <th>مجری/برگزار کننده اصلی</th>
                    <th>برگزار کننده همکار(دانشگاه/سازمان /انجمن علمی دانشجویی)</th>
                    <th>نحوه برگزاری</th>
                    <th>محل برگزاری</th>
                    <th>مبلغ هزینه شده</th>
                    <th>درآمد کسب شده</th>
                    <th>لینک رویداد بر روی سایت</th>
                    <th> عنوان حامی </th>
                    <th> مبلغ حمایت جذب شده (ریال)</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($ruydad['recordsCount'] > 0) :
                    foreach ($ruydad['list'] as $v) :
                ?>
                        <tr>
                            <td><?= $v['admin_id'] ?></td>
                            <td><?= $v['type'] ?></td>
                            <td><?= $v['amaliati_no'] ?></td>
                            <td><?= $v['title'] ?></td>
                            <td><?= convertDate($v['startdate']) ?></td>
                            <td><?= convertDate($v['finishdate']) ?></td>
                            <td><?= $v['time'] ?></td>
                            <td><?= $v['nationality'] ?></td>
                            <td><?= $v['member_type'] ?></td>
                            <td><?= $v['member_no'] ?></td>
                            <td><?= $v['main_executor'] ?></td>
                            <td><?= $v['sub_executor'] ?></td>
                            <td><?= $v['execute_type'] ?></td>
                            <td><?= $v['salon'] ?></td>
                            <td><?= $v['cost'] ?></td>
                            <td><?= $v['income'] ?></td>
                            <td><?= $v['website_link'] ?></td>
                            <td><?= $v['hami_type'] ?></td>
                            <td><?= $v['hami_income'] ?></td>
                            <td><?= readMore($v['tozihat'],10) ?></td>

                            <td>
                                <?= ($v['status'] == 0) ? '' : 'ارسال به مافوق' ?>
                                <? if($v['status'] == 0):  ?>
                                <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad" method="post">
                                    <button name="confirm" value="<?= $v['id'] ?>" onclick="confirm('آیا از ارسال به مافوق مطمئن هستید؟')" class="btn btn-xs btn-success pull-right">ارسال به مافوق</button>
                                </form>
                                    <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad&method=delete&id=<?= $v['id'] ?>" class="btn btn-danger " onclick="return confirm('آیا مطمئن هستید؟')">حذف</a>

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
                <h4 class="modal-title">توضیحات</h4>
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
