<style type="text/css">
    #form1 table tr td {
        text-align: right;
    }
    #form1 table {
        width: 100%;
        text-align: center;
    }
    #form1 p {
        text-align: right;
    }
    #form1 blockquote blockquote p {
        text-align: justify;
    }
    #form1 blockquote blockquote p {
        text-align: right;
    }
    td{
        padding: 0 10px;
        direction: rtl;
    }
    textarea{ width: 90%; margin-top: 10px; height: 40px}
    body{ user-select: text;}


    <?foreach($list['exists'] as $k => $v){ if($admin_info['admin_id'] == $v['admin_id2']){ $submitted = 1;}  }?>
    <?foreach($list['exists2'] as $k2 => $v2){ if($admin_info['admin_id'] == $v2['admin_id2']){ $submitted2 = 1;}  }?>


    <? if($submitted == 1){
    for ($i=1;$i<=27;$i++){    ?>
    #s2id_menu<?=$i?>{display: none}
    <? if($admin_info['semat'] == 'معاون'){?> #s2id_menu<?=$i+27?>{display: none}
    <?  } } }?>

    <? if($submitted2 == 1){
    for ($i=1;$i<=27;$i++){    ?>
    #s2id_menu<?=$i+27?>{display: none}

    <?   } }?>

    <?for ($i=1;$i<=27;$i++){    ?>
    <? if($admin_info['semat'] == 'رئیس'){?>
    #s2id_menu<?=$i?>{display: none}
    <?}else if($admin_info['semat'] == 'معاون'){ ?>
    #s2id_menu<?=$i+27?>{display: none}
    <?} }?>


</style>



