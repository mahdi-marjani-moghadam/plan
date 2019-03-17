
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


    <?
    if($list['insert_date'] != ''){
        ?>
    #form1 .btn,#form1 a.download,input[type=file]{display: none}

    <?
        for ($i=1;$i<=27;$i++){    ?>
    #s2id_menu<?=$i?>{display: none}

    <?   } }?>
</style>



<div class="content-body">

    <div id="panel-tablesorter" class="panel panel-warning" >
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم خودارزیابی</h3>
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
                    <form class="mostanadat " data-type="mostanadat2" id="form1" name="form1" method="post" action="" enctype="multipart/form-data" style="direction: ltr; text-align: right; font-family: Tahoma, Geneva, sans-serif; font-size: 16px; color: #111;">
                        <input name="semat" id="semat" type="hidden" value="<?=$list['semat']?>">
                        <table width="1238" border="1" align="center" style="direction: ltr; font-size:12px">
                            <tr bgcolor="#FFFFCC">
                                <td width="122"> سال 95</td>
                                <td width="112">دوره ارزیابی:</td>
                                <td colspan="2">کاربرگ ارزیابی عملکرد اعضای غیر هیأت علمی دانشگاه الزهرا(س)-;کارشناس مسئول-کارشناس و سطوح پایین تر </td>
                                <td><p>کاربرگ شماره 2   </p>
                                    <p>(خود ارزیابی)</p></td>
                                <td><img src="<?=TEMPLATE_DIR?>images/logo@2x.png" width="140" height="118" /></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC"><?=$list['vahed_fari']?></td>
                                <td bgcolor="#FFFFCC">واحد فرعی:</td>
                                <td width="404" bgcolor="#FFFFCC"><?=$list['vahed_asli']?></td>
                                <td width="222" bgcolor="#FFFFCC">حوزه/واحد اصلی:</td>
                                <td width="170" bgcolor="#FFFFCC"><?=$list['name']?></td>
                                <td width="168" bgcolor="#FFFFCC">نام:</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC"><?=$list['semat']?></td>
                                <td bgcolor="#FFFFCC">سمت:</td>
                                <td bgcolor="#FFFFCC">&nbsp;<?=$list['posts']?></td>
                                <td bgcolor="#FFFFCC">عنوان پست سازمانی:</td>
                                <td bgcolor="#FFFFCC"><?=$list['family']?></td>
                                <td bgcolor="#FFFFCC">نام خانوادگی:</td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFCC">&nbsp;</td>
                                <td bgcolor="#FFFFCC">&nbsp;</td>
                                <td bgcolor="#FFFFCC"><?=convertDate($list['insert_date'])?></td>
                                <td bgcolor="#FFFFCC">تاریخ تکمیل کاربرگ:</td>
                                <td bgcolor="#FFFFCC"><?=$list['code_meli']?></td>
                                <td bgcolor="#FFFFCC">کد ملی:</td>
                            </tr>
                        </table>
                        <p>&nbsp;</p>
                        <table width="1284" border="34" align="center"><table width="1284" height="34" border="1" >
                                <tr>
                                    <td width="1274" align="right" bgcolor="#990033" style="color: #fff;">تذکر: لطفاً قبل از تکمیل فرم ارزیابی نسبت به ضمیمه نمودن مستندات مربوط به شاخص‌هایی که به رنگ قرمز مشخص شده اقدام نمایید. لازم به ذکر است پس از امتیازدهی و ثبت، امکان ضمیمه نمودن مستندات وجود ندارد و امتیاز بخش مستندات برای شما لحاظ نمی گردد.</td>
                                </tr>
                            </table>
                            <table width="1284" border="" align="center">
                            <tr>
                                <td width="1274" align="right" bgcolor="#990033" style="color: #fff;">لطفا قبل از تائید نهایی از کامل بودن مدارک ارسالی اطمینان حاصل نمایید.
                                </td>
                            </tr>
                                </table>
                    <p>&nbsp;</p>

                        <table width="1295 " border="1" align="center" style="direction: ltr; font-size: 12px">
                            <tr>
                                <td colspan="8"  color="#F00" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                            <tr>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td bgcolor="#99CCFF">&nbsp;</td>
                                <td colspan="3" bgcolor="#99CCFF">ارزیابی شونده در ستون ارزیابی می ‏بایست بر روی فلش کلیک نموده و یکی از گزینه ‏ها را انتخاب نمایند</td>
                                <td colspan="2" bgcolor="#99CCFF">راهنمای ارزیابی:</td>
                            </tr>
                            <tr>
                                <td width="225" bgcolor="#99CCFF">مستندات قابل قبول</td>
                                <td width="48" bgcolor="#99CCFF">امتیاز مکتسبه</td>
                                <td width="124" bgcolor="#99CCFF">ارزیابی</td>
                                <td width="33" bgcolor="#99CCFF"></td>
                                <td width="568" bgcolor="#99CCFF">توصیف شاخص</td>
                                <td width="144" bgcolor="#99CCFF">شاخص</td>
                                <td width="67" bgcolor="#99CCFF">معیار</td>
                                <td width="34" bgcolor="#99CCFF">ردیف</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class='s1'><?=$list['vazn1']*$list['menu1'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu1'],'t') !== 0)? translate($list['menu1']):'';?><select name="menu1" id="menu1">
                                        <option <?=($list['menu1'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu1'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu1'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu1'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu1'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu1'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="5"></td>
                                <td>احترام به ارزش‌های اسلامی، شئونات اجتماعی و پوشش متناسب با محیط‏ کار</td>
                                <td>تعظیم شعائر</td>
                                <td rowspan="5">اخلاق حرفه‌ای</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn2']*$list['menu2'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu2'],'t') !== 0)? translate($list['menu2']):'';?><select name="menu2" id="menu2">
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
                                <td>&nbsp;</td>

                                <td class='s1'><?=$list['vazn3']*$list['menu3'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu3'],'t') !== 0)? translate($list['menu3']):'';?><select name="menu3" id="menu3">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn4']*$list['menu4'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu4'],'t') !== 0)? translate($list['menu4']):'';?><select name="menu4" id="menu4">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn5']*$list['menu5'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu5'],'t') !== 0)? translate($list['menu5']):'';?><select name="menu5" id="menu5">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn6']*$list['menu6'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu6'],'t') !== 0)? translate($list['menu6']):'';?><select name="menu6" id="menu6">
                                        <option <?=($list['menu6'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu6'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu6'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu6'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu6'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu6'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="5"></td>
                                <td>پشتکار، جدیت، سخت‏ کوشی و پیگیری امور تا حصول نتیجه</td>
                                <td> مسئولیت پذیری</td>
                                <td rowspan="5">تعهد سازمانی</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn7']*$list['menu7'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu7'],'t') !== 0)? translate($list['menu7']):'';?><select name="menu7" id="menu7">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn8']*$list['menu8'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu8'],'t') !== 0)? translate($list['menu8']):'';?><select name="menu8" id="menu8">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn9']*$list['menu9'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu9'],'t') !== 0)? translate($list['menu9']):'';?><select name="menu9" id="menu9">
                                        <option <?=($list['menu9'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu9'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu9'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu9'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu9'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu9'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                </select>
                                <td>
                                    رفتار فردی و داوطلبانه‌ منجر به ارتقای اثر بخشی واحد خارج از شرح وظایف سازمانی و یا خارج از ساعت اداری
                                </td>
                                <td>  رفتار شهروندی سازمانی</td>
                                <td>9</td>
                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn10']*$list['menu10'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu10'],'t') !== 0)? translate($list['menu10']):'';?><select name="menu10" id="menu10">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn11']*$list['menu11'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu11'],'t') !== 0)? translate($list['menu11']):'';?><select name="menu11" id="menu11">
                                        <option <?=($list['menu11'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu11'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu11'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu11'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu11'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu11'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="4"></td>
                                <td>برقراری ارتباط میان فردی مناسب با همکاران و مدیران ایجاد تفاهم و تعامل مناسب</td>
                                <td>تعاملات</td>
                                <td rowspan="4">مهارت‌های ارتباطی</td>
                                <td>11</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn12']*$list['menu12'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu12'],'t') !== 0)? translate($list['menu12']):'';?><select name="menu12" id="menu12">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn13']*$list['menu13'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu13'],'t') !== 0)? translate($list['menu13']):'';?><select name="menu13" id="menu13">
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
                                <td>
