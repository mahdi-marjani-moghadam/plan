
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
        direction: ltr;
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
                        <table width="1238" border="1" align="center" style="direction: ltr">
                            <tr bgcolor="#FFFFCC">
                                <td width="122"> سال 95</td>
                                <td width="112">دوره ارزیابی:</td>
                                <td colspan="2">کاربرگ محاسبه امتیاز کل ارزیابی عملکرد اعضای غیر هیأت علمی دانشگاه الزهرا(س)-;کارشناس مسئول-کارشناس و سطوح پایین تر </td>
                                <td><p>کاربرگ شماره 5</p></td>
                                <td><img src="<?=RELA_DIR?>templates/admin/images/logo@2x.png" width="140" height="118" alt="arz" /></td>
                            </tr>
                            <tr>
                                <td colspan="4" bgcolor="#FFFFCC">ارزیابی کننده نهایی(مدیر نهایی)</td>
                                <td colspan="2" bgcolor="#FFFFCC">ارزیابی شونده</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC"><?=$admin_info['vahed_asli']?></td>
                                <td bgcolor="#FFFFCC">حوزه اصلی ارزیابی:</td>
                                <td width="404" bgcolor="#FFFFCC"><?=$admin_info['name']?></td>
                                <td width="222" bgcolor="#FFFFCC">نام:</td>
                                <td width="170" bgcolor="#FFFFCC"><?=$list['name']?></td>
                                <td width="168" bgcolor="#FFFFCC">:نام </td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC"><?=$admin_info['vahed_fari']?></td>
                                <td bgcolor="#FFFFCC">واحد فرعی ارزیابی:</td>
                                <td bgcolor="#FFFFCC"><?=$admin_info['family']?></td>
                                <td bgcolor="#FFFFCC">:نام خانوادگی</td>
                                <td bgcolor="#FFFFCC"><?=$list['family']?></td>
                                <td bgcolor="#FFFFCC">:نام خانوادگی</td>
                            </tr>
                           <!-- <tr>
                                <td colspan="2" bgcolor="#FFFFCC">&nbsp;</td>
                                <td colspan="4" bgcolor="#FFFFCC">امتیاز کل:</td>
                            </tr>-->
                        </table>
                        <p>&nbsp;</p>
                        <table width="1639" border="1" align="center" style="direction: ltr; text-align: right;">
                            <tr>
                                <td colspan="3" bgcolor="#99CCFF">کمیته ارزیابی</td>
                                <td width="105" bgcolor="#99CCFF">مرکز ارزیابی</td>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی کننده</td>
                                <td colspan="2" bgcolor="#99CCFF">ارزیابی شونده</td>
                                <td width="729" rowspan="3" bgcolor="#99CCFF">توصیف شاخص</td>
                                <td width="162" rowspan="3" bgcolor="#99CCFF">شاخص</td>
                                <td width="128" rowspan="3" bgcolor="#99CCFF">معیار</td>
                                <td width="82" rowspan="3" bgcolor="#99CCFF">ردیف</td>
                            </tr>
                            <tr>
                                <td width="65" bgcolor="#99CCFF">امتیاز کل</td>
                                <td colspan="2" bgcolor="#99CCFF">امتیاز</td>
                                <td width="105" bgcolor="#99CCFF">اعتبار سنجی</td>
                                <td colspan="2" bgcolor="#99CCFF">امتیاز</td>
                                <td colspan="2" bgcolor="#99CCFF">امتیاز</td>
                            </tr>
                            <tr>
                                <td width="65" bgcolor="#99CCFF">&nbsp;</td>
                                <td width="47" bgcolor="#99CCFF">وزن</td>
                                <td width="43" bgcolor="#99CCFF">CA</td>
                                <td width="105" bgcolor="#99CCFF">DV</td>
                                <td width="51" bgcolor="#99CCFF">وزن</td>
                                <td width="40" bgcolor="#99CCFF">MA</td>
                                <td width="56" bgcolor="#99CCFF">وزن</td>
                                <td bgcolor="#99CCFF">SA</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu1']*$list['vazn1']*0.25)+($list['exists2'][0]['menu1']*$list['vazn1']*0.55)+($list['exists3']['menu1'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn1']*$v['menu1']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn1']*$v['menu1']; }?></td>
                                <td>احترام به ارزش‌های اسلامی، شئونات اجتماعی و پوشش متناسب با محیط‏ کار</td>
                                <td>تعظیم شعائر</td>
                                <td rowspan="5">اخلاق حرفه‌ای</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu2']*$list['vazn2']*0.25)+($list['exists2'][0]['menu2']*$list['vazn2']*0.55)+($list['exists3']['menu2'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="menu2" value="<?=($list['exists3']['menu2'])?>" ></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn2']*$v['menu2']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn2']*$v['menu2']; }?></td>
                                <td>نداشتن تأخیر در ورود و تعجیل در خروج و نداشتن غیبت</td>
                                <td> *حضور به موقع</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu3']*$list['vazn3']*0.25)+($list['exists2'][0]['menu3']*$list['vazn3']*0.55)+($list['exists3']['menu3'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn3']*$v['menu3']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn3']*$v['menu3']; }?></td>
                                <td>مدارا و حسن معاشرت با مدیران و همکاران</td>
                                <td>حسن خلق</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu4']*$list['vazn4']*0.25)+($list['exists2'][0]['menu4']*$list['vazn4']*0.55)+($list['exists3']['menu4'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn4']*$v['menu4']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn4']*$v['menu4']; }?></td>
                                <td>خود کنترلی و عدم نیاز به کنترل مستقیم و مداوم مسئول واحد</td>
                                <td>وجدان کاری</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu5']*$list['vazn5']*0.25)+($list['exists2'][0]['menu5']*$list['vazn5']*0.55)+($list['exists3']['menu5'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn5']*$v['menu5']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn5']*$v['menu5']; }?></td>
                                <td>ادب، خوشرویی، خویشتن‌‏داری، سعه‌‏صدر و تواضع در برخورد با مراجعین</td>
                                <td>تکریم ارباب رجوع</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu6']*$list['vazn6']*0.25)+($list['exists2'][0]['menu6']*$list['vazn6']*0.55)+($list['exists3']['menu6'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td width="55"><?foreach($list['exists2'] as $k => $v){ echo $list['vazn6']*$v['menu6']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn6']*$v['menu6']; }?></td>
                                <td>پشتکار، جدیت، سخت‏کوشی و پیگیری امور تا حصول نتیجه</td>
                                <td> مسئولیت پذیری</td>
                                <td rowspan="5">تعهد سازمانی</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu7']*$list['vazn7']*0.25)+($list['exists2'][0]['menu7']*$list['vazn7']*0.55)+($list['exists3']['menu7'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn7']*$v['menu7']; }?></td>
                                <td>0.25</td>
                                <td width="55"><?foreach($list['exists'] as $k => $v){ echo $list['vazn7']*$v['menu7']; }?></td>
                                <td>تلاش در راستای بهبود عملکرد و تحقق اهداف واحد و دانشگاه</td>
                                <td>تعالی سازمانی</td>
                                <td>7</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu8']*$list['vazn8']*0.25)+($list['exists2'][0]['menu8']*$list['vazn8']*0.55)+($list['exists3']['menu8'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn8']*$v['menu8']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn8']*$v['menu8']; }?></td>
                                <td>تشریک مساعی در تنظیم خط‏‌‌ مشی داخلی و شیوه‏‌نامه‌‏های مورد نیاز</td>
                                <td>مشارکت</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu9']*$list['vazn9']*0.25)+($list['exists2'][0]['menu9']*$list['vazn9']*0.55)+($list['exists3']['menu9'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn9']*$v['menu9']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn9']*$v['menu9']; }?></td>
                                <td>رفتار فردی و داوطلبانه‌‏ی منجر به ارتقای اثر بخشی واحد خارج از شرح وظایف سازمانی و یا خارج از ساعت اداری</td>
                                <td>رفتار شهروندی سازمانی</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu10']*$list['vazn10']*0.25)+($list['exists2'][0]['menu10']*$list['vazn10']*0.55)+($list['exists3']['menu10'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn10']*$v['menu10']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn10']*$v['menu10']; }?></td>
                                <td>میزان تمایل و علاقه به انجام وظایف شغلی</td>
                                <td>انگیزش</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu11']*$list['vazn11']*0.25)+($list['exists2'][0]['menu11']*$list['vazn11']*0.55)+($list['exists3']['menu11'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn11']*$v['menu11']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn11']*$v['menu11']; }?></td>
                                <td>برقراری ارتباط میان فردی مناسب با همکاران و مدیران ایجاد تفاهم و تعامل مناسب</td>
                                <td>تعاملات</td>
                                <td rowspan="4">مهارت‌های ارتباطی</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu12']*$list['vazn12']*0.25)+($list['exists2'][0]['menu12']*$list['vazn12']*0.55)+($list['exists3']['menu12'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn12']*$v['menu12']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn12']*$v['menu12']; }?></td>
                                <td>واکنش مناسب در برابر چالش‏‌های موجود و قابلیت ‏سازگاری در محیط کار</td>
                                <td>انعطاف پذیری</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu13']*$list['vazn13']*0.25)+($list['exists2'][0]['menu13']*$list['vazn13']*0.55)+($list['exists3']['menu13'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn13']*$v['menu13']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn13']*$v['menu13']; }?></td>
                                <td>ظرفیت ‏پذیرش انتقادات و کوشش در اصلاح رفتارهای ناپسند بدون نشان‏ دادن عکس‏‌العمل منفی</td>
                                <td>انتقاد پذیری</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu14']*$list['vazn14']*0.25)+($list['exists2'][0]['menu14']*$list['vazn14']*0.55)+($list['exists3']['menu14'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="menu14" value="<?=($list['exists3']['menu14'])?>" ></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn14']*$v['menu14']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn14']*$v['menu14']; }?></td>
                                <td>حضور فعال در گروه‌‏های کاری و ایجاد هم‌افزایی در واحد مربوطه</td>
                                <td>*کارگروهی</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu15']*$list['vazn15']*0.25)+($list['exists2'][0]['menu15']*$list['vazn15']*0.55)+($list['exists3']['menu15'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="menu15" value="<?=($list['exists3']['menu15'])?>" ></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn15']*$v['menu15']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn15']*$v['menu15']; }?></td>
                                <td>مشارکت فعال در دوره‌‏های آموزشی مرتبط با شغل و بکارگیری آموخته‏‌ها در عمل</td>
                                <td>*دوره های آموزشی</td>
                                <td rowspan="4">یاددهی و یادگیری</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu16']*$list['vazn16']*0.25)+($list['exists2'][0]['menu16']*$list['vazn16']*0.55)+($list['exists3']['menu16'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn16']*$v['menu16']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn16']*$v['menu16']; }?></td>
                                <td>خود‏آموزی و کوشش در افزایش سطح دانش ‏شغلی </td>
                                <td>دانش ‏افزایی </td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu17']*$list['vazn17']*0.25)+($list['exists2'][0]['menu17']*$list['vazn17']*0.55)+($list['exists3']['menu17'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn17']*$v['menu17']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn17']*$v['menu17']; }?></td>
                                <td>توانایی انتقال معلومات و مهارت‌های شغلی به همکاران</td>
                                <td>آموزش به دیگران</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu18']*$list['vazn18']*0.25)+($list['exists2'][0]['menu18']*$list['vazn18']*0.55)+($list['exists3']['menu18'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn18']*$v['menu18']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn18']*$v['menu18']; }?></td>
                                <td>مستند‏سازی تجربیات و فرایندهای کاری شناسایی مسائلی که در حین انجام کار پیش آمده و راه‌‏حل‏‌هایی که عضو برای مسائل به آن رسیده</td>
                                <td>مدیریت دانش</td>
                                <td>18</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu19']*$list['vazn19']*0.25)+($list['exists2'][0]['menu19']*$list['vazn19']*0.55)+($list['exists3']['menu19'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn19']*$v['menu19']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn19']*$v['menu19']; }?></td>
                                <td>آشنایی کامل بر شرح وظایف، بخشنامه‏‌ها، آیین‏نامه‏‌ها و دستورالعمل‏‌های شغلی و رعایت قوانین و مقررات در کلیه امور</td>
                                <td>تسلط بر شغل و قانون‏‌مداری</td>
                                <td rowspan="7">توانمندی شغلی</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu20']*$list['vazn20']*0.25)+($list['exists2'][0]['menu20']*$list['vazn20']*0.55)+($list['exists3']['menu20'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td><input type="text" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"                                           title="This should be a number with up to 2 decimal places." name="menu20" value="<?=($list['exists3']['menu20'])?>" ></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn20']*$v['menu20']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn20']*$v['menu20']; }?></td>
                                <td>ارائه پیشنهادات کارشناسی و بهبود فرایند انجام کار در حیطه وظایف‏ شغلی</td>
                                <td> *خلاقیت و نو‏آوری</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu21']*$list['vazn21']*0.25)+($list['exists2'][0]['menu21']*$list['vazn21']*0.55)+($list['exists3']['menu21'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn21']*$v['menu21']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn21']*$v['menu21']; }?></td>
                                <td>اولویت‏ بندی امور محوله و الزام به اتمام آن در زمان مقرر</td>
                                <td>مدیریت ‏زمان</td>
                                <td>21</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu22']*$list['vazn22']*0.25)+($list['exists2'][0]['menu22']*$list['vazn22']*0.55)+($list['exists3']['menu22'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td><input type="text" name="menu22" value="<?=($list['exists3']['menu22'])?>" ></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn22']*$v['menu22']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn22']*$v['menu22']; }?></td>
                                <td>توانایی نگارش گزارشات تخصصی و فنی‏ کاربردی و قابل فهم با استفاده از شیوه‏‌های پذیرفته شده علمی</td>
                                <td> *گزارش‏‌دهی</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu23']*$list['vazn23']*0.25)+($list['exists2'][0]['menu23']*$list['vazn23']*0.55)+($list['exists3']['menu23'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn23']*$v['menu23']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn23']*$v['menu23']; }?></td>
                                <td>میزان تسط به آیین نگارش ‏اداری و بکارگیری آن در تدوین گزارشات‏کاری</td>
                                <td>مکاتبات ‏اداری</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu24']*$list['vazn24']*0.25)+($list['exists2'][0]['menu24']*$list['vazn24']*0.55)+($list['exists3']['menu24'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn24']*$v['menu24']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn24']*$v['menu24']; }?></td>
                                <td>تسلط و بکارگیری نرم‌‏افزارهای تخصصی مرتبط با شغل و شرح وظایف بر اساس شغل</td>
                                <td>نرم‌‌‏افزارهای‏ شغلی</td>
                                <td>24</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu25']*$list['vazn25']*0.25)+($list['exists2'][0]['menu25']*$list['vazn25']*0.55)+($list['exists3']['menu25'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn25']*$v['menu25']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn25']*$v['menu25']; }?></td>
                                <td> در انجام وظایف ICDL تسلط در استفاده از سامانه‌‏های دانشگاه و مهارت‌‏های </td>
                                <td>مهارت عمومی فاوا </td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu26']*$list['vazn26']*0.25)+($list['exists2'][0]['menu26']*$list['vazn80']*0.55)+($list['exists3']['menu26'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn80']*$v['menu26']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn26']*$v['menu26']; }?></td>
                                <td>
                                    <? foreach($list['exists2'] as $k => $v){
                                        echo
                                            $list['admins'][$v['admin_id2']]['name'].' '.
                                            $list['admins'][$v['admin_id2']]['family'].' : '.
                                            $v['newrow3'].'<br>';
                                    }?>
                                </td>
                                <td><? foreach($list['exists2'] as $k => $v){
                                        echo
                                            $list['admins'][$v['admin_id2']]['name'].' '.
                                            $list['admins'][$v['admin_id2']]['family'].' : '.
                                            $v['newrow1'].'<br>';
                                    }?></td>
                                <td rowspan="2">شاخص‌های پیشنهادی</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td><?= ($list['exists'][0]['menu27']*$list['vazn27']*0.25)+($list['exists2'][0]['menu27']*$list['vazn81']*0.55)+($list['exists3']['menu27'])  ?></td>
                                <td>0.20</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td>0.55</td>
                                <td><?foreach($list['exists2'] as $k => $v){ echo $list['vazn81']*$v['menu27']; }?></td>
                                <td>0.25</td>
                                <td><?foreach($list['exists'] as $k => $v){ echo $list['vazn27']*$v['menu27']; }?></td>
                                <td><? foreach($list['exists2'] as $k => $v){
                                        echo
                                            $list['admins'][$v['admin_id2']]['name'].' '.
                                            $list['admins'][$v['admin_id2']]['family'].' : '.
                                            $v['newrow4'].'<br>';
                                    }?></td>
                                <td><? foreach($list['exists2'] as $k => $v){
                                        echo
                                            $list['admins'][$v['admin_id2']]['name'].' '.
                                            $list['admins'][$v['admin_id2']]['family'].' : '.
                                            $v['newrow2'].'<br>';
                                    }?></td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>
                                    <?
                                    $sum = 0;
                                    for($p=1;$p<=27;$p++){
                                        $sum +=
                                            ($list['exists'][0]['menu'.$p]*$list['vazn'.$p]*0.25)+
                                            ($list['exists2'][0]['menu'.$p]*$list['vazn'.($p+54)]*0.55)+
                                            ($list['exists3']['menu'.$p]);
                                    }
                                    echo $sum;?>

                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?
                                    foreach($list['exists2'] as $k => $v){
                                        $sum = 0;
                                        ?>

                                        <?
                                        for ($k=1 ;$k<=27 ;$k++)
                                        {
                                            $sum += $list['vazn'.($k+54)]*$v['menu'.$k];
                                        }
                                        echo $sum;

                                    }?></td>
                                <td></td>
                                <td>
                                    <?
                                    foreach($list['exists'] as $k => $v){
                                        $sum = 0;
                                        ?>

                                        <?
                                        for ($k=1 ;$k<=27 ;$k++)
                                        {
                                            $sum += $list['vazn'.$k]*$v['menu'.$k];
                                        }
                                        echo $sum;

                                    }?>
                                </td>
                                <td>&nbsp;</td>
                                <td colspan="3">جمع</td>
                            </tr>
                        </table>
                        <p>
                            <input type="submit" class="btn btn-white btn-info" name="submit" id="submit" value="ثبت/ارسال" />
                        </p>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
