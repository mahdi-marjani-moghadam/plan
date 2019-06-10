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

                    <form id="form1" name="form1" method="post" action="">
                        <table width="1238" border="1" align="center" style="direction: rtl">
                            <tr bgcolor="#FFFFCC">
                            <td><img src="<?=TEMPLATE_DIR?>images/logo@2x.png" width="110" height="88" alt="arz" /></td>
                            <td><p>کاربرگ شماره 6</p></td>
                            <td colspan="2">اعلام نتایج ارزیابی عملکرد اعضای غیر هیأت علمی دانشگاه الزهرا(س)-;کارشناس مسئول-کارشناس و سطوح پایین تر-رئیس گروه/اداره </td>
                            <td width="112">دوره ارزیابی:</td>
                            <td width="122"> سال 95</td>
                            </tr>
                            <tr>
                                <td colspan="6" bgcolor="#FFFFCC">ارزیابی شونده</td>
                            </tr>
                            <tr>
                                <td width="168" bgcolor="#FFFFCC">نام: </td>
                                <td width="170" bgcolor="#FFFFCC"><?=$list['name']?></td>
                                <td width="222" bgcolor="#FFFFCC">حوزه اصلی ارزیابی:</td>
                                <td width="404" bgcolor="#FFFFCC"><?=$list['vahed_asli']?></td>
                                <td bgcolor="#FFFFCC">سمت کنونی:</td>
                                <td bgcolor="#FFFFCC"><?=$list['semat']?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC">نام خانوادگی:</td>
                                <td bgcolor="#FFFFCC"><?=$list['family']?></td>
                                <td bgcolor="#FFFFCC">واحد فرعی ارزیابی:</td>
                                <td bgcolor="#FFFFCC"><?=$list['vahed_fari']?></td>
                                <td bgcolor="#FFFFCC">تاریخ اعلام نتیجه ارزیابی:</td>
                                <td bgcolor="#FFFFCC"><?=convertDate($list['exists3']['insert_date'])?></td>

                            </tr>
                        </table>
                        <p>&nbsp;</p>
                        <table width="1236" height="193" border="1"style="direction: rtl">
                            <tr>
                                <td colspan="3" bgcolor="#FFFFCC"> تحلیل عملکرد ارزیابی شونده</td>
                            </tr>
                            <tr bgcolor="#FFFFCC">
                                <td width="10">ردیف</td>
                                <td width="622">نقاط قوت ارزیابی شونده:</td>
                                <td width="482">نقاط ضعف ارزیابی شونده:</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row6'].'<br>'; }?></td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row11'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row7'].'<br>'; }?></td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row12'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row8'].'<br>'; }?></td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row13'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row9'].'<br>'; }?></td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row14'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row10'].'<br>'; }?></td>
                                <td><? foreach($list['emza'] as $k => $v){echo $v['row15'].'<br>';}?></td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>
                        <table width="1233" border="1"style="direction: rtl">
                            <tr bgcolor="#FFFFCC">
                                <td width="93">ردیف</td>
                                <td colspan="4">راهکارهای پیشنهادی بهبود عملکرد ارزیابی شونده:</td>
                                <td>امضا رئیس کمیته</td>
                                <td>امضا دبیر کمیته</td>

                            </tr>
                            <tr>
                                <td>1</td>
                                <td colspan="4"><? foreach($list['emza'] as $k => $v){echo $v['row1'].'<br>';}?></td>
                                <td rowspan="5"><? if( $list['emza'][0]['admin_id2'] == $list['admin1'] ){?>
                                       <img width="200" src='<?=RELA_DIR?>statics/emza/111.png'>
                                    <? }?></td>
                                <td rowspan="5"><? if( $list['emza'][0]['admin_id2'] == $list['admin1'] ){?>
                                       <img width="200" src='<?=RELA_DIR?>statics/emza/12000000.png'>
                                    <? }?></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td colspan="4"><? foreach($list['emza'] as $k => $v){echo $v['row2'].'<br>';}?></td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td colspan="4"><? foreach($list['emza'] as $k => $v){echo $v['row3'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td colspan="4"><? foreach($list['emza'] as $k => $v){echo $v['row4'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td colspan="4"><? foreach($list['emza'] as $k => $v){echo $v['row5'].'<br>';}?></td>
                            </tr>
                            <tr>
                                <td width="128" rowspan=""><p>امضاءارزیابی کننده </p>
                                    <p>(مدیر بلافصل)</p></td>
                                <td width="222" rowspan="">
                                    <? if( $list['emza'][0]['admin_id2'] == $list['admin1'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin1']?>.png'>
                                    <? }?>

                                <td width="561" rowspan=""><p>امضاءارزیابی کننده </p>
                                    <p>(مدیر میانی )</p></td>
                                <td width="369" rowspan="">
                                    <? if( $list['emza'][1]['admin_id2'] == $list['admin2'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin2']?>.png'>
                                    <? }?>
                                </td>

                                <td width="369" rowspan=""><p>امضاءارزیابی کننده</p>
                                <p>(مدیر نهایی )</p></td>
                                <td width="369" rowspan="">
                                    <? if( $list['emza'][2]['admin_id2'] == $list['admin3'] ){?>
                                        <img width="200" src='<?=RELA_DIR?>statics/emza/<?=$list['admin3']?>.png'>
                                    <? }?>
                                </td>

                                <td width="174" colspan="4" height="53"> تاریخ رویت:   <?=convertDate($admin_info['first_login'])?> </td>

                                    <p></p></td>

                                </td>
                            </tr>
                        </table>
                        <p>
                            <label for="text box"></label>
                        </p>
                        <table width="1234" border="1" align="center" style="direction: rtl">
                            <tr>
                                <td width="47" bgcolor="#99CCFF">ردیف</td>
                                <td width="133" bgcolor="#99CCFF">معیار</td>
                                <td width="171" bgcolor="#99CCFF">شاخص</td>
                                <td width="758" bgcolor="#99CCFF">توصیف شاخص</td>
                                <td width="91" bgcolor="#99CCFF">سقف امتیاز </td>
                                <td width="91" bgcolor="#99CCFF">امتیاز نهایی</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td rowspan="5">اخلاق حرفه‌ای</td>
                                <td>تعظیم شعائر</td>
                                <td>احترام به ارزش‌های اسلامی، شئونات اجتماعی و پوشش متناسب با محیط‏ کار</td>
                                <td>
                                <? $user= ($list['exists'][0]['menu1']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu1']==0)?0:4; ?>
                                <?= (($user*$list['vazn1']*0.25)+(($final*$list['vazn1']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu1']*$list['vazn1']*0.25)+($list['exists2'][0]['menu1']*$list['vazn1']*0.55)+($list['exists3']['menu1'])  ?>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>حضور به موقع *</td>
                                <td>نداشتن تأخیر در ورود و تعجیل در خروج و نداشتن غیبت</td>
                                <td><? $user= ($list['exists'][0]['menu2']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu2']==0)?0:4; ?>
                                <?= (($user*$list['vazn2']*0.25)+(($final*$list['vazn2']*0.55)))+3  ?></td>

                                <td><?= ($list['exists'][0]['menu2']*$list['vazn2']*0.25)+($list['exists2'][0]['menu2']*$list['vazn2']*0.55)+($list['exists3']['menu2'])  ?></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>حسن خلق</td>
                                <td>مدارا و حسن معاشرت با مدیران و همکاران</td>
                                <td><? $user= ($list['exists'][0]['menu3']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu3']==0)?0:4; ?>
                                <?= (($user*$list['vazn3']*0.25)+(($final*$list['vazn3']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu3']*$list['vazn3']*0.25)+($list['exists2'][0]['menu3']*$list['vazn3']*0.55)+($list['exists3']['menu3'])  ?></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>وجدان کاری</td>
                                <td>خود کنترلی و عدم نیاز به کنترل مستقیم و مداوم مسئول واحد</td>
                                <td><? $user= ($list['exists'][0]['menu4']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu4']==0)?0:4; ?>
                                <?= (($user*$list['vazn4']*0.25)+(($final*$list['vazn4']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu4']*$list['vazn4']*0.25)+($list['exists2'][0]['menu4']*$list['vazn4']*0.55)+($list['exists3']['menu4'])  ?></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>تکریم ارباب رجوع</td>
                                <td>ادب، خوشرویی، خویشتن‌‏داری، سعه‌‏صدر و تواضع در برخورد با مراجعین</td>
                                <td><? $user= ($list['exists'][0]['menu5']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu5']==0)?0:4; ?>
                                <?= (($user*$list['vazn5']*0.25)+(($final*$list['vazn5']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu5']*$list['vazn5']*0.25)+($list['exists2'][0]['menu5']*$list['vazn5']*0.55)+($list['exists3']['menu5'])  ?></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td rowspan="5">تعهد سازمانی</td>
                                <td> مسئولیت پذیری</td>
                                <td>پشتکار، جدیت، سخت‏کوشی و پیگیری امور تا حصول نتیجه</td>
                                <td><? $user= ($list['exists'][0]['menu6']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu6']==0)?0:4; ?>
                                <?= (($user*$list['vazn6']*0.25)+(($final*$list['vazn6']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu6']*$list['vazn6']*0.25)+($list['exists2'][0]['menu6']*$list['vazn6']*0.55)+($list['exists3']['menu6'])  ?></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>تعالی سازمانی</td>
                                <td>تلاش در راستای بهبود عملکرد و تحقق اهداف واحد و دانشگاه</td>
                                <td><? $user= ($list['exists'][0]['menu7']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu7']==0)?0:4; ?>
                                <?= (($user*$list['vazn7']*0.25)+(($final*$list['vazn7']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu7']*$list['vazn7']*0.25)+($list['exists2'][0]['menu7']*$list['vazn7']*0.55)+($list['exists3']['menu7'])  ?></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>مشارکت</td>
                                <td>تشریک مساعی در تنظیم خط‏‌‌ مشی داخلی و شیوه‏‌نامه‌‏های مورد نیاز</td>
                                <td><? $user= ($list['exists'][0]['menu8']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu8']==0)?0:4; ?>
                                <?= (($user*$list['vazn8']*0.25)+(($final*$list['vazn8']*0.55)))  ?></td>
                                <td><?= ($list['exists'][0]['menu8']*$list['vazn8']*0.25)+($list['exists2'][0]['menu8']*$list['vazn8']*0.55)+($list['exists3']['menu8'])  ?></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>رفتار شهروندی سازمانی</td>
                                <td>رفتار فردی و داوطلبانه‌‏ی منجر به ارتقای اثر بخشی واحد خارج از شرح وظایف سازمانی و یا خارج از ساعت اداری</td>
                                <td><? $user= ($list['exists'][0]['menu9']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu9']==0)?0:4; ?>
                                <?= (($user*$list['vazn9']*0.25)+(($final*$list['vazn9']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu9']*$list['vazn9']*0.25)+($list['exists2'][0]['menu9']*$list['vazn9']*0.55)+($list['exists3']['menu9'])  ?></td>
                            </tr>

                            <tr>
                                <td>10</td>
                                <td>انگیزش</td>
                                <td>میزان تمایل و علاقه به انجام وظایف شغلی</td>
                                <td><? $user= ($list['exists'][0]['menu10']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu10']==0)?0:4; ?>
                                <?= (($user*$list['vazn10']*0.25)+(($final*$list['vazn10']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu10']*$list['vazn10']*0.25)+($list['exists2'][0]['menu10']*$list['vazn10']*0.55)+($list['exists3']['menu10'])  ?></td>
                            </tr>

                            <tr>
                                <td>11</td>
                                <td rowspan="4">مهارت‌های ارتباطی</td>
                                <td>تعاملات</td>
                                <td>برقراری ارتباط میان فردی مناسب با همکاران و مدیران ایجاد تفاهم و تعامل مناسب</td>
                                <td><? $user= ($list['exists'][0]['menu11']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu11']==0)?0:4; ?>
                                <?= (($user*$list['vazn11']*0.25)+(($final*$list['vazn11']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu11']*$list['vazn11']*0.25)+($list['exists2'][0]['menu11']*$list['vazn11']*0.55)+($list['exists3']['menu11'])  ?></td>
                            </tr>

                            <tr>
                                <td>12</td>
                                <td>انعطاف پذیری</td>
                                <td>واکنش مناسب در برابر چالش‏‌های موجود و قابلیت ‏سازگاری در محیط کار</td>
                                <td><? $user= ($list['exists'][0]['menu12']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu12']==0)?0:4; ?>
                                <?= (($user*$list['vazn12']*0.25)+(($final*$list['vazn12']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu12']*$list['vazn12']*0.25)+($list['exists2'][0]['menu12']*$list['vazn12']*0.55)+($list['exists3']['menu12'])  ?></td>
                            </tr>

                            <tr>
                                <td>13</td>
                                <td>انتقاد پذیری</td>
                                <td>ظرفیت ‏پذیرش انتقادات و کوشش در اصلاح رفتارهای ناپسند بدون نشان‏ دادن عکس‏‌العمل منفی</td>
                                <td><? $user= ($list['exists'][0]['menu13']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu13']==0)?0:4; ?>
                                <?= (($user*$list['vazn13']*0.25)+(($final*$list['vazn13']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu13']*$list['vazn13']*0.25)+($list['exists2'][0]['menu13']*$list['vazn13']*0.55)+($list['exists3']['menu13'])  ?></td>
                            </tr>

                            <tr>
                                <td>14</td>
                                <td>کارگروهی*</td>
                                <td>حضور فعال در گروه‌‏های کاری و ایجاد هم‌افزایی در واحد مربوطه</td>
                                <td><? $user= ($list['exists'][0]['menu14']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu14']==0)?0:4; ?>
                                <?= (($user*$list['vazn14']*0.25)+(($final*$list['vazn14']*0.55)))+5  ?></td>

                                <td><?= ($list['exists'][0]['menu14']*$list['vazn14']*0.25)+($list['exists2'][0]['menu14']*$list['vazn14']*0.55)+($list['exists3']['menu14'])  ?></td>
                            </tr>

                            <tr>
                                <td>15</td>
                                <td rowspan="4">یاددهی و یادگیری</td>
                                <td>*دوره های آموزشی</td>
                                <td>مشارکت فعال در دوره‌‏های آموزشی مرتبط با شغل و بکارگیری آموخته‏‌ها در عمل</td>
                                <td><? $user= ($list['exists'][0]['menu15']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu15']==0)?0:4; ?>
                                <?= (($user*$list['vazn15']*0.25)+(($final*$list['vazn15']*0.55)))+3  ?></td>

                                <td><?= ($list['exists'][0]['menu15']*$list['vazn15']*0.25)+($list['exists2'][0]['menu15']*$list['vazn15']*0.55)+($list['exists3']['menu15'])  ?></td>
                            </tr>

                            <tr>
                                <td>16</td>
                                <td>دانش ‏افزایی </td>
                                <td>خود‏آموزی و کوشش در افزایش سطح دانش ‏شغلی </td>
                                <td><? $user= ($list['exists'][0]['menu16']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu16']==0)?0:4; ?>
                                <?= (($user*$list['vazn16']*0.25)+(($final*$list['vazn16']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu16']*$list['vazn16']*0.25)+($list['exists2'][0]['menu16']*$list['vazn16']*0.55)+($list['exists3']['menu16'])  ?></td>
                            </tr>

                            <tr>
                                <td>17</td>
                                <td>آموزش به دیگران</td>
                                <td>توانایی انتقال معلومات و مهارت‌های شغلی به همکاران</td>
                                <td><? $user= ($list['exists'][0]['menu17']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu17']==0)?0:4; ?>
                                <?= (($user*$list['vazn17']*0.25)+(($final*$list['vazn17']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu17']*$list['vazn17']*0.25)+($list['exists2'][0]['menu17']*$list['vazn17']*0.55)+($list['exists3']['menu17'])  ?></td>
                            </tr>

                            <tr>
                                <td>18</td>
                                <td>مدیریت دانش</td>
                                <td>مستند‏سازی تجربیات و فرایندهای کاری شناسایی مسائلی که در حین انجام کار پیش آمده و راه‌‏حل‏‌هایی که عضو برای مسائل به آن رسیده</td>
                                <td><? $user= ($list['exists'][0]['menu18']==0)?0:4; ?>
                                <? $final= ($list['exists2'][0]['menu18']==0)?0:4; ?>
                                <?= (($user*$list['vazn18']*0.25)+(($final*$list['vazn18']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu18']*$list['vazn18']*0.25)+($list['exists2'][0]['menu18']*$list['vazn18']*0.55)+($list['exists3']['menu18'])  ?></td>
                            </tr>

                            <tr>
                                <td>19</td>
                                <td rowspan="7">توانمندی شغلی</td>
                                <td>تسلط بر شغل و قانون‏‌مداری</td>
                                <td>آشنایی کامل بر شرح وظایف، بخشنامه‏‌ها، آیین‏ نامه‏‌ها و دستورالعمل‏‌های شغلی و رعایت قوانین و مقررات در کلیه امور</td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu19']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu19']==0)?0:4; ?>
                                    <?= (($user*$list['vazn19']*0.25)+(($final*$list['vazn19']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu19']*$list['vazn19']*0.25)+($list['exists2'][0]['menu19']*$list['vazn19']*0.55)+($list['exists3']['menu19'])  ?></td>
                            </tr>

                            <tr>
                                <td>20</td>
                                <td>خلاقیت و نو‏آوری *</td>
                                <td>ارائه پیشنهادات کارشناسی و بهبود فرایند انجام کار در حیطه وظایف‏ شغلی</td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu20']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu20']==0)?0:4; ?>
                                    <?= (($user*$list['vazn20']*0.25)+(($final*$list['vazn20']*0.55)))+5  ?></td>

                                <td><?= ($list['exists'][0]['menu20']*$list['vazn20']*0.25)+($list['exists2'][0]['menu20']*$list['vazn20']*0.55)+($list['exists3']['menu20'])  ?></td>
                            </tr>

                            <tr>
                                <td>21</td>
                                <td>مدیریت ‏زمان</td>
                                <td>اولویت‏ بندی امور محوله و الزام به اتمام آن در زمان مقرر</td>

                                <td>
                                    <? $user= ($list['exists'][0]['menu21']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu21']==0)?0:4; ?>
                                    <?= (($user*$list['vazn21']*0.25)+(($final*$list['vazn21']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu21']*$list['vazn21']*0.25)+($list['exists2'][0]['menu21']*$list['vazn21']*0.55)+($list['exists3']['menu21'])  ?></td>
                            </tr>

                            <tr>
                                <td>22</td>
                                <td>گزارش‏‌دهی *</td>
                                <td>توانایی نگارش گزارشات تخصصی و فنی‏ کاربردی و قابل فهم با استفاده از شیوه‏‌های پذیرفته شده علمی</td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu22']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu22']==0)?0:4; ?>
                                    <?= (($user*$list['vazn22']*0.25)+(($final*$list['vazn22']*0.55)))+4  ?></td>

                                <td><?= ($list['exists'][0]['menu22']*$list['vazn22']*0.25)+($list['exists2'][0]['menu22']*$list['vazn22']*0.55)+($list['exists3']['menu22'])  ?></td>
                            </tr>

                            <tr>
                                <td>23</td>
                                <td>مکاتبات ‏اداری</td>
                                <td>میزان تسلط به آیین نگارش ‏اداری و بکارگیری آن در تدوین گزارشات‏ کاری</td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu23']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu23']==0)?0:4; ?>
                                    <?= (($user*$list['vazn23']*0.25)+(($final*$list['vazn23']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu23']*$list['vazn23']*0.25)+($list['exists2'][0]['menu23']*$list['vazn23']*0.55)+($list['exists3']['menu23'])  ?></td>
                            </tr>

                            <tr>
                                <td>24</td>
                                <td>نرم‌‌‏افزارهای‏ شغلی</td>
                                <td>تسلط و بکارگیری نرم‌‏افزارهای تخصصی مرتبط با شغل و شرح وظایف بر اساس شغل</td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu24']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu24']==0)?0:4; ?>
                                    <?= (($user*$list['vazn24']*0.25)+(($final*$list['vazn24']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu24']*$list['vazn24']*0.25)+($list['exists2'][0]['menu24']*$list['vazn24']*0.55)+($list['exists3']['menu24'])  ?></td>
                            </tr>

                            <tr>
                                <td>25</td>
                                <td>مهارت عمومی فاوا </td>
                                <td> تسلط در استفاده از سامانه‌‏های دانشگاه و مهارت‌‏های ICDL در انجام وظایف </td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu25']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu25']==0)?0:4; ?>
                                    <?= (($user*$list['vazn25']*0.25)+(($final*$list['vazn25']*0.55)))  ?></td>

                                <td><?= ($list['exists'][0]['menu25']*$list['vazn25']*0.25)+($list['exists2'][0]['menu25']*$list['vazn25']*0.55)+($list['exists3']['menu25'])  ?></td>
                            </tr>

                            <tr>
                                <td>26</td>
                                <td rowspan="2">شاخص‌های پیشنهادی</td>
                                <td><? foreach($list['exists'] as $k => $v){echo 'ارزیابی شونده:'.$v['newrow1'].'<br>';}?>
                                <? foreach($list['exists2'] as $k => $v){echo 'ارزیابی کننده:'.$v['newrow1'].'<br>';}?></td>
                                <td><? foreach($list['exists'] as $k => $v){echo 'ارزیابی شونده:'.$v['newrow3'].'<br>';}?>
                               <? foreach($list['exists2'] as $k => $v){echo 'ارزیابی کننده:'.$v['newrow3'].'<br>';}?></td>

                                <td>
                                    <? $user= ($list['exists'][0]['menu26']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu26']==0)?0:4; ?>
                                    <?= (($user*$list['vazn26']*0.25)+($final*$list['vazn80']*0.55))  ?></td>
                                <td><?=
                                    ($list['exists'][0]['menu26']*$list['vazn26']*0.25)+                                                                                  ($list['exists2'][0]['menu26']*$list['vazn80']*0.55)+
                                    ($list['exists3']['menu26'])  ?></td>
                             </tr>
                            <tr>
                                <td>27</td>
                                <td><? foreach($list['exists'] as $k => $v){echo 'ارزیابی شونده'.$v['newrow2'].'<br>';}?>
                                    <? foreach($list['exists2'] as $k => $v){echo 'ارزیابی کننده'.$v['newrow2'].'<br>';}?></td>
                                <td><? foreach($list['exists'] as $k => $v){echo 'ارزیابی شونده'.$v['newrow4'].'<br>';}?>
                                    <? foreach($list['exists2'] as $k => $v){echo 'ارزیابی کننده'.$v['newrow4'].'<br>';}?></td>
                                <td>
                                    <? $user= ($list['exists'][0]['menu27']==0)?0:4; ?>
                                    <? $final= ($list['exists2'][0]['menu27']==0)?0:4; ?>
                                    <?= (($user*$list['vazn27']*0.25)+(($final*$list['vazn27']*0.55)))  ?></td>

                                <td><?=
                                    ($list['exists'][0]['menu27']*$list['vazn27']*0.25)+
                                    ($list['exists2'][0]['menu27']*$list['vazn81']*0.55)+
                                    ($list['exists3']['menu27'])  ?></td>
                            </tr>
                            <tr>
                                <td colspan="3">جمع</td>
                                <td>امتیاز نهایی:</td>
                                <td><?
                                    $sum = 0;
                                    for($p=1;$p<=27;$p++){
                                        $user = ($list['exists'][0]['menu'.$p]==0)?0:4;
                                        $final = ($list['exists2'][0]['menu'.$p]==0)?0:4;
                                        $sum +=
                                            ($user*$list['vazn'.$p]*0.25)+
                                            ($final*$list['vazn'.($p+54)]*0.55)
                                        ;
                                    }
                                   echo $sum+20;?></td>

                                <td><?
                                    $sum = 0;
                                    for($p=1;$p<=27;$p++){
                                        $sum +=
                                            ($list['exists'][0]['menu'.$p]*$list['vazn'.$p]*0.25)+
                                            ($list['exists2'][0]['menu'.$p]*$list['vazn'.($p+54)]*0.55)+
                                            ($list['exists3']['menu'.$p])
                                        ;
                                    }
                                    echo $sum;?></td>
                            </tr>
                        </table>
                        <style>
                            @media   print {
                                html,tr,td{ direction: rtl;}
                            }
                        </style>
                        <script>var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 1;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js,pf;pf=document.createElement('script');pf.type='text/javascript';pf.src='//cdn.printfriendly.com/printfriendly.js';document.getElementsByTagName('head')[0].appendChild(pf)})();</script><a href="https://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="//cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
                        <p>&nbsp; </p>
                        <p>&nbsp;</p>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>