<!--                                    <a href="<?/*=RELA_DIR*/?>statics/sample/1.docx">دانلود فایل مربوطه</a>
--><!--                                    <input type="file" name="file3">
-->                                    <input type="file" name="file4">
                                    <a href="<?=RELA_DIR?>statics/files/<?=$list['admin_id']?>/<?=$list['file4']?>"><?=$list['file4']?></a>
                                </td>
                                <td class='s1'><?=$list['vazn14']*$list['menu14'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu14'],'t') !== 0)? translate($list['menu14']):'';?><select name="menu14" id="menu14">
                                        <option <?=($list['menu14'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu14'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu14'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu14'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu14'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu14'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>حضور فعال در گروه‌‏های کاری و ایجاد هم‌افزایی در واحد مربوطه</td>
                                <td style="color:red">*کارگروهی</td>
                                <td>14</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn15']*$list['menu15'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu15'],'t') !== 0)? translate($list['menu15']):'';?><select name="menu15" id="menu15">
                                        <option <?=($list['menu15'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu15'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu15'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu15'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu15'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu15'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="4"></td>
                                <td>مشارکت فعال در دوره‌‏های آموزشی مرتبط با شغل و بکارگیری آموخته‏‌ها در عمل</td>
                                <td>دوره های آموزشی*</td>
                                <td rowspan="4">یاددهی و یادگیری</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn16']*$list['menu16'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu16'],'t') !== 0)? translate($list['menu16']):'';?><select name="menu16" id="menu16">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn17']*$list['menu17'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu17'],'t') !== 0)? translate($list['menu17']):'';?><select name="menu17" id="menu17">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn18']*$list['menu18'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu18'],'t') !== 0)? translate($list['menu18']):'';?><select name="menu18" id="menu18">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn19']*$list['menu19'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu19'],'t') !== 0)? translate($list['menu19']):'';?><select name="menu19" id="menu19">
                                        <option <?=($list['menu19'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu19'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu19'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu19'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu19'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu19'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td rowspan="7"></td>
                                <td>آشنایی کامل بر شرح وظایف، بخش نامه ها، آیین نامه ها و دستورالعمل های شغلی و رعایت قوانین و مقررات در کلیه امور</td>
                                <td>تسلط بر شغل و قانون‏‌مداری</td>
                                <td rowspan="7">توانمندی شغلی</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td>
<!--                                    <a href="<?/*=RELA_DIR*/?>statics/sample/1.docx">دانلود فایل مربوطه</a>
--><!--                                    <input type="file" name="file7">
-->                                    <input type="file" name="file8">
                                    <a href="<?=RELA_DIR?>statics/files/<?=$list['admin_id']?>/<?=$list['file8']?>"><?=$list['file8']?></a>
                                </td>
                                <td class='s1'><?=$list['vazn20']*$list['menu20'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu20'],'t') !== 0)? translate($list['menu20']):'';?><select name="menu20" id="menu20">
                                        <option <?=($list['menu20'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu20'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu20'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu20'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu20'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu20'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>ارائه پیشنهادات کارشناسی و بهبود فرایند انجام کار در حیطه وظایف‏ شغلی</td>
                                <td style="color:red"> *خلاقیت و نو‏آوری</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn21']*$list['menu21'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu21'],'t') !== 0)? translate($list['menu21']):'';?><select name="menu21" id="menu21">
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
                                <td>
<!--                                    <a href="<?/*=RELA_DIR*/?>statics/sample/1.docx">دانلود فایل مربوطه</a>
-->                                    <input type="file" name="file9">
                                    <a href="<?=RELA_DIR?>statics/files/<?=$list['admin_id']?>/<?=$list['file9']?>"><?=$list['file9']?></a>
<!--                                    <input type="file" name="file10">
-->                                </td>
                                <td class='s1'><?=$list['vazn22']*$list['menu22'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu22'],'t') !== 0)? translate($list['menu22']):'';?><select name="menu22" id="menu22">
                                        <option <?=($list['menu22'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu22'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu22'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu22'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu22'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu22'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>توانایی نگارش گزارشات تخصصی و فنی‏ کاربردی و قابل فهم با استفاده از شیوه‏‌های پذیرفته شده علمی</td>
                                <td style="color:red">* گزارش‏‌دهی</td>
                                <td>22</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn23']*$list['menu23'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu23'],'t') !== 0)? translate($list['menu23']):'';?><select name="menu23" id="menu23">
                                        <option <?=($list['menu23'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu23'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu23'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu23'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu23'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu23'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>میزان تسط به آیین نگارش ‏اداری و بکارگیری آن در تدوین گزارشات‏ کاری</td>
                                <td>مکاتبات ‏اداری</td>
                                <td>23</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn24']*$list['menu24'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu24'],'t') !== 0)? translate($list['menu24']):'';?><select name="menu24" id="menu24">
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
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn25']*$list['menu25'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu25'],'t') !== 0)? translate($list['menu25']):'';?><select name="menu25" id="menu25">
                                        <option <?=($list['menu25'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu25'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu25'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu25'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu25'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu25'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td> تسلط در استفاده از سامانه‌‏های دانشگاه و مهارت‌‏های ICDL در انجام وظایف   </td>
                                <td>مهارت عمومی فاوا </td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class='s1'><?=$list['vazn26']*$list['menu26'];?></td>
                                <td><?=($list['insert_date'] != ''&& strpos($list['menu26'],'t') !== 0)? translate($list['menu26']):'';?><select name="menu26" id="menu26">
                                        <option <?=($list['menu26'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu26'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu26'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu26'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu26'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu26'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>&nbsp;</td>
                                <td><label for="newrow3"></label>
                                    <textarea name="newrow3"  cols="90" id="newrow3"><?=$list['newrow3']?></textarea></td>
                                <td><label for="newrow1"></label>
                                    <input type="text" name="newrow1" value="<?=$list['newrow1']?>" id="newrow1" /></td>
                                <td rowspan="2">شاخص‌های پیشنهادی</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td class='s1'><?=$list['vazn27']*$list['menu27'];?></td>
                                <td><?=strpos($list['menu27'],'t')?><?=($list['insert_date'] != ''&& strpos($list['menu27'],'t') !== 0)? translate($list['menu27']):'';?><select name="menu27" id="menu27">
                                        <option <?=($list['menu27'] == 0)?'selected':'';?> value="0">لطفا انتخاب کنید</option>
                                        <option <?=($list['menu27'] == 4)?'selected':'';?> value="4">بسیار خوب</option>
                                        <option <?=($list['menu27'] == 3.2)?'selected':'';?> value="3.2">خوب</option>
                                        <option <?=($list['menu27'] == 2.4)?'selected':'';?> value="2.4">متوسط</option>
                                        <option <?=($list['menu27'] == 1.6)?'selected':'';?> value="1.6">ضعیف</option>
                                        <option <?=($list['menu27'] == 0.8)?'selected':'';?> value="0.8">بسیار ضعیف</option>
                                    </select></td>
                                <td>&nbsp;</td>
                                <td><label for="newrow4"></label>
                                    <textarea name="newrow4" cols="90" id="newrow4" ><?=$list['newrow4']?></textarea></td>
                                <td><label for="newrow2"></label>
                                    <input type="text" name="newrow2" id="newrow2" value="<?=$list['newrow2']?>" /></td>
                                <td>27</td>
                            </tr>
                            <td></td>
                            <td id="s1">
                                <?
                                $sum = 0;
                                for ($i=1 ;$i<=27 ;$i++)
                                {
                                    $sum += $list['menu'.$i]*$list['vazn'.$i];
                                }
                                echo $sum;
                                ?>
                            </td>
                            <td colspan="">&nbsp;</td>
                            <td colspan="2">&nbsp;</td>
                            <td colspan="3">جمع</td>
                        </table>
                        <p>.(تذکر 1: در صورت عدم مصداق یک یا دو شاخص از شاخص‌های تعریف شده ارزیابی کننده/ارزیابی شونده می‌تواند نسبت به تعریف 1 یا 2 شاخص اقدام نماید(در ردیف 26 و 27</p>
                        <p>.تذکر2: ارزیابی کننده/ارزیابی شونده فقط و فقط می‌تواند 25 شاخص امتیاز دهی نماید</p>
                        <p>&nbsp;</p>

                        <p class="text-center" style="padding: 0 30px">

                            <input class="btn btn-primary btn-default text-white text-16" name="submit" id="submit" value="ثبت" type="submit">
                            </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
