<div class="row smallSpace"></div>
<div class="content-body">
    <div id="panel-1" class="panel panel-default border-green">
        <div class="panel-heading bg-green">
            <h3 class="panel-title rtl "> فرم رویدادهای برگزار شده</h3>
        </div>
        <div class="panel-body">
            <div class="alert alert-danger">این فرم شامل برگزاری رویدادهایی نظیر (کارگاه، همایش، سمینار، اردو، بازدید، وبینار، ژورنال کلاب، کرسی، نمایشگاه، سخنرانی، مناظره، ایده شو، دوره آزاد، MOOC، مسابقه و...) می باشد که با هدف ارتقای سلامت جسم و روان دانشجویان- توانمندسازی دانشجویان جهت شرکت در مسابقات و المپیادها- معرفت افزایی، ترویج اصول دینی، اخلاق عمومی و حرفه ای- توسعه مهارت های اجتماعی و حرفه ای/تقویت دانش و مهارت کاربردی/ ارتقای قانون مداری- ارتقای مهارت های پژوهشی/ توانمندسازی اساتید و دانشجویان جهت ارتقای کیفیت و انتشار نتایج پایان نامه- توسعه فناوری و کارآفرینی، رویدادهای ایده شو، یاس، کارگاه های آموزشی مرتبط با استارت آپ ها- توانمندسازی اساتید و دانشجویان و مهارت افزایی جهت همکاری با صنعت و جامعه- مدیریت سبز، توسعه پایدار، اقتصاد مقاومتی- برگزاری فعالیتهای مشارکتی با نهادهای اجتماعی پیرامون دانشگاه/تعامل دانشگاه با جامعه- برگزاری دوره های آموزش آزاد و دوره های مورد نیاز صنعت و جامعه برگزار می شوند.</div>

            <? 
            if($msg){
                echo $msg;
            }
            ?>

            <div class="alert alert-warning">تاریخ اتمام بازه تکمیل فرم: <?=convertDate($this->time['finish_date'])?></div>
            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad" method="post">
                <table class="form">
                    <tr>
                        <td>واحد</td>
                        <td colspan="1">

                            <select style="display: block" name="admin_id">
                                <? if(count(array_keys(array_column($this->selectBoxAdmins, 'admin_id'), $admin_info['admin_id'])) == 1):?>
                                    <option value="<?=$admin_info['admin_id']?>"> خودم</option>
                                <? endif;?>
                                <? foreach($this->selectBoxAdmins as $admin):?>
                                    <option <?= ($data['admin_id'] === $admin['admin_id']) ? 'selected' : '' ?> value="<?= $admin['admin_id'] ?>"><?= $admin['name'].' ',$admin['family'] ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>نوع رویداد*</td>
                        <td>
                            <select name="type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['ruydad']['type'] as $item):?>
                                <option <?= ($data['type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td>هدف اصلی*</td>
                        <td>
                            <select name="amaliati_no">
                                <option value="">انتخاب کنید</option>
                                <?/* foreach($amaliati as $amaliati_no => $amaliati):*/?><!--
                                <option <?/*= ($data['amaliati_no'] === $amaliati_no) ? 'selected' : '' */?> value="<?/*= $amaliati_no */?>"><?/*= $amaliati */?></option>
                                --><?/*endforeach;*/?>
                                <? foreach($this->options['ruydad']['amaliati_no'] as $item):?>
                                    <option <?= ($data['amaliati_no'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>

                            </select>
                        </td>

                        <td>عنوان رویداد*</td>
                        <td><input name="title" value="<?= $data['title'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ابتدای دوره*</td>
                        <td>
                        
                        <input name="startdate" value="<?= convertDate($data['startdate']) ?>" autocomplete="off" class="form-control date"></td>

                        <td>انتهای دوره*</td>
                        <td><input name="finishdate" value="<?= convertDate($data['finishdate']) ?>" autocomplete="off" class="form-control date"></td>

                        <td>مدت زمان برگزاری (ساعت)*</td>
                        <td><input name="time" type="number" value="<?= $data['time'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>ملی/بین المللی*</td>
                        <td>
                            <select name="nationality">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['ruydad']['nationality'] as $item):?>
                                <option <?= ($data['nationality'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>

                        <td> مخاطب</td>
                        <td>
                            <select name="member_type">
                                <option value="">انتخاب کنید</option>
                                <? foreach($this->options['ruydad']['member_type'] as $item):?>
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
                                <? foreach($this->options['ruydad']['main_executor'] as $item):?>
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
                                <? foreach($this->options['ruydad']['execute_type'] as $item):?>
                                <option <?= ($data['execute_type'] === $item) ? 'selected' : '' ?> value="<?= $item ?>"><?= $item ?></option>
                                <?endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>محل برگزاری</td>
                        <td><input name="salon" value="<?= $data['salon'] ?>" class="form-control"></td>

                        <td>مبلغ هزینه شده(میلیون ریال)*</td>
                        <td><input name="cost" type="number" min="0" value="<?= $data['cost'] ?>" class="form-control"></td>

                        <td>درآمد کسب شده(میلیون ریال)*</td>
                        <td><input name="income" type="number" min="0" value="<?= $data['income'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>لینک رویداد بر روی سایت*</td>
                        <td><input name="website_link" value="<?= $data['website_link'] ?>" class="form-control"></td>

                        <td> عنوان حامی </td>
                        <td><input name="hami_type" value="<?= $data['hami_type'] ?>" class="form-control"></td>

                        <td> مبلغ حمایت جذب شده (میلیون ریال)</td>
                        <td><input name="hami_income" type="number" min="0" value="<?= $data['hami_income'] ?>" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>توضیحات</td>
                        <td colspan="5"><input name="tozihat" value="<?= $data['tozihat'] ?>" class="form-control"></td>
                    </tr>

                </table>
                <?php if(isset($_GET['id']) && is_numeric($_GET['id'])): ?>
                    <div style="display: flex; justify-content: center; ">
                        <div class="col-md-3">
                            <button name="edit" style="font-size:1.3em" value="<?php echo $_GET['id'] ?>" class="btn btn-info btn-large btn-block"> ویرایش</button>
                        </div>
                    </div>
                <?php else: ?>
                    <button name="temporary" value="1" class="btn btn-warning btn-large">ثبت موقت</button>
                <?php endif; ?>

                    
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
                    <th> مبلغ حمایت جذب شده (میلیون ریال)</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                </tr>
                <?php
                if ($ruydad['recordsCount'] > 0) :
                    foreach ($ruydad['list'] as $v) :
                        $v['confirm1'] = $this->permissions[$v['admin_id']]['confirm1'];
                        $v['confirm2'] = $this->permissions[$v['admin_id']]['confirm2'];

                        $v['name'] = $this->admins[$v['admin_id']]['name'];
                        $v['family'] = $this->admins[$v['admin_id']]['family'];

                        ?>
                        <tr>
                            <td><?= $v['name'].' '.$v['family'] ?></td>
                            <td><?= $v['type'] ?></td>
                            <td><?= $v['amaliati_no'] ?></td>
                            <td><?= readMore( $v['title'], 15) ?></td>
                            <td><?= convertDate($v['startdate']) ?></td>
                            <td><?= convertDate($v['finishdate']) ?></td>
                            <td><?= $v['time'] ?></td>
                            <td><?= $v['nationality'] ?></td>
                            <td><?= $v['member_type'] ?></td>
                            <td><?= $v['member_no'] ?></td>
                            <td><?= $v['main_executor'] ?></td>
                            <td><?= readMore( $v['sub_executor'], 20) ?></td>
                            <td><?= $v['execute_type'] ?></td>
                            <td><?= readMore( $v['salon'], 20) ?></td>
                            <td><?= $v['cost'] ?></td>
                            <td><?= $v['income'] ?></td>
                            <td><?= readMore( $v['website_link'], 5) ?></td>
                            <td><?= readMore( $v['hami_type'], 20) ?></td>
                            <td><?= $v['hami_income'] ?></td>
                            <td><?= readMore($v['tozihat'],20) ?></td>

                            <td>
                                <?php if ($this->time['import_time'] == 1): ?>

                                    <? if( in_array($admin_info['admin_id'], [$v['import_admin']]) ):?>

                                        <? if(($v['status'] == 0 || $v['status'] == 1) ):  ?>
                                            <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad" method="post">
                                                <button name="sendToParent" value="<?= $v['id'] ?>" onclick="return confirm('آیا از ارسال به مافوق مطمئن هستید؟')"
                                                        class="btn btn-xs btn-block btn-success pull-right">ارسال به مافوق</button>
                                            </form>
                                            <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad&method=delete&id=<?= $v['id'] ?>"
                                               class="btn btn-xs btn-block btn-danger pull-right" onclick="return confirm('آیا برای حذف مطمئن هستید؟')">حذف</a>
                                            <a href="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad&id=<?= $v['id'] ?>"
                                               class="btn btn-xs btn-block btn-info pull-right" onclick="return confirm('آیا برای ویرایش مطمئن هستید؟')">ویرایش</a>
                                        <? else:?>
                                            <?= ($v['status'] == 2) ? 'ارسال به مافوق' : '' ?>
                                            <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>

                                        <? endif;?>
                                    <? else:
                                        if(($v['status'] == 0 || $v['status'] == 1)):?>
                                            در حال ورود اطلاعات
                                        <?/* else:*/?><!--
                                            <?/*= ($v['status'] == 2) ? 'ارسال به مافوق' : '' */?>
                                            <?/*= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' */?>
                                            --><?/*= ($v['status'] == 4) ? 'تایید نهایی ' : '' */?>
                                        <? endif;?>
                                    <? endif;?>
                                <? endif;?>
                                <?php if ($this->time['confirm_time'] == 1): ?>
                                    <? if($admin_info['admin_id'] == $v['confirm1']):?>
                                        <? if($v['status'] == 2 ):?>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad&edit" method="post">
                                            <button name="edit" value="<?= $v['id'] ?>" onclick="return confirm('مطمئن هستید که نیازمند اصلاح می باشد؟')"
                                                    class="btn btn-block btn-xs btn-warning pull-right">نیازمند اصلاح</button>
                                        </form>
                                        <!--<form action="<?/*= RELA_DIR */?>admin/?component=shakhes&action=ruydad&confirm" method="post">
                                            <button name="confirm"  value="<?/*= $v['id'] */?>" onclick="return confirm('آیا از تائید مطمئن هستید؟')"
                                                    class="btn btn-xs btn-block btn-success pull-right">تائید</button>
                                        </form>-->
                                        <? else:?>
                                            <?= ($v['status'] == 3) ? 'تایید توسط مافوق' : '' ?>
                                            <?= ($v['status'] == 4) ? 'تایید نهایی ' : '' ?>
                                        <? endif;?>
                                    <? endif;?>


                                    <? if($admin_info['admin_id'] == $v['confirm2']):?>
                                        <? if($v['status'] == 3):?>
                                        <form action="<?= RELA_DIR ?>admin/?component=shakhes&action=ruydad&confirmFinal" method="post">
                                            <button name="confirmFinal"  value="<?= $v['id'] ?>" onclick="confirm('آیا از تائید مطمئن هستید؟')"
                                                    class="btn btn-xs btn-success pull-right">تائید نهایی</button>
                                        </form>

                                        <? else:?>
                                            <?= ($v['status'] == 1) ? '' : '' ?>
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
