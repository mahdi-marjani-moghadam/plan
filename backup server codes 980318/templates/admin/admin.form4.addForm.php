<?
//echo "<pre>";
//print_r($list);
//echo "</pre>";?>
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


    <?foreach($list['exists3'] as $k => $v){ if($admin_info['admin_id'] == $v['admin_id2']){ $admin3 = 1;}   }?>
    <?foreach($list['exists2'] as $k2 => $v2){ if($admin_info['admin_id'] == $v2['admin_id2']){ $admin2 = 1;}  }?>
    <?foreach($list['exists1'] as $k2 => $v2){ if($admin_info['admin_id'] == $v2['admin_id2']){ $admin1 = 1;}  }?>


    .hiddenForm{display: none;}
    #nextForm4{display: block;}

    <?
    if($list['beforeSend'] == 1){
        echo '#submit{display:none}';
    }
    if($list['submited'] != '' && $list['existByExist'] == ''/*|| is_array($list['exists1']) || is_array($list['exists2']) || is_array($list['exists3'])*/){        ?>
    /*textarea{display: none}*/
    .hiddenForm{display: block;}
    #nextForm4{display: none;}

    <? }
    else if( count($list['exists1'])>0 || count($list['exists2'])>0 || count($list['exists3'])>0)
        {
            if($list['existByExist'] == ''){
            echo '
            .hiddenForm{display: block;}
            #nextForm4{display: none;}
            .extra{display: none}';
            }

        }
?>


    <? if($admin == 1 ){
        for ($i=1;$i<=27;$i++){
            if($list['status'] == 11 && $i <=27){?>
    #s2id_menu<?=$i?>{display: none}
    <?
    }
    elseif($list['status'] == 11 && $i <=27){
        ?> #s2id_menu<?=$i+27?>{display: none}

    <?
    }
}
}               ?>




    <?for ($i=1;$i<=27;$i++){    ?>
    <? if($admin_info['semat'] == 'مدیر'){?>
    /*#s2id_menu<?//=$i?>{display: none}*/
    <?}else if($admin_info['semat'] == 'معاون'){ ?>
    /*#s2id_menu<?//=$i+27?>{display: none}*/
    <?} }?>



</style>