<div class="content-body">

    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم نظرسنجی</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?
        //print_r_debug($msg);
        ?>
        <?php if($msg!='')
        { ?>
            <?= $msg ?>
            <?php
        }
        ?>
        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12  center-block">
                    <form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
                        <input name="semat" id="semat" type="hidden" value="<?=$list['semat']?>">
                        <input name="admin" type="hidden" value="<?=$_GET['id']?>">
                        <table  border="1" align="center" style="direction: ltr">
                            <tr bgcolor="#FFFFCC">
                                <td width="122" class="right"> سال 95</td>
                                <td width="112" class="right">دوره ارزیابی:</td>
                                <td colspan="2" class="right">کاربرگ ارزیابی عملکرد اعضای غیر هیأت علمی دانشگاه الزهرا(س)-کارشناس مسئول-کارشناس و سطوح پایین‌تر</td>
                                <td class="right"><p>کاربرگ شماره 4</p></td>
                                <td class="right"><img src="<?=RELA_DIR?>templates/admin/images/logo@2x.png" width="140" height="118" /></td>
                            </tr>
                            <tr bgcolor="#FFFFCC">
                                <td colspan="4" class="right" align="right">ارزیابی شونده </td>
                                <td colspan="2"><p class="right">ارزیابی کننده (بلافصل)</p></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC" class="right"><?=$admin_info['vahed_asli']?></td>
                                <td bgcolor="#FFFFCC" class="right">حوزه اصلی ارزیابی</td>
                                <td width="404" bgcolor="#FFFFCC" class="right"><?=$admin_info['name']?></td>
                                <td width="222" bgcolor="#FFFFCC" class="right">نام</td>
                                <td width="170" bgcolor="#FFFFCC"><?=$list['name']?></td>
                                <td width="168" bgcolor="#FFFFCC" class="right">نام</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC" class="right"><?=$admin_info['vahed_fari']?></td>
                                <td bgcolor="#FFFFCC" class="right">واحد فرعی ارزیابی</td>
                                <td bgcolor="#FFFFCC" class="right"><?=$admin_info['family']?></td>
                                <td bgcolor="#FFFFCC" class="right">نام خانوادگی</td>
                                <td bgcolor="#FFFFCC"><?=$list['family']?></td>
                                <td bgcolor="#FFFFCC" class="right">نام خانوادگی</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC" class="right"><?=$admin_info['semat']?></td>
                                <td bgcolor="#FFFFCC" class="right">سمت کنونی</td>
                                <td bgcolor="#FFFFCC" class="right"><?/*=$list['insert_date']*/?>
                                <?
                                for($i=1;$i<=3;$i++):
                                    if($admin_info['admin_id'] == $list["admin".$i]){$date = $list["exists".$i][0]['insert_date'];}
                                endfor;
                                ?>

                                <?=convertDate($date)?>
                                </td>
                                <td bgcolor="#FFFFCC" class="right">تاریخ ارزیابی</td>
                                <td bgcolor="#FFFFCC"><?=$list['semat']?></td>
                                <td bgcolor="#FFFFCC" class="right">سمت کنونی</td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>
                        <table  border="1" align="center" style="direction: ltr"  >
                            <tr>
                                <td colspan="3">تحلیل عملکرد ارزیابی شونده</td>
                                <td colspan="2" rowspan="7">در این قسمت ارزیابی کننده می‏ بایست عملکرد ارزیابی شونده را تحلیل نموده و نقاط قوت و ضعف ارزیابی شونده را بنویسد.</td>
                            </tr>
                            <tr>
                                <td colspan="2">نقاط ضعف ارزیابی شونده</td>
                                <td>نقاط قوت ارزیابی شونده</td>
                            </tr>
                            <tr>
                                <td height="52" colspan="2">
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row11'].'<br>'; }?>
                                    <br>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row11'].'<br>'; }?>
                                    <textarea name="row11" cols="70" class="right" id="row11"><?=$list['row11']?></textarea>.1
                                </td>
                                <td>
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row6'].'<br>'; }?>
                                    <br>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row6'].'<br>'; }?>
                                    <textarea name="row6" cols="70" class="right" id="row6"><?=$list['row6']?></textarea>.1</td>
                            </tr>
                            <tr>
                                <td height="48" colspan="2">
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row12'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row12'].'<br>'; }?>
                                    <br>
                                    <textarea name="row12" cols="70" class="right" id="row12"><?=$list['row12']?></textarea>.2</td>
                                <td>
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row7'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row7'].'<br>'; }?>
                                    <br>
                                    <textarea name="row7" cols="70" class="right" id="row7"><?=$list['row7']?></textarea>.2</td>
                            </tr>
                            <tr>
                                <td height="49" colspan="2">
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row13'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row13'].'<br>'; }?>
                                    <br>
                                    <textarea name="row13" cols="70" class="right" id="row13"><?=$list['row13']?></textarea>.3</td>
                                <td>
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row8'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row8'].'<br>'; }?>
                                    <br>
                                    <textarea name="row8" cols="70" class="right" id="row8"><?=$list['row8']?></textarea>.3</td>
                            </tr>
                            <tr>
                                <td height="48" colspan="2">
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row14'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row14'].'<br>'; }?>
                                    <br>
                                    <textarea name="row14" cols="70" class="right" id="row14"><?=$list['row14']?></textarea>.4</td>
                                <td>
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row9'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row9'].'<br>'; }?>
                                    <br>
                                    <textarea name="row9" cols="70" class="right" id="row9"><?=$list['row9']?></textarea>.4</td>
                            </tr>
                            <tr>
                                <td height="50" colspan="2">
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row15'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row15'].'<br>'; }?>
                                    <br>
                                    <textarea name="row15" cols="70" class="right" id="row15"><?=$list['row15']?></textarea>.5</td>
                                <td>
                                    <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row10'].'<br>'; }?>
                                    <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row10'].'<br>'; }?>
                                    <br>
                                    <textarea name="row10" cols="70" class="right" id="row10"><?=$list['row10']?></textarea>.5</td>
                            </tr>
                            <tr>
                                <td height="50" colspan="3">راهکارهای پیشنهادی بهبود عملکرد ارزیابی شونده</td>
                                <td colspan="2" rowspan="2">در این قسمت ارزیابی کننده م‏ی بایست مطابق با انتظارات و  بازخورهای ارائه شده  در طول دوره ارزیابی، راهکارهای پیشنهادی را در جهت بهبود عملکرد ارزیابی شونده درج نماید. </td>
                            </tr>
                            <tr>
                                <td height="70" colspan="3"><p>
                                        <label for="row"></label>
                                        <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row1'].'<br>'; }?>
                                        <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row1'].'<br>'; }?>
                                        <br>
                                        <textarea name="row1" cols="150" class="right" id="row1"><?=$list['row1']?></textarea>.1</p>
                                    <p>
                                        <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row2'].'<br>'; }?>
                                        <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row2'].'<br>'; }?>
                                        <br>
                                        <textarea name="row2" cols="150" class="right" id="row2"><?=$list['row2']?></textarea>.2</p>
                                    <p>
                                        <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row3'].'<br>'; }?>
                                        <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row3'].'<br>'; }?>
                                        <br>
                                        <textarea name="row3" cols="150" class="right" id="row3"><?=$list['row3']?></textarea>.3</p>
                                    <p>
                                        <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row4'].'<br>'; }?>
                                        <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row4'].'<br>'; }?>
                                        <br>
                                        <textarea name="row4" cols="150" class="right" id="row4"><?=$list['row4']?></textarea>.4</p>
                                    <p>
                                        <?foreach($list['exists'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row5'].'<br>'; }?>
                                        <?foreach($list['exists2'] as $k => $v){  echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row5'].'<br>'; }?>
                                        <br>
                                        <textarea name="row5" cols="150" class="right" id="row5"><?=$list['row5']?></textarea>.5</p>
                                    <p>&nbsp;</p></td>
                            </tr>
                            <tr>
                                <td width="174" height="53">:تاریخ ارسال به مرکز</td>
                                <td width="369" rowspan="2"><input type='file' /></td>
                                <td width="561" rowspan="2"><p>امضاء ارزیابی کننده نهایی</p>
                                    <p>(مدیر ‏میانی)</p></td>
                                <td width="222" rowspan="2"><input type='file' /></td>
                                <td width="128" rowspan="2"><p>امضاء ارزیابی کننده </p>
                                    <p>(مدیر بلافصل)</p></td>
                            </tr>
                            <tr>
                                <td height="53">
                                    <?=$list['insert_date']?>
                                </td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>

                        <p></p>
                        <table border="1" align="center"  style="direction: ltr">
                            <tr>
                                <td colspan="9" width="1274" align="right" bgcolor="#990033" style="color: #fff;">به منظور سهولت تکمیل فرم، امتیازات ثبت شده توسط مدیران سطوح پایین‌تر، در ستون امتیاز مدیران بالایی قرار می‌گیرد،که قابل ویرایش می‌باشد. </td>
                            </tr>
                            <tr>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td width="65" bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td colspan="3" bgcolor="#99CCFF">ارزیابی شونده در ستون ارزیابی می ‏بایست بر روی فلش            کلیک نموده و یکی از گزینه ‏ها را انتخاب نمایند</td>
                                <td colspan="2" bgcolor="#99CCFF">راهنمای ارزیابی:</td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده (مدیر نهایی)</td>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده (مدیر بلافصل)</td>
                                <td width="33" rowspan="2" bgcolor="#99CCFF">سقف امتیاز معیار</td>
                                <td width="672" rowspan="2" bgcolor="#99CCFF">توصیف شاخص</td>
                                <td width="144" rowspan="2" bgcolor="#99CCFF">شاخص</td>
                                <td width="92" rowspan="2" bgcolor="#99CCFF">معیار</td>
                                <td width="41" rowspan="2" bgcolor="#99CCFF">ردیف</td>
                            </tr>
                            <tr>
                                <td width="79" bgcolor="#99CCFF">امتیاز</td>
                                <td width="128" bgcolor="#99CCFF">ارزیابی </td>
                                <td bgcolor="#99CCFF" style="white-space: nowrap">امتیاز
                                    <br>
                                    <table border="1" id="tbl"  >
                                        <tr>
                                            <?foreach($list['exists'] as $k => $v){  echo '<td width="150px"> '.$list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].'</td>'; }?>
                                        </tr>
                                    </table>
                                </td>
                                <td width="124" bgcolor="#99CCFF">ارزیابی</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn1']*$v['menu28']; }?></td>
                                <td><select name="menu28" id="menu28">
                                        <option <?=($list['menu28'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu28'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu28'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu28'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu28'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu28'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn1']*$v['menu1'].'</td>'; }?></tr></table></td>
                                <td><select  name="menu1" id="menu1">
                                        <option <?=($list['menu1'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu1'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu1'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu1'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu1'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu1'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="5">24</td>
                                <td align="right">احترام به ارزش‌های اسلامی، شئونات اجتماعی و پوشش متناسب با محیط‏ کار</td>
                                <td>تعظیم شعائر</td>
                                <td rowspan="5">اخلاق حرفه‌ای</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn2']*$v['menu29']; }?></td>
                                <td><select name="menu29" id="menu29">
                                        <option <?=($list['menu29'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu29'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu29'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu29'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu29'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu29'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn2']*$v['menu2'].'</td>'; }?></tr></table></td>
                                <td><select name="menu2" id="menu2">
                                        <option <?=($list['menu2'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu2'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu2'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu2'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu2'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu2'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>نداشتن تأخیر در ورود و تعجیل در خروج و نداشتن غیبت</td>
                                <td> *حضور به موقع</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn3']*$v['menu30']; }?></td>
                                <td><select name="menu30" id="menu30">
                                        <option <?=($list['menu30'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu30'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu30'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu30'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu30'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu30'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn3']*$v['menu3'].'</td>'; }?></tr></table></td>
                                <td><select name="menu3" id="menu3">
                                        <option <?=($list['menu3'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu3'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu3'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu3'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu3'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu3'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>مدارا و حسن معاشرت با مدیران و همکاران</td>
                                <td>حسن خلق</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn4']*$v['menu31']; }?></td>
                                <td><select name="menu31" id="menu31">
                                        <option <?=($list['menu31'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu31'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu31'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu31'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu31'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu31'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn4']*$v['menu4'].'</td>'; }?></tr></table></td>
                                <td><select name="menu4" id="menu4">
                                        <option <?=($list['menu4'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu4'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu4'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu4'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu4'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu4'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>خود کنترلی و عدم نیاز به کنترل مستقیم و مداوم مسئول واحد</td>
                                <td>وجدان کاری</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn5']*$v['menu32']; }?></td>
                                <td><select name="menu32" id="menu32">
                                        <option <?=($list['menu32'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu32'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu32'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu32'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu32'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu32'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn5']*$v['menu5'].'</td>'; }?></tr></table></td>
                                <td><select name="menu5" id="menu5">
                                        <option <?=($list['menu5'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu5'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu5'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu5'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu5'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu5'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>ادب، خوشرویی، خویشتن‌‏داری، سعه‌‏صدر و تواضع در برخورد با مراجعین</td>
                                <td>تکریم ارباب رجوع</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn6']*$v['menu33']; }?></td>
                                <td><select name="menu33" id="menu33">
                                        <option <?=($list['menu33'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu33'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu33'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu33'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu33'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu33'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn6']*$v['menu6'].'</td>'; }?></tr></table></td>
                                <td><select name="menu6" id="menu6">
                                        <option <?=($list['menu6'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu6'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu6'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu6'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu6'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu6'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="5">20</td>
                                <td>پشتکار، جدیت، سخت‏کوشی و پیگیری امور تا حصول نتیجه</td>
                                <td> مسئولیت پذیری</td>
                                <td rowspan="5">تعهد سازمانی</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn7']*$v['menu34']; }?></td>
                                <td><select name="menu34" id="menu34">
                                        <option <?=($list['menu34'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu34'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu34'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu34'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu34'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu34'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn7']*$v['menu7'].'</td>'; }?></tr></table></td>
                                <td><select name="menu7" id="menu7">
                                        <option <?=($list['menu7'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu7'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu7'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu7'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu7'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu7'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>تلاش در راستای بهبود عملکرد و تحقق اهداف واحد و دانشگاه</td>
                                <td>تعالی سازمانی</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn8']*$v['menu35']; }?></td>
                                <td><select name="menu35" id="menu35">
                                        <option <?=($list['menu35'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu35'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu35'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu35'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu35'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu35'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn8']*$v['menu8'].'</td>'; }?></tr></table></td>
                                <td><select name="menu8" id="menu8">
                                        <option <?=($list['menu8'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu8'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu8'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu8'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu8'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu8'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>تشریک مساعی در تنظیم خط‏‌‌ مشی داخلی و شیوه‏‌نامه‌‏های مورد نیاز</td>
                                <td>مشارکت</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn9']*$v['menu36']; }?></td>
                                <td><select name="menu36" id="menu36">
                                        <option <?=($list['menu36'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu36'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu36'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu36'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu36'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu36'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn9']*$v['menu9'].'</td>'; }?></tr></table></td>
                                <td><select name="menu9" id="menu9">
                                        <option <?=($list['menu9'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu9'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu9'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu9'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu9'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu9'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>رفتار فردی و داوطلبانه‌‏ی منجر به ارتقای اثر بخشی واحد خارج از شرح وظایف سازمانی و یا خارج از ساعت اداری</td>
                                <td>رفتار شهروندی سازمانی</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn10']*$v['menu37']; }?></td>
                                <td><select name="menu37" id="menu37">
                                        <option <?=($list['menu37'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu37'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu37'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu37'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu37'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu37'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn10']*$v['menu10'].'</td>'; }?></tr></table></td>
                                <td><select name="menu10" id="menu10">
                                        <option <?=($list['menu10'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu10'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu10'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu10'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu10'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu10'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>میزان تمایل و علاقه به انجام وظایف شغلی</td>
                                <td>انگیزش</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn11']*$v['menu38']; }?></td>
                                <td><select name="menu38" id="menu38">
                                        <option <?=($list['menu38'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu38'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu38'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu38'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu38'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu38'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn11']*$v['menu11'].'</td>'; }?></tr></table></td>
                                <td><select name="menu11" id="menu11">
                                        <option <?=($list['menu11'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu11'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu11'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu11'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu11'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu11'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="4">16</td>
                                <td>برقراری ارتباط میان فردی مناسب با همکاران و مدیران ایجاد تفاهم و تعامل مناسب</td>
                                <td>تعاملات</td>
                                <td rowspan="4">مهارت‌های ارتباطی</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn12']*$v['menu39']; }?></td>
                                <td><select name="menu39" id="menu39">
                                        <option <?=($list['menu39'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu39'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu39'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu39'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu39'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu39'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn12']*$v['menu12'].'</td>'; }?></tr></table></td>
                                <td><select name="menu12" id="menu12">
                                        <option <?=($list['menu12'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu12'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu12'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu12'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu12'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu12'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>واکنش مناسب در برابر چالش‏‌های موجود و قابلیت ‏سازگاری در محیط کار</td>
                                <td>انعطاف پذیری</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn13']*$v['menu40']; }?></td>
                                <td><select name="menu40" id="menu40">
                                        <option <?=($list['menu40'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu40'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu40'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu40'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu40'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu40'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn13']*$v['menu13'].'</td>'; }?></tr></table></td>
                                <td><select name="menu13" id="menu13">
                                        <option <?=($list['menu13'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu13'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu13'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu13'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu13'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu13'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>ظرفیت ‏پذیرش انتقادات و کوشش در اصلاح رفتارهای ناپسند بدون نشان‏ دادن عکس‏‌العمل منفی</td>
                                <td>انتقاد پذیری</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn14']*$v['menu41']; }?></td>
                                <td><select name="menu41" id="menu41">
                                        <option <?=($list['menu41'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu41'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu41'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu41'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu41'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu41'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn14']*$v['menu14'].'</td>'; }?></tr></table></td>
                                <td><select name="menu14" id="menu14">
                                        <option <?=($list['menu14'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu14'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu14'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu14'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu14'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu14'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>حضور فعال در گروه‌‏های کاری و ایجاد هم‌افزایی در واحد مربوطه</td>
                                <td>*کارگروهی</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn15']*$v['menu42']; }?></td>
                                <td><select name="menu42" id="menu42">
                                        <option <?=($list['menu42'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu42'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu42'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu42'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu42'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu42'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn15']*$v['menu15'].'</td>'; }?></tr></table></td>
                                <td><select name="menu15" id="menu15">
                                        <option <?=($list['menu15'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu15'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu15'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu15'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu15'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu15'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="4">16</td>
                                <td>مشارکت فعال در دوره‌‏های آموزشی مرتبط با شغل و بکارگیری آموخته‏‌ها در عمل</td>
                                <td>*دوره های آموزشی</td>
                                <td rowspan="4">یاددهی و یادگیری</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn16']*$v['menu43']; }?></td>
                                <td><select name="menu43" id="menu43">
                                        <option <?=($list['menu43'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu43'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu43'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu43'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu43'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu43'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn16']*$v['menu16'].'</td>'; }?></tr></table></td>
                                <td><select name="menu16" id="menu16">
                                        <option <?=($list['menu16'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu16'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu16'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu16'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu16'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu16'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>خود‏آموزی و کوشش در افزایش سطح دانش ‏شغلی </td>
                                <td>دانش ‏افزایی </td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn17']*$v['menu44']; }?></td>
                                <td><select name="menu44" id="menu44">
                                        <option <?=($list['menu44'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu44'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu44'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu44'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu44'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu44'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn17']*$v['menu17'].'</td>'; }?></tr></table></td>
                                <td><select name="menu17" id="menu17">
                                        <option <?=($list['menu17'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu17'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu17'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu17'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu17'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu17'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>توانایی انتقال معلومات و مهارت‌های شغلی به همکاران</td>
                                <td>آموزش به دیگران</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn18']*$v['menu45']; }?></td>
                                <td><select name="menu45" id="menu45">
                                        <option <?=($list['menu45'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu45'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu45'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu45'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu45'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu45'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn18']*$v['menu18'].'</td>'; }?></tr></table></td>
                                <td><select name="menu18" id="menu18">
                                        <option <?=($list['menu18'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu18'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu18'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu18'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu18'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu18'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>مستند‏سازی تجربیات و فرایندهای کاری شناسایی مسائلی که در حین انجام کار پیش آمده و راه‌‏حل‏‌هایی که عضو برای مسائل به آن رسیده</td>
                                <td>مدیریت دانش</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn19']*$v['menu46']; }?></td>
                                <td><select name="menu46" id="menu46">
                                        <option <?=($list['menu46'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu46'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu46'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu46'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu46'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu46'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn19']*$v['menu19'].'</td>'; }?></tr></table></td>
                                <td><select name="menu19" id="menu19">
                                        <option <?=($list['menu19'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu19'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu19'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu19'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu19'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu19'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="7">24</td>
                                <td>آشنایی کامل بر شرح وظایف، بخشنامه‏‌ها، آیین‏نامه‏‌ها و دستورالعمل‏‌های شغلی و رعایت قوانین و مقررات در کلیه امور</td>
                                <td>تسلط بر شغل و قانون‏‌مداری</td>
                                <td rowspan="7">توانمندی شغلی</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn20']*$v['menu47']; }?></td>
                                <td><select name="menu47" id="menu47">
                                        <option <?=($list['menu47'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu47'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu47'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu47'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu47'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu47'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn20']*$v['menu20'].'</td>'; }?></tr></table></td>
                                <td><select name="menu20" id="menu20">
                                        <option <?=($list['menu20'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu20'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu20'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu20'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu20'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu20'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td class="right">ارائه پیشنهادات کارشناسی و بهبود فرایند انجام کار در حیطه وظایف‏ شغلی</td>
                                <td> *خلاقیت و نو‏آوری</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn21']*$v['menu48']; }?></td>
                                <td><select name="menu48" id="menu48">
                                        <option <?=($list['menu48'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu48'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu48'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu48'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu48'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu48'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn21']*$v['menu21'].'</td>'; }?></tr></table></td>
                                <td><select name="menu21" id="menu21">
                                        <option <?=($list['menu21'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu21'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu21'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu21'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu21'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu21'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>اولویت‏ بندی امور محوله و الزام به اتمام آن در زمان مقرر</td>
                                <td>مدیریت ‏زمان</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn22']*$v['menu49']; }?></td>
                                <td><select name="menu49" id="menu49">
                                        <option <?=($list['menu49'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu49'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu49'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu49'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu49'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu49'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn22']*$v['menu22'].'</td>'; }?></tr></table></td>
                                <td><select name="menu22" id="menu22">
                                        <option <?=($list['menu22'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu22'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu22'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu22'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu22'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu22'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>توانایی نگارش گزارشات تخصصی و فنی‏ کاربردی و قابل فهم با استفاده از شیوه‏‌های پذیرفته شده علمی</td>
                                <td> *گزارش‏‌دهی</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn23']*$v['menu50']; }?></td>
                                <td><select name="menu50" id="menu50">
                                        <option <?=($list['menu50'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu50'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu50'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu50'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu50'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu50'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn23']*$v['menu23'].'</td>'; }?></tr></table></td>
                                <td><select name="menu23" id="menu23">
                                        <option <?=($list['menu23'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu23'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu23'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu23'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu23'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu23'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>میزان تسط به آیین نگارش ‏اداری و بکارگیری آن در تدوین گزارشات‏کاری</td>
                                <td>مکاتبات ‏اداری</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn24']*$v['menu51']; }?></td>
                                <td><select name="menu51" id="menu51">
                                        <option <?=($list['menu51'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu51'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu51'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu51'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu51'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu51'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn24']*$v['menu24'].'</td>'; }?></tr></table></td>
                                <td><select name="menu24" id="menu24">
                                        <option <?=($list['menu24'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu24'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu24'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu24'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu24'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu24'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>تسلط و بکارگیری نرم‌‏افزارهای تخصصی مرتبط با شغل و شرح وظایف بر اساس شغل</td>
                                <td>نرم‌‌‏افزارهای‏ شغلی</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn25']*$v['menu52']; }?></td>
                                <td><select name="menu52" id="menu52">
                                        <option <?=($list['menu52'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu52'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu52'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu52'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu52'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu52'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn25']*$v['menu25'].'</td>'; }?></tr></table></td>
                                <td><select name="menu25" id="menu25">
                                        <option <?=($list['menu25'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu25'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu25'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu25'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu25'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu25'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td align="right"> در انجام وظایف ICDL تسلط در استفاده از سامانه‌‏های دانشگاه و مهارت‌‏های </td>
                                <td>مهارت عمومی فاوا </td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn26']*$v['menu53']; }?></td>
                                <td><select name="menu53" id="menu53">
                                        <option <?=($list['menu53'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu53'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu53'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu53'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu53'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu53'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn26']*$v['menu26'].'</td>'; }?></tr></table></td>
                                <td><select name="menu26" id="menu26">
                                        <option <?=($list['menu26'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu26'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu26'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu26'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu26'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu26'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>&nbsp;</td>
                                <td><textarea name="newrow3" cols="100" class="right" id="newrow3"></textarea></td>
                                <td><label for="newrow"></label>
                                    <input name="newrow1" type="text" class="right" id="newrow1" /></td>
                                <td rowspan="2">شاخص‌های پیشنهادی</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn27']*$v['menu54']; }?></td>
                                <td><select name="menu54" id="menu54">
                                        <option <?=($list['menu54'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu54'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu54'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu54'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu54'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu54'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td><table border="1"><tr><?foreach($list['exists'] as $k => $v){ echo '<td>'.$list['vazn27']*$v['menu27'].'</td>'; }?></tr></table>


                                </td>
                                <td><select name="menu27" id="menu27">
                                        <option <?=($list['menu27'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu27'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu27'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu27'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu27'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu27'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>&nbsp;</td>
                                <td><textarea name="newrow4" cols="100" class="right" id="newrow4"> </textarea></td>
                                <td><input name="newrow2" type="text" class="right" id="newrow2" /></td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td id="">
                                    <table border="1"><tr>
                                            <?

                                            foreach($list['exists'] as $k => $v){
                                                $sum = 0;
                                                ?>
                                                <td width="150px">
                                                    <?
                                                    for ($k=1 ;$k<=27 ;$k++)
                                                    {
                                                        $sum += $list['vazn'.$k]*$v['menu'.$k];
                                                    }
                                                    echo $sum;
                                                    ?>
                                                </td>
                                                <?
                                                //echo '<td width="150px"> '.$list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].'</td>';
                                            }?>
                                        </tr></table>
                                    <?

                                    ?></td>
                                <td></td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="3">جمع</td>
                            </tr>
                            <tr>

                                <td colspan="3" id="sum">
                                    <?
                                    foreach($list['exists2'] as $k => $v){
                                        $sum = 0;
                                        ?>

                                        <?
                                        for ($k=1 ;$k<=27 ;$k++)
                                        {
                                            $sum += $list['vazn'.$k]*$v['menu'.($k+27)];
                                        }
                                        echo $sum;

                                    }?>
                                </td>
                                <td></td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="3">جمع</td>
                            </tr>
                        </table>
                        <p class="text-center" style="padding: 0 30px">
                            <? if($submitted != 1 && $submitted2 != 1){?>
                                <input class="btn btn-primary btn-default text-white text-16" name="submit" id="submit" value="ثبت" type="submit">
                            <? }?>
                        </p>

                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;  </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
