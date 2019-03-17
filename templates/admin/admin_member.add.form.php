<div class="content">
  <div class="content-header">
    <h2 class="content-title rtl"><i class="glyphicon glyphicon-user"></i>افزودن عاملیت</h2>
  </div>
  <!--/content-header -->
  
  <div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
      <div class="panel-heading bg-white">
        <h3 class="panel-title rtl">افزودن عاملیت</h3>
        <div class="panel-actions">
          <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه"> <i class="fa fa-expand"></i> </button>
          <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن"> <i class="fa fa-caret-down"></i> </button>
        </div>
        <!-- /panel-actions --> 
      </div>
      <!-- /panel-heading -->
      <?php if($msg!=null)
            { ?>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
        <?= $msg ?>
      </div>
      <?php
            }
            ?>
      <div class="panel-body">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8  center-block">
            <form name="addCompany" id="addCompany" role="form" data-validate="form" class="form-horizontal form-bordered" autocomplete="off" novalidate="novalidate" method="post">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="product_name">کد نمایندگی</label>
                    <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="کد نمایندگی " value="<?=$list['username'] ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="ManagerName">نام:</label>
                    <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="text" class="form-control" name="name" id="name" autocomplete="off" placeholder="نام" value="<?=$list['name'] ?>" required>
                    </div>
                  </div>
                </div>
              </div>
 
<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="product_name">نام خانوادگی</label>
                    <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="text" class="form-control" name="family" id="family" autocomplete="off" placeholder="نام خانوادگی" value="<?=$list['family'] ?>" required>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="product_name3">تلفن</label>
                    <div class="col-xs-12 col-sm-8 pull-right">
                      <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" placeholder="تلفن" value="<?=$list['phone'] ?>" required="required" />
                    </div>
                  </div>
                </div>
</div>  
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-6">
    <div class="form-group">
      <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="ManagerName2">موبایل:</label>
      <div class="col-xs-12 col-sm-8 pull-right">
        <input type="text" class="form-control" name="mobile" id="mobile" autocomplete="off" placeholder="موبایل" value="<?=$list['mobile'] ?>" required="required" />
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-6">
      <div class="form-group">
        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="product_name2">رمز عبور</label>
        <div class="col-xs-12 col-sm-8 pull-right">
          <input type="text" class="form-control" name="password" id="password" autocomplete="off" placeholder="رمز عبور" value="<?=$list['password'] ?>" required="required" />
        </div>
      </div>
  </div>
</div>                          
<div class="row xsmallSpace hidden-xs"></div>
              <div class="row">
                <div class="col-md-12">
                  <p class="pull-right">
                    <input type="hidden"  name="action" id="action" value="add">
                    <button type="submit" class="btn btn-icon btn-success rtl"> <i class="fa fa-plus"></i> اضافه کردن </button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/content --> 

