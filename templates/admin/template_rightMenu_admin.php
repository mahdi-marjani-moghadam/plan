<aside class="side-left" id="side-left">
    <ul class="sidebar">
        <!--/sidebar-item-->
        <li>
            <a href="<?php print RELA_DIR; ?>admin/index.php">
                <i class="sidebar-icon fa fa-home"></i>
                <span class="sidebar-text">خانه</span>
            </a>
        </li>
        <!--/sidebar-item-->
        <li>
            <a class="Download">
                <i class="sidebar-icon fa fa-list-alt"></i>
                <span class="sidebar-text">پایش</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php print RELA_DIR; ?>admin/?component=reports&s=STEP_FORM<?php echo  STEP_FORM1 ?>">
                        <!--<i class="sidebar-icon fa fa-list"></i>-->
                        <span class="sidebar-text">گزارش عملکرد</span>
                    </a>

                </li>
                <!--/sidebar-item-->

                <li>
                    <a href="<?php print RELA_DIR; ?>admin/?component=form&q=,null,">
                        <span class="sidebar-text"> وضعیت پیشرفت</span>
                    </a>
                </li>
                <!--/sidebar-item-->
                <?php
                if ($admin_info['admin1'] != 0 || $admin_info['admin2'] != 0 || $admin_info['admin3'] != 0) :
                ?>
                    <li>
                        <a href="<?php print RELA_DIR; ?>admin/?component=form&action=myForm">
                            <span class="sidebar-text">فرم خود اظهاری</span>
                        </a>
                    </li>
                    <!--/sidebar-item-->
                <?php
                endif;
                include_once ROOT_DIR . 'component/admin/admin/model/admin.admin.model.php';
                $oop = new adminadminModel();
                $fields['where'] = " admin1={$admin_info['admin_id']} or admin2={$admin_info['admin_id']} or admin3={$admin_info['admin_id']}";
                $res1 = $oop->getByFilter($fields);
                ?>


                <?php if ($admin_info['group_admin'] == '0') : ?>
                    <li>
                        <a class="Download">
                            <!--<i class="sidebar-icon fa fa-bar-chart"></i>-->
                            <span class="sidebar-text">نمودار</span>
                        </a>
                        <ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=1&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=2&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if ($admin_info['group_admin'] == '1' && $admin_info['parent_id'] != 0) : ?>
                    <li>
                        <a class="Download">

                            <span class="sidebar-text">نمودار</span>
                        </a>
                        <ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=1&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=2&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح اقدام</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=3&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=4&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اهداف</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($admin_info['parent_id'] == '0') : ?>
                    <li>
                        <a class="Download">

                            <span class="sidebar-text">نمودار گروه‌ها</span>
                        </a>
                        <ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=g1&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=g2&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a class="Download">

                            <span class="sidebar-text">نمودار دانشکده و ستاد</span>
                        </a>
                        <ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=v1&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=v2&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه در سطح اقدام</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=v3&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=v4&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه اهداف</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="Download">

                            <span class="sidebar-text">نمودار دانشگاه</span>
                        </a>
                        <ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=1&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">مقایسه واحدها در سطح هدف</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=2&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">وضعیت دانشگاه در سطح هدف کلان</span>
                                </a>
                            </li>
                            <!--/child-item-->
                            <li>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=3&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">میانگین دانشکده ها</span>
                                </a>
                                <a href="<?php echo  RELA_DIR ?>admin/?component=chart&action=4&s=<?php echo  STEP_FORM1 ?>">
                                    <span class="sidebar-text text-16">میانگین ستاد</span>
                                </a>
                            </li>
                            <!--/child-item-->


                        </ul>
                    </li>
                <?php endif; ?>




                <?php /* if(($res1['export']['recordsCount']>0)):*/ ?>
                <!--
            <?php /* if($admin_info['group_admin']==1): */ ?>
            <li>
                <a href="<?php /*print RELA_DIR; */ ?>admin/?component=admin&action=child">
                    <i class="sidebar-icon fa fa-users"></i>
                    <span class="sidebar-text">اعضاء زیر مجموعه</span>
                </a>
            </li>-->
                <!--/sidebar-item-->
                <?php /* endif;*/ ?>
                <!--
        -->
                <?php /* endif;*/ ?>
            </ul>
        </li>


        <li>
            <a class="Download">
                <i class="sidebar-icon fa fa-chart-pie"></i>
                <span class="sidebar-text">ارزیابی</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=khodezhari">
                        <span class="sidebar-text text-16"> خوداظهاری</span></a>
                    <!--<ul class="sidebar-child animated fadeInRight">
                            <li>
                                <a href="<?php /*= RELA_DIR */?>admin/?component=shakhes&action=shora">
                                    <span class="sidebar-text text-16">فرم عضویت در شوراهای برون دانشگاهی</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php /*= RELA_DIR */?>admin/?component=shakhes&action=jalasat">
                                    <span class="sidebar-text text-16">فرم جلسات توجیهی تحصیلات تکمیلی</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php /*= RELA_DIR */?>admin/?component=shakhes&action=daneshamukhte">
                                    <span class="sidebar-text text-16">فرم همکاری دانش آموختگان و دانشجویان </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php /*= RELA_DIR */?>admin/?component=shakhes&action=ruydad">
                                    <span class="sidebar-text text-16">فرم رویدادهای برگزار شده</span>
                                </a>
                            </li>
                        </ul>-->
                <li>
                    <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes">
                        <span class="sidebar-text text-16"> گزارش</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes">
                        <span class="sidebar-text text-16"> نمودار</span>
                    </a>
                </li>


                <?php if($admin_info['admin_id'] == 1): ?> 
                <li>
                    <a href="<?php echo  RELA_DIR ?>admin/?component=shakhes&action=setting">
                        <span class="sidebar-text text-16"> تنظیمات شاخص</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR ?>admin/page/1/?component=shakhes&action=adminSetting">
                        <span class="sidebar-text text-16"> تنظیمات ادمین</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>


        <li>
            <a class="Download">
                <i class="sidebar-icon fa fa-download"></i>
                <span class="sidebar-text">راهنمای سامانه</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?php echo  RELA_DIR ?>statics/sample/Portal GuideLine.pdf">
                        <span class="sidebar-text text-16"> راهنمای منوی پایش</span>
                    </a>
                </li>
                <!--/child-item-->
                <li>
                    <a href="<?php echo  RELA_DIR ?>statics/sample/movie.rar">
                        <span class="sidebar-text text-16"> راهنمای ویدیویی منوی پایش</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo  RELA_DIR ?>statics/sample/formsguide.pdf">
                        <span class="sidebar-text text-16"> راهنمای منوی ارزیابی</span>
                    </a>
                </li>
                <!--/child-item-->
            </ul>
        </li>

        <li>
            <a class='download' href="<?php echo  RELA_DIR ?>statics/sample/شیوه نامه.pdf">
                <i class="sidebar-icon fa fa-download"></i>
                <span class="sidebar-text">شیوه نامه ارزیابی</span>
            </a>
        </li>

        <!--<li>
            <a href="#">
                <i class="sidebar-icon fa fa-user"></i>
                <span class="sidebar-text">شیوه نامه</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="">
                        <span class="sidebar-text text-16">راهنمای سامانه</span>
                    </a>
                </li><!--/child-item-->


        <li>
            <a href="<?php print RELA_DIR; ?>admin/?component=admin">
                <i class="sidebar-icon fa fa-gears"></i>
                <span class="sidebar-text">تنظیمات کاربری</span>
            </a>
        </li>
        <!--/sidebar-item-->


        <?php /* if($admin_info['parent_id'] == '0' ):*/ ?>
        <!--
            <li>
                <a href="<?php /*print RELA_DIR; */ ?>admin/?component=rate">
                    <i class="sidebar-icon fa fa-user"></i>
                    <span class="sidebar-text">محاسبه امتیاز کل</span>
                </a>
            </li><!--/sidebar-item-->
        <?php /* endif;*/ ?>






    </ul>
    <!--/sidebar-->
</aside>
<!--/side-left-->

<div class="content">