<div class="container-login">
    <div class="container-logo">
        <img src="<?=RELA_DIR?>templates/admin/images/logo@2x.png" alt="" class="center-block">
    </div>
    <div id="panel-login" class="panel panel-default sortable-widget-item center-block">
        <div class="panel-heading">
            <h3 class="panel-title rtl">ورود به سامانه پایش و ارزیابی برنامه عملیاتی</h3>
        </div>

        <div class="panel-body">
            <form action="" method="POST" data-validate="form" role="form">
                <input type="hidden" name="action" value="login" />
                <div class="form-group">
                    <div class="input-group input-group-in">
                        <span class="input-group-addon text-muted"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="نام کاربری" autocomplete="off" autofocus="" spellcheck="false" required>
                    </div><!--/input-group-->
                </div><!--/form-group-->

                <div class="form-group">
                    <div class="input-group input-group-in">
                        <span class="input-group-addon text-muted"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="گذرواژه" autocomplete="off" spellcheck="false" required>
                    </div><!--/input-group-->
                </div><!--/form-group-->

                <div class="form-group form-actions">
                    <input type="submit" class="btn btn-primary btn-default btn-block text-white text-16" value="ورود به سیستم">
                </div><!--/form-group-->


            </form><!--/#signin-form-->

            <a style="font-weight: bold" target="_blank" href="<?=RELA_DIR?>statics/sample/Portal GuideLine.pdf">دانلود راهنمای سامانه</a>

        </div>
    </div>
</div>