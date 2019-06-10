<div class="content content-full">
    <div class="container">
        <div class="signin-wrapper">
            <div class="tab-content">
                <div class="row tab-pane fade in active" id="signin">

                    <div class="col-md-3   col-sm-8"></div>
                    <div class="col-md-4   col-sm-8">

                        <div class="signin">
                            <div class="signin-brand text-center">
                                <a href="<?php echo RELA_DIR;?>login.php">
                                    <img  src="<?php echo RELA_DIR;?>templates/<?php echo CURRENT_SKIN; ?>/images/logo@2x.png" >
                                </a>
                            </div><!--/signin-brand-->

                            <? if($msg != ''):?>
                                <div class="alert alert-danger"><?=$msg?></div>
                            <? endif;?>
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
                        </div><!--/signin-->




                    </div><!--/cols-->
                </div><!--/row-->

            </div><!--/tab-content-->

            <div class="signin-footer">
                <ul class="list-inline pull-right">
                    <li>&copy; 2016 </li>
                </ul>
            </div>

        </div><!--/signin-wapper-->

    </div><!--/container-->
</div><!--/content-->