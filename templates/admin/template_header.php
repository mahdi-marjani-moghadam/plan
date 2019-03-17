
<? if($admin_info['result'] != -1):?>
<!-- section header -->
        <header class="header fixed">
            <div class=" pull-right" style="line-height: 3em">
                <h1 style="font-size: 14px"> کاربر گرامی، <?global $admin_info;?> <?=$admin_info['name']?> <?=$admin_info['family']?> خوش آمدید </h1>

            </div>
            <!-- header-profile -->
            <?php if($admin_info!=-1){?>
            <div class="header-profile pull-left">

                <div class="profile-nav">
                    <a  class="dropdown-toggle" data-toggle="dropdown">
                        <span class="profile-username text-16">حساب کاربری</span>
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInDown pull-right" role="menu">

                        <li><a href="<?php echo RELA_DIR ?>admin/?component=login&action=logout" class="text-16"><i class="fa fa-power-off"></i> خروج از حساب</a></li>
                    </ul>
                </div>
            </div><!-- header-profile -->
            <?php }?>

            <div class="pull-right logoHolder">
             <!--   <img src="<?php echo RELA_DIR;?>templates/<?php echo CURRENT_SKIN; ?>/images/logo-elin.png" alt="">-->
            </div>
            <a id="toggleSideBar"><i class="fa fa-bars"></i></a>
        </header><!--/header-->

        <? endif; ?>
