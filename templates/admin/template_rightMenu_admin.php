<aside class="side-left" id="side-left">
    <ul class="sidebar">
        <!--/sidebar-item-->
        <li>
            <a href="<?php print RELA_DIR; ?>admin/index.php">
                <i class="sidebar-icon fa fa-home"></i>
                <span class="sidebar-text">خانه</span>
            </a>
        </li><!--/sidebar-item-->
        <li>
            <a href="<?php print RELA_DIR; ?>admin/?component=reports">
                <i class="sidebar-icon fa fa-list"></i>
                <span class="sidebar-text">گزارش عملکرد</span>
            </a>

        </li><!--/sidebar-item-->
        <? if($admin_info['group_admin'] == '1' ):?>
        <li>
            <a class="Download">
                <i class="sidebar-icon fa fa-bar-chart"></i>
                <span class="sidebar-text">نمودار</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=1">
                        <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                    </a>
                </li><!--/child-item-->
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=2">
                        <span class="sidebar-text text-16">مقایسه در سطح اقدام</span>
                    </a>
                </li><!--/child-item-->
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=3">
                        <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                    </a>
                </li><!--/child-item-->
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=4">
                        <span class="sidebar-text text-16">مقایسه اقدامات در سطح هدف</span>
                    </a>
                </li>
            </ul>
        </li>
        <? endif;?>

        <? if($admin_info['group_admin'] == '0' ):?>
        <li>
            <a class="Download">
                <i class="sidebar-icon fa fa-bar-chart"></i>
                <span class="sidebar-text">نمودار</span>
            </a>
            <ul class="sidebar-child animated fadeInRight">
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=1">
                        <span class="sidebar-text text-16">مقایسه در سطح هدف</span>
                    </a>
                </li><!--/child-item-->
                <li>
                    <a href="<?=RELA_DIR?>admin/?component=chart&action=2">
                        <span class="sidebar-text text-16">مقایسه در سطح اقدام</span>
                    </a>
                </li>
            </ul>
        </li>
        <? endif;?>


        <? if($admin_info['flag'] == '100' ):?>
            <li>
                <a class="Download">
                    <i class="sidebar-icon fa fa-bar-chart"></i>
                    <span class="sidebar-text">نمودار</span>
                </a>
                <ul class="sidebar-child animated fadeInRight">
                    <li>
                        <a href="<?=RELA_DIR?>admin/?component=Chart&action=1">
                            <span class="sidebar-text text-16">مقایسه دانشکده ها در سطح هدف</span>
                        </a>
                    </li><!--/child-item-->
                    <li>
                        <a href="<?=RELA_DIR?>admin/?component=chart&action=">
                            <span class="sidebar-text text-16">...</span>
                        </a>
                    </li>
                </ul>
            </li>
        <? endif;?>


        <li>
            <a href="<?php print RELA_DIR; ?>admin/?component=form&q=,null,">
                <i class="sidebar-icon fa fa-line-chart"></i>
                <span class="sidebar-text"> وضعیت پیشرفت</span>
            </a>
        </li><!--/sidebar-item-->
        <?
        if($admin_info['admin1']!=0 || $admin_info['admin2']!=0 || $admin_info['admin3']!=0):
            ?>
            <!--<li>
                <a href="<?/*=RELA_DIR*/?>admin/?component=rate&action=showResult&id=<?/*=$admin_info['admin_id']*/?>">
                    <i class="sidebar-icon fa fa-group"></i>
                    <span class="sidebar-text">ارزیابی گروه ها</span>
                </a>
            </li>--><!--/sidebar-item-->
            <?
        endif;
        if($admin_info['admin1']!=0 || $admin_info['admin2']!=0 || $admin_info['admin3']!=0):
            ?>
            <li>
                <a href="<?php print RELA_DIR; ?>admin/?component=form&action=myForm">
                    <i class="sidebar-icon fa fa-list-alt"></i>
                    <span class="sidebar-text">فرم خود اظهاری</span>
                </a>
            </li><!--/sidebar-item-->
            <?
        endif;
        include_once ROOT_DIR.'component/admin/admin/model/admin.admin.model.php';
        $oop = new adminadminModel();
        $fields['where']=" admin1={$admin_info['admin_id']} or admin2={$admin_info['admin_id']} or admin3={$admin_info['admin_id']}";
        $res1 = $oop->getByFilter($fields);

        ?>

        <?/* if(($res1['export']['recordsCount']>0)):*/?><!--
            <?/* if($admin_info['group_admin']==1):*/?>
            <li>
                <a href="<?php /*print RELA_DIR; */?>admin/?component=admin&action=child">
                    <i class="sidebar-icon fa fa-users"></i>
                    <span class="sidebar-text">اعضاء زیر مجموعه</span>
                </a>
            </li>--><!--/sidebar-item-->
        <?/* endif;*/?><!--
        --><?/* endif;*/?>



        <li>
                    <a class="Download">
                <i class="sidebar-icon fa fa-download"></i>
                <span class="sidebar-text">راهنمای سامانه</span>
            </a>
                    <ul class="sidebar-child animated fadeInRight">
                        <li>
                            <a href="<?=RELA_DIR?>statics/sample/Portal GuideLine.pdf">
                                <span class="sidebar-text text-16">فایل متنی</span>
                            </a>
                        </li><!--/child-item-->
                        <li>
                            <a href="<?=RELA_DIR?>statics/sample/movie.rar">
                                <span class="sidebar-text text-16"> فایل ویدیویی</span>
                            </a>
                        </li><!--/child-item-->
                    </ul>
        </li>

        <li>
            <a class='download' href="<?=RELA_DIR?>statics/sample/شیوه نامه.pdf">
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
                </li><!--/sidebar-item-->


        <?/* if($admin_info['parent_id'] == '0' ):*/?><!--
            <li>
                <a href="<?php /*print RELA_DIR; */?>admin/?component=rate">
                    <i class="sidebar-icon fa fa-user"></i>
                    <span class="sidebar-text">محاسبه امتیاز کل</span>
                </a>
            </li><!--/sidebar-item-->
        <?/* endif;*/?>






        </ul><!--/sidebar-->
</aside><!--/side-left-->

<div class="content">