<div class="content-body">

    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ارزیابی</h3>
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
                                <td colspan="4" class="right" align="right"> ارزیابی کننده (بلافصل)</td>
                                <td colspan="2"><p class="right">ارزیابی شونده</p></td>
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
                                <td bgcolor="#FFFFCC" class="right">
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
                                <td colspan="5">تحلیل عملکرد ارزیابی شونده</td>
                                <td colspan="2" rowspan="7">در این قسمت ارزیابی کننده می‏ بایست عملکرد ارزیابی شونده را تحلیل نموده و نقاط قوت و ضعف ارزیابی شونده را بنویسد.</td>
                            </tr>
                            <tr>
                                <td colspan="3">نقاط ضعف ارزیابی شونده</td>
                                <td colspan="2">نقاط قوت ارزیابی شونده</td>
                            </tr>
                            <tr>
                                <td height="52" colspan="3">
                                    <? foreach($list['exists3'] as $k => $v){

                                        if($v['insert_date'] != ''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row11'].'<br>';}
                                    }?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row11'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row11'].'<br>'; ?>
                                    <textarea name="row11" cols="70" class="right" id="row11"><?=$list['row11']?></textarea>.1
                                </td>
                                <td colspan="2">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row6'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row6'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row6'].'<br>'; ?>
                                    <textarea name="row6" cols="70" class="right" id="row6"><?=$list['row6']?></textarea>.1</td>
                            </tr>
                            <tr>
                                <td height="48" colspan="3">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row12'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row12'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row12'].'<br>'; ?>
                                    <textarea name="row12" cols="70" class="right" id="row12"><?=$list['row12']?></textarea>.2</td>
                                <td colspan="2">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row7'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row7'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row7'].'<br>'; ?>
                                    <textarea name="row7" cols="70" class="right" id="row7"><?=$list['row7']?></textarea>.2</td>
                            </tr>
                            <tr>
                                <td height="49" colspan="3">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row13'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row13'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row13'].'<br>'; ?>
                                    <textarea name="row13" cols="70" class="right" id="row13"><?=$list['row13']?></textarea>.3</td>
                                <td colspan="2">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row8'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row8'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row8'].'<br>'; ?>
                                    <textarea name="row8" cols="70" class="right" id="row8"><?=$list['row8']?></textarea>.3</td>
                            </tr>
                            <tr>
                                <td height="48" colspan="3">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row14'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row14'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row14'].'<br>'; ?>
                                    <textarea name="row14" cols="70" class="right" id="row14"><?=$list['row14']?></textarea>.4</td>
                                <td  colspan="2">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row9'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row9'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row9'].'<br>'; ?>
                                    <textarea name="row9" cols="70" class="right" id="row9"><?=$list['row9']?></textarea>.4</td>
                            </tr>
                            <tr>
                                <td height="50" colspan="3">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row15'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row15'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row15'].'<br>'; ?>
                                    <textarea name="row15" cols="70" class="right" id="row15"><?=$list['row15']?></textarea>.5</td>
                                <td colspan="2">
                                    <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row10'].'<br>'; }}?>
                                    <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row10'].'<br>'; }}?>
                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row10'].'<br>'; ?>
                                    <textarea name="row10" cols="70" class="right" id="row10"><?=$list['row10']?></textarea>.5</td>
                            </tr>
                            <tr>
                                <td height="50" colspan="5">راهکارهای پیشنهادی بهبود عملکرد ارزیابی شونده</td>
                                <td colspan="2" rowspan="2">در این قسمت ارزیابی کننده م‏ی بایست مطابق با انتظارات و  بازخورهای ارائه شده  در طول دوره ارزیابی، راهکارهای پیشنهادی را در جهت بهبود عملکرد ارزیابی شونده درج نماید. </td>
                            </tr>
                            <tr>
                                <td height="70" colspan="5"><p>
                                        <label for="row"></label>
                                        <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row1'].'<br>'; }}?>
                                        <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row1'].'<br>'; }}?>
                                        <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row1'].'<br>'; ?>
                                        <textarea name="row1" cols="150" class="right" id="row1"><?=$list['row1']?></textarea>.1</p>
                                    <p>
                                        <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row2'].'<br>'; }}?>
                                        <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row2'].'<br>'; }}?>
                                        <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row2'].'<br>'; ?>
                                        <?=$list['row2']?>
                                        <textarea name="row2" cols="150" class="right" id="row2"><?=$list['row2']?></textarea>.2</p>
                                    <p>
                                        <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row3'].'<br>'; }}?>
                                        <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row3'].'<br>'; }}?>
                                        <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row3'].'<br>'; ?>
                                        <?=$list['row3']?>
                                        <textarea name="row3" cols="150" class="right" id="row3"><?=$list['row3']?></textarea>.3</p>
                                    <p>
                                        <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row4'].'<br>'; }}?>
                                        <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row4'].'<br>'; }}?>
                                        <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row4'].'<br>'; ?>
                                        <?=$list['exists1'][0]['row4']?>
                                        <textarea name="row4" cols="150" class="right" id="row4"><?=$list['row4']?></textarea>.4</p>
                                    <p>
                                        <?foreach($list['exists3'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row5'].'<br>'; }}?>
                                        <?foreach($list['exists2'] as $k => $v){  if($v['insert_date'] != ''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['row5'].'<br>'; }}?>

                                        <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['row5'].'<br>'; ?>


                                        <textarea name="row5" cols="150" class="right" id="row5"><?=$list['row5']?></textarea>.5</p>
                                    <p>&nbsp;</p></td>
                            </tr>
                            <tr>
                                <?
                                for($i=1;$i<=3;$i++):
                                    if($admin_info['admin_id'] == $list["admin".$i]){$date = $list["exists".$i][0]['insert_date'];}
                                endfor;
                                    ?>
                                <td width="174" height="53"> :تاریخ ارسال به مرکز   <?=convertDate($date)?> </td>
                                <td width="369" rowspan=""><? if($list['exists3'][0]['insert_date'] != '' && $list['exists3'][0]['admin_id2'] == $list['admin3'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin3']?>.png'>
                                    <? }?></td>
                                <td width="369" rowspan="">امضاء ارزیابی کننده نهایی</td>
                                <td width="369" rowspan=""><? if($list['exists2'][0]['insert_date'] != '' && $list['exists2'][0]['admin_id2'] == $list['admin2'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin2']?>.png'>
                                    <? }?></td>
                                <td width="561" rowspan=""><p>امضاء ارزیابی کننده میانی</p>
                                    <p>(مدیر‏نهایی)</p></td>
                                <td width="222" rowspan="">
                                    <?
                                    if($list['exists1'][0]['insert_date'] != '' && $list['exists1'][0]['admin_id2'] == $list['admin1'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin1']?>.png'>
                                    <? }?>
                                </td>
                                <td width="128" rowspan=""><p>امضاء ارزیابی کننده </p>
                                    <p>(مدیر بلافصل)</p></td>
                            </tr>

                        </table>
                        <p>&nbsp;</p>
                        <p>&nbsp;<a id="nextForm4" class="btn btn-white btn-info" style="font-size: 25px" >مرحله بعدی</a> </p>
                        <p>&nbsp;</p>
                        <table border="" class="hiddenForm" align="center"  style="direction: ltr;width:100%;background: #990033" >
                            <tr style="width:100%">
                                <td align="left" bgcolor="#8b0000" style="color: #fff;width:100%"> به منظور سهولت تکمیل فرم، امتیازات ثبت شده توسط مدیران سطوح پایین‌تر، در ستون امتیاز مدیران بالایی قرار می‌گیرد،که قابل ویرایش می‌باشد.</td>
                            </tr>
                        </table>
                        <table border="1" class="hiddenForm" align="center"  style="direction: ltr">
                            <tr>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td width="65" colspan="3" bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td colspan="3" bgcolor="#99CCFF">ارزیابی شونده در ستون ارزیابی می ‏بایست بر روی فلش            کلیک نموده و یکی از گزینه ‏ها را انتخاب نمایند</td>
                                <td colspan="2" bgcolor="#99CCFF">راهنمای ارزیابی:</td>
                            </tr>
                            <tr>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده (مدیر نهایی)</td>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده (مدیر میانی)</td>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده (مدیر بلافصل)</td>
                                <td width="33" rowspan="2" bgcolor="#99CCFF"></td>
                                <td width="672" rowspan="2" bgcolor="#99CCFF">توصیف شاخص</td>
                                <td width="144" rowspan="2" bgcolor="#99CCFF">شاخص</td>
                                <td width="92" rowspan="2" bgcolor="#99CCFF">معیار</td>
                                <td width="41" rowspan="2" bgcolor="#99CCFF">ردیف</td>
                            </tr>
                            <tr>
                                <td width="79" bgcolor="#99CCFF">امتیاز</td>
                                <td width="128" bgcolor="#99CCFF">ارزیابی </td>
                                <td bgcolor="#99CCFF">امتیاز</td>
                                <td bgcolor="#99CCFF">ارزیابی
                                    <!--<br>
            <table border="1" id="tbl"  >
                <tr>
                    <?/*foreach($list['exists3'] as $k => $v){
                        {
                            echo '<td width="150px"> '.$list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].'</td>';
                        }
                    }*/?>
                </tr>
            </table></td>-->
                                <td bgcolor="#99CCFF" style="white-space: nowrap">امتیاز
                                    <br>
                                    <table border="1" id="tbl"  >
                                        <tr>

                                            <?foreach($list['exists'] as $k => $v){ if($admin_info['admin_id'] == $v['admin_id2']){  echo '<td width="150px"> '.$list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].'</td>'; }}?>
                                        </tr>
                                    </table>
                                </td>
                                <td width="124" bgcolor="#99CCFF">ارزیابی</td>
                            </tr>
                            <tr>
                                <?
                                $row = 1;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != '' && strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>

                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td rowspan="5"></td>
                                <td align="right">احترام به ارزش‌های اسلامی، شئونات اجتماعی و پوشش متناسب با محیط‏ کار</td>
                                <td>تعظیم شعائر</td>
                                <td rowspan="5">اخلاق حرفه‌ای</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <?
                                $row = 2;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>

                                <td>نداشتن تأخیر در ورود و تعجیل در خروج و نداشتن غیبت</td>
                                <td> *حضور به موقع</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <?
                                $row = 3;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>

                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>مدارا و حسن معاشرت با مدیران و همکاران</td>
                                <td>حسن خلق</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <?
                                $row = 4;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>خود کنترلی و عدم نیاز به کنترل مستقیم و مداوم مسئول واحد</td>
                                <td>وجدان کاری</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <?
                                $row = 5;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>ادب، خوشرویی، خویشتن‌‏داری، سعه‌‏صدر و تواضع در برخورد با مراجعین</td>
                                <td>تکریم ارباب رجوع</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <?
                                $row = 6;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td rowspan="5"></td>
                                <td>پشتکار، جدیت، سخت‏کوشی و پیگیری امور تا حصول نتیجه</td>
                                <td> مسئولیت پذیری</td>
                                <td rowspan="5">تعهد سازمانی</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <?
                                $row = 7;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>تلاش در راستای بهبود عملکرد و تحقق اهداف واحد و دانشگاه</td>
                                <td>تعالی سازمانی</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <?
                                $row = 8;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>تشریک مساعی در تنظیم خط‏‌‌ مشی داخلی و شیوه‏‌نامه‌‏های مورد نیاز</td>
                                <td>مشارکت</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <?
                                $row = 9;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>رفتار فردی و داوطلبانه‌‏ی منجر به ارتقای اثر بخشی واحد خارج از شرح وظایف سازمانی و یا خارج از ساعت اداری</td>
                                <td>رفتار شهروندی سازمانی</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <?
                                $row = 10;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>میزان تمایل و علاقه به انجام وظایف شغلی</td>
                                <td>انگیزش</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <?
                                $row = 11;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td rowspan="4"></td>
                                <td>برقراری ارتباط میان فردی مناسب با همکاران و مدیران ایجاد تفاهم و تعامل مناسب</td>
                                <td>تعاملات</td>
                                <td rowspan="4">مهارت‌های ارتباطی</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <?
                                $row = 12;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>واکنش مناسب در برابر چالش‏‌های موجود و قابلیت ‏سازگاری در محیط کار</td>
                                <td>انعطاف پذیری</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <?
                                $row = 13;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>ظرفیت ‏پذیرش انتقادات و کوشش در اصلاح رفتارهای ناپسند بدون نشان‏ دادن عکس‏‌العمل منفی</td>
                                <td>انتقاد پذیری</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <?
                                $row = 14;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>حضور فعال در گروه‌‏های کاری و ایجاد هم‌افزایی در واحد مربوطه</td>
                                <td>*کارگروهی</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <?
                                $row = 15;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td rowspan="4"></td>
                                <td>مشارکت فعال در دوره‌‏های آموزشی مرتبط با شغل و بکارگیری آموخته‏‌ها در عمل</td>
                                <td>*دوره های آموزشی</td>
                                <td rowspan="4">یاددهی و یادگیری</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <?
                                $row = 16;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>خود‏آموزی و کوشش در افزایش سطح دانش ‏شغلی </td>
                                <td>دانش ‏افزایی </td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <?
                                $row = 17;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>توانایی انتقال معلومات و مهارت‌های شغلی به همکاران</td>
                                <td>آموزش به دیگران</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <?
                                $row = 18;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>مستند‏سازی تجربیات و فرایندهای کاری شناسایی مسائلی که در حین انجام کار پیش آمده و راه‌‏حل‏‌هایی که عضو برای مسائل به آن رسیده</td>
                                <td>مدیریت دانش</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <?
                                $row = 19;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td rowspan="7"></td>
                                <td>آشنایی کامل بر شرح وظایف، بخشنامه‏‌ها، آیین‏ نامه‏‌ها و دستورالعمل‏‌های شغلی و رعایت قوانین و مقررات در کلیه امور</td>
                                <td>تسلط بر شغل و قانون‏‌مداری</td>
                                <td rowspan="7">توانمندی شغلی</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <?
                                $row = 20;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td class="right">ارائه پیشنهادات کارشناسی و بهبود فرایند انجام کار در حیطه وظایف‏ شغلی</td>
                                <td> *خلاقیت و نو‏آوری</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <?
                                $row = 21;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>اولویت‏ بندی امور محوله و الزام به اتمام آن در زمان مقرر</td>
                                <td>مدیریت ‏زمان</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <?
                                $row = 22;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>توانایی نگارش گزارشات تخصصی و فنی‏ کاربردی و قابل فهم با استفاده از شیوه‏‌های پذیرفته شده علمی</td>
                                <td> *گزارش‏‌دهی</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <?
                                $row = 23;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>میزان تسط به آیین نگارش ‏اداری و بکارگیری آن در تدوین گزارشات‏کاری</td>
                                <td>مکاتبات ‏اداری</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <?
                                $row = 24;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>تسلط و بکارگیری نرم‌‏افزارهای تخصصی مرتبط با شغل و شرح وظایف بر اساس شغل</td>
                                <td>نرم‌‌‏افزارهای‏ شغلی</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <?
                                $row = 25;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td align="right"> تسلط در استفاده از سامانه‌‏های دانشگاه و مهارت‌‏های ICDL در انجام وظایف   </td>
                                <td>مهارت عمومی فاوا </td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <?
                                $row = 26;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>

                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>
                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k]):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>&nbsp;</td>
                                <td>
                                    <? foreach($list['exists3'] as $k => $v){ if($v['insert_date'] !=''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow3'].'<br>'; }}?>
                                    <? foreach($list['exists2'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow3'].'<br>'; }}?>

                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['newrow3'].'<br>'; ?>
                                    <textarea name="newrow3" cols="100" class="right extra" id="newrow3"><?=$list['exists1'][0]['newrow3']?></textarea></td>
                                <td>
                                    <? foreach($list['exists3'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow1'].'<br>'; }}?>
                                    <? foreach($list['exists2'] as $k => $v){  if($v['insert_date'] !=''){ echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow1'].'<br>'; }}?>

                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['newrow1'].'<br>'; ?>
                                    <input name="newrow1" type="text" class="right extra" id="newrow1" value="<?=($list['exists1'][0]['newrow1']);?>" /></td>
                                <td rowspan="2">شاخص‌های پیشنهادی</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <?
                                $row = 27;
                                for($k=3;$k>=1;$k--):?>
                                    <td class="s<?=$k?>"><? echo $list['vazn'.($row+(27*($k-1)))]*$list['exists'.$k][0]['menu'.($row)]; ?></td>
                                    <td>
                                        <?=($list['exists'.$k][0]['insert_date'] != ''&& strpos($list['exists'.$k][0]['menu'.($row)],'t') !== 0)? translate($list['exists'.$k][0]['menu'.($row)]):'';?>

                                        <? if(($list['exists'.$k][0]['insert_date']) == '' && $admin_info['admin_id'] == $list['admin'.$k] && $admin_info['admin_id'] == $list['admin'.$k] ):?>
                                            <select name="menu<?=($row)?>" id="menu<?=($row)?>">
                                                <option <?=($list['exists'.$k][0]['menu'.(($row))] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                                <option <?=($list['exists'.$k][0]['menu'.($row)] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                            </select>
                                        <? endif;?>
                                    </td>
                                <? endfor;?>
                                <td>&nbsp;</td>
                                <td>
                                    <? foreach($list['exists3'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow4'].'<br>'; }}?>
                                    <? foreach($list['exists2'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow4'].'<br>'; }}?>

                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['newrow4'].'<br>'; ?>
                                    <textarea name="newrow4" cols="100" class="right extra" id="newrow4"><?=($list['exists1'][0]['newrow4']);?> </textarea></td>
                                <td>
                                    <? foreach($list['exists3'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow2'].'<br>'; }}?>
                                    <? foreach($list['exists2'] as $k => $v){  if($v['insert_date'] !=''){echo $list['admins'][$v['admin_id2']]['name'].' '.$list['admins'][$v['admin_id2']]['family'].' : '.$v['newrow2'].'<br>'; }}?>

                                    <? echo $list['admins'][$list['exists1'][0]['admin_id2']]['name'].' '.$list['admins'][$list['exists1'][0]['admin_id2']]['family'].' : '.$list['exists1'][0]['newrow2'].'<br>'; ?>
                                    <input name="newrow2"  type="text" class="right extra" id="newrow2" value="<?=($list['exists1'][0]['newrow2']);?>" /></td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td id="s3"><?
                                    foreach($list['exists3'] as $k => $v){
                                        $sum = 0;
                                        ?>

                                        <?
                                        for ($kk=1 ;$kk<=27 ;$kk++)
                                        {
                                            $sum += $list['vazn'.($kk+54)]*$v['menu'.($kk)];
                                        }
                                        echo $sum;

                                    }?></td>
                                <td></td>
                                <td id="s2"><?
                                    foreach($list['exists2'] as $k => $v){
                                        $sum = 0;
                                        for ($kk=1 ;$kk<=27 ;$kk++)
                                        {
                                            //echo $list['vazn'.($kk+27)]."*".$v['menu'.($kk)].'<br>';
                                            $sum += $list['vazn'.($kk+27)]*$v['menu'.($kk)];
                                        }
                                        echo $sum;

                                    }
                                    ?></td>
                                <td>
                                </td>
                                <td id="s1">

                                    <?
                                    foreach($list['exists1'] as $k => $v){
                                        $sum = 0;
                                        for ($kk=1 ;$kk<=27 ;$kk++)
                                        {
                                            $sum += $list['vazn'.$kk]*$v['menu'.$kk];
                                        }
                                        echo $sum;
                                    }?>

                                <td>

                                </td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="3">جمع</td>
                            </tr>
                        </table>
                        <p class="text-center hiddenForm" style="padding: 0 30px">
                            <?// if($admin1 == 1 && $admin2 == 1 && $admin3==1){?>
                            <input class="btn btn-primary btn-default text-white text-16" name="submit" id="submit" value="ثبت" type="submit">
                            <?// }?>
                        </p>

                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